<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Koperasi Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">

<nav class="bg-green-600 p-4 text-white flex justify-between">
    <a href="{{ route('home') }}" class="font-bold text-lg">Koperasi Digital</a>

    <div class="space-x-4">
        <a href="{{ route('home') }}">Beranda</a>
        <a href="{{ route('education.public') }}">Edukasi</a>

        @auth
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        @else
            <a href="{{ route('login') }}">Login</a>
        @endauth
    </div>
</nav>

<main class="p-6">
    @yield('content')
</main>

<footer class="py-4 text-center text-sm text-gray-500">
    © {{ date('Y') }} Koperasi Digital
</footer>

</body>
</html>
