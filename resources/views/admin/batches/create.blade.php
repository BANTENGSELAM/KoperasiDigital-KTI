<x-admin-layout title="Buat Batch Baru">

<h1 class="text-2xl font-semibold mb-4">Buat Batch Baru</h1>

<form action="{{ route('admin.batches.store') }}"
      method="POST"
      class="bg-white p-6 rounded shadow">
    @csrf

    <label>Kode Batch</label>
    <input name="kode_batch" class="border p-2 w-full mb-3">

    <label>Pilih Pickup</label>
    <select name="pickup_id" class="border p-2 w-full mb-3">
        @foreach($pickups as $p)
            <option value="{{ $p->id }}">
                {{ $p->tanggal }} — {{ $p->berat_kg }} kg
            </option>
        @endforeach
    </select>

    <label>Berat Masuk (kg)</label>
    <input name="berat_masuk_kg" class="border p-2 w-full mb-3" type="number" step="0.01">

    <label>Berat Keluar (kg)</label>
    <input name="berat_keluar_kg" class="border p-2 w-full mb-3" type="number" step="0.01">

    <label>Tanggal Mulai</label>
    <input name="tgl_mulai" type="date" class="border p-2 w-full mb-3">

    <label>Tanggal Selesai</label>
    <input name="tgl_selesai" type="date" class="border p-2 w-full mb-3">

    <label>Status</label>
    <select name="status" class="border p-2 w-full mb-3">
        <option value="proses">Proses</option>
        <option value="selesai">Selesai</option>
        <option value="dibatalkan">Dibatalkan</option>
    </select>

    <label>Keterangan</label>
    <textarea name="keterangan" class="border p-2 w-full mb-3"></textarea>

    <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
</form>

</x-admin-layout>
