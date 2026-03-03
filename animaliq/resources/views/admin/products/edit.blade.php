@extends('layouts.admin') @section('title', 'Edit Product') @section('content')
<h1 class="text-2xl font-bold mb-4">Edit Product</h1>
<form action="{{ route('admin.products.update', $product) }}" method="POST" class="max-w-md">@csrf @method('PUT')
<div class="mb-4"><label class="block">Name</label><input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border rounded px-2 py-1" required></div>
<div class="mb-4"><label class="block">Price</label><input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full border rounded px-2 py-1" step="0.01" required></div>
<div class="mb-4"><label class="block">Stock</label><input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full border rounded px-2 py-1"></div>
<div class="mb-4"><label class="block">Status</label><select name="status" class="w-full border rounded px-2 py-1">@foreach(['active','inactive'] as $s)<option value="{{ $s }}" {{ $product->status == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>@endforeach</select></div>
<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button></form>
@endsection
