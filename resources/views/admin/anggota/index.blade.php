<x-admin-layout title="Data Anggota">

<h1 class="text-2xl font-semibold mb-4">Data Anggota</h1>

<a href="{{ route('admin.anggota.create') }}"
   class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah Anggota</a>

<div class="bg-white mt-4 p-4 rounded shadow">
    <table class="min-w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Nama</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
            <tr>
                <td class="border p-2">{{ $u->name }}</td>
                <td class="border p-2">{{ $u->email }}</td>
                <td class="border p-2">{{ $u->roles->pluck('name')->implode(', ') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</x-admin-layout>
