<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AnimalModel;
use App\Models\InvestmentSlotModel;
use App\Models\MarketplaceDetailsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminFeatureController extends Controller
{
    // Mengkonfirmasi Pembayaran Slot Investasi
    public function confirmInvestmentSlot(Request $request)
    {
        // Memvalidasi request
        $validator = Validator::make($request->all(), [
            'id_investment_slot' => 'required|integer',
            'status' => 'required|string|in:success,failed',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        // Mengambil data investment slot
        $investmentSlot = InvestmentSlotModel::find($request->id_investment_slot);
        $investmentSlot->status = $request->status;
        if ($request->status == 'failed') {
            $investmentSlot->expired_at = date('Y-m-d H:i:s', strtotime('+1 day'));
        }
        $investmentSlot->save();

        // Mengembalikan response
        return response()->json(['message' => 'Investment Slot status updated', 'investment_slot' => $investmentSlot]);
    }


    // Mengkonfirmasi Pembelian Hewan yang Slot Investasinya sudah terisi
    public function confirmAnimal(Request $request)
    {
        // Memvalidasi request
        $validator = Validator::make($request->all(), [
            'id_animal' => 'required|integer',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        // Mengambil data Animal
        $animal = AnimalModel::find($request->id_animal);

        // Merubah Status yang awalnya open menjadi process dan mengisi tanggal pembelian
        $animal->status = 'process';
        $animal->purchase_date = date('Y-m-d H:i:s');
        $animal->start_date = date('Y-m-d H:i:s');
        $animal->end_date = date('Y-m-d H:i:s', strtotime('+1 year'));
        $animal->save();

        // Mengembalikan response
        return response()->json(['message' => 'Animal status updated', 'animal' => $animal]);
    }

    // Mengkonfirmasi Penjualan Hewan di Marketplace
    public function confirmMarketplace(Request $request)
    {
        // Memvalidasi request
        $validator = Validator::make($request->all(), [
            'id_marketplace_details' => 'required|integer',
            'status' => 'required|string|in:success,failed',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        // Mengambil data Marketplace Details
        $marketplaceDetails = MarketplaceDetailsModel::find($request->id_marketplace_details);
        $marketplaceDetails->status = $request->status;
        if ($request->status == 'failed') {
            $marketplaceDetails->expired_at = date('Y-m-d H:i:s', strtotime('+1 day'));
        } else {
            $marketplaceDetails->expired_at = null;
        }
        $marketplaceDetails->save();


        // Jika status Success Status di animal menjadi Distribution
        if ($request->status == 'success') {
            $animal = AnimalModel::find($marketplaceDetails->marketplaceAnimal->id_animal);
            $animal->status = 'distribution';
            $animal->selling_date = date('Y-m-d H:i:s');
            $animal->selling_price = $marketplaceDetails->marketplaceAnimal->price;
            $animal->save();
        }

        // Mengembalikan response
        return response()->json(['message' => 'Marketplace Details status updated', 'marketplace_details' => $marketplaceDetails]);
    }
}
