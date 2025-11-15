@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Daftar Batch Kompos</h1>

<div class="flex justify-end mb-4">
    <a href="{{ route('admin.batches.create') }}"
       class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        + Batch Baru
    </a>
</div>

<div class="bg-white shadow rounded p-6">
    <table class="w-full border text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Kode Batch</th>
                <th class="border p-2">Berat Masuk (kg)</th>
                <th class="border p-2">Tanggal Mulai</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($batches as $b)
                <tr>
                    <td class="border p-2">{{ $b->kode_batch }}</td>
                    <td class="border p-2">{{ $b->berat_masuk_kg }}</td>
                    <td class="border p-2">{{ $b->tgl_mulai ?? '-' }}</td>
                    <td class="border p-2 capitalize">
                        {{ $b->status }}
                    </td>
                    <td class="border p-2">
                        <a href="{{ route('admin.batches.edit', $b->id) }}" class="text-blue-600 hover:underline">
                            Edit
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-500 p-4">
                        Belum ada batch kompos.
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>
</div>
@endsection
