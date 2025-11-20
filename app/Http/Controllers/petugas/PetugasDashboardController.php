<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pickup;
use Illuminate\Support\Facades\Auth;

class PetugasDashboardController extends Controller
{
    public function index()
    {
        $petugasId = Auth::id();

        $tugasHariIni = Pickup::where('petugas_id',$petugasId)
            ->where('tanggal', today())->get();

        return view('petugas.dashboard', compact('tugasHariIni'));
    }
}
