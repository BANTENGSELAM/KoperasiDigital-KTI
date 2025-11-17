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
        // Admin bisa memilih pickup apa saja
        $pickups = Pickup::all();

        return view('admin.batches.create', compact('pickups'));
    }

     public function store(Request $request)
    {
        $request->validate([
            // 'pickup_id' => 'required|exists:pickups,id',
            'kode_batch' => 'required|string',
            'berat_masuk_kg' => 'required|numeric',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'nullable|date',
            'status' => 'required|string',
            'keterangan' => 'nullable|string',
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
            // 'pickup_id' => 'required|exists:pickups,id',
            'kode_batch' => 'required|string',
            'berat_masuk_kg' => 'required|numeric',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'nullable|date',
            'status' => 'required|string',
            'keterangan' => 'nullable|string',
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
