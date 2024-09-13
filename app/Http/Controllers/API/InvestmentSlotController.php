<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\InvestmentSlotModel;
use App\Models\TransferProofsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Tymon\JWTAuth\Facades\JWTAuth;

class InvestmentSlotController extends Controller
{
    public function index()
    {
        // I
    }

    public function checkout(Request $request)
    {
        // Get the authenticated user
        $user = JWTAuth::user();
        if ($user == null || $user->level != 'investor') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Validate The Request
        $validator = Validator::make($request->all(), [
            'id_investment_slot' => 'required|numeric',
            'image_proof' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Return Validation Error
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Get the investment slot
        $investmentSlot = InvestmentSlotModel::where('id_investment_slot', $request->id_investment_slot)->first();
        if ($investmentSlot == null) {
            return response()->json(['message' => 'Investment slot not found'], 404);
        }elseif($investmentSlot->status != 'ready'){
            return response()->json(['message' => 'Investment slot already checked out'], 422);
        }

        // Save the image proof
        $imageProof = $request->file('image_proof');
        $fileName = "TF-" . $user?->id_user . time() . '.' . $imageProof->getClientOriginalExtension();
        // Resize the image and Upload Image
        $ImageManager = new ImageManager(new Driver());
        $ImageManager->read($imageProof)->scaleDown(400)->save('uploads/' . $fileName, 90);

        // Update the investment slot
        $investmentSlot->status = 'pending';
        $investmentSlot->save();
        
        TransferProofsModel::create([
            'id_investment_slot' => $investmentSlot->id_investment_slot,
            'proof_image' => $fileName,
        ]);

        return response()->json(['message' => 'Checkout success']);
    }
}
