<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\Sales;
use App\Models\CompostBatch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sales::with('batch')->latest()->get();
        return view('admin.sales.index', compact('sales'));
    }

    public function create()
    {
        $batches = CompostBatch::all();
        return view('admin.sales.create', compact('batches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:compost_batches,id',
            'pembeli' => 'required',
            'jumlah_kg' => 'required|numeric',
            'harga_per_kg' => 'required|numeric',
        ]);

        Sales::create([
            'batch_id' => $request->batch_id,
            'pembeli' => $request->pembeli,
            'jumlah_kg' => $request->jumlah_kg,
            'harga_per_kg' => $request->harga_per_kg,
            'total' => $request->jumlah_kg * $request->harga_per_kg,
        ]);

        return redirect()->route('admin.sales.index')
            ->with('success', 'Penjualan berhasil dicatat.');
    }
}
