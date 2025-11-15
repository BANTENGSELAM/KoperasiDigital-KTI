<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koperasi Digital</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 text-gray-800">

    {{-- Navbar --}}
    <nav class="bg-green-600 text-white p-4 shadow">
        <div class="max-w-7xl mx-auto flex justify-between items-center">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="font-bold text-lg">
                Koperasi Digital
            </a>

            {{-- Menu --}}
            <div class="flex items-center space-x-4">

                <a href="{{ route('home') }}" class="hover:text-gray-200">Beranda</a>

                <a href="{{ route('education.public') }}" class="hover:text-gray-200">Edukasi</a>

                @auth
                    {{-- Tampilkan dashboard sesuai role --}}
                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-200">Dashboard</a>
                    @elseif(auth()->user()->hasRole('petugas'))
                        <a href="{{ route('petugas.dashboard') }}" class="hover:text-gray-200">Dashboard</a>
                    @elseif(auth()->user()->hasRole('restoran_umkm'))
                        <a href="{{ route('member.dashboard') }}" class="hover:text-gray-200">Dashboard</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="hover:text-gray-200">Login</a>
                @endauth

            </div>
        </div>
    </nav>

    {{-- Content --}}
    <main class="max-w-7xl mx-auto p-6">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-100 text-center py-4 mt-12 text-sm text-gray-600">
        © {{ date('Y') }} Koperasi Digital — Semua Hak Dilindungi
    </footer>

</body>
</html>
