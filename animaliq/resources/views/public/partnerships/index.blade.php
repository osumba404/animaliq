@extends('layouts.public')

@section('title', 'Partnerships')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Partnerships</h1>
    <p class="mb-8">Structured section for current partners, institutional collaborations, media kit, and partnership request form.</p>
    @if($mediaKitUrl)
        <p><a href="{{ $mediaKitUrl }}" class="text-[#f53003] underline" target="_blank">Download Media Kit</a></p>
    @endif
    @if($proposalTemplateUrl)
        <p><a href="{{ asset('storage/' . $proposalTemplateUrl) }}" class="text-[#f53003] underline" download>Partnership Proposal Template</a></p>
    @endif
@endsection
