<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\AdminFeatureController;
use App\Http\Controllers\API\AnimalController;
use App\Http\Controllers\API\AnimalTypeController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\InvestmentSlotController;
use App\Http\Controllers\API\InvestmentTypeController;
use App\Http\Controllers\API\InvestorController;
use App\Http\Controllers\API\MitraController;
use App\Http\Controllers\API\ProgressController;
use App\Http\Controllers\API\SubAnimalTypeController;
use App\Http\Controllers\API\ExpensesController;
use App\Http\Controllers\API\MarketplaceController;
use App\Http\Controllers\API\PaymentMethodController;
use App\Http\Controllers\API\TransferProofsController;
use App\Http\Controllers\API\UserController;
use App\Http\Middleware\Cors;
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

// User Routes
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('my-order', [UserController::class, 'myOrder'])->name('my-order');
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
    Route::get('animal-type/{id}', [AnimalTypeController::class, 'details'])->name('animal-type.details');
});


// Mitra Routes
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('mitra', [MitraController::class, 'index'])->name('mitra.index');
    Route::post('mitra', [MitraController::class, 'saveData'])->name('mitra.save');
});

// Investor Routes
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('investor', [InvestorController::class, 'index'])->name('investor.index');
    Route::get('investor/byanimal/{id}', [InvestorController::class, 'getByAnimal'])->name('investor.byanimal');
    Route::post('investor', [InvestorController::class, 'saveData'])->name('investor.save');
});

// Animal Routes
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('animal', [AnimalController::class, 'index'])->name('animal.index');
    Route::get('animal/mitra', [AnimalController::class, 'indexMitra'])->name('animal.index.mitra');
    Route::get('animal/mypet', [AnimalController::class, 'getMyPet'])->name('animal.mypet');
    Route::get('animal/details/{id}', [AnimalController::class, 'details'])->name('animal.details');
    Route::post('animal', [AnimalController::class, 'saveData'])->name('animal.save');
    Route::post('animal/buy', [AnimalController::class, 'buyAnimal'])->name('animal.buy');
    Route::post('animal/sell', [AnimalController::class, 'sellAnimal'])->name('animal.sell');
    Route::post('animal/confirm-profit', [AnimalController::class, 'confirmProfit'])->name('animal.confirm-profit');
});

// Slot Routes
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('slot', [InvestmentSlotController::class, 'index'])->name('slot.index');
    Route::get('slot/details', [InvestmentSlotController::class, 'details'])->name('slot.details');
    Route::get('slot/details/{id}', [InvestmentSlotController::class, 'details'])->name('slot.details');
    Route::post('slot/checkout/manual', [InvestmentSlotController::class, 'manualCheckout'])->name('slot.checkout.manual');
    Route::post('slot/checkout/proof', [InvestmentSlotController::class, 'proofCheckout'])->name('slot.checkout.proof');
    Route::post('slot/checkout/confirm', [InvestmentSlotController::class, 'confirmCheckout'])->name('slot.checkout.confirm');
    Route::post('slot/profit-distribution/make', [InvestmentSlotController::class, 'makeProfitDistribution'])->name('slot.profit-distribution.make');
    Route::post('slot/confirm-profit', [InvestmentSlotController::class, 'confirmProfit'])->name('slot.confirm-profit');
});

// Investment Type Routes 
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('investment-type', [InvestmentTypeController::class, 'index'])->name('investment-type.index');
});

// Transfer Proof Routes
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('transfer-proof', [TransferProofsController::class, 'index'])->name('transfer-proof.index');
});

// Progress Routes
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('progress', [ProgressController::class, 'progress'])->name('progress.index');
    Route::post('progress', [ProgressController::class, 'saveData'])->name('progress.save');
});

// Expanses Routes 
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('expenses', [ExpensesController::class, 'index'])->name('expanses.index');
    Route::post('expenses', [ExpensesController::class, 'saveData'])->name('expanses.save');
});

// Marketplace Routes 
Route::group(['prefix' => 'marketplace'], function () {
    Route::get('/', [MarketplaceController::class, 'index'])->name('marketplace.index');
    Route::get('/details/{id}', [MarketplaceController::class, 'details'])->name('marketplace.details');
    Route::get('/by-animal/{id}', [MarketplaceController::class, 'getDetailsByAnimal'])->name('marketplace.getDetailsByAnimal');
});
Route::middleware(['jwt.auth'])->group(function () {
    Route::post('marketplace/make-checkout', [MarketplaceController::class, 'makeCheckoutAnimal'])->name('marketplace.make-checkout');
    Route::post('marketplace/confirm-checkout', [MarketplaceController::class, 'confirmCheckoutAnimal'])->name('marketplace.confirm-checkout');
});

// Payment Method Routes
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('payment-method', [PaymentMethodController::class, 'index'])->name('payment-method.index');
});


// Admin Routes
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('animal-distribution', [AdminController::class, 'animalDistribution'])->name('animal-distribution');
    Route::post('share-mitra-profit', [AdminController::class, 'shareProfitMitra'])->name('share-profit');
    Route::post('share-investor-profit', [AdminController::class, 'shareProfitInvestor'])->name('share-investor-profit');
});


// Route Untuk Mengkonfirmasi Sementara
Route::prefix('admin')->group(function () {
    // Mengkonfirmasi Pembayaran Investment Slot
    Route::post('confirm-investment-slot', [AdminFeatureController::class, 'confirmInvestmentSlot'])->name('confirm-investment-slot');

    // Mengkonfirmasi Pembelian Animal Ketika Slot Sudah Penuh
    Route::post('confirm-animal', [AdminFeatureController::class, 'confirmAnimal'])->name('confirm-animal');

    // Mengkonfirmasi Pembayaran Animal di Marketplace
    Route::post('confirm-marketplace', [AdminFeatureController::class, 'confirmMarketplace'])->name('confirm-marketplace');


    // 
});
