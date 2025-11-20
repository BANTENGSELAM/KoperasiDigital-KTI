<x-admin-layout title="Batch Kompos">

<h1 class="text-2xl font-bold mb-4">Daftar Batch Kompos</h1>

<a href="{{ route('admin.batches.create') }}" 
   class="bg-green-600 text-white px-4 py-2 rounded">+ Batch Baru</a>

<table class="w-full bg-white mt-4 border">
    <thead>
        <tr class="bg-gray-100">
            <th class="border p-2">Kode</th>
            <th class="border p-2">Pickup</th>
            <th class="border p-2">Berat Masuk</th>
            <th class="border p-2">Status</th>
            <th class="border p-2">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($batches as $b)
        <tr>
            <td class="border p-2">{{ $b->kode_batch }}</td>
            <td class="border p-2">{{ optional($b->pickup)->tanggal }}</td>
            <td class="border p-2">{{ $b->berat_masuk_kg }} kg</td>
            <td class="border p-2">{{ $b->status }}</td>
            <td class="border p-2">
                <a href="{{ route('admin.batches.edit', $b->id) }}" class="text-blue-600">Edit</a>
                |
                <form action="{{ route('admin.batches.destroy', $b->id) }}" method="POST" class="inline-block">
                    @csrf @method('DELETE')
                    <button class="text-red-600" onclick="return confirm('Hapus batch?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</x-admin-layout>
