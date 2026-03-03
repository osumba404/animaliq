<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-[#FDFDFC] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-block px-5 py-1.5 border border-gray-300 rounded text-sm">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="inline-block px-5 py-1.5 rounded text-sm">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-block px-5 py-1.5 border border-gray-300 rounded text-sm">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>
        <div class="flex items-center justify-center w-full">
            <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
                <div class="flex-1 p-6 pb-12 lg:p-20 bg-white shadow rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
                    <h1 class="mb-1 font-medium">Let's get started</h1>
                    <p class="mb-2 text-gray-500">This is the default Laravel welcome page. <a href="{{ route('home') }}" class="text-red-600 underline">Go to Animal IQ homepage</a>.</p>
                </div>
                <div class="bg-[#fff2f2] relative rounded-t-lg lg:rounded-t-none lg:rounded-r-lg aspect-[335/376] lg:aspect-auto w-full lg:w-[438px] shrink-0 overflow-hidden flex items-center justify-center">
                    <span class="text-4xl text-red-600 font-bold">Animal IQ</span>
                </div>
            </main>
        </div>
        @if (Route::has('login'))
            <div class="h-14 hidden lg:block"></div>
        @endif
    </body>
</html>
