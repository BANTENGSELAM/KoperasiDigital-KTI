@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold mb-4">Edit Batch Kompos</h2>

<form action="{{ route('admin.batches.update', $batch->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div>
            <label>Kode Batch</label>
            <input type="text" name="kode_batch"
                   value="{{ $batch->kode_batch }}"
                   class="w-full border p-2" required>
        </div>

        {{-- <div>
            <label>Pilih Pickup</label>
            <select name="pickup_id" class="w-full border p-2" required>
                @foreach($pickups as $p)
                    <option value="{{ $p->id }}"
                        @if($batch->pickup_id == $p->id) selected @endif>
                        {{ $p->lokasi }} — {{ $p->berat }} kg ({{ $p->tanggal }})
                    </option>
                @endforeach
            </select>
        </div> --}}

        <div>
            <label>Berat Masuk (kg)</label>
            <input type="number" step="0.01" name="berat_masuk_kg"
                   value="{{ $batch->berat_masuk_kg }}"
                   class="w-full border p-2" required>
        </div>

        <div>
            <label>Berat Keluar (kg)</label>
            <input type="number" step="0.01" name="berat_keluar_kg"
                   value="{{ $batch->berat_keluar_kg }}"
                   class="w-full border p-2">
        </div>

        <div>
            <label>Tanggal Mulai</label>
            <input type="date" name="tgl_mulai"
                   value="{{ $batch->tgl_mulai }}"
                   class="w-full border p-2" required>
        </div>

        <div>
            <label>Tanggal Selesai</label>
            <input type="date" name="tgl_selesai"
                   value="{{ $batch->tgl_selesai }}"
                   class="w-full border p-2">
        </div>

        <div>
            <label>Status</label>
            <select name="status" class="w-full border p-2">
                <option value="proses"  @if($batch->status == 'proses') selected @endif>Proses</option>
                <option value="selesai" @if($batch->status == 'selesai') selected @endif>Selesai</option>
            </select>
        </div>

    </div>

    <div class="mt-4">
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Update
        </button>

        <a href="{{ route('admin.batches.index') }}"
           class="ml-2 text-gray-600 hover:underline">Batal</a>
    </div>

</form>
@endsection
