<x-admin-layout>

    <h1 class="text-xl font-bold mb-4">Daftar Batch Kompos</h1>

    <a href="{{ route('admin.batches.create') }}"
       class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mb-4 inline-block">
        + Batch Baru
    </a>

    <table class="w-full border text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Kode</th>
                <th class="border p-2">Pickup</th>
                <th class="border p-2">Berat Masuk</th>
                <th class="border p-2">Tanggal Mulai</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($batches as $b)
                <tr>
                    <td class="border p-2">{{ $b->kode_batch }}</td>
                    <td class="border p-2">
                        @if ($b->pickup)
                            Pickup #{{ $b->pickup->id }} — {{ $b->pickup->lokasi }}
                        @else
                            <span class="text-gray-500 italic">Tidak ada</span>
                        @endif
                    </td>
                    <td class="border p-2">{{ $b->berat_masuk_kg }} kg</td>
                    <td class="border p-2">{{ $b->tgl_mulai }}</td>
                    <td class="border p-2">{{ ucfirst($b->status) }}</td>

                    <td class="border p-2 flex gap-2">
                        <a href="{{ route('admin.batches.edit', $b->id) }}"
                           class="px-3 py-1 bg-blue-500 text-white rounded">Edit</a>

                        <form action="{{ route('admin.batches.destroy', $b->id) }}" method="POST"
                              onsubmit="return confirm('Hapus batch ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 bg-red-600 text-white rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="border p-2 text-center text-gray-500">
                        Belum ada data batch.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</x-admin-layout>
