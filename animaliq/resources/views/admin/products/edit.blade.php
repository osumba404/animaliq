@extends('layouts.admin')

@section('title', 'Edit Product')
@section('heading', 'Edit Product')

@section('content')
    <h1 class="text-2xl font-bold mb-6 theme-text-primary">Edit Product</h1>
    <form action="{{ route('admin.products.update', $product) }}" method="POST" class="max-w-lg" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="theme-input w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Description</label>
            <textarea name="description" class="theme-input w-full" rows="4">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-medium theme-text-secondary mb-1">Price</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" class="theme-input w-full" step="0.01" min="0" required>
            </div>
            <div>
                <label class="block font-medium theme-text-secondary mb-1">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="theme-input w-full" min="0">
            </div>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Image</label>
            @if($product->image_path)
                <p class="text-sm theme-text-secondary mb-1">Current: <img src="{{ asset('storage/' . $product->image_path) }}" alt="" class="inline-block h-16 w-auto object-cover rounded mt-1"></p>
            @endif
            <input type="file" name="image" accept="image/*" class="theme-input w-full">
            <span class="text-xs theme-text-secondary">Leave empty to keep current image</span>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Status</label>
            <select name="status" class="theme-input w-full">
                <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="theme-btn">Update</button>
        <a href="{{ route('admin.products.index') }}" class="ml-2 theme-link">Cancel</a>
    </form>
@endsection
