{{-- resources/views/components/admin-layout.blade.php --}}
@props(['title' => 'Admin Panel'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="flex">

        {{-- Sidebar --}}
        <aside class="w-64 bg-green-700 text-white min-h-screen p-4">
            <h1 class="font-bold text-lg mb-4">Admin Panel</h1>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}" class="block py-2">Dashboard</a></li>
                <li><a href="{{ route('admin.anggota.index') }}" class="block py-2">Anggota</a></li>
                <li><a href="{{ route('admin.batches.index') }}" class="block py-2">Batch Kompos</a></li>
                <li><a href="{{ route('admin.sales.index') }}" class="block py-2">Penjualan</a></li>
                <li><a href="{{ route('admin.shu.index') }}" class="block py-2">SHU</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="block py-2 text-left w-full text-red-300">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>

    </div>

</body>
</html>
