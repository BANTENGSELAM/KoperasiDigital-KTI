<?php
namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\CompostBatch;
use App\Models\Ledger;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('batch')->latest()->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $batches = CompostBatch::where('status', 'selesai')->get();
        return view('sales.create', compact('batches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:compost_batches,id',
            'pembeli' => 'required|string|max:255',
            'jumlah_kg' => 'required|numeric|min:0.1',
            'harga_per_kg' => 'required|numeric|min:0.1',
            'tanggal' => 'required|date',
        ]);

        $total = $request->jumlah_kg * $request->harga_per_kg;

        $sale = Sale::create([
            'batch_id' => $request->batch_id,
            'pembeli' => $request->pembeli,
            'jumlah_kg' => $request->jumlah_kg,
            'harga_per_kg' => $request->harga_per_kg,
            'total' => $total,
            'tanggal' => $request->tanggal,
        ]);

        // Catat ke ledger
        Ledger::create([
            'kategori' => 'Penjualan Pupuk',
            'type' => 'income',
            'amount' => $total,
            'tanggal' => $request->tanggal,
            'ref_id' => $sale->id,
            'ref_type' => Sale::class,
            'catatan' => 'Penjualan dari batch #' . $sale->batch_id,
        ]);

        return redirect()->route('sales.index')->with('success', 'Penjualan berhasil dicatat!');
    }
}
