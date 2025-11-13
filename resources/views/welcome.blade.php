@extends('layouts.public')

@section('content')
    <section class="text-center">
        <h1 class="text-4xl font-bold text-green-700 mb-4">Selamat Datang di Koperasi Digital</h1>
        <p class="text-gray-600 max-w-2xl mx-auto mb-6">
            Kami menghubungkan restoran, UMKM, dan petani dalam ekonomi sirkular berbasis pengelolaan sampah dapur menjadi pupuk organik.
        </p>
        <a href="{{ route('register') }}" class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700">
            Bergabung Sekarang
        </a>
    </section>
@endsection
