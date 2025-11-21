<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SHUController;
use App\Http\Controllers\UMKMPickupController;
use App\Http\Controllers\Admin\SalesController;

// Petugas & Member
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\EducationalPostController;
use App\Http\Controllers\Admin\AdminSalesController;

// Edukasi publik & edukator
use App\Http\Controllers\Admin\CompostBatchController;
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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

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

    // Pickup Management (NEW)
    Route::get('/pickups', [\App\Http\Controllers\Admin\AdminPickupController::class, 'index'])->name('pickups.index');
    Route::post('/pickups/{id}/assign', [\App\Http\Controllers\Admin\AdminPickupController::class, 'assignPetugas'])->name('pickups.assign');
    Route::post('/pickups/{id}/confirm', [\App\Http\Controllers\Admin\AdminPickupController::class, 'confirmSelesai'])->name('pickups.confirm');
    Route::post('/pickups/{id}/reject', [\App\Http\Controllers\Admin\AdminPickupController::class, 'reject'])->name('pickups.reject');
    
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
    
    // Pickup Management
    Route::get('/pickups', [PetugasPickupController::class,'index'])->name('pickups.index');
    Route::patch('/pickups/{id}/status', [PetugasPickupController::class,'updateStatus'])->name('pickups.updateStatus');
    Route::post('/pickups/{id}/uploadBukti', [PetugasPickupController::class,'uploadBukti'])->name('pickups.uploadBukti');
    });


// ======================================================
// MEMBER ROUTES (UMKM)
// ======================================================
Route::middleware(['auth','role:restoran_umkm'])->prefix('member')->name('member.')->group(function(){
    Route::get('/dashboard', [\App\Http\Controllers\Member\MemberDashboardController::class,'index'])->name('dashboard');
    
    // Pickup Management (CRUD)
    Route::get('/pickups', [UMKMPickupController::class,'index'])->name('pickups.index');
    Route::get('/pickups/create', [UMKMPickupController::class,'create'])->name('pickups.create');
    Route::post('/pickups', [UMKMPickupController::class,'store'])->name('pickups.store');
    Route::get('/pickups/{id}/edit', [UMKMPickupController::class,'edit'])->name('pickups.edit');
    Route::put('/pickups/{id}', [UMKMPickupController::class,'update'])->name('pickups.update');
    Route::delete('/pickups/{id}', [UMKMPickupController::class,'destroy'])->name('pickups.destroy');
    
    // SHU
    Route::get('/shu', [\App\Http\Controllers\Member\MemberSHUController::class, 'index'])->name('shu.index');
    
    // Profile
    Route::get('/profile', [\App\Http\Controllers\Member\MemberProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\Member\MemberProfileController::class, 'update'])->name('profile.update');
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
