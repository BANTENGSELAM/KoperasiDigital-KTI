<x-admin-layout title="Jadwalkan Pengambilan">

<h1 class="text-2xl font-bold mb-4">Jadwalkan Pengambilan</h1>

<form action="{{ route('member.pickups.store') }}" method="POST"
      class="bg-white p-6 rounded shadow">
    @csrf

    <label>Tanggal</label>
    <input type="date" name="tanggal" class="border p-2 w-full mb-3">

    <label>Lokasi</label>
    <input name="lokasi" class="border p-2 w-full mb-3">

    <label>Berat Perkiraan (kg)</label>
    <input name="berat_kg" type="number" step="0.1" class="border p-2 w-full mb-3">

    <label>Jenis Sampah</label>
    <input name="jenis" class="border p-2 w-full mb-3">

    <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
</form>

</x-admin-layout>
