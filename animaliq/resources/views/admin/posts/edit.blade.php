@extends('layouts.admin') @section('title', 'Edit Post') @section('content')
<h1 class="text-2xl font-bold mb-4">Edit Post</h1>
<form action="{{ route('admin.posts.update', $post) }}" method="POST" class="max-w-md">@csrf @method('PUT')
<div class="mb-4"><label class="block">Title</label><input type="text" name="title" value="{{ old('title', $post->title) }}" class="w-full border rounded px-2 py-1" required></div>
<div class="mb-4"><label class="block">Content</label><textarea name="content" class="w-full border rounded px-2 py-1" rows="6">{{ old('content', $post->content) }}</textarea></div>
<div class="mb-4"><label class="block">Campaign</label><select name="campaign_id" class="w-full border rounded px-2 py-1"><option value="">—</option>@foreach($campaigns as $c)<option value="{{ $c->id }}" {{ $post->campaign_id == $c->id ? 'selected' : '' }}>{{ $c->title }}</option>@endforeach</select></div>
<div class="mb-4"><label class="block">Status</label><select name="status" class="w-full border rounded px-2 py-1">@foreach(['draft','published'] as $s)<option value="{{ $s }}" {{ $post->status == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>@endforeach</select></div>
<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button></form>
@endsection
