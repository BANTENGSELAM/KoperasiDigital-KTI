@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Tambah Anggota Baru</h1>

<div class="bg-white shadow rounded p-6 max-w-xl">

    <form action="{{ route('admin.anggota.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="font-semibold">Nama</label>
            <input type="text" name="name"
                   class="border p-2 w-full rounded" required>
        </div>

        <div class="mb-4">
            <label class="font-semibold">Email</label>
            <input type="email" name="email"
                   class="border p-2 w-full rounded" required>
        </div>

        <div class="mb-4">
            <label class="font-semibold">Password</label>
            <input type="password" name="password"
                   class="border p-2 w-full rounded" required>
        </div>

        <div class="mb-4">
            <label class="font-semibold">Role Anggota</label>
            <select name="role" class="border p-2 w-full rounded" required>
                <option value="restoran_umkm">Restoran / UMKM</option>
                <option value="petugas">Petugas</option>
                <option value="edukator">Edukator</option>
            </select>
        </div>

        <button type="submit"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Simpan Anggota
        </button>
    </form>

</div>
@endsection
