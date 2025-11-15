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
        CompostBatch::create($request->all());

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

    public function update(Request $request, $id)
    {
        $batch = CompostBatch::findOrFail($id);
        $batch->update($request->all());
    
        return redirect()->route('admin.batches.index')
                ->with('success', 'Batch berhasil diperbarui!');
    }
}
