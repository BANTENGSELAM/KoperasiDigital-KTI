<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\User;
use App\Models\Sales;
use App\Models\Distribution;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SHUController extends Controller
{
    public function index()
    {
        $distributions = Distribution::with('user')->get();
        return view('admin.shu.index', compact('distributions'));
    }

    public function calculate()
    {
        Distribution::truncate();

        $totalPenjualan = Sales::sum('total');

        $members = User::role('restoran_umkm')->get();

        foreach ($members as $m) {
            $shu = $totalPenjualan * 0.3 / max($members->count(), 1);

            Distribution::create([
                'user_id' => $m->id,
                'jumlah_diterima' => $shu,
            ]);
        }

        return redirect()->route('admin.shu.index')->with('success', 'SHU telah dihitung ulang.');
    }
}
