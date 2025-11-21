<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pickup;
use App\Models\Distribution;
use Illuminate\Support\Facades\Auth;

class PetugasDashboardController extends Controller
{
    public function index()
    {
        $petugasId = Auth::id();

        // Pickup hari ini (semua)
        $pickupHariIni = Pickup::where('tanggal', today())->get();
        
        // Pickup yang ditugaskan ke saya
        $pickupSaya = Pickup::where('petugas_id', $petugasId)
            ->where('status', '!=', 'selesai')
            ->get();
        
        // TRANSPARANSI: Total sampah dikumpulkan oleh semua petugas (selesai)
        $totalSampahSistem = Pickup::where('status', 'selesai')->sum('berat_kg');
        
        // TRANSPARANSI: Total SHU yang sudah didistribusikan
        $totalSHUSistem = Distribution::sum('jumlah_diterima');
        
        // Pickup selesai minggu ini
        $pickupSelesaiMingguIni = Pickup::where('status', 'selesai')
            ->whereBetween('tanggal', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        return view('petugas.dashboard', compact(
            'pickupHariIni',
            'pickupSaya',
            'totalSampahSistem',
            'totalSHUSistem',
            'pickupSelesaiMingguIni'
        ));
    }
}
