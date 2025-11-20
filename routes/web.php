<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\SHUController;
use App\Http\Controllers\UMKMPickupController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\AnggotaController;

// Petugas & Member
use App\Http\Controllers\EducationalPostController;
use App\Http\Controllers\Admin\AdminSalesController;
use App\Http\Controllers\Admin\CompostBatchController;

// Edukasi publik & edukator
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Petugas\PetugasPickupController;
use App\Http\Controllers\Member\MemberDashboardController;
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
Route::middleware(['auth','role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('anggota', AnggotaController::class);

    Route::resource('batches', CompostBatchController::class);

    Route::resource('sales', SalesController::class);

    Route::get('/shu', [SHUController::class, 'index'])->name('shu.index');
    Route::post('/shu/calculate', [SHUController::class, 'calculate'])->name('shu.calculate');
    Route::get('/shu/pdf', [SHUController::class, 'exportPdf'])->name('shu.pdf');

});


// ======================================================
// PETUGAS ROUTES
// ======================================================
Route::middleware(['auth', 'role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

    Route::get('/dashboard', [\App\Http\Controllers\Petugas\PetugasDashboardController::class,'index'])->name('dashboard');
    Route::get('/pickups', [PetugasPickupController::class,'index'])->name('pickups.index');
    Route::patch('/pickups/{id}/status', [PetugasPickupController::class,'updateStatus'])->name('pickups.updateStatus');
    Route::post('/pickups/{id}/uploadBukti', [PetugasPickupController::class,'uploadBukti'])->name('pickups.uploadBukti');
    });


// ======================================================
// MEMBER ROUTES (UMKM)
// ======================================================
Route::middleware(['auth','role:restoran_umkm'])->prefix('member')->name('member.')->group(function(){
    Route::get('/dashboard', [\App\Http\Controllers\Member\MemberDashboardController::class,'index'])->name('dashboard');
    Route::get('/pickups', [UMKMPickupController::class,'index'])->name('pickups.index');
    Route::get('/pickups/create', [UMKMPickupController::class,'create'])->name('pickups.create');
    Route::post('/pickups', [UMKMPickupController::class,'store'])->name('pickups.store');
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
