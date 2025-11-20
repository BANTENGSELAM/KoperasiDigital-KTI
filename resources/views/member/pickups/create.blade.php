@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <h2 class="text-xl font-semibold mb-4">Jadwalkan Pengambilan</h2>

    <form method="POST" action="{{ route('member.pickups.store') }}">
        @csrf

        <div class="mb-3">
            <label class="block mb-1">Tanggal</label>
            <input type="date" name="tanggal" class="w-full border p-2" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Jenis Sampah</label>
            <input type="text" name="jenis" class="w-full border p-2" placeholder="Sampah dapur..." required>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Lokasi</label>
            <input type="text" name="lokasi" class="w-full border p-2" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Perkiraan Berat (kg)</label>
            <input type="number" step="0.01" name="berat_kg" class="w-full border p-2" required>
        </div>

        <div>
            <button class="bg-green-600 text-white px-4 py-2 rounded">Ajukan Pickup</button>
        </div>
    </form>
</div>
@endsection
