<?php

use App\Http\Controllers\EdukasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    SHUController,
    SaleController,
    PickupController,
    ProfileController,
    CompostBatchController,
    MemberDashboardController,
    EducationalPostController,
    AdminDashboardController
};
use App\Http\Controllers\Admin\AnggotaController;



/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('welcome'))->name('landing');

/*
|--------------------------------------------------------------------------
| Profil User (semua yang login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Dashboard Default (fallback, diarahkan via controller login)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| ROUTE ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard admin utama
    Route::get('/dashboard', [SHUController::class, 'index'])->name('dashboard');
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Manajemen anggota
    Route::resource('/anggota', AnggotaController::class);

    // Modul SHU
    Route::get('/shu', [SHUController::class, 'index'])->name('shu.index');
    Route::post('/admin/shu/calculate', [SHUController::class, 'calculate'])->name('shu.calculate');
    Route::get('/shu/chart', [SHUController::class, 'chartData'])->name('shu.chart');
    Route::get('/shu/pdf', [SHUController::class, 'exportPdf'])->name('shu.pdf');

    // Modul penjualan & batch kompos
    Route::resource('/batches', CompostBatchController::class);
    Route::resource('/sales', SaleController::class);
});

/*
|--------------------------------------------------------------------------
| ROUTE PETUGAS
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/petugas/pickups', [PickupController::class, 'index'])->name('pickups.index');
    Route::get('/pickups/create', [PickupController::class, 'create'])->name('pickups.create');
    Route::post('/pickups', [PickupController::class, 'store'])->name('pickups.store');
    Route::patch('/pickups/{id}/status', [PickupController::class, 'updateStatus'])->name('pickups.updateStatus');
    Route::resource('pickups', PickupController::class)->middleware('auth');

});

/*
|--------------------------------------------------------------------------
| ROUTE RESTORAN / UMKM
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:restoran_umkm'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');

    // Jika anggota ingin melihat riwayat pickup mereka
    Route::get('/pickups', [PickupController::class, 'index'])->name('pickups.index');
    Route::get('/pickups/create', [PickupController::class, 'create'])->name('pickups.create');
    Route::post('/pickups', [PickupController::class, 'store'])->name('pickups.store');
});

/*
|--------------------------------------------------------------------------
| ROUTE EDUKATOR
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:edukator'])->prefix('edukasi')->name('education.')->group(function () {
    Route::get('/dashboard', [EducationalPostController::class, 'manage'])->name('manage');
    Route::get('/create', [EducationalPostController::class, 'create'])->name('create');
    Route::post('/store', [EducationalPostController::class, 'store'])->name('store');
    
    Route::get('/edukasi', [EdukasiController::class, 'publik'])->name('edukasi.publik');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (breeze / jetstream)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
