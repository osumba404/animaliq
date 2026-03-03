@extends('layouts.admin')
@section('title', 'Site Settings')
@section('heading', 'Site Settings')
@section('content')
<p class="mb-4 theme-text-secondary">Site settings use predefined keys. Your role is to populate their values. Edit by section below.</p>
@php $sections = config('settings_sections', []); @endphp
<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4 mb-8">
    @foreach($sections as $slug => $config)
        <a href="{{ route('admin.settings.sections', $slug) }}" class="theme-card rounded-lg p-4 block hover:border-[var(--accent-orange)] transition-colors">
            <h3 class="font-semibold theme-text-primary">{{ $config['title'] }}</h3>
            <p class="text-sm theme-text-secondary mt-1">{{ count($config['keys']) }} keys</p>
        </a>
    @endforeach
</div>
<h2 class="text-lg font-semibold mb-2 theme-text-primary">All predefined keys</h2>
<ul class="space-y-0">
    @foreach($sections as $slug => $config)
        @foreach($config['keys'] as $key => $meta)
            <li class="flex justify-between items-center py-2 theme-table-cell border-b text-sm">
                <span class="theme-text-primary">{{ $key }}</span>
                <a href="{{ route('admin.settings.sections', $slug) }}" class="theme-link">Edit in {{ $config['title'] }}</a>
            </li>
        @endforeach
    @endforeach
</ul>
@endsection
