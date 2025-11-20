@extends('layouts.admin')

@section('content')
<h2 class="text-xl font-semibold mb-4">Daftar Batch Kompos</h2>

<a href="{{ route('admin.batches.create') }}"
   class="bg-green-600 text-white px-4 py-2 rounded">+ Batch Baru</a>

<table class="w-full mt-4 border">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2 border">Kode Batch</th>
            <th class="p-2 border">Pickup</th>
            <th class="p-2 border">Berat Masuk</th>
            <th class="p-2 border">Berat Keluar</th>
            <th class="p-2 border">Tanggal</th>
            <th class="p-2 border">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($batches as $b)
            <tr>
                <td class="border p-2">{{ $b->kode_batch }}</td>
                <td class="border p-2">{{ $b->pickup->lokasi ?? '-' }}</td>
                <td class="border p-2">{{ $b->berat_masuk_kg }} kg</td>
                <td class="border p-2">{{ $b->berat_keluar_kg }} kg</td>
                <td class="border p-2">{{ $b->tanggal_mulai }} → {{ $b->tanggal_selesai }}</td>
                <td class="border p-2">

                    <a href="{{ route('admin.batches.edit',$b->id) }}"
                       class="text-blue-600">Edit</a>

                    <form action="{{ route('admin.batches.destroy',$b->id) }}"
                          method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Hapus batch?')"
                                class="text-red-600">Hapus</button>
                    </form>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
