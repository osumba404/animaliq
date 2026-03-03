<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @include('partials.theme')
</head>
<body class="theme-bg-primary theme-text-primary flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 flex items-center justify-between">
        <a href="{{ route('home') }}" class="text-lg font-semibold" style="background: linear-gradient(135deg, var(--orange-200), var(--orange-600)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Animal IQ</a>
        @if (Route::has('login'))
            <nav class="flex items-center gap-3">
                @include('partials.theme-toggle')
                @auth
                    <a href="{{ route('community.dashboard') }}" class="theme-btn-outline px-4 py-1.5 text-sm">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="theme-link font-medium">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="theme-btn px-4 py-1.5 text-sm">Register</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>
    <div class="flex items-center justify-center w-full">
        <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row theme-card rounded-lg overflow-hidden">
            <div class="flex-1 p-6 pb-12 lg:p-20 theme-bg-primary">
                <h1 class="mb-1 font-medium theme-text-primary">Let's get started</h1>
                <p class="mb-2 theme-text-secondary">This is the default Laravel welcome page. <a href="{{ route('home') }}" class="theme-link">Go to Animal IQ homepage</a>.</p>
            </div>
            <div class="theme-bg-warm border-l theme-border flex items-center justify-center aspect-[335/376] lg:aspect-auto w-full lg:w-[438px] shrink-0 p-8">
                <span class="text-4xl font-bold theme-accent">Animal IQ</span>
            </div>
        </main>
    </div>
    @if (Route::has('login'))
        <div class="h-14 hidden lg:block"></div>
    @endif
</body>
</html>
