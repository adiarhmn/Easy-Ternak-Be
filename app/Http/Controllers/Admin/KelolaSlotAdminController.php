<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelolaSlotAdminController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'EasyTernak | Slot',
            'page' => 'Slot Investasi',
            // 'btnAdd' => 'Buka Slot',
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