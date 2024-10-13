<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnimalModel;
use App\Models\InvestmentSlotModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KelolaSlotAdminController extends Controller
{
    public function index()
    {
        $slots = AnimalModel::with(['subAnimalType', 'mitra', 'investmentSlot', 'animalImage'])
            ->get();
    
        // Initialize the slots as collections
        $fullSlots = collect();
        $availableSlots = collect();
    
        foreach($slots as $slot) {
            // Check if the slot is full
            if($slot->investmentSlot->where('status', 'success')->count() == $slot->total_slots) {
                $fullSlots->push($slot);
            } else {
                // For available slots, check for pending investors
                $hasPendingInvestor = $slot->investmentSlot->where('status', 'pending')->whereNotNull('id_investor')->isNotEmpty();
                $slot->hasPendingInvestor = $hasPendingInvestor; // Add a flag to the slot object
                $availableSlots->push($slot);
            }
        }
    
        $data = [
            'title' => 'EasyTernak | Slot',
            'page' => 'Slot Investasi',
            'availableSlots' => $availableSlots,
            'fullSlots' => $fullSlots,
            'urlAdd' => 'admin/slot/tambah',
        ];
    
        return view('pages.admin.kelola-slot.slot', $data);
    }
    
    public function detail(){

        $data = [
            'title' => 'EasyTernak | Slot',
            'page' => 'Slot',
            'topbar' => 'Detail',
        ];

        return view('pages.admin.kelola-slot.detail.detail', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'EasyTernak | Slot',
            'page' => 'Slot Investasi',
        ];
        return view('pages.admin.kelola-slot.tambah', $data);
    }

    public function investor($idAnimal)
    {
        // Mengambil data investasi berdasarkan id_animal
        $investmentSlots = InvestmentSlotModel::with('investor')
            ->where('id_animal', $idAnimal)
            ->whereNotNull('id_investor')
            ->get();
    
        // Menambahkan 1 hari pada kolom expired_at
        foreach ($investmentSlots as $investment) {
            if (!empty($investment->expired_at)) {
                // Konversi expired_at ke Carbon instance sebelum menambah hari
                $investment->expired_at = Carbon::parse($investment->expired_at)->addDay();
            }
        }
    
        $data = [
            'title' => 'EasyTernak | Slot',
            'page' => 'Slot',
            'topbar' => 'Investor',
            'investmentSlots' => $investmentSlots,
            'animal' => AnimalModel::find($idAnimal),
        ];
    
        return view('pages.admin.kelola-slot.detail.investor', $data);
    }
    
    
    public function approve($id)
    {
        $investment = InvestmentSlotModel::find($id);
        
        if ($investment) {
            $investment->status = 'success'; // Ubah status dari 'pending' menjadi 'success'
            $investment->save();
            return redirect()->back()->with('success', 'Investasi disetujui.');
        }

        return redirect()->back()->with('error', 'Investasi tidak ditemukan.');
    }

    // Metode untuk menolak investasi
    public function reject($id)
    {
        $investment = InvestmentSlotModel::find($id);
        
        if ($investment) {
            $investment->status = 'rejected'; // Ubah status sesuai logika Anda
            $investment->save();
            return redirect()->back()->with('success', 'Investasi ditolak.');
        }

        return redirect()->back()->with('error', 'Investasi tidak ditemukan.');
    }
    

}