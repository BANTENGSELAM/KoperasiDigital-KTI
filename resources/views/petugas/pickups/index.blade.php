<x-admin-layout title="Daftar Pickup">

<h1 class="text-2xl font-bold mb-4">Daftar Pengambilan</h1>

<div class="bg-white p-4 rounded shadow">
    <table class="min-w-full border text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Tanggal</th>
                <th class="border p-2">UMKM</th>
                <th class="border p-2">Lokasi</th>
                <th class="border p-2">Berat</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pickups as $p)
            <tr>
                <td class="border p-2">{{ $p->tanggal }}</td>
                <td class="border p-2">{{ $p->user->name }}</td>
                <td class="border p-2">{{ $p->lokasi }}</td>
                <td class="border p-2">{{ $p->berat_kg }} kg</td>
                <td class="border p-2">{{ $p->status }}</td>
                <td class="border p-2">
                    <form action="{{ route('petugas.pickups.updateStatus',$p) }}" method="POST">
                        @csrf @method('PATCH')

                        <select name="status" class="border p-1 text-sm">
                            <option value="dijadwalkan">Dijadwalkan</option>
                            <option value="diambil">Diambil</option>
                            <option value="selesai">Selesai</option>
                        </select>

                        <input name="catatan" placeholder="Catatan" class="border p-1 text-sm">

                        <button class="bg-green-600 text-white px-2 py-1 text-xs rounded">Update</button>
                    </form>

                    <form method="POST" enctype="multipart/form-data"
                          action="{{ route('petugas.pickups.uploadFoto',$p) }}" class="mt-1">
                        @csrf
                        <input type="file" name="foto_lapangan" class="text-xs">
                        <button class="bg-blue-600 text-white px-2 py-1 text-xs rounded mt-1">
                            Upload Foto
                        </button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</x-admin-layout>
