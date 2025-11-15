<?php

namespace App\Http\Controllers;

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
        $pickups = Pickup::where('status', 'selesai')->get();

        return view('admin.batches.create', compact('pickups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_batch' => 'required|unique:compost_batches,kode_batch',
            'berat_masuk_kg' => 'required|numeric',
            'tgl_mulai' => 'required|date',
        ]);

        CompostBatch::create([
            'kode_batch' => $request->kode_batch,
            'berat_masuk_kg' => $request->berat_masuk_kg,
            'tgl_mulai' => $request->tgl_mulai,
            'status' => 'proses'
        ]);

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch berhasil dibuat.');
    }

    public function destroy($id)
    {
        CompostBatch::findOrFail($id)->delete();

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch berhasil dihapus.');
    }
}
