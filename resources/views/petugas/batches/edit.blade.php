@extends('layouts.admin')

@section('content')
<h2 class="text-xl mb-4 font-semibold">Edit Batch Kompos</h2>

<form action="{{ route('admin.batches.update', $batch) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Kode Batch</label>
    <input type="text" name="kode_batch" value="{{ old('kode_batch', $batch->kode_batch) }}" class="border p-2 w-full mb-3" required>
    @error('kode_batch')
        <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
    @enderror

    <label>Pilih Pickup (opsional)</label>
    <select name="pickup_id" class="border p-2 w-full mb-3">
        <option value="">-- Tidak Pakai Pickup --</option>
        @foreach($pickups as $p)
            <option value="{{ $p->id }}" {{ old('pickup_id', $batch->pickup_id) == $p->id ? 'selected' : '' }}>
                {{ $p->lokasi }} ({{ $p->berat_kg }} kg)
            </option>
        @endforeach
    </select>
    @error('pickup_id')
        <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
    @enderror

    <label>Berat Masuk (kg)</label>
    <input type="number" step="0.01" name="berat_masuk_kg" value="{{ old('berat_masuk_kg', $batch->berat_masuk_kg) }}" class="border p-2 w-full mb-3" required>
    @error('berat_masuk_kg')
        <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
    @enderror

    <label>Berat Keluar (kg) <span class="text-gray-500 text-sm">(Opsional)</span></label>
    <input type="number" step="0.01" name="berat_keluar_kg" value="{{ old('berat_keluar_kg', $batch->berat_keluar_kg) }}" class="border p-2 w-full mb-3">
    @error('berat_keluar_kg')
        <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
    @enderror

    <label>Tanggal Mulai</label>
    <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $batch->tanggal_mulai) }}" class="border p-2 w-full mb-3" required>
    @error('tanggal_mulai')
        <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
    @enderror

    <label>Tanggal Selesai</label>
    <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $batch->tanggal_selesai) }}" class="border p-2 w-full mb-3" required>
    @error('tanggal_selesai')
        <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
    @enderror

    <label>Status</label>
    <select name="status" class="border p-2 w-full mb-3" required>
        <option value="proses" {{ old('status', $batch->status) == 'proses' ? 'selected' : '' }}>Proses</option>
        <option value="selesai" {{ old('status', $batch->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
        <option value="dibatalkan" {{ old('status', $batch->status) == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
    </select>
    @error('status')
        <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
    @enderror

    <label>Catatan</label>
    <textarea name="catatan" class="border p-2 w-full mb-3">{{ old('catatan', $batch->catatan) }}</textarea>
    @error('catatan')
        <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
    @enderror

    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Update Batch</button>
    <a href="{{ route('admin.batches.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded ml-2">Batal</a>
</form>
@endsection
