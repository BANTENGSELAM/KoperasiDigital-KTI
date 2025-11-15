<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = User::role('restoran_umkm')->get();
        return view('admin.anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('admin.anggota.create');
    }

    public function store(Request $request)
    {
        // jika mau tambah anggota manual, tinggal isi validasi & simpan
        return back()->with('info', 'Fitur belum diimplementasikan');
    }

    public function show(User $anggotum)
    {
        return view('admin.anggota.show', compact('anggotum'));
    }

    public function edit(User $anggotum)
    {
        return view('admin.anggota.edit', compact('anggotum'));
    }

    public function update(Request $request, User $anggotum)
    {
        return back()->with('info', 'Update anggota belum diimplementasikan');
    }

    public function destroy(User $anggotum)
    {
        $anggotum->delete();
        return redirect()->route('admin.anggota.index')->with('success', 'Anggota dihapus');
    }
}
