<x-admin-layout title="Penjualan">

<h1 class="text-2xl font-bold mb-4">Daftar Penjualan Pupuk</h1>

<a href="{{ route('admin.sales.create') }}"
   class="bg-green-600 text-white px-4 py-2 rounded">+ Catat Penjualan</a>

<table class="w-full bg-white mt-4 border">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2 border">Tanggal</th>
            <th class="p-2 border">Batch</th>
            <th class="p-2 border">Pembeli</th>
            <th class="p-2 border">Jumlah (kg)</th>
            <th class="p-2 border">Total (Rp)</th>
        </tr>
    </thead>

    <tbody>
        @foreach($sales as $s)
        <tr>
            <td class="border p-2">{{ $s->tanggal }}</td>
            <td class="border p-2">{{ optional($s->batch)->kode_batch ?? '-' }}</td>
            <td class="border p-2">{{ $s->pembeli }}</td>
            <td class="border p-2">{{ $s->jumlah_kg }}</td>
            <td class="border p-2">Rp {{ number_format($s->total, 0) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</x-admin-layout>
