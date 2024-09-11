<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MitraModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

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
        $mitra = MitraModel::where('id_user', $user->id_user)->first();
        if ($mitra == null) {
            return response()->json(['message' => 'Mitra not found'], 404);
        }

        return response()->json(['message' => 'Mitra data', 'mitra' => $mitra]);
    }

    // Function to store the mitra data
    public function store(Request $request)
    {
        $user = JWTAuth::user();
        if ($user == null || $user->level != 'mitra') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'address' => 'required|string',
            'telephone' => 'required|string|max:15',
            'nik' => 'required|string|max:16',
            // 'ktp_image' => 'required|image',
        ]);

        // Return Validation Error
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $mitra = MitraModel::where('id_user', $user->id_user)->first();
        if ($mitra == null) {
            $mitra = new MitraModel();
            $mitra->id_user = $user->id_user;
        }

        $mitra->name = $request->name;
        $mitra->address = $request->address;
        $mitra->telephone = $request->telephone;
        $mitra->nik = $request->nik;
        $mitra->ktp_image = "Error Custom";
        $mitra->save();

        return response()->json(['message' => 'Mitra data successfully saved', 'mitra' => $mitra]);
    }
}
