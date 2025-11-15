@extends('layouts.admin') 

@section('content')
<h1 class="text-2xl font-bold mb-4">Dashboard Petugas</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="p-4 bg-white rounded shadow">
        <h3 class="text-gray-600">Total Pengambilan</h3>
        <p class="text-3xl font-bold text-green-700">{{ $totalPickups }}</p>
    </div>

    <div class="p-4 bg-white rounded shadow">
        <h3 class="text-gray-600">Total Penjualan</h3>
        <p class="text-3xl font-bold text-blue-700">Rp {{ number_format($totalSales, 0) }}</p>
    </div>

    <div class="p-4 bg-white rounded shadow">
        <h3 class="text-gray-600">Total SHU Dibagikan</h3>
        <p class="text-3xl font-bold text-yellow-700">Rp {{ number_format($totalSHU, 0) }}</p>
    </div>

</div>
@endsection
