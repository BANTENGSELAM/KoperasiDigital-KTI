<x-admin-layout title="SHU">
    <h1 class="text-xl mb-4">SHU</h1>

    <form action="{{ route('admin.shu.calculate') }}" method="POST" class="inline">@csrf <button class="bg-green-600 text-white px-4 py-2 rounded">Hitung Ulang SHU</button></form>
    <a href="{{ route('admin.shu.pdf') }}" class="bg-blue-600 text-white px-4 py-2 rounded ml-2">Unduh PDF</a>

    <table class="mt-4 w-full bg-white">
        <thead class="bg-gray-100"><tr><th class="p-2">Nama</th><th class="p-2">Kontribusi (kg)</th><th class="p-2">Jumlah SHU</th></tr></thead>
        <tbody>
        @foreach($distributions as $d)
            <tr>
                <td class="p-2">{{ $d->user->name }}</td>
                <td class="p-2">{{ $d->kontribusi }}</td>
                <td class="p-2">Rp {{ number_format($d->jumlah_diterima,0,',','.') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-admin-layout>
