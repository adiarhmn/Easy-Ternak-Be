<?php

use App\Http\Controllers\API\AnimalController;
use App\Http\Controllers\API\AnimalTypeController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\InvestmentSlotController;
use App\Http\Controllers\API\InvestmentTypeController;
use App\Http\Controllers\API\InvestorController;
use App\Http\Controllers\API\MitraController;
use App\Http\Controllers\API\SubAnimalTypeController;
use App\Http\Middleware\Cors;
use Illuminate\Support\Facades\Route;



// Login and Register
Route::group(['prefix' => ''], function ($routes) {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
});

// Authenticated Routes
Route::get('test', function () {
    return response()->json(['message' => 'Hello World']);
});

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
    Route::get('animal/mitra', [AnimalController::class, 'indexMitra'])->name('animal.index.mitra');
    Route::get('animal/{id}', [AnimalController::class, 'details'])->name('animal.details');
    Route::post('animal', [AnimalController::class, 'saveData'])->name('animal.save');
    Route::post('animal/buy', [AnimalController::class, 'buyAnimal'])->name('animal.buy');
});

// Slot Routes
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('slot', [InvestmentSlotController::class, 'index'])->name('slot.index');
    Route::get('slot/{id}', [InvestmentSlotController::class, 'details'])->name('slot.details');
    Route::post('slot/checkout/manual', [InvestmentSlotController::class, 'manualCheckout'])->name('slot.checkout.manual');
    Route::post('slot/checkout/proof', [InvestmentSlotController::class, 'proofCheckout'])->name('slot.checkout.proof');
});


// Sub Animal Type
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('sub-animal-type', [SubAnimalTypeController::class, 'index'])->name('sub-animal-type.index');
    Route::get('sub-animal-type/{id}', [SubAnimalTypeController::class, 'details'])->name('sub-animal-type.details');
    Route::post('sub-animal-type', [SubAnimalTypeController::class, 'saveData'])->name('sub-animal-type.save');
});

// Animal Type Routes
Route::middleware(['jwt.auth', Cors::class])->group(function () {
    Route::get('animal-type', [AnimalTypeController::class, 'index'])->name('animal-type.index');
    // Route::post('animal-type', [AnimalTypeController::class, 'index'])->name('animal-type.index');
    Route::get('animal-type/{id}', [AnimalTypeController::class, 'details'])->name('animal-type.details');
    // Route::post('animal-type', [AnimalTypeController::class, 'saveData'])->name('animal-type.save');
});

// Investment Type Routes 
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('investment-type', [InvestmentTypeController::class, 'index'])->name('investment-type.index');
});
