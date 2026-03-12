@extends('layouts.public')

@section('title', $researchProject->title)

@section('meta')
@php
    $seoTitle = $researchProject->title . ' – Animal IQ';
    $seoDescription = Str::limit(strip_tags($researchProject->summary ?? ''), 160);
    $seoCanonical = route('research.show', $researchProject);
    $seoImage = $researchProject->banner_image;
@endphp
@include('partials.seo')
@endsection

@section('content')
    @if($researchProject->banner_image)
        <div class="rounded-2xl overflow-hidden mb-8 -mx-4 md:mx-0 h-56 md:h-72">
            <img src="{{ asset('storage/' . $researchProject->banner_image) }}" alt="{{ $researchProject->title }}" class="w-full h-full object-cover">
        </div>
    @endif

    <div class="max-w-4xl mx-auto">
        <header class="mb-8 flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
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

        <section class="mb-10">
            <h2 class="text-xl font-bold theme-text-primary mb-3">Summary</h2>
            <div class="prose prose-lg max-w-none theme-text-secondary leading-relaxed">{!! nl2br(e($researchProject->summary ?? 'No summary yet.')) !!}</div>
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
    </div>
@endsection
