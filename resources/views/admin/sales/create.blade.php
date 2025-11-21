@extends('layouts.admin')

@section('content')
<h2 class="text-xl mb-4">Catat Penjualan</h2>

<form action="{{ route('admin.sales.store') }}" method="POST">
    @csrf

    {{-- <label>Batch Kompos</label>
    <select name="batch_id" class="border p-2 w-full mb-3">
        @foreach($batches as $b)
            <option value="{{ $b->id }}">{{ $b->kode_batch }}</option>
        @endforeach
    </select> --}}

    <label>Pembeli</label>
    <input type="text" name="pembeli" class="border p-2 w-full mb-3">

    <label>Jumlah (kg)</label>
    <input type="number" step="0.01" name="jumlah_kg" class="border p-2 w-full mb-3">

    <label>Harga per Kg</label>
    <input type="number" step="0.01" name="harga_per_kg" class="border p-2 w-full mb-3">

    <label>Tanggal</label>
    <input type="date" name="tanggal" class="border p-2 w-full mb-3">

    <button class="bg-green-600 text-white px-4 py-2">Simpan</button>
</form>
@endsection
