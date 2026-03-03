@extends('layouts.admin') @section('title', 'Users') @section('content')
<h1 class="text-2xl font-bold mb-4">Users</h1>
<p><a href="{{ route('admin.users.create') }}" class="text-blue-600 hover:underline">Add User</a></p>
<ul class="mt-4 space-y-2">@foreach($users as $u)<li class="flex justify-between py-2 border-b"><span>{{ $u->first_name }} {{ $u->last_name }} ({{ $u->email }})</span><span><a href="{{ route('admin.users.edit', $u) }}" class="text-blue-600 hover:underline">Edit</a> @if($u->id !== auth()->id())| <form action="{{ route('admin.users.destroy', $u) }}" method="POST" class="inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:underline">Delete</button></form>@endif</span></li>@endforeach</ul>
{{ $users->links() }} @endsection
