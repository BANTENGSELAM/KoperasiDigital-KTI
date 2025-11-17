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
        $totalExpense = Ledger::where('type','expense')->sum('amount');
        $labaBersih = $totalPendapatan - $totalExpense;

        if($labaBersih <= 0) {
            return back()->with('error','Tidak ada laba bersih untuk dibagikan.');
        }

        $kontribusiPerUser = \App\Models\Contribution::selectRaw('user_id, SUM(berat_sampah) as total_berat')
            ->groupBy('user_id')
            ->get();

        $totalBerat = $kontribusiPerUser->sum('total_berat');

        DB::transaction(function() use($kontribusiPerUser,$labaBersih,$totalBerat){
            // hapus distribusi lama jika perlu
            \App\Models\Distribution::truncate();

            foreach($kontribusiPerUser as $c){
                $share = ($totalBerat>0) ? ($c->total_berat / $totalBerat) : 0;
                $amount = round($labaBersih * $share, 2);
                \App\Models\Distribution::create([
                    'user_id'=>$c->user_id,
                    'kontribusi'=>$c->total_berat,
                    'jumlah_diterima'=>$amount,
                ]);
            }
        });

        return redirect()->route('admin.shu.index')->with('success','SHU berhasil dihitung.');
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
