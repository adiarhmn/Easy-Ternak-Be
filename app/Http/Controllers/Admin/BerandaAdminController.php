<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BerandaAdminController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'EasyTernak | Beranda',
            'page' => 'Beranda',
            'deskripsi' => 'Selamat Datang Admin EasyTernak',
        ];
        return view('pages.admin.beranda', $data);
    }
}
