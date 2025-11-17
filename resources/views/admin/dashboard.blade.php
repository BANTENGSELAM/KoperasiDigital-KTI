@extends('layouts.admin')

@section('content')
<h1>Catat Penjualan</h1>

<form action="{{ route('admin.sales.store') }}" method="POST">
    @csrf
    <label>Batch</label>
    <select name="batch_id">
        <option value="">-- pilih batch (yang ada pupuk) --</option>
        @foreach($batches as $b)
            <option value="{{ $b->id }}">{{ $b->kode_batch }} — {{ $b->berat_keluar_kg ?? 0 }} kg</option>
        @endforeach
    </select>
    <label>Pembeli</label><input name="pembeli" required>
    <label>Jumlah (kg)</label><input type="number" name="jumlah_kg" step="0.01" required>
    <label>Harga per kg</label><input type="number" name="harga_per_kg" step="0.01" required>
    <button>Simpan</button>
</form>
@endsection
