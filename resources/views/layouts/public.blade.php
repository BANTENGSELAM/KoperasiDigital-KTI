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
                            @auth
                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" class="px-3">Dashboard</a>

                    @elseif(auth()->user()->hasRole('petugas'))
                        <a href="{{ route('petugas.dashboard') }}" class="px-3">Dashboard</a>

                    @elseif(auth()->user()->hasRole('restoran_umkm'))
                        <a href="{{ route('member.dashboard') }}" class="px-3">Dashboard</a>

                    @elseif(auth()->user()->hasRole('edukator'))
                        <a href="{{ route('education.manage') }}" class="px-3">Dashboard</a>

                    @endif
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
