<x-app-layout>
    <div class="max-w-3xl mx-auto py-8">
        <h2 class="text-2xl font-semibold mb-4">Tulis Artikel Baru</h2>

        <form method="POST" action="{{ route('education.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block mb-1 font-medium">Judul</label>
                <input type="text" name="judul" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Thumbnail (Opsional)</label>
                <input type="file" name="thumbnail" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Konten</label>
                <textarea name="konten" rows="8" class="w-full border rounded p-2" required></textarea>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>
