@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Buat Batch Kompos Baru</h1>

<div class="bg-white shadow rounded p-6">

    <form action="{{ route('admin.batches.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="font-semibold">Kode Batch</label>
            <input type="text" name="kode_batch" 
                class="border p-2 w-full rounded" 
                placeholder="Contoh: BATCH-001"
                required>
        </div>

        <div class="mb-4">
            <label class="font-semibold">Berat Masuk (kg)</label>
            <input type="number" step="0.01" name="berat_masuk_kg"
                class="border p-2 w-full rounded"
                required>
        </div>

        <div class="mb-4">
            <label class="font-semibold">Tanggal Mulai</label>
            <input type="date" name="tgl_mulai"
                class="border p-2 w-full rounded">
        </div>

        <div class="mb-4">
            <label class="font-semibold">Status</label>
            <select name="status" class="border p-2 w-full rounded">
                <option value="proses">Proses</option>
                <option value="selesai">Selesai</option>
                <option value="dibatalkan">Dibatalkan</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="font-semibold">Keterangan</label>
            <textarea name="keterangan" class="border p-2 w-full rounded" rows="3"></textarea>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Simpan Batch
        </button>
    </form>

</div>
@endsection
