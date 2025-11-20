<x-admin-layout title="SHU">

<h1 class="text-2xl font-bold mb-4">Perhitungan SHU</h1>

<form action="{{ route('admin.shu.calculate') }}" method="POST">
    @csrf
    <button class="bg-green-600 text-white px-4 py-2 rounded">Hitung Ulang SHU</button>
</form>

<a href="{{ route('admin.shu.pdf') }}" 
   class="bg-blue-600 text-white px-4 py-2 rounded inline-block mt-2">Unduh PDF</a>

<table class="w-full bg-white mt-6 border">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2 border">Nama</th>
            <th class="p-2 border">Kontribusi (kg)</th>
            <th class="p-2 border">SHU Diterima</th>
        </tr>
    </thead>

    <tbody>
        @foreach($distributions as $d)
        <tr>
            <td class="border p-2">{{ $d->user->name }}</td>
            <td class="border p-2">{{ $d->kontribusi }}</td>
            <td class="border p-2">Rp {{ number_format($d->jumlah_diterima, 0) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</x-admin-layout>
