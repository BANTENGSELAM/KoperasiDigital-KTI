<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Contribution;
use App\Models\Distribution;
use App\Models\Pickup;

class MemberDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalKontribusi = Contribution::where('user_id', $user->id)->sum('berat_sampah');
        $totalSHU = Distribution::where('user_id', $user->id)->sum('jumlah_diterima');
        $jadwalTerbaru = Pickup::where('user_id', $user->id)->latest()->take(5)->get();

        return view('member.dashboard', compact('user', 'totalKontribusi', 'totalSHU', 'jadwalTerbaru'));
    }
}
