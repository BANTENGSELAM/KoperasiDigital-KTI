<?php

namespace App\Http\Controllers;

use App\Models\Pickup;
use App\Models\Contribution;
use App\Models\CompostBatch;
use App\Models\Sales;
use App\Models\Distribution;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalSampah'      => Contribution::sum('berat_sampah'),
            'totalBatch'       => CompostBatch::count(),
            'totalPenjualan'   => Sales::sum('total'),
            'totalSHU'         => Distribution::sum('jumlah_diterima'),
            'totalAnggota'     => User::count(),
            'grafikKontribusi' => Contribution::selectRaw('MONTH(tanggal) as bulan, SUM(berat_sampah) as total')
                                ->groupBy('bulan')->orderBy('bulan')->get(),
            'grafikPenjualan'  => Sales::selectRaw('MONTH(tanggal) as bulan, SUM(total) as total_penjualan')
                                ->groupBy('bulan')->orderBy('bulan')->get(),
        ]);
    }
}
