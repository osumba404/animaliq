@extends('layouts.public')

@section('title', $researchProject->title)

@section('content')
    <h1 class="text-3xl font-bold mb-4">{{ $researchProject->title }}</h1>
    <p class="text-[#706f6c] mb-4">{{ $researchProject->status }} · {{ $researchProject->start_date?->format('F Y') }} @if($researchProject->end_date)– {{ $researchProject->end_date->format('F Y') }}@endif</p>
    <div class="prose dark:prose-invert max-w-none mb-8">{!! nl2br(e($researchProject->summary ?? '')) !!}</div>
    <h2 class="text-xl font-semibold mb-2">Reports</h2>
    <ul class="space-y-2">
        @forelse($researchProject->reports as $report)
            <li>
                @if($report->file_path)
                    <a href="{{ asset('storage/' . $report->file_path) }}" class="text-[#f53003] hover:underline" target="_blank">{{ $report->title }}</a>
                @else
                    {{ $report->title }}
                @endif
                @if($report->published_at) – {{ $report->published_at->format('M j, Y') }} @endif
            </li>
        @empty
            <li class="text-[#706f6c]">No reports yet.</li>
        @endforelse
    </ul>
@endsection
