@extends('layouts.admin')

@section('content')
<h1 class="text-xl font-bold mb-4">Catat Penjualan</h1>

<form action="{{ route('admin.sales.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label>Batch</label>
        <select name="batch_id" class="border rounded p-2 w-full" required>
            @foreach($batches as $b)
                <option value="{{ $b->id }}">{{ $b->kode_batch }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Pembeli</label>
        <input type="text" name="pembeli" class="border rounded p-2 w-full" required>
    </div>

    <div>
        <label>Jumlah (kg)</label>
        <input type="number" name="jumlah_kg" class="border rounded p-2 w-full" required>
    </div>

    <div>
        <label>Harga per kg</label>
        <input type="number" name="harga_per_kg" class="border rounded p-2 w-full" required>
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
