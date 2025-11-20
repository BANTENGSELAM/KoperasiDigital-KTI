<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        // pilih pickup yang sudah selesai (atau semua kalau kamu mau)
        $pickups = Pickup::where('status','selesai')->get();
        return view('admin.batches.create', compact('pickups'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_batch' => 'required|string',
            'pickup_id' => 'required|exists:pickups,id',
            'berat_masuk_kg' => 'required|numeric|min:0',
            'berat_keluar_kg' => 'nullable|numeric|min:0',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'nullable|date',
            'status' => 'required|in:proses,selesai,dibatalkan',
            'keterangan' => 'nullable|string',
        ]);

        CompostBatch::create($data);

        return redirect()->route('admin.batches.index')->with('success','Batch berhasil dibuat.');
    }

    public function edit(CompostBatch $batch)
    {
        $pickups = Pickup::where('status','selesai')->get();
        return view('admin.batches.edit', compact('batch','pickups'));
    }

    public function update(Request $request, CompostBatch $batch)
    {
        $data = $request->validate([
            'kode_batch' => 'required|string',
            'pickup_id' => 'required|exists:pickups,id',
            'berat_masuk_kg' => 'required|numeric|min:0',
            'berat_keluar_kg' => 'nullable|numeric|min:0',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'nullable|date',
            'status' => 'required|in:proses,selesai,dibatalkan',
            'keterangan' => 'nullable|string',
        ]);

        $batch->update($data);

        return redirect()->route('admin.batches.index')->with('success','Batch diperbarui.');
    }

    public function destroy(CompostBatch $batch)
    {
        $batch->delete();
        return back()->with('success','Batch dihapus.');
    }
}
