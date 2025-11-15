@extends('layouts.public')

@section('content')

<div class="text-center py-10">
    <h1 class="text-4xl font-bold text-green-700 mb-4">Koperasi Digital</h1>
    <p class="text-lg text-gray-700 max-w-2xl mx-auto">
        Platform pengelolaan sampah dapur berbasis komunitas UMKM & restoran.
        Sampah diolah menjadi pupuk organik, dijual ke petani, dan keuntungan dibagikan kembali kepada anggota.
    </p>

    <div class="mt-6">
        <a href="{{ route('register') }}"
            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg">
            Daftar Menjadi Anggota
        </a>
    </div>
</div>

{{-- Statistik --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto mt-10">

    <div class="p-6 bg-white shadow rounded text-center">
        <h3 class="text-gray-600 font-semibold">Total Sampah Terkumpul</h3>
        <p class="text-3xl font-bold text-green-700">{{ number_format($totalSampah, 2) }} kg</p>
    </div>

    <div class="p-6 bg-white shadow rounded text-center">
        <h3 class="text-gray-600 font-semibold">Pupuk Diproduksi</h3>
        <p class="text-3xl font-bold text-blue-700">{{ number_format($totalPupuk, 2) }} kg</p>
    </div>

    <div class="p-6 bg-white shadow rounded text-center">
        <h3 class="text-gray-600 font-semibold">Total Anggota</h3>
        <p class="text-3xl font-bold text-yellow-700">{{ number_format($totalAnggota) }}</p>
    </div>

</div>

{{-- Artikel Terbaru --}}
<div class="max-w-5xl mx-auto mt-16">
    <h2 class="text-2xl font-bold mb-4">Artikel Edukasi Terbaru</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($posts as $post)
        <div class="bg-white shadow rounded p-4">
            <h3 class="font-semibold text-lg">{{ $post->judul }}</h3>
            <p class="text-sm text-gray-500 mb-3">{{ $post->created_at->format('d M Y') }}</p>
            <p class="text-gray-700 text-sm">{{ Str::limit($post->konten, 100) }}</p>

            <a href="{{ route('education.show', $post->id) }}"
               class="text-green-600 mt-2 inline-block">
                Baca Selengkapnya →
            </a>
        </div>
        @endforeach
    </div>
</div>

@endsection
