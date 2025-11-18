<x-admin-layout title="Edit Batch">

<h1 class="text-2xl font-semibold mb-4">Edit Batch</h1>

<form action="{{ route('admin.batches.update',$batch) }}"
      method="POST" class="bg-white p-6 rounded shadow">
    @csrf
    @method('PUT')

    <label>Kode Batch</label>
    <input name="kode_batch" value="{{ $batch->kode_batch }}" class="border p-2 w-full mb-3">

    <label>Pilih Pickup</label>
    <select name="pickup_id" class="border p-2 w-full mb-3">
        @foreach($pickups as $p)
            <option value="{{ $p->id }}" @selected($batch->pickup_id == $p->id)>
                {{ $p->tanggal }} — {{ $p->berat_kg }} kg
            </option>
        @endforeach
    </select>

    <label>Berat Masuk (kg)</label>
    <input name="berat_masuk_kg" type="number" step="0.01"
           class="border p-2 w-full mb-3"
           value="{{ $batch->berat_masuk_kg }}">

    <label>Berat Keluar (kg)</label>
    <input name="berat_keluar_kg" type="number" step="0.01"
           class="border p-2 w-full mb-3"
           value="{{ $batch->berat_keluar_kg }}">

    <label>Tanggal Mulai</label>
    <input name="tgl_mulai" type="date" value="{{ $batch->tgl_mulai }}"
           class="border p-2 w-full mb-3">

    <label>Tanggal Selesai</label>
    <input name="tgl_selesai" type="date" value="{{ $batch->tgl_selesai }}"
           class="border p-2 w-full mb-3">

    <label>Status</label>
    <select name="status" class="border p-2 w-full mb-3">
        <option value="proses" @selected($batch->status=='proses')>Proses</option>
        <option value="selesai" @selected($batch->status=='selesai')>Selesai</option>
        <option value="dibatalkan" @selected($batch->status=='dibatalkan')>Dibatalkan</option>
    </select>

    <label>Keterangan</label>
    <textarea name="keterangan" class="border p-2 w-full mb-3">{{ $batch->keterangan }}</textarea>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
</form>

</x-admin-layout>
