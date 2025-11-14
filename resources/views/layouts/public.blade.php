<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koperasi Digital</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800">
    <nav class="bg-green-600 text-white p-4 flex justify-between">
        <a href="/" class="font-bold text-lg">Koperasi Digital</a>
        <div>
            <a href="{{ route('home') }}" class="px-3">Beranda</a>
            <a href="{{ route('education.public') }}" class="px-3">Edukasi</a>
            @auth
                <a href="{{ route('dashboard') }}" class="px-3">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="px-3">Login</a>
            @endauth
        </div>
    </nav>

    <main class="p-8">
        @yield('content')
    </main>

    <footer class="bg-gray-100 text-center py-4 mt-8 text-sm text-gray-600">
        © {{ date('Y') }} Koperasi Digital – Ekonomi Sirkular UMKM.
    </footer>
</body>
</html>
