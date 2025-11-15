@extends('layouts.admin')

@section('content')
<h1 class="text-xl font-bold mb-6">Catat Penjualan Pupuk</h1>

<form action="{{ route('admin.sales.store') }}" method="POST">
    @csrf

    <label class="block mb-2 font-semibold">Pilih Batch</label>
    <select name="batch_id" class="border p-2 w-full mb-4">
        @foreach($batches as $b)
            <option value="{{ $b->id }}">{{ $b->kode_batch }}</option>
        @endforeach
    </select>

    <label class="block mb-2 font-semibold">Pembeli</label>
    <input type="text" name="pembeli" class="border p-2 w-full mb-4">

    <label class="block mb-2 font-semibold">Jumlah (kg)</label>
    <input type="number" step="0.01" name="jumlah_kg" class="border p-2 w-full mb-4">

    <label class="block mb-2 font-semibold">Harga per kg</label>
    <input type="number" step="0.01" name="harga_per_kg" class="border p-2 w-full mb-4">

    <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
