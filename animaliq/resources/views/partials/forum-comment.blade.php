@php
$isLiked = auth()->check() && $comment->likes->where('user_id', auth()->id())->isNotEmpty();
@endphp
<div class="theme-card rounded-2xl p-4 comment-item" id="forum-comment-{{ $comment->id }}">
    <div class="flex gap-3">
        <div class="w-9 h-9 rounded-full flex-shrink-0 flex items-center justify-center text-sm font-bold theme-bg-secondary theme-accent overflow-hidden">
            @if($comment->user->profile_photo)
                <img src="{{ asset('storage/' . $comment->user->profile_photo) }}" alt="" class="w-full h-full object-cover">
            @else
                {{ strtoupper(mb_substr($comment->user->first_name ?? '?', 0, 1)) }}
            @endif
        </div>
        <div class="flex-1">
            <div class="flex items-center gap-2 mb-1">
                <span class="font-semibold theme-text-primary text-sm">{{ $comment->user->first_name }} {{ $comment->user->last_name }}</span>
                <span class="text-xs theme-text-secondary">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            <p class="theme-text-secondary text-sm leading-relaxed">{{ $comment->body }}</p>
            <div class="flex items-center gap-3 mt-2">
                <button class="like-comment-btn flex items-center gap-1 text-xs theme-text-secondary hover:text-red-500 transition"
                    style="{{ $isLiked ? 'color:var(--accent-orange)' : '' }}" data-id="{{ $comment->id }}">
                    <svg class="w-3.5 h-3.5" fill="{{ $isLiked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    <span>{{ $comment->likes_count ?? 0 }}</span>
                </button>
                @auth
                <button class="reply-btn text-xs theme-text-secondary hover:theme-accent transition"
                    data-id="{{ $comment->id }}" data-name="{{ $comment->user->first_name }}">Reply</button>
                @endauth
            </div>

            {{-- Replies --}}
            @if($comment->replies && $comment->replies->isNotEmpty())
            <div class="replies-list mt-4 ml-2 space-y-3 border-l-2 pl-4" style="border-color:var(--border-color)">
                @foreach($comment->replies as $reply)
                @php $replyLiked = auth()->check() && $reply->likes->where('user_id', auth()->id())->isNotEmpty(); @endphp
                <div class="flex gap-2 comment-item" id="forum-comment-{{ $reply->id }}">
                    <div class="w-7 h-7 rounded-full flex-shrink-0 flex items-center justify-center text-xs font-bold theme-bg-secondary theme-accent overflow-hidden">
                        @if($reply->user->profile_photo)
                            <img src="{{ asset('storage/' . $reply->user->profile_photo) }}" alt="" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(mb_substr($reply->user->first_name ?? '?', 0, 1)) }}
                        @endif
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="font-semibold theme-text-primary text-xs">{{ $reply->user->first_name }} {{ $reply->user->last_name }}</span>
                            <span class="text-xs theme-text-secondary">{{ $reply->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="theme-text-secondary text-xs leading-relaxed">{{ $reply->body }}</p>
                        <button class="like-comment-btn flex items-center gap-1 text-xs theme-text-secondary hover:text-red-500 transition mt-1"
                            style="{{ $replyLiked ? 'color:var(--accent-orange)' : '' }}" data-id="{{ $reply->id }}">
                            <svg class="w-3 h-3" fill="{{ $replyLiked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            <span>{{ $reply->likes_count ?? 0 }}</span>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
