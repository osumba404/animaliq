<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') – {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @include('partials.theme')
    <style>
        .admin-sidebar { background: var(--bg-secondary); border-right: 1px solid var(--border-color); }
        .admin-sidebar a, .admin-sidebar button { color: var(--text-secondary); text-decoration: none; background: none; border: none; cursor: pointer; font: inherit; }
        .admin-sidebar a:hover, .admin-sidebar a.active, .admin-sidebar button:hover { background: var(--bg-warm); color: var(--accent-orange); }
        .admin-sidebar .group-label { color: var(--text-secondary); }
    </style>
</head>
<body class="theme-bg-primary theme-text-primary min-h-screen antialiased flex">
    <aside class="w-64 min-h-screen admin-sidebar flex flex-col shrink-0">
        <div class="p-4 theme-header-border">
            <a href="{{ route('admin.dashboard') }}" class="font-semibold theme-accent text-lg">Admin</a>
        </div>
        <nav class="p-2 flex-1 overflow-y-auto">
            <ul class="space-y-0.5">
                <li><a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded @if(request()->routeIs('admin.dashboard')) active @endif">Dashboard</a></li>
                <li class="pt-2 mt-2 border-t theme-border"><span class="px-3 text-xs font-semibold group-label uppercase">Content</span></li>
                <li><a href="{{ route('admin.departments.index') }}" class="block px-3 py-2 rounded @if(request()->routeIs('admin.departments.*')) active @endif">Departments</a></li>
                <li><a href="{{ route('admin.programs.index') }}" class="block px-3 py-2 rounded @if(request()->routeIs('admin.programs.*')) active @endif">Programs</a></li>
                <li><a href="{{ route('admin.events.index') }}" class="block px-3 py-2 rounded @if(request()->routeIs('admin.events.*')) active @endif">Events</a></li>
                <li><a href="{{ route('admin.research.index') }}" class="block px-3 py-2 rounded @if(request()->routeIs('admin.research.*')) active @endif">Research</a></li>
                <li><a href="{{ route('admin.campaigns.index') }}" class="block px-3 py-2 rounded @if(request()->routeIs('admin.campaigns.*')) active @endif">Campaigns</a></li>
                <li><a href="{{ route('admin.posts.index') }}" class="block px-3 py-2 rounded @if(request()->routeIs('admin.posts.*')) active @endif">Posts</a></li>
                <li class="pt-2 mt-2 border-t theme-border"><span class="px-3 text-xs font-semibold group-label uppercase">Settings &amp; Site</span></li>
                <li><a href="{{ route('admin.settings.index') }}" class="block px-3 py-2 rounded @if(request()->routeIs('admin.settings.index') || request()->routeIs('admin.settings.edit') || request()->routeIs('admin.settings.create')) active @endif">Site Settings</a></li>
                <li><a href="{{ route('admin.settings.sections', 'homepage') }}" class="block px-3 py-2 rounded @if(request()->routeIs('admin.settings.sections') && request()->route('section') === 'homepage') active @endif">Homepage</a></li>
                <li><a href="{{ route('admin.settings.sections', 'mission') }}" class="block px-3 py-2 rounded @if(request()->routeIs('admin.settings.sections') && request()->route('section') === 'mission') active @endif">Mission &amp; Vision</a></li>
                <li><a href="{{ route('admin.settings.sections', 'about') }}" class="block px-3 py-2 rounded @if(request()->routeIs('admin.settings.sections') && request()->route('section') === 'about') active @endif">About</a></li>
                <li><a href="{{ route('admin.settings.slides') }}" class="block px-3 py-2 rounded @if(request()->routeIs('admin.settings.slides*')) active @endif">Homepage Slides</a></li>
                <li><a href="{{ route('admin.team.index') }}" class="block px-3 py-2 rounded @if(request()->routeIs('admin.team.*')) active @endif">Team</a></li>
                <li class="pt-2 mt-2 border-t theme-border"><span class="px-3 text-xs font-semibold group-label uppercase">Finance &amp; Store</span></li>
                <li><a href="{{ route('admin.donations.campaigns') }}" class="block px-3 py-2 rounded @if(request()->routeIs('admin.donations.*')) active @endif">Donation Campaigns</a></li>
                <li><a href="{{ route('admin.products.index') }}" class="block px-3 py-2 rounded @if(request()->routeIs('admin.products.*')) active @endif">Products</a></li>
                <li class="pt-2 mt-2 border-t theme-border"><span class="px-3 text-xs font-semibold group-label uppercase">System</span></li>
                <li><a href="{{ route('admin.users.index') }}" class="block px-3 py-2 rounded @if(request()->routeIs('admin.users.*')) active @endif">Users</a></li>
                <li><a href="{{ route('admin.audit.index') }}" class="block px-3 py-2 rounded @if(request()->routeIs('admin.audit.*')) active @endif">Audit Log</a></li>
            </ul>
        </nav>
        <div class="p-2 border-t theme-border">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded" target="_blank">View Site</a>
            <form method="POST" action="{{ url('/logout') }}" class="mt-1">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 rounded text-sm">Logout</button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col min-w-0">
        <header class="theme-bg-secondary theme-border border-b px-6 py-3 shrink-0 flex items-center justify-between">
            <h2 class="text-lg font-semibold theme-text-primary">@yield('heading', 'Admin')</h2>
            @include('partials.theme-toggle')
        </header>
        <main class="flex-1 p-6 overflow-auto theme-bg-primary">
            @if (session('success'))
                <div class="mb-4 p-4 rounded theme-alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-4 rounded theme-alert-error">{{ session('error') }}</div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
