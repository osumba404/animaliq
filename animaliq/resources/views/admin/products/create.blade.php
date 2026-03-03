@extends('layouts.admin') @section('title', 'Create Product') @section('content')
<h1 class="text-2xl font-bold mb-4">Create Product</h1>
<form action="{{ route('admin.products.store') }}" method="POST" class="max-w-md">@csrf
<div class="mb-4"><label class="block">Name</label><input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-2 py-1" required></div>
<div class="mb-4"><label class="block">Price</label><input type="number" name="price" value="{{ old('price') }}" class="w-full border rounded px-2 py-1" step="0.01" required></div>
<div class="mb-4"><label class="block">Stock</label><input type="number" name="stock" value="{{ old('stock', 0) }}" class="w-full border rounded px-2 py-1"></div>
<div class="mb-4"><label class="block">Status</label><select name="status" class="w-full border rounded px-2 py-1"><option value="active">Active</option><option value="inactive">Inactive</option></select></div>
<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button></form>
@endsection
