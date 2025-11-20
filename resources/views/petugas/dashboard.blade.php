@extends('layouts.petugas')

@section('content')
<h2 class="text-xl font-semibold mb-4">Dashboard Petugas</h2>

<p class="mb-4 text-gray-600">
Tugas hari ini: cek pickup UMKM dan unggah bukti setelah pengambilan selesai.
</p>

<a href="{{ route('petugas.pickups.index') }}" class="bg-green-600 px-4 py-2 text-white">
Lihat Tugas Pengambilan
</a>
@endsection
