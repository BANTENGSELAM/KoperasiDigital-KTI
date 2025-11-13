<x-app-layout>
    <div class="max-w-6xl mx-auto py-8">
        <h2 class="text-2xl font-semibold mb-4">Artikel Edukasi & Sosialisasi</h2>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                <div class="bg-white shadow rounded p-4">
                    @if($post->thumbnail)
                        <img src="{{ asset('storage/'.$post->thumbnail) }}" class="rounded mb-3" alt="thumbnail">
                    @endif
                    <h3 class="text-lg font-bold mb-2">{{ $post->judul }}</h3>
                    <a href="{{ route('education.show', $post->id) }}" class="text-blue-600 hover:underline">Baca Selengkapnya</a>
                </div>
            @endforeach
        </div>

        <div class="mt-6">{{ $posts->links() }}</div>
    </div>
</x-app-layout>
