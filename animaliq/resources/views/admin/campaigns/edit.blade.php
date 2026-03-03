@extends('layouts.admin') @section('title', 'Edit Campaign') @section('content')
<h1 class="text-2xl font-bold mb-4">Edit Campaign</h1>
<form action="{{ route('admin.campaigns.update', $campaign) }}" method="POST" class="max-w-md">@csrf @method('PUT')
<div class="mb-4"><label class="block">Title</label><input type="text" name="title" value="{{ old('title', $campaign->title) }}" class="w-full border rounded px-2 py-1" required></div>
<div class="mb-4"><label class="block">Description</label><textarea name="description" class="w-full border rounded px-2 py-1">{{ old('description', $campaign->description) }}</textarea></div>
<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button></form>
@endsection
