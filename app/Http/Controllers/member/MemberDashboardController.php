<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Pickup;
use App\Models\Contribution;
use App\Models\Distribution;
use Illuminate\Support\Facades\Auth;

class MemberDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Transparansi: Total kontribusi sampah disetor
        $totalKontribusi = Contribution::where('user_id', $user->id)->sum('berat_sampah');
        
        // Transparansi: Total SHU yang diterima
        $totalSHU = Distribution::where('user_id', $user->id)->sum('jumlah_diterima');
        
        // Pickup request terbaru (untuk monitoring)
        $pickupTerbaru = Pickup::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();
        
        // Pickup bulan ini
        $pickupBulanIni = Pickup::where('user_id', $user->id)
            ->whereMonth('tanggal', now()->month)
            ->count();

        return view('member.dashboard', compact(
            'totalKontribusi',
            'totalSHU',
            'pickupTerbaru',
            'pickupBulanIni'
        ));
    }
}
