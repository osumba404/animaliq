<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') – {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen antialiased">
    <header class="bg-white dark:bg-gray-800 shadow">
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
            <div class="mb-4 p-4 rounded bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-4 p-4 rounded bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200">{{ session('error') }}</div>
        @endif
        @yield('content')
    </div>
</body>
</html>
