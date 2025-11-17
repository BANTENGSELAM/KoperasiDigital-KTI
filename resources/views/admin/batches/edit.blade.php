@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold mb-4">Edit Batch Kompos</h2>

<form action="{{ route('admin.batches.update', $batch->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div>
            <label>Kode Batch</label>
            <input type="text" name="kode_batch" class="w-full border p-2"
                   value="{{ old('kode_batch', $batch->kode_batch) }}">
        </div>

        <div>
            <label>Pilih Pickup</label>
            <select name="pickup_id" class="w-full border p-2">
                @foreach($pickups as $p)
                    <option value="{{ $p->id }}"
                        {{ $batch->pickup_id == $p->id ? 'selected' : '' }}>
                        {{ $p->lokasi }} — {{ $p->berat }} kg
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Berat Masuk (kg)</label>
            <input type="number" name="berat_masuk_kg" step="0.01" class="w-full border p-2"
                   value="{{ old('berat_masuk_kg', $batch->berat_masuk_kg) }}">
        </div>

        <div>
            <label>Berat Keluar (kg)</label>
            <input type="number" name="berat_keluar_kg" step="0.01" class="w-full border p-2"
                   value="{{ old('berat_keluar_kg', $batch->berat_keluar_kg) }}">
        </div>

        <div>
            <label>Tanggal Mulai</label>
            <input type="date" name="tgl_mulai" class="w-full border p-2"
                   value="{{ old('tgl_mulai', $batch->tgl_mulai) }}">
        </div>

        <div>
            <label>Tanggal Selesai</label>
            <input type="date" name="tgl_selesai" class="w-full border p-2"
                   value="{{ old('tgl_selesai', $batch->tgl_selesai) }}">
        </div>

        <div>
            <label>Status</label>
            <select name="status" class="w-full border p-2">
                <option value="proses"  {{ $batch->status == 'proses' ? 'selected' : '' }}>Proses</option>
                <option value="selesai" {{ $batch->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="batal"   {{ $batch->status == 'batal' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </div>

    </div>

    <div class="mt-4">
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan Perubahan
        </button>

        <a href="{{ route('admin.batches.index') }}" class="ml-2 text-gray-600 hover:underline">
            Batal
        </a>
    </div>

</form>
@endsection
