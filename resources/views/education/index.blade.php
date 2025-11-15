@extends('layouts.public')

@section('content')

<h1 class="text-3xl font-bold mb-6">Edukasi Publik</h1>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
@foreach($posts as $p)
    <div class="bg-white shadow p-4 rounded">
        <h3 class="font-semibold text-lg">{{ $p->judul }}</h3>
        <p class="text-gray-500 text-sm">{{ $p->created_at->format('d M Y') }}</p>
        <p class="mt-2 text-gray-700">{{ Str::limit($p->konten, 150) }}</p>

        <a href="{{ route('education.show', $p->id) }}"
            class="text-green-600 mt-3 inline-block">
            Baca Selengkapnya →
        </a>
    </div>
@endforeach
</div>

{{ $posts->links() }}

@endsection
