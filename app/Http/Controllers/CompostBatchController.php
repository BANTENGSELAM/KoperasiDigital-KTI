<?php

namespace App\Http\Controllers;

use App\Models\CompostBatch;
use App\Models\Pickup;
use Illuminate\Http\Request;

class CompostBatchController extends Controller
{
    public function index()
    {
        $batches = CompostBatch::orderBy('created_at', 'desc')->get();
        return view('admin.batches.index', compact('batches'));
    }

    public function create()
    {
        $pickups = Pickup::where('status', 'selesai')->get();

        return view('admin.batches.create', compact('pickups'));
    }

    public function edit($id)
    {
        $batch = CompostBatch::findOrFail($id);
        $pickups = Pickup::where('status', 'selesai')->get();

        return view('admin.batches.edit', compact('batch', 'pickups'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_batch' => 'required',
            'pickup_id' => 'required|exists:pickups,id',
            'berat_masuk_kg' => 'required|numeric',
            'berat_keluar_kg' => 'nullable|numeric',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'nullable|date',
            'status' => 'required'
        ]);

        $batch = CompostBatch::findOrFail($id);
        $batch->update($request->all());

        return redirect()->route('admin.batches.index')->with('success', 'Batch berhasil diperbarui.');
    }


    public function store(Request $request)
    {
        $request->validate([
            'kode_batch' => 'required|unique:compost_batches,kode_batch',
            'berat_masuk_kg' => 'required|numeric|min:0.1',
            'berat_keluar_kg' => 'nullable|numeric|min:0',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'nullable|date|after_or_equal:tgl_mulai',
            'status' => 'required|in:proses,selesai,dibatalkan',
            'keterangan' => 'nullable|string',
        ]);

        CompostBatch::create([
            'kode_batch'      => $request->kode_batch,
            'berat_masuk_kg'  => $request->berat_masuk_kg,
            'berat_keluar_kg' => $request->berat_keluar_kg,
            'tgl_mulai'       => $request->tgl_mulai,
            'tgl_selesai'     => $request->tgl_selesai,
            'status'          => $request->status,
            'keterangan'      => $request->keterangan,
        ]);

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch kompos berhasil dibuat!');
    }

    public function destroy($id)
    {
        CompostBatch::findOrFail($id)->delete();

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch berhasil dihapus.');
    }
}
