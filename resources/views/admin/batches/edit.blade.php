@extends('layouts.admin')

@section('content')
<h2 class="text-xl mb-4 font-semibold">Batch Kompos Baru</h2>

<form action="{{ route('admin.batches.store') }}" method="POST">
    @csrf

    <label>Kode Batch</label>
    <input type="text" name="kode_batch" class="border p-2 w-full mb-3">

    <label>Pilih Pickup (opsional)</label>
    <select name="pickup_id" class="border p-2 w-full mb-3">
        <option value="">-- Tidak Pakai Pickup --</option>
        @foreach($pickups as $p)
            <option value="{{ $p->id }}">
                {{ $p->lokasi }} ({{ $p->berat_kg }} kg)
            </option>
        @endforeach
    </select>

    <label>Berat Masuk (kg)</label>
    <input type="number" step="0.01" name="berat_masuk_kg" class="border p-2 w-full mb-3">

    <label>Berat Keluar (kg)</label>
    <input type="number" step="0.01" name="berat_keluar_kg" class="border p-2 w-full mb-3">

    <label>Tanggal Mulai</label>
    <input type="date" name="tanggal_mulai" class="border p-2 w-full mb-3">

    <label>Tanggal Selesai</label>
    <input type="date" name="tanggal_selesai" class="border p-2 w-full mb-3">

    <label>Catatan</label>
    <textarea name="catatan" class="border p-2 w-full mb-3"></textarea>

    <button class="bg-green-600 text-white px-4 py-2">Simpan</button>
</form>
@endsection
