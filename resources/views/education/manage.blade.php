@extends('layouts.edukator')

@section('content')

<h1 class="text-2xl font-bold mb-6">Kelola Artikel</h1>

<a href="{{ route('education.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Artikel Baru</a>

<div class="mt-6 bg-white p-6 shadow rounded">

    <table class="min-w-full border text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Judul</th>
                <th class="border p-2">Tanggal</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($posts as $p)
            <tr>
                <td class="border p-2">{{ $p->judul }}</td>
                <td class="border p-2">{{ $p->created_at->format('d-m-Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="2" class="p-4 text-center text-gray-500">Belum ada artikel.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
