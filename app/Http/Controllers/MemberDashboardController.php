<?php

namespace App\Http\Controllers;

use App\Models\Pickup;
use App\Models\Contribution;
use App\Models\Distribution;
use Illuminate\Container\Attributes\Auth;

class MemberDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $totalKontribusi = \App\Models\Contribution::where('user_id', $user->id)->sum('berat_sampah');
        $totalSHU = \App\Models\Distribution::where('user_id',$user->id)->sum('jumlah_diterima');
        $jadwal = Pickup::where('user_id',$user->id)->latest()->take(5)->get();
        return view('member.dashboard', compact('user','totalKontribusi','totalSHU','jadwal'));
    }

    
}
