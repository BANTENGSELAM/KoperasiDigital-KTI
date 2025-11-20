<x-admin-layout title="Jadwalkan Pickup">
    <h1 class="text-xl mb-4">Jadwalkan Pengambilan</h1>

    <form action="{{ route('member.pickups.store') }}" method="POST" class="bg-white p-4 rounded">
        @csrf
        <label>Tanggal</label><input name="tanggal" type="date" class="w-full border p-2 mb-2" required>
        <label>Lokasi</label><input name="lokasi" class="w-full border p-2 mb-2" required>
        <label>Berat (kg)</label><input name="berat_kg" type="number" step="0.01" class="w-full border p-2 mb-2" required>
        <label>Jenis</label><input name="jenis" class="w-full border p-2 mb-2">
        <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</x-admin-layout>
