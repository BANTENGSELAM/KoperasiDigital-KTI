<?php

namespace App\Http\Controllers;

use App\Notifications\SHUCalculatedNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Sales;
use App\Models\Ledger;
use App\Models\Contribution;
use App\Models\Distribution;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class SHUController extends Controller
{
    // Halaman utama SHU
    public function index()
    {
        $totalPendapatan = Sales ::sum('total')  ?? 0;
        $totalPengeluaran = Ledger::where('type', 'expense')->sum('amount')?? 0;
        $shuBersih = $totalPendapatan - $totalPengeluaran;

        $distributions = Distribution::with('user')->latest()->get();

        return view('admin.shu.index', compact('totalPendapatan', 'totalPengeluaran', 'shuBersih', 'distributions'));
    }

    // Perhitungan dan distribusi SHU otomatis
    public function calculate()
    {
        $totalPendapatan = Sales::sum('total');
        $totalPengeluaran = Ledger::where('type', 'expense')->sum('amount');
        $shuBersih = $totalPendapatan - $totalPengeluaran;

        // Ambil total kontribusi semua anggota
        $totalKontribusi = Contribution::sum('berat_sampah');

        if ($totalKontribusi <= 0 || $shuBersih <= 0) {
            return back()->with('error', 'Tidak ada data kontribusi atau SHU belum tersedia.');
        }

        // Reset distribusi sebelumnya (opsional)
        Distribution::truncate();

        // Bagi SHU berdasarkan kontribusi sampah
        $contributions = Contribution::with('user')->get();
        foreach ($contributions as $c) {
            $persentase = $c->berat_sampah / $totalKontribusi;
            $jumlah_diterima = $shuBersih * $persentase;

            Distribution::create([
                'user_id' => $c->user_id,
                'total_kontribusi' => $c->berat_sampah,
                'persentase' => round($persentase * 100, 2),
                'jumlah_diterima' => round($jumlah_diterima, 2),
                'periode' => Carbon::now()->format('Y-m'),

                
            ]);

            $c->user->notify(new \App\Notifications\SHUCalculatedNotification(
                round($jumlah_diterima, 2),
                Carbon::now()->format('Y-m')
            ));
        }

        return redirect()->route('shu.index')->with('success', 'Perhitungan SHU berhasil dilakukan.');
    }

        public function chartData()
    {
        // Ambil data penjualan (income) per bulan
        $sales = DB::table('sales')
            ->selectRaw('DATE_FORMAT(tanggal, "%Y-%m") as bulan, SUM(total) as pendapatan')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Ambil data pengeluaran per bulan
        $expenses = DB::table('ledgers')
            ->selectRaw('DATE_FORMAT(tanggal, "%Y-%m") as bulan, SUM(amount) as pengeluaran')
            ->where('type', 'expense')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Gabungkan kedua data untuk visualisasi
        $data = [
            'bulan' => $sales->pluck('bulan'),
            'pendapatan' => $sales->pluck('pendapatan'),
            'pengeluaran' => $expenses->pluck('pengeluaran'),
        ];

        return response()->json($data);
    }

        public function exportPDF()
    {
        $totalPendapatan = \App\Models\Sales::sum('total');
        $totalPengeluaran = \App\Models\Ledger::where('type', 'expense')->sum('amount');
        $shuBersih = $totalPendapatan - $totalPengeluaran;
        $distributions = \App\Models\Distribution::with('user')->get();

        $pdf = Pdf::loadView('admin.shu.pdf', [
            'totalPendapatan' => $totalPendapatan,
            'totalPengeluaran' => $totalPengeluaran,
            'shuBersih' => $shuBersih,
            'distributions' => $distributions,
            'periode' => now()->format('F Y'),
        ]);

        return $pdf->download('laporan_shu_' . now()->format('Y_m_d') . '.pdf');
    }


}
