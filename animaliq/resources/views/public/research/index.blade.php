@extends('layouts.public')

@section('title', 'Research & Knowledge Hub')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Research & Knowledge Hub</h1>
    <p class="mb-8">Youth-led research, reports, and knowledge sharing.</p>
    <div class="grid md:grid-cols-2 gap-6">
        @forelse($projects as $project)
            <a href="{{ route('research.show', $project) }}" class="block p-4 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] hover:border-[#19140035]">
                <h2 class="font-semibold">{{ $project->title }}</h2>
                <p class="text-sm text-[#706f6c]">{{ $project->status }} · {{ $project->start_date?->format('Y') }}</p>
                <p class="text-sm mt-1 line-clamp-2">{{ $project->summary }}</p>
            </a>
        @empty
            <p class="text-[#706f6c] col-span-full">No research projects yet.</p>
        @endforelse
    </div>
@endsection
