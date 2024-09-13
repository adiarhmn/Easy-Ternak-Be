<?php

use App\Http\Controllers\API\AnimalController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\InvestmentSlotController;
use App\Http\Controllers\API\InvestorController;
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
    Route::post('mitra', [MitraController::class, 'saveData'])->name('mitra.save');
});

// Investor Routes
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('investor', [InvestorController::class, 'index'])->name('investor.index');
    Route::post('investor', [InvestorController::class, 'saveData'])->name('investor.save');
});

// Animal Routes
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('animal', [AnimalController::class, 'index'])->name('animal.index');
    Route::get('animal-mitra', [AnimalController::class, 'indexMitra'])->name('animal.index.mitra');
    Route::get('animal/{id}', [AnimalController::class, 'details'])->name('animal.details');
    Route::post('animal', [AnimalController::class, 'saveData'])->name('animal.save');
});

// Slot Routes
Route::middleware(['jwt.auth'])->group(function () {
    Route::post('slot/checkout', [InvestmentSlotController::class, 'checkout'])->name('slot.checkout');
});
