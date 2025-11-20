<x-admin-layout title="Anggota">
    <h1 class="text-xl mb-4">Data Anggota</h1>
    <a href="{{ route('admin.anggota.create') }}" class="bg-green-600 text-white px-3 py-1 rounded">+ Tambah</a>

    <table class="mt-4 w-full bg-white">
        <thead class="bg-gray-100"><tr><th class="p-2">Nama</th><th class="p-2">Email</th><th class="p-2">Role</th></tr></thead>
        <tbody>
        @foreach($users as $u)
            <tr><td class="p-2">{{ $u->name }}</td><td class="p-2">{{ $u->email }}</td><td class="p-2">{{ $u->roles->pluck('name')->implode(', ') }}</td></tr>
        @endforeach
        </tbody>
    </table>
</x-admin-layout>
