<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnimalModel;
use Illuminate\Http\Request;

class KelolaPemeliharaanAdminController extends Controller
{
    public function index()
{
    // Ambil data hewan dari database
    $animals = AnimalModel::where("status", "process")->get();

    // Menyiapkan data untuk view
    $animalData = $animals->map(function ($animal) {
        // Cek apakah selling_date valid
        if ($animal->selling_date) {
            // Set zona waktu Asia/Makassar
            $now = \Carbon\Carbon::now('Asia/Makassar')->startOfDay(); // Mulai dari awal hari
            $sellingDate = \Carbon\Carbon::parse($animal->selling_date)->setTimezone('Asia/Makassar')->startOfDay(); // Juga mulai dari awal hari

            // Hitung sisa hari hingga selling_date
            $remainingDays = $now->diffInDays($sellingDate, false); // false untuk tidak mengambil nilai absolut

            // Jika selling_date sudah lewat, atur menjadi 0
            $remainingDays = max(0, $remainingDays);
        } else {
            $remainingDays = null; // Atau bisa diatur ke nilai lain jika selling_date tidak ada
        }

        // Tambahkan data baru untuk sisa hari
        $animal->remainingDays = (int)$remainingDays; // Pastikan menjadi integer

        return $animal;
    });

    $data = [
        'title' => 'EasyTernak | Pemeliharaan',
        'page' => 'Pemeliharaan',
        'topbar' => 'Pemeliharaan', 
        'animals' => $animalData, // Pass data hewan ke view
    ];
    return view('pages.admin.kelola-pemeliharaan.pemeliharaan', $data);
}
public function confirmSale(Request $request)
    {
        $request->validate([
            'animal_id' => 'required|exists:animal,id_animal',
        ]);

        // Find the animal and update the status
        $animal = AnimalModel::findOrFail($request->animal_id);
        $animal->status = 'distribution'; // Update status to distribution
        $animal->save();

        // Redirect to the sales menu after updating the status with a custom message
        // return redirect()->route('admin.penjualan')->with('success', 'Status hewan telah diubah menjadi tahap penjualan.');
        return redirect()->route('admin.penjualan.detail.profit', ['id' => $animal->id_animal])
        ->with('success', 'Hewan Berhasil Dijual.');
    }



    public function detail($idAnimal){

        // Mengambil data animal beserta relasinya menggunakan eager loading
        $animal = AnimalModel::with(['subAnimalType', 'investmentType', 'mitra', 'animalImage', 'investmentSlot'])
            ->find($idAnimal);
    
            if (!$animal) {
                return redirect('admin/penjualan')->with('error', 'Data tidak ditemukan.');
            }
            
            $data = [
                'title' => 'EasyTernak | Pemeliharaan',
                'page' => 'Pemeliharaan',
                'topbar' => 'Detail',
                'animal' => $animal, // Mengirim data animal ke view
            'idAnimal' => $idAnimal, // Menambahkan animal jika perlu
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