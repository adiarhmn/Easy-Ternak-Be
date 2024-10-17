<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnimalModel;
use App\Models\AnimalExpensesModel;
use Illuminate\Support\Facades\DB;

class BerandaAdminController extends Controller
{
    public function index()
    {
        // Menghitung total slot
        $totalSlot = AnimalModel::count();

        // Menghitung slot tersedia (dengan status open atau close)
        $slotTersedia = AnimalModel::where('status', 'open')
            ->orWhere('status', 'close')
            ->count();

        // Menghitung slot pemeliharaan (dengan status process)
        $slotPemeliharaan = AnimalModel::where('status', 'process')->count();

        // Menghitung slot terjual (dengan status distribution)
        $slotTerjual = AnimalModel::where('status', 'distribution')->count();

        // Menghitung total profit
        $profit = AnimalModel::where('status', operator: 'distribution')
            ->select(DB::raw('SUM(selling_price - purchase_price) as profit'))
            ->first()->profit;

        // Menghitung total pengeluaran dari tabel animal_expenses
        $pengeluaran = AnimalExpensesModel::sum('price');

        // Mengurangi profit dengan total pengeluaran
        $totalProfit = $profit;

        $data = [
            'title' => 'EasyTernak | Beranda',
            'page' => 'Beranda',
            'deskripsi' => 'Selamat Datang Admin EasyTernak',
            'totalSlot' => $totalSlot,
            'slotTersedia' => $slotTersedia,
            'slotPemeliharaan' => $slotPemeliharaan,
            'slotTerjual' => $slotTerjual,
            'totalProfit' => $totalProfit
        ];

        return view('pages.admin.beranda', $data);
    }
}