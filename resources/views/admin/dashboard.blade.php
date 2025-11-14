@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

    <div class="p-4 bg-white rounded shadow">
        <h3 class="font-semibold text-gray-600">Total Sampah (kg)</h3>
        <p class="text-3xl font-bold text-green-700">{{ number_format($totalSampah, 2) }}</p>
    </div>

    <div class="p-4 bg-white rounded shadow">
        <h3 class="font-semibold text-gray-600">Total Penjualan</h3>
        <p class="text-3xl font-bold text-blue-700">Rp {{ number_format($totalPenjualan, 0) }}</p>
    </div>

    <div class="p-4 bg-white rounded shadow">
        <h3 class="font-semibold text-gray-600">Total SHU Dibagikan</h3>
        <p class="text-3xl font-bold text-yellow-700">Rp {{ number_format($totalSHU, 0) }}</p>
    </div>

</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div class="bg-white p-4 rounded shadow">
        <h3 class="font-semibold text-gray-600 mb-2">Grafik Kontribusi Sampah</h3>
        <canvas id="grafikKontribusi"></canvas>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h3 class="font-semibold text-gray-600 mb-2">Grafik Penjualan Pupuk</h3>
        <canvas id="grafikPenjualan"></canvas>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const kontribusiData = @json($grafikKontribusi);
const penjualanData = @json($grafikPenjualan);

new Chart(document.getElementById('grafikKontribusi'), {
    type: 'line',
    data: {
        labels: kontribusiData.map(d => 'Bulan ' + d.bulan),
        datasets: [{
            label: 'Kontribusi Sampah (kg)',
            data: kontribusiData.map(d => d.total),
            borderWidth: 3
        }]
    }
});

new Chart(document.getElementById('grafikPenjualan'), {
    type: 'bar',
    data: {
        labels: penjualanData.map(d => 'Bulan ' + d.bulan),
        datasets: [{
            label: 'Penjualan (Rp)',
            data: penjualanData.map(d => d.total_penjualan),
            borderWidth: 3
        }]
    }
});
</script>

@endsection
