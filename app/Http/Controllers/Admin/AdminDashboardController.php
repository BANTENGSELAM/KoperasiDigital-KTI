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
        // Total sampah dari batch compost (berat masuk)
        $totalSampah = CompostBatch::sum('berat_masuk_kg');
        
        // Total pupuk yang dihasilkan (berat keluar)
        $totalPupuk = CompostBatch::sum('berat_keluar_kg');
        
        // Total penjualan
        $totalPenjualan = Sales::sum('total');
        
        // Total SHU yang sudah didistribusikan
        $totalSHU = Distribution::sum('jumlah_diterima');
        
        // Total anggota UMKM/Restoran
        $totalAnggota = User::role('restoran_umkm')->count();
        
        // Batch aktif (sedang proses)
        $batchAktif = CompostBatch::where('status', 'proses')->count();
        
        // Total batch selesai
        $batchSelesai = CompostBatch::where('status', 'selesai')->count();

        return view('admin.dashboard', compact(
            'totalSampah',
            'totalPupuk',
            'totalPenjualan',
            'totalSHU',
            'totalAnggota',
            'batchAktif',
            'batchSelesai'
        ));
    }
}
