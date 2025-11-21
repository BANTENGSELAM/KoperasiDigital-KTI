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
            'catatan' => 'nullable|string',
        ]);

        $data['user_id'] = Auth::id();
        $data['status'] = 'dijadwalkan';
        // berat_kg akan diisi oleh petugas saat pickup selesai

        Pickup::create($data);

        return redirect()->route('member.dashboard')
            ->with('success', 'Jadwal pickup berhasil dibuat! Tunggu petugas mengambil tugas.');
    }

    // Form edit pickup (hanya jika masih dijadwalkan)
    public function edit($id)
    {
        $pickup = Pickup::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        // Hanya bisa edit jika masih dijadwalkan
        if ($pickup->status != 'dijadwalkan') {
            return redirect()->route('member.pickups.index')
                ->with('error', 'Pickup yang sudah diambil petugas tidak bisa diedit.');
        }

        return view('member.pickups.edit', compact('pickup'));
    }

    // Update pickup
    public function update(Request $request, $id)
    {
        $pickup = Pickup::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        // Hanya bisa update jika masih dijadwalkan
        if ($pickup->status != 'dijadwalkan') {
            return redirect()->route('member.pickups.index')
                ->with('error', 'Pickup yang sudah diambil petugas tidak bisa diubah.');
        }

        $data = $request->validate([
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'catatan' => 'nullable|string',
        ]);

        $pickup->update($data);

        return redirect()->route('member.pickups.index')
            ->with('success', 'Pickup berhasil diperbarui.');
    }

    // Hapus/batalkan pickup
    public function destroy($id)
    {
        $pickup = Pickup::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        // Hanya bisa hapus jika masih dijadwalkan
        if ($pickup->status != 'dijadwalkan') {
            return redirect()->route('member.pickups.index')
                ->with('error', 'Pickup yang sudah diambil petugas tidak bisa dibatalkan.');
        }

        $pickup->delete();

        return redirect()->route('member.pickups.index')
            ->with('success', 'Pickup berhasil dibatalkan.');
    }
}
