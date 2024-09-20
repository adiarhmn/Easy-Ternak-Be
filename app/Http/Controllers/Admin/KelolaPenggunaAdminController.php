<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Models\InvestorModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\MitraModel;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Support\Facades\Storage;

class KelolaPenggunaAdminController extends Controller
{
    public function index()
    {
        $dataMitra = DB::table('mitra')->get();

        $data = [
            'title' => 'EasyTernak | Pengguna',
            'page' => 'Pengguna',
            'topbar' => 'Mitra',
            'btnAdd' => 'Tambah',
            'urlAdd' => 'admin/pengguna/mitra/tambah',
        ];

        return view('pages.admin.kelola-pengguna.pengguna', $data, compact('dataMitra'));
    }

    public function investor()
    {

        $investor = InvestorModel::all();

        $data = [
            'title' => 'EasyTernak | Investor',
            'page' => 'Pengguna',
            'topbar' => 'Investor',
        ];

        return view('pages.admin.kelola-pengguna.investor', $data, compact('investor'));
    }


    public function profilMitra($id)
    {
        // Mengambil data mitra dan menghubungkannya dengan tabel 'user'
        $mitra = DB::table('mitra')
            ->join('user', 'mitra.id_user', '=', 'user.id_user')
            ->where('mitra.id_mitra', $id)
            ->first();

        // Cek apakah data mitra ditemukan
        if (!$mitra) {
            return redirect()->back()->with('error', 'Mitra tidak ditemukan');
        }

        // Cek apakah file KTP ada di direktori 'public/ktp_images'
        $ktpPath = 'ktp_images/' . $mitra->ktp;
        if (!$mitra->ktp || !file_exists(public_path($ktpPath))) {
            // Jika KTP tidak ada atau file KTP tidak ditemukan, gunakan gambar KTP default
            $ktpImage = 'ktp_images/default-ktp.jpg';
        } else {
            $ktpImage = $ktpPath;
        }

        // Data yang akan dikirim ke view
        $data = [
            'title' => 'EasyTernak | Profil Mitra',
            'page' => 'Pengguna',
            'topbar' => 'Profil Mitra',
            'ktpImage' => $ktpImage,
            'mitra' => $mitra
        ];

        return view('pages.admin.kelola-pengguna.profil-mitra', $data);
    }

    public function updateMitra(Request $request, $id)
    {
        // Temukan mitra
        $mitra = MitraModel::find($id);
        if (!$mitra) {
            return redirect()->back()->withErrors(['msg' => 'Mitra tidak ditemukan']);
        }

        // Temukan user terkait
        $user = UserModel::where('id_user', $mitra->id_user)->first();
        if (!$user) {
            return redirect()->back()->withErrors(['msg' => 'User tidak ditemukan']);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:user,email',
            'no_hp' => 'required|string|max:20',
            'bank' => 'nullable|string|max:255',
            'akun_bank' => 'nullable|string|max:255',
            'no_rek' => 'nullable|string|max:255',
            'ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'email.unique' => 'Email sudah digunakan.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.string' => 'Nomor HP harus berupa teks.',
            'no_hp.max' => 'Nomor HP maksimal 20 karakter.',
            'bank.string' => 'Bank harus berupa teks.',
            'bank.max' => 'Bank maksimal 255 karakter.',
            'akun_bank.string' => 'Akun bank harus berupa teks.',
            'akun_bank.max' => 'Akun bank maksimal 255 karakter.',
            'no_rek.string' => 'Nomor rekening harus berupa teks.',
            'no_rek.max' => 'Nomor rekening maksimal 255 karakter.',
            'ktp.image' => 'KTP harus berupa gambar.',
            'ktp.mimes' => 'KTP harus berformat jpeg, png, atau jpg.',
            'ktp.max' => 'Ukuran KTP maksimal 2MB.',
        ]);


        // Temukan mitra
        // Update data mitra
        $mitra->update([
            'name' => $request->input('nama'),
            'address' => $request->input('alamat'),
            'telephone' => $request->input('no_hp'),
            'payment_name' => $request->input('bank'),
            'payment_account' => $request->input('akun_bank'),
            'payment_number' => $request->input('no_rek'),
            // Update KTP jika ada file
            'ktp' => $request->hasFile('ktp') ? $this->uploadKTP($request->file('ktp')) : $mitra->ktp,
        ]);

        // Update data user
        $user->update([
            'email' => $request->input('email'),
        ]);


