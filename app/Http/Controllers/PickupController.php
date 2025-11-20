<?php

namespace App\Http\Controllers;

use App\Models\Pickup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PickupController extends Controller
{
    // Member list
    public function indexMember()
    {
        $pickups = Pickup::where('user_id', Auth::id())->latest()->get();
        return view('member.pickups.index', compact('pickups'));
    }

    public function create()
    {
        return view('member.pickups.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'lokasi' => 'required|string',
            'berat_kg' => 'required|numeric|min:0.01',
            'jenis' => 'nullable|string',
        ]);

        $data['user_id'] = Auth::id();
        $data['status'] = 'dijadwalkan';
        Pickup::create($data);

        return redirect()->route('member.pickups.index')->with('success','Jadwal pengambilan dibuat.');
    }

    // Petugas list
    public function indexPetugas()
    {
        $pickups = Pickup::orderBy('tanggal','asc')->get();
        return view('petugas.pickups.index', compact('pickups'));
    }

    public function updateStatus(Request $request, Pickup $pickup)
    {
        $request->validate([
            'status'=>'required|in:dijadwalkan,diambil,selesai,dibatalkan',
            'catatan'=>'nullable|string'
        ]);

        $pickup->update([
            'status'=>$request->status,
            'catatan'=>$request->catatan,
            'petugas_id'=>auth()->id()
        ]);

        return back()->with('success','Status diperbarui.');
    }

    public function uploadFoto(Request $request, Pickup $pickup)
    {
        $request->validate(['foto_lapangan'=>'required|image|max:2048']);
        $path = $request->file('foto_lapangan')->store('pickup_fotos','public');
        $pickup->update(['foto_lapangan'=>$path]);
        return back()->with('success','Foto berhasil diunggah.');
    }
}
