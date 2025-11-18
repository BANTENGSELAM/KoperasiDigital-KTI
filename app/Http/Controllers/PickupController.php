<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pickup;
use Illuminate\Support\Facades\Auth;

class PickupController extends Controller
{
    // For member: list their pickups
    public function index()
    {
        $user = Auth::user();
        if($user->hasRole('restoran_umkm')){
            $pickups = Pickup::where('user_id',$user->id)->get();
            return view('member.pickups.index', compact('pickups'));
        }

        if($user->hasRole('petugas')){
            $pickups = Pickup::whereIn('status',['dijadwalkan','diambil'])->get();
            return view('petugas.pickups.index', compact('pickups'));
        }

        // otherwise fallback
        abort(403);
    }

    public function create()
    {
        // member create request
        return view('member.pickups.create');
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'tanggal'=>'required|date',
            'berat_kg'=>'required|numeric|min:0.01',
            'jenis'=>'nullable|string',
            'lokasi'=>'nullable|string',
            'catatan'=>'nullable|string'
        ]);

        $data['user_id'] = auth()->id();
        $data['status'] = 'dijadwalkan';

        Pickup::create($data);

        return redirect()->back()->with('success','Permintaan pickup dikirim.');
    }

    // petugas update status
    public function updateStatus(Request $r, $id)
    {
        $r->validate(['status'=>'required|in:dijadwalkan,diambil,selesai,dibatalkan','photo'=>'nullable|image|max:2048']);

        $pickup = Pickup::findOrFail($id);
        $pickup->status = $r->status;

        if($r->hasFile('photo')){
            $path = $r->file('photo')->store('pickup_photos','public');
            $pickup->photo = $path;
        }

        $pickup->save();

        return back()->with('success','Status pickup diperbarui.');
    }

    public function indexPetugas()
{
    $pickups = Pickup::where('status','!=','selesai')
        ->orderBy('tanggal')
        ->get();

    return view('petugas.pickups.index', compact('pickups'));
}

public function updateStatus(Request $request, Pickup $pickup)
{
    $pickup->update([
        'status' => $request->status,
        'catatan' => $request->catatan
    ]);

    return back()->with('success','Status berhasil diperbarui.');
}

public function uploadFoto(Request $request, Pickup $pickup)
{
    $request->validate([
        'foto_lapangan' => 'required|image|max:2048'
    ]);

    $path = $request->file('foto_lapangan')->store('pickup_fotos','public');

    $pickup->update(['foto_lapangan' => $path]);

    return back()->with('success','Foto lapangan berhasil diunggah.');
}

}
