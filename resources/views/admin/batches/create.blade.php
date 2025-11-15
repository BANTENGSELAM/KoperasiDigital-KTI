@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold mb-4">Tambah Batch Kompos</h2>

<form method="POST" action="{{ route('admin.batches.store') }}" class="bg-white p-6 rounded shadow">
    @csrf

    <label class="block mb-3">
        <span class="font-semibold">Kode Batch</span>
        <input type="text" name="kode_batch" class="w-full border p-2 rounded">
    </label>

    <label class="block mb-3">
        <span class="font-semibold">Berat Masuk (kg)</span>
        <input type="number" name="berat_masuk_kg" class="w-full border p-2 rounded">
    </label>

    <label class="block mb-3">
        <span class="font-semibold">Tanggal Mulai</span>
        <input type="date" name="tgl_mulai" class="w-full border p-2 rounded">
    </label>

    <button class="bg-green-600 text-white px-4 py-2 rounded">
        Simpan
    </button>
</form>
@endsection
