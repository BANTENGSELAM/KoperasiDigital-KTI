<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sales;
use App\Models\Contribution;
use App\Models\Distribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SHUController extends Controller
{
    public function index()
    {
        $distributions = Distribution::with('user')->get();
        $totalPendapatan = Sales::sum('total');
        $totalKontribusiSemua = Contribution::sum('berat_sampah');

        return view('admin.shu.index', compact(
            'distributions',
            'totalPendapatan',
            'totalKontribusiSemua'
        ));
    }

    public function calculate()
    {
        $totalPendapatan = Sales::sum('total');
        if ($totalPendapatan <= 0) {
            return back()->with('error', 'Tidak ada pendapatan untuk dibagikan.');
        }

        $kontribusi = Contribution::selectRaw('user_id, SUM(berat_sampah) as total_berat')
            ->groupBy('user_id')
            ->get();

        $totalBerat = $kontribusi->sum('total_berat');

        DB::transaction(function() use ($kontribusi, $totalPendapatan, $totalBerat){
            Distribution::truncate();

            foreach ($kontribusi as $row) {
                $share = $totalBerat ? ($row->total_berat / $totalBerat) : 0;
                $amount = $totalPendapatan * $share;

                Distribution::create([
                    'user_id' => $row->user_id,
                    'kontribusi' => $row->total_berat,
                    'jumlah_diterima' => $amount,
                ]);
            }
        });

        return redirect()->route('admin.shu.index')
            ->with('success', 'SHU berhasil dihitung.');
    }

    public function exportPdf()
    {
        $distributions = Distribution::with('user')->get();
        return view('admin.shu.pdf', compact('distributions'));
    }
}
