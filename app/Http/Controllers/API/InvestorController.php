<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AnimalModel;
use App\Models\InvestorModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Tymon\JWTAuth\Facades\JWTAuth;

class InvestorController extends Controller
{
    public function index()
    {
        $user = JWTAuth::user();
        if ($user == null || $user->level != 'investor') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $investor = InvestorModel::where('id_user', $user->id_user)
            ->with('investorProfit')
            ->withSum('investorProfit as total_profit', 'profit')
            ->with('investmentSlot')
            ->with('user')
            ->first();
        if ($investor == null) {
            return response()->json(['message' => 'Investor not found'], 404);
        }

        return response()->json(['message' => 'Investor data', 'investor' => $investor]);
    }

    public function saveData(Request $request)
    {
        $user = JWTAuth::user();
        if ($user == null || $user->level != 'investor') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:20|alpha_num',
            'name' => 'required|string|max:20',
            'address' => 'required|string',
            'telephone' => 'required|numeric|max_digits:15',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'payment_number' => 'nullable|numeric|max_digits:25',
            'provider' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }


        // Start the transaction
        DB::beginTransaction();
        $investor = InvestorModel::where('id_user', $user->id_user)->first();
        try {
            if ($investor == null) {
                $investor = InvestorModel::create([
                    'id_user' => $user->id_user,
                    'name' => $request->name,
                    'address' => $request->address,
                    'telephone' => $request->telephone,
                ]);
            } else {
                $investor->name = $request->name;
                $investor->address = $request->address;
                $investor->telephone = $request->telephone;
                $investor->payment_number = $request->payment_number;
                $investor->provider = $request->provider;
                $investor->save();
            }

            // Save and Update Data User & Process Upload the Profile Image
            $user = User::find($user->id_user);
            $filePicture = $request->file('profile_picture');
            if ($filePicture != null) {
                // Check if exist image and delete the image
                if ($user->profile_picture != null) {
                    if (file_exists('uploads/' . $user->profile_picture)) {
                        unlink('uploads/' . $user->profile_picture);
                    }
                }
                $fileName = "profile-" . $user?->id_user . now()->format('Ymd-His') . '.' . $filePicture->getClientOriginalExtension();
                // Resize the image and Upload Image
                $ImageManager = new ImageManager(new Driver());
                $ImageManager->read($filePicture)->scaleDown(400)->save('uploads/' . $fileName, 90);
            }

            $user->username = $request->username;
            $user->profile_picture = $fileName ?? $user->profile_picture;
            $user->save();

            // Commit Transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback Transaction
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()]);
        }

        return response()->json(['message' => 'Investor data saved', 'investor' => $investor]);
    }

    public function getByAnimal($id)
    {
        // Get Authenticated User
        $user = JWTAuth::user();
        if ($user == null) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Get Investors By Animal ID
        $investors = InvestorModel::whereHas('investmentSlot', function ($query) use ($id) {
            $query->whereHas('animal', function ($query) use ($id) {
                $query->where('id_animal', $id);
            });
        })->with(['investmentSlot' => function ($query) use ($id) {
            $query->where('id_animal', $id);
        }])->get();

        return response()->json(['message' => 'Investor data', 'investors' => $investors]);
    }
}
