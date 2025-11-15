@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Daftar Anggota Koperasi</h1>

<div class="flex justify-end mb-4">
    <a href="{{ route('admin.anggota.create') }}"
       class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        + Tambah Anggota
    </a>
</div>

<div class="bg-white shadow rounded p-6">
    <table class="min-w-full border text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Nama</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Role</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($anggota as $a)
                <tr>
                    <td class="border p-2">{{ $a->name }}</td>
                    <td class="border p-2">{{ $a->email }}</td>
                    <td class="border p-2 capitalize">
                        {{ $a->roles->pluck('name')->implode(', ') }}
                    </td>
                    <td class="border p-2">
                        <a href="{{ route('admin.anggota.edit', $a->id) }}"
                           class="text-blue-600 hover:underline">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">
                        Belum ada anggota terdaftar.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
