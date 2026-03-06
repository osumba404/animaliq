@extends('layouts.admin')

@section('title', 'Programs')
@section('heading', 'Programs')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold theme-text-primary">Programs</h1>
        <a href="{{ route('admin.programs.create') }}" class="theme-btn">Add Program</a>
    </div>

    @if($programs->isEmpty())
        <div class="theme-card rounded-lg p-8 text-center">
            <p class="theme-text-secondary mb-4">No programs yet.</p>
            <a href="{{ route('admin.programs.create') }}" class="theme-btn">Add your first program</a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($programs as $p)
                <article class="theme-card rounded-lg p-4 transition hover:shadow-lg">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div class="min-w-0 flex-1 flex flex-wrap items-start gap-4">
                            @if($p->image)
                                <img src="{{ asset('storage/' . $p->image) }}" alt="" class="w-20 h-20 object-cover rounded-lg shrink-0">
                            @endif
                            <div class="min-w-0 flex-1">
                            <h2 class="font-semibold theme-text-primary text-lg">{{ $p->title }}</h2>
                            <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-2 text-sm theme-text-secondary">
                                <span><span class="font-medium">Status:</span> <span class="theme-badge">{{ $p->status ?? '—' }}</span></span>
                                @if($p->department)
                                    <span><span class="font-medium">Department:</span> {{ $p->department->name }}</span>
                                @endif
                                <span><span class="font-medium">Events:</span> {{ $p->events_count ?? 0 }}</span>
                            </div>
                            @if($p->description)
                                <p class="text-sm theme-text-secondary mt-2 line-clamp-2">{{ Str::limit($p->description, 140) }}</p>
                            @endif
                            </div>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 shrink-0">
                            <a href="{{ route('admin.programs.edit', $p) }}" class="theme-link font-medium">Edit</a>
                            <form action="{{ route('admin.programs.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Delete this program?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        {{ $programs->links() }}
    @endif
@endsection
