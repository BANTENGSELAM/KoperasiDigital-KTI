@extends('layouts.member')

@section('content')

<h1 class="text-2xl font-bold mb-6">Dashboard Member</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="p-4 bg-white shadow rounded">
        <h3 class="font-semibold">Total Kontribusi Sampah (kg)</h3>
        <p class="text-3xl font-bold text-green-700">{{ number_format($totalKontribusi, 2) }}</p>
    </div>

    <div class="p-4 bg-white shadow rounded">
        <h3 class="font-semibold">Total SHU Diterima</h3>
        <p class="text-3xl font-bold text-yellow-700">Rp {{ number_format($totalSHU, 0) }}</p>
    </div>

    <div class="p-4 bg-white shadow rounded">
        <h3 class="font-semibold">Pickup Terbaru</h3>
        <p class="text-xl font-bold">{{ $jadwalTerbaru->count() }} jadwal</p>
    </div>

</div>

{{-- Tabel Jadwal Pickup --}}
<div class="bg-white p-6 rounded shadow mt-6">
    <h3 class="text-lg font-semibold mb-4">Riwayat Pickup</h3>

    <table class="min-w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Tanggal</th>
                <th class="border p-2">Lokasi</th>
                <th class="border p-2">Berat</th>
                <th class="border p-2">Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($jadwalTerbaru as $p)
                <tr>
                    <td class="border p-2">{{ $p->tanggal }}</td>
                    <td class="border p-2">{{ $p->lokasi }}</td>
                    <td class="border p-2">{{ $p->berat_sampah }} kg</td>
                    <td class="border p-2">{{ ucfirst($p->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">Belum ada riwayat.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
