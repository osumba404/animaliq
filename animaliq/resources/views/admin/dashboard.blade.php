@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Executive Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
            <p class="text-2xl font-bold">{{ $membersCount }}</p>
            <p class="text-sm text-gray-500">Active Members</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
            <p class="text-2xl font-bold">{{ $eventsCount }}</p>
            <p class="text-sm text-gray-500">Upcoming Events</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
            <p class="text-2xl font-bold">{{ $registrationsCount }}</p>
            <p class="text-sm text-gray-500">Registrations</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
            <p class="text-2xl font-bold">{{ number_format($donationsTotal, 0) }}</p>
            <p class="text-sm text-gray-500">Donations Total</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
            <p class="text-2xl font-bold">{{ $programsActive }}</p>
            <p class="text-sm text-gray-500">Active Programs</p>
        </div>
    </div>
    <nav class="flex flex-wrap gap-4">
        <a href="{{ route('admin.departments.index') }}" class="px-4 py-2 bg-white dark:bg-gray-800 rounded shadow hover:bg-gray-50">Departments</a>
        <a href="{{ route('admin.programs.index') }}" class="px-4 py-2 bg-white dark:bg-gray-800 rounded shadow hover:bg-gray-50">Programs</a>
        <a href="{{ route('admin.events.index') }}" class="px-4 py-2 bg-white dark:bg-gray-800 rounded shadow hover:bg-gray-50">Events</a>
        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-white dark:bg-gray-800 rounded shadow hover:bg-gray-50">Users</a>
        <a href="{{ route('admin.settings.index') }}" class="px-4 py-2 bg-white dark:bg-gray-800 rounded shadow hover:bg-gray-50">Settings</a>
        <a href="{{ route('admin.research.index') }}" class="px-4 py-2 bg-white dark:bg-gray-800 rounded shadow hover:bg-gray-50">Research</a>
        <a href="{{ route('admin.campaigns.index') }}" class="px-4 py-2 bg-white dark:bg-gray-800 rounded shadow hover:bg-gray-50">Campaigns</a>
        <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 bg-white dark:bg-gray-800 rounded shadow hover:bg-gray-50">Posts</a>
        <a href="{{ route('admin.donations.campaigns') }}" class="px-4 py-2 bg-white dark:bg-gray-800 rounded shadow hover:bg-gray-50">Donations</a>
        <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-white dark:bg-gray-800 rounded shadow hover:bg-gray-50">Products</a>
        <a href="{{ route('admin.audit.index') }}" class="px-4 py-2 bg-white dark:bg-gray-800 rounded shadow hover:bg-gray-50">Audit Log</a>
    </nav>
@endsection
