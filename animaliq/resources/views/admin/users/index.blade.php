@extends('layouts.admin')

@section('title', 'Users')
@section('heading', 'Users')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold theme-text-primary">Users</h1>
        <a href="{{ route('admin.users.create-form') }}" class="theme-btn" data-crud-modal>Add User</a>
    </div>

    @if($users->isEmpty())
        <div class="theme-card rounded-lg p-8 text-center">
            <p class="theme-text-secondary mb-4">No users yet.</p>
            <a href="{{ route('admin.users.create-form') }}" class="theme-btn" data-crud-modal>Add user</a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($users as $u)
                <article class="theme-card rounded-lg p-4 transition hover:shadow-lg">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div class="min-w-0 flex-1">
                            <h2 class="font-semibold theme-text-primary text-lg">{{ $u->first_name }} {{ $u->last_name }}</h2>
                            <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-2 text-sm theme-text-secondary">
                                <span><span class="font-medium">Email:</span> {{ $u->email }}</span>
                                @if($u->phone)
                                    <span><span class="font-medium">Phone:</span> {{ $u->phone }}</span>
                                @endif
                                <span><span class="font-medium">Status:</span> <span class="theme-badge">{{ $u->status ?? 'active' }}</span></span>
                                @if($u->role !== 'member')
                                    <span><span class="font-medium">Role:</span> <span class="theme-badge">{{ $u->role === 'super_admin' ? 'Super Admin' : 'Admin' }}</span></span>
                                @endif
                            </div>
                            @if($u->bio)
                                <p class="text-sm theme-text-secondary mt-2 line-clamp-2">{{ Str::limit($u->bio, 140) }}</p>
                            @endif
                        </div>
                        <div class="flex flex-wrap items-center gap-2 shrink-0">
                            <a href="{{ route('admin.users.edit-form', $u) }}" class="theme-link font-medium" data-crud-modal>Edit</a>
                            @if($u->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $u) }}" method="POST" class="inline" onsubmit="return confirm('Delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        {{ $users->links() }}
    @endif
@endsection
