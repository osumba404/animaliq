@extends('layouts.admin')

@section('title', 'Homepage Slides')
@section('heading', 'Homepage Slides')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold theme-text-primary">Homepage Slides</h1>
        <a href="{{ route('admin.settings.slides.create-form') }}" class="theme-btn" data-crud-modal>Add Slide</a>
    </div>

    @if($slides->isEmpty())
        <div class="theme-card rounded-lg p-8 text-center">
            <p class="theme-text-secondary mb-4">No slides yet.</p>
            <a href="{{ route('admin.settings.slides.create-form') }}" class="theme-btn" data-crud-modal>Add your first slide</a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($slides as $s)
                <article class="theme-card rounded-lg p-4 transition hover:shadow-lg">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div class="min-w-0 flex-1 flex flex-wrap items-start gap-4">
                            @if($s->image_path)
                                <img src="{{ asset('storage/' . $s->image_path) }}" alt="" class="w-24 h-16 object-cover rounded shrink-0">
                            @endif
                            <div class="min-w-0 flex-1">
                                <h2 class="font-semibold theme-text-primary text-lg">{{ $s->title ?: '(No title)' }}</h2>
                                <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-2 text-sm theme-text-secondary">
                                    <span><span class="font-medium">Status:</span> <span class="theme-badge">{{ $s->status ?? '—' }}</span></span>
                                    <span><span class="font-medium">Order:</span> {{ $s->display_order ?? 0 }}</span>
                                    @if($s->cta_text)
                                        <span><span class="font-medium">CTA:</span> {{ $s->cta_text }}</span>
                                    @endif
                                </div>
                                @if($s->subtitle)
                                    <p class="text-sm theme-text-secondary mt-2 line-clamp-2">{{ Str::limit($s->subtitle, 140) }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 shrink-0">
                            <a href="{{ route('admin.settings.slides.edit-form', $s) }}" class="theme-link font-medium" data-crud-modal>Edit</a>
                            <form action="{{ route('admin.settings.slides.destroy', $s) }}" method="POST" class="inline" onsubmit="return confirm('Delete this slide?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
@endsection
