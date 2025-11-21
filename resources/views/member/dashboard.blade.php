@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard Restoran</h1>

    {{-- Transparansi Info Cards - Design Konsisten --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        {{-- Total Sampah Disetor --}}
        <div class="bg-gradient-to-br from-green-500 to-green-600 p-6 rounded-lg shadow-lg text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium uppercase">Total Sampah Disetor</p>
                    <p class="text-3xl font-bold mt-2">{{ number_format($totalKontribusi, 2) }} <span class="text-lg">kg</span></p>
                    <p class="text-green-100 text-xs mt-1">Kontribusi Anda ke sistem</p>
                </div>
                <div class="text-5xl opacity-20">♻️</div>
            </div>
        </div>

        {{-- Total SHU Diterima --}}
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-6 rounded-lg shadow-lg text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium uppercase">Total SHU Diterima</p>
                    <p class="text-3xl font-bold mt-2">Rp {{ number_format($totalSHU, 0, ',', '.') }}</p>
                    <p class="text-orange-100 text-xs mt-1">Pembagian keuntungan</p>
                </div>
                <div class="text-5xl opacity-20">💰</div>
            </div>
        </div>

        {{-- Pickup Bulan Ini --}}
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-lg shadow-lg text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium uppercase">Pickup Bulan Ini</p>
                    <p class="text-3xl font-bold mt-2">{{ $pickupBulanIni }}</p>
                    <p class="text-blue-100 text-xs mt-1">Jadwal pickup</p>
                </div>
                <div class="text-5xl opacity-20">📅</div>
            </div>
        </div>
    </div>

    {{-- Request Pickup Button --}}
    <div class="mb-6">
        <a href="{{ route('member.pickups.create') }}" 
           class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-lg transition">
            <span class="mr-2">+</span> Jadwalkan Pickup Sampah
        </a>
    </div>

    {{-- Pickup Terbaru --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b">
            <h3 class="font-semibold text-gray-700">Pickup Terbaru</h3>
        </div>
        
        @if($pickupTerbaru->count() > 0)
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Berat (kg)</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($pickupTerbaru as $p)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-900">{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $p->lokasi }}</td>
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
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $p->berat_kg ? number_format($p->berat_kg, 2) . ' kg' : '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="p-6 text-center text-gray-500">
            <p>Belum ada pickup. Klik tombol di atas untuk jadwalkan pickup pertama Anda!</p>
        </div>
        @endif
    </div>

    {{-- Info Transparansi --}}
    <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
        <p class="text-blue-900 font-medium">💡 Transparansi</p>
        <p class="text-blue-700 text-sm mt-1">
            Semua data sampah yang Anda setor tercatat dalam sistem. SHU dihitung berdasarkan kontribusi sampah Anda dibandingkan total sampah dari semua restoran/UMKM.
        </p>
    </div>
</div>
@endsection
