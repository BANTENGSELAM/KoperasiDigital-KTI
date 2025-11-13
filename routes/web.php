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





Route::get('/', function () {
    return view('/welcome');
});

// Route::get('/test', function() {
//     return view('test');
// });


// route khusus admin
Route::middleware(['role:admin'])->group(function () {
    Route::resource('admin/anggota', AnggotaController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'role:restoran_umkm'])->group(function () {
    Route::resource('pickups', PickupController::class)->only(['index', 'create', 'store']);
    Route::get('/dashboard/member', [MemberDashboardController::class, 'index'])->name('member.dashboard');
});

Route::middleware(['auth', 'role:petugas|admin'])->group(function () {
    Route::get('/petugas/pickups', [PickupController::class, 'index'])->name('pickups.index');
    Route::get('/petugas/pickups/create', [PickupController::class, 'create'])->name('pickups.create');
    Route::post('/pickups/store', [PickupController::class, 'store'])->name('pickups.store');
    Route::patch('/pickups/{id}/status', [PickupController::class, 'updateStatus'])->name('pickups.updateStatus');

    Route::resource('batches', CompostBatchController::class);
    Route::resource('sales', SaleController::class);
    Route::get('/admin/shu', [SHUController::class, 'index'])->name('shu.index');
    Route::post('/admin/shu/calculate', [SHUController::class, 'calculate'])->name('shu.calculate');
    Route::get('/admin/shu/chart', [SHUController::class, 'chartData'])->name('shu.chart');
    Route::get('/admin/shu/pdf', [SHUController::class, 'exportPdf'])->name('shu.pdf');
    Route::get('/dashboard/edukasi', [EducationalPostController::class, 'manage'])->name('education.manage');
    Route::get('/dashboard/edukasi/create', [EducationalPostController::class, 'create'])->name('education.create');
    Route::post('/dashboard/edukasi/store', [EducationalPostController::class, 'store'])->name('education.store');

});



require __DIR__.'/auth.php';
