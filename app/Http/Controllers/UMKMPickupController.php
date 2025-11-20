<?php

namespace App\Http\Controllers;

use App\Models\Pickup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UMKMPickupController extends Controller
{
    // Tampilkan list pickup user (member)
    public function index()
    {
        $pickups = Pickup::where('user_id', Auth::id())->latest()->get();
        return view('member.pickups.index', compact('pickups'));
    }

    // Form buat pickup
    public function create()
    {
        return view('member.pickups.create');
    }

    // Simpan pickup baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'berat_kg' => 'required|numeric|min:0.01',
            'jenis' => 'nullable|string|max:255',
            'catatan' => 'nullable|string',
        ]);

        $data['user_id'] = Auth::id();
        $data['status'] = 'dijadwalkan';

        Pickup::create($data);

        return redirect()->route('member.pickups.index')
            ->with('success', 'Jadwal pengambilan berhasil dibuat.');
    }
}
