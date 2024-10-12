<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AnimalModel;
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

        // Check Investment Slot If Pending and Expired
        InvestmentSlotModel::where('id_investor', $user->investor->id_investor)
            ->where('status', 'pending')
            ->where('expired_at', '<', now())
            ->update([
                'status' => 'ready',
                'id_investor' => null,
            ]);

        // Get Investment Slot 
        $investmentSlots = InvestmentSlotModel::where('id_investor', $user->investor->id_investor)
            ->with('animal.subAnimalType.animalType')
            ->with('animal.mitra')
            ->with('animal.investmentType')
            ->with('animal.animalImage')
            ->orderBy('id_investment_slot', 'desc')
            ->get()
            ->groupBy('animal.id_animal');

        // Mengubah hasil menjadi array yang lebih mudah dibaca
        $groupedInvestmentSlots = $investmentSlots->map(function ($slots, $animalId) {
            return [
                'animal_id' => $animalId,
                'animal' => $slots->first()->animal,
                'investment_slots' => $slots,
            ];
        })->values()->toArray(); // Mengonversi koleksi menjadi array

        // Return Investment Slot
        return response()->json(['message' => 'Investment slot data', 'investmentSlots' => $groupedInvestmentSlots]);
    }

    public function details(Request $request, $id)
    {
        // Get the authenticated user
        $user = JWTAuth::user();
        if ($user == null) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Get query parameter
        if ($request->id_investor && $request->id_animal) {
            // Get the investment slot
            $investmentSlot = InvestmentSlotModel::where('id_investor', $request->id_investor)
                ->where('id_animal', $request->id_animal)
                ->with('animal.subAnimalType.animalType')
                ->first();

            if ($investmentSlot == null) {
                return response()->json(['message' => 'Investment slot not found'], 404);
            }

            return response()->json(['message' => 'Investment slot data', 'investmentSlot' => $investmentSlot->toArray()]);
        }


        // Get the investment slot
        $investmentSlot = InvestmentSlotModel::where('id_investment_slot', $id)
            ->with('animal.subAnimalType.animalType')
            ->first();

        if ($investmentSlot == null) {
            return response()->json(['message' => 'Investment slot not found'], 404);
        }

        return response()->json(['message' => 'Investment slot data', 'investmentSlot' => $investmentSlot->toArray()]);
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
            'id_payment_method' => 'required|numeric',
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
            $investmentSlot->status = 'waiting';
            $investmentSlot->id_payment_method = $request->id_payment_method;
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

    public function confirmCheckout(Request $request)
    {
        // Get the authenticated user
        $user = JWTAuth::user();
        if ($user == null || $user->level != 'mitra') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Validate The Request
        $validator = Validator::make($request->all(), [
            'id_investment_slot' => 'required|numeric',
            'status' => 'required|in:success,failed',
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
        } elseif ($investmentSlot->status != 'waiting') {
            return response()->json(['message' => 'Investment slot already checked out'], 422);
        }

        // Update the investment slot
        $investmentSlot->status = $request->status;
        $investmentSlot->save();

        return response()->json(['message' => 'Checkout success']);
    }

    // Bagi Hasil
    public function makeProfitDistribution(Request $request)
    {
        // Get the authenticated user
        $user = JWTAuth::user();
        if ($user == null || $user->level != 'mitra') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Validate The Request
        $validator = Validator::make($request->all(), [
            'id_investor' => 'required|numeric',
            'id_animal' => 'required|numeric',
            'proof_images' => 'required|array',
            'proof_images.*' => 'image|mimes:jpg,png,jpeg|max:2048',
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

            // Count Profit
            $Animal = AnimalModel::where('id_animal', $request->id_animal)
                ->withSum('animalExpenses as total_expenses', 'price')
                ->first();

            // Count Gross Profit
            $grossProfit = $Animal->selling_price - $Animal->purchase_price;

            // Tax 5%
            $tax = $grossProfit * 0.05;
            if ($tax < 0) {
                $tax = 0;
            }

            $profit = $grossProfit - $tax - $Animal->total_expenses;

            // Investor 50%
            $investorProfits = $profit * 0.5;

            // Share the profit to investors
            $investorProfit = $investorProfits / $Animal->total_slots;

            // Get the investment slot
            $investmentSlot = InvestmentSlotModel::where('id_investor', $request->id_investor)
                ->where('id_animal', $request->id_animal)
                ->where('status', 'success')
                ->get();

            // Check if the total slot is enough
            if ($investmentSlot == null) {
                return response()->json(['message' => 'Investment slot not found'], 404);
            }

            // Process Upload the image File
            $proofImages = [];
            foreach ($request->proof_images as $fileImage) {
                $fileName = "profit-" . $user?->id_user . now()->format('Ymd-His') . '.' . $fileImage->getClientOriginalExtension();
                // Resize the image and Upload Image
                $ImageManager = new ImageManager(new Driver());
                $ImageManager->read($fileImage)->scaleDown(400)->save('uploads/' . $fileName, 90);
                $proofImages[] = $fileName;
            }

            // Save the transfer proof
            foreach ($proofImages as $proofImage) {
                $transferProof = new TransferProofsModel();
                $transferProof->id_investment_slot = $investmentSlot[0]->id_investment_slot;
                $transferProof->proof_image = $proofImage;
                $transferProof->save();
            }

            // Update the investment slot
            foreach ($investmentSlot as $slot) {
                $slot->profit = $investorProfit;
                $slot->distribution_status = 'waiting';
                $slot->save();
            }

            // Commit the transaction
            DB::commit();
            return response()->json(['message' => 'Profit distribution success']);
        } catch (\Exception $e) {

            // Rollback the transaction
            DB::rollBack();
            return response()->json(['message' => 'Profit distribution failed'], 500);
        }
    }

    public function confirmProfitDistribution(Request $request) {}
}
