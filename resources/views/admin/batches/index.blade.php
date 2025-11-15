@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold mb-4">Daftar Batch Kompos</h2>

<a href="{{ route('admin.batches.create') }}"
   class="bg-green-600 text-white px-4 py-2 rounded inline-block mb-4">
    + Batch Baru
</a>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 p-3 rounded mb-3">
        {{ session('success') }}
    </div>
@endif

<table class="w-full bg-white shadow rounded text-sm">
    <thead>
        <tr class="bg-gray-100">
            <th class="p-3 border">Kode Batch</th>
            <th class="p-3 border">Berat Masuk (kg)</th>
            <th class="p-3 border">Tanggal Mulai</th>
            <th class="p-3 border">Status</th>
            <th class="p-3 border">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($batches as $b)
        <tr>
            <td class="p-3 border">{{ $b->kode_batch }}</td>
            <td class="p-3 border">{{ $b->berat_kompos }}</td>
            <td class="p-3 border">{{ $b->tanggal_produksi}}</td>
            <td class="p-3 border">{{ $b->status }}</td>
            <td class="p-3 border">
                <form method="POST" action="{{ route('admin.batches.destroy', $b->id) }}">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus batch?')"
                        class="text-red-600">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center p-3">
                Belum ada batch.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
