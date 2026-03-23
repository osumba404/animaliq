@extends('layouts.public')

@section('title', $researchProject->title)

@section('meta')
@php
    $seoTitle       = $researchProject->title . ' – Animal IQ Research';
    $seoDescription = $researchProject->summary
        ? Str::limit(strip_tags($researchProject->summary), 155)
        : 'Read about the ' . $researchProject->title . ' research project by Animal IQ' . ($researchProject->department ? ', ' . $researchProject->department->name . ' department' : '') . '.';
    $seoCanonical   = route('research.show', $researchProject);
    $seoImage       = $researchProject->banner_image;
    $jsonLd = [
        '@context'      => 'https://schema.org',
        '@type'         => 'ScholarlyArticle',
        'name'          => $researchProject->title,
        'url'           => route('research.show', $researchProject),
        'description'   => strip_tags($researchProject->summary ?? ''),
        'datePublished' => $researchProject->start_date?->toDateString(),
        'dateModified'  => $researchProject->updated_at?->toDateString(),
        'publisher'     => ['@type' => 'Organization', 'name' => 'Animal IQ', 'url' => url('/')],
        'image'         => $researchProject->banner_image ? asset('storage/' . $researchProject->banner_image) : null,
        'breadcrumb'    => [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',     'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Research', 'item' => route('research.index')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $researchProject->title, 'item' => route('research.show', $researchProject)],
            ],
        ],
    ];
@endphp
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
    <article class="max-w-3xl mx-auto">
        @if($researchProject->banner_image)
            <div class="rounded-2xl overflow-hidden mb-8 -mx-4 md:mx-0 h-64 md:h-96 shadow-lg">
                <img src="{{ asset('storage/' . $researchProject->banner_image) }}" alt="{{ $researchProject->title }}" class="w-full h-full object-cover">
            </div>
        @endif
        <header class="mb-8 flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 reveal">
            <div>
                @if($researchProject->department)
                    <p class="text-sm font-semibold theme-accent uppercase tracking-wide mb-2">{{ $researchProject->department->name }}</p>
                @endif
                <h1 class="text-3xl md:text-4xl font-bold theme-text-primary">{{ $researchProject->title }}</h1>
                <p class="theme-text-secondary mt-2 flex items-center gap-2">
                    <span class="theme-badge">{{ $researchProject->status }}</span>
                    @if($researchProject->start_date) {{ $researchProject->start_date->format('F Y') }} @endif
                    @if($researchProject->end_date) – {{ $researchProject->end_date->format('F Y') }} @endif
                </p>
            </div>
            <div class="flex-shrink-0">@include('partials.share-button', ['shareTitle' => $researchProject->title . ' – Animal IQ', 'url' => route('research.show', $researchProject)])</div>
        </header>

        <section class="mb-10 reveal">
            <h2 class="text-xl font-bold theme-text-primary mb-3">Summary</h2>
            <div class="blog-content mb-10">{!! nl2br(e($researchProject->summary ?? 'No summary yet.')) !!}</div>
        </section>

        <section class="pt-10 border-t theme-border">
            <h2 class="text-2xl font-bold theme-text-primary mb-6">Reports &amp; Documents</h2>
            @forelse($researchProject->reports as $report)
                <article class="theme-card rounded-2xl p-6 md:p-8 mb-6 last:mb-0 hover-lift">
                    @if($report->banner_image ?? null)
                        <div class="rounded-xl overflow-hidden mb-4 h-48">
                            <img src="{{ asset('storage/' . $report->banner_image) }}" alt="{{ $report->title }}" class="w-full h-full object-cover">
                        </div>
                    @endif
                    <h3 class="text-lg font-bold theme-text-primary mb-2">{{ $report->title }}</h3>
                    @if($report->published_at)
                        <p class="text-sm theme-text-secondary mb-4">Published {{ $report->published_at->format('F j, Y') }}</p>
                    @endif
                    @if($report->file_path)
                        @php
                            $ext = strtolower(pathinfo($report->file_path, PATHINFO_EXTENSION));
                            $isPdf = $ext === 'pdf';
                            $url = asset('storage/' . $report->file_path);
                        @endphp
                        <div class="flex flex-wrap gap-3 items-center">
                            <a href="{{ $url }}" class="theme-btn inline-block" target="_blank" rel="noopener">{{ $isPdf ? 'View / Download PDF' : 'Download' }}</a>
                        </div>
                        @if($isPdf)
                            <div class="mt-4 rounded-xl overflow-hidden border theme-border" style="height: 480px;">
                                <iframe src="{{ $url }}#view=FitH" class="w-full h-full" title="{{ $report->title }}"></iframe>
                            </div>
                        @endif
                    @else
                        <p class="text-sm theme-text-secondary">Document not yet uploaded.</p>
                    @endif
                </article>
            @empty
                <p class="theme-text-secondary">No reports yet.</p>
            @endforelse
        </section>
    </article>
@endsection
