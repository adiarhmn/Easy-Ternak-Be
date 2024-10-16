<?php

use App\Http\Controllers\Admin\MainAuthController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BerandaAdminController;
use App\Http\Controllers\Admin\KelolaSlotAdminController;
use App\Http\Controllers\Admin\KelolaPemeliharaanAdminController;
use App\Http\Controllers\Admin\KelolaPenjualanAdminController;
use App\Http\Controllers\Admin\KelolaPenggunaAdminController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('pages.login');
});
Route::post('/post-login', [MainAuthController::class, 'postLogin'])->name('postlogin');
Route::get('/logout', [MainAuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->group(function(){
    Route::get('/beranda',[BerandaAdminController::class,'index'])->name('admin.beranda');

    Route::get('/slot',[KelolaSlotAdminController::class,'index'])->name('admin.slot');
    Route::get('/slot/tambah',[KelolaSlotAdminController::class,'tambah'])->name('admin.tambah');
    Route::get('/slot/setujui/{id}', [KelolaSlotAdminController::class, 'approve'])->name('admin.slot.approve');
    Route::get('/slot/tolak/{id}', [KelolaSlotAdminController::class, 'reject'])->name('admin.slot.reject');
    Route::get('/slot/detail/{id}',[KelolaSlotAdminController::class,'detail'])->name('admin.slot.detail');
    Route::get('/slot/detail/investor/{id}',[KelolaSlotAdminController::class,'investor'])->name('admin.slot.investor');
    Route::post('/slot/confirm', [KelolaSlotAdminController::class, 'confirmSlot'])->name('admin.slot.confirm');

    Route::get('/pemeliharaan',[KelolaPemeliharaanAdminController::class,'index'])->name('admin.pemeliharaan');
    Route::get('/pemeliharaan/detail/{id}',[KelolaPemeliharaanAdminController::class,'detail'])->name('admin.pemeliharaan.detail');
    Route::get('/pemeliharaan/progres/{id}',[KelolaPemeliharaanAdminController::class,'progres'])->name('admin.pemeliharaan.progres');
    Route::get('/pemeliharaan/pengeluaran/{id}',[KelolaPemeliharaanAdminController::class,'pengeluaran'])->name('admin.pemeliharaan.pengeluaran');
    Route::get('/pemeliharaan/investor/{id}',[KelolaPemeliharaanAdminController::class,'investor'])->name('admin.pemeliharaan.investor');
    Route::get('/pemeliharaan/formjual/{id}',[KelolaPemeliharaanAdminController::class,'formjual'])->name('admin.pemeliharaan.formjual');
    Route::post('/pemeliharaan/jual', [KelolaPemeliharaanAdminController::class, 'confirmSale'])->name('admin.pemeliharaan.confirmSale');

    Route::get('/penjualan',[KelolaPenjualanAdminController::class,'index'])->name('admin.penjualan');
    Route::get('/penjualan/detail/{id}',[KelolaPenjualanAdminController::class,'detail'])->name('admin.penjualan.detail');
    Route::get('/penjualan/detail/keuangan/{id}',[KelolaPenjualanAdminController::class,'profit'])->name('admin.penjualan.detail.profit');
    Route::get('/penjualan/detail/transfer/{id}',[KelolaPenjualanAdminController::class,'transfer'])->name('admin.penjualan.detail.transfer');
    Route::get('/penjualan/detail/progres/{id}',[KelolaPenjualanAdminController::class,'progres'])->name('admin.penjualan.progres.transfer');
    Route::get('/penjualan/detail/pengeluaran/{id}',[KelolaPenjualanAdminController::class,'pengeluaran'])->name('admin.penjualan.pengeluaran.transfer');
    Route::get('/penjualan/detail/investor/{id}',[KelolaPenjualanAdminController::class,'investor'])->name('admin.penjualan.investor.transfer');

    Route::get('/pengguna',[KelolaPenggunaAdminController::class,'index'])->name('admin.pengguna');
    Route::get('/pengguna/mitra',[KelolaPenggunaAdminController::class,'index'])->name('admin.pegguna');
    Route::get('/pengguna/mitra/tambah',[KelolaPenggunaAdminController::class,'tambahMitra'])->name('admin.pegguna.tambah');
    Route::post('/pengguna/mitra/simpan',[KelolaPenggunaAdminController::class,'simpanMitra'])->name('admin.pegguna.simpan');
    Route::get('/pengguna/mitra/profil/{id}',[KelolaPenggunaAdminController::class,'profilMitra'])->name('admin.pegguna.profil');
    Route::post('/pengguna/mitra/update/{id}',[KelolaPenggunaAdminController::class,'updateMitra'])->name('admin.pegguna.update');

    Route::get('/pengguna/investor',[KelolaPenggunaAdminController::class,'investor'])->name('admin.pegguna.investor');
    Route::get('/pengguna/investor/profil/{id}',[KelolaPenggunaAdminController::class,'profilInvestor'])->name('admin.pegguna.investor.profil');
    Route::get('/pengguna/investor/tambah',[KelolaPenggunaAdminController::class,'tambahInvestor'])->name('admin.pegguna.tambah');
    Route::post('/pengguna/investor/simpan',[KelolaPenggunaAdminController::class,'simpanInvestor'])->name('admin.pegguna.simpan');
    Route::post('/pengguna/investor/update/{id}',[KelolaPenggunaAdminController::class,'updateInvestor'])->name('admin.pegguna.update');

});