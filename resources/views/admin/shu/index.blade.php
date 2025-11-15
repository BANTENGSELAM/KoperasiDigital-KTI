@extends('layouts.admin')

@section('content')
<h1 class="text-xl font-bold mb-4">Distribusi SHU</h1>

<div class="mb-4">
    <a href="{{ route('admin.shu.calculate') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
        Hitung Ulang SHU
    </a>
</div>

<div class="bg-white shadow rounded p-6">
    <table class="table-auto w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Anggota</th>
                <th class="border p-2">Kontribusi Sampah</th>
                <th class="border p-2">SHU Diterima</th>
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
</div>
@endsection
