<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AnimalProgressModel;
use App\Models\ProgressImageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProgressController extends Controller
{
    public function saveData(Request $request)
    {
        // Get the authenticated user
        $user = JWTAuth::user();

        // Validate the request
        $validator = Validator::make($request->all(), [
            'id_animal' => 'required|integer',
            'description' => 'required|string',
            'date' => 'required',
            'progress_images' => 'required|array',
            'progress_images.*' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        // Return validation error
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Save file images
        $nameImages = [];
        if ($request->hasFile('progress_images')) {
            $files = $request->file('progress_images');
            foreach ($files as $index => $fileImage) {
                $fileName = "anml-$index" . now()->format('Ymd-His') . '.' . $fileImage->getClientOriginalExtension();

                // Resize the image and Upload Image
                $ImageManager = new ImageManager(new Driver());
                $ImageManager->read($fileImage)->scaleDown(400)->save('uploads/' . $fileName, 90);

                // Save the image name
                $nameImages[$index] = $fileName;
            }
        }

        // Save the progress data
        $AnimalProgress = AnimalProgressModel::create([
            'id_animal' => $request->id_animal,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        // Save the progress images
        foreach ($nameImages as $nameImage) {
            ProgressImageModel::create([
                'id_animal_progress' => $AnimalProgress->id_animal_progress,
                'image' => $nameImage
            ]);
        }

        return response()->json(['message' => 'Progress saved', 'progress' => $AnimalProgress]);
    }
}
