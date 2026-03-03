@extends('layouts.admin') @section('title', 'Create Post') @section('content')
<h1 class="text-2xl font-bold mb-4">Create Post</h1>
<form action="{{ route('admin.posts.store') }}" method="POST" class="max-w-md">@csrf
<div class="mb-4"><label class="block">Title</label><input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded px-2 py-1" required></div>
<div class="mb-4"><label class="block">Content</label><textarea name="content" class="w-full border rounded px-2 py-1" rows="6">{{ old('content') }}</textarea></div>
<div class="mb-4"><label class="block">Campaign</label><select name="campaign_id" class="w-full border rounded px-2 py-1"><option value="">—</option>@foreach($campaigns as $c)<option value="{{ $c->id }}">{{ $c->title }}</option>@endforeach</select></div>
<div class="mb-4"><label class="block">Status</label><select name="status" class="w-full border rounded px-2 py-1"><option value="draft">Draft</option><option value="published">Published</option></select></div>
<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button></form>
@endsection
