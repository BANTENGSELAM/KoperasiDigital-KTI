<x-admin-layout>

    <h1 class="text-xl font-bold mb-4">Buat Batch Kompos Baru</h1>

    <form action="{{ route('admin.batches.store') }}" method="POST">
        @csrf

        {{-- <div class="mb-4">
            <label class="block font-semibold">Pilih Pickup</label>
            <select name="pickup_id" class="w-full border p-2 rounded">
                <option value="">-- Pilih Pickup --</option>
                @foreach ($pickups as $p)
                    <option value="{{ $p->id }}">
                        {{ $p->id }} - {{ $p->lokasi }} ({{ $p->berat }} kg)
                    </option>
                @endforeach
            </select>
        </div> --}}

        <div class="grid grid-cols-2 gap-4">

            <div class="mb-4">
                <label class="block font-semibold">Kode Batch</label>
                <input type="text" name="kode_batch" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Berat Masuk (kg)</label>
                <input type="number" step="0.01" name="berat_masuk_kg" class="w-full border p-2 rounded" required>
            </div>

        </div>

        <div class="grid grid-cols-2 gap-4">

            <div class="mb-4">
                <label class="block font-semibold">Tanggal Mulai</label>
                <input type="date" name="tgl_mulai" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Tanggal Selesai</label>
                <input type="date" name="tgl_selesai" class="w-full border p-2 rounded">
            </div>

        </div>

        <div class="mb-4">
            <label class="block font-semibold">Status</label>
            <select name="status" class="w-full border p-2 rounded">
                <option value="proses">Proses</option>
                <option value="selesai">Selesai</option>
                <option value="dibatalkan">Dibatalkan</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Keterangan</label>
            <textarea name="keterangan" class="w-full border p-2 rounded"></textarea>
        </div>

        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Simpan Batch
        </button>

    </form>

</x-admin-layout>
