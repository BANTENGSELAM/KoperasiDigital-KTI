@extends('layouts.admin')

@section('content')
<h2 class="text-xl mb-4 font-semibold">Edit Penjualan</h2>

<form action="{{ route('admin.sales.update', $sale) }}" method="POST" class="bg-white p-4 rounded">
    @csrf
    @method('PUT')

    <label>Pembeli</label>
    <input type="text" name="pembeli" value="{{ old('pembeli', $sale->pembeli) }}" class="border p-2 w-full mb-3" required>
    @error('pembeli')
        <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
    @enderror

    <label>Jumlah (kg)</label>
    <input type="number" step="0.01" name="jumlah_kg" value="{{ old('jumlah_kg', $sale->jumlah_kg) }}" class="border p-2 w-full mb-3" required>
    @error('jumlah_kg')
        <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
    @enderror

    <label>Harga per Kg</label>
    <input type="number" step="0.01" name="harga_per_kg" value="{{ old('harga_per_kg', $sale->harga_per_kg) }}" class="border p-2 w-full mb-3" required>
    @error('harga_per_kg')
        <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
    @enderror

    <label>Tanggal</label>
    <input type="date" name="tanggal" value="{{ old('tanggal', $sale->tanggal) }}" class="border p-2 w-full mb-3" required>
    @error('tanggal')
        <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
    @enderror

    <div class="bg-blue-50 p-3 rounded mb-3">
        <p class="text-sm text-gray-700">Total: <strong>Rp {{ number_format($sale->total, 0, ',', '.') }}</strong></p>
    </div>

    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Update Penjualan</button>
    <a href="{{ route('admin.sales.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded ml-2">Batal</a>
</form>
@endsection
