<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\InvestmentSlotModel;
use App\Models\InvestorModel;
use App\Models\TransferProofsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Tymon\JWTAuth\Facades\JWTAuth;

class InvestmentSlotController extends Controller
{
    public function index()
    {
        // Get User
        $user = JWTAuth::user();
        if ($user == null || $user->level != 'investor') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Get Investment Slot 
        $investmentSlots = InvestmentSlotModel::where('id_investor', $user->investor->id_investor)
            ->with('animal.subAnimalType.animalType')
            ->with('animal.mitra')
            ->get();

        foreach ($investmentSlots as $slot) {
            if ($slot->status == 'pending' && $slot->expired_at < now()) {
                $slot->status = 'ready';
                $slot->id_investor = null;
                $slot->save();
            }
        }

        // Return Investment Slot
        return response()->json(['message' => 'Investment slot data', 'investmentSlots' => $investmentSlots]);
    }

    public function details($id)
    {
        // Get the investment slot
        $investmentSlot = InvestmentSlotModel::where('id_investment_slot', $id)->with('animal.subAnimalType.animalType')->first();
        if ($investmentSlot == null) {
            return response()->json(['message' => 'Investment slot not found'], 404);
        }

        return response()->json(['message' => 'Investment slot data', 'investmentSlot' => $investmentSlot]);
    }

    // Function to Manual checkout investment slot by investor
    public function manualCheckout(Request $request)
    {
        // Get the authenticated user
        $user = JWTAuth::user();
        $Investor = InvestorModel::where('id_user', $user->id_user)->first();
        if ($user == null || $user->level != 'investor' || $Investor == null) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Validate The Request
        $validator = Validator::make($request->all(), [
            'id_investment_slot' => 'required|numeric',
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
        } elseif ($investmentSlot->status != 'ready') {
            return response()->json(['message' => 'Investment slot already checked out'], 422);
        }

        // Update the investment slot
        $investmentSlot->id_investor = $Investor->id_investor;
        $investmentSlot->status = 'pending';
        $investmentSlot->expired_at = date('Y-m-d H:i:s', strtotime('+1 day'));
        $investmentSlot->save();
        return response()->json(['message' => 'Checkout success']);
    }

    public function proofCheckout(Request $request)
    {
        // Get the authenticated user
        $user = JWTAuth::user();
        $Investor = InvestorModel::where('id_user', $user->id_user)->first();
        if ($user == null || $user->level != 'investor' || $Investor == null) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Validate The Request
        $validator = Validator::make($request->all(), [
            'id_investment_slot' => 'required|numeric',
            'proof_image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
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
            // Get the investment slot
            $investmentSlot = InvestmentSlotModel::where('id_investment_slot', $request->id_investment_slot)->first();
            if ($investmentSlot == null) {
                return response()->json(['message' => 'Investment slot not found'], 404);
            } elseif ($investmentSlot->status != 'pending') {
                return response()->json(['message' => 'Investment slot already checked out'], 422);
            }

            // Process Upload the image File
            $fileImage = $request->file('proof_image');
            if ($fileImage != null) {
                $fileName = "proof-" . $user?->id_user . now()->format('Ymd-His') . '.' . $fileImage->getClientOriginalExtension();
                // Resize the image and Upload Image
                $ImageManager = new ImageManager(new Driver());
                $ImageManager->read($fileImage)->scaleDown(400)->save('uploads/' . $fileName, 90);
            }

            // Save the transfer proof
            $transferProof = new TransferProofsModel();
            $transferProof->id_investment_slot = $investmentSlot->id_investment_slot;
            $transferProof->proof_image = $fileName;
            $transferProof->save();

            // Update the investment slot
            $investmentSlot->status = 'success'; // DIRUBAH NANTI JADI PENDING ======= KARENA HARUS DI CEK DULU OLLEH ADMIN
            $investmentSlot->save();

            // Commit the transaction
            DB::commit();
            return response()->json(['message' => 'Checkout success']);
        } catch (\Exception $e) {

            // Rollback the transaction
            DB::rollBack();
            return response()->json(['message' => 'Checkout failed'], 500);
        }
    }
}
