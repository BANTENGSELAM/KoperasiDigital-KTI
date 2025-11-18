<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pickup;
use App\Models\CompostBatch;
use App\Models\Sales;
use App\Models\Distribution;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalSampah = Pickup::sum('berat_kg');
        $totalPupuk = CompostBatch::sum('berat_keluar_kg');
        $totalPenjualan = Sales::sum('total');
        $totalSHU = Distribution::sum('jumlah_diterima');
        $totalAnggota = User::role('restoran_umkm')->count();

        return view('admin.dashboard', compact(
            'totalSampah', 'totalPupuk', 'totalPenjualan', 'totalSHU', 'totalAnggota'
        ));
    }
}
