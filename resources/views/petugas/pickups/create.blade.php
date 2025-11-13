<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Jadwal Pengambilan') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('pickups.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block font-medium mb-1">Pilih Anggota (Restoran/UMKM)</label>
                    <select name="user_id" class="w-full border rounded p-2">
                        @foreach ($members as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Tanggal Pengambilan</label>
                    <input type="date" name="tanggal" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Lokasi</label>
                    <input type="text" name="lokasi" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Perkiraan Berat (kg)</label>
                    <input type="number" name="berat" step="0.01" class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Status</label>
                    <select name="status" class="w-full border rounded p-2">
                        <option value="menunggu">Menunggu</option>
                        <option value="proses">Proses</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>

                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
