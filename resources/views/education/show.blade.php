<x-app-layout>
    <div class="max-w-3xl mx-auto py-8">
        <h2 class="text-3xl font-semibold mb-3">{{ $post->judul }}</h2>
        <p class="text-gray-500 mb-4">Oleh: {{ $post->user->name ?? 'Edukator' }}</p>

        @if($post->thumbnail)
            <img src="{{ asset('storage/'.$post->thumbnail) }}" class="rounded mb-4" alt="thumbnail">
        @endif

        <div class="prose max-w-none">
            {!! nl2br(e($post->konten)) !!}
        </div>
    </div>
</x-app-layout>
