<x-admin-layout title="Dashboard Admin">
    <h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

    {{-- Info Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        {{-- Total Sampah dari Batch Compost --}}
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-lg shadow-lg text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Sampah (Batch)</p>
                    <p class="text-3xl font-bold mt-2">{{ number_format($totalSampah ?? 0, 2) }} <span class="text-lg">kg</span></p>
                    <p class="text-blue-100 text-xs mt-1">Dari semua batch compost</p>
                </div>
                <div class="text-5xl opacity-20">📦</div>
            </div>
        </div>

        {{-- Total Pupuk Dihasilkan --}}
        <div class="bg-gradient-to-br from-green-500 to-green-600 p-6 rounded-lg shadow-lg text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Total Pupuk</p>
                    <p class="text-3xl font-bold mt-2">{{ number_format($totalPupuk ?? 0, 2) }} <span class="text-lg">kg</span></p>
                    <p class="text-green-100 text-xs mt-1">Pupuk kompos siap jual</p>
                </div>
                <div class="text-5xl opacity-20">🌱</div>
            </div>
        </div>

        {{-- Total Penjualan --}}
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-6 rounded-lg shadow-lg text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Total Penjualan</p>
                    <p class="text-3xl font-bold mt-2">Rp {{ number_format($totalPenjualan ?? 0, 0, ',', '.') }}</p>
                    <p class="text-purple-100 text-xs mt-1">Pendapatan dari penjualan</p>
                </div>
                <div class="text-5xl opacity-20">💰</div>
            </div>
        </div>

        {{-- Total SHU --}}
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-6 rounded-lg shadow-lg text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium">Total SHU</p>
                    <p class="text-3xl font-bold mt-2">Rp {{ number_format($totalSHU ?? 0, 0, ',', '.') }}</p>
                    <p class="text-orange-100 text-xs mt-1">SHU yang didistribusikan</p>
                </div>
                <div class="text-5xl opacity-20">🎁</div>
            </div>
        </div>
    </div>

    {{-- Status Batch & Anggota --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        {{-- Batch Aktif (Proses) --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-gray-700 font-semibold">Batch Sedang Proses</h3>
                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">Aktif</span>
            </div>
            <p class="text-4xl font-bold text-yellow-600">{{ $batchAktif ?? 0 }}</p>
            <p class="text-gray-500 text-sm mt-1">Batch dalam pengolahan</p>
        </div>

        {{-- Batch Selesai --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-gray-700 font-semibold">Batch Selesai</h3>
                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">Siap</span>
            </div>
            <p class="text-4xl font-bold text-green-600">{{ $batchSelesai ?? 0 }}</p>
            <p class="text-gray-500 text-sm mt-1">Siap dijual</p>
        </div>

        {{-- Total Anggota --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-gray-700 font-semibold">Total Anggota</h3>
                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">UMKM</span>
            </div>
            <p class="text-4xl font-bold text-blue-600">{{ $totalAnggota ?? 0 }}</p>
            <p class="text-gray-500 text-sm mt-1">Restoran & UMKM</p>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-4 text-gray-700">Quick Actions</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.batches.create') }}" class="flex items-center justify-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg text-blue-600 font-medium transition">
                <span class="mr-2">+</span> Batch Baru
            </a>
            <a href="{{ route('admin.sales.create') }}" class="flex items-center justify-center p-4 bg-green-50 hover:bg-green-100 rounded-lg text-green-600 font-medium transition">
                <span class="mr-2">+</span> Catat Penjualan
            </a>
            <a href="{{ route('admin.shu.index') }}" class="flex items-center justify-center p-4 bg-purple-50 hover:bg-purple-100 rounded-lg text-purple-600 font-medium transition">
                <span class="mr-2">📊</span> Lihat SHU
            </a>
            <a href="{{ route('admin.anggota.create') }}" class="flex items-center justify-center p-4 bg-orange-50 hover:bg-orange-100 rounded-lg text-orange-600 font-medium transition">
                <span class="mr-2">+</span> Tambah Anggota
            </a>
        </div>
    </div>

    {{-- Info Note --}}
    <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
        <p class="text-blue-900 font-medium">ℹ️ Informasi</p>
        <p class="text-blue-700 text-sm mt-1">
            <strong>Total Sampah</strong> dihitung otomatis dari <strong>berat masuk</strong> semua batch compost. 
            Setiap kali Anda membuat atau mengubah batch, angka ini akan otomatis terupdate.
        </p>
    </div>
</x-admin-layout>
