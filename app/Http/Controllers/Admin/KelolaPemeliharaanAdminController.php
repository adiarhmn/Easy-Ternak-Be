<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelolaPemeliharaanAdminController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'EasyTernak | Pemeliharaan',
            'page' => 'Pemeliharaan',
            'topbar' => 'Pemeliharaan',
        ];
        return view('pages.admin.kelola-pemeliharaan.pemeliharaan', $data);
    }

    public function detail(){

        $data = [
            'title' => 'EasyTernak | Pemeliharaan',
            'page' => 'Pemeliharaan',
            'topbar' => 'Detail',
        ];

        return view('pages.admin.kelola-pemeliharaan.detail.detail', $data);
    }

    public function progres(){
        $data = [
            'title' => 'EasyTernak | Pemeliharaan',
            'page' => 'Pemeliharaan',
            'topbar' => 'Progres',
        ];

        return view('pages.admin.kelola-pemeliharaan.detail.progres', $data);
    }

    public function pengeluaran(){
        $data = [
            'title' => 'EasyTernak | Pemeliharaan',
            'page' => 'Pemeliharaan',
            'topbar' => 'Pengeluaran',
        ];

        return view('pages.admin.kelola-pemeliharaan.detail.pengeluaran', $data);
    }

    public function investor(){
        $data = [
            'title' => 'EasyTernak | Pemeliharaan',
            'page' => 'Pemeliharaan',
            'topbar' => 'Investor',
        ];

        return view('pages.admin.kelola-pemeliharaan.detail.investor', $data);
    }

}
