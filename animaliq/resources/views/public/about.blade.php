@extends('layouts.public')

@section('title', 'About Animal IQ')

@section('content')
    <h1 class="text-3xl font-bold mb-6 theme-text-primary">About Animal IQ</h1>

    @if($founderStory)
        <section class="mb-8">
            <h2 class="text-xl font-semibold mb-2 theme-section-title">Founder Story</h2>
            <div class="prose theme-text-secondary max-w-none">{!! nl2br(e($founderStory)) !!}</div>
        </section>
    @endif

    @if($mission)
        <section class="mb-8">
            <h2 class="text-xl font-semibold mb-2 theme-section-title">Mission</h2>
            <div class="flex flex-col md:flex-row gap-4 items-start">
                @if($missionImage)
                    <img src="{{ asset('storage/' . $missionImage) }}" alt="Mission" class="rounded-lg max-w-sm w-full object-cover shrink-0">
                @endif
                <p class="theme-text-secondary flex-1">{{ $mission }}</p>
            </div>
        </section>
    @endif

    @if($vision)
        <section class="mb-8">
            <h2 class="text-xl font-semibold mb-2 theme-section-title">Vision</h2>
            <div class="flex flex-col md:flex-row gap-4 items-start">
                @if($visionImage)
                    <img src="{{ asset('storage/' . $visionImage) }}" alt="Vision" class="rounded-lg max-w-sm w-full object-cover shrink-0">
                @endif
                <p class="theme-text-secondary flex-1">{{ $vision }}</p>
            </div>
        </section>
    @endif

    @if(!empty($coreValues))
        <section class="mb-8">
            <h2 class="text-xl font-semibold mb-2 theme-section-title">Core Values</h2>
            <ul class="list-disc pl-6 theme-text-secondary">
                @foreach((array) $coreValues as $value)
                    <li>{{ is_string($value) ? $value : ($value['name'] ?? json_encode($value)) }}</li>
                @endforeach
            </ul>
        </section>
    @endif

    @if($teamMembers->isNotEmpty())
        <section class="mb-8">
            <h2 class="text-xl font-semibold mb-4 theme-section-title">Our Team</h2>
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($teamMembers as $tm)
                    <div class="theme-card rounded-lg p-4">
                        @if($tm->image)
                            <img src="{{ asset('storage/' . $tm->image) }}" alt="{{ $tm->name }}" class="w-20 h-20 object-cover rounded-full mb-2">
                        @endif
                        <h3 class="font-semibold theme-text-primary">{{ $tm->name }}</h3>
                        <p class="text-sm theme-accent">{{ $tm->role }}</p>
                        @if($tm->role_description)
                            <p class="text-sm theme-text-secondary mt-1">{{ $tm->role_description }}</p>
                        @endif
                        @if($tm->remarks)
                            <p class="text-sm theme-text-secondary mt-1">{{ $tm->remarks }}</p>
                        @endif
                        @if(!empty($tm->socials))
                            <div class="flex gap-2 mt-2">
                                @if(!empty($tm->socials['twitter']))<a href="{{ $tm->socials['twitter'] }}" class="text-sm theme-link" target="_blank" rel="noopener">Twitter</a>@endif
                                @if(!empty($tm->socials['instagram']))<a href="{{ $tm->socials['instagram'] }}" class="text-sm theme-link" target="_blank" rel="noopener">Instagram</a>@endif
                                @if(!empty($tm->socials['facebook']))<a href="{{ $tm->socials['facebook'] }}" class="text-sm theme-link" target="_blank" rel="noopener">Facebook</a>@endif
                                @if(!empty($tm->socials['linkedin']))<a href="{{ $tm->socials['linkedin'] }}" class="text-sm theme-link" target="_blank" rel="noopener">LinkedIn</a>@endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <section class="mb-8">
        <h2 class="text-xl font-semibold mb-4 theme-section-title">Organizational Structure</h2>
        @forelse($departments as $dept)
            <div class="mb-6 theme-card rounded-lg p-4">
                <h3 class="font-semibold text-lg theme-text-primary">{{ $dept->name }}</h3>
                @if($dept->mandate)
                    <p class="text-sm theme-text-secondary mb-2">{{ $dept->mandate }}</p>
                @endif
                <ul class="list-disc pl-6 theme-text-secondary">
                    @foreach($dept->departmentMembers as $dm)
                        <li>{{ $dm->user->first_name }} {{ $dm->user->last_name }}{!! $dm->position_title ? ' – ' . e($dm->position_title) : '' !!}{!! $dm->is_lead ? ' (Lead)' : '' !!}</li>
                    @endforeach
                </ul>
            </div>
        @empty
            <p class="theme-text-secondary">Department structure will be listed here.</p>
        @endforelse
    </section>

    @if($strategicPlanUrl)
        <p class="mb-2"><a href="{{ asset('storage/' . $strategicPlanUrl) }}" class="theme-link" download>Download Strategic Plan</a></p>
    @endif
    @if(!empty($annualReports))
        <p class="theme-text-secondary">Annual reports can be made available here via admin.</p>
    @endif
@endsection
