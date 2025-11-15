<?php

namespace App\Http\Controllers;

use App\Models\CompostBatch;
use App\Models\Pickup;
use Illuminate\Http\Request;

class CompostBatchController extends Controller
{
    public function index()
    {
        $batches = CompostBatch::with('pickup')->latest()->get();
        return view('admin.batches.index', compact('batches'));
    }

    public function create()
    {
        $pickups = Pickup::where('status', 'selesai')->get();
        return view('admin.batches.create', compact('pickups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pickup_id' => 'required|exists:pickups,id',
            'kode_batch' => 'required|unique:compost_batches,kode_batch',
            'berat_kompos' => 'required|numeric',
            'tanggal_produksi' => 'required|date',
        ]);

        CompostBatch::create([
            'pickup_id' => $request->pickup_id,
            'kode_batch' => $request->kode_batch,
            'berat_kompos' => $request->berat_kompos,
            'tanggal_produksi' => $request->tanggal_produksi,
        ]);

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch kompos berhasil dibuat!');
    }

    public function edit($id)
    {
        $batch = CompostBatch::findOrFail($id);
        $pickups = Pickup::where('status', 'selesai')->get();

        return view('admin.batches.edit', compact('batch', 'pickups'));
    }

    public function update(Request $request, $id)
    {
        $batch = CompostBatch::findOrFail($id);

        $request->validate([
            'pickup_id' => 'required|exists:pickups,id',
            'kode_batch' => 'required|unique:compost_batches,kode_batch,' . $batch->id,
            'berat_kompos' => 'required|numeric',
            'tanggal_produksi' => 'required|date',
        ]);

        $batch->update($request->all());

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch berhasil diperbarui!');
    }

    public function destroy($id)
    {
        CompostBatch::findOrFail($id)->delete();

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch berhasil dihapus!');
    }
}
