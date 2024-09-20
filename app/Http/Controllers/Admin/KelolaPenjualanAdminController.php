<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelolaPenjualanAdminController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'EasyTernak | Penjualan',
            'page' => 'Penjualan',
        ];
        return view('pages.admin.kelola-penjualan.penjualan', $data);
    }

    public function detail(){

        $data = [
            'title' => 'EasyTernak | Detail',
            'page' => 'Penjualan',
            'topbar' => 'Detail',
        ];

        return view('pages.admin.kelola-penjualan.detail.detail', $data);
    }
    public function profit(){

        $data = [
            'title' => 'EasyTernak | Keuangan',
            'page' => 'Penjualan',
            'topbar' => 'Keuangan',
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

    public function progres(){
        $data = [
            'title' => 'EasyTernak | Progres',
            'page' => 'Penjualan',
            'topbar' => 'Progres',
        ];

        return view('pages.admin.kelola-penjualan.detail.progres', $data);
    }

    public function investor(){
        $data = [
            'title' => 'EasyTernak | Investor',
            'page' => 'Penjualan',
            'topbar' => 'Investor',
        ];

        return view('pages.admin.kelola-penjualan.detail.investor', $data);
    }
}
