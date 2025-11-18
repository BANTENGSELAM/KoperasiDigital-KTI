@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Buat Batch Kompos</h1>

<form action="{{ route('admin.batches.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label class="font-semibold">Kode Batch</label>
        <input type="text" name="kode_batch" class="border rounded w-full p-2" required>
    </div>

    <div>
        <label class="font-semibold">Pickup (Sumber Sampah)</label>
        <select name="pickup_id" class="border rounded w-full p-2" required>
            <option value="">-- Pilih Pickup --</option>
            @foreach($pickups as $p)
                <option value="{{ $p->id }}">
                    {{ $p->lokasi }} - {{ $p->tanggal }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="font-semibold">Berat Masuk (kg)</label>
        <input type="number" name="berat_masuk" step="0.1" class="border rounded w-full p-2" required>
    </div>

    <div>
        <label class="font-semibold">Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai" class="border rounded w-full p-2" required>
    </div>

    <div>
        <label class="font-semibold">Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai" class="border rounded w-full p-2">
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
