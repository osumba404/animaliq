@extends('layouts.public')

@section('title', 'Eco Store')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Eco Store</h1>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($products as $product)
            <a href="{{ route('store.show', $product) }}" class="block p-4 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] hover:border-[#19140035]">
                @if($product->image_path)
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded mb-2">
                @endif
                <h2 class="font-semibold">{{ $product->name }}</h2>
                <p class="text-[#f53003] font-medium">{{ number_format($product->price, 0) }}</p>
            </a>
        @empty
            <p class="text-[#706f6c] col-span-full">No products yet.</p>
        @endforelse
    </div>
    {{ $products->links() }}
@endsection
