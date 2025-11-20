<x-admin-layout title="Tambah Anggota">
    <h1 class="text-xl mb-4">Tambah Anggota</h1>
    <form action="{{ route('admin.anggota.store') }}" method="POST" class="bg-white p-4 rounded">
        @csrf
        <label>Nama</label><input name="name" class="w-full border p-2 mb-2" required>
        <label>Email</label><input name="email" type="email" class="w-full border p-2 mb-2" required>
        <label>Password</label><input name="password" type="password" class="w-full border p-2 mb-2" required>
        <label>Role</label>
        <select name="role" class="w-full border p-2 mb-2">
            <option value="restoran_umkm">UMKM</option>
            <option value="petugas">Petugas</option>
            <option value="admin">Admin</option>
        </select>
        <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</x-admin-layout>
