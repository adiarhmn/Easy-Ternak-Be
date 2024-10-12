<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AnimalModel;
use App\Models\MarketplaceAnimalModel;
use App\Models\MarketplaceDetailsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Tymon\JWTAuth\Facades\JWTAuth;

class MarketplaceController extends Controller
{
    public function index()
    {
        $animals = MarketplaceAnimalModel::where('status', 'ready')
            ->with(['animal.animalImage', 'animal.subAnimalType.animalType', 'mitra'])
            ->get();
        if ($animals == null) {
            return response()->json(['message' => 'No data found'], 404);
        }
        return response()->json(['message' => 'Marketplace data animals', 'marketplace_animals' => $animals]);
    }

    // Details Animal From Marketplace
    public function details($id)
    {
        $animal = MarketplaceAnimalModel::where('id_marketplace_animal', $id)
            ->with(['animal.animalImage', 'animal.subAnimalType.animalType', 'mitra', 'marketplaceDetails'])
            ->first();
        if ($animal == null) {
            return response()->json(['message' => 'Animal not found'], 404);
        }
        return response()->json(['message' => 'Animal data Detail', 'animal' => $animal]);
    }

    public function getDetailsByAnimal($id)
    {
        $animal = AnimalModel::where('id_animal', $id)
            ->with(['mitra.user', 'subAnimalType.animalType', 'animalImage', 'investmentSlot.investor.investmentSlot', 'investmentSlot.transferProof', 'animalProgress.ProgressImage', 'animalExpenses', 'marketplaceAnimal'])
            ->withSum('animalExpenses as total_expenses', 'price')
            ->first();


        if ($animal == null) {
            return response()->json(['message' => 'Animal not found'], 404);
        }

        return response()->json(['message' => 'Animal data Detail', 'animal' => $animal]);
    }

    // Make Checkout Animal
    public function makeCheckoutAnimal(Request $request)
    {
        // Get Authenticated User
        $user = JWTAuth::user();
        if ($user == null) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Validate Request
        $validator = Validator::make($request->all(), [
            'id_marketplace_animal' => 'required|integer',
        ]);

        // Return Validation Error
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            // Find Marketplace Animal
            $marketplaceAnimal = MarketplaceAnimalModel::where('id_marketplace_animal', $request->id_marketplace_animal)
                ->where('status', 'ready')
                ->first();
            $marketplaceAnimal->status = 'sold';
            $marketplaceAnimal->save();

            // Create Marketplace Details
            $marketplaceDetails = new MarketplaceDetailsModel();
            $marketplaceDetails->id_marketplace_animal = $request->id_marketplace_animal;
            $marketplaceDetails->id_user = $user->id_user;
            $marketplaceDetails->status = 'pending';
            $marketplaceDetails->expired_at = date('Y-m-d H:i:s', strtotime('+1 day'));

            // Save Marketplace Details
            if ($marketplaceDetails->save()) {
                DB::commit();
                return response()->json(['message' => 'Checkout success', 'marketplace_details' => $marketplaceDetails]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Checkout failed'], 500);
        }

        // Return Failed
        return response()->json(['message' => 'Checkout failed'], 500);
    }

    public function confirmCheckoutAnimal(Request $request)
    {
        // Get Authenticated User
        $user = JWTAuth::user();
        if ($user == null) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Validate Request
        $validator = Validator::make($request->all(), [
            'id_marketplace_details' => 'required|integer',
            'proof_image' => 'required|image',
            'id_payment_method' => 'required|integer',
        ]);

        // Return Validation Error
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Find Marketplace Details
        $marketplaceDetails = MarketplaceDetailsModel::where('id_marketplace_details', $request->id_marketplace_details)
            ->where('id_user', $user->id_user)
            ->where('status', 'pending')
            ->first();

        // Check if Marketplace Details is not found
        if ($marketplaceDetails == null) {
            return response()->json(['message' => 'Marketplace Details not found', 'data_request' => $request->all(), 'user' => $user], 404);
        }

        // Upload Proof Image
        if ($request->hasFile('proof_image')) {
            $proofImage = $request->file('proof_image');
            $fileName = "prf-img" . now()->format('Ymd-His') . '.' . $proofImage->getClientOriginalExtension();

            // Resize the image and Upload Image
            $ImageManager = new ImageManager(new Driver());
            $ImageManager->read($proofImage)->scaleDown(400)->save('uploads/' . $fileName, 90);
            $nameImages = $fileName;
        }

        // Update Marketplace Details
        $marketplaceDetails->proof_image = $nameImages ?? null;
        $marketplaceDetails->id_payment_method = $request->id_payment_method;

        // Save Marketplace Details
        if ($marketplaceDetails->save()) {
            return response()->json(['message' => 'Checkout success', 'marketplace_details' => $marketplaceDetails]);
        }

        // Return Failed
        return response()->json(['message' => 'Checkout failed'], 500);
    }
}
