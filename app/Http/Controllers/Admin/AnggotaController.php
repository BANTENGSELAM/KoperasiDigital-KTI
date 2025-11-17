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

    public function store(Request $r)
    {
        $r->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6',
            'role'=>'required|in:restoran_umkm,petugas,edukator'
        ]);

        $user = \App\Models\User::create([
            'name'=>$r->name,
            'email'=>$r->email,
            'password'=>bcrypt($r->password)
        ]);
        $user->assignRole($r->role);

        return redirect()->route('admin.anggota.index')->with('success','Anggota dibuat.');
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
