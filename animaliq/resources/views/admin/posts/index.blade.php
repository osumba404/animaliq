@extends('layouts.admin') @section('title', 'Posts') @section('content')
<h1 class="text-2xl font-bold mb-4">Posts</h1>
<p><a href="{{ route('admin.posts.create') }}" class="text-blue-600 hover:underline">Add Post</a></p>
<ul class="mt-4 space-y-2">@foreach($posts as $p)<li class="flex justify-between py-2 border-b"><span>{{ $p->title }} ({{ $p->status }})</span><span><a href="{{ route('admin.posts.edit', $p) }}" class="text-blue-600 hover:underline">Edit</a> | <form action="{{ route('admin.posts.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:underline">Delete</button></form></span></li>@endforeach</ul>
{{ $posts->links() }} @endsection
