@extends('layouts.public')
@section('title', 'Notifications')
@section('content')
@php
function notifIcon(string $type): string {
    $icons = [
        'program'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>',
        'event'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>',
        'post'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>',
        'research' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>',
    ];
    return $icons[$type] ?? '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>';
}
@endphp
<div class="max-w-2xl mx-auto">
    <div class="flex items-center justify-between mb-6 reveal">
        <h1 class="text-2xl font-bold theme-text-primary">Notifications</h1>
        <button id="mark-all-read-btn" class="text-sm theme-link font-medium">Mark all as read</button>
    </div>

    @if($notifications->isEmpty())
        <div class="theme-card rounded-xl p-10 text-center reveal">
            <div class="flex justify-center mb-3">
                <svg class="w-12 h-12 theme-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path stroke-linecap="round" stroke-linejoin="round" d="M13.73 21a2 2 0 01-3.46 0"/></svg>
            </div>
            <p class="theme-text-secondary">You have no notifications yet.</p>
        </div>
    @else
        <div class="space-y-3" id="notifications-list">
            @foreach($notifications as $n)
                <div class="theme-card rounded-xl p-4 flex gap-4 items-start transition notification-item {{ $n->isUnread() ? 'border-l-4' : '' }} reveal"
                     style="{{ $n->isUnread() ? 'border-left-color: var(--accent-orange);' : '' }}"
                     data-id="{{ $n->id }}">
                    <div class="shrink-0 mt-0.5 w-9 h-9 rounded-lg flex items-center justify-center" style="background:var(--bg-warm); color:var(--accent-orange);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            @if($n->type === 'program')
                                <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            @elseif($n->type === 'event')
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                            @elseif($n->type === 'post')
                                <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/>
                            @elseif($n->type === 'research')
                                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                            @else
                                <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/>
                            @endif
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-2">
                            <p class="font-semibold theme-text-primary text-sm leading-snug">{{ $n->title }}</p>
                            @if($n->isUnread())
                                <span class="shrink-0 w-2 h-2 rounded-full mt-1.5" style="background:var(--accent-orange);"></span>
                            @endif
                        </div>
                        @if($n->body)
                            <p class="text-sm theme-text-secondary mt-1 line-clamp-2">{{ $n->body }}</p>
                        @endif
                        <div class="flex items-center gap-3 mt-2">
                            <span class="text-xs theme-text-secondary">{{ $n->created_at->diffForHumans() }}</span>
                            @if($n->url)
                                <a href="{{ $n->url }}" class="text-xs theme-link font-medium" onclick="markRead({{ $n->id }})">View &rarr;</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-6">{{ $notifications->links() }}</div>
    @endif
</div>
@endsection
@push('scripts')
<script>
function markRead(id) {
    fetch('/notifications/' + id + '/read', {method:'POST', headers:{'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content || '{{ csrf_token() }}', 'Accept':'application/json'}});
}
document.getElementById('mark-all-read-btn')?.addEventListener('click', function() {
    fetch('/notifications/read-all', {method:'POST', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}','Accept':'application/json'}})
        .then(() => document.querySelectorAll('.notification-item').forEach(el => {
            el.style.borderLeftColor = '';
            el.classList.remove('border-l-4');
            el.querySelector('.rounded-full')?.remove();
        }));
});
</script>
@endpush
