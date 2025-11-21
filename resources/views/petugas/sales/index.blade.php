@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-semibold mb-4">Penjualan Pupuk</h2>

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

<a href="{{ route('admin.sales.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded inline-block mb-4">+ Catat Penjualan</a>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pembeli</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga/Kg</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @forelse($sales as $s)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $s->tanggal }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $s->pembeli }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($s->jumlah_kg, 2) }} kg</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($s->harga_per_kg, 0, ',', '.') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600">Rp {{ number_format($s->total, 0, ',', '.') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <a href="{{ route('admin.sales.edit', $s->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                    
                    <form action="{{ route('admin.sales.destroy', $s->id) }}" method="POST" class="inline"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus penjualan ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data penjualan.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
