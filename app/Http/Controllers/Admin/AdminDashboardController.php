<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pickup;
use App\Models\Sales;
use App\Models\Distribution;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total Data
        $totalSampah = Pickup::sum('berat_kg');
        $totalPenjualan = Sales::sum('total');
        $totalSHU = Distribution::sum('jumlah_diterima');

        // Grafik 1: Kontribusi sampah per bulan
        $grafikKontribusi = DB::table('pickups')
            ->selectRaw("DATE_FORMAT(tanggal, '%Y-%m') as bulan, SUM(berat_kg) as total")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Grafik 2: Penjualan pupuk per bulan
        $grafikPenjualan = DB::table('sales')
            ->selectRaw("DATE_FORMAT(tanggal, '%Y-%m') as bulan, SUM(total) as total")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        return view('admin.dashboard', compact(
            'totalSampah',
            'totalPenjualan',
            'totalSHU',
            'grafikKontribusi',
            'grafikPenjualan'
        ));
    }
}
