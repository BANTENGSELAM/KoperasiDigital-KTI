<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catat Penjualan Pupuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.sales.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="batch_id" class="form-label">Batch</label>
                        <select name="batch_id" class="form-control" required>
                            @foreach($batches as $b)
                                <option value="{{ $b->id }}">{{ $b->kode_batch }} ({{ $b->berat_keluar_kg }} kg)</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="pembeli" class="form-label">Nama Pembeli</label>
                        <input type="text" class="form-control" name="pembeli" required>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_kg" class="form-label">Jumlah Terjual (kg)</label>
                        <input type="number" step="0.01" class="form-control" name="jumlah_kg" required>
                    </div>

                    <div class="mb-3">
                        <label for="harga_per_kg" class="form-label">Harga per Kg (Rp)</label>
                        <input type="number" step="0.01" class="form-control" name="harga_per_kg" required>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal Penjualan</label>
                        <input type="date" class="form-control" name="tanggal" required>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
