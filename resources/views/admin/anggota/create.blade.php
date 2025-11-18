<x-admin-layout title="Tambah Anggota">

<h1 class="text-2xl font-semibold mb-4">Tambah Anggota</h1>

<form action="{{ route('admin.anggota.store') }}" method="POST" class="bg-white p-6 rounded shadow">
    @csrf

    <label>Nama</label>
    <input name="name" class="border p-2 w-full mb-3" required>

    <label>Email</label>
    <input name="email" type="email" class="border p-2 w-full mb-3" required>

    <label>Password</label>
    <input name="password" type="password" class="border p-2 w-full mb-3" required>

    <label>Role</label>
    <select name="role" class="border p-2 w-full mb-3" required>
        <option value="restoran_umkm">UMKM</option>
        <option value="petugas">Petugas</option>
        <option value="admin">Admin</option>
    </select>

    <button class="bg-green-600 px-4 py-2 text-white rounded">Simpan</button>
</form>

</x-admin-layout>
