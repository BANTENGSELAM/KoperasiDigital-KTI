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
            ->with('success', 'Akun berhasil dibuat.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.anggota.edit', compact('user'));
    }

    public function update(Request $r, $id)
    {
        $user = User::findOrFail($id);

        $data = $r->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'role' => 'required|in:admin,petugas,restoran_umkm'
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
       
        if ($r->filled('password')) {
            $user->password = bcrypt($data['password']);
        }

        $user->save();

        // Sync role
        $user->syncRoles([$data['role']]);

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Prevent self-deletion
        if ($user->id == auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();
        
        return redirect()->route('admin.anggota.index')
            ->with('success', 'Akun berhasil dihapus.');
    }
}
