@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Batch</h1>

<form action="{{ route('admin.batches.update', $batch->id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label class="font-semibold">Kode Batch</label>
        <input type="text" name="kode_batch" class="border rounded w-full p-2"
               value="{{ $batch->kode_batch }}" required>
    </div>

    <div>
        <label class="font-semibold">Pickup</label>
        <select name="pickup_id" class="border rounded w-full p-2" required>
            @foreach($pickups as $p)
                <option value="{{ $p->id }}" {{ $batch->pickup_id == $p->id ? 'selected' : '' }}>
                    {{ $p->lokasi }} - {{ $p->tanggal }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="font-semibold">Berat Masuk (kg)</label>
        <input type="number" name="berat_masuk" step="0.1"
               value="{{ $batch->berat_masuk }}"
               class="border rounded w-full p-2" required>
    </div>

    <div>
        <label class="font-semibold">Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai"
               value="{{ $batch->tanggal_mulai }}"
               class="border rounded w-full p-2" required>
    </div>

    <div>
        <label class="font-semibold">Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai"
               value="{{ $batch->tanggal_selesai }}"
               class="border rounded w-full p-2">
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
