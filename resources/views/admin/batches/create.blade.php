@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Buat Batch Kompos Baru</h1>

    @if($pickupsSelesai->count() == 0)
        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 mb-4">
            <p class="text-yellow-700 font-medium">⚠️ Tidak Ada Pickup yang Siap Diproses</p>
            <p class="text-yellow-600 text-sm mt-1">
                Belum ada pickup dengan status "selesai" yang belum dibuat jadi batch. Silakan tunggu petugas menyelesaikan pickup atau admin mengkonfirmasi pickup.
            </p>
        </div>
        <a href="{{ route('admin.batches.index') }}" class="text-blue-600 hover:underline">← Kembali ke Daftar Batch</a>
    @else
    <form action="{{ route('admin.batches.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Kode Batch <span class="text-red-500">*</span></label>
            <input type="text" 
                   name="kode_batch" 
                   value="{{ old('kode_batch', 'BATCH-' . now()->format('Ymd-His')) }}" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2" 
                   required>
            @error('kode_batch')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Pilih Pickup yang Akan Diproses <span class="text-red-500">*</span></label>
            <div class="border border-gray-300 rounded-lg p-3 max-h-64 overflow-y-auto">
                @foreach($pickupsSelesai as $p)
                    <label class="flex items-start gap-3 py-2 hover:bg-gray-50 px-2 rounded">
                        <input type="checkbox" 
                               name="pickup_ids[]" 
                               value="{{ $p->id }}" 
                               class="mt-1"
                               {{ in_array($p->id, old('pickup_ids', [])) ? 'checked' : '' }}>
                        <div class="flex-1 text-sm">
                            <div class="font-medium text-gray-900">{{ $p->user->name ?? 'Unknown' }}</div>
                            <div class="text-gray-600">
                                📍 {{ $p->lokasi }} | 
                                📅 {{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }} |
                                ⚖️ {{ number_format($p->berat_kg, 2) }} kg
                            </div>
                        </div>
                    </label>
                @endforeach
            </div>
            @error('pickup_ids')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            <p class="text-gray-500 text-sm mt-1">Pilih satu atau lebih pickup untuk digabung jadi batch</p>
        </div>

        <div class="mb-4 bg-blue-50 p-3 rounded">
            <p class="text-blue-900 text-sm">
                <strong>Berat Masuk:</strong> Akan dihitung otomatis dari total berat pickup yang dipilih
            </p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Berat Keluar (kg) <span class="text-gray-500 text-sm">(Opsional, isi jika batch sudah selesai)</span></label>
            <input type="number" 
                   name="berat_keluar_kg" 
                   step="0.01"
                   value="{{ old('berat_keluar_kg') }}" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2">
            @error('berat_keluar_kg')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Tanggal Mulai <span class="text-red-500">*</span></label>
                <input type="date" 
                       name="tanggal_mulai" 
                       value="{{ old('tanggal_mulai', now()->format('Y-m-d')) }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2" 
                       required>
                @error('tanggal_mulai')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Tanggal Selesai <span class="text-red-500">*</span></label>
                <input type="date" 
                       name="tanggal_selesai" 
                       value="{{ old('tanggal_selesai', now()->addDays(30)->format('Y-m-d')) }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2" 
                       required>
                @error('tanggal_selesai')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Status <span class="text-red-500">*</span></label>
            <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                <option value="proses" {{ old('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="dibatalkan" {{ old('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Catatan</label>
            <textarea name="catatan" 
                      rows="3" 
                      class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ old('catatan') }}</textarea>
            @error('catatan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg">
                Simpan Batch
            </button>
            <a href="{{ route('admin.batches.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg">
                Batal
            </a>
        </div>
    </form>
    @endif
</div>
@endsection
