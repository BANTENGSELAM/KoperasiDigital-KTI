@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold mb-4">Daftar Batch Kompos</h2>

<a href="{{ route('admin.batches.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">
    + Batch Baru
</a>

@if(session('success'))
    <div class="bg-green-200 text-green-800 p-3 mb-4 rounded">
        {{ session('success') }}
    </div>
@endif

<table class="w-full bg-white shadow rounded">
    <thead>
        <tr class="bg-gray-100">
            <th class="p-3 border">Kode Batch</th>
            <th class="p-3 border">Pickup</th>
            <th class="p-3 border">Berat Kompos</th>
            <th class="p-3 border">Tanggal Produksi</th>
            <th class="p-3 border">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($batches as $batch)
        <tr>
            <td class="border p-3">{{ $batch->kode_batch }}</td>
            <td class="border p-3">{{ $batch->pickup->lokasi ?? '-' }}</td>
            <td class="border p-3">{{ $batch->berat_kompos }} kg</td>
            <td class="border p-3">{{ $batch->tanggal_produksi }}</td>
            <td class="border p-3">

                <a href="{{ route('admin.batches.edit', $batch->id) }}" class="text-blue-600">Edit</a>

                <form action="{{ route('admin.batches.destroy', $batch->id) }}" method="POST" class="inline-block ml-2">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin hapus batch?')" class="text-red-600">
                        Hapus
                    </button>
                </form>

            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center p-3">Belum ada batch.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
