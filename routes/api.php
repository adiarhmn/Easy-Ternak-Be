<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MitraController;
use Illuminate\Support\Facades\Route;



// Login and Register
Route::group(['prefix' => ''], function ($routes) {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
});

// Authenticated Routes
Route::middleware(['jwt.auth'])->group(function () {
    Route::post('me', [AuthController::class, 'me'])->name('me');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
});


// Mitra Routes
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('mitra', [MitraController::class, 'index'])->name('mitra.index');
    Route::post('mitra', [MitraController::class, 'store'])->name('mitra.store');
    Route::put('mitra', [MitraController::class, 'update'])->name('mitra.update');
});
