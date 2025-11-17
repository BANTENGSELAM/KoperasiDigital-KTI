@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold mb-4">Daftar Batch Kompos</h2>

<div class="mb-4">
    <a href="{{ route('admin.batches.create') }}"
        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        + Batch Baru
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-2 mb-4 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white shadow rounded p-6">
    <table class="min-w-full border text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Kode Batch</th>
                <th class="border p-2">Pickup</th>
                <th class="border p-2">Berat Masuk</th>
                <th class="border p-2">Berat Keluar</th>
                <th class="border p-2">Tanggal</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($batches as $b)
            <tr>
                <td class="border p-2">{{ $b->kode_batch }}</td>
                <td class="border p-2">
                    {{ $b->pickup->lokasi ?? '-' }}
                    ({{ $b->pickup->berat ?? '0' }} kg)
                </td>
                <td class="border p-2">{{ $b->berat_masuk_kg }} kg</td>
                <td class="border p-2">{{ $b->berat_keluar_kg ?? '-' }} kg</td>

                <td class="border p-2">
                    Mulai: {{ $b->tgl_mulai }} <br>
                    Selesai: {{ $b->tgl_selesai ?? '-' }}
                </td>

                <td class="border p-2">
                    <span class="px-2 py-1 rounded bg-gray-200">{{ ucfirst($b->status) }}</span>
                </td>

                <td class="border p-2">
                    <a href="{{ route('admin.batches.edit', $b->id) }}"
                        class="text-blue-600 hover:underline">Edit</a>

                    <form action="{{ route('admin.batches.destroy', $b->id) }}"
                          method="POST" class="inline-block ml-2"
                          onsubmit="return confirm('Yakin ingin menghapus batch ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-gray-500 p-4">
                    Belum ada batch kompos.
                </td>
            </tr>
            @endforelse
        </tbody>

    </table>
</div>
@endsection
