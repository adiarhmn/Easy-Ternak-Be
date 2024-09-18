<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AnimalImageModel;
use App\Models\AnimalModel;
use App\Models\InvestmentSlotModel;
use App\Models\MitraModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class AnimalController extends Controller
{

    // Function to get the animal data
    public function index()
    {
        $user = JWTAuth::user();
        if ($user == null) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // $animals = AnimalModel::with('subAnimalType.animalType')->with('investmentSlot')->with('mitra')->get();
        $animals = AnimalModel::withCount([
            'InvestmentSlot as total_sold' => function ($query) {
                $query->where('status', 'sold')->orWhere('status', 'pending');
            },
            'InvestmentSlot as total_ready' => function ($query) {
                $query->where('status', 'ready');
            }
        ])->with('subAnimalType.animalType')->with('investmentSlot')->with('mitra')->get();
        return response()->json(['message' => 'Animal data', 'animals' => $animals]);
    }

    // Function to get the animal data by mitra
    public function indexMitra()
    {
        // Check if the user is a mitra
        $user = JWTAuth::user();
        $mitra = MitraModel::where('id_user', $user?->id_user)->first();
        if ($mitra == null) {
            return response()->json(['message' => 'Unauthorizedh'], 401);
        }

        // Get the animal data
        $animals = AnimalModel::where('id_mitra', $mitra->id_mitra)->with('subAnimalType.animalType')->with('investmentSlot')->get();
        return response()->json(['message' => 'Animal data', 'animals' => $animals]);
    }

    // Function to get the animal data by id
    public function details(int $id)
    {
        $animal = AnimalModel::where('id_animal', $id)->with('subAnimalType.animalType')->with('investmentSlot')->first();
        if ($animal == null) {
            return response()->json(['message' => 'Animal not found'], 404);
        }
        return response()->json(['message' => 'Animal data', 'animal' => $animal]);
    }

    // Function to Save Data Animal
    public function saveData(Request $request)
    {
        // Check if the user is a mitra
        $user = JWTAuth::user();
        $mitra = MitraModel::where('id_user', $user?->id_user)->first();
        if ($mitra == null) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Validate The Request
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255',
            'id_sub_animal_type' => 'required|numeric',
            'price' => 'required|numeric',
            'id_investment_type' => 'required|numeric',
            'total_slots' => 'required|numeric|min:1|max:10',
            'animal_images' => 'required|array',
            'animal_images.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Return Validation Error
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $nameImages = [];

        // Menangkap file
        if ($request->hasFile('animal_images')) {
            $files = $request->file('animal_images');
            foreach ($files as $index => $fileImage) {
                $fileName = "anml-$index" . now()->format('Ymd-His') . '.' . $fileImage->getClientOriginalExtension();
                // Resize the image and Upload Image
                $ImageManager = new ImageManager(new Driver());
                $ImageManager->read($fileImage)->scaleDown(400)->save('uploads/' . $fileName, 90);

                // Save the image name
                $nameImages[$index] = $fileName;
            }
        }

        // Create Code Animal
        $animal_code = Str::upper(Str::substr($user->username, 0, 3)) . "-" . time();

        try {
            // Start Transaction
            DB::beginTransaction();

            // Create The Animal
            $animal = AnimalModel::create([
                'id_mitra' => $mitra->id_mitra,
                'animal_code' => $animal_code,
                'description' => $request->description,
                'id_sub_animal_type' => $request->id_sub_animal_type,
                'price' => $request->price,
                'id_investment_type' => $request->id_investment_type,
                'total_slots' => $request->total_slots,
            ]);

            // Create Investment Slot
            $slot_price = $request->price / $request->total_slots;
            for ($i = 1; $i <= $request->total_slots; $i++) {
                $slot = new InvestmentSlotModel();
                $slot->id_animal = $animal->id_animal;
                $slot->slot_code = $animal_code . "-" . $i . time();
                $slot->slot_price = $slot_price;
                $slot->save();
            }

            // Save The Animal Images
            foreach ($nameImages as $nameImage) {
                AnimalImageModel::create([
                    'id_animal' => $animal->id_animal,
                    'image' => $nameImage,
                ]);
            }

            // Commit Transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback Transaction
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()]);
        }

        return response()->json(['message' => 'Animal data saved']);
    }
}
