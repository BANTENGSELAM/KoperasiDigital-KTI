<x-admin-layout title="Dashboard UMKM">
    <h1 class="text-xl mb-4">Dashboard UMKM</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class="bg-white p-4 rounded">Total Kontribusi: <strong>{{ $totalKontribusi ?? 0 }} kg</strong></div>
        <div class="bg-white p-4 rounded">Total SHU: <strong>Rp {{ number_format($totalSHU ?? 0,0) }}</strong></div>
    </div>

    <a href="{{ route('member.pickups.create') }}" class="bg-green-600 text-white px-3 py-1 rounded">Jadwalkan Pickup</a>

    <h2 class="mt-6 mb-2">Jadwal Terbaru</h2>
    <table class="bg-white w-full">
        <thead class="bg-gray-100"><tr><th class="p-2">Tanggal</th><th class="p-2">Lokasi</th><th class="p-2">Berat</th><th class="p-2">Status</th></tr></thead>
        <tbody>@foreach($jadwal as $j)<tr><td class="p-2">{{ $j->tanggal }}</td><td class="p-2">{{ $j->lokasi }}</td><td class="p-2">{{ $j->berat_kg }} kg</td><td class="p-2">{{ $j->status }}</td></tr>@endforeach</tbody>
    </table>
</x-admin-layout>
