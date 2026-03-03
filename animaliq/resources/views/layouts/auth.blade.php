<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sign in') – {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FDFDFC] text-[#1b1b18] min-h-screen antialiased flex flex-col">
    <header class="border-b border-gray-200">
        <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-xl font-semibold">Animal IQ</a>
            <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:underline">← Back to site</a>
        </nav>
    </header>
    <main class="container mx-auto px-4 py-12 flex-1 flex items-center justify-center">
        <div class="w-full max-w-md">
            @if (session('success'))
                <div class="mb-4 p-4 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-4 rounded bg-red-100 text-red-800">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="mb-4 p-4 rounded bg-red-100 text-red-800">
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
    <footer class="border-t border-gray-200 py-4">
        <div class="container mx-auto px-4 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Animal IQ
        </div>
    </footer>
</body>
</html>
