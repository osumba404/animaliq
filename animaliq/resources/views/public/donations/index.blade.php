@extends('layouts.public')

@section('title', 'Donate')

@section('meta')
@php
    $seoTitle = 'Donate – Animal IQ';
    $seoDescription = 'Support Animal IQ through one-time or campaign-based donations. M-Pesa and receipt by email.';
    $seoCanonical = route('donations.index');
@endphp
@include('partials.seo')
@endsection

@section('content')
    <section class="theme-bg-warm border-b theme-border -mx-4 px-4 py-12 md:py-16">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <p class="text-sm font-semibold tracking-wider uppercase theme-accent mb-2">Support us</p>
                <h1 class="text-4xl md:text-5xl font-bold theme-text-primary">Donate</h1>
                <p class="text-lg theme-text-secondary mt-2">One-time or campaign-based. M-Pesa integration. Donation receipt by email.</p>
            </div>
            <div class="flex-shrink-0">@include('partials.share-button', ['shareTitle' => 'Donate – Animal IQ', 'url' => route('donations.index')])</div>
        </div>
    </section>

    <div class="py-12 max-w-6xl mx-auto">
    <div class="grid md:grid-cols-2 gap-6">
        @forelse($campaigns as $campaign)
            <a href="{{ route('donations.show', $campaign) }}" class="block theme-card rounded-2xl p-6 hover-lift">
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
