<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnimalExpensesModel;
use App\Models\AnimalModel;
use App\Models\AnimalProgressModel;
use App\Models\InvestmentSlotModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KelolaPenjualanAdminController extends Controller
{
    public function index()
    {
        $animals = AnimalModel::where('status', 'distribution')->get();
        $data = [
            'title' => 'EasyTernak | Penjualan',
            'page' => 'Penjualan',
            'animals' => $animals,
        ];
        return view('pages.admin.kelola-penjualan.penjualan', $data);
    } 

    public function detail($idAnimal){

        // Mengambil data animal beserta relasinya menggunakan eager loading
        $animal = AnimalModel::with(['subAnimalType', 'investmentType', 'mitra', 'animalImage', 'investmentSlot'])
        ->find($idAnimal);
        
        if (!$animal) {
            return redirect('admin/penjualan')->with('error', 'Data tidak ditemukan.');
        }
        
        $data = [
            'title' => 'EasyTernak | Detail',
            'page' => 'Penjualan',
            'topbar' => 'Detail',
            'animal' => $animal, // Mengirim data animal ke view
            'idAnimal' => $idAnimal, // Menambahkan animal jika perlu
        ];

        return view('pages.admin.kelola-penjualan.detail.detail', $data);
    }
    public function profit($idAnimal){
        $data = [
            'title' => 'EasyTernak | Keuangan',
            'page' => 'Penjualan',
            'topbar' => 'Keuangan',
            'idAnimal' => $idAnimal,
        ];

        return view('pages.admin.kelola-penjualan.detail.profit', $data);
    }

    public function transfer(){
        $data = [
            'title' => 'EasyTernak | Transfer',
            'page' => 'Penjualan',
            'topbar' => 'Transfer',
        ];

        return view('pages.admin.kelola-penjualan.detail.transfer', $data);
    }


    public function progres($animal_id, Request $request){
        // Set default date range (10 days range)
    $today = Carbon::now()->toDateString();
    $tenDaysAgo = Carbon::now()->subDays(10)->toDateString();

    // Get filtered data based on request date range
    $startDate = request('start_date', $tenDaysAgo);  // Use default if not provided
    $endDate = request('end_date', $today);          // Use default if not provided

    // Fetch progress data based on the date range
    $progress = AnimalProgressModel::where('id_animal', $animal_id)
        ->whereBetween('date', [$startDate, $endDate])
        ->get();
        $data = [
            'title' => 'EasyTernak | Histori Progress Penjualan',
            'page' => 'Penjualan',
            'topbar' => 'Progres',
            'progress' => $progress,
            'startDate' => $startDate,
            'endDate' => $endDate,
            "idAnimal" => $animal_id
        ];

        return view('pages.admin.kelola-penjualan.detail.progres', $data);
    }

    public function pengeluaran($idAnimal, Request $request)
    {
        // Set default date range (10 days range)
        $today = Carbon::now()->toDateString();
        $tenDaysAgo = Carbon::now()->subDays(10)->toDateString();
    
        // Get filtered data based on request date range
        $startDate = $request->input('tanggal_awal', $tenDaysAgo); // Use default if not provided
        $endDate = $request->input('tanggal_akhir', $today);       // Use default if not provided
    
        // Fetch expense data based on the date range
        $expenses = AnimalExpensesModel::where('id_animal', $idAnimal)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();
    
        $data = [
            'title' => 'EasyTernak | Pengeluaran',
            'page' => 'Pengeluaran',
            'topbar' => 'Pengeluaran',
            'idAnimal' => $idAnimal,
            'expenses' => $expenses,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ];
    
        return view('pages.admin.kelola-penjualan.detail.pengeluaran', $data);
    }

    public function investor($idAnimal)
    {
        // Mengambil data investasi berdasarkan id_animal beserta bukti pembayaran
        $investmentSlots = InvestmentSlotModel::with(['investor', 'transferProof']) // Mengambil bukti pembayaran dari relasi transfer proofs
        ->where('id_animal', $idAnimal)
            ->whereNotNull('id_investor')
            ->get();
    
        // Menambahkan expired_at dengan tambahan satu hari
        foreach ($investmentSlots as $investment) {
            if (!empty($investment->expired_at)) {
                $investment->expired_at = Carbon::parse($investment->expired_at)->addDay();
            }
        }
    
        $data = [
            'title' => 'EasyTernak | Slot',
            'page' => 'Penjualan',
            'topbar' => 'Investor',
            'investmentSlots' => $investmentSlots,
            'animal' => AnimalModel::find($idAnimal), // Menambahkan animal jika perlu
            'idAnimal' => $idAnimal, // Menambahkan animal jika perlu
        ];
    
        return view('pages.admin.kelola-penjualan.detail.investor', $data);
    }
}