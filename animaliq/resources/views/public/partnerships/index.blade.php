@extends('layouts.public')

@section('title', 'Partnerships')

@section('content')
    <section class="theme-bg-warm border-b theme-border -mx-4 px-4 py-16 md:py-24">
        <div class="max-w-3xl mx-auto text-center">
            <p class="text-sm font-semibold tracking-wider uppercase theme-accent mb-2">Work with us</p>
            <h1 class="text-4xl md:text-5xl font-bold theme-text-primary">Partnerships</h1>
            <p class="text-lg theme-text-secondary mt-4">Partners, media kit, and partnership opportunities.</p>
        </div>
    </section>
    <div class="max-w-4xl mx-auto py-12">
        <section class="theme-card rounded-2xl p-8 md:p-10 mb-10">
            <h2 class="text-2xl font-bold theme-text-primary mb-4">Why Partner With Us</h2>
            <p class="theme-text-secondary leading-relaxed mb-4">Animal IQ brings together wildlife education, youth empowerment, and community conservation. We work with institutions, NGOs, and businesses to amplify impact.</p>
            <ul class="space-y-2 theme-text-secondary">
                <li class="flex items-start gap-2"><span class="theme-accent font-bold">·</span> Institutional collaborations for school and campus programs</li>
                <li class="flex items-start gap-2"><span class="theme-accent font-bold">·</span> Media and communications partnerships</li>
                <li class="flex items-start gap-2"><span class="theme-accent font-bold">·</span> Resource development and grant alignment</li>
            </ul>
        </section>
        <section class="theme-card rounded-2xl p-8 md:p-10">
            <h2 class="text-2xl font-bold theme-text-primary mb-4">Resources</h2>
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
        </section>
        <section class="theme-card rounded-2xl p-8 md:p-10 mt-10 text-center">
            <h2 class="text-xl font-bold theme-text-primary mb-2">Interested in Partnering?</h2>
            <p class="theme-text-secondary mb-4">Reach out to discuss collaboration opportunities.</p>
            <a href="{{ route('home') }}" class="theme-btn">Get in touch</a>
        </section>
    </div>
@endsection
