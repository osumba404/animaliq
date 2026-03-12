<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Animal IQ') – {{ config('app.name') }}</title>
    @hasSection('meta')
        @yield('meta')
    @else
        @include('partials.seo')
    @endif
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
                    <li>@include('partials.nav-link', ['route' => route('home'), 'label' => 'Home', 'icon' => 'home'])</li>
                    <li>@include('partials.nav-link', ['route' => route('about'), 'label' => 'About', 'icon' => 'about'])</li>
                    <li>@include('partials.nav-link', ['route' => route('programs.index'), 'label' => 'Programs', 'icon' => 'programs'])</li>
                    <li>@include('partials.nav-link', ['route' => route('events.index'), 'label' => 'Events', 'icon' => 'events'])</li>
                    <li>@include('partials.nav-link', ['route' => route('research.index'), 'label' => 'Research', 'icon' => 'research'])</li>
                    <li>@include('partials.nav-link', ['route' => route('blog.index'), 'label' => 'Blog', 'icon' => 'blog'])</li>
                    <li>@include('partials.nav-link', ['route' => route('donations.index'), 'label' => 'Donate', 'icon' => 'donate', 'class' => 'theme-link font-medium'])</li>
                    <li>@include('partials.nav-link', ['route' => route('store.index'), 'label' => 'Store', 'icon' => 'store'])</li>
                    @auth
                        <li>@include('partials.nav-link', ['route' => route('community.dashboard'), 'label' => 'My Dashboard', 'icon' => 'dashboard', 'class' => 'theme-link font-medium'])</li>
                        <li>
                            <form method="POST" action="{{ url('/logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="theme-nav-link bg-transparent border-none cursor-pointer p-0 text-left inline-flex items-center gap-1.5">
                                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </li>
                    @else
                        @if (Route::has('login'))
                            <li>@include('partials.nav-link', ['route' => route('login'), 'label' => 'Log in', 'icon' => 'login', 'class' => 'theme-link font-medium'])</li>
                        @endif
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}" class="theme-btn-outline text-sm inline-flex items-center gap-1.5"><svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg><span>Register</span></a></li>
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
                <li>@include('partials.nav-link', ['route' => route('home'), 'label' => 'Home', 'icon' => 'home', 'class' => 'mobile-nav-link flex items-center gap-1.5 px-4 py-3 rounded-lg theme-text-primary'])</li>
                <li>@include('partials.nav-link', ['route' => route('about'), 'label' => 'About', 'icon' => 'about', 'class' => 'mobile-nav-link flex items-center gap-1.5 px-4 py-3 rounded-lg theme-text-primary'])</li>
                <li>@include('partials.nav-link', ['route' => route('programs.index'), 'label' => 'Programs', 'icon' => 'programs', 'class' => 'mobile-nav-link flex items-center gap-1.5 px-4 py-3 rounded-lg theme-text-primary'])</li>
                <li>@include('partials.nav-link', ['route' => route('events.index'), 'label' => 'Events', 'icon' => 'events', 'class' => 'mobile-nav-link flex items-center gap-1.5 px-4 py-3 rounded-lg theme-text-primary'])</li>
                <li>@include('partials.nav-link', ['route' => route('research.index'), 'label' => 'Research', 'icon' => 'research', 'class' => 'mobile-nav-link flex items-center gap-1.5 px-4 py-3 rounded-lg theme-text-primary'])</li>
                <li>@include('partials.nav-link', ['route' => route('blog.index'), 'label' => 'Blog', 'icon' => 'blog', 'class' => 'mobile-nav-link flex items-center gap-1.5 px-4 py-3 rounded-lg theme-text-primary'])</li>
                <li>@include('partials.nav-link', ['route' => route('donations.index'), 'label' => 'Donate', 'icon' => 'donate', 'class' => 'mobile-nav-link flex items-center gap-1.5 px-4 py-3 rounded-lg theme-accent font-medium'])</li>
                <li>@include('partials.nav-link', ['route' => route('store.index'), 'label' => 'Store', 'icon' => 'store', 'class' => 'mobile-nav-link flex items-center gap-1.5 px-4 py-3 rounded-lg theme-text-primary'])</li>
                @auth
                    <li>@include('partials.nav-link', ['route' => route('community.dashboard'), 'label' => 'My Dashboard', 'icon' => 'dashboard', 'class' => 'mobile-nav-link flex items-center gap-1.5 px-4 py-3 rounded-lg theme-accent font-medium'])</li>
                    <li>
                        <form method="POST" action="{{ url('/logout') }}">
                            @csrf
                            <button type="submit" class="mobile-nav-link w-full text-left px-4 py-3 rounded-lg theme-text-primary inline-flex items-center gap-1.5">
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                @else
                    @if (Route::has('login'))
                        <li>@include('partials.nav-link', ['route' => route('login'), 'label' => 'Log in', 'icon' => 'login', 'class' => 'mobile-nav-link flex items-center gap-1.5 px-4 py-3 rounded-lg theme-accent font-medium'])</li>
                    @endif
                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}" class="mobile-nav-link flex items-center gap-1.5 px-4 py-3 rounded-lg theme-accent font-medium"><svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg><span>Register</span></a></li>
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
    <footer class="theme-border border-t mt-12 py-10 theme-bg-secondary footer-enter">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8 text-center md:text-left">
                <div>
                    <a href="{{ route('home') }}" class="font-semibold text-lg theme-accent" style="background: linear-gradient(135deg, var(--orange-200), var(--orange-600)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Animal IQ</a>
                    <p class="text-sm theme-text-secondary mt-2">Education, conservation, and community at the heart of wildlife protection.</p>
                </div>
                <div>
                    <h3 class="font-semibold theme-text-primary mb-3">Quick links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('about') }}" class="theme-nav-link">About</a></li>
                        <li><a href="{{ route('programs.index') }}" class="theme-nav-link">Programs</a></li>
                        <li><a href="{{ route('events.index') }}" class="theme-nav-link">Events</a></li>
                        <li><a href="{{ route('research.index') }}" class="theme-nav-link">Research</a></li>
                        <li><a href="{{ route('blog.index') }}" class="theme-nav-link">Blog</a></li>
                        <li><a href="{{ route('donations.index') }}" class="theme-nav-link">Donate</a></li>
                        <li><a href="{{ route('store.index') }}" class="theme-nav-link">Store</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold theme-text-primary mb-3">Get involved</h3>
                    <p class="text-sm theme-text-secondary mb-3">Support our mission through donations, partnerships, or by joining our community.</p>
                    <a href="{{ route('donations.index') }}" class="theme-btn text-sm inline-block">Donate</a>
                </div>
            </div>
            <div class="pt-6 border-t theme-border text-center text-sm theme-text-secondary">
                &copy; {{ date('Y') }} Animal IQ. All rights reserved.
            </div>
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
    @include('partials.share-script')
</body>
</html>
