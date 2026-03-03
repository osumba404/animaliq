@extends('layouts.auth')

@section('title', 'Log in')

@section('content')
<div class="bg-white border border-gray-200 rounded-lg shadow-sm p-8">
    <h1 class="text-2xl font-semibold mb-2">Log in</h1>
    <p class="text-gray-500 text-sm mb-6">Sign in to your Animal IQ account.</p>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                   class="w-full rounded border border-gray-300 px-3 py-2 text-gray-900 focus:border-gray-500 focus:outline-none focus:ring-1 focus:ring-gray-500">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" name="password" id="password" required autocomplete="current-password"
                   class="w-full rounded border border-gray-300 px-3 py-2 text-gray-900 focus:border-gray-500 focus:outline-none focus:ring-1 focus:ring-gray-500">
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300 text-gray-600 focus:ring-gray-500">
            <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
        </div>

        <button type="submit" class="w-full rounded bg-gray-900 text-white py-2.5 px-4 font-medium hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
            Log in
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-500">
        Don't have an account? <a href="{{ route('register') }}" class="font-medium text-gray-900 hover:underline">Register</a>
    </p>
</div>
@endsection
