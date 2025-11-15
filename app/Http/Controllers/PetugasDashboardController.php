<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pickup;
use App\Models\Sales; // model kamu bernama Sales (jamak)
use App\Models\Distribution;

class PetugasDashboardController extends Controller
{
    public function index()
    {
        // Total pengambilan sampah yang sudah dikerjakan petugas
        $totalPickups = Pickup::count();

        // Total penjualan pupuk
        $totalSales = Sales::sum('total');

        // Total SHU (jika petugas boleh lihat secara global)
        $totalSHU = Distribution::sum('jumlah_diterima');

        return view('petugas.dashboard', compact(
            'totalPickups',
            'totalSales',
            'totalSHU'
        ));
    }
}
