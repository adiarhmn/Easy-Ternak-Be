<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class MainAuthController extends Controller
{
    public function postLogin(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek autentikasi pengguna dengan level admin
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password'], 'level' => 'admin'])) {
            // Jika berhasil, arahkan ke dashboard admin
            return redirect()->intended('admin/beranda');
        }

        // Jika gagal, kembalikan dengan error
        return back()->withErrors([
            'login_error' => 'Username atau password salah!',
        ])->withInput($request->only('username'));
    }

    public function logout(Request $request)
{
    Auth::logout(); // Mengeluarkan pengguna dari sesi

    $request->session()->invalidate(); // Menghapus semua data sesi

    $request->session()->regenerateToken(); // Menghasilkan ulang token CSRF

    return redirect('/login')->with('message', 'Anda telah berhasil logout.'); // Mengarahkan pengguna kembali ke halaman login
}
}