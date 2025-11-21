@extends('layouts.admin')

@section('content')
<h2 class="text-xl mb-4 font-semibold">Edit Anggota</h2>

<form action="{{ route('admin.anggota.update', $user) }}" method="POST" class="bg-white p-4 rounded">
    @csrf
    @method('PUT')
    
    <label>Nama</label>
    <input name="name" value="{{ old('name', $user->name) }}" class="w-full border p-2 mb-2" required>
    @error('name')
        <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
    @enderror
    
    <label>Email</label>
    <input name="email" type="email" value="{{ old('email', $user->email) }}" class="w-full border p-2 mb-2" required>
    @error('email')
        <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
    @enderror
    
    <label>Password <span class="text-gray-500 text-sm">(Kosongkan jika tidak ingin mengubah)</span></label>
    <input name="password" type="password" class="w-full border p-2 mb-2">
    @error('password')
        <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
    @enderror
    
    <label>Role</label>
    <select name="role" class="w-full border p-2 mb-2" required>
        <option value="restoran_umkm" {{ old('role', $user->roles->first()->name ?? '') == 'restoran_umkm' ? 'selected' : '' }}>UMKM / Restoran</option>
        <option value="petugas" {{ old('role', $user->roles->first()->name ?? '') == 'petugas' ? 'selected' : '' }}>Petugas</option>
        <option value="admin" {{ old('role', $user->roles->first()->name ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
    </select>
    @error('role')
        <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
    @enderror
    
    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Update</button>
    <a href="{{ route('admin.anggota.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded ml-2">Batal</a>
</form>
@endsection
