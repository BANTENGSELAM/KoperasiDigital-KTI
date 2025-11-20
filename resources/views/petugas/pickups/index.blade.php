@extends('layouts.app') {{-- atau layouts.petugas jika ada --}}

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-xl font-semibold mb-4">Daftar Pengambilan</h2>

    <div class="bg-white shadow rounded">
        <table class="min-w-full">
            <thead class="bg-gray-100 text-sm">
                <tr>
                    <th class="p-2">UMKM</th>
                    <th class="p-2">Tanggal</th>
                    <th class="p-2">Lokasi</th>
                    <th class="p-2">Berat</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pickups as $p)
                <tr class="border-b">
                    <td class="p-2">{{ optional($p->user)->name }}</td>
                    <td class="p-2">{{ $p->tanggal }}</td>
                    <td class="p-2">{{ $p->lokasi }}</td>
                    <td class="p-2">{{ $p->berat_kg ?? '-' }}</td>
                    <td class="p-2">{{ ucfirst($p->status) }}</td>
                    <td class="p-2">
                        <form method="POST" action="{{ route('petugas.pickups.updateStatus', $p->id) }}" class="inline-block">
                            @csrf
                            @method('PATCH')

                            <select name="status" class="border p-1">
                                <option value="dijadwalkan">Dijadwalkan</option>
                                <option value="diambil">Diambil</option>
                                <option value="selesai">Selesai</option>
                                <option value="dibatalkan">Dibatalkan</option>
                            </select>

                            <input type="number" step="0.01" name="berat_kg" placeholder="Berat akhir" class="border p-1 w-28 ml-2">

                            <button class="bg-blue-600 text-white px-3 py-1 ml-2 rounded">Update</button>
                        </form>

                        <form method="POST" action="{{ route('petugas.pickups.uploadBukti', $p->id) }}" enctype="multipart/form-data" class="mt-1">
                            @csrf
                            <input type="file" name="foto" class="mt-1">
                            <button class="bg-green-600 text-white px-3 py-1 mt-1 rounded">Upload Bukti</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="p-4 text-center text-gray-500">Tidak ada pickup.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
