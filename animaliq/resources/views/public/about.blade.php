@extends('layouts.public')

@section('title', 'About Animal IQ')

@section('content')
    <h1 class="text-3xl font-bold mb-6">About Animal IQ</h1>

    @if($founderStory)
        <section class="mb-8">
            <h2 class="text-xl font-semibold mb-2">Founder Story</h2>
            <div class="prose dark:prose-invert">{!! nl2br(e($founderStory)) !!}</div>
        </section>
    @endif

    @if($mission)
        <section class="mb-8">
            <h2 class="text-xl font-semibold mb-2">Mission</h2>
            <p>{{ $mission }}</p>
        </section>
    @endif

    @if($vision)
        <section class="mb-8">
            <h2 class="text-xl font-semibold mb-2">Vision</h2>
            <p>{{ $vision }}</p>
        </section>
    @endif

    @if(!empty($coreValues))
        <section class="mb-8">
            <h2 class="text-xl font-semibold mb-2">Core Values</h2>
            <ul class="list-disc pl-6">
                @foreach((array) $coreValues as $value)
                    <li>{{ is_string($value) ? $value : ($value['name'] ?? json_encode($value)) }}</li>
                @endforeach
            </ul>
        </section>
    @endif

    <section class="mb-8">
        <h2 class="text-xl font-semibold mb-4">Organizational Structure</h2>
        @forelse($departments as $dept)
            <div class="mb-6">
                <h3 class="font-semibold text-lg">{{ $dept->name }}</h3>
                @if($dept->mandate)
                    <p class="text-sm text-[#706f6c] mb-2">{{ $dept->mandate }}</p>
                @endif
                <ul class="list-disc pl-6">
                    @foreach($dept->departmentMembers as $dm)
                        <li>{{ $dm->user->first_name }} {{ $dm->user->last_name }}{!! $dm->position_title ? ' – ' . e($dm->position_title) : '' !!}{!! $dm->is_lead ? ' (Lead)' : '' !!}</li>
                    @endforeach
                </ul>
            </div>
        @empty
            <p class="text-[#706f6c]">Department structure will be listed here.</p>
        @endforelse
    </section>

    @if($strategicPlanUrl)
        <p class="mb-2"><a href="{{ asset('storage/' . $strategicPlanUrl) }}" class="text-[#f53003] underline" download>Download Strategic Plan</a></p>
    @endif
    @if(!empty($annualReports))
        <p class="text-[#706f6c]">Annual reports can be made available here via admin.</p>
    @endif
@endsection
