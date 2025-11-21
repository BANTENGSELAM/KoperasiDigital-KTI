@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Riwayat Pickup Sampah</h1>

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

    {{-- Button Jadwal Baru --}}
    <div class="mb-6">
        <a href="{{ route('member.pickups.create') }}" 
           class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-lg transition">
            <span class="mr-2">+</span> Jadwalkan Pickup Baru
        </a>
    </div>

    {{-- Tabel Pickup --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($pickups->count() > 0)
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Berat (kg)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petugas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($pickups as $p)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $p->lokasi }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
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
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $p->berat_kg ? number_format($p->berat_kg, 2) . ' kg' : '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $p->petugas ? $p->petugas->name : '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($p->status == 'dijadwalkan')
                            {{-- Hanya bisa edit/delete jika masih dijadwalkan --}}
                            <a href="{{ route('member.pickups.edit', $p->id) }}" 
                               class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                            
                            <form action="{{ route('member.pickups.destroy', $p->id) }}" 
                                  method="POST" 
                                  class="inline"
                                  onsubmit="return confirm('Yakin ingin batalkan pickup ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Batalkan</button>
                            </form>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="p-8 text-center text-gray-500">
            <p class="mb-4">Belum ada pickup yang dijadwalkan.</p>
            <a href="{{ route('member.pickups.create') }}" 
               class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition">
                <span class="mr-2">+</span> Jadwalkan Pickup Pertama
            </a>
        </div>
        @endif
    </div>

    {{-- Info --}}
    <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
        <p class="text-blue-900 font-medium text-sm">ℹ️ Informasi</p>
        <ul class="text-blue-700 text-sm mt-2 list-disc list-inside space-y-1">
            <li>Anda hanya bisa edit/batalkan pickup yang masih berstatus "Dijadwalkan"</li>
            <li>Setelah petugas mengambil tugas, pickup tidak bisa dibatalkan</li>
            <li>Berat sampah akan diisi oleh petugas saat pickup selesai</li>
        </ul>
    </div>
</div>
@endsection
