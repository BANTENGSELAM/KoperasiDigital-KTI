@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Jadwalkan Pickup Sampah</h1>

        {{-- Alert Messages --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Form Jadwal Pickup --}}
        <form action="{{ route('member.pickups.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Lokasi Pickup <span class="text-red-500">*</span></label>
                <input type="text" 
                       name="lokasi" 
                       value="{{ old('lokasi', auth()->user()->name) }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" 
                       required
                       placeholder="Contoh: Restoran Preksu, Jl. Sudirman No. 123">
                @error('lokasi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Tanggal Pickup <span class="text-red-500">*</span></label>
                <input type="date" 
                       name="tanggal" 
                       value="{{ old('tanggal', now()->addDay()->format('Y-m-d')) }}" 
                       min="{{ now()->format('Y-m-d') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" 
                       required>
                @error('tanggal')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-1">Pilih tanggal untuk pengambilan sampah</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Estimasi Berat Sampah (kg) <span class="text-gray-500 text-sm">(Opsional)</span></label>
                <input type="number" 
                       name="berat_estimasi" 
                       value="{{ old('berat_estimasi') }}" 
                       step="0.1"
                       min="0"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" 
                       placeholder="Contoh: 25.5">
                @error('berat_estimasi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-1">Perkiraan berat sampah yang akan diambil</p>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Catatan <span class="text-gray-500 text-sm">(Opsional)</span></label>
                <textarea name="catatan" 
                          rows="3" 
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                          placeholder="Catatan tambahan, misal: lokasi parkir, jam operasional, dll.">{{ old('catatan') }}</textarea>
                @error('catatan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Info Box --}}
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                <p class="text-blue-900 font-medium text-sm">ℹ️ Informasi</p>
                <ul class="text-blue-700 text-sm mt-2 list-disc list-inside space-y-1">
                    <li>Jadwal pickup akan diproses oleh admin</li>
                    <li>Petugas akan datang sesuai jadwal yang dipilih</li>
                    <li>Anda akan menerima notifikasi saat petugas mengambil tugas</li>
                    <li>Berat sampah akan ditimbang saat pickup</li>
                </ul>
            </div>

            {{-- Buttons --}}
            <div class="flex gap-3">
                <button type="submit" 
                        class="flex-1 bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition">
                    📅 Jadwalkan Pickup
                </button>
                <a href="{{ route('member.dashboard') }}" 
                   class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
