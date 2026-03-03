@extends('layouts.public')

@section('title', 'Donate')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Support Our Mission</h1>
    <p class="mb-8">One-time donation, campaign-based donation, M-Pesa integration. Donation receipt auto-email.</p>
    <div class="grid md:grid-cols-2 gap-6">
        @forelse($campaigns as $campaign)
            <a href="{{ route('donations.show', $campaign) }}" class="block p-4 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] hover:border-[#19140035]">
                <h2 class="font-semibold">{{ $campaign->title }}</h2>
                @if($campaign->target_amount)
                    <p class="text-sm text-[#706f6c]">Target: {{ number_format($campaign->target_amount, 0) }}</p>
                @endif
            </a>
        @empty
            <p class="text-[#706f6c]">No active campaigns. General donations coming soon.</p>
        @endforelse
    </div>
@endsection
