<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Animal IQ') – {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @include('partials.theme')
    @stack('styles')
</head>
<body class="theme-bg-primary theme-text-primary min-h-screen antialiased">
    <header class="theme-bg-primary theme-header-border">
        <nav class="container mx-auto px-4 py-4 flex flex-wrap items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="text-xl font-semibold" style="background: linear-gradient(135deg, var(--orange-200), var(--orange-600)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Animal IQ</a>
            <div class="flex flex-wrap items-center gap-4">
                @include('partials.theme-toggle')
                <ul class="flex flex-wrap items-center gap-6">
<li><a href="{{ route('home') }}" class="theme-nav-link">Home</a></li>
                <li><a href="{{ route('about') }}" class="theme-nav-link">About</a></li>
                <li><a href="{{ route('programs.index') }}" class="theme-nav-link">Programs</a></li>
                <li><a href="{{ route('events.index') }}" class="theme-nav-link">Events</a></li>
                <li><a href="{{ route('research.index') }}" class="theme-nav-link">Research</a></li>
                <li><a href="{{ route('advocacy.index') }}" class="theme-nav-link">Advocacy</a></li>
                <li><a href="{{ route('blog.index') }}" class="theme-nav-link">Blog</a></li>
                <li><a href="{{ route('partnerships.index') }}" class="theme-nav-link">Partnerships</a></li>
                    <li><a href="{{ route('donations.index') }}" class="theme-link font-medium">Donate</a></li>
                    <li><a href="{{ route('store.index') }}" class="theme-nav-link">Store</a></li>
                    @auth
                        <li><a href="{{ route('community.dashboard') }}" class="theme-link font-medium">My Dashboard</a></li>
                        <li>
                            <form method="POST" action="{{ url('/logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="theme-nav-link bg-transparent border-none cursor-pointer p-0 text-left">Logout</button>
                            </form>
                        </li>
                    @else
                        @if (Route::has('login'))
                            <li><a href="{{ route('login') }}" class="theme-link font-medium">Log in</a></li>
                        @endif
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}" class="theme-btn-outline text-sm inline-block">Register</a></li>
                        @endif
                    @endauth
                </ul>
            </div>
        </nav>
    </header>
    <main class="container mx-auto px-4 py-8 theme-text-primary">
        @if (session('success'))
            <div class="mb-4 p-4 rounded theme-alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-4 p-4 rounded theme-alert-error">{{ session('error') }}</div>
        @endif
        @yield('content')
    </main>
    <footer class="theme-border border-t mt-12 py-8 theme-bg-secondary">
        <div class="container mx-auto px-4 text-center text-sm theme-text-secondary">
            &copy; {{ date('Y') }} Animal IQ. All rights reserved.
        </div>
    </footer>
    @stack('scripts')
</body>
</html>
