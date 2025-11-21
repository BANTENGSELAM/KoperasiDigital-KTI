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
        // Hanya tampilkan pickup yang sudah selesai dan belum ada di batch
        $pickupsSelesai = Pickup::where('status', 'selesai')
            ->whereNull('batch_id') // Belum diproses jadi batch
            ->with('user')
            ->get();
        
        return view('admin.batches.create', compact('pickupsSelesai'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_batch' => 'required|unique:compost_batches',
            'pickup_ids' => 'required|array|min:1', // Multi-select pickup
            'pickup_ids.*' => 'exists:pickups,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'status' => 'required|in:proses,selesai,dibatalkan',
            'catatan' => 'nullable|string',
        ]);

        // Hitung total berat dari pickup yang dipilih
        $pickups = Pickup::whereIn('id', $request->pickup_ids)->get();
        $beratMasuk = $pickups->sum('berat_kg');

        // Buat batch
        $batch = CompostBatch::create([
            'kode_batch' => $request->kode_batch,
            'berat_masuk_kg' => $beratMasuk,
            'berat_keluar_kg' => $request->berat_keluar_kg,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        // Link pickup ke batch
        Pickup::whereIn('id', $request->pickup_ids)->update(['batch_id' => $batch->id]);

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch berhasil dibuat dari ' . count($request->pickup_ids) . ' pickup!');
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
            'kode_batch' => 'required',
            'pickup_id' => 'nullable|exists:pickups,id',
            'berat_masuk_kg' => 'required|numeric|min:0',
            'berat_keluar_kg' => 'nullable|numeric|min:0',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'status' => 'required|in:proses,selesai,dibatalkan',
        ]);

        $batch->update($request->all());

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch kompos berhasil diperbarui.');
    }

    public function destroy($id)
    {
        CompostBatch::findOrFail($id)->delete();

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch kompos berhasil dihapus.');
    }
}
