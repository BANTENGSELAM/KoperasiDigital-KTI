<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contribution;
use App\Models\Sales;
use App\Models\Distribution;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalSampah = Contribution::sum('berat_sampah');
        $totalPenjualan = Sales::sum('total');
        $totalSHU = Distribution::sum('jumlah_diterima');

        return view('admin.dashboard', compact(
            'totalSampah',
            'totalPenjualan',
            'totalSHU'
        ));
    }
}
