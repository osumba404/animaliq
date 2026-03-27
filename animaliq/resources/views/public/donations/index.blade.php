@extends('layouts.public')

@section('title', 'Support Wildlife Conservation – Donate to Animal IQ')

@section('meta')
@php
    $seoTitle       = 'Support Wildlife Conservation – Donate to Animal IQ';
    $seoDescription = 'Make a difference for wildlife and youth education. Donate to Animal IQ’s conservation campaigns via M-Pesa. Every contribution funds programs, events, and research.';
    $seoCanonical   = route('donations.index');
    $jsonLd = [
        '@context'    => 'https://schema.org',
        '@type'       => 'DonateAction',
        'name'        => 'Donate to Animal IQ',
        'url'         => route('donations.index'),
        'description' => 'Support Animal IQ wildlife education and conservation through donations.',
        'recipient'   => ['@type' => 'Organization', 'name' => 'Animal IQ', 'url' => url('/')],
        'breadcrumb'  => [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',   'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Donate', 'item' => route('donations.index')],
            ],
        ],
    ];
@endphp
@include('partials.seo')
@endsection

@section('content')
    <section class="theme-bg-warm border-b theme-border -mx-4 px-4 py-12 md:py-16">
        <div class="max-w-6xl mx-auto">
            <div>
                <p class="text-sm font-semibold tracking-wider uppercase theme-accent mb-2">Support us</p>
                <h1 class="text-4xl md:text-5xl font-bold theme-text-primary animate-fade-in-up">Donate</h1>
                <p class="text-lg theme-text-secondary mt-2 animate-fade-in-up animate-delay-1">One-time or campaign-based. M-Pesa integration. Donation receipt by email.</p>
                <div class="mt-4 accent-bar"></div>
            </div>
        </div>
    </section>

    <div class="py-12 max-w-6xl mx-auto">
    <div class="grid md:grid-cols-2 gap-6">
        @forelse($campaigns as $campaign)
            <a href="{{ route('donations.show', $campaign) }}" class="block theme-card rounded-2xl p-6 hover-lift reveal">
                <h2 class="font-bold theme-text-primary">{{ $campaign->title }}</h2>
                @if($campaign->target_amount)
                    <p class="text-sm theme-text-secondary mt-1">Target: {{ number_format($campaign->target_amount, 0) }} KES</p>
                @endif
                <span class="inline-block mt-3 theme-link font-medium">Donate to this campaign →</span>
            </a>
        @empty
            <p class="theme-text-secondary col-span-full">No active campaigns. General donations coming soon.</p>
        @endforelse
    </div>
    </div>
@endsection
