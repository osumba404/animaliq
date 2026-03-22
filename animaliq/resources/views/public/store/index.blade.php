@extends('layouts.public')

@section('title', 'Eco Store')

@section('meta')
@php
    $seoTitle       = 'Eco Store – Shop & Support Animal IQ Conservation';
    $seoDescription = 'Shop Animal IQ merchandise: T-shirts, stickers, books, and eco-friendly products. Every purchase directly supports wildlife education and conservation programs in Kenya.';
    $seoCanonical   = route('store.index');
    $jsonLd = [
        '@context'    => 'https://schema.org',
        '@type'       => 'Store',
        'name'        => 'Animal IQ Eco Store',
        'url'         => route('store.index'),
        'description' => 'Merchandise and eco-friendly products supporting Animal IQ wildlife education and conservation.',
        'seller'      => ['@type' => 'Organization', 'name' => 'Animal IQ', 'url' => url('/')],
        'breadcrumb'  => [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',  'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Store', 'item' => route('store.index')],
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
                <p class="text-sm font-semibold tracking-wider uppercase theme-accent mb-2">Shop for a cause</p>
                <h1 class="text-4xl md:text-5xl font-bold theme-text-primary">Eco Store</h1>
                <p class="text-lg theme-text-secondary mt-2">T-shirts, stickers, books and more. Proceeds support our programs.</p>
            </div>
        </div>
    </section>

    <div class="py-12 max-w-6xl mx-auto">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($products as $product)
                <article class="theme-card rounded-2xl overflow-hidden transition hover:shadow-xl group flex flex-col">
                    <a href="{{ route('store.show', $product) }}" class="block flex-1 flex flex-col">
                        <div class="aspect-square bg-[var(--bg-secondary)] overflow-hidden">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center theme-text-secondary"><svg class="w-16 h-16 opacity-30 theme-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg></div>
                            @endif
                        </div>
                        <div class="p-5 flex-1 flex flex-col">
                            <h2 class="font-bold text-lg theme-text-primary group-hover:theme-accent transition line-clamp-2">{{ $product->name }}</h2>
                            <p class="text-xl font-bold theme-accent mt-2">{{ number_format($product->price, 0) }} <span class="text-sm font-normal theme-text-secondary">KES</span></p>
                            @if($product->stock !== null && $product->stock < 5 && $product->stock > 0)
                                <p class="text-xs theme-text-secondary mt-1">Only {{ $product->stock }} left</p>
                            @endif
                        </div>
                    </a>
                    <div class="p-5 pt-0 flex flex-wrap items-center justify-between gap-2">
                        <a href="{{ route('store.show', $product) }}" class="theme-btn flex-1 sm:flex-none text-center">View product</a>
                        @include('partials.share-button', ['shareTitle' => $product->name . ' – Animal IQ Store', 'url' => route('store.show', $product)])
                    </div>
                </article>
            @empty
                <div class="col-span-full theme-card rounded-2xl p-12 text-center">
                    <p class="theme-text-secondary text-lg">No products at the moment. Check back soon.</p>
                </div>
            @endforelse
        </div>
        {{ $products->links() }}
    </div>
@endsection
