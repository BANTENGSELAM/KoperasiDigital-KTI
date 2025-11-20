@props(['title'=>'Admin Panel'])
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">
    <aside class="w-64 bg-green-700 text-white p-6">
        <h2 class="text-xl font-bold mb-6">Koperasi Digital</h2>

        <nav class="space-y-2 text-sm">
            <a href="{{ route('admin.dashboard') }}" class="block hover:text-gray-200">Dashboard</a>
            <a href="{{ route('admin.anggota.index') }}" class="block hover:text-gray-200">Anggota</a>
            <a href="{{ route('admin.batches.index') }}" class="block hover:text-gray-200">Batch Kompos</a>
            <a href="{{ route('admin.sales.index') }}" class="block hover:text-gray-200">Penjualan</a>
            <a href="{{ route('admin.shu.index') }}" class="block hover:text-gray-200">SHU</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="mt-4 text-red-300">Logout</button>
            </form>
        </nav>
    </aside>

    <main class="flex-1 p-6">
        <div class="max-w-7xl mx-auto">
            {{ $slot }}
        </div>
    </main>
</div>

</body>
</html>
