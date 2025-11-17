@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold mb-4">Buat Batch Kompos Baru</h2>

<form action="{{ route('admin.batches.store') }}" method="POST">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div>
            <label>Kode Batch</label>
            <input type="text" name="kode_batch" class="w-full border p-2" required>
        </div>

        <div>
            <label>Pilih Pickup</label>
            <select name="pickup_id" class="w-full border p-2" required>
                <option value="">-- pilih pickup --</option>
                @foreach($pickups as $p)
                    <option value="{{ $p->id }}">
                        {{ $p->lokasi }} — {{ $p->berat }} kg ({{ $p->tanggal }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Berat Masuk (kg)</label>
            <input type="number" name="berat_masuk_kg" step="0.01" class="w-full border p-2" required>
        </div>

        <div>
            <label>Berat Keluar (kg)</label>
            <input type="number" name="berat_keluar_kg" step="0.01" class="w-full border p-2">
        </div>

        <div>
            <label>Tanggal Mulai</label>
            <input type="date" name="tgl_mulai" class="w-full border p-2" required>
        </div>

        <div>
            <label>Tanggal Selesai</label>
            <input type="date" name="tgl_selesai" class="w-full border p-2">
        </div>

        <div>
            <label>Status</label>
            <select name="status" class="w-full border p-2">
                <option value="proses">Proses</option>
                <option value="selesai">Selesai</option>
            </select>
        </div>

    </div>

    <div class="mt-4">
        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Simpan
        </button>
        <a href="{{ route('admin.batches.index') }}" class="ml-2 text-gray-600 hover:underline">
            Batal
        </a>
    </div>

</form>
@endsection