        return redirect()->to('admin/pengguna/mitra/profil/' . $id)->with('success', 'Data berhasil diperbarui');
    }

    private function uploadKTP($file)
    {
        $filename = time();
        $file->move(public_path('ktp_images'), $filename);
        return $filename;
    }



    public function profilInvestor($id)
    {
        // Mengambil data investor dan menghubungkannya dengan tabel 'user' menggunakan id_user
        $investor = InvestorModel::join('user', 'investor.id_user', '=', 'user.id_user')
            ->where('investor.id_investor', $id)
            ->first();



        // Cek apakah data investor ditemukan
        if (!$investor) {
            return redirect()->back()->with('error', 'Investor tidak ditemukan');
        }

        // Cek apakah file KTP ada di direktori 'public/ktp_images'
        $ktpPath = 'ktp_images/' . $investor->ktp;
        if (!$investor->ktp || !file_exists(public_path($ktpPath))) {
            // Jika KTP tidak ada atau file KTP tidak ditemukan, gunakan gambar KTP default
            $ktpImage = 'default-ktp.jpg';
        } else {
            $ktpImage = $ktpPath;
        }

        // Data yang akan dikirim ke view
        $data = [
            'title' => 'EasyTernak | Profil Investor',
            'page' => 'Pengguna',
            'topbar' => 'Profil Investor',
            'ktpImage' => $ktpImage,
            'investor' => $investor
        ];

        return view('pages.admin.kelola-pengguna.profil-investor', $data);
    }


    public function tambahMitra()
    {

        $data = [
            'title' => 'EasyTernak | Tambah Mitra',
            'page' => 'Pengguna',
            'topbar' => 'Mitra',
        ];

        return view('pages.admin.kelola-pengguna.tambah-mitra', $data);
    }

    public function simpanMitra(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:user,username',
            'telephone' => 'required|string|max:15',
            'address' => 'required|string',
            'ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'payment_name' => 'required|string|max:255',
            'payment_account' => 'required|string|max:255',
            'payment_number' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|string|min:8',
        ],[
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username maksimal 255 karakter.',
            'username.unique' => 'Username sudah digunakan.',
            'telephone.required' => 'Nomor telepon wajib diisi.',
            'telephone.string' => 'Nomor telepon harus berupa teks.',
            'telephone.max' => 'Nomor telepon maksimal 15 karakter.',
            'address.required' => 'Alamat wajib diisi.',
            'address.string' => 'Alamat harus berupa teks.',
            'ktp.image' => 'KTP harus berupa gambar.',
            'ktp.mimes' => 'KTP harus berformat jpeg, png, atau jpg.',
            'ktp.max' => 'Ukuran KTP maksimal 2MB.',
            'payment_name.required' => 'Nama pembayaran wajib diisi.',
            'payment_name.string' => 'Nama pembayaran harus berupa teks.',
            'payment_name.max' => 'Nama pembayaran maksimal 255 karakter.',
            'payment_account.required' => 'Akun pembayaran wajib diisi.',
            'payment_account.string' => 'Akun pembayaran harus berupa teks.',
            'payment_account.max' => 'Akun pembayaran maksimal 255 karakter.',
            'payment_number.required' => 'Nomor pembayaran wajib diisi.',
            'payment_number.string' => 'Nomor pembayaran harus berupa teks.',
            'payment_number.max' => 'Nomor pembayaran maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password harus memiliki minimal 8 karakter.',
        ]);


        $data = [];

        // Proses upload file KTP jika ada
        if ($request->hasFile('ktp')) {
            $file = $request->file('ktp');

            // Simpan file KTP ke folder 'public/ktp_images' dengan nama random
            if ($file->isValid()) {
                $randomName = rand() . '.' . $file->getClientOriginalExtension(); // Nama file random dengan ekstensi asli
                $file->move(public_path('ktp_images'), $randomName); // Pindahkan file ke folder public/ktp_images
                $data['ktp'] = $randomName; // Hanya simpan nama file ke database
            }
        }

        // Buat akun pengguna di tabel user
        $userId = DB::table('user')->insertGetId([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'email' => $request->input('email'),
            'is_active' => 1,
            'level' => 'mitra',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Simpan data mitra di tabel mitra
        $data['id_user'] = $userId;
        $data['name'] = $request->input('name');
        $data['telephone'] = $request->input('telephone');
        $data['address'] = $request->input('address');
        $data['payment_name'] = $request->input('payment_name');
        $data['payment_account'] = $request->input('payment_account');
        $data['payment_number'] = $request->input('payment_number');
        $data['created_at'] = now();
        $data['updated_at'] = now();

        DB::table('mitra')->insert($data);

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->to('admin/pengguna')->with('success', 'Mitra berhasil ditambahkan!');
    }


}
