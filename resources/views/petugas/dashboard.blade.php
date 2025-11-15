@extends('layouts.petugas')

@section('content')

<h1 class="text-2xl font-bold mb-6">Dashboard Petugas</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="p-4 bg-white rounded shadow">
        <h3 class="font-semibold text-gray-600">Total Pickup</h3>
        <p class="text-3xl font-bold">{{ $totalPickup }}</p>
    </div>

    <div class="p-4 bg-white rounded shadow">
        <h3 class="font-semibold text-gray-600">Pickup Pending</h3>
        <p class="text-3xl font-bold text-yellow-700">{{ $pickupPending }}</p>
    </div>

    <div class="p-4 bg-white rounded shadow">
        <h3 class="font-semibold text-gray-600">Pickup Selesai</h3>
        <p class="text-3xl font-bold text-green-700">{{ $pickupSelesai }}</p>
    </div>

</div>

@endsection
