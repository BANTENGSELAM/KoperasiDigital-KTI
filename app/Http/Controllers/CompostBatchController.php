<?php

namespace App\Http\Controllers;

use App\Models\CompostBatch;
use App\Models\Pickup;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompostBatchController extends Controller
{
    public function index()
    {
        $batches = CompostBatch::latest()->get();
        return view('batches.index', compact('batches'));
    }

    public function create()
    {
        // pilih pickup yang sudah selesai untuk diolah
        $pickups = Pickup::where('status', 'selesai')->get();
        return view('batches.create', compact('pickups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pickup_ids' => 'required|array',
        ]);

        $totalBerat = Pickup::whereIn('id', $request->pickup_ids)->sum('berat_kg');

        CompostBatch::create([
            'kode_batch' => 'CB' . now()->format('Ymd') . Str::upper(Str::random(4)),
            'berat_masuk_kg' => $totalBerat,
            'tgl_mulai' => now(),
            'status' => 'proses',
        ]);

        // Update pickup menjadi "diolah"
        Pickup::whereIn('id', $request->pickup_ids)->update(['status' => 'diolah']);

        return redirect()->route('batches.index')->with('success', 'Batch pengolahan pupuk berhasil dibuat.');
    }

    public function edit(CompostBatch $batch)
    {
        return view('batches.edit', compact('batch'));
    }

    public function update(Request $request, CompostBatch $batch)
    {
        $request->validate([
            'berat_keluar_kg' => 'required|numeric|min:0',
        ]);

        $batch->update([
            'berat_keluar_kg' => $request->berat_keluar_kg,
            'tgl_selesai' => now(),
            'status' => 'selesai',
        ]);

        return redirect()->route('batches.index')->with('success', 'Batch telah diselesaikan.');
    }
}
