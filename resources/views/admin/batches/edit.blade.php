<x-admin-layout title="Edit Batch">

<h1 class="text-xl font-bold mb-4">Edit Batch Kompos</h1>

<form action="{{ route('admin.batches.update', $batch->id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label>Kode Batch</label>
        <input name="kode_batch" class="w-full border p-2" value="{{ $batch->kode_batch }}" required>
    </div>

    <div>
        <label>Pilih Pickup</label>
        <select name="pickup_id" class="w-full border p-2" required>
            @foreach($pickups as $p)
                <option value="{{ $p->id }}" {{ $batch->pickup_id == $p->id ? 'selected' : '' }}>
                    {{ $p->tanggal }} — {{ $p->berat_kg }} kg
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Berat Masuk (kg)</label>
        <input name="berat_masuk_kg" value="{{ $batch->berat_masuk_kg }}" class="w-full border p-2">
    </div>

    <div>
        <label>Status</label>
        <select name="status" class="w-full border p-2">
            <option value="proses" {{ $batch->status=='proses'?'selected':'' }}>Proses</option>
            <option value="selesai" {{ $batch->status=='selesai'?'selected':'' }}>Selesai</option>
            <option value="dibatalkan" {{ $batch->status=='dibatalkan'?'selected':'' }}>Dibatalkan</option>
        </select>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
</form>

</x-admin-layout>
