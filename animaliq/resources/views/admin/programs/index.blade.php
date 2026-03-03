@extends('layouts.admin') @section('title', 'Programs') @section('content')
<h1 class="text-2xl font-bold mb-4">Programs</h1>
<p><a href="{{ route('admin.programs.create') }}" class="text-blue-600 hover:underline">Add Program</a></p>
<ul class="mt-4 space-y-2">@foreach($programs as $p)
<li class="flex justify-between py-2 border-b"><span>{{ $p->title }}</span><span><a href="{{ route('admin.programs.edit', $p) }}" class="text-blue-600 hover:underline">Edit</a> | <form action="{{ route('admin.programs.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:underline">Delete</button></form></span></li>
@endforeach</ul>
{{ $programs->links() }} @endsection
