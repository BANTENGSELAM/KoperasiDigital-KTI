@extends('layouts.member')

@section('content')
<h2 class="text-xl font-semibold mb-4">Pickup Baru</h2>

<form method="POST" action="{{ route('member.pickups.store') }}">
@csrf

<label>Tanggal</label>
<input type="date" name="tanggal" class="w-full border p-2 mb-3">

<label>Jenis Sampah</label>
<input type="text" name="jenis" class="w-full border p-2 mb-3">

<label>Lokasi</label>
<input type="text" name="lokasi" class="w-full border p-2 mb-3">

<label>Perkiraan Berat (kg)</label>
<input type="number" step="0.1" name="berat_kg" class="w-full border p-2 mb-3">

<button class="bg-green-600 text-white px-4 py-2">Ajukan Pickup</button>

@endsection
