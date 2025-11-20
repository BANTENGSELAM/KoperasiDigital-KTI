<?php

namespace App\Http\Controllers;

use App\Models\Pickup;
use Illuminate\Http\Request;

class PetugasPickupController extends Controller
{
    public function index()
    {
        $pickups = Pickup::latest()->get();
        return view('petugas.pickups.index', compact('pickups'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pickup = Pickup::findOrFail($id);

        $pickup->status = $request->status;

        if ($request->status === 'selesai' && $request->berat_kg) {
            $pickup->berat_kg = $request->berat_kg;
        }

        $pickup->save();

        return back()->with('success', 'Status berhasil diperbarui.');
    }

    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image|max:2048'
        ]);

        $pickup = Pickup::findOrFail($id);

        $filename = 'bukti_' . time() . '.' . $request->foto->extension();
        $request->foto->storeAs('pickup_bukti', $filename, 'public');

        $pickup->bukti_foto = $filename;
        $pickup->save();

        return back()->with('success', 'Bukti foto berhasil di-upload.');
    }
}
