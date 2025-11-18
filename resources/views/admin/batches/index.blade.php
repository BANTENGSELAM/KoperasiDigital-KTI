@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Batch Kompos</h1>

<a href="{{ route('admin.batches.create') }}"
   class="bg-green-600 text-white px-4 py-2 rounded">+ Batch Baru</a>

<table class="min-w-full mt-4 border text-sm text-gray-700">
    <thead class="bg-gray-100">
        <tr>
            <th class="border p-2">Kode Batch</th>
            <th class="border p-2">Pickup</th>
            <th class="border p-2">Berat Masuk</th>
            <th class="border p-2">Tanggal</th>
            <th class="border p-2">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($batches as $batch)
        <tr>
            <td class="border p-2">{{ $batch->kode_batch }}</td>
            <td class="border p-2">
                {{ $batch->pickup->lokasi ?? '-' }}
            </td>
            <td class="border p-2">{{ $batch->berat_masuk }} kg</td>
            <td class="border p-2">{{ $batch->tanggal_mulai }}</td>
            <td class="border p-2">
                <a href="{{ route('admin.batches.edit', $batch->id) }}" class="text-blue-600">Edit</a>

                <form method="POST"
                      action="{{ route('admin.batches.destroy', $batch->id) }}"
                      class="inline">
                    @csrf
                    @method('DELETE')

                    <button class="text-red-600"
                            onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
