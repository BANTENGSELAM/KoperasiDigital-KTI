@props(['title' => 'Admin Panel'])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside class="w-64 bg-green-700 text-white p-4">
            <h2 class="text-xl font-bold mb-4">Admin Panel</h2>

            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block hover:text-gray-300">Dashboard</a>
                <a href="{{ route('admin.anggota.index') }}" class="block hover:text-gray-300">Anggota</a>
                <a href="{{ route('admin.batches.index') }}" class="block hover:text-gray-300">Batch Kompos</a>
                <a href="{{ route('admin.sales.index') }}" class="block hover:text-gray-300">Penjualan</a>
                <a href="{{ route('admin.shu.index') }}" class="block hover:text-gray-300">SHU</a>

                <form action="{{ route('logout') }}" method="POST" class="mt-4">
                    @csrf
                    <button class="text-red-300 hover:text-red-100">Logout</button>
                </form>
            </nav>
        </aside>

        <main class="flex-1 p-6">
            <div class="max-w-6xl mx-auto">
                {{ $slot }}
            </div>
        </main>

    </div>

</body>
</html>
