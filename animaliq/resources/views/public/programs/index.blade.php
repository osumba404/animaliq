@extends('layouts.public')

@section('title', 'Our Programs')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Our Programs</h1>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($programs as $program)
            <a href="{{ route('programs.show', $program) }}" class="block p-4 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] hover:border-[#19140035]">
                <h2 class="font-semibold text-lg">{{ $program->title }}</h2>
                <p class="text-sm text-[#706f6c] mt-1 line-clamp-2">{{ $program->description }}</p>
            </a>
        @empty
            <p class="text-[#706f6c] col-span-full">No programs yet.</p>
        @endforelse
    </div>
@endsection
