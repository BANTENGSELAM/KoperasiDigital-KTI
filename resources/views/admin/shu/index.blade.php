@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Distribusi SHU</h1>

<div class="flex gap-3 mb-6">

    <a href="{{ route('admin.shu.calculate') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Hitung Ulang SHU
    </a>

    <a href="{{ route('admin.shu.pdf') }}"
       class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
        Unduh PDF
    </a>

</div>

<div class="bg-white shadow rounded p-6">
    <table class="min-w-full border text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Nama Anggota</th>
                <th class="border p-2">Kontribusi Sampah (kg)</th>
                <th class="border p-2">SHU Diterima</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($distributions as $item)
                <tr>
                    <td class="border p-2">{{ $item->user->name }}</td>
                    <td class="border p-2">{{ $item->kontribusi }}</td>
                    <td class="border p-2">Rp {{ number_format($item->jumlah_diterima, 0) }}</td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection
