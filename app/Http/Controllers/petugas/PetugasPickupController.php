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
        ]);

        $p = Pickup::findOrFail($id);

        $file = $request->file('foto');
        $path = $file->store('pickup_bukti', 'public'); // storage/app/public/pickup_bukti

        // simpan path relatif
        $p->bukti_foto = $path;
        // set petugas jika kosong
        if (!$p->petugas_id) $p->petugas_id = Auth::id();
        $p->save();

        return back()->with('success', 'Bukti foto berhasil diunggah.');
    }
}
