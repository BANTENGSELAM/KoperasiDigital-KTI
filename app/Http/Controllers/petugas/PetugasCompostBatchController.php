<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\CompostBatch;
use App\Models\Pickup;
use Illuminate\Http\Request;

class PetugasCompostBatchController extends Controller
{
    public function index()
    {
        $batches = CompostBatch::with('pickup')->latest()->get();
        return view('petugas.batches.index', compact('batches'));
    }

    public function create()
    {
        $pickups = Pickup::where('status', 'selesai')->get();
        return view('petugas.batches.create', compact('pickups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_batch' => 'required',
            'pickup_id' => 'nullable|exists:pickups,id',
            'berat_masuk_kg' => 'required|numeric|min:0',
            'berat_keluar_kg' => 'nullable|numeric|min:0',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'status' => 'required|in:proses,selesai,dibatalkan',
        ]);

        CompostBatch::create($request->all());

        return redirect()->route('petugas.batches.index')
            ->with('success', 'Batch berhasil dibuat!');
    }

    public function edit($id)
    {
        $batch = CompostBatch::findOrFail($id);
        $pickups = Pickup::where('status', 'selesai')->get();
        return view('petugas.batches.edit', compact('batch', 'pickups'));
    }

    public function update(Request $request, $id)
    {
        $batch = CompostBatch::findOrFail($id);
        
        $request->validate([
            'kode_batch' => 'required',
            'pickup_id' => 'nullable|exists:pickups,id',
            'berat_masuk_kg' => 'required|numeric|min:0',
            'berat_keluar_kg' => 'nullable|numeric|min:0',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'status' => 'required|in:proses,selesai,dibatalkan',
        ]);

        $batch->update($request->all());

        return redirect()->route('petugas.batches.index')
            ->with('success', 'Batch berhasil diperbarui!');
    }

    public function show($id)
    {
        $batch = CompostBatch::with('pickup')->findOrFail($id);
        return view('petugas.batches.show', compact('batch'));
    }
}
