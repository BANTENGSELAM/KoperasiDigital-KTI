@extends('layouts.petugas')

@section('content')
<h2 class="text-xl font-semibold mb-4">Daftar Pickup</h2>

<table class="w-full border">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2 border">UMKM</th>
            <th class="p-2 border">Lokasi</th>
            <th class="p-2 border">Tanggal</th>
            <th class="p-2 border">Status</th>
            <th class="p-2 border">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($pickups as $p)
        <tr>
            <td class="border p-2">{{ $p->user->name }}</td>
            <td class="border p-2">{{ $p->lokasi }}</td>
            <td class="border p-2">{{ $p->tanggal }}</td>
            <td class="border p-2">{{ ucfirst($p->status) }}</td>

            <td class="border p-2">

                <form method="POST" action="{{ route('petugas.pickups.updateStatus',$p->id) }}">
                    @csrf
                    @method('PATCH')

                    <select name="status" class="border p-1">
                        <option value="dijadwalkan">Dijadwalkan</option>
                        <option value="diambil">Diambil</option>
                        <option value="selesai">Selesai</option>
                    </select>

                    <input type="number" step="0.01" name="berat_kg"
                        placeholder="Berat akhir" class="border p-1 w-24">

                    <button class="bg-blue-600 text-white px-2 py-1">Update</button>
                </form>

                <form method="POST" action="{{ route('petugas.pickups.uploadBukti',$p->id) }}"
                      enctype="multipart/form-data" class="mt-2">
                    @csrf

                    <input type="file" name="foto" class="border p-1 w-full mb-1">

                    <button class="bg-green-600 text-white px-2 py-1 w-full">
                        Upload Bukti
                    </button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
