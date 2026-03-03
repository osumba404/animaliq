@extends('layouts.admin') @section('title', 'Research') @section('content')
<h1 class="text-2xl font-bold mb-4">Research Projects</h1>
<p><a href="{{ route('admin.research.create') }}" class="text-blue-600 hover:underline">Add Project</a></p>
<ul class="mt-4 space-y-2">@foreach($projects as $p)<li class="flex justify-between py-2 border-b"><span>{{ $p->title }} ({{ $p->status }})</span><span><a href="{{ route('admin.research.edit', $p) }}" class="text-blue-600 hover:underline">Edit</a> | <form action="{{ route('admin.research.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:underline">Delete</button></form></span></li>@endforeach</ul>
{{ $projects->links() }} @endsection
