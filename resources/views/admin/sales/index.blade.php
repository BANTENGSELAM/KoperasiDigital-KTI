@extends('layouts.admin')

@section('content')
<h2 class="text-xl font-semibold mb-4">Penjualan Pupuk</h2>

<a href="{{ route('admin.sales.create') }}"
   class="bg-green-600 text-white px-4 py-2 rounded">+ Catat Penjualan</a>

<table class="w-full border mt-4">
    <thead class="bg-gray-100">
        <tr>
            <th class="border p-2">Tanggal</th>
            {{-- <th class="border p-2">Batch</th> --}}
            <th class="border p-2">Pembeli</th>
            <th class="border p-2">Jumlah</th>
            <th class="border p-2">Total</th>
        </tr>
    </thead>

    <tbody>
        @foreach($sales as $s)
            <tr>
                <td class="border p-2">{{ $s->tanggal }}</td>
                {{-- <td class="border p-2">{{ $s->batch->kode_batch }}</td> --}}
                <td class="border p-2">{{ $s->pembeli }}</td>
                <td class="border p-2">{{ $s->jumlah_kg }} kg</td>
                <td class="border p-2">Rp {{ number_format($s->total,0,',','.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
