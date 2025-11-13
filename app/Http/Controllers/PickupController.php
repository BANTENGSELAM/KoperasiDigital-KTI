<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pickup;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PickupController extends Controller
{
    // daftar jadwal pengambilan untuk petugas
    public function index()
    {
        $pickups = Pickup::with('user')
            ->latest()
            ->paginate(10);

        return view('petugas.pickups.index', compact('pickups'));
    }

    // form buat pengambilan baru
    public function create()
    {
        $members = User::role('restoran_umkm')->get();
        return view('petugas.pickups.create', compact('members'));
    }

    // simpan pengambilan baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string',
            'berat' => 'nullable|numeric|min:0',
            'status' => 'required|in:menunggu,proses,selesai',
        ]);

        Pickup::create([
            'user_id' => $request->user_id,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'berat' => $request->berat,
            'status' => $request->status,
            'petugas_id' => Auth::id(),
        ]);

        return redirect()->route('pickups.index')->with('success', 'Data pengambilan berhasil ditambahkan.');
    }

    // ubah status ke "selesai"
    public function updateStatus($id)
    {
        $pickup = Pickup::findOrFail($id);
        $pickup->status = 'selesai';
        $pickup->save();

        return redirect()->back()->with('success', 'Status pengambilan diperbarui.');
    }
}
