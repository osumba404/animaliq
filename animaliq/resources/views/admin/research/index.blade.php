@extends('layouts.admin')

@section('title', 'Research Projects')
@section('heading', 'Research')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold theme-text-primary">Research Projects</h1>
        <a href="{{ route('admin.research.create') }}" class="theme-btn">Add Project</a>
    </div>

    @if($projects->isEmpty())
        <div class="theme-card rounded-lg p-8 text-center">
            <p class="theme-text-secondary mb-4">No research projects yet.</p>
            <a href="{{ route('admin.research.create') }}" class="theme-btn">Add your first project</a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($projects as $p)
                <article class="theme-card rounded-lg p-4 transition hover:shadow-lg">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div class="min-w-0 flex-1">
                            <h2 class="font-semibold theme-text-primary text-lg">{{ $p->title }}</h2>
                            <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-2 text-sm theme-text-secondary">
                                <span><span class="font-medium">Status:</span> <span class="theme-badge">{{ $p->status ?? '—' }}</span></span>
                                @if($p->department)
                                    <span><span class="font-medium">Department:</span> {{ $p->department->name }}</span>
                                @endif
                                <span><span class="font-medium">Reports:</span> {{ $p->reports_count ?? 0 }}</span>
                                @if($p->start_date || $p->end_date)
                                    <span><span class="font-medium">Period:</span> {{ $p->start_date?->format('M Y') ?? '—' }}@if($p->end_date) → {{ $p->end_date->format('M Y') }}@endif</span>
                                @endif
                            </div>
                            @if($p->summary)
                                <p class="text-sm theme-text-secondary mt-2 line-clamp-2">{{ Str::limit($p->summary, 140) }}</p>
                            @endif
                        </div>
                        <div class="flex flex-wrap items-center gap-2 shrink-0">
                            <a href="{{ route('admin.research.edit', $p) }}" class="theme-link font-medium">Edit</a>
                            <form action="{{ route('admin.research.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Delete this project?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        {{ $projects->links() }}
    @endif
@endsection
