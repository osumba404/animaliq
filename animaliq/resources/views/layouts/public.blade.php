<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Animal IQ') – {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen antialiased">
    <header class="border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
        <nav class="container mx-auto px-4 py-4 flex flex-wrap items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="text-xl font-semibold">Animal IQ</a>
            <ul class="flex flex-wrap items-center gap-6">
                <li><a href="{{ route('home') }}" class="hover:underline">Home</a></li>
                <li><a href="{{ route('about') }}" class="hover:underline">About</a></li>
                <li><a href="{{ route('programs.index') }}" class="hover:underline">Programs</a></li>
                <li><a href="{{ route('events.index') }}" class="hover:underline">Events</a></li>
                <li><a href="{{ route('research.index') }}" class="hover:underline">Research</a></li>
                <li><a href="{{ route('advocacy.index') }}" class="hover:underline">Advocacy</a></li>
                <li><a href="{{ route('blog.index') }}" class="hover:underline">Blog</a></li>
                <li><a href="{{ route('partnerships.index') }}" class="hover:underline">Partnerships</a></li>
                <li><a href="{{ route('donations.index') }}" class="hover:underline">Donate</a></li>
                <li><a href="{{ route('store.index') }}" class="hover:underline">Store</a></li>
                @auth
                    <li><a href="{{ route('community.dashboard') }}" class="hover:underline">My Dashboard</a></li>
                    <li>
                        <form method="POST" action="{{ url('/logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="hover:underline">Logout</button>
                        </form>
                    </li>
                @else
                    @if (Route::has('login'))
                        <li><a href="{{ route('login') }}" class="hover:underline">Log in</a></li>
                    @endif
                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}" class="hover:underline">Register</a></li>
                    @endif
                @endauth
            </ul>
        </nav>
    </header>
    <main class="container mx-auto px-4 py-8">
        @if (session('success'))
            <div class="mb-4 p-4 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-4 p-4 rounded bg-red-100 text-red-800">{{ session('error') }}</div>
        @endif
        @yield('content')
    </main>
    <footer class="border-t border-[#e3e3e0] dark:border-[#3E3E3A] mt-12 py-8">
        <div class="container mx-auto px-4 text-center text-sm text-[#706f6c]">
            &copy; {{ date('Y') }} Animal IQ. All rights reserved.
        </div>
    </footer>
    @stack('scripts')
</body>
</html>
