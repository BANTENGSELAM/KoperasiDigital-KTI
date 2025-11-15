<?php

namespace App\Http\Controllers;

use App\Models\Pickup;

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
}
