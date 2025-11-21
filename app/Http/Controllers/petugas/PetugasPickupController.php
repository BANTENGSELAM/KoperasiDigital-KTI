<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pickup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PetugasPickupController extends Controller
{
    // Tampilkan semua pickup (atau filter petugas jika diinginkan)
    public function index()
    {
        // Tampilkan semua pickup agar petugas bisa ambil tugas,
        // atau hanya milik petugas: Pickup::where('petugas_id', Auth::id())->get();
        $pickups = Pickup::latest()->get();
        return view('petugas.pickups.index', compact('pickups'));
    }

    // Update status dan berat (oleh petugas)
    public function updateStatus(Request $request, $id)
    {
        $p = Pickup::findOrFail($id);

        $data = $request->validate([
            'status' => 'required|in:dijadwalkan,diambil,selesai,dibatalkan',
            'berat_kg' => 'nullable|numeric|min:0',
            'catatan' => 'nullable|string',
        ]);

        // set petugas_id jika belum diset
        if (!$p->petugas_id) {
            $p->petugas_id = Auth::id();
        }

        // update berat hanya bila ada input
        if (isset($data['berat_kg']) && $data['berat_kg'] !== null) {
            $p->berat_kg = $data['berat_kg'];
        }

        $p->status = $data['status'];
        if (isset($data['catatan'])) $p->catatan = $data['catatan'];
        $p->save();

        return back()->with('success', 'Status pickup diperbarui.');
    }

    // Upload bukti foto lapangan
    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image|max:4096',
            'berat_kg' => 'required|numeric|min:0',
        ]);

        $p = Pickup::findOrFail($id);

        // Upload foto
        $file = $request->file('foto');
        $path = $file->store('pickup_bukti', 'public');

        // Update pickup: foto, berat, status langsung SELESAI
        $p->bukti_foto = $path;
        $p->berat_kg = $request->berat_kg;
        $p->status = 'selesai'; // Langsung selesai, tidak perlu konfirmasi admin
        
        // set petugas jika kosong
        if (!$p->petugas_id) $p->petugas_id = Auth::id();
        $p->save();

        // Langsung create Contribution untuk SHU
        \App\Models\Contribution::create([
            'user_id' => $p->user_id,
            'berat_sampah' => $p->berat_kg,
            'tanggal' => $p->tanggal,
        ]);

        return back()->with('success', 'Pickup selesai! Foto & berat tersimpan, contribution tercatat untuk SHU.');
    }
}
