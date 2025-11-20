<?php

namespace App\Http\Controllers;

use App\Models\Pickup;
use Illuminate\Http\Request;

class UMKMPickupController extends Controller
{
    public function index()
    {
        $pickups = Pickup::where('user_id', auth()->id())->latest()->get();
        return view('member.pickups.index', compact('pickups'));
    }

    public function create()
    {
        return view('member.pickups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required',
            'lokasi' => 'required',
            'berat_kg' => 'required|numeric|min:0.5',
        ]);

        Pickup::create([
            'user_id' => auth()->id(),
            'tanggal' => $request->tanggal,
            'jenis' => $request->jenis,
            'lokasi' => $request->lokasi,
            'berat_kg' => $request->berat_kg,
            'status' => 'dijadwalkan',
        ]);

        return redirect()->route('member.pickups.index')
            ->with('success', 'Pickup berhasil diajukan.');
    }
}
