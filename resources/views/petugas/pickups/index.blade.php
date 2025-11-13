<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pengambilan Sampah') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="mb-4 flex justify-end">
            <a href="{{ route('pickups.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                + Tambah Pengambilan
            </a>
        </div>

        <div class="bg-white shadow rounded p-6">
            <table class="min-w-full border text-sm text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-2">Tanggal</th>
                        <th class="border p-2">Restoran/UMKM</th>
                        <th class="border p-2">Lokasi</th>
                        <th class="border p-2">Berat (kg)</th>
                        <th class="border p-2">Status</th>
                        <th class="border p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pickups as $pickup)
                        <tr>
                            <td class="border p-2">{{ $pickup->tanggal }}</td>
                            <td class="border p-2">{{ $pickup->user->name ?? '-' }}</td>
                            <td class="border p-2">{{ $pickup->lokasi }}</td>
                            <td class="border p-2">{{ $pickup->berat ?? '-' }}</td>
                            <td class="border p-2">
                                <span class="px-2 py-1 rounded text-white
                                    {{ $pickup->status == 'selesai' ? 'bg-green-600' : ($pickup->status == 'proses' ? 'bg-yellow-500' : 'bg-gray-400') }}">
                                    {{ ucfirst($pickup->status) }}
                                </span>
                            </td>
                            <td class="border p-2">
                                @if ($pickup->status !== 'selesai')
                                    <form method="POST" action="{{ route('pickups.updateStatus', $pickup->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button class="bg-blue-600 text-white px-2 py-1 rounded text-xs hover:bg-blue-700">
                                            Tandai Selesai
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">Belum ada data pengambilan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">{{ $pickups->links() }}</div>
        </div>
    </div>
</x-app-layout>
