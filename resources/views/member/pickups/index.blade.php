@extends('layouts.app') {{-- sesuaikan layout yang kamu pakai, atau gunakan x-admin-layout jika ada --}}

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h2 class="text-xl font-semibold mb-4">Riwayat Pengambilan Saya</h2>

    <a href="{{ route('member.pickups.create') }}" class="bg-green-600 text-white px-3 py-2 rounded">+ Jadwalkan Pickup</a>

    <div class="mt-4 bg-white shadow rounded">
        <table class="min-w-full">
            <thead class="bg-gray-100 text-sm">
                <tr>
                    <th class="p-2">Tanggal</th>
                    <th class="p-2">Berat (kg)</th>
                    <th class="p-2">Lokasi</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Bukti</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pickups as $p)
                <tr class="border-b">
                    <td class="p-2">{{ $p->tanggal }}</td>
                    <td class="p-2">{{ $p->berat_kg }} kg</td>
                    <td class="p-2">{{ $p->lokasi }}</td>
                    <td class="p-2">{{ ucfirst($p->status) }}</td>
                    <td class="p-2">
                        @if($p->bukti_foto)
                            <a target="_blank" href="{{ asset('storage/' . $p->bukti_foto) }}" class="text-blue-600">Lihat</a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">Belum ada pickup.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
