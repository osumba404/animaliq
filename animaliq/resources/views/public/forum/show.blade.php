@extends('layouts.public')

@section('title', $post->title . ' – Animal IQ Forum')

@section('content')
    <div class="max-w-3xl mx-auto">
        {{-- Breadcrumb --}}
        <nav class="mb-4 text-sm">
            <ol class="flex flex-wrap items-center gap-1 theme-text-secondary">
                <li><a href="{{ route('forum.index') }}" class="hover:underline">Forum</a> <span class="opacity-40">›</span></li>
                <li class="theme-text-primary font-medium line-clamp-1">{{ $post->title }}</li>
            </ol>
        </nav>

        {{-- Post Card --}}
        <article class="theme-card rounded-2xl p-6 md:p-8 mb-6 reveal">
            {{-- Author + meta --}}
            <div class="flex gap-3 mb-5">
                <div class="w-11 h-11 rounded-full flex-shrink-0 flex items-center justify-center text-sm font-bold theme-bg-secondary theme-accent overflow-hidden">
                    @if($post->user->profile_photo)
                        <img src="{{ asset('storage/' . $post->user->profile_photo) }}" alt="" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(mb_substr($post->user->first_name ?? '?', 0, 1)) }}
                    @endif
                </div>
                <div>
                    <p class="font-semibold theme-text-primary text-sm">{{ $post->user->first_name }} {{ $post->user->last_name }}</p>
                    <p class="text-xs theme-text-secondary">{{ $post->created_at->format('F j, Y · g:i A') }}</p>
                </div>
                @if(auth()->id() === $post->user_id || (auth()->check() && auth()->user()->isAdmin()))
                <form method="POST" action="{{ route('forum.destroy', $post) }}" class="ml-auto" onsubmit="return confirm('Delete this post?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-xs text-red-500 hover:underline">Delete</button>
                </form>
                @endif
            </div>

            {{-- Title --}}
            <h1 class="text-2xl md:text-3xl font-bold theme-text-primary mb-4 leading-tight">{{ $post->title }}</h1>

            {{-- Image --}}
            @if($post->image)
            <div class="rounded-xl overflow-hidden mb-5 -mx-2">
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full object-cover max-h-96">
            </div>
            @endif

            {{-- Body --}}
            <div class="theme-text-secondary leading-relaxed whitespace-pre-wrap text-[0.95rem]">{{ $post->body }}</div>

            {{-- Engagement Bar --}}
            <div class="mt-6 pt-5 border-t theme-border flex flex-wrap items-center gap-5" id="engagement-bar">
                {{-- Views --}}
                <span class="flex items-center gap-1.5 text-sm theme-text-secondary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <span>{{ number_format($post->views_count) }}</span>
                </span>
                {{-- Like --}}
                <button id="like-btn"
                    class="flex items-center gap-1.5 text-sm transition {{ $userLiked ? '' : 'theme-text-secondary hover:text-red-500' }}"
                    style="{{ $userLiked ? 'color:var(--accent-orange)' : '' }}"
                    data-slug="{{ $post->slug }}"
                    data-liked="{{ $userLiked ? 'true' : 'false' }}">
                    <svg class="w-4 h-4" fill="{{ $userLiked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    <span id="likes-count">{{ number_format($post->likes_count) }}</span>
                </button>
                {{-- Comments jump --}}
                <a href="#comments" class="flex items-center gap-1.5 text-sm theme-text-secondary hover:theme-accent transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    <span id="comments-count">{{ number_format($post->comments_count) }}</span>
                </a>
                {{-- Bookmark --}}
                <button id="bookmark-btn"
                    class="flex items-center gap-1.5 text-sm transition {{ $userBookmarked ? '' : 'theme-text-secondary hover:theme-accent' }}"
                    style="{{ $userBookmarked ? 'color:var(--accent-orange)' : '' }}"
                    data-slug="{{ $post->slug }}"
                    data-bookmarked="{{ $userBookmarked ? 'true' : 'false' }}">
                    <svg class="w-4 h-4" fill="{{ $userBookmarked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                    <span id="bookmarks-count">{{ number_format($post->bookmarks_count) }}</span>
                </button>
                {{-- Share --}}
                <div class="ml-auto">
                    @include('partials.share-button', ['shareTitle' => $post->title . ' – Animal IQ Forum', 'url' => route('forum.show', $post)])
                </div>
            </div>
        </article>

        {{-- Comments Section --}}
        <section class="mt-2" id="comments">
            <h2 class="text-lg font-bold theme-text-primary mb-4">
                Replies <span class="text-sm font-normal theme-text-secondary" id="comments-total">({{ $post->comments_count }})</span>
            </h2>

            @auth
            {{-- Comment form --}}
            <div class="theme-card rounded-2xl p-4 mb-5">
                <div class="flex gap-3">
                    <div class="w-9 h-9 rounded-full flex-shrink-0 flex items-center justify-center text-sm font-bold theme-bg-secondary theme-accent overflow-hidden">
                        @if(auth()->user()->profile_photo)
                            <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(mb_substr(auth()->user()->first_name ?? '?', 0, 1)) }}
                        @endif
                    </div>
                    <div class="flex-1">
                        <textarea id="comment-body" rows="3" class="theme-input w-full resize-none"
                            placeholder="Add to the discussion…"></textarea>
                        <div class="flex justify-end mt-2">
                            <button id="submit-comment" class="theme-btn text-sm px-5 py-2" data-slug="{{ $post->slug }}">Reply</button>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="theme-card rounded-2xl p-4 mb-5 text-center">
                <p class="theme-text-secondary text-sm mb-2">Log in to join the discussion.</p>
                <a href="{{ route('login') }}" class="theme-btn text-sm inline-block">Log in</a>
            </div>
            @endauth

            {{-- Comments List --}}
            <div id="comments-list" class="space-y-4">
                @foreach($post->comments->whereNull('parent_id') as $comment)
                    @include('partials.forum-comment', ['comment' => $comment, 'postSlug' => $post->slug])
                @endforeach
            </div>
        </section>
    </div>

