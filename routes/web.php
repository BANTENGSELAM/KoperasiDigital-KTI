<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SHUController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompostBatchController;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\EducationalPostController;
use App\Http\Controllers\MemberDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;

/*
|--------------------------------------------------------------------------
| PUBLIC / GUEST ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/edukasi', [EducationalPostController::class, 'public'])
            ->name('education.public');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | PROFILE (SEMUA USER)
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | MEMBER (ANGGOTA / UMKM / RESTORAN)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:restoran_umkm'])->prefix('member')->name('member.')->group(function () {

        Route::get('/dashboard', [MemberDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/pickups', [PickupController::class, 'index'])
            ->name('pickups.index');

        Route::get('/pickups/create', [PickupController::class, 'create'])
            ->name('pickups.create');

        Route::post('/pickups', [PickupController::class, 'store'])
            ->name('pickups.store');
    });


    /*
    |--------------------------------------------------------------------------
    | PETUGAS (PETUGAS & ADMIN)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:petugas|admin'])->prefix('petugas')->name('petugas.')->group(function () {

        Route::get('/dashboard', function () {
            return view('petugas.dashboard');
        })->name('dashboard');

        Route::get('/pickups', [PickupController::class, 'index'])->name('pickups.index');
        Route::get('/pickups/create', [PickupController::class, 'create'])->name('pickups.create');
        Route::post('/pickups/store', [PickupController::class, 'store'])->name('pickups.store');
        Route::patch('/pickups/{id}/status', [PickupController::class, 'updateStatus'])->name('pickups.updateStatus');
    });


    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {

        // Dashboard Admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Kelola Anggota
        Route::resource('/anggota', AnggotaController::class);

        // Batches (Kompos)
        Route::resource('/batches', CompostBatchController::class);

        // Sales (Penjualan)
        Route::resource('/sales', SaleController::class);
    

        // SHU
        Route::get('/shu', [SHUController::class, 'index'])->name('shu.index');
        Route::post('/shu/calculate', [SHUController::class, 'calculate'])->name('shu.calculate');
        Route::get('/shu/chart', [SHUController::class, 'chartData'])->name('shu.chart');
        Route::get('/shu/pdf', [SHUController::class, 'exportPdf'])->name('shu.pdf');

        // Edukasi (Admin/Edukator)
        Route::get('/edukasi/dashboard', [EducationalPostController::class, 'manage'])
            ->name('education.manage');

        Route::get('/edukasi/create', [EducationalPostController::class, 'create'])
            ->name('education.create');

        Route::post('/edukasi/store', [EducationalPostController::class, 'store'])
            ->name('education.store');

        

    });
});

require __DIR__.'/auth.php';
