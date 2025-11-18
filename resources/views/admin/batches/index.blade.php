<x-admin-layout title="Batch Kompos">

<h1 class="text-2xl font-semibold mb-4">Batch Kompos</h1>

<a href="{{ route('admin.batches.create') }}"
   class="bg-green-600 text-white px-4 py-2 rounded">+ Batch Baru</a>

<div class="bg-white mt-4 p-4 rounded shadow">
    <table class="min-w-full border text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Kode</th>
                <th class="border p-2">Pickup</th>
                <th class="border p-2">Berat Masuk</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($batches as $b)
            <tr>
                <td class="border p-2">{{ $b->kode_batch }}</td>
                <td class="border p-2">{{ $b->pickup->tanggal ?? '-' }}</td>
                <td class="border p-2">{{ $b->berat_masuk_kg }} kg</td>
                <td class="border p-2">{{ $b->status }}</td>
                <td class="border p-2">
                    <a href="{{ route('admin.batches.edit',$b) }}" class="text-blue-600">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</x-admin-layout>
