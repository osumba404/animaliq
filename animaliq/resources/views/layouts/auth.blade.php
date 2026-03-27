<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sign in') – {{ config('app.name') }}</title>
    <meta name="robots" content="noindex, nofollow">
    <script src="https://cdn.tailwindcss.com"></script>
    @include('partials.theme')
    @include('partials.animations')
    @stack('styles')
</head>
<body class="theme-bg-primary theme-text-primary min-h-screen antialiased flex flex-col">
    <header class="theme-border border-b">
        <nav class="container mx-auto px-4 py-3 md:py-4 flex items-center justify-between gap-2">
            <a href="{{ route('home') }}" class="text-lg md:text-xl font-semibold shrink-0" style="background: linear-gradient(135deg, var(--orange-200), var(--orange-600)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Animal IQ</a>
            <div class="flex items-center gap-2 md:gap-4 min-w-0">
                @include('partials.theme-toggle')
                <a href="{{ route('home') }}" class="theme-nav-link text-sm whitespace-nowrap">← Back to site</a>
            </div>
        </nav>
    </header>
    <main class="container mx-auto px-4 py-8 md:py-12 flex-1 flex items-center justify-center min-w-0">
        <div class="w-full max-w-md">
            @if (session('success'))
                <div class="mb-4 p-4 rounded theme-alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-4 rounded theme-alert-error">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="mb-4 p-4 rounded theme-alert-error">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </div>
    </main>
    <footer class="theme-border border-t py-4 theme-bg-secondary">
        <div class="container mx-auto px-4 text-center text-sm theme-text-secondary">
            &copy; {{ date('Y') }} Animal IQ
        </div>
    </footer>
    @stack('scripts')
    <script>
    /**
     * BFCache guard — mobile browsers (iOS Safari, Android Chrome) restore pages
     * from the Back/Forward Cache instantly, without a network request. This means
     * the @csrf token embedded in the form can be stale, causing a 419 "Page Expired"
     * when the user submits. Reloading whenever the page is restored from bfcache
     * guarantees a fresh token every time.
     */
    window.addEventListener('pageshow', function (e) {
        if (e.persisted) {
            window.location.reload();
        }
    });
    </script>
</body>
</html>
