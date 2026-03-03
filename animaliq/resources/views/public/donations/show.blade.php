@extends('layouts.public')

@section('title', 'Donate – ' . $donationCampaign->title)

@section('content')
    <h1 class="text-3xl font-bold mb-4">{{ $donationCampaign->title }}</h1>
    <div class="prose dark:prose-invert max-w-none mb-8">{!! nl2br(e($donationCampaign->description ?? '')) !!}</div>
    <p class="text-[#706f6c]">Donation form (M-Pesa, etc.) to be integrated here.</p>
@endsection
