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
        $batches = CompostBatch::latest()->get();
        return view('admin.batches.index', compact('batches'));
    }

    public function create()
    {
        $pickups = Pickup::where('status','selesai')->get();
        return view('admin.batches.create', compact('pickups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_batch' => 'required',
            'tanggal_mulai' => 'required|date',
            'berat_masuk_kg' => 'required|numeric',
        ]);

        CompostBatch::create($request->all());

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch berhasil dibuat');
    }

    public function edit(CompostBatch $batch)
    {
        return view('admin.batches.edit', compact('batch'));
    }

    public function update(Request $request, CompostBatch $batch)
    {
        $batch->update($request->all());

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch berhasil diperbaruhi');
    }

    public function destroy(CompostBatch $batch)
    {
        $batch->delete();

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch berhasil dihapus');
    }
}
