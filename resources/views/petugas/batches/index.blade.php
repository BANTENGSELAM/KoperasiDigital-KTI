@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-semibold mb-4">Daftar Batch Kompos</h2>

{{-- Alert Messages --}}
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<a href="{{ route('admin.batches.create') }}"
   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded inline-block mb-4">+ Batch Baru</a>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Batch</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pickup</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Berat Masuk</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Berat Keluar</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($batches as $b)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $b->kode_batch }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $b->pickup->lokasi ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($b->berat_masuk_kg, 2) }} kg</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $b->berat_keluar_kg ? number_format($b->berat_keluar_kg, 2) . ' kg' : '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $b->tanggal_mulai }} → {{ $b->tanggal_selesai }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($b->status == 'selesai')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                        @elseif($b->status == 'proses')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Proses</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Dibatalkan</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="{{ route('admin.batches.edit', $b->id) }}"
                           class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>

                        <form action="{{ route('admin.batches.destroy', $b->id) }}"
                              method="POST" class="inline"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus batch {{ $b->kode_batch }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                        Belum ada data batch kompos. Silakan buat batch baru.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
