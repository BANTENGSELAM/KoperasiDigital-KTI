<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompostBatch;
use App\Models\Pickup;

class CompostBatchController extends Controller
{
    public function index()
    {
        $batches = CompostBatch::with('pickup')->latest()->get();
        return view('admin.batches.index', compact('batches'));
    }

    

    public function create()
    {
        // Pickup yang sudah selesai dan belum digunakan di batch
        $pickups = Pickup::where('status', 'selesai')->get();
        return view('admin.batches.create', compact('pickups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_batch'       => 'required|unique:compost_batches,kode_batch',
            'pickup_id'        => 'required|exists:pickups,id',
            'berat_masuk_kg'   => 'required|numeric|min:0',
            'berat_keluar_kg'  => 'nullable|numeric|min:0',
            'tgl_mulai'        => 'required|date',
            'tgl_selesai'      => 'nullable|date',
            'status'           => 'required',
        ]);

        CompostBatch::create($request->all());

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch kompos berhasil dibuat!');
    }

    public function edit($id)
    {
        $batch   = CompostBatch::findOrFail($id);
        $pickups = Pickup::where('status', 'selesai')->get();

        return view('admin.batches.edit', compact('batch', 'pickups'));
    }

    public function update(Request $request, $id)
    {
        $batch = CompostBatch::findOrFail($id);

        $request->validate([
            'kode_batch'       => 'required',
            'pickup_id'        => 'required|exists:pickups,id',
            'berat_masuk_kg'   => 'required|numeric|min:0',
            'berat_keluar_kg'  => 'nullable|numeric|min:0',
            'tgl_mulai'        => 'required|date',
            'tgl_selesai'      => 'nullable|date',
            'status'           => 'required',
        ]);

        $batch->update($request->all());

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch kompos berhasil diperbarui!');
    }

    public function destroy($id)
    {
        CompostBatch::findOrFail($id)->delete();

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch kompos berhasil dihapus!');
    }
}
