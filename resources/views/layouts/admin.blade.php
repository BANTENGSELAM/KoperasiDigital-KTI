<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex bg-gray-100">

<aside class="w-64 bg-green-700 text-white min-h-screen p-4">
    <h2 class="text-lg font-bold mb-4">Admin Panel</h2>

    <ul>
        <li><a href="{{ route('admin.dashboard') }}" class="block py-2">Dashboard</a></li>
        <li><a href="{{ route('admin.anggota.index') }}" class="block py-2">Anggota</a></li>
        <li><a href="{{ route('admin.batches.index') }}" class="block py-2">Batch Kompos</a></li>
        <li><a href="{{ route('admin.sales.index') }}" class="block py-2">Penjualan</a></li>
        <li><a href="{{ route('admin.shu.index') }}" class="block py-2">SHU</a></li>

        <li class="mt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-red-300">Logout</button>
            </form>
        </li>
    </ul>
</aside>

<main class="flex-1 p-6">
    @yield('content')
</main>

</body>
</html>
