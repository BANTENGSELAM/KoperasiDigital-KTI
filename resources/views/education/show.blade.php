@extends('layouts.public')

@section('content')

<h1 class="text-3xl font-bold mb-4">{{ $post->judul }}</h1>
<p class="text-gray-500 mb-6">{{ $post->created_at->format('d M Y') }}</p>

<div class="bg-white p-6 shadow rounded leading-relaxed">
    {!! nl2br(e($post->konten)) !!}
</div>

@endsection
