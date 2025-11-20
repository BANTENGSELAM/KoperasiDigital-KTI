@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h2 class="text-xl font-semibold mb-4">Dashboard Petugas</h2>
    <p class="mb-4">Klik tombol di bawah untuk melihat semua tugas pengambilan.</p>
    <a href="{{ route('petugas.pickups.index') }}" class="bg-green-600 text-white px-4 py-2 rounded">Lihat Tugas Pengambilan</a>
</div>
@endsection
