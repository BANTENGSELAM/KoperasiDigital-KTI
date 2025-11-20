<x-admin-layout title="Catat Penjualan">

<h1 class="text-xl font-bold mb-4">Catat Penjualan Baru</h1>

<form action="{{ route('admin.sales.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label>Batch (opsional)</label>
        <select name="batch_id" class="w-full border p-2">
            <option value="">Tanpa Batch</option>
            @foreach($batches as $b)
                <option value="{{ $b->id }}">{{ $b->kode_batch }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Pembeli</label>
        <input name="pembeli" class="w-full border p-2" required>
    </div>

    <div>
        <label>Jumlah (kg)</label>
        <input name="jumlah_kg" type="number" step="0.01" class="w-full border p-2" required>
    </div>

    <div>
        <label>Harga per kg</label>
        <input name="harga_per_kg" type="number" class="w-full border p-2" required>
    </div>

    <div>
        <label>Tanggal</label>
        <input name="tanggal" type="date" class="w-full border p-2" required>
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
</form>

</x-admin-layout>
