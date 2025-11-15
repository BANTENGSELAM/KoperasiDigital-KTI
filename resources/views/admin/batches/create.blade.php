@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold mb-4">Tambah Batch Kompos</h2>

<form action="{{ route('admin.batches.store') }}" method="POST" class="bg-white p-6 rounded shadow">
    @csrf

    <label class="block mb-3">
        <span class="font-semibold">Pilih Pickup</span>
        <select name="pickup_id" class="w-full border p-2 rounded">
            <option value="">-- pilih pickup selesai --</option>
            @foreach($pickups as $pu)
                <option value="{{ $pu->id }}">{{ $pu->lokasi }} - {{ $pu->tanggal }}</option>
            @endforeach
        </select>
    </label>

    <label class="block mb-3">
        <span class="font-semibold">Kode Batch</span>
        <input type="text" name="kode_batch" class="w-full border p-2 rounded">
    </label>

    <label class="block mb-3">
        <span class="font-semibold">Berat Kompos (kg)</span>
        <input type="number" name="berat_kompos" class="w-full border p-2 rounded">
    </label>

    <label class="block mb-3">
        <span class="font-semibold">Tanggal Produksi</span>
        <input type="date" name="tanggal_produksi" class="w-full border p-2 rounded">
    </label>

    <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
