<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan SHU Koperasi Digital') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Ringkasan SHU --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">

            <div class="bg-gray-50 p-4 rounded border">
                <h4 class="font-semibold">Total Pendapatan</h4>
                <p>Rp {{ number_format($totalPendapatan ?? 0, 2) }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded border">
                <h4 class="font-semibold">Total Pengeluaran</h4>
                <p>Rp {{ number_format($totalPengeluaran ?? 0, 2) }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded border">
                <h4 class="font-semibold">SHU Bersih</h4>
                <p>Rp {{ number_format($shuBersih ?? 0, 2) }}</p>
            </div>

        </div>

       {{-- Tombol Aksi --}}
        <div class="mb-6 flex items-center gap-2">
            <form method="POST" action="{{ route('admin.shu.calculate') }}">
                @csrf
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    Hitung Ulang SHU
                </button>
            </form>

            {{-- jika kamu mau tetap pakai link untuk PDF --}}
            <a href="{{ route('shu.pdf') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded ml-2">
                Unduh Laporan PDF
            </a>
        </div>


        {{-- Tabel Distribusi SHU --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h4 class="font-semibold mb-4">Distribusi SHU ke Anggota</h4>

            <table class="min-w-full border text-sm text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-2">Nama Anggota</th>
                        <th class="border p-2">Total Kontribusi (kg)</th>
                        <th class="border p-2">% Kontribusi</th>
                        <th class="border p-2">Jumlah Diterima</th>
                        <th class="border p-2">Periode</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($distributions as $d)
                        <tr>
                            <td class="border p-2">{{ $d->user->name ?? '-' }}</td>
                            <td class="border p-2">{{ $d->total_kontribusi }}</td>
                            <td class="border p-2">{{ $d->persentase }}%</td>
                            <td class="border p-2">Rp {{ number_format($d->jumlah_diterima, 2) }}</td>
                            <td class="border p-2">{{ $d->periode }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 py-3">
                                Belum ada data distribusi SHU.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
