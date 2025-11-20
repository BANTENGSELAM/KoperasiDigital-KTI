@props(['title' => 'Admin Panel'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">
    
    <aside class="w-64 bg-green-700 text-white p-4">
        <h1 class="text-xl font-bold mb-4">Admin Panel</h1>

        <ul class="space-y-2">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.anggota.index') }}">Anggota</a></li>
            <li><a href="{{ route('admin.batches.index') }}">Batch Kompos</a></li>
            <li><a href="{{ route('admin.sales.index') }}">Penjualan</a></li>
            <li><a href="{{ route('admin.shu.index') }}">SHU</a></li>
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                </form>

                <li>
                    <a href="#" class="block py-2 text-red-300"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </li>
        </ul>
    </aside>

    <main class="flex-1 p-6">
        {{ $slot }}
    </main>

</div>

</body>
</html>
