<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AnimalModel;
use App\Models\InvestorProfitModel;
use App\Models\MitraProfitModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class AdminController extends Controller
{
    public function animalDistribution(Request $request)
    {
        if ($request->id_animal != null) {
            $data = AnimalModel::where('id_animal', $request->id_animal)
                ->where('status', 'distribution')
                ->with(['subAnimalType.animalType', 'investmentSlot.investor', 'mitra', 'animalExpenses', 'mitraProfit', 'investmentSlot.investor', 'investmentSlot.investor.investmentSlot', 'investmentSlot.investorProfit'])
                ->withSum('animalExpenses as total_expenses', 'price')
                ->first();
            if ($data == null) {
                return response()->json(['message' => 'No data found'], 404);
            }

            $data->investmentSlot = $data->investmentSlot->groupBy('id_investor')->map(function ($slots, $investorId) {
                return [
                    'investor_id' => $investorId,
                    'investor' => $slots->first()->investor,
                    'investment_slots' => $slots,
                ];
            })->values();

            $data->gross_profit = $data->selling_price - $data->purchase_price;
            $data->tax = $data->gross_profit * 0.05;
            $data->net_profit = $data->gross_profit - $data->tax;
            $data->mitra_profit_total = $data->net_profit * 0.5;
            $data->investor_profit_total = ($data->net_profit * 0.5) / 2;
            return response()->json(['message' => 'Animal data distribution detail', 'animal' => $data]);
        }

        $data = AnimalModel::where('status', 'distribution')
            ->with(['subAnimalType.animalType', 'investmentSlot', 'mitra', 'animalExpenses', 'mitraProfit', 'investmentSlot.investor', 'investmentSlot.investor.investmentSlot', 'investmentSlot.investorProfit'])
            ->withSum('animalExpenses as total_expenses', 'price')
            ->get();

        return response()->json(['message' => 'Animal data distribution', 'animals' => $data]);
    }

    public function shareProfitMitra(Request $request)
    {
        // Validate request
        $valdiator = Validator::make($request->all(), [
            'id_animal' => 'required|integer',
            'id_mitra' => 'required|integer',
            'profit' => 'required|numeric',
            'proof_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($valdiator->fails()) {
            return response()->json(['message' => $valdiator->errors()], 400);
        }

        // Store Image
        $fileImage = $request->file('proof_image');
        if ($fileImage != null) {
            $fileName = "proof-" . $request->id_mitra . now()->format('Ymd-His') . '.' . $fileImage->getClientOriginalExtension();
            // Resize the image and Upload Image
            $ImageManager = new ImageManager(new Driver());
            $ImageManager->read($fileImage)->scaleDown(400)->save('uploads/' . $fileName, 90);
        }

        $mitraProfit = MitraProfitModel::create([
            'id_animal' => $request->id_animal,
            'id_mitra' => $request->id_mitra,
            'profit' => $request->profit,
            'proof_image' => $fileName,
            'status' => 'pending'
        ]);

        return response()->json(['message' => 'Profit shared', 'profit' => $mitraProfit]);
    }

    public function shareProfitInvestor(Request $request)
    {
        // Validate Request
        $validator = Validator::make($request->all(), [
            'id_investment_slot' => 'required|integer',
            'id_investor' => 'required|integer',
            'profit' => 'required|numeric',
            'proof_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        // Store Image
        $fileImage = $request->file('proof_image');
        if ($fileImage != null) {
            $fileName = "proof-" . $request->id_investor . now()->format('Ymd-His') . '.' . $fileImage->getClientOriginalExtension();
            // Resize the image and Upload Image
            $ImageManager = new ImageManager(new Driver());
            $ImageManager->read($fileImage)->scaleDown(400)->save('uploads/' . $fileName, 90);
        }

        $investorProfit = InvestorProfitModel::create([
            'id_investment_slot' => $request->id_investment_slot,
            'id_investor' => $request->id_investor,
            'profit' => $request->profit,
            'proof_image' => $fileName,
            'status' => 'pending'
        ]);

        return response()->json(['message' => 'Profit shared', 'profit' => $investorProfit]);
    }
}
