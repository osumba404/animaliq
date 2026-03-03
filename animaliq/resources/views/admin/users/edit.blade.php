@extends('layouts.admin') @section('title', 'Edit User') @section('content')
<h1 class="text-2xl font-bold mb-4">Edit User</h1>
<form action="{{ route('admin.users.update', $user) }}" method="POST" class="max-w-md">@csrf @method('PUT')
<div class="mb-4"><label class="block">First name</label><input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="w-full border rounded px-2 py-1" required></div>
<div class="mb-4"><label class="block">Last name</label><input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="w-full border rounded px-2 py-1" required></div>
<div class="mb-4"><label class="block">Email</label><input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded px-2 py-1" required></div>
<div class="mb-4"><label class="block">Password (leave blank to keep)</label><input type="password" name="password" class="w-full border rounded px-2 py-1"></div>
<div class="mb-4"><label class="block">Status</label><select name="status" class="w-full border rounded px-2 py-1">@foreach(['active','inactive','suspended'] as $s)<option value="{{ $s }}" {{ $user->status == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>@endforeach</select></div>
<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button></form>
@endsection
