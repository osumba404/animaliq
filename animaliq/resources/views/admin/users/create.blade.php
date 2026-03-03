@extends('layouts.admin')
@section('title', 'Create User')
@section('heading', 'Create User')
@section('content')
<h1 class="text-2xl font-bold mb-4 theme-text-primary">Create User</h1>
<form action="{{ route('admin.users.store') }}" method="POST" class="max-w-md">
    @csrf
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">First name</label><input type="text" name="first_name" value="{{ old('first_name') }}" class="theme-input w-full" required></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Last name</label><input type="text" name="last_name" value="{{ old('last_name') }}" class="theme-input w-full" required></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Email</label><input type="email" name="email" value="{{ old('email') }}" class="theme-input w-full" required></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Password</label><input type="password" name="password" class="theme-input w-full" required></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Password confirm</label><input type="password" name="password_confirmation" class="theme-input w-full" required></div>
    <div class="mb-4">
        <label class="block font-medium theme-text-secondary mb-1">Role</label>
        <select name="role" class="theme-input w-full">
            <option value="member" {{ old('role', 'member') === 'member' ? 'selected' : '' }}>Member</option>
            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="super_admin" {{ old('role') === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
        </select>
    </div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Status</label><select name="status" class="theme-input w-full"><option value="active">Active</option><option value="inactive">Inactive</option><option value="suspended">Suspended</option></select></div>
    <button type="submit" class="theme-btn">Save</button>
    <a href="{{ route('admin.users.index') }}" class="ml-2 theme-link">Cancel</a>
</form>
@endsection
