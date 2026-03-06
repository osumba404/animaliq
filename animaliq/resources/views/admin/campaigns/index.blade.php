@extends('layouts.admin')

@section('title', 'Campaigns')
@section('heading', 'Campaigns')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold theme-text-primary">Campaigns</h1>
        <a href="{{ route('admin.campaigns.create') }}" class="theme-btn">Add Campaign</a>
    </div>

    @if($campaigns->isEmpty())
        <div class="theme-card rounded-lg p-8 text-center">
            <p class="theme-text-secondary mb-4">No campaigns yet.</p>
            <a href="{{ route('admin.campaigns.create') }}" class="theme-btn">Add your first campaign</a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($campaigns as $c)
                <article class="theme-card rounded-lg p-4 transition hover:shadow-lg">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div class="min-w-0 flex-1 flex flex-wrap items-start gap-4">
                            @if($c->image ?? null)
                                <img src="{{ asset('storage/' . $c->image) }}" alt="" class="w-20 h-20 object-cover rounded-lg shrink-0">
                            @endif
                            <div class="min-w-0 flex-1">
                            <h2 class="font-semibold theme-text-primary text-lg">{{ $c->title }}</h2>
                            <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-2 text-sm theme-text-secondary">
                                <span><span class="font-medium">Posts:</span> {{ $c->posts_count ?? 0 }}</span>
                                @if($c->start_date || $c->end_date)
                                    <span><span class="font-medium">Period:</span> {{ $c->start_date?->format('M j, Y') ?? '—' }} @if($c->end_date)→ {{ $c->end_date->format('M j, Y') }}@endif</span>
                                @endif
                            </div>
                            @if($c->description)
                                <p class="text-sm theme-text-secondary mt-2 line-clamp-2">{{ Str::limit($c->description, 140) }}</p>
                            @endif
                            </div>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 shrink-0">
                            <a href="{{ route('admin.campaigns.edit', $c) }}" class="theme-link font-medium">Edit</a>
                            <form action="{{ route('admin.campaigns.destroy', $c) }}" method="POST" class="inline" onsubmit="return confirm('Delete this campaign?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        {{ $campaigns->links() }}
    @endif
@endsection
