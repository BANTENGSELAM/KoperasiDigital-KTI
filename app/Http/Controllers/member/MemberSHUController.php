<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Distribution;
use Illuminate\Support\Facades\Auth;

class MemberSHUController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // List semua distribusi SHU
        $distributions = Distribution::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Total SHU keseluruhan
        $totalSHU = $distributions->sum('jumlah_diterima');
        
        // Total kontribusi keseluruhan
        $totalKontribusi = $distributions->sum('kontribusi');

        return view('member.shu.index', compact(
            'distributions',
            'totalSHU',
            'totalKontribusi'
        ));
    }
}
