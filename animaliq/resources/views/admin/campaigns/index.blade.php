@extends('layouts.admin') @section('title', 'Campaigns') @section('content')
<h1 class="text-2xl font-bold mb-4">Campaigns</h1>
<p><a href="{{ route('admin.campaigns.create') }}" class="text-blue-600 hover:underline">Add Campaign</a></p>
<ul class="mt-4 space-y-2">@foreach($campaigns as $c)<li class="flex justify-between py-2 border-b"><span>{{ $c->title }}</span><span><a href="{{ route('admin.campaigns.edit', $c) }}" class="text-blue-600 hover:underline">Edit</a> | <form action="{{ route('admin.campaigns.destroy', $c) }}" method="POST" class="inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:underline">Delete</button></form></span></li>@endforeach</ul>
{{ $campaigns->links() }} @endsection
