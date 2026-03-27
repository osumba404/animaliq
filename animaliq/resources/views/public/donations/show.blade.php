@extends('layouts.public')

@section('title', 'Donate: ' . $donationCampaign->title . ' – Animal IQ')

@section('meta')
@php
    $seoTitle       = 'Donate: ' . $donationCampaign->title . ' – Animal IQ';
    $seoDescription = $donationCampaign->description
        ? Str::limit(strip_tags($donationCampaign->description), 155)
        : 'Support the ' . $donationCampaign->title . ' campaign by Animal IQ. Your donation funds wildlife education and conservation programs.';
    $seoCanonical   = route('donations.show', $donationCampaign);
    $jsonLd = [
        '@context'    => 'https://schema.org',
        '@type'       => 'DonateAction',
        'name'        => 'Donate: ' . $donationCampaign->title,
        'url'         => route('donations.show', $donationCampaign),
        'description' => strip_tags($donationCampaign->description ?? ''),
        'recipient'   => ['@type' => 'Organization', 'name' => 'Animal IQ', 'url' => url('/')],
        'breadcrumb'  => [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',   'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Donate', 'item' => route('donations.index')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $donationCampaign->title, 'item' => route('donations.show', $donationCampaign)],
            ],
        ],
    ];
@endphp
@include('partials.seo')
@endsection

@section('content')
    <nav aria-label="Breadcrumb" class="mb-4 text-sm">
        <ol class="flex flex-wrap items-center gap-1 theme-text-secondary">
            <li><a href="{{ route('home') }}" class="hover:underline">Home</a> <span aria-hidden="true" class="opacity-40">›</span></li>
            <li><a href="{{ route('donations.index') }}" class="hover:underline">Donate</a> <span aria-hidden="true" class="opacity-40">›</span></li>
            <li class="theme-text-primary font-medium">{{ $donationCampaign->title }}</li>
        </ol>
    </nav>
    <section class="theme-bg-warm border-b theme-border -mx-4 px-4 py-12 md:py-16 mb-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl md:text-4xl font-bold theme-text-primary">{{ $donationCampaign->title }}</h1>
        </div>
    </section>
    <div class="max-w-4xl mx-auto">
    <div class="prose prose-lg dark:prose-invert max-w-none theme-text-secondary mb-8">{!! nl2br(e($donationCampaign->description ?? '')) !!}</div>

    @if(session('success'))
        <p class="mb-4 p-4 rounded-lg bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200">{{ session('success') }}</p>
    @endif
    @if(session('info'))
        <p class="mb-4 p-4 rounded-lg theme-bg-warm theme-text-secondary">{{ session('info') }}</p>
    @endif
    @if($errors->any())
        <ul class="mb-4 list-disc list-inside text-red-600 dark:text-red-400">
            @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    @endif

    <div class="theme-card rounded-2xl p-6 md:p-8 max-w-md">
        <h2 class="text-xl font-bold theme-text-primary mb-4">Donate via M-Pesa</h2>
        <p class="text-base theme-text-secondary mb-4 leading-relaxed">
            Channel your contributions to this till number: <strong class="theme-text-primary text-xl ml-1">{{ \App\Models\SiteSetting::getByKey('mpesa_till_number', 'xxxxxx') }}</strong>
        </p>
        <p class="text-sm theme-text-secondary">
            Till Name / Business Name: <strong class="theme-text-primary">{{ \App\Models\SiteSetting::getByKey('mpesa_till_name', 'xxxxxx') }}</strong>
        </p>
    </div>
    </div>
@endsection
