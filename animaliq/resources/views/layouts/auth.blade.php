<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sign in') – {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @include('partials.theme')
</head>
<body class="theme-bg-primary theme-text-primary min-h-screen antialiased flex flex-col">
    <header class="theme-border border-b">
        <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-xl font-semibold" style="background: linear-gradient(135deg, var(--orange-200), var(--orange-600)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Animal IQ</a>
            <div class="flex items-center gap-4">
                @include('partials.theme-toggle')
                <a href="{{ route('home') }}" class="theme-nav-link text-sm">← Back to site</a>
            </div>
        </nav>
    </header>
    <main class="container mx-auto px-4 py-12 flex-1 flex items-center justify-center">
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
</body>
</html>
