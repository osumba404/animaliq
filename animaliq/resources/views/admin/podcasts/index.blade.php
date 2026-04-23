@extends('layouts.admin')

@section('title', 'Podcasts')
@section('heading', 'Podcasts')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold theme-text-primary">Podcasts</h1>
        <a href="{{ route('admin.podcasts.create') }}" class="theme-btn">+ Add Podcast</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 rounded theme-alert-success">{{ session('success') }}</div>
    @endif

    <div class="theme-card rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b theme-border">
                    <th class="px-4 py-3 text-left theme-text-secondary font-medium">Order</th>
                    <th class="px-4 py-3 text-left theme-text-secondary font-medium">Title</th>
                    <th class="px-4 py-3 text-left theme-text-secondary font-medium">YouTube URL</th>
                    <th class="px-4 py-3 text-left theme-text-secondary font-medium">Status</th>
                    <th class="px-4 py-3 text-right theme-text-secondary font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y" style="border-color:var(--border-color)">
                @forelse($podcasts as $podcast)
                <tr class="hover:bg-[var(--bg-warm)] transition">
                    <td class="px-4 py-3 theme-text-secondary text-center">{{ $podcast->display_order }}</td>
                    <td class="px-4 py-3 theme-text-primary font-medium">{{ $podcast->title }}</td>
                    <td class="px-4 py-3 theme-text-secondary max-w-xs truncate">
                        <a href="{{ $podcast->youtube_url }}" target="_blank" class="theme-link text-xs">{{ Str::limit($podcast->youtube_url, 50) }}</a>
                    </td>
                    <td class="px-4 py-3">
                        @if($podcast->active)
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">Active</span>
                        @else
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">Inactive</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <a href="{{ route('admin.podcasts.edit', $podcast) }}" class="theme-link text-xs">Edit</a>
                        <form action="{{ route('admin.podcasts.destroy', $podcast) }}" method="POST" class="inline" onsubmit="return confirm('Delete this podcast?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs text-red-500 hover:text-red-700">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center theme-text-secondary">No podcasts yet. <a href="{{ route('admin.podcasts.create') }}" class="theme-link">Add one</a></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $podcasts->links() }}</div>
@endsection
