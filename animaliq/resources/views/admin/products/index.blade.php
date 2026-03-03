@extends('layouts.admin') @section('title', 'Products') @section('content')
<h1 class="text-2xl font-bold mb-4">Products</h1>
<p><a href="{{ route('admin.products.create') }}" class="text-blue-600 hover:underline">Add Product</a></p>
<ul class="mt-4 space-y-2">@foreach($products as $p)<li class="flex justify-between py-2 border-b"><span>{{ $p->name }} ({{ $p->status }}) @if($p->trashed()) <span class="text-gray-500">deleted</span> @endif</span><span>@if(!$p->trashed())<a href="{{ route('admin.products.edit', $p) }}" class="text-blue-600 hover:underline">Edit</a> | <form action="{{ route('admin.products.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:underline">Delete</button></form>@endif</span></li>@endforeach</ul>
{{ $products->links() }} @endsection
