<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <link rel="preconnect" href="https://cdn.tailwindcss.com">
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
            <a href="{{ route('home') }}" class="logo-brand text-xl font-semibold flex items-center gap-2 shrink-0" style="background: linear-gradient(135deg, var(--orange-200), var(--orange-600)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                @php $siteLogo = \App\Models\SiteSetting::getByKey('site_logo'); @endphp
                @if($siteLogo)
                    <img src="{{ asset('storage/' . $siteLogo) }}" alt="Logo" class="h-8 w-8 object-cover rounded-full inline-block" style="-webkit-text-fill-color: initial;">
                @endif
                Animal IQ
            </a>
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
                        <li>
                            @if(in_array(auth()->user()->role, ['admin', 'super_admin']))
                                <div class="relative" id="dashboard-dropdown-wrap">
                                    <button type="button" id="dashboard-dropdown-btn" class="inline-flex items-center gap-1.5 theme-nav-link" style="background:none;border:none;cursor:pointer;padding:0;" aria-haspopup="true" aria-expanded="false">
                                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                        <span @if(request()->is('community/*')) style="color:var(--accent-orange);font-weight:600;" @endif>My Dashboard</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </button>
                                    <div id="dashboard-dropdown" class="absolute right-0 mt-1 w-48 rounded-lg border theme-border theme-bg-primary shadow-lg z-50 hidden">
                                        <a href="{{ route('community.dashboard') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm theme-text-primary hover:bg-[var(--bg-warm)] rounded-t-lg @if(request()->is('community/*')) font-semibold @endif" style="@if(request()->is('community/*')) color:var(--accent-orange); @endif">My Dashboard</a>
                                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm theme-text-primary hover:bg-[var(--bg-warm)] rounded-b-lg @if(request()->is('admin*')) font-semibold @endif" style="@if(request()->is('admin*')) color:var(--accent-orange); @endif">Admin Dashboard</a>
                                    </div>
                                </div>
                            @else
                                @include('partials.nav-link', ['route' => route('community.dashboard'), 'label' => 'My Dashboard', 'icon' => 'dashboard', 'class' => 'theme-link font-medium'])
                            @endif
                        </li>
                        <li>
                            <form method="POST" action="{{ url('/logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="theme-nav-link bg-transparent border-none cursor-pointer p-0 text-left inline-flex items-center gap-1.5">
                                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </li>
                        {{-- Bell notification icon --}}
                        <li class="relative" id="bell-wrap">
                            <button id="bell-btn" aria-label="Notifications" class="relative p-1.5 rounded-lg theme-text-secondary hover:text-[var(--accent-orange)] transition" style="background:none;border:none;cursor:pointer;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                <span id="bell-badge" class="absolute -top-1 -right-1 min-w-[18px] h-[18px] px-1 rounded-full text-white text-[10px] font-bold flex items-center justify-center hidden" style="background:var(--accent-orange);"></span>
                            </button>
                            {{-- Popup --}}
                            <div id="bell-popup" class="hidden absolute right-0 mt-2 w-80 rounded-xl border theme-border theme-bg-primary shadow-2xl z-50" style="top:100%;">
                                <div class="flex items-center justify-between px-4 py-3 border-b theme-border">
                                    <span class="font-semibold theme-text-primary text-sm">Notifications</span>
                                    <button id="bell-mark-all" class="text-xs theme-link">Mark all read</button>
                                </div>
                                <div id="bell-list" class="divide-y" style="border-color:var(--border-color);max-height:340px;overflow-y:auto;"></div>
                                <div class="px-4 py-3 border-t theme-border text-center">
                                    <a href="{{ route('notifications.index') }}" class="text-sm theme-link font-medium">View all notifications →</a>
                                </div>
                            </div>
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
                    <li>
                        @if(in_array(auth()->user()->role, ['admin', 'super_admin']))
                            <a href="{{ route('community.dashboard') }}" class="mobile-nav-link flex items-center gap-1.5 px-4 py-3 rounded-lg @if(request()->is('community/*')) font-semibold @endif" style="@if(request()->is('community/*')) color:var(--accent-orange); @endif">My Dashboard</a>
                            <a href="{{ route('admin.dashboard') }}" class="mobile-nav-link flex items-center gap-1.5 px-4 py-3 rounded-lg @if(request()->is('admin*')) font-semibold @endif" style="@if(request()->is('admin*')) color:var(--accent-orange); @endif">Admin Dashboard</a>
                        @else
                            @include('partials.nav-link', ['route' => route('community.dashboard'), 'label' => 'My Dashboard', 'icon' => 'dashboard', 'class' => 'mobile-nav-link flex items-center gap-1.5 px-4 py-3 rounded-lg theme-accent font-medium'])
                        @endif
                    </li>
                    <li>
                        <a href="{{ route('notifications.index') }}" class="mobile-nav-link flex items-center gap-1.5 px-4 py-3 rounded-lg theme-text-primary">
                            <span class="relative">
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                <span id="mobile-bell-badge" class="absolute -top-1 -right-1 min-w-[16px] h-[16px] px-0.5 rounded-full text-white text-[9px] font-bold flex items-center justify-center hidden" style="background:var(--accent-orange);"></span>
                            </span>
                            <span>Notifications</span>
                        </a>
                    </li>
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
    <script>
    (function() {
        var ddBtn = document.getElementById('dashboard-dropdown-btn');
        var dd    = document.getElementById('dashboard-dropdown');
        if (ddBtn && dd) {
            ddBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                var isHidden = dd.classList.contains('hidden');
                dd.classList.toggle('hidden', !isHidden);
                ddBtn.setAttribute('aria-expanded', String(isHidden));
            });
            document.addEventListener('click', function(e) {
                if (!ddBtn.contains(e.target) && !dd.contains(e.target)) {
                    dd.classList.add('hidden');
                    ddBtn.setAttribute('aria-expanded', 'false');
                }
            });
        }
    })();
    </script>
    @auth
    <script>
    (function() {
        var bellBtn  = document.getElementById('bell-btn');
        var bellPop  = document.getElementById('bell-popup');
        var bellList = document.getElementById('bell-list');
        var bellBadge= document.getElementById('bell-badge');
        var csrf     = document.querySelector('meta[name=csrf-token]')?.content || '';
        var icons = {
            program:  '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>',
            event:    '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>',
            post:     '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>',
            research: '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>',
        };
        var defaultIcon = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>';

        function timeAgo(dateStr) {
            var diff = Math.floor((Date.now() - new Date(dateStr)) / 1000);
            if (diff < 60)   return diff + 's ago';
            if (diff < 3600) return Math.floor(diff/60) + 'm ago';
            if (diff < 86400)return Math.floor(diff/3600) + 'h ago';
            return Math.floor(diff/86400) + 'd ago';
        }

        function loadNotifications() {
            fetch('/notifications/recent', {headers:{'Accept':'application/json','X-CSRF-TOKEN':csrf}})
                .then(r => r.json())
                .then(data => {
                    // Badge
                    var mobileBadge = document.getElementById('mobile-bell-badge');
                    if (data.unread > 0) {
                        var label = data.unread > 99 ? '99+' : data.unread;
                        bellBadge.textContent = label;
                        bellBadge.classList.remove('hidden');
                        if (mobileBadge) { mobileBadge.textContent = label; mobileBadge.classList.remove('hidden'); }
                    } else {
                        bellBadge.classList.add('hidden');
                        if (mobileBadge) mobileBadge.classList.add('hidden');
                    }
                    // List
                    if (!data.notifications.length) {
                        bellList.innerHTML = '<div class="px-4 py-6 text-center text-sm" style="color:var(--text-secondary)">No notifications yet.</div>';
                        return;
                    }
                    bellList.innerHTML = data.notifications.map(function(n) {
                        var icon = icons[n.type] || defaultIcon;
                        var unread = !n.read_at;
                        return '<div class="flex gap-3 px-4 py-3 hover:bg-[var(--bg-warm)] transition cursor-pointer notification-row" data-id="'+n.id+'" data-url="'+(n.url||'')+'" style="'+(unread?'background:var(--bg-warm);':'')+'">'
                            + '<span class="shrink-0 mt-0.5 w-7 h-7 rounded-md flex items-center justify-center" style="background:var(--bg-warm);color:var(--accent-orange);">'+icon+'</span>'
                            + '<div class="flex-1 min-w-0">'
                            + '<p class="text-sm font-'+(unread?'semibold':'normal')+' leading-snug truncate" style="color:var(--text-primary)">'+n.title+'</p>'
                            + (n.body ? '<p class="text-xs mt-0.5 line-clamp-1" style="color:var(--text-secondary)">'+n.body+'</p>' : '')
                            + '<p class="text-xs mt-1" style="color:var(--text-secondary)">'+timeAgo(n.created_at)+'</p>'
                            + '</div>'
                            + (unread ? '<span class="w-2 h-2 rounded-full shrink-0 mt-2" style="background:var(--accent-orange);"></span>' : '')
                            + '</div>';
                    }).join('');
                    // Click rows
                    bellList.querySelectorAll('.notification-row').forEach(function(row) {
                        row.addEventListener('click', function() {
                            var id  = row.dataset.id;
                            var url = row.dataset.url;
                            fetch('/notifications/'+id+'/read', {method:'POST', headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json'}});
                            if (url) window.location.href = url;
                        });
                    });
                });
        }

        if (bellBtn) {
            bellBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                var open = !bellPop.classList.contains('hidden');
                bellPop.classList.toggle('hidden', open);
                if (!open) loadNotifications();
            });
            document.addEventListener('click', function(e) {
                if (!document.getElementById('bell-wrap')?.contains(e.target)) {
                    bellPop.classList.add('hidden');
                }
            });
        }

        document.getElementById('bell-mark-all')?.addEventListener('click', function() {
            fetch('/notifications/read-all', {method:'POST', headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json'}})
                .then(() => { bellBadge.classList.add('hidden'); loadNotifications(); });
        });

        // Load badge count on page load
        loadNotifications();
    })();
    </script>
    @endauth
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var forms = document.querySelectorAll('form[method="GET"]');
        forms.forEach(function(form) {
            var sortSelect = form.querySelector('select[name="sort"]');
            var searchInput = form.querySelector('input[name="q"]');
            
            if (sortSelect) {
                sortSelect.addEventListener('change', function() {
                    form.submit();
                });
            }
            
            if (searchInput) {
                var timeout = null;
                searchInput.addEventListener('input', function() {
                    clearTimeout(timeout);
                    timeout = setTimeout(function() {
                        form.submit();
                    }, 500);
                });
                
                if (searchInput.value) {
                    var val = searchInput.value;
                    searchInput.focus();
                    searchInput.value = '';
                    searchInput.value = val;
                }
            }
        });
    });
    </script>
    @stack('scripts')
    @include('partials.share-script')
</body>
</html>
