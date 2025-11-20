<x-admin-layout title="Dashboard Admin">
    <h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="p-4 bg-white rounded shadow">
            <h3>Total Sampah (kg)</h3>
            <div class="text-2xl font-bold">{{ number_format($totalSampah ?? 0,2) }}</div>
        </div>
        <div class="p-4 bg-white rounded shadow">
            <h3>Total Penjualan</h3>
            <div class="text-2xl font-bold">Rp {{ number_format($totalPenjualan ?? 0,0) }}</div>
        </div>
        <div class="p-4 bg-white rounded shadow">
            <h3>Total SHU</h3>
            <div class="text-2xl font-bold">Rp {{ number_format($totalSHU ?? 0,0) }}</div>
        </div>
    </div>
</x-admin-layout>
