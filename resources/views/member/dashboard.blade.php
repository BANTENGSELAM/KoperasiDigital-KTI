<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Anggota Koperasi Digital') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-6xl mx-auto sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-green-50 p-4 rounded border">
                <h3 class="font-semibold mb-1">Total Kontribusi Sampah</h3>
                <p class="text-2xl font-bold text-green-700">
                    {{ number_format($totalKontribusi ?? 0, 2) }} kg
                </p>
            </div>

            <div class="bg-blue-50 p-4 rounded border">
                <h3 class="font-semibold mb-1">Total SHU Diterima</h3>
                <p class="text-2xl font-bold text-blue-700">
                    Rp {{ number_format($totalSHU ?? 0, 2) }}
                </p>
            </div>

            <div class="bg-yellow-50 p-4 rounded border">
                <h3 class="font-semibold mb-1">Profil Anggota</h3>
                <p class="text-lg font-medium text-gray-800">{{ $user->name }}</p>
                <p class="text-sm text-gray-500">{{ $user->email }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h3 class="font-semibold text-lg mb-4">Jadwal Pengambilan Sampah Terbaru</h3>

            <table class="min-w-full border text-sm text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-2">Tanggal</th>
                        <th class="border p-2">Lokasi</th>
                        <th class="border p-2">Berat (kg)</th>
                        <th class="border p-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jadwalTerbaru as $pickup)
                        <tr>
                            <td class="border p-2">{{ $pickup->tanggal ?? '-' }}</td>
                            <td class="border p-2">{{ $pickup->lokasi ?? '-' }}</td>
                            <td class="border p-2">{{ $pickup->berat ?? '-' }}</td>
                            <td class="border p-2">
                                <span class="px-2 py-1 rounded text-white
                                    {{ $pickup->status === 'selesai' ? 'bg-green-600' : 'bg-yellow-500' }}">
                                    {{ ucfirst($pickup->status ?? 'menunggu') }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-500 py-3">
                                Belum ada jadwal pengambilan sampah.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
