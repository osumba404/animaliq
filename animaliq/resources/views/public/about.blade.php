@extends('layouts.public')

@section('title', 'About Animal IQ – Mission, Vision, Team & Story')

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
            <div class="mt-6 accent-bar mx-auto"></div>
        </div>
    </section>

    <div class="max-w-5xl mx-auto">
        {{-- Founder Story --}}
        @if($founderStory)
            <section class="py-12 md:py-16">
                <div class="theme-card rounded-2xl overflow-hidden shadow-lg reveal">
                    <div class="flex flex-col md:flex-row">
                        {{-- Text: 60% on desktop --}}
                        <div class="flex-1 p-8 md:p-10 border-l-4 border-l-[var(--accent-orange)]" style="@if($founderImageUrl) flex: 0 0 60%; max-width: 60%; @endif">
                            <h2 class="text-2xl font-bold theme-text-primary mb-4">Founder Story</h2>
                            <div class="prose prose-lg max-w-none theme-text-secondary leading-relaxed text-base md:text-lg" style="color: var(--text-secondary);">{!! nl2br(e($founderStory)) !!}</div>
                        </div>
                        {{-- Image: 40% on desktop, below on mobile --}}
                        @if($founderImageUrl)
                        <div class="md:w-2/5 flex-shrink-0 min-h-[280px] md:min-h-0 overflow-hidden">
                            <img src="{{ $founderImageUrl }}" alt="Founder Story" class="w-full h-full object-cover object-center">
                        </div>
                        @endif
                    </div>
                </div>
            </section>
        @endif

        {{-- Mission & Vision --}}
        <section class="py-12 md:py-16">
            <style>
                .mv-split {
                    display: flex;
                    flex-wrap: wrap;
                    border-radius: 2rem;
                    overflow: hidden;
                    box-shadow: 0 25px 45px -12px rgba(0,0,0,0.22);
                    position: relative;
                    max-width: 900px;
                    margin: 0 auto;
                }
                .mv-panel {
                    flex: 1;
                    min-width: 280px;
                    padding: 52px 40px;
                    position: relative;
                    overflow: hidden;
                    transition: transform 0.3s ease, box-shadow 0.3s;
                }
                .mv-panel:hover {
                    transform: scale(1.02);
                    box-shadow: 0 30px 40px -12px rgba(0,0,0,0.3);
                    z-index: 2;
                    border-radius: 0.75rem;
                }
                .mv-bg-img {
                    position: absolute;
                    inset: 0;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    object-position: center;
                    z-index: 0;
                }
                .mv-overlay {
                    position: absolute;
                    inset: 0;
                    z-index: 1;
                }
                html.light-theme .mv-overlay { background: rgba(255,255,255,0.62); }
                html.dark-theme  .mv-overlay { background: rgba(0,0,0,0.62); }
                .mv-content {
                    position: relative;
                    z-index: 2;
                }
                .mv-icon {
                    width: 3rem;
                    height: 3rem;
                    margin-bottom: 1.5rem;
                    color: var(--accent-orange);
                }
                .mv-title {
                    font-size: 2rem;
                    font-weight: 800;
                    letter-spacing: -0.02em;
                    margin-bottom: 0.25rem;
                }
                html.light-theme .mv-panel .mv-title { color: #111; }
                html.light-theme .mv-panel .mv-sub   { color: #444; }
                html.light-theme .mv-panel .mv-desc  { color: #222; }
                html.dark-theme  .mv-panel .mv-title { color: #fff; }
                html.dark-theme  .mv-panel .mv-sub   { color: rgba(255,255,255,0.65); }
                html.dark-theme  .mv-panel .mv-desc  { color: rgba(255,255,255,0.9); }
                .mv-sub {
                    font-size: 0.78rem;
                    text-transform: uppercase;
                    letter-spacing: 3px;
                    font-weight: 600;
                    opacity: 0.8;
                    margin-bottom: 1.25rem;
                }
                .mv-desc {
                    font-size: 1rem;
                    line-height: 1.6;
                    font-weight: 500;
                    max-width: 92%;
                }
                @@media (max-width: 640px) {
                    .mv-panel { padding: 36px 24px; }
                    .mv-title { font-size: 1.65rem; }
                }
            </style>
            <h2 class="text-center text-2xl md:text-3xl font-bold theme-text-primary mb-8 reveal">Our Mission & Vision</h2>
            <div class="mv-split reveal">
                @if($mission)
                <div class="mv-panel mv-mission">
                    @if($missionImageUrl)
                    <img src="{{ $missionImageUrl }}" alt="" class="mv-bg-img">
                    @endif
                    <div class="mv-overlay"></div>
                    <div class="mv-content">
                        <svg class="mv-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <div class="mv-title">Mission</div>
                        <div class="mv-sub">Why we exist</div>
                        <div class="mv-desc">{{ $mission }}</div>
                    </div>
                </div>
                @endif
                @if($vision)
                <div class="mv-panel mv-vision">
                    @if($visionImageUrl)
                    <img src="{{ $visionImageUrl }}" alt="" class="mv-bg-img">
                    @endif
                    <div class="mv-overlay"></div>
                    <div class="mv-content">
                        <svg class="mv-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="mv-title">Vision</div>
                        <div class="mv-sub">Where we’re going</div>
                        <div class="mv-desc">{{ $vision }}</div>
                    </div>
                </div>
                @endif
            </div>
        </section>

        {{-- Core Values --}}
        @if(!empty($coreValues))
            <section class="py-12 md:py-16">
                <h2 class="text-2xl font-bold theme-text-primary mb-2 text-center reveal">Core Values</h2>
                <p class="text-center theme-text-secondary mb-10 max-w-xl mx-auto reveal reveal-delay-1">The principles that guide everything we do.</p>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @php
                        $parsedValues = is_string($coreValues) && str_starts_with(trim($coreValues), '[') 
                            ? json_decode($coreValues, true) 
                            : (array) $coreValues;
                    @endphp
                    @foreach($parsedValues as $index => $value)
                        @php $label = is_string($value) ? $value : ($value['name'] ?? json_encode($value)); @endphp
                        <div class="theme-card rounded-xl p-5 flex items-start gap-4 hover-lift border-l-4 border-l-[var(--accent-orange)] reveal reveal-delay-{{ min($index+1,6) }}">
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
                    <h2 class="text-2xl font-bold theme-text-primary mb-2 text-center reveal">Our Team</h2>
                    <p class="text-center theme-text-secondary mb-10 max-w-xl mx-auto reveal reveal-delay-1">The people behind our mission.</p>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($teamMembers as $tm)
                            <article class="theme-card rounded-2xl p-6 text-center hover-lift overflow-hidden group reveal reveal-delay-{{ min($loop->index+1,6) }}">
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
            <h2 class="text-2xl font-bold theme-text-primary mb-2 text-center reveal">Organizational Structure</h2>
            <p class="text-center theme-text-secondary mb-10 max-w-xl mx-auto reveal reveal-delay-1">How we're organized to deliver impact.</p>
            @forelse($departments as $dept)
                <div id="dept-{{ $dept->id }}" class="theme-card rounded-2xl p-6 md:p-8 mb-6 last:mb-0 hover-lift flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 reveal">
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
                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=info@animaliq.co.ke,animaliqinitiative@gmail.com&cc=tabithawaigwa99@gmail.com,sharonmona21@gmail.com,eva717.m@gmail.com&su=Request%20For%20Partnership" target="_blank" rel="noopener noreferrer" class="theme-btn">Get in touch</a>
                </div>
            </div>
        </section>
    </div>
@endsection
