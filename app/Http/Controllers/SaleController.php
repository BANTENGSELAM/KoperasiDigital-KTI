<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sales;
use App\Models\CompostBatch;
use App\Models\Ledger;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sales::with('batch')->latest()->get();
        return view('admin.sales.index', compact('sales'));
    }

    public function create()
    {
        $batches = CompostBatch::where('status', 'selesai')->get();
        return view('admin.sales.create', compact('batches'));
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'batch_id' => 'nullable|exists:compost_batches,id',
            'pembeli' => 'required',
            'jumlah_kg' => 'required|numeric|min:0.1',
            'harga_per_kg' => 'required|numeric|min:0',
            'tanggal' => 'required|date'
        ]);

        $data['total'] = $data['jumlah_kg'] * $data['harga_per_kg'];

        $sale = Sales::create($data);

        Ledger::create([
            'kategori' => 'Penjualan Pupuk',
            'type' => 'income',
            'amount' => $sale->total,
            'tanggal' => $sale->tanggal,
            'ref_id' => $sale->id,
            'ref_type' => Sales::class
        ]);

        return redirect()->route('admin.sales.index')->with('success', 'Penjualan dicatat!');
    }
}
