@extends('layouts.public')

@section('title', $post->title . ' – Animal IQ Blog')

@section('meta')
@php
    $seoTitle         = $post->title . ' – Animal IQ Blog';
    $seoDescription   = $post->content
        ? Str::limit(strip_tags($post->content), 155)
        : $post->title . ' – Read this article on the Animal IQ blog about wildlife education and conservation.';
    $seoCanonical     = route('blog.show', $post);
    $seoImage         = $post->featured_image;
    $seoType          = 'article';
    $seoPublishedTime = $post->published_at?->toIso8601String();
    $seoModifiedTime  = $post->updated_at?->toIso8601String();
    $authorName       = $post->author->first_name . ' ' . $post->author->last_name;
    $jsonLd = [
        '@context'         => 'https://schema.org',
        '@type'            => 'BlogPosting',
        'headline'         => $post->title,
        'url'              => route('blog.show', $post),
        'description'      => Str::limit(strip_tags($post->content ?? ''), 155),
        'datePublished'    => $post->published_at?->toIso8601String(),
        'dateModified'     => $post->updated_at?->toIso8601String(),
        'author'           => ['@type' => 'Person', 'name' => $authorName],
        'publisher'        => ['@type' => 'Organization', 'name' => 'Animal IQ', 'url' => url('/')],
        'image'            => $post->featured_image ? asset('storage/' . $post->featured_image) : null,
        'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => route('blog.show', $post)],
        'breadcrumb'       => [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => route('blog.index')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $post->title, 'item' => route('blog.show', $post)],
            ],
        ],
    ];
@endphp
<meta name="author" content="{{ $authorName }}">
<meta property="article:author" content="{{ $authorName }}">
<meta property="article:section" content="Wildlife & Conservation">
@include('partials.seo')
@endsection

@push('styles')
<style>
/* Blog / CMS content – typography for HTML from editor */
.blog-content { color: var(--text-secondary); line-height: 1.75; }
.blog-content h1 { font-size: 1.875rem; font-weight: 700; margin-top: 2rem; margin-bottom: 0.75rem; color: var(--text-primary); line-height: 1.3; }
.blog-content h1:first-child { margin-top: 0; }
.blog-content h2 { font-size: 1.5rem; font-weight: 700; margin-top: 1.75rem; margin-bottom: 0.5rem; color: var(--text-primary); border-bottom: 1px solid var(--border-color); padding-bottom: 0.25rem; }
.blog-content h3 { font-size: 1.25rem; font-weight: 600; margin-top: 1.5rem; margin-bottom: 0.5rem; color: var(--text-primary); }
.blog-content h4 { font-size: 1.125rem; font-weight: 600; margin-top: 1.25rem; margin-bottom: 0.5rem; color: var(--text-primary); }
.blog-content p { margin-top: 0.75rem; margin-bottom: 0.75rem; }
.blog-content p:first-child { margin-top: 0; }
.blog-content ul { margin: 0.75rem 0; padding-left: 1.5rem; list-style-type: disc; }
.blog-content ol { margin: 0.75rem 0; padding-left: 1.5rem; list-style-type: decimal; }
.blog-content li { margin: 0.25rem 0; }
.blog-content li > ul, .blog-content li > ol { margin: 0.25rem 0; }
.blog-content blockquote { margin: 1rem 0; padding: 0.75rem 1rem; border-left: 4px solid var(--accent-orange); background: var(--bg-warm); color: var(--text-secondary); font-style: italic; border-radius: 0 0.25rem 0.25rem 0; }
.blog-content a { color: var(--accent-orange); text-decoration: none; }
.blog-content a:hover { text-decoration: underline; }
.blog-content strong { font-weight: 700; color: var(--text-primary); }
.blog-content em { font-style: italic; }
.blog-content hr { margin: 1.5rem 0; border: none; border-top: 1px solid var(--border-color); }
.blog-content img { max-width: 100%; height: auto; border-radius: 0.5rem; margin: 1rem 0; }
.blog-content pre, .blog-content code { font-family: ui-monospace, monospace; font-size: 0.875em; background: var(--bg-secondary); padding: 0.125rem 0.375rem; border-radius: 0.25rem; }
.blog-content pre { padding: 1rem; overflow-x: auto; margin: 1rem 0; }
.blog-content pre code { padding: 0; background: transparent; }
</style>
@endpush

