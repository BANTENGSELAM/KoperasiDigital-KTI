@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold mb-4">Buat Batch Kompos Baru</h2>

<form method="POST" action="{{ route('admin.batches.store') }}" class="bg-white p-6 rounded shadow max-w-xl">
    @csrf

    {{-- KODE BATCH --}}
    <label class="block mb-3">
        <span class="font-semibold">Kode Batch</span>
        <input type="text" name="kode_batch" value="{{ old('kode_batch') }}" 
               class="w-full border p-2 rounded" required>
    </label>

    {{-- BERAT MASUK --}}
    <label class="block mb-3">
        <span class="font-semibold">Berat Masuk (kg)</span>
        <input type="number" step="0.01" name="berat_masuk_kg" value="{{ old('berat_masuk_kg') }}"
               class="w-full border p-2 rounded" required>
    </label>

    {{-- BERAT KELUAR --}}
    <label class="block mb-3">
        <span class="font-semibold">Berat Keluar (kg)</span>
        <input type="number" step="0.01" name="berat_keluar_kg" value="{{ old('berat_keluar_kg') }}"
               class="w-full border p-2 rounded">
        <small class="text-gray-500">Opsional — diisi setelah proses selesai</small>
    </label>

    {{-- TANGGAL MULAI --}}
    <label class="block mb-3">
        <span class="font-semibold">Tanggal Mulai</span>
        <input type="date" name="tgl_mulai" value="{{ old('tgl_mulai') }}"
               class="w-full border p-2 rounded" required>
    </label>

    {{-- TANGGAL SELESAI --}}
    <label class="block mb-3">
        <span class="font-semibold">Tanggal Selesai</span>
        <input type="date" name="tgl_selesai" value="{{ old('tgl_selesai') }}"
               class="w-full border p-2 rounded">
        <small class="text-gray-500">Opsional — diisi setelah proses kompos selesai</small>
    </label>

    {{-- STATUS --}}
    <label class="block mb-3">
        <span class="font-semibold">Status</span>
        <select name="status" class="w-full border p-2 rounded" required>
            <option value="proses" {{ old('status') == 'proses' ? 'selected' : '' }}>Proses</option>
            <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            <option value="dibatalkan" {{ old('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
        </select>
    </label>

    {{-- KETERANGAN --}}
    <label class="block mb-3">
        <span class="font-semibold">Keterangan</span>
        <textarea name="keterangan" class="w-full border p-2 rounded" rows="3">{{ old('keterangan') }}</textarea>
    </label>

    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        Simpan Batch
    </button>
</form>
@endsection
