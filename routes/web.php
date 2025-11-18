<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\PickupController;
use App\Http\Controllers\Admin\SHUController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\EducationalPostController;

// Petugas & Member
use App\Http\Controllers\MemberDashboardController;
use App\Http\Controllers\Admin\CompostBatchController;
use App\Http\Controllers\Admin\AdminDashboardController;

// Edukasi publik & edukator
use App\Http\Controllers\Petugas\PetugasDashboardController;


// =======================
// PUBLIC (Landing)
// =======================
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/edukasi', [EducationalPostController::class, 'public'])
    ->name('education.public');

// =======================
// AUTH MIDDLEWARE
// =======================
require __DIR__.'/auth.php';


// ======================================================
// ADMIN ROUTES
// ======================================================
Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function() {

    Route::get('/dashboard', [AdminDashboardController::class,'index'])
        ->name('dashboard');

    // Anggota
    Route::resource('anggota', AnggotaController::class);

    // Batch kompos
    Route::resource('batches', CompostBatchController::class);

    // Penjualan
    Route::resource('sales', SalesController::class);

    // SHU
    Route::get('/shu', [SHUController::class,'index'])->name('shu.index');
    Route::post('/shu/calculate', [SHUController::class,'calculate'])->name('shu.calculate');
    Route::get('/shu/pdf', [SHUController::class,'exportPdf'])->name('shu.pdf');
});


// ======================================================
// PETUGAS ROUTES
// ======================================================
Route::middleware(['auth','role:petugas'])->prefix('petugas')->name('petugas.')->group(function() {

    Route::get('/dashboard', [PetugasDashboardController::class,'index'])
        ->name('dashboard');

    Route::get('/pickups', [PickupController::class,'indexPetugas'])
        ->name('pickups.index');

    Route::patch('/pickups/{pickup}/status', [PickupController::class,'updateStatus'])
        ->name('pickups.updateStatus');

    Route::post('/pickups/{pickup}/upload-foto', [PickupController::class,'uploadFoto'])
        ->name('pickups.uploadFoto');
});


// ======================================================
// MEMBER ROUTES (UMKM)
// ======================================================
Route::middleware(['auth','role:restoran_umkm'])->prefix('member')->name('member.')->group(function() {

    Route::get('/dashboard', [MemberDashboardController::class,'index'])
        ->name('dashboard');

    Route::get('/pickups', [PickupController::class,'indexMember'])
        ->name('pickups.index');

    Route::get('/pickups/create', [PickupController::class,'create'])
        ->name('pickups.create');

    Route::post('/pickups', [PickupController::class,'store'])
        ->name('pickups.store');
});


// ======================================================
// EDUKATOR (Untuk Petugas Edukasi / Admin)
// ======================================================
Route::middleware(['auth','role:admin|petugas'])->group(function() {

    Route::get('/edukasi/dashboard', [EducationalPostController::class,'manage'])
        ->name('education.manage');

    Route::get('/edukasi/create', [EducationalPostController::class,'create'])
        ->name('education.create');

    Route::post('/edukasi', [EducationalPostController::class,'store'])
        ->name('education.store');
});
