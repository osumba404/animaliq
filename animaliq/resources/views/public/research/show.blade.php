@extends('layouts.public')

@section('title', $researchProject->title)

@section('content')
    @if($researchProject->banner_image)
        <div class="rounded-lg overflow-hidden mb-6">
            <img src="{{ asset('storage/' . $researchProject->banner_image) }}" alt="{{ $researchProject->title }}" class="w-full h-56 object-cover">
        </div>
    @endif
    <h1 class="text-3xl font-bold mb-4 theme-text-primary">{{ $researchProject->title }}</h1>
    <p class="theme-text-secondary mb-6">{{ $researchProject->status }} · {{ $researchProject->start_date?->format('F Y') }} @if($researchProject->end_date)– {{ $researchProject->end_date->format('F Y') }}@endif</p>
    <div class="prose theme-text-secondary max-w-none mb-8">{!! nl2br(e($researchProject->summary ?? '')) !!}</div>

    <h2 class="text-xl font-semibold mb-4 theme-section-title">Reports &amp; Documents</h2>
    <div class="space-y-6">
        @forelse($researchProject->reports as $report)
            <div class="theme-card rounded-lg p-4">
                @if($report->banner_image)
                    <img src="{{ asset('storage/' . $report->banner_image) }}" alt="{{ $report->title }}" class="w-full max-h-48 object-cover rounded mb-3">
                @endif
                <h3 class="font-semibold theme-text-primary">{{ $report->title }}</h3>
                @if($report->published_at)
                    <p class="text-sm theme-text-secondary mb-2">Published {{ $report->published_at->format('F j, Y') }}</p>
                @endif
                @if($report->file_path)
                    @php
                        $ext = strtolower(pathinfo($report->file_path, PATHINFO_EXTENSION));
                        $isPdf = $ext === 'pdf';
                        $url = asset('storage/' . $report->file_path);
                    @endphp
                    <div class="flex flex-wrap gap-3 items-center">
                        <a href="{{ $url }}" class="theme-btn inline-block" target="_blank" rel="noopener">{{ $isPdf ? 'View / Download PDF' : 'Download' }}</a>
                        @if($isPdf)
                            <div class="w-full mt-2 rounded overflow-hidden border theme-border" style="height: 480px;">
                                <iframe src="{{ $url }}#view=FitH" class="w-full h-full" title="{{ $report->title }}"></iframe>
                            </div>
                        @endif
                    </div>
                @else
                    <p class="theme-text-secondary text-sm">Document not yet uploaded.</p>
                @endif
            </div>
        @empty
            <p class="theme-text-secondary">No reports yet.</p>
        @endforelse
    </div>
@endsection
