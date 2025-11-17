<?php

namespace App\Http\Controllers;

use App\Models\Pickup;
use Illuminate\Support\Facades\Request;

class PetugasDashboardController extends Controller
{
    public function index()
    {
        $totalPickup = Pickup::count();
        $pickupPending = Pickup::where('status', 'pending')->count();
        $pickupSelesai = Pickup::where('status', 'selesai')->count();

        return view('petugas.dashboard', compact(
            'totalPickup',
            'pickupPending',
            'pickupSelesai'
        ));
    }
    public function uploadPhoto(Request $r, $pickupId)
    {
        $r->validate(['photo'=>'required|image|max:2048']);
        $pickup = Pickup::findOrFail($pickupId);
        $path = $r->file('photo')->store('pickup_photos','public');
        // simpan di kolom photo atau create relation PickupPhoto
        $pickup->update(['photo'=>$path,'status'=>'selesai']);
        return back()->with('success','Foto bukti diunggah, status pickup diset selesai.');
    }
}