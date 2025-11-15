<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Petugas Panel</title>
    @vite(['resources/css/app.css'])
</head>

<body class="flex">

<aside class="w-64 bg-blue-700 text-white min-h-screen p-4">
    <h2 class="font-bold text-lg mb-4">Petugas</h2>

    <ul>
        <li><a href="{{ route('petugas.dashboard') }}" class="block py-2">Dashboard</a></li>
        <li><a href="{{ route('petugas.pickups.index') }}" class="block py-2">Pengambilan</a></li>

        <li class="mt-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="text-red-400">Logout</button>
            </form>
        </li>
    </ul>
</aside>

<main class="flex-1 p-6">
    @yield('content')
</main>

</body>
</html>
