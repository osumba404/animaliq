@extends('layouts.admin')

@section('title', 'Forum Posts')
@section('heading', 'Forum Posts')

@section('content')
<div class="mb-4 flex flex-wrap items-center justify-between gap-3">
    <form method="GET" class="flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search posts…" class="border theme-border rounded px-3 py-1.5 text-sm theme-bg-primary theme-text-primary">
        <button type="submit" class="px-3 py-1.5 text-sm rounded theme-btn">Search</button>
        @if(request('q'))
            <a href="{{ route('admin.forum.index') }}" class="px-3 py-1.5 text-sm rounded border theme-border theme-text-secondary">Clear</a>
        @endif
    </form>
    <span class="text-sm theme-text-secondary">{{ $posts->total() }} post{{ $posts->total() !== 1 ? 's' : '' }}</span>
</div>

<div class="rounded-xl border theme-border overflow-hidden">
    <table class="w-full text-sm">
        <thead class="theme-bg-secondary">
            <tr>
                <th class="px-4 py-3 text-left font-semibold theme-text-primary">Title</th>
                <th class="px-4 py-3 text-left font-semibold theme-text-primary hidden md:table-cell">Author</th>
                <th class="px-4 py-3 text-center font-semibold theme-text-primary hidden sm:table-cell">Views</th>
                <th class="px-4 py-3 text-center font-semibold theme-text-primary hidden sm:table-cell">Likes</th>
                <th class="px-4 py-3 text-center font-semibold theme-text-primary hidden sm:table-cell">Comments</th>
                <th class="px-4 py-3 text-left font-semibold theme-text-primary hidden md:table-cell">Posted</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y" style="border-color:var(--border-color)">
            @forelse($posts as $post)
            <tr class="hover:theme-bg-secondary transition">
                <td class="px-4 py-3 theme-text-primary font-medium max-w-xs">
                    <a href="{{ route('forum.show', $post) }}" target="_blank" class="hover:underline line-clamp-2">{{ $post->title }}</a>
                </td>
                <td class="px-4 py-3 theme-text-secondary hidden md:table-cell whitespace-nowrap">
                    {{ $post->user->first_name }} {{ $post->user->last_name }}
                </td>
                <td class="px-4 py-3 text-center theme-text-secondary hidden sm:table-cell">{{ number_format($post->views_count) }}</td>
                <td class="px-4 py-3 text-center theme-text-secondary hidden sm:table-cell">{{ number_format($post->likes_count) }}</td>
                <td class="px-4 py-3 text-center theme-text-secondary hidden sm:table-cell">{{ number_format($post->comments_count) }}</td>
                <td class="px-4 py-3 theme-text-secondary hidden md:table-cell whitespace-nowrap">{{ $post->created_at->format('d M Y') }}</td>
                <td class="px-4 py-3 text-right whitespace-nowrap">
                    <a href="{{ route('forum.show', $post) }}" target="_blank" class="text-xs theme-link mr-3">View</a>
                    <form method="POST" action="{{ route('admin.forum.destroy', $post) }}" class="inline" onsubmit="return confirm('Delete this post and all its comments?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-red-500 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-4 py-10 text-center theme-text-secondary">No forum posts yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($posts->hasPages())
<div class="mt-4">{{ $posts->links() }}</div>
@endif
@endsection
