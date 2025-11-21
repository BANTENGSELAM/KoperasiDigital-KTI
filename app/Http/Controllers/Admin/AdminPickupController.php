<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pickup;
use App\Models\User;
use App\Models\Contribution;
use Illuminate\Http\Request;

class AdminPickupController extends Controller
{
    // List semua pickup
    public function index()
    {
        $pickups = Pickup::with(['user', 'petugas'])->latest()->get();
        
        // Pickup pending (belum ada petugas atau belum selesai)
        $pickupPending = Pickup::whereIn('status', ['dijadwalkan', 'diambil'])->count();
        
        // List petugas untuk assign
        $petugasList = User::role('petugas')->get();
        
        return view('admin.pickups.index', compact('pickups', 'pickupPending', 'petugasList'));
    }

    // Assign pickup ke petugas
    public function assignPetugas(Request $request, $id)
    {
        $pickup = Pickup::findOrFail($id);
        
        $request->validate([
            'petugas_id' => 'required|exists:users,id'
        ]);
        
        $pickup->petugas_id = $request->petugas_id;
        $pickup->save();
        
        return back()->with('success', 'Pickup berhasil ditugaskan ke petugas!');
    }

    // Konfirmasi pickup selesai (setelah lihat foto)
    public function confirmSelesai(Request $request, $id)
    {
        $pickup = Pickup::findOrFail($id);
        
        // Validasi harus ada foto bukti & berat
        if (!$pickup->bukti_foto) {
            return back()->with('error', 'Pickup belum ada foto bukti dari petugas!');
        }
        
        if (!$pickup->berat_kg) {
            return back()->with('error', 'Berat sampah belum diinput!');
        }
        
        // Update status jadi selesai
        $pickup->status = 'selesai';
        $pickup->save();
        
        // Create Contribution untuk SHU
        Contribution::create([
            'user_id' => $pickup->user_id,
            'berat_sampah' => $pickup->berat_kg,
            'tanggal' => $pickup->tanggal,
        ]);
        
        return back()->with('success', 'Pickup dikonfirmasi selesai! Contribution sudah tercatat untuk SHU.');
    }

    // Reject/batalkan pickup
    public function reject($id)
    {
        $pickup = Pickup::findOrFail($id);
        $pickup->status = 'dibatalkan';
        $pickup->save();
        
        return back()->with('success', 'Pickup dibatalkan.');
    }
}
