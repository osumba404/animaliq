@extends('layouts.public')

@section('title', 'About Animal IQ')

@section('meta')
@php
    $seoTitle       = 'About Animal IQ – Mission, Vision, Team & Story';
    $seoDescription = 'Discover Animal IQ: our founder story, mission to educate and conserve wildlife, vision for a nature-connected generation, core values, team, and organizational structure.';
    $seoCanonical   = route('about');
    $jsonLd = [
        '@context'    => 'https://schema.org',
        '@type'       => 'AboutPage',
        'name'        => 'About Animal IQ',
        'url'         => route('about'),
        'description' => 'Learn about Animal IQ: founder story, mission, vision, core values, team, and departments.',
        'publisher'   => ['@type' => 'Organization', 'name' => 'Animal IQ', 'url' => url('/')],
    ];
@endphp
@include('partials.seo')
@endsection

@section('content')
    {{-- Hero --}}
    <section class="relative overflow-hidden theme-bg-warm border-b theme-border -mx-4 px-4 py-16 md:py-24">
        <div class="container mx-auto px-4 text-center max-w-3xl">
            <p class="text-sm font-semibold tracking-wider uppercase theme-accent mb-3 animate-fade-in-up">Who we are</p>
            <h1 class="text-4xl md:text-5xl font-bold theme-text-primary mb-4 animate-fade-in-up animate-delay-1">About Animal IQ</h1>
            <p class="text-lg theme-text-secondary animate-fade-in-up animate-delay-2">Education, conservation, and community at the heart of wildlife protection.</p>
            <div class="mt-8 h-1 w-20 mx-auto rounded-full animate-fade-in-up animate-delay-3" style="background: linear-gradient(90deg, var(--orange-400), var(--orange-600));"></div>
        </div>
    </section>

    <div class="max-w-5xl mx-auto">
        {{-- Founder Story --}}
        @if($founderStory)
            <section class="py-12 md:py-16">
                <div class="theme-card rounded-2xl p-8 md:p-10 border-l-4 border-l-[var(--accent-orange)] shadow-lg">
                    <h2 class="text-2xl font-bold theme-text-primary mb-2">Founder Story</h2>
                    <div class="prose prose-lg max-w-none theme-text-secondary leading-relaxed text-base md:text-lg" style="color: var(--text-secondary);">{!! nl2br(e($founderStory)) !!}</div>
                </div>
            </section>
        @endif

        {{-- Mission & Vision --}}
        <section class="py-12 md:py-16 theme-bg-secondary -mx-4 px-4 md:rounded-2xl">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-center text-2xl md:text-3xl font-bold theme-text-primary mb-8">Our Mission & Vision</h2>
                <div class="grid md:grid-cols-2 gap-6 lg:gap-8">
                    @if($mission)
                        <article class="theme-card rounded-2xl overflow-hidden hover-lift group flex flex-col">
                            <div class="h-44 bg-[var(--bg-primary)] overflow-hidden img-zoom">
                                @if($missionImage)
                                    <img src="{{ asset('storage/' . $missionImage) }}" alt="Our mission" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center theme-text-secondary">
                                        <svg class="w-14 h-14 opacity-30 theme-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-6 md:p-7 flex-1 flex flex-col">
                                <p class="text-xs font-semibold theme-accent uppercase tracking-wide mb-2">Mission</p>
                                <h3 class="text-xl font-bold theme-text-primary mb-2 group-hover:theme-accent transition">Why we exist</h3>
                                <p class="theme-text-secondary leading-relaxed text-sm md:text-base flex-1">{{ $mission }}</p>
                            </div>
                        </article>
                    @endif
                    @if($vision)
                        <article class="theme-card rounded-2xl overflow-hidden hover-lift group flex flex-col">
                            <div class="h-44 bg-[var(--bg-primary)] overflow-hidden img-zoom">
                                @if($visionImage)
                                    <img src="{{ asset('storage/' . $visionImage) }}" alt="Our vision" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center theme-text-secondary">
                                        <svg class="w-14 h-14 opacity-30 theme-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-6 md:p-7 flex-1 flex flex-col">
                                <p class="text-xs font-semibold theme-accent uppercase tracking-wide mb-2">Vision</p>
                                <h3 class="text-xl font-bold theme-text-primary mb-2 group-hover:theme-accent transition">Where we’re going</h3>
                                <p class="theme-text-secondary leading-relaxed text-sm md:text-base flex-1">{{ $vision }}</p>
                            </div>
                        </article>
                    @endif
                </div>
            </div>
        </section>

        {{-- Core Values --}}
        @if(!empty($coreValues))
            <section class="py-12 md:py-16">
                <h2 class="text-2xl font-bold theme-text-primary mb-2 text-center">Core Values</h2>
                <p class="text-center theme-text-secondary mb-10 max-w-xl mx-auto">The principles that guide everything we do.</p>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach((array) $coreValues as $index => $value)
                        @php $label = is_string($value) ? $value : ($value['name'] ?? json_encode($value)); @endphp
                        <div class="theme-card rounded-xl p-5 flex items-start gap-4 hover-lift border-l-4 border-l-[var(--accent-orange)]">
                            <span class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold theme-bg-warm theme-accent border-2 theme-border">{{ $index + 1 }}</span>
                            <p class="theme-text-primary font-medium pt-1">{{ $label }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- Team --}}
        @if($teamMembers->isNotEmpty())
            <section class="py-12 md:py-16 theme-bg-warm -mx-4 px-4 md:rounded-2xl">
                <div class="max-w-5xl mx-auto">
                    <h2 class="text-2xl font-bold theme-text-primary mb-2 text-center">Our Team</h2>
                    <p class="text-center theme-text-secondary mb-10 max-w-xl mx-auto">The people behind our mission.</p>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($teamMembers as $tm)
                            <article class="theme-card rounded-2xl p-6 text-center hover-lift overflow-hidden group">
                                <div class="mb-4 flex justify-center">
                                    @if($tm->image)
                                        <img src="{{ asset('storage/' . $tm->image) }}" alt="{{ $tm->name }}" class="w-28 h-28 object-cover rounded-[1.25rem] ring-4 ring-[var(--orange-200)] group-hover:ring-[var(--accent-orange)] transition">
                                    @else
                                        <div class="w-28 h-28 rounded-[1.25rem] flex items-center justify-center text-3xl font-bold theme-bg-secondary theme-accent ring-4 ring-[var(--orange-200)]">{{ strtoupper(mb_substr($tm->name ?? '?', 0, 1)) }}</div>
                                    @endif
                                </div>
                                <h3 class="text-lg font-bold theme-text-primary">{{ $tm->name }}</h3>
                                <p class="text-sm font-semibold theme-accent mt-1">{{ $tm->role }}</p>
                                @if($tm->role_description)
                                    <p class="text-sm theme-text-secondary mt-3 leading-relaxed">{{ Str::limit($tm->role_description, 120) }}</p>
                                @endif
                                @if($tm->remarks)
                                    <p class="text-xs theme-text-secondary mt-2 italic">{{ Str::limit($tm->remarks, 80) }}</p>
                                @endif
                                @include('partials.social-icons', ['socials' => $tm->socials ?? []])
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Organizational Structure --}}
        <section class="py-12 md:py-16">
            <h2 class="text-2xl font-bold theme-text-primary mb-2 text-center">Organizational Structure</h2>
            <p class="text-center theme-text-secondary mb-10 max-w-xl mx-auto">How we're organized to deliver impact.</p>
            @forelse($departments as $dept)
                <div id="dept-{{ $dept->id }}" class="theme-card rounded-2xl p-6 md:p-8 mb-6 last:mb-0 hover-lift flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                    <div class="flex-1">
                    <h3 class="text-xl font-bold theme-text-primary flex items-center gap-2">
                        <span class="w-1 h-6 rounded-full bg-[var(--accent-orange)]"></span>
                        {{ $dept->name }}
                    </h3>
                    @if($dept->mandate)
                        <p class="text-sm theme-text-secondary mt-2 mb-4">{{ $dept->mandate }}</p>
                    @endif
                    @if($dept->departmentMembers->isNotEmpty())
                        <ul class="space-y-2">
                            @foreach($dept->departmentMembers as $dm)
                                <li class="flex items-center gap-2 text-sm theme-text-secondary">
                                    <span class="w-2 h-2 rounded-full bg-[var(--orange-400)] shrink-0"></span>
                                    <span class="theme-text-primary font-medium">{{ $dm->user->first_name }} {{ $dm->user->last_name }}</span>
                                    @if($dm->position_title)<span class="theme-text-secondary">— {{ $dm->position_title }}</span>@endif
                                    @if($dm->is_lead)<span class="text-xs px-2 py-0.5 rounded-full theme-bg-warm theme-accent font-medium">Lead</span>@endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-sm theme-text-secondary italic">Members to be listed.</p>
                    @endif
                    </div>
                    <div class="flex-shrink-0">
                        @include('partials.share-button', ['shareTitle' => $dept->name . ' – Animal IQ', 'url' => route('about') . '#dept-' . $dept->id])
                    </div>
                </div>
            @empty
                <div class="theme-card rounded-2xl p-8 text-center">
                    <p class="theme-text-secondary">Department structure will be listed here.</p>
                </div>
            @endforelse
        </section>

        {{-- Resources --}}
        <section class="py-12 md:py-16 theme-bg-secondary -mx-4 px-4 rounded-2xl mb-8">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-2xl font-bold theme-text-primary mb-4">Resources</h2>
                <p class="theme-text-secondary mb-6">Strategic documents and reports.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    @if($strategicPlanUrl)
                        <a href="{{ asset('storage/' . $strategicPlanUrl) }}" class="theme-btn inline-flex items-center gap-2" download>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Download Strategic Plan
                        </a>
                    @endif
                    @if(!empty($annualReports))
                        <span class="theme-text-secondary text-sm">Annual reports available.</span>
                    @endif
                    @if(!$strategicPlanUrl && empty($annualReports))
                        <p class="theme-text-secondary text-sm w-full">Documents will appear here when added.</p>
                    @endif
                </div>
            </div>
        </section>

        {{-- Partnerships --}}
        <section class="py-12 md:py-16">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-2xl font-bold theme-text-primary mb-2 text-center">Partnerships</h2>
                <p class="text-center theme-text-secondary mb-10 max-w-xl mx-auto">Work with us. Partners, media kit, and partnership opportunities.</p>
                <div class="theme-card rounded-2xl p-8 md:p-10 mb-8">
                    <h3 class="text-xl font-bold theme-text-primary mb-4">Why Partner With Us</h3>
                    <p class="theme-text-secondary leading-relaxed mb-4">Animal IQ brings together wildlife education, youth empowerment, and community conservation. We work with institutions, NGOs, and businesses to amplify impact.</p>
                    <ul class="space-y-2 theme-text-secondary">
                        <li class="flex items-start gap-2"><span class="theme-accent font-bold">·</span> Institutional collaborations for school and campus programs</li>
                        <li class="flex items-start gap-2"><span class="theme-accent font-bold">·</span> Media and communications partnerships</li>
                        <li class="flex items-start gap-2"><span class="theme-accent font-bold">·</span> Resource development and grant alignment</li>
                    </ul>
                </div>
                <div class="theme-card rounded-2xl p-8 md:p-10 mb-8">
                    <h3 class="text-xl font-bold theme-text-primary mb-4">Partnership Resources</h3>
                    <p class="theme-text-secondary mb-6">Download our media kit and partnership proposal template.</p>
                    <div class="flex flex-wrap gap-4">
                        @if($mediaKitUrl ?? null)
                            <a href="{{ $mediaKitUrl }}" class="theme-btn inline-block" target="_blank" rel="noopener">Download Media Kit</a>
                        @endif
                        @if($proposalTemplateUrl ?? null)
                            <a href="{{ asset('storage/' . $proposalTemplateUrl) }}" class="theme-btn-outline inline-block" download>Partnership Proposal Template</a>
                        @endif
                    </div>
                    @if(empty($mediaKitUrl ?? '') && empty($proposalTemplateUrl ?? ''))
                        <p class="theme-text-secondary text-sm mt-4">Resources will be listed here when available.</p>
                    @endif
                </div>
                <div class="theme-card rounded-2xl p-8 md:p-10 text-center">
                    <h3 class="text-xl font-bold theme-text-primary mb-2">Interested in Partnering?</h3>
                    <p class="theme-text-secondary mb-4">Reach out to discuss collaboration opportunities.</p>
                    <a href="{{ route('home') }}" class="theme-btn">Get in touch</a>
                </div>
            </div>
        </section>
    </div>
@endsection
