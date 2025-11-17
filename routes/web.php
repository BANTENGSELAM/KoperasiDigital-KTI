<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SHUController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\CompostBatchController;
use App\Http\Controllers\MemberDashboardController;
use App\Http\Controllers\PetugasDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Struktur route ini memisahkan area berdasarkan role: admin, petugas, member.
| Semua route auth (login/logout/register/forgot) disertakan via auth.php.
|
*/

/*
|---------------------------------------------------------------------------
| Public Routes
|---------------------------------------------------------------------------
*/
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/edukasi', [\App\Http\Controllers\EducationalPostController::class, 'publicIndex'])
    ->name('education.public');

/*
|---------------------------------------------------------------------------
| Include Auth Routes (Laravel Breeze / Fortify / Jetstream whatever you use)
|---------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

/*
|---------------------------------------------------------------------------
| Routes that require authentication (general profile actions)
|---------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|---------------------------------------------------------------------------
| Admin Routes (only role:admin)
| Prefix: /admin
| Names: admin.*
|---------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])
        ->name('dashboard');

    // Anggota (Admin membuat akun anggota: restoran_umkm, petugas, edukator)
    Route::resource('anggota', \App\Http\Controllers\Admin\AnggotaController::class);

    // Batch Kompos (CRUD)
    Route::resource('batches', CompostBatchController::class);

    // Penjualan Pupuk (CRUD)
    Route::resource('sales', SaleController::class);

    // SHU - lihat, hitung ulang, chart, export pdf
    Route::get('/shu', [SHUController::class, 'index'])->name('shu.index');
    Route::post('/shu/calculate', [SHUController::class, 'calculate'])->name('shu.calculate');
    Route::get('/shu/chart', [SHUController::class, 'chartData'])->name('shu.chart');
    Route::get('/shu/pdf', [SHUController::class, 'exportPdf'])->name('shu.pdf');

    // Optional: admin-only endpoints (ledger, distributions) if present
    // Route::resource('ledgers', \App\Http\Controllers\Admin\LedgerController::class);
    // Route::resource('distributions', \App\Http\Controllers\Admin\DistributionController::class);
});

/*
|---------------------------------------------------------------------------
| Petugas Routes (only role:petugas)
| Prefix: /petugas
| Names: petugas.*
|---------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {

    // Petugas dashboard (sederhana: jadwal & upload bukti)
    Route::get('/dashboard', [PetugasDashboardController::class, 'index'])
        ->name('dashboard');

    // Pickup management for petugas (index, show, update status, upload photo)
    Route::get('/pickups', [PickupController::class, 'index'])->name('pickups.index');
    Route::get('/pickups/{pickup}', [PickupController::class, 'show'])->name('pickups.show');
    Route::patch('/pickups/{pickup}/status', [PickupController::class, 'updateStatus'])->name('pickups.updateStatus');
    Route::post('/pickups/{pickup}/upload-photo', [PickupController::class, 'uploadPhoto'])->name('pickups.uploadPhoto');

    // If petugas needs to create pickups (usually petugas marks status and attaches media)
    // Route::post('/pickups', [\App\Http\Controllers\Petugas\PickupController::class, 'store'])->name('pickups.store');
});

/*
|---------------------------------------------------------------------------
| Member Routes (role:restoran_umkm)
| Prefix: /member
| Names: member.*
|---------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:restoran_umkm'])->prefix('member')->name('member.')->group(function () {

    // Member dashboard: submit pickup request, view kontribusi & estimasi SHU
    Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');

    // Pickup requests by member (create & list own pickups)
    Route::get('/pickups', [PickupController::class, 'index'])->name('pickups.index');
    Route::get('/pickups/create', [PickupController::class, 'create'])->name('pickups.create');
    Route::post('/pickups', [PickupController::class, 'store'])->name('pickups.store');
});

/*
|---------------------------------------------------------------------------
| Edukasi (Edukator) - some routes available for authenticated edukator users
|---------------------------------------------------------------------------
*/
Route::middleware(['auth','role:edukator|admin'])->group(function(){
    Route::get('/dashboard/edukasi', [\App\Http\Controllers\EducationalPostController::class, 'manage'])->name('education.manage');
    Route::get('/edukasi/create', [\App\Http\Controllers\EducationalPostController::class, 'create'])->name('education.create');
    Route::post('/edukasi', [\App\Http\Controllers\EducationalPostController::class, 'store'])->name('education.store');
});

/*
|---------------------------------------------------------------------------
| Fallback / misc
|---------------------------------------------------------------------------
*/
// simple health-check route (optional)
Route::get('/up', function () {
    return response('OK', 200);
});
