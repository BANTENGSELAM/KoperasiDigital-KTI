<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sales;
use App\Models\Distribution;
use App\Models\Contribution;
use App\Models\Ledger;

class SHUController extends Controller
{
    public function index()
    {
        $distributions = Distribution::with('user')->get();
        $totalPendapatan = Sales::sum('total');
        $totalPengeluaran = Ledger::where('type', 'expense')->sum('amount');
        $labaBersih = $totalPendapatan - $totalPengeluaran;

        return view('admin.shu.index', compact(
            'distributions','totalPendapatan','totalPengeluaran','labaBersih'
        ));
    }

    public function calculate()
    {
        $totalPendapatan = Sales::sum('total');
        $totalPengeluaran = Ledger::where('type', 'expense')->sum('amount');
        $labaBersih = $totalPendapatan - $totalPengeluaran;

        if ($labaBersih <= 0) {
            return back()->with('error', 'Tidak ada laba untuk dibagikan.');
        }

        $kontribusi = Contribution::selectRaw("user_id, SUM(berat_sampah) AS total_berat")
            ->groupBy('user_id')
            ->get();

        $totalBerat = $kontribusi->sum('total_berat');

        Distribution::truncate();

        foreach ($kontribusi as $c) {
            $persen = $totalBerat > 0 ? ($c->total_berat / $totalBerat) : 0;
            $jumlah = $labaBersih * $persen;

            Distribution::create([
                'user_id' => $c->user_id,
                'kontribusi' => $c->total_berat,
                'jumlah_diterima' => round($jumlah,2)
            ]);
        }

        return back()->with('success', 'SHU berhasil dihitung!');
    }

    public function exportPdf()
    {
        $distributions = Distribution::with('user')->get();
        return view('admin.shu.pdf', compact('distributions'));
    }
}
