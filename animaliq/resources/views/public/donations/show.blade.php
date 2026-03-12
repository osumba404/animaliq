@extends('layouts.public')

@section('title', 'Donate – ' . $donationCampaign->title)

@section('meta')
@php
    $seoTitle = 'Donate: ' . $donationCampaign->title . ' – Animal IQ';
    $seoDescription = Str::limit(strip_tags($donationCampaign->description ?? ''), 160);
    $seoCanonical = route('donations.show', $donationCampaign);
@endphp
@include('partials.seo')
@endsection

@section('content')
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
        <h2 class="text-xl font-bold theme-text-primary mb-2">Donate via M-Pesa (Daraja)</h2>
        <p class="text-sm theme-text-secondary mb-4">Enter amount and your M-Pesa number. You will be prompted on your phone to enter PIN. (Integration not yet active – form ready for Daraja API.)</p>
        <form action="{{ route('donations.initiate', $donationCampaign) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium theme-text-primary mb-1">Amount (KES)</label>
                <input type="number" name="amount" id="amount" step="0.01" min="1" max="999999.99" value="{{ old('amount', '100') }}" class="theme-input w-full" required>
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium theme-text-primary mb-1">M-Pesa number (254XXXXXXXXX)</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="254712345678" class="theme-input w-full" required>
            </div>
            <button type="submit" class="theme-btn w-full">Pay with M-Pesa</button>
        </form>
    </div>
    </div>
@endsection