@push('scripts')
<script>
(function() {
    var csrf = document.querySelector('meta[name=csrf-token]')?.content || '';
    var postSlug = @json($post->slug);
    var auth = {{ auth()->check() ? 'true' : 'false' }};
    var loginUrl = '{{ route('login') }}';

    // Like
    var likeBtn = document.getElementById('like-btn');
    if (likeBtn) {
        likeBtn.addEventListener('click', function() {
            if (!auth) { window.location = loginUrl; return; }
            fetch('/forum/' + postSlug + '/like', {method:'POST', headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json'}})
                .then(r => r.json()).then(data => {
                    document.getElementById('likes-count').textContent = data.count.toLocaleString();
                    likeBtn.querySelector('svg').setAttribute('fill', data.liked ? 'currentColor' : 'none');
                    likeBtn.style.color = data.liked ? 'var(--accent-orange)' : '';
                });
        });
    }

    // Bookmark
    var bookmarkBtn = document.getElementById('bookmark-btn');
    if (bookmarkBtn) {
        bookmarkBtn.addEventListener('click', function() {
            if (!auth) { window.location = loginUrl; return; }
            fetch('/forum/' + postSlug + '/bookmark', {method:'POST', headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json'}})
                .then(r => r.json()).then(data => {
                    document.getElementById('bookmarks-count').textContent = data.count.toLocaleString();
                    bookmarkBtn.querySelector('svg').setAttribute('fill', data.bookmarked ? 'currentColor' : 'none');
                    bookmarkBtn.style.color = data.bookmarked ? 'var(--accent-orange)' : '';
                });
        });
    }

    // Comment submit
    var submitBtn = document.getElementById('submit-comment');
    if (submitBtn) {
        submitBtn.addEventListener('click', function() {
            if (!auth) { window.location = loginUrl; return; }
            var body = document.getElementById('comment-body').value.trim();
            if (!body) return;
            submitBtn.disabled = true;
            fetch('/forum/' + postSlug + '/comment', {
                method:'POST',
                headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json','Content-Type':'application/json'},
                body: JSON.stringify({body: body})
            }).then(r => r.json()).then(data => {
                submitBtn.disabled = false;
                if (data.comment) {
                    document.getElementById('comment-body').value = '';
                    var list = document.getElementById('comments-list');
                    var div = document.createElement('div');
                    div.innerHTML = renderComment(data.comment);
                    list.prepend(div.firstChild);
                    var count = parseInt(document.getElementById('comments-count').textContent.replace(/,/g,'')) + 1;
                    document.getElementById('comments-count').textContent = count.toLocaleString();
                    document.getElementById('comments-total').textContent = '(' + count.toLocaleString() + ')';
                }
            }).catch(function() { submitBtn.disabled = false; });
        });
    }

    function renderComment(c) {
        var name = c.user ? c.user.name : 'User';
        var initials = name.charAt(0).toUpperCase();
        var avatar = c.user && c.user.photo
            ? '<img src="' + c.user.photo + '" alt="" class="w-full h-full object-cover">'
            : initials;
        return '<div class="theme-card rounded-2xl p-4 comment-item" id="forum-comment-' + c.id + '">'
            + '<div class="flex gap-3">'
            + '<div class="w-9 h-9 rounded-full flex-shrink-0 flex items-center justify-center text-sm font-bold theme-bg-secondary theme-accent overflow-hidden">' + avatar + '</div>'
            + '<div class="flex-1">'
            + '<div class="flex items-center gap-2 mb-1"><span class="font-semibold theme-text-primary text-sm">' + name + '</span><span class="text-xs theme-text-secondary">' + c.created_at + '</span></div>'
            + '<p class="theme-text-secondary text-sm leading-relaxed">' + escapeHtml(c.body) + '</p>'
            + '<div class="flex items-center gap-3 mt-2">'
            + '<button class="like-comment-btn flex items-center gap-1 text-xs theme-text-secondary hover:text-red-500 transition" data-id="' + c.id + '"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg><span>0</span></button>'
            + '<button class="reply-btn text-xs theme-text-secondary hover:theme-accent transition" data-id="' + c.id + '" data-name="' + name + '">Reply</button>'
            + '</div></div></div></div>';
    }

    function escapeHtml(str) {
        return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    // Delegate: like comment & reply
    document.getElementById('comments-list').addEventListener('click', function(e) {
        var likeBtn = e.target.closest('.like-comment-btn');
        if (likeBtn) {
            if (!auth) { window.location = loginUrl; return; }
            fetch('/forum/comments/' + likeBtn.dataset.id + '/like', {method:'POST', headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json'}})
                .then(r => r.json()).then(data => {
                    likeBtn.querySelector('span').textContent = data.count;
                    likeBtn.querySelector('svg').setAttribute('fill', data.liked ? 'currentColor' : 'none');
                    likeBtn.style.color = data.liked ? 'var(--accent-orange)' : '';
                });
            return;
        }
        var replyBtn = e.target.closest('.reply-btn');
        if (replyBtn) {
            if (!auth) { window.location = loginUrl; return; }
            var cid = replyBtn.dataset.id;
            var cname = replyBtn.dataset.name;
            var existing = document.getElementById('reply-form-' + cid);
            if (existing) { existing.remove(); return; }
            var form = document.createElement('div');
            form.id = 'reply-form-' + cid;
            form.className = 'mt-3 flex gap-2';
            form.innerHTML = '<textarea class="theme-input flex-1 text-sm resize-none" rows="2" placeholder="Reply to ' + cname + '…"></textarea>'
                + '<button class="theme-btn text-sm px-3 py-1.5 submit-reply" data-parent="' + cid + '">Reply</button>';
            replyBtn.closest('.flex-1').appendChild(form);
            return;
        }
        var submitReply = e.target.closest('.submit-reply');
        if (submitReply) {
            if (!auth) { window.location = loginUrl; return; }
            var parentId = submitReply.dataset.parent;
            var textarea = submitReply.previousElementSibling;
            var body = textarea.value.trim();
            if (!body) return;
            submitReply.disabled = true;
            fetch('/forum/' + postSlug + '/comment', {
                method:'POST',
                headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json','Content-Type':'application/json'},
                body: JSON.stringify({body: body, parent_id: parentId})
            }).then(r => r.json()).then(data => {
                submitReply.disabled = false;
                if (data.comment) {
                    var parentItem = document.getElementById('forum-comment-' + parentId);
                    if (parentItem) {
                        var repliesDiv = parentItem.querySelector('.replies-list');
                        if (!repliesDiv) {
                            repliesDiv = document.createElement('div');
                            repliesDiv.className = 'replies-list mt-4 ml-8 space-y-3 border-l-2 pl-4';
                            repliesDiv.style.borderColor = 'var(--border-color)';
                            parentItem.querySelector('.flex-1').appendChild(repliesDiv);
                        }
                        var div = document.createElement('div');
                        div.innerHTML = renderComment(data.comment);
                        repliesDiv.appendChild(div.firstChild);
                    }
                    document.getElementById('reply-form-' + parentId)?.remove();
                }
            }).catch(function() { submitReply.disabled = false; });
        }
    });
})();
</script>
@endpush
@endsection
