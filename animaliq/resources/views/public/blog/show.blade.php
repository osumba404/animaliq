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

        <footer class="mt-10 pt-6 border-t border-[var(--border-color)]">
            <a href="{{ route('blog.index') }}" class="theme-link font-medium">← Back to Blog</a>
        </footer>
    </article>
@endsection
