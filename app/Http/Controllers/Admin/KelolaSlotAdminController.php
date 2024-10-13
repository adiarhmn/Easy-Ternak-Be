<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnimalModel;
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
    
        foreach($slots as $slot){
            if($slot->investmentSlot->where('status', 'success')->count() == $slot->total_slots){
                $fullSlots->push($slot);
            } else {
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

    public function investor(){
        $data = [
            'title' => 'EasyTernak | Slot',
            'page' => 'Slot',
            'topbar' => 'Investor',
        ];

        return view('pages.admin.kelola-slot.detail.investor', $data);
    }

}