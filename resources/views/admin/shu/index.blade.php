<x-admin-layout title="SHU">

<h1 class="text-2xl font-semibold mb-4">Pembagian SHU</h1>

<div class="mb-4">
    <a href="{{ route('admin.shu.calculate') }}"
       class="bg-green-600 text-white px-4 py-2 rounded">Hitung SHU Baru</a>

    <a href="{{ route('admin.shu.pdf') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded ml-2">Unduh PDF</a>
</div>

<div class="bg-white p-4 rounded shadow">

    <h3 class="font-bold mb-4">Hasil Perhitungan</h3>

    <table class="min-w-full border text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Anggota</th>
                <th class="border p-2">Kontribusi Sampah (kg)</th>
                <th class="border p-2">Jumlah SHU (Rp)</th>
            </tr>
        </thead>

        <tbody>
            @foreach($distributions as $d)
            <tr>
                <td class="border p-2">{{ $d->user->name }}</td>
                <td class="border p-2">{{ $d->kontribusi }}</td>
                <td class="border p-2">Rp {{ number_format($d->jumlah_diterima,0,',','.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

</x-admin-layout>
