<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page not found – {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @include('partials.theme')
</head>
<body class="theme-bg-primary theme-text-primary min-h-screen antialiased flex flex-col items-center justify-center p-6">
    <div class="text-center max-w-md">
        <p class="text-6xl font-bold theme-accent mb-2">404</p>
        <h1 class="text-2xl font-semibold theme-text-primary mb-2">Page not found</h1>
        <p class="theme-text-secondary mb-6">The page you're looking for doesn't exist or has been moved.</p>
        <a href="{{ url('/') }}" class="theme-btn inline-block">Back to home</a>
    </div>
</body>
</html>
