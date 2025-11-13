<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Koperasi Digital</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex">
        <aside class="w-64 bg-green-700 text-white min-h-screen p-4">
            <h1 class="font-bold text-lg mb-4">Admin Panel</h1>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}" class="block py-2">Dashboard</a></li>
                <li><a href="{{ route('pickups.index') }}" class="block py-2">Data Pengambilan</a></li>
                <li><a href="{{ route('sales.index') }}" class="block py-2">Penjualan Pupuk</a></li>
                <li><a href="{{ route('distributions.index') }}" class="block py-2">Distribusi SHU</a></li>
                <li><a href="{{ route('logout') }}" class="block py-2 text-red-300">Logout</a></li>
            </ul>
        </aside>
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
