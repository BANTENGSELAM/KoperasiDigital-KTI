<x-admin-layout title="Catat Penjualan">

<h1 class="text-2xl font-semibold mb-4">Catat Penjualan</h1>

<form action="{{ route('admin.sales.store') }}" method="POST"
      class="bg-white p-6 rounded shadow">
    @csrf

    <label>Pilih Batch</label>
    <select name="batch_id" class="border p-2 w-full mb-3">
        <option value="">Tanpa batch</option>
        @foreach($batches as $b)
            <option value="{{ $b->id }}">{{ $b->kode_batch }} ({{ $b->berat_keluar_kg }} kg)</option>
        @endforeach
    </select>

    <label>Pembeli</label>
    <input name="pembeli" class="border p-2 w-full mb-3">

    <label>Jumlah (kg)</label>
    <input name="jumlah_kg" type="number" step="0.1"
           class="border p-2 w-full mb-3">

    <label>Harga per kg</label>
    <input name="harga_per_kg" type="number" step="100"
           class="border p-2 w-full mb-3">

    <label>Tanggal</label>
    <input name="tanggal" type="date"
           class="border p-2 w-full mb-3">

    <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
</form>

</x-admin-layout>
