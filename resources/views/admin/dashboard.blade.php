<x-admin-layout title="Dashboard Admin">

<h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

    <div class="p-4 bg-white shadow rounded">
        <div>Total Sampah Masuk</div>
        <div class="text-3xl font-bold text-green-700">{{ number_format($totalSampah,2) }} kg</div>
    </div>

    <div class="p-4 bg-white shadow rounded">
        <div>Total Penjualan</div>
        <div class="text-3xl font-bold text-blue-600">Rp {{ number_format($totalPenjualan,0,',','.') }}</div>
    </div>

    <div class="p-4 bg-white shadow rounded">
        <div>Total SHU Dibagikan</div>
        <div class="text-3xl font-bold text-yellow-600">Rp {{ number_format($totalSHU,0,',','.') }}</div>
    </div>

</div>

<div class="bg-white p-4 rounded shadow">
    <h3 class="font-semibold mb-2">Total Anggota UMKM</h3>
    <div class="text-xl">{{ $totalAnggota }}</div>
</div>

</x-admin-layout>
