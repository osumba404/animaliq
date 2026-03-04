@extends('layouts.admin')

@section('title', 'Products')
@section('heading', 'Products')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold theme-text-primary">Products</h1>
        <a href="{{ route('admin.products.create') }}" class="theme-btn">Add Product</a>
    </div>

    @if($products->isEmpty())
        <div class="theme-card rounded-lg p-8 text-center">
            <p class="theme-text-secondary mb-4">No products yet.</p>
            <a href="{{ route('admin.products.create') }}" class="theme-btn">Add your first product</a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($products as $p)
                <article class="theme-card rounded-lg p-4 transition hover:shadow-lg {{ $p->trashed() ? 'opacity-70' : '' }}">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div class="min-w-0 flex-1 flex flex-wrap items-start gap-4">
                            @if($p->image_path)
                                <img src="{{ asset('storage/' . $p->image_path) }}" alt="" class="w-16 h-16 object-cover rounded shrink-0">
                            @endif
                            <div class="min-w-0 flex-1">
                                <h2 class="font-semibold theme-text-primary text-lg">{{ $p->name }}</h2>
                                <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-2 text-sm theme-text-secondary">
                                    <span><span class="font-medium">Price:</span> {{ number_format($p->price ?? 0, 2) }}</span>
                                    <span><span class="font-medium">Stock:</span> {{ $p->stock ?? '—' }}</span>
                                    <span><span class="font-medium">Status:</span> <span class="theme-badge">{{ $p->status ?? '—' }}</span></span>
                                    @if(isset($p->order_items_count))
                                        <span><span class="font-medium">In orders:</span> {{ $p->order_items_count }}</span>
                                    @endif
                                    @if($p->trashed())
                                        <span class="theme-badge opacity-75">Deleted</span>
                                    @endif
                                </div>
                                @if($p->description)
                                    <p class="text-sm theme-text-secondary mt-2 line-clamp-2">{{ Str::limit($p->description, 140) }}</p>
                                @endif
                            </div>
                        </div>
                        @if(!$p->trashed())
                            <div class="flex flex-wrap items-center gap-2 shrink-0">
                                <a href="{{ route('admin.products.edit', $p) }}" class="theme-link font-medium">Edit</a>
                                <form action="{{ route('admin.products.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
        {{ $products->links() }}
    @endif
@endsection
