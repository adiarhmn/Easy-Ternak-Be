<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MitraModel;
use Illuminate\Http\Request;
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
            'name' => 'required|string|max:100',
            'address' => 'required|string',
            'telephone' => 'required|numeric|max_digits:15',
            'nik' => 'required|numeric|max_digits:18',
            'ktp_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Return Validation Error
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

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

            $fileName = "ktp-" . $user?->id_user . time() . '.' . $fileImage->getClientOriginalExtension();
            // Resize the image and Upload Image
            $ImageManager = new ImageManager(new Driver());
            $ImageManager->read($fileImage)->resize(200, 200)->save('uploads/' . $fileName);
        }

        $mitra->name = $request->name;
        $mitra->address = $request->address;
        $mitra->telephone = $request->telephone;
        $mitra->nik = $request->nik;
        $mitra->ktp_image = $fileName ?? $mitra->ktp_image;
        $mitra->save();

        return response()->json(['message' => 'Mitra data successfully saved', 'mitra' => $mitra]);
    }
}
