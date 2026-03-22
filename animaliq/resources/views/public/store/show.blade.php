@extends('layouts.public')

@section('title', $product->name)

@section('meta')
@php
    $seoTitle       = $product->name . ' – Animal IQ Eco Store';
    $seoDescription = $product->description
        ? Str::limit(strip_tags($product->description), 155)
        : 'Buy ' . $product->name . ' from the Animal IQ Eco Store. Proceeds support wildlife education and conservation programs in Kenya.';
    $seoCanonical   = route('store.show', $product);
    $seoImage       = $product->image_path;
    $jsonLd = [
        '@context'    => 'https://schema.org',
        '@type'       => 'Product',
        'name'        => $product->name,
        'url'         => route('store.show', $product),
        'description' => strip_tags($product->description ?? ''),
        'image'       => $product->image_path ? asset('storage/' . $product->image_path) : null,
        'offers'      => [
            '@type'         => 'Offer',
            'price'         => $product->price,
            'priceCurrency' => 'KES',
            'availability'  => ($product->stock === null || $product->stock > 0)
                ? 'https://schema.org/InStock'
                : 'https://schema.org/OutOfStock',
            'url'           => route('store.show', $product),
            'seller'        => ['@type' => 'Organization', 'name' => 'Animal IQ'],
        ],
        'brand'       => ['@type' => 'Brand', 'name' => 'Animal IQ'],
        'breadcrumb'  => [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',  'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Store', 'item' => route('store.index')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $product->name, 'item' => route('store.show', $product)],
            ],
        ],
    ];
@endphp
@include('partials.seo')
@endsection

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
                <header class="mb-6 flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                    <h1 class="text-3xl md:text-4xl font-bold theme-text-primary">{{ $product->name }}</h1>
                    <div class="flex-shrink-0">@include('partials.share-button', ['shareTitle' => $product->name . ' – Animal IQ Store', 'url' => route('store.show', $product)])</div>
                </header>
                <p class="text-3xl font-bold theme-accent mb-2">{{ number_format($product->price, 0) }} <span class="text-lg font-normal theme-text-secondary">KES</span></p>
                @if($product->stock !== null)
                    <p class="text-sm theme-text-secondary mb-4">@if($product->stock > 0) In stock ({{ $product->stock }}) @else <span class="theme-accent font-medium">Out of stock</span> @endif</p>
                @endif
                <div class="prose theme-text-secondary max-w-none mb-8">{!! nl2br(e($product->description ?? '')) !!}</div>
                @if($product->stock === null || $product->stock > 0)
                    <p class="text-sm theme-text-secondary mb-2">M-Pesa checkout will use the Daraja API (STK Push). Integration is prepared but not implemented yet – see <code class="text-sm">config/daraja.php</code> and <code class="text-sm">App\Services\Mpesa\DarajaService</code>. For now, contact us to order.</p>
                    <a href="{{ route('home') }}#contact" class="theme-btn inline-block">Contact to order</a>
                @endif
            </div>
        </div>
    </div>
@endsection
