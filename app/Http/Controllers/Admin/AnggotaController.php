<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.anggota.index', compact('users'));
    }

    public function create()
    {
        return view('admin.anggota.create');
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,petugas,restoran_umkm'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email'=>$data['email'],
            'password'=>bcrypt($data['password'])
        ]);

        $user->assignRole($data['role']);

        return redirect()->route('admin.anggota.index')
            ->with('success','Akun berhasil dibuat.');
    }
}
