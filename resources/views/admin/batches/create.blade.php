<x-admin-layout title="Buat Batch">

<h1 class="text-xl font-bold mb-4">Buat Batch Kompos</h1>

<form action="{{ route('admin.batches.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label>Kode Batch</label>
        <input name="kode_batch" class="w-full border p-2" required>
    </div>

    <div>
        <label>Pilih Pickup</label>
        <select name="pickup_id" class="w-full border p-2" required>
            <option value="">-- Pilih Pickup --</option>
            @foreach($pickups as $p)
                <option value="{{ $p->id }}">
                    {{ $p->tanggal }} — {{ $p->berat_kg }} kg
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Berat Masuk (kg)</label>
        <input name="berat_masuk_kg" type="number" step="0.01" class="w-full border p-2" required>
    </div>

    <div>
        <label>Tanggal Mulai</label>
        <input type="date" name="tgl_mulai" class="w-full border p-2" required>
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
</form>

</x-admin-layout>
