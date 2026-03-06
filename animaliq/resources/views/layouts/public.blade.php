<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Animal IQ') – {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @include('partials.theme')
    @include('partials.animations')
    @stack('styles')
</head>
<body class="theme-bg-primary theme-text-primary min-h-screen antialiased">
    <header class="theme-bg-primary theme-header-border sticky top-0 z-30">
        <nav class="container mx-auto px-4 py-3 md:py-4 flex flex-wrap items-center justify-between gap-2">
            <a href="{{ route('home') }}" class="logo-brand text-xl font-semibold shrink-0" style="background: linear-gradient(135deg, var(--orange-200), var(--orange-600)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Animal IQ</a>
            <div class="flex items-center gap-2 md:gap-4">
                @include('partials.theme-toggle')
                {{-- Desktop nav: visible from md up --}}
                <ul class="hidden md:flex flex-wrap items-center gap-4 lg:gap-6">
                    <li><a href="{{ route('home') }}" class="theme-nav-link">Home</a></li>
                    <li><a href="{{ route('about') }}" class="theme-nav-link">About</a></li>
                    <li><a href="{{ route('programs.index') }}" class="theme-nav-link">Programs</a></li>
                    <li><a href="{{ route('events.index') }}" class="theme-nav-link">Events</a></li>
                    <li><a href="{{ route('research.index') }}" class="theme-nav-link">Research</a></li>
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
                {{-- Mobile hamburger --}}
                <button type="button" class="md:hidden hamburger-btn flex flex-col justify-center gap-1.5 w-10 h-10 p-2 rounded border theme-border theme-bg-secondary" id="mobile-menu-btn" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-nav-panel">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </nav>
        {{-- Mobile nav overlay --}}
        <div class="mobile-menu-overlay md:hidden" id="mobile-menu-overlay" aria-hidden="true"></div>
        {{-- Mobile nav panel (slide-in from right) --}}
        <div class="mobile-nav-panel md:hidden py-6 px-4" id="mobile-nav-panel" role="dialog" aria-label="Navigation menu" aria-modal="true" aria-hidden="true">
            <div class="flex items-center justify-between mb-6 px-2">
                <span class="font-semibold theme-text-primary">Menu</span>
                <button type="button" class="hamburger-btn open w-10 h-10 p-2 rounded border theme-border" id="mobile-menu-close" aria-label="Close menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
            <ul class="space-y-1">
                <li><a href="{{ route('home') }}" class="mobile-nav-link block px-4 py-3 rounded-lg theme-text-primary">Home</a></li>
                <li><a href="{{ route('about') }}" class="mobile-nav-link block px-4 py-3 rounded-lg theme-text-primary">About</a></li>
                <li><a href="{{ route('programs.index') }}" class="mobile-nav-link block px-4 py-3 rounded-lg theme-text-primary">Programs</a></li>
                <li><a href="{{ route('events.index') }}" class="mobile-nav-link block px-4 py-3 rounded-lg theme-text-primary">Events</a></li>
                <li><a href="{{ route('research.index') }}" class="mobile-nav-link block px-4 py-3 rounded-lg theme-text-primary">Research</a></li>
                <li><a href="{{ route('blog.index') }}" class="mobile-nav-link block px-4 py-3 rounded-lg theme-text-primary">Blog</a></li>
                <li><a href="{{ route('partnerships.index') }}" class="mobile-nav-link block px-4 py-3 rounded-lg theme-text-primary">Partnerships</a></li>
                <li><a href="{{ route('donations.index') }}" class="mobile-nav-link block px-4 py-3 rounded-lg theme-accent font-medium">Donate</a></li>
                <li><a href="{{ route('store.index') }}" class="mobile-nav-link block px-4 py-3 rounded-lg theme-text-primary">Store</a></li>
                @auth
                    <li><a href="{{ route('community.dashboard') }}" class="mobile-nav-link block px-4 py-3 rounded-lg theme-accent font-medium">My Dashboard</a></li>
                    <li>
                        <form method="POST" action="{{ url('/logout') }}">
                            @csrf
                            <button type="submit" class="mobile-nav-link w-full text-left px-4 py-3 rounded-lg theme-text-primary">Logout</button>
                        </form>
                    </li>
                @else
                    @if (Route::has('login'))
                        <li><a href="{{ route('login') }}" class="mobile-nav-link block px-4 py-3 rounded-lg theme-accent font-medium">Log in</a></li>
                    @endif
                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}" class="mobile-nav-link block px-4 py-3 rounded-lg theme-accent font-medium">Register</a></li>
                    @endif
                @endauth
            </ul>
        </div>
    </header>
    <main class="container mx-auto px-4 py-6 md:py-8 theme-text-primary min-w-0 main-enter">
        @if (session('success'))
            <div class="mb-4 p-4 rounded theme-alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-4 p-4 rounded theme-alert-error">{{ session('error') }}</div>
        @endif
        @yield('content')
    </main>
    <footer class="theme-border border-t mt-12 py-8 theme-bg-secondary footer-enter">
        <div class="container mx-auto px-4 text-center text-sm theme-text-secondary">
            &copy; {{ date('Y') }} Animal IQ. All rights reserved.
        </div>
    </footer>
    <script>
    (function() {
        var btn = document.getElementById('mobile-menu-btn');
        var closeBtn = document.getElementById('mobile-menu-close');
        var overlay = document.getElementById('mobile-menu-overlay');
        var panel = document.getElementById('mobile-nav-panel');
        function openMenu() {
            if (!panel || !overlay) return;
            panel.classList.add('open');
            overlay.classList.add('open');
            if (btn) { btn.classList.add('open'); btn.setAttribute('aria-expanded', 'true'); btn.setAttribute('aria-label', 'Close menu'); }
            panel.setAttribute('aria-hidden', 'false');
            overlay.setAttribute('aria-hidden', 'false');
            document.body.classList.add('mobile-nav-open');
        }
        function closeMenu() {
            if (!panel || !overlay) return;
            panel.classList.remove('open');
            overlay.classList.remove('open');
            if (btn) { btn.classList.remove('open'); btn.setAttribute('aria-expanded', 'false'); btn.setAttribute('aria-label', 'Open menu'); }
            panel.setAttribute('aria-hidden', 'true');
            overlay.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('mobile-nav-open');
        }
        if (btn) btn.addEventListener('click', function() { (panel && panel.classList.contains('open')) ? closeMenu() : openMenu(); });
        if (closeBtn) closeBtn.addEventListener('click', closeMenu);
        if (overlay) overlay.addEventListener('click', closeMenu);
        document.querySelectorAll('.mobile-nav-panel a').forEach(function(a) { a.addEventListener('click', closeMenu); });
    })();
    </script>
    @stack('scripts')
</body>
</html>
