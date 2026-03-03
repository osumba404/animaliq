@extends('layouts.admin')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-6 theme-text-primary">Executive Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        <div class="theme-card p-4 rounded-lg">
            <p class="text-2xl font-bold theme-accent">{{ $membersCount }}</p>
            <p class="text-sm theme-text-secondary">Active Members</p>
        </div>
        <div class="theme-card p-4 rounded-lg">
            <p class="text-2xl font-bold theme-accent">{{ $eventsCount }}</p>
            <p class="text-sm theme-text-secondary">Upcoming Events</p>
        </div>
        <div class="theme-card p-4 rounded-lg">
            <p class="text-2xl font-bold theme-accent">{{ $registrationsCount }}</p>
            <p class="text-sm theme-text-secondary">Registrations</p>
        </div>
        <div class="theme-card p-4 rounded-lg">
            <p class="text-2xl font-bold theme-accent">{{ number_format($donationsTotal, 0) }}</p>
            <p class="text-sm theme-text-secondary">Donations Total</p>
        </div>
        <div class="theme-card p-4 rounded-lg">
            <p class="text-2xl font-bold theme-accent">{{ $programsActive }}</p>
            <p class="text-sm theme-text-secondary">Active Programs</p>
        </div>
    </div>
    <nav class="flex flex-wrap gap-4">
        @php $sections = $adminAllowedSections ?? []; @endphp
        @if(in_array('departments', $sections))<a href="{{ route('admin.departments.index') }}" class="theme-card px-4 py-2 rounded hover:border-[var(--accent-orange)] transition-colors">Departments</a>@endif
        @if(in_array('programs', $sections))<a href="{{ route('admin.programs.index') }}" class="theme-card px-4 py-2 rounded hover:border-[var(--accent-orange)] transition-colors">Programs</a>@endif
        @if(in_array('events', $sections))<a href="{{ route('admin.events.index') }}" class="theme-card px-4 py-2 rounded hover:border-[var(--accent-orange)] transition-colors">Events</a>@endif
        @if(in_array('users', $sections))<a href="{{ route('admin.users.index') }}" class="theme-card px-4 py-2 rounded hover:border-[var(--accent-orange)] transition-colors">Users</a>@endif
        @if(in_array('settings', $sections))<a href="{{ route('admin.settings.index') }}" class="theme-card px-4 py-2 rounded hover:border-[var(--accent-orange)] transition-colors">Settings</a>@endif
        @if(in_array('research', $sections))<a href="{{ route('admin.research.index') }}" class="theme-card px-4 py-2 rounded hover:border-[var(--accent-orange)] transition-colors">Research</a>@endif
        @if(in_array('campaigns', $sections))<a href="{{ route('admin.campaigns.index') }}" class="theme-card px-4 py-2 rounded hover:border-[var(--accent-orange)] transition-colors">Campaigns</a>@endif
        @if(in_array('posts', $sections))<a href="{{ route('admin.posts.index') }}" class="theme-card px-4 py-2 rounded hover:border-[var(--accent-orange)] transition-colors">Posts</a>@endif
        @if(in_array('donations', $sections))<a href="{{ route('admin.donations.campaigns') }}" class="theme-card px-4 py-2 rounded hover:border-[var(--accent-orange)] transition-colors">Donations</a>@endif
        @if(in_array('products', $sections))<a href="{{ route('admin.products.index') }}" class="theme-card px-4 py-2 rounded hover:border-[var(--accent-orange)] transition-colors">Products</a>@endif
        @if(in_array('team', $sections))<a href="{{ route('admin.team.index') }}" class="theme-card px-4 py-2 rounded hover:border-[var(--accent-orange)] transition-colors">Team</a>@endif
        @if(in_array('audit', $sections))<a href="{{ route('admin.audit.index') }}" class="theme-card px-4 py-2 rounded hover:border-[var(--accent-orange)] transition-colors">Audit Log</a>@endif
    </nav>
@endsection
