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
        // hanya pickup yg status = selesai
        $pickups = Pickup::where('status', 'selesai')->get();
        return view('admin.batches.create', compact('pickups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_batch' => 'required',
            'pickup_id' => 'nullable|exists:pickups,id',
            'berat_masuk_kg' => 'required|numeric|min:0',
            'berat_keluar_kg' => 'required|numeric|min:0',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
        ]);

        CompostBatch::create($request->all());

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch kompos berhasil dibuat.');
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
            'berat_masuk_kg' => 'required|numeric',
            'berat_keluar_kg' => 'required|numeric',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
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
