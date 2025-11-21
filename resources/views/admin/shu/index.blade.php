<x-admin-layout title="SHU">
    <h1 class="text-2xl font-bold mb-4">Sisa Hasil Usaha (SHU)</h1>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Info Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-blue-100 p-4 rounded-lg">
            <p class="text-sm text-gray-600">Total Pendapatan</p>
            <p class="text-xl font-bold text-blue-900">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>
        <div class="bg-green-100 p-4 rounded-lg">
            <p class="text-sm text-gray-600">Total Kontribusi</p>
            <p class="text-xl font-bold text-green-900">{{ number_format($totalKontribusiSemua, 2, ',', '.') }} kg</p>
        </div>
        <div class="bg-purple-100 p-4 rounded-lg">
            <p class="text-sm text-gray-600">Total SHU Dibagikan</p>
            <p class="text-xl font-bold text-purple-900">Rp {{ number_format($totalSHU, 0, ',', '.') }}</p>
        </div>
    </div>

    {{-- Info Auto-Calculate --}}
    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4">
        <p class="text-blue-900 font-medium text-sm">ℹ️ SHU Auto-Calculate</p>
        <p class="text-blue-700 text-sm mt-1">
            SHU dihitung otomatis setiap kali halaman ini dibuka. Ketika ada UMKM baru atau contribution baru, SHU akan di-update otomatis.
        </p>
    </div>

    {{-- Action Buttons --}}
    <div class="mb-4">
        <form action="{{ route('admin.shu.calculate') }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghitung ulang SHU? Data SHU sebelumnya akan dihapus.')">
            @csrf 
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                Hitung Ulang SHU
            </button>
        </form>
        <a href="{{ route('admin.shu.pdf') }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded ml-2">
            Unduh PDF
        </a>
    </div>

    {{-- SHU Distribution Table --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Anggota</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontribusi (kg)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Persentase</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah SHU</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @forelse($distributions as $index => $d)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $d->user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($d->kontribusi, 2, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $totalKontribusiSemua > 0 ? number_format(($d->kontribusi / $totalKontribusiSemua) * 100, 2) : 0 }}%
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600">
                        Rp {{ number_format($d->jumlah_diterima, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        Belum ada data distribusi SHU. Silakan klik "Hitung Ulang SHU" untuk menghitung distribusi.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
