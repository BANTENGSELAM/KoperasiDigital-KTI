<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Member</title>
    @vite(['resources/css/app.css'])
</head>

<body class="flex">

<aside class="w-64 bg-indigo-700 text-white min-h-screen p-4">
    <h2 class="font-bold text-lg mb-4">Member</h2>

    <ul>
        <li><a href="{{ route('member.dashboard') }}" class="block py-2">Dashboard</a></li>
        <li><a href="{{ route('member.pickups.index') }}" class="block py-2">Pickup Saya</a></li>

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
