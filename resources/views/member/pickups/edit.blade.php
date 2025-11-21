@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Edit Jadwal Pickup</h1>

        {{-- Alert Messages --}}
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Form Edit Pickup --}}
        <form action="{{ route('member.pickups.update', $pickup->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Lokasi Pickup <span class="text-red-500">*</span></label>
                <input type="text" 
                       name="lokasi" 
                       value="{{ old('lokasi', $pickup->lokasi) }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" 
                       required>
                @error('lokasi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Tanggal Pickup <span class="text-red-500">*</span></label>
                <input type="date" 
                       name="tanggal" 
                       value="{{ old('tanggal', $pickup->tanggal) }}" 
                       min="{{ now()->format('Y-m-d') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" 
                       required>
                @error('tanggal')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Catatan <span class="text-gray-500 text-sm">(Opsional)</span></label>
                <textarea name="catatan" 
                          rows="3" 
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('catatan', $pickup->catatan) }}</textarea>
                @error('catatan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Info Box --}}
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 mb-6">
                <p class="text-yellow-900 font-medium text-sm">⚠️ Perhatian</p>
                <p class="text-yellow-700 text-sm mt-1">
                    Anda hanya bisa mengedit pickup yang masih berstatus "Dijadwalkan". Setelah petugas mengambil tugas, pickup tidak bisa diubah.
                </p>
            </div>

            {{-- Buttons --}}
            <div class="flex gap-3">
                <button type="submit" 
                        class="flex-1 bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition">
                    💾 Simpan Perubahan
                </button>
                <a href="{{ route('member.pickups.index') }}" 
                   class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
