<x-admin-layout title="Dashboard UMKM">

<h1 class="text-2xl font-bold mb-6">Dashboard UMKM</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-gray-600">Total Kontribusi</h3>
        <p class="text-3xl font-bold text-green-700">{{ $totalKontribusi }} kg</p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-gray-600">Total SHU</h3>
        <p class="text-3xl font-bold text-blue-700">Rp {{ number_format($totalSHU,0,',','.') }}</p>
    </div>

</div>

<h2 class="text-xl font-semibold mt-8 mb-4">Jadwal Pengambilan Terbaru</h2>

<a href="{{ route('member.pickups.create') }}"
   class="bg-green-600 text-white px-4 py-2 rounded">Jadwalkan Pengambilan</a>

<div class="bg-white p-4 mt-4 rounded shadow">
    <table class="min-w-full text-sm border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Tanggal</th>
                <th class="border p-2">Lokasi</th>
                <th class="border p-2">Berat</th>
                <th class="border p-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwal as $j)
            <tr>
                <td class="border p-2">{{ $j->tanggal }}</td>
                <td class="border p-2">{{ $j->lokasi }}</td>
                <td class="border p-2">{{ $j->berat_kg }}</td>
                <td class="border p-2">{{ $j->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</x-admin-layout>