@section('content')
    <nav aria-label="Breadcrumb" class="mb-4 text-sm">
        <ol class="flex flex-wrap items-center gap-1 theme-text-secondary">
            <li><a href="{{ route('home') }}" class="hover:underline">Home</a> <span aria-hidden="true" class="opacity-40">›</span></li>
            <li><a href="{{ route('blog.index') }}" class="hover:underline">Blog</a> <span aria-hidden="true" class="opacity-40">›</span></li>
            <li class="theme-text-primary font-medium">{{ $post->title }}</li>
        </ol>
    </nav>
    <article class="max-w-3xl mx-auto">
        @if($post->featured_image)
            <div class="rounded-2xl overflow-hidden mb-8 -mx-4 md:mx-0 h-64 md:h-96 shadow-lg">
                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
            </div>
        @endif
        <header class="mb-8 flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 reveal">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold theme-text-primary mb-3 leading-tight">{{ $post->title }}</h1>
                <p class="theme-text-secondary text-sm md:text-base">
                    By {{ $post->author->first_name }} {{ $post->author->last_name }}
                    @if($post->published_at)
                        · {{ $post->published_at->format('F j, Y') }}
                    @endif
                </p>
            </div>
            <div class="flex-shrink-0">@include('partials.share-button', ['shareTitle' => $post->title . ' – Animal IQ', 'url' => route('blog.show', $post)])</div>
        </header>

        <div class="blog-content">{!! $post->content !!}</div>

        {{-- Engagement Bar (X style) --}}
        <div class="mt-8 pt-6 border-t theme-border flex flex-wrap items-center gap-4" id="engagement-bar">
            {{-- Views --}}
            <span class="flex items-center gap-1.5 text-sm theme-text-secondary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                <span id="views-count">{{ number_format($post->views_count) }}</span>
            </span>
            {{-- Like --}}
            <button id="like-btn" class="flex items-center gap-1.5 text-sm transition {{ $userLiked ? '' : 'theme-text-secondary hover:text-red-500' }}" style="{{ $userLiked ? 'color:var(--accent-orange)' : '' }}" data-post="{{ $post->id }}" data-liked="{{ $userLiked ? 'true' : 'false' }}">
                <svg class="w-4 h-4" fill="{{ $userLiked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                <span id="likes-count">{{ number_format($post->likes_count) }}</span>
            </button>
            {{-- Comments jump --}}
            <a href="#comments" class="flex items-center gap-1.5 text-sm theme-text-secondary hover:theme-accent transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                <span id="comments-count">{{ number_format($post->comments_count) }}</span>
            </a>
            {{-- Bookmark --}}
            <button id="bookmark-btn" class="flex items-center gap-1.5 text-sm transition {{ $userBookmarked ? '' : 'theme-text-secondary hover:theme-accent' }}" style="{{ $userBookmarked ? 'color:var(--accent-orange)' : '' }}" data-post="{{ $post->id }}" data-bookmarked="{{ $userBookmarked ? 'true' : 'false' }}">
                <svg class="w-4 h-4" fill="{{ $userBookmarked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                <span id="bookmarks-count">{{ number_format($post->bookmarks_count) }}</span>
            </button>
            {{-- Share --}}
            <div class="ml-auto">@include('partials.share-button', ['shareTitle' => $post->title . ' – Animal IQ Initiative', 'url' => route('blog.show', $post)])</div>
        </div>

        {{-- Comments Section --}}
        <section class="mt-10 pt-6 border-t theme-border" id="comments">
            <h2 class="text-xl font-bold theme-text-primary mb-6">Comments <span class="text-base font-normal theme-text-secondary" id="comments-total">({{ $post->comments_count }})</span></h2>

            @auth
            {{-- Comment form --}}
            <div class="theme-card rounded-xl p-4 mb-6">
                <div class="flex gap-3">
                    <div class="w-9 h-9 rounded-full flex-shrink-0 flex items-center justify-center text-sm font-bold theme-bg-secondary theme-accent">
                        {{ strtoupper(mb_substr(auth()->user()->first_name ?? '?', 0, 1)) }}
                    </div>
                    <div class="flex-1">
                        <textarea id="comment-body" rows="3" class="theme-input w-full resize-none" placeholder="Share your thoughts..."></textarea>
                        <div class="flex justify-end mt-2">
                            <button id="submit-comment" class="theme-btn text-sm px-4 py-2" data-post="{{ $post->id }}">Post Comment</button>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="theme-card rounded-xl p-4 mb-6 text-center">
                <p class="theme-text-secondary text-sm mb-2">Log in to join the discussion.</p>
                <a href="{{ route('login') }}" class="theme-btn text-sm inline-block">Log in</a>
            </div>
            @endauth

            {{-- Comments List --}}
            <div id="comments-list">
                @foreach($post->comments as $comment)
                    @include('partials.post-comment', ['comment' => $comment, 'postId' => $post->id])
                @endforeach
            </div>
        </section>

        <footer class="mt-10 pt-6 border-t border-[var(--border-color)]">
            <a href="{{ route('blog.index') }}" class="theme-link font-medium">← Back to Blog</a>
        </footer>
    </article>

