<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EdukasiController extends Controller
{

    public function publik()
    {
        // Logika untuk halaman edukasi publik, misalnya ambil data edukasi
        return view('edukasi.publik');  // Ganti dengan view yang sesuai
    }

}
