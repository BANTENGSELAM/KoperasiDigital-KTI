<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Artikel Edukasi Anda') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto sm:px-6 lg:px-8">

        <div class="mb-4 flex justify-end">
            <a href="{{ route('education.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                + Tambah Artikel
            </a>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <table class="min-w-full border text-sm text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-2">Judul</th>
                        <th class="border p-2">Tanggal</th>
                        <th class="border p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <td class="border p-2">{{ $post->judul }}</td>
                            <td class="border p-2">{{ $post->created_at->format('d M Y') }}</td>
                            <td class="border p-2">
                                <a href="{{ route('education.show', $post->id) }}"
                                    class="text-blue-600 hover:underline">Lihat</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-gray-500 py-3">
                                Belum ada artikel yang Anda buat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
