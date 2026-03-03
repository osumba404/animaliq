<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') – {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen antialiased">
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('admin.dashboard') }}" class="font-semibold">Admin</a>
            <nav class="flex gap-4">
                <a href="{{ route('home') }}" class="text-sm hover:underline" target="_blank">View Site</a>
                <form method="POST" action="{{ url('/logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm hover:underline">Logout</button>
                </form>
            </nav>
        </div>
    </header>
    <div class="container mx-auto px-4 py-8">
        @if (session('success'))
            <div class="mb-4 p-4 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-4 p-4 rounded bg-red-100 text-red-800">{{ session('error') }}</div>
        @endif
        @yield('content')
    </div>
</body>
</html>
