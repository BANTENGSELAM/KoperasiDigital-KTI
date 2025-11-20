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

        $jadwal = Pickup::where('user_id',$user->id)->latest()->take(5)->get();
        $totalKontribusi = Contribution::where('user_id',$user->id)->sum('berat_sampah');
        $totalSHU = Distribution::where('user_id',$user->id)->sum('jumlah_diterima');

        return view('member.dashboard', compact('jadwal','totalKontribusi','totalSHU'));
    }
}
