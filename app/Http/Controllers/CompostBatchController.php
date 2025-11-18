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
       // Pickup hanya muncul jika status = selesai
        $pickups = Pickup::where('status', 'selesai')->get();

        return view('admin.batches.create', compact('pickups'));
    }

     public function store(Request $request)
    {
        $request->validate([
            // 'pickup_id' => 'required|exists:pickups,id',
            'kode_batch' => 'required',
            'pickup_id' => 'required|exists:pickups,id',
            'berat_masuk' => 'required|numeric',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date',
        ]);

        CompostBatch::create($request->all());

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch kompos berhasil dibuat!');
    }

    public function edit($id)
    {
        $pickups = Pickup::where('status', 'selesai')->get();

        return view('admin.batches.edit', compact('batch', 'pickups'));
    }

    public function update(Request $request, CompostBatch $batch)
    {
        $request->validate([
            'kode_batch' => 'required',
            'pickup_id' => 'required|exists:pickups,id',
            'berat_masuk' => 'required|numeric',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date',
        ]);

        $batch->update($request->all());

        return redirect()
            ->route('admin.batches.index')
            ->with('success', 'Batch berhasil diperbarui');
    }

    public function destroy($id)
    {
        CompostBatch::findOrFail($id)->delete();

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch kompos berhasil dihapus!');
    }
}
