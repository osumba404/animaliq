@extends('layouts.admin')
@section('title', 'Users')
@section('heading', 'Users')
@section('content')
<h1 class="text-2xl font-bold mb-4 theme-text-primary">Users</h1>
<p class="mb-4"><a href="{{ route('admin.users.create-form') }}" class="theme-btn inline-block" data-crud-modal>Add User</a></p>
<ul class="space-y-0">
    @foreach($users as $u)
    <li class="flex justify-between items-center py-3 theme-table-cell border-b">
        <span class="theme-text-primary">
            {{ $u->first_name }} {{ $u->last_name }} ({{ $u->email }})
            @if($u->role !== 'member')
                <span class="ml-2 theme-badge">{{ $u->role === 'super_admin' ? 'Super Admin' : 'Admin' }}</span>
            @endif
        </span>
        <span>
            <a href="{{ route('admin.users.edit-form', $u) }}" class="theme-link font-medium" data-crud-modal>Edit</a>
            @if($u->id !== auth()->id())
            | <form action="{{ route('admin.users.destroy', $u) }}" method="POST" class="inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:underline bg-transparent border-none cursor-pointer p-0">Delete</button></form>
            @endif
        </span>
    </li>
    @endforeach
</ul>
{{ $users->links() }}
@endsection
