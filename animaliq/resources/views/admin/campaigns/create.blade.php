@extends('layouts.admin') @section('title', 'Create Campaign') @section('content')
<h1 class="text-2xl font-bold mb-4">Create Campaign</h1>
<form action="{{ route('admin.campaigns.store') }}" method="POST" class="max-w-md">@csrf
<div class="mb-4"><label class="block">Title</label><input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded px-2 py-1" required></div>
<div class="mb-4"><label class="block">Description</label><textarea name="description" class="w-full border rounded px-2 py-1">{{ old('description') }}</textarea></div>
<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button></form>
@endsection
