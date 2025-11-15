<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\Pickup;
use Illuminate\Support\Str;
use App\Models\CompostBatch;
use Illuminate\Http\Request;

class CompostBatchController extends Controller
{
    public function index()
    {
        $batches = CompostBatch::latest()->get();
        return view('batches.index', compact('batches'));
    }

    public function create()
    {
        // pilih pickup yang sudah selesai untuk diolah
        $pickups = Pickup::where('status', 'selesai')->get();
        return view('admin.batches.create', compact('pickups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:compost_batches,id',
            'pembeli' => 'required',
            'jumlah_kg' => 'required|numeric',
            'harga_per_kg' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        $total = $request->jumlah_kg * $request->harga_per_kg;

        Sales::create([
            'batch_id' => $request->batch_id,
            'pembeli' => $request->pembeli,
            'jumlah_kg' => $request->jumlah_kg,
            'harga_per_kg' => $request->harga_per_kg,
            'tanggal' => $request->tanggal,
            'total' => $total,
        ]);

        return redirect()->route('admin.sales.index')->with('success', 'Penjualan berhasil dicatat');
    }

    public function edit(CompostBatch $batch)
    {
        return view('batches.edit', compact('batch'));
    }

    public function update(Request $request, CompostBatch $batch)
    {
        $request->validate([
            'berat_keluar_kg' => 'required|numeric|min:0',
        ]);

        $batch->update([
            'berat_keluar_kg' => $request->berat_keluar_kg,
            'tgl_selesai' => now(),
            'status' => 'selesai',
        ]);

        return redirect()->route('batches.index')->with('success', 'Batch telah diselesaikan.');
    }
}
