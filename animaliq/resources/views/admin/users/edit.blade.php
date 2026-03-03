@extends('layouts.admin')
@section('title', 'Edit User')
@section('heading', 'Edit User')
@section('content')
<h1 class="text-2xl font-bold mb-4 theme-text-primary">Edit User</h1>
<form action="{{ route('admin.users.update', $user) }}" method="POST" class="max-w-md">
    @csrf
    @method('PUT')
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">First name</label><input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="theme-input w-full" required></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Last name</label><input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="theme-input w-full" required></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Email</label><input type="email" name="email" value="{{ old('email', $user->email) }}" class="theme-input w-full" required></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Password (leave blank to keep)</label><input type="password" name="password" class="theme-input w-full"></div>
    <div class="mb-4">
        <label class="block font-medium theme-text-secondary mb-1">Role</label>
        <select name="role" class="theme-input w-full">
            <option value="member" {{ old('role', $user->role) === 'member' ? 'selected' : '' }}>Member</option>
            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="super_admin" {{ old('role', $user->role) === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
        </select>
    </div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Status</label><select name="status" class="theme-input w-full">@foreach(['active','inactive','suspended'] as $s)<option value="{{ $s }}" {{ old('status', $user->status) == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>@endforeach</select></div>
    <button type="submit" class="theme-btn">Update</button>
    <a href="{{ route('admin.users.index') }}" class="ml-2 theme-link">Cancel</a>
</form>
@endsection
