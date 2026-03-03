@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="bg-white border border-gray-200 rounded-lg shadow-sm p-8">
    <h1 class="text-2xl font-semibold mb-2">Create an account</h1>
    <p class="text-gray-500 text-sm mb-6">Join the Animal IQ community.</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First name</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required autofocus autocomplete="given-name"
                       class="w-full rounded border border-gray-300 px-3 py-2 text-gray-900 focus:border-gray-500 focus:outline-none focus:ring-1 focus:ring-gray-500">
            </div>
            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last name</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required autocomplete="family-name"
                       class="w-full rounded border border-gray-300 px-3 py-2 text-gray-900 focus:border-gray-500 focus:outline-none focus:ring-1 focus:ring-gray-500">
            </div>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="email"
                   class="w-full rounded border border-gray-300 px-3 py-2 text-gray-900 focus:border-gray-500 focus:outline-none focus:ring-1 focus:ring-gray-500">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" name="password" id="password" required autocomplete="new-password"
                   class="w-full rounded border border-gray-300 px-3 py-2 text-gray-900 focus:border-gray-500 focus:outline-none focus:ring-1 focus:ring-gray-500"
                   aria-describedby="password-requirements">
            <p id="password-requirements" class="mt-1 text-xs text-gray-500">Minimum 8 characters.</p>
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password"
                   class="w-full rounded border border-gray-300 px-3 py-2 text-gray-900 focus:border-gray-500 focus:outline-none focus:ring-1 focus:ring-gray-500">
        </div>

        <button type="submit" class="w-full rounded bg-gray-900 text-white py-2.5 px-4 font-medium hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
            Register
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-500">
        Already have an account? <a href="{{ route('login') }}" class="font-medium text-gray-900 hover:underline">Log in</a>
    </p>
</div>
@endsection
