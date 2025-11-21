@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Manajemen Pickup Sampah</h1>

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

    {{-- Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-blue-50 p-4 rounded-lg">
            <p class="text-blue-600 text-sm font-medium">Total Pickup</p>
            <p class="text-3xl font-bold text-blue-900">{{ $pickups->count() }}</p>
        </div>
        <div class="bg-yellow-50 p-4 rounded-lg">
            <p class="text-yellow-600 text-sm font-medium">Pending</p>
            <p class="text-3xl font-bold text-yellow-900">{{ $pickupPending }}</p>
        </div>
        <div class="bg-green-50 p-4 rounded-lg">
            <p class="text-green-600 text-sm font-medium">Selesai</p>
            <p class="text-3xl font-bold text-green-900">{{ $pickups->where('status', 'selesai')->count() }}</p>
        </div>
    </div>

    {{-- Tabel Pickup --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($pickups->count() > 0)
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">UMKM</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Petugas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Berat (kg)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Foto</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($pickups as $p)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 text-sm">{{ $p->user->name ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm">{{ $p->lokasi }}</td>
                    <td class="px-6 py-4 text-sm">
                        @if($p->petugas_id)
                            {{ $p->petugas->name ?? '-' }}
                        @else
                            {{-- Form Assign Petugas --}}
                            <form action="{{ route('admin.pickups.assign', $p->id) }}" method="POST" class="flex gap-2">
                                @csrf
                                <select name="petugas_id" class="text-xs border rounded px-2 py-1">
                                    <option value="">Pilih Petugas</option>
                                    @foreach($petugasList as $petugas)
                                        <option value="{{ $petugas->id }}">{{ $petugas->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="text-xs bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">
                                    Assign
                                </button>
                            </form>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($p->status == 'selesai')
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">✅ Selesai</span>
                        @elseif($p->status == 'diambil')
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">📸 Diambil</span>
                        @elseif($p->status == 'dijadwalkan')
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">📅 Dijadwalkan</span>
                        @else
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-semibold">{{ $p->status }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm">{{ $p->berat_kg ? number_format($p->berat_kg, 2) . ' kg' : '-' }}</td>
                    <td class="px-6 py-4 text-sm">
                        @if($p->bukti_foto)
                            <a href="{{ asset('storage/' . $p->bukti_foto) }}" target="_blank" class="text-blue-600 hover:underline">
                                Lihat Foto
                            </a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @if($p->status == 'diambil' && $p->bukti_foto && $p->berat_kg)
                            {{-- Confirm Selesai --}}
                            <form action="{{ route('admin.pickups.confirm', $p->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-green-600 hover:text-green-900 font-semibold">
                                    ✓ Konfirmasi
                                </button>
                            </form>
                        @elseif($p->status == 'dijadwalkan')
                            {{-- Batal --}}
                            <form action="{{ route('admin.pickups.reject', $p->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin batalkan pickup?')">
                                    Batal
                                </button>
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
            Belum ada pickup request dari UMKM.
        </div>
        @endif
    </div>

    {{-- Info Alur --}}
    <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
        <p class="text-blue-900 font-medium">💡 Alur Pickup</p>
        <ol class="text-blue-700 text-sm mt-2 list-decimal list-inside space-y-1">
            <li>UMKM request pickup → status "Dijadwalkan"</li>
            <li>Admin assign ke petugas</li>
            <li>Petugas upload foto & berat → status "Diambil"</li>
            <li>Admin lihat foto & confirm → status "Selesai" + Contribution tercatat</li>
        </ol>
    </div>
</div>
@endsection
