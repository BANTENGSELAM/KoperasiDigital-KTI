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
        // Auto-calculate SHU untuk semua user UMKM
        $this->autoCalculate();
        
        $distributions = Distribution::with('user')->get();
        $totalPendapatan = Sales::sum('total');
        $totalKontribusiSemua = Contribution::sum('berat_sampah');
        $totalSHU = Distribution::sum('jumlah_diterima');

        return view('admin.shu.index', compact(
            'distributions',
            'totalPendapatan',
            'totalKontribusiSemua',
            'totalSHU'
        ));
    }

    // Auto-calculate SHU (dipanggil setiap kali load index)
    private function autoCalculate()
    {
        $totalPendapatan = Sales::sum('total');
        if ($totalPendapatan <= 0) {
            return; // Tidak ada pendapatan, skip
        }

        $kontribusi = Contribution::selectRaw('user_id, SUM(berat_sampah) as total_berat')
            ->groupBy('user_id')
            ->get();

        if ($kontribusi->isEmpty()) {
            return; // Tidak ada kontribusi, skip
        }

        $totalBerat = $kontribusi->sum('total_berat');

        try {
            DB::transaction(function() use ($kontribusi, $totalPendapatan, $totalBerat){
                // Delete existing distributions
                Distribution::query()->delete();

                foreach ($kontribusi as $row) {
                    $share = $totalBerat > 0 ? ($row->total_berat / $totalBerat) : 0;
                    $amount = $totalPendapatan * $share;

                    Distribution::create([
                        'user_id' => $row->user_id,
                        'kontribusi' => $row->total_berat,
                        'jumlah_diterima' => $amount,
                    ]);
                }
            });
        } catch (\Exception $e) {
            // Silent fail, SHU calculation error tidak perlu ditampilkan di index
        }
    }

    public function calculate()
    {
        try {
            $totalPendapatan = Sales::sum('total');
            if ($totalPendapatan <= 0) {
                return back()->with('error', 'Tidak ada pendapatan untuk dibagikan.');
            }

            $kontribusi = Contribution::selectRaw('user_id, SUM(berat_sampah) as total_berat')
                ->groupBy('user_id')
                ->get();

            if ($kontribusi->isEmpty()) {
                return back()->with('error', 'Tidak ada kontribusi anggota untuk dihitung.');
            }

            $totalBerat = $kontribusi->sum('total_berat');

            DB::transaction(function() use ($kontribusi, $totalPendapatan, $totalBerat){
                // Gunakan delete() instead of truncate() karena truncate tidak bisa di dalam transaction
                Distribution::query()->delete();

                foreach ($kontribusi as $row) {
                    $share = $totalBerat > 0 ? ($row->total_berat / $totalBerat) : 0;
                    $amount = $totalPendapatan * $share;

                    Distribution::create([
                        'user_id' => $row->user_id,
                        'kontribusi' => $row->total_berat,
                        'jumlah_diterima' => $amount,
                    ]);
                }
            });

            return redirect()->route('admin.shu.index')
                ->with('success', 'SHU berhasil dihitung ulang. Total pendapatan: Rp ' . number_format($totalPendapatan, 0, ',', '.'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function exportPdf()
    {
        $distributions = Distribution::with('user')->get();
        $totalPendapatan = Sales::sum('total');
        $totalKontribusi = Contribution::sum('berat_sampah');
        $totalSHU = $distributions->sum('jumlah_diterima');
        
        return view('admin.shu.pdf', compact('distributions', 'totalPendapatan', 'totalKontribusi', 'totalSHU'));
    }
}
