@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold mb-4">Daftar Batch Kompos</h2>

{{-- Alert --}}
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="mb-4">
    <a href="{{ route('admin.batches.create') }}" 
       class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        + Batch Baru
    </a>
</div>

<div class="bg-white p-6 rounded shadow">
    <table class="min-w-full border text-sm text-gray-700">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Kode Batch</th>
                <th class="p-2 border">Berat Masuk (kg)</th>
                <th class="p-2 border">Berat Keluar (kg)</th>
                <th class="p-2 border">Tanggal Mulai</th>
                <th class="p-2 border">Tanggal Selesai</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($batches as $batch)
                <tr>
                    <td class="border p-2">{{ $batch->kode_batch }}</td>

                    <td class="border p-2">{{ number_format($batch->berat_masuk_kg, 2) }}</td>

                    <td class="border p-2">
                        {{ $batch->berat_keluar_kg ? number_format($batch->berat_keluar_kg, 2) : '-' }}
                    </td>

                    <td class="border p-2">{{ $batch->tgl_mulai }}</td>

                    <td class="border p-2">
                        {{ $batch->tgl_selesai ? $batch->tgl_selesai : '-' }}
                    </td>

                    <td class="border p-2">
                        @if($batch->status == 'proses')
                            <span class="px-2 py-1 bg-yellow-200 text-yellow-800 rounded text-xs">Proses</span>
                        @elseif($batch->status == 'selesai')
                            <span class="px-2 py-1 bg-green-200 text-green-800 rounded text-xs">Selesai</span>
                        @else
                            <span class="px-2 py-1 bg-red-200 text-red-800 rounded text-xs">Dibatalkan</span>
                        @endif
                    </td>

                    <td class="border p-2 flex gap-2">
                        <a href="{{ route('admin.batches.edit', $batch->id) }}" 
                           class="text-blue-600 hover:underline">Edit</a>

                        <form action="{{ route('admin.batches.destroy', $batch->id) }}" 
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus batch ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-gray-500 py-4">Belum ada batch kompos.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
