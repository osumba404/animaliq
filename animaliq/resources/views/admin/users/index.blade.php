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
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="theme-table-header">
                        <th class="text-left px-4 py-3 font-semibold theme-text-primary border-b theme-table-cell">Name</th>
                        <th class="text-left px-4 py-3 font-semibold theme-text-primary border-b theme-table-cell">Email</th>
                        <th class="text-left px-4 py-3 font-semibold theme-text-primary border-b theme-table-cell">Phone</th>
                        <th class="text-left px-4 py-3 font-semibold theme-text-primary border-b theme-table-cell">Role</th>
                        <th class="text-left px-4 py-3 font-semibold theme-text-primary border-b theme-table-cell">Status</th>
                        <th class="text-left px-4 py-3 font-semibold theme-text-primary border-b theme-table-cell">Bio</th>
                        <th class="text-left px-4 py-3 font-semibold theme-text-primary border-b theme-table-cell">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $u)
                        <tr class="theme-card border-b theme-table-cell hover:bg-[var(--bg-warm)] transition">
                            <td class="px-4 py-3 theme-text-primary font-medium">{{ $u->first_name }} {{ $u->last_name }}</td>
                            <td class="px-4 py-3 theme-text-secondary">{{ $u->email }}</td>
                            <td class="px-4 py-3 theme-text-secondary">{{ $u->phone ?? '—' }}</td>
                            <td class="px-4 py-3">
                                @if($u->role !== 'member')
                                    <span class="theme-badge">{{ $u->role === 'super_admin' ? 'Super Admin' : 'Admin' }}</span>
                                @else
                                    <span class="theme-text-secondary">Member</span>
                                @endif
                            </td>
                            <td class="px-4 py-3"><span class="theme-badge">{{ $u->status ?? 'active' }}</span></td>
                            <td class="px-4 py-3 theme-text-secondary max-w-[200px] truncate">{{ $u->bio ? Str::limit($u->bio, 60) : '—' }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.users.edit-form', $u) }}" class="theme-link font-medium" data-crud-modal>Edit</a>
                                    @if($u->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $u) }}" method="POST" class="inline" onsubmit="return confirm('Delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $users->links() }}</div>
    @endif
@endsection
