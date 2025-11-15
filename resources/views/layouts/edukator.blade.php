<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edukator</title>
    @vite(['resources/css/app.css'])
</head>

<body class="flex">

<aside class="w-64 bg-purple-700 text-white min-h-screen p-4">
    <h2 class="font-bold text-lg mb-4">Edukator</h2>

    <ul>
        <li><a href="{{ route('education.manage') }}" class="block py-2">Kelola Artikel</a></li>
        <li><a href="{{ route('education.create') }}" class="block py-2">Buat Artikel</a></li>

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
