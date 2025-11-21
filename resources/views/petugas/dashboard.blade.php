@extends('layouts.petugas')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard Petugas</h1>

    {{-- Transparansi Info Cards - Design Konsisten --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        {{-- Pickup Hari Ini --}}
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-lg shadow-lg text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium uppercase">Pickup Hari Ini</p>
                    <p class="text-3xl font-bold mt-2">{{ $pickupHariIni->count() }}</p>
                    <p class="text-blue-100 text-xs mt-1">Total jadwal hari ini</p>
                </div>
                <div class="text-5xl opacity-20">📍</div>
            </div>
        </div>

        {{-- Total Sampah Sistem (Transparansi) --}}
        <div class="bg-gradient-to-br from-green-500 to-green-600 p-6 rounded-lg shadow-lg text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium uppercase">Total Sampah Sistem</p>
                    <p class="text-3xl font-bold mt-2">{{ number_format($totalSampahSistem, 2) }} <span class="text-lg">kg</span></p>
                    <p class="text-green-100 text-xs mt-1">Dikumpulkan semua petugas</p>
                </div>
                <div class="text-5xl opacity-20">♻️</div>
            </div>
        </div>

        {{-- Total SHU Sistem (Transparansi) --}}
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-6 rounded-lg shadow-lg text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium uppercase">Total SHU Didistribusikan</p>
                    <p class="text-3xl font-bold mt-2">Rp {{ number_format($totalSHUSistem, 0, ',', '.') }}</p>
                    <p class="text-orange-100 text-xs mt-1">Ke semua UMKM</p>
                </div>
                <div class="text-5xl opacity-20">💰</div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-700">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('petugas.pickups.index') }}" 
               class="flex items-center justify-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg text-blue-600 font-medium transition">
                <span class="mr-2">📋</span> Lihat Semua Pickup
            </a>
            <a href="{{ route('petugas.pickups.index') }}?filter=today" 
               class="flex items-center justify-center p-4 bg-green-50 hover:bg-green-100 rounded-lg text-green-600 font-medium transition">
                <span class="mr-2">📍</span> Pickup Hari Ini
            </a>
        </div>
    </div>

    {{-- Pickup Hari Ini Detail --}}
    @if($pickupHariIni->count() > 0)
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b">
            <h3 class="font-semibold text-gray-700">Pickup Hari Ini ({{ $pickupHariIni->count() }})</h3>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Restoran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Petugas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($pickupHariIni as $p)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $p->lokasi }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $p->user->name ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        @if($p->petugas_id == auth()->id())
                            <span class="text-green-600 font-medium">Saya</span>
                        @else
                            {{ $p->petugas ? 'Petugas lain' : 'Belum ditugaskan' }}
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @if($p->status == 'selesai')
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Selesai</span>
                        @elseif($p->status == 'diambil')
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">Diambil</span>
                        @elseif($p->status == 'dijadwalkan')
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">Dijadwalkan</span>
                        @else
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-semibold">{{ ucfirst($p->status) }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <a href="{{ route('petugas.pickups.index') }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
        <p class="text-yellow-700">📌 Tidak ada pickup yang dijadwalkan untuk hari ini.</p>
    </div>
    @endif

    {{-- Info Transparansi --}}
    <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
        <p class="text-blue-900 font-medium">💡 Transparansi Sistem</p>
        <ul class="text-blue-700 text-sm mt-2 list-disc list-inside">
            <li>Total sampah dikumpulkan: <strong>{{ number_format($totalSampahSistem, 2) }} kg</strong></li>
            <li>Total SHU didistribusikan ke UMKM: <strong>Rp {{ number_format($totalSHUSistem, 0, ',', '.') }}</strong></li>
            <li>Semua data pickup dan SHU tercatat transparan dalam sistem</li>
        </ul>
    </div>
</div>
@endsection
