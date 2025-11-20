<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sales;
use App\Models\CompostBatch;
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
        $batches = CompostBatch::all();
        return view('admin.sales.create', compact('batches'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'batch_id' => 'nullable|exists:compost_batches,id',
            'pembeli' => 'required|string',
            'jumlah_kg' => 'required|numeric|min:0.1',
            'harga_per_kg' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ]);

        $data['total'] = $data['jumlah_kg'] * $data['harga_per_kg'];

        Sales::create($data);

        return redirect()->route('admin.sales.index')
            ->with('success', 'Data penjualan berhasil dicatat.');
    }
}
