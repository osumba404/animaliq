@extends('layouts.public')

@section('title', 'About Animal IQ')

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
            <div class="max-w-5xl mx-auto">
                <h2 class="text-center text-2xl font-bold theme-text-primary mb-10">Our Mission & Vision</h2>
                <div class="grid md:grid-cols-2 gap-8">
                    @if($mission)
                        <div class="theme-card rounded-2xl p-6 md:p-8 overflow-hidden hover-lift">
                            <div class="flex flex-col gap-4">
                                @if($missionImage)
                                    <img src="{{ asset('storage/' . $missionImage) }}" alt="Our mission" class="w-full h-48 object-cover rounded-xl">
                                @endif
                                <div>
                                    <h3 class="text-xl font-bold theme-accent mb-3">Mission</h3>
                                    <p class="theme-text-secondary leading-relaxed">{{ $mission }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($vision)
                        <div class="theme-card rounded-2xl p-6 md:p-8 overflow-hidden hover-lift">
                            <div class="flex flex-col gap-4">
                                @if($visionImage)
                                    <img src="{{ asset('storage/' . $visionImage) }}" alt="Our vision" class="w-full h-48 object-cover rounded-xl">
                                @endif
                                <div>
                                    <h3 class="text-xl font-bold theme-accent mb-3">Vision</h3>
                                    <p class="theme-text-secondary leading-relaxed">{{ $vision }}</p>
                                </div>
                            </div>
                        </div>
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
                                        <img src="{{ asset('storage/' . $tm->image) }}" alt="{{ $tm->name }}" class="w-28 h-28 object-cover rounded-full ring-4 ring-[var(--orange-200)] group-hover:ring-[var(--accent-orange)] transition">
                                    @else
                                        <div class="w-28 h-28 rounded-full flex items-center justify-center text-3xl font-bold theme-bg-secondary theme-accent ring-4 ring-[var(--orange-200)]">{{ strtoupper(mb_substr($tm->name ?? '?', 0, 1)) }}</div>
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
                                @if(!empty(array_filter($tm->socials ?? [])))
                                    <div class="flex justify-center gap-3 mt-4 flex-wrap">
                                        @if(!empty($tm->socials['twitter']))<a href="{{ $tm->socials['twitter'] }}" class="text-sm theme-link font-medium" target="_blank" rel="noopener" aria-label="Twitter">Twitter</a>@endif
                                        @if(!empty($tm->socials['instagram']))<a href="{{ $tm->socials['instagram'] }}" class="text-sm theme-link font-medium" target="_blank" rel="noopener" aria-label="Instagram">Instagram</a>@endif
                                        @if(!empty($tm->socials['facebook']))<a href="{{ $tm->socials['facebook'] }}" class="text-sm theme-link font-medium" target="_blank" rel="noopener" aria-label="Facebook">Facebook</a>@endif
                                        @if(!empty($tm->socials['linkedin']))<a href="{{ $tm->socials['linkedin'] }}" class="text-sm theme-link font-medium" target="_blank" rel="noopener" aria-label="LinkedIn">LinkedIn</a>@endif
                                    </div>
                                @endif
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
                <div class="theme-card rounded-2xl p-6 md:p-8 mb-6 last:mb-0 hover-lift">
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
    </div>
@endsection
