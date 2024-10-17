<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnimalExpensesModel;
use App\Models\AnimalModel;
use App\Models\AnimalProgressModel;
use App\Models\InvestmentSlotModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KelolaPemeliharaanAdminController extends Controller
{
    public function index()
{

    if (!Auth::check() || Auth::user()->level !== 'admin') {
        return redirect('/login')->withErrors(['login_error' => 'Anda harus login sebagai admin untuk mengakses halaman ini.']);
    }


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
   // Validasi input
   $validatedData = $request->validate([
    'animal_id' => 'required|exists:animal,id_animal',
    'harga_jual' => 'required|numeric|min:0',
    'total_modal' => 'required|numeric',
    'hasil_bersih' => 'nullable|numeric|min:0',
    'profit_platform' => 'nullable|numeric|min:0',
    'profit_investor' => 'nullable|numeric|min:0',
    'profit_mitra' => 'nullable|numeric|min:0',
]);

// Temukan hewan berdasarkan ID
$animal = AnimalModel::findOrFail($validatedData['animal_id']);

// Update harga jual dan tanggal penjualan
$animal->selling_price = $validatedData['harga_jual'];
$animal->selling_date = Carbon::now('Asia/Makassar');
$animal->status = 'distribution';
$animal->save();

// Hitung total modal
$totalModal = $validatedData['total_modal'] ?? 0;
// Hitung profit
$profit = $validatedData['profit_investor'];
$profit = max(0, $profit); // Atur profit menjadi 0 jika negatif

    // Ambil semua slot investasi yang statusnya success untuk hewan ini
    $investmentSlots = InvestmentSlotModel::where('id_animal', $animal->id_animal)
                        ->where('status', 'success')
                        ->get();

    // Hitung profit per investor (dibagi rata sesuai jumlah investor)
    $jumlahInvestor = $investmentSlots->count();
    if ($jumlahInvestor > 0) {
        $profitPerInvestor = $profit / $jumlahInvestor;

        // Update profit di setiap slot investasi
        foreach ($investmentSlots as $slot) {
            $slot->profit = $profitPerInvestor;
            $slot->save();
        }
    }

    // Redirect ke halaman detail profit setelah berhasil update
    return redirect()->route('admin.penjualan.detail.profit', ['id' => $animal->id_animal])
        ->with('success', 'Hewan berhasil dijual dan profit telah didistribusikan.');
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
            'title' => 'EasyTernak | Pemeliharaan',
            'page' => 'Pemeliharaan',
            'topbar' => 'Progres',
            'progress' => $progress,
            'startDate' => $startDate,
            'endDate' => $endDate,
            "idAnimal" => $animal_id
        ];

        return view('pages.admin.kelola-pemeliharaan.detail.progres', $data);
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
            'title' => 'EasyTernak | Pemeliharaan',
            'page' => 'Pemeliharaan',
            'topbar' => 'Pengeluaran',
            'idAnimal' => $idAnimal,
            'expenses' => $expenses,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ];
    
        return view('pages.admin.kelola-pemeliharaan.detail.pengeluaran', $data);
    }
    
    public function formjual($idAnimal){
        // Mengambil data hewan beserta relasinya menggunakan eager loading
        $animal = AnimalModel::with(['animalExpenses'])->find($idAnimal);

        if (!$animal) {
            return redirect('admin/penjualan')->with('error', 'Data tidak ditemukan.');
        }

        // Harga beli
        $hargaBeli = $animal->purchase_price;

        // Total pengeluaran dari tabel expenses
        $totalPengeluaran = $animal->animalExpenses->sum('price');

        // Menghitung total modal
        $totalModal = $hargaBeli + $totalPengeluaran;

        $data = [
            'title' => 'EasyTernak | Jual',
            'page' => 'Pemeliharaan',
            'topbar' => 'Jual',
            'animal' => $animal,
            'hargaBeli' => $hargaBeli,
            'totalPengeluaran' => $totalPengeluaran,
            'totalModal' => $totalModal,
            'idAnimal' => $idAnimal,
        ];


        return view('pages.admin.kelola-pemeliharaan.detail.jual', $data);
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
            'page' => 'Pemeliharaan',
            'topbar' => 'Investor',
            'investmentSlots' => $investmentSlots,
            'animal' => AnimalModel::find($idAnimal), // Menambahkan animal jika perlu
            'idAnimal' => $idAnimal, // Menambahkan animal jika perlu
        ];
    
        return view('pages.admin.kelola-pemeliharaan.detail.investor', $data);
    }

}