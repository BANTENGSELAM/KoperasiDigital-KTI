<x-admin-layout>

<h1 class="text-2xl font-semibold mb-4">Penjualan Pupuk</h1>

<a href="{{ route('admin.sales.create') }}"
   class="bg-green-600 text-white px-4 py-2 rounded">+ Catat Penjualan</a>

<div class="bg-white mt-4 p-4 rounded shadow">
<table class="min-w-full border">
    <thead class="bg-gray-100">
        <tr>
            <th class="border p-2">Tanggal</th>
            <th class="border p-2">Batch</th>
            <th class="border p-2">Pembeli</th>
            <th class="border p-2">Jumlah (kg)</th>
            <th class="border p-2">Total (Rp)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $s)
        <tr>
            <td class="border p-2">{{ $s->tanggal }}</td>
            <td class="border p-2">{{ $s->batch->kode_batch ?? '-' }}</td>
            <td class="border p-2">{{ $s->pembeli }}</td>
            <td class="border p-2">{{ $s->jumlah_kg }}</td>
            <td class="border p-2">Rp {{ number_format($s->total,0,',','.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

</x-admin-layout>
