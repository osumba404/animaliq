@extends('layouts.public')

@section('title', $product->name)

@section('content')
    <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
    @if($product->image_path)
        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="max-w-md rounded-lg mb-4">
    @endif
    <p class="text-xl text-[#f53003] font-medium mb-4">{{ number_format($product->price, 0) }}</p>
    <div class="prose dark:prose-invert max-w-none">{!! nl2br(e($product->description ?? '')) !!}</div>
    {{-- Add to cart / M-Pesa checkout --}}
@endsection
