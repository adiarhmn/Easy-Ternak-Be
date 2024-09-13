<?php

use App\Http\Controllers\InvestmentSlotController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Investment Slot Routes
Route::group(['prefix' => ''], function ($routes) {
    Route::get('slot', [InvestmentSlotController::class, 'index'])->name('slot.index');
    Route::get('slot/{id}', [InvestmentSlotController::class, 'details'])->name('slot.details');
    Route::get('slot-validate/{id}', [InvestmentSlotController::class, 'validateSlot'])->name('slot.validate');
});
