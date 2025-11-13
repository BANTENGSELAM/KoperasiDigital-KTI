<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Petugas - Koperasi Digital</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <nav class="bg-blue-600 text-white p-4 flex justify-between">
        <div class="font-bold">Petugas Koperasi</div>
        <div>
            <a href="{{ route('pickups.index') }}" class="px-3">Pengambilan</a>
            <a href="{{ route('logout') }}" class="px-3 text-red-200">Logout</a>
        </div>
    </nav>

    <main class="p-6">
        @yield('content')
    </main>
</body>
</html>