@push('scripts')
<script>
(function() {
    var csrf = document.querySelector('meta[name=csrf-token]')?.content || '';
    var postId = {{ $post->id }};
    var auth = {{ auth()->check() ? 'true' : 'false' }};

    function timeAgo(d) {
        var diff = Math.floor((Date.now() - new Date(d)) / 1000);
        if (diff < 60) return 'just now';
        if (diff < 3600) return Math.floor(diff/60) + 'm ago';
        if (diff < 86400) return Math.floor(diff/3600) + 'h ago';
        return Math.floor(diff/86400) + 'd ago';
    }

    // Like
    var likeBtn = document.getElementById('like-btn');
    if (likeBtn) {
        likeBtn.addEventListener('click', function() {
            if (!auth) { window.location = '{{ route('login') }}'; return; }
            fetch('/blog/' + postId + '/like', {method:'POST', headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json'}})
                .then(r => r.json()).then(data => {
                    document.getElementById('likes-count').textContent = data.count.toLocaleString();
                    var icon = likeBtn.querySelector('svg');
                    likeBtn.dataset.liked = data.liked ? 'true' : 'false';
                    icon.setAttribute('fill', data.liked ? 'currentColor' : 'none');
                    likeBtn.style.color = data.liked ? 'var(--accent-orange)' : '';
                });
        });
    }

    // Bookmark
    var bookmarkBtn = document.getElementById('bookmark-btn');
    if (bookmarkBtn) {
        bookmarkBtn.addEventListener('click', function() {
            if (!auth) { window.location = '{{ route('login') }}'; return; }
            fetch('/blog/' + postId + '/bookmark', {method:'POST', headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json'}})
                .then(r => r.json()).then(data => {
                    document.getElementById('bookmarks-count').textContent = data.count.toLocaleString();
                    var icon = bookmarkBtn.querySelector('svg');
                    bookmarkBtn.dataset.bookmarked = data.bookmarked ? 'true' : 'false';
                    icon.setAttribute('fill', data.bookmarked ? 'currentColor' : 'none');
                    bookmarkBtn.style.color = data.bookmarked ? 'var(--accent-orange)' : '';
                });
        });
    }

    // Comment submit
    var submitBtn = document.getElementById('submit-comment');
    if (submitBtn) {
        submitBtn.addEventListener('click', function() {
            var body = document.getElementById('comment-body').value.trim();
            if (!body) return;
            fetch('/blog/' + postId + '/comment', {
                method:'POST',
                headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json','Content-Type':'application/json'},
                body: JSON.stringify({body: body})
            }).then(r => r.json()).then(data => {
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
            });
        });
    }

    function renderComment(c) {
        var name = c.user ? c.user.name : 'User';
        var initials = name.charAt(0).toUpperCase();
        return '<div class="flex gap-3 mb-6 comment-item" id="comment-' + c.id + '">'
            + '<div class="w-9 h-9 rounded-full flex-shrink-0 flex items-center justify-center text-sm font-bold theme-bg-secondary theme-accent">' + initials + '</div>'
            + '<div class="flex-1">'
            + '<div class="flex items-center gap-2 mb-1"><span class="font-semibold theme-text-primary text-sm">' + name + '</span><span class="text-xs theme-text-secondary">' + c.created_at + '</span></div>'
            + '<p class="theme-text-secondary text-sm leading-relaxed">' + c.body + '</p>'
            + '<div class="flex items-center gap-3 mt-2">'
            + '<button class="like-comment-btn flex items-center gap-1 text-xs theme-text-secondary hover:text-red-500 transition" data-id="' + c.id + '"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg><span>0</span></button>'
            + '<button class="reply-btn text-xs theme-text-secondary hover:theme-accent transition" data-id="' + c.id + '" data-name="' + name + '">Reply</button>'
            + '</div></div></div>';
    }

    // Delegate like comment & reply
    document.getElementById('comments-list').addEventListener('click', function(e) {
        var likeBtn = e.target.closest('.like-comment-btn');
        if (likeBtn) {
            if (!auth) { window.location = '{{ route('login') }}'; return; }
            var commentId = likeBtn.dataset.id;
            fetch('/blog/comments/' + commentId + '/like', {method:'POST', headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json'}})
                .then(r => r.json()).then(data => {
                    var countEl = likeBtn.querySelector('span');
                    countEl.textContent = data.count;
                    likeBtn.querySelector('svg').setAttribute('fill', data.liked ? 'currentColor' : 'none');
                    likeBtn.style.color = data.liked ? 'var(--accent-orange)' : '';
                });
        }
        var replyBtn = e.target.closest('.reply-btn');
        if (replyBtn) {
            if (!auth) { window.location = '{{ route('login') }}'; return; }
            var cid = replyBtn.dataset.id;
            var cname = replyBtn.dataset.name;
            var existing = document.getElementById('reply-form-' + cid);
            if (existing) { existing.remove(); return; }
            var form = document.createElement('div');
            form.id = 'reply-form-' + cid;
            form.className = 'mt-3 flex gap-2';
            form.innerHTML = '<textarea class="theme-input flex-1 text-sm resize-none" rows="2" placeholder="Reply to ' + cname + '..."></textarea><button class="theme-btn text-sm px-3 submit-reply" data-parent="' + cid + '">Reply</button>';
            replyBtn.closest('.flex-1').appendChild(form);
        }
        var submitReply = e.target.closest('.submit-reply');
        if (submitReply) {
            if (!auth) { window.location = '{{ route('login') }}'; return; }
            var parentId = submitReply.dataset.parent;
            var textarea = submitReply.previousElementSibling;
            var body = textarea.value.trim();
            if (!body) return;
            fetch('/blog/' + postId + '/comment', {
                method:'POST',
                headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json','Content-Type':'application/json'},
                body: JSON.stringify({body: body, parent_id: parentId})
            }).then(r => r.json()).then(data => {
                if (data.comment) {
                    var parentItem = document.getElementById('comment-' + parentId);
                    if (parentItem) {
                        var repliesDiv = parentItem.querySelector('.replies-list') || (function(){
                            var d = document.createElement('div');
                            d.className = 'replies-list ml-12 mt-3 space-y-3';
                            parentItem.appendChild(d);
                            return d;
                        })();
                        var div = document.createElement('div');
                        div.innerHTML = renderComment(data.comment);
                        repliesDiv.appendChild(div.firstChild);
                    }
                    document.getElementById('reply-form-' + parentId)?.remove();
                }
            });
        }
    });
})();
</script>
@endpush
@endsection
