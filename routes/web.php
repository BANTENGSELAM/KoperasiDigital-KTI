<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SHUController;
use App\Http\Controllers\HomeController;

// Admin Controllers
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompostBatchController;
use App\Http\Controllers\Admin\AnggotaController;

// Petugas Controllers
use App\Http\Controllers\EducationalPostController;
use App\Http\Controllers\MemberDashboardController;

// Member Controllers
use App\Http\Controllers\PetugasDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;


// =====================
// ROUTE HALAMAN PUBLIK
// =====================
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/', [HomeController::class, 'index'])->name('home');


// Publik melihat artikel edukasi
Route::get('/edukasi', [EducationalPostController::class, 'public'])
    ->name('education.public');


// =============================
// ROLE = ADMIN
// =============================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard Admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('anggota', AnggotaController::class)->names('admin.anggota');
        // CRUD Anggota
        Route::resource('/anggota', AnggotaController::class);

        // Batch
        Route::resource('/batches', CompostBatchController::class);

        // Penjualan pupuk
        Route::resource('/sales', SaleController::class);

        // SHU
        Route::get('/shu', [SHUController::class, 'index'])->name('shu.index');
        Route::post('/shu/calculate', [SHUController::class, 'calculate'])->name('shu.calculate');
        Route::get('/shu/chart', [SHUController::class, 'chartData'])->name('shu.chart');
        Route::get('/shu/pdf', [SHUController::class, 'exportPdf'])->name('shu.pdf');
    });


// =============================
// ROLE = PETUGAS
// =============================
Route::middleware(['auth', 'role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/pickups', [PickupController::class, 'index'])->name('pickups.index');
        Route::get('/pickups/create', [PickupController::class, 'create'])->name('pickups.create');
        Route::post('/pickups/store', [PickupController::class, 'store'])->name('pickups.store');
        Route::patch('/pickups/{id}/status', [PickupController::class, 'updateStatus'])
            ->name('pickups.updateStatus');
    });

    // Route::prefix('petugas')->middleware(['auth','role:petugas|admin'])->group(function() {
    //     Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('petugas.dashboard');
    //     Route::resource('pickups', PickupController::class)->names('petugas.pickups');
    // });


// =============================
// ROLE = MEMBER (UMKM/RESTORAN)
// =============================
Route::middleware(['auth', 'role:restoran_umkm'])
    ->prefix('member')
    ->name('member.')
    ->group(function () {

        Route::get('/dashboard', [MemberDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/pickups', [PickupController::class, 'index'])->name('pickups.index');
        
    });

    // Route::prefix('member')->middleware(['auth','role:restoran_umkm'])->group(function() {
    //     Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('member.dashboard');
    //     Route::get('/pickups', [PickupController::class, 'memberIndex'])->name('member.pickups.index');
    // });


// =============================
// ROLE = EDUKATOR
// =============================
Route::middleware(['auth', 'role:edukator'])
    ->prefix('edukasi')
    ->name('education.')
    ->group(function () {

        Route::get('/dashboard', [EducationalPostController::class, 'manage'])
            ->name('manage');

        Route::get('/create', [EducationalPostController::class, 'create'])
            ->name('create');

        Route::post('/store', [EducationalPostController::class, 'store'])
            ->name('store');
    });


// =====================
// PROFILE
// =====================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
