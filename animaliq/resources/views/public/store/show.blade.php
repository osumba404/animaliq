@extends('layouts.public')

@section('title', $product->name)

@section('content')
    <div class="max-w-5xl mx-auto py-8">
        <div class="grid md:grid-cols-2 gap-8 md:gap-12">
            <div class="theme-card rounded-2xl overflow-hidden aspect-square md:aspect-auto md:min-h-[400px] bg-[var(--bg-secondary)]">
                @if($product->image_path)
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center theme-text-secondary"><svg class="w-20 h-20 opacity-30 theme-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg></div>
                @endif
            </div>
            <div>
                <h1 class="text-3xl md:text-4xl font-bold theme-text-primary mb-4">{{ $product->name }}</h1>
                <p class="text-3xl font-bold theme-accent mb-2">{{ number_format($product->price, 0) }} <span class="text-lg font-normal theme-text-secondary">KES</span></p>
                @if($product->stock !== null)
                    <p class="text-sm theme-text-secondary mb-4">@if($product->stock > 0) In stock ({{ $product->stock }}) @else <span class="theme-accent font-medium">Out of stock</span> @endif</p>
                @endif
                <div class="prose theme-text-secondary max-w-none mb-8">{!! nl2br(e($product->description ?? '')) !!}</div>
                @if($product->stock === null || $product->stock > 0)
                    <p class="text-sm theme-text-secondary mb-2">M-Pesa checkout coming soon. For now, contact us to order.</p>
                    <a href="{{ route('home') }}#contact" class="theme-btn inline-block">Contact to order</a>
                @endif
            </div>
        </div>
    </div>
@endsection
