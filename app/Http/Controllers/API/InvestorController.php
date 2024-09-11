<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\InvestorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class InvestorController extends Controller
{
    public function index() 
    {
        $user = JWTAuth::user();
        if ($user == null || $user->level != 'investor') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $investor = InvestorModel::where('id_user', $user->id_user)->with('user')->first();
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
            'name' => 'required|string|max:100',
            'address' => 'required|string',
            'telephone' => 'required|numeric|max_digits:18',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $investor = InvestorModel::where('id_user', $user->id_user)->first();
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
            $investor->save();
        }

        return response()->json(['message' => 'Investor data saved', 'investor' => $investor]);
    }
}
