<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\CompostBatch;
use App\Models\User;
use App\Models\EducationalPost;

class HomeController extends Controller
{
    public function index()
    {
        $totalSampah = Contribution::sum('berat_sampah');
        $totalPupuk = CompostBatch::sum('berat_keluar_kg');
        $totalAnggota = User::count();
        $posts = EducationalPost::latest()->take(3)->get();

        return view('home', compact(
            'totalSampah',
            'totalPupuk',
            'totalAnggota',
            'posts'
        ));
    }
}
