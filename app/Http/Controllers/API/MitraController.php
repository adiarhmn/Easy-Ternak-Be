<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MitraModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class MitraController extends Controller
{

    // Function to get the authenticated mitra data
    public function index()
    {
        // Get the authenticated user
        $user = JWTAuth::user();
        if ($user == null || $user->level != 'mitra') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Get the mitra data
        $mitra = MitraModel::where('id_user', $user->id_user)->with('user')->first();
        if ($mitra == null) {
            return response()->json(['message' => 'Mitra not found'], 404);
        }

        return response()->json(['message' => 'Mitra data', 'mitra' => $mitra]);
    }

    // Function to store the mitra data
    public function saveData(Request $request)
    {
        $user = JWTAuth::user();
        if ($user == null || $user->level != 'mitra') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:20|alpha_num',
            'name' => 'required|string|max:20',
            'address' => 'required|string',
            'telephone' => 'required|numeric|max_digits:15',
            'nik' => 'required|numeric|max_digits:18',
            'ktp_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Return Validation Error
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Start the transaction
        DB::beginTransaction();
        try {
            // Check if the mitra is new or not
            $mitra = MitraModel::where('id_user', $user->id_user)->first();
            if ($mitra == null) {
                $mitra = new MitraModel();
                $mitra->id_user = $user->id_user;
            }

            // Process Upload the image File
            $fileImage = $request->file('ktp_image');
            if ($fileImage != null) {
                // Check if exist image and delete the image
                if ($mitra->ktp_image != null) {
                    if (file_exists('uploads/' . $mitra->ktp_image)) {
                        unlink('uploads/' . $mitra->ktp_image);
                    }
                }

                $fileKTPName = "ktp-" . $user?->id_user . now()->format('Ymd-His') . '.' . $fileImage->getClientOriginalExtension();
                // Resize the image and Upload Image
                $ImageManager = new ImageManager(new Driver());
                $ImageManager->read($fileImage)->scaleDown(400)->save('uploads/' . $fileKTPName, 90);
            }

            // Save the mitra data
            $mitra->name = $request->name;
            $mitra->address = $request->address;
            $mitra->telephone = $request->telephone;
            $mitra->nik = $request->nik;
            $mitra->ktp_image = $fileKTPName ?? $mitra->ktp_image;
            $mitra->save();


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

        return response()->json(['message' => 'Mitra data successfully saved', 'mitra' => $mitra]);
    }
}
