@extends('layouts.admin') @section('title', 'Create User') @section('content')
<h1 class="text-2xl font-bold mb-4">Create User</h1>
<form action="{{ route('admin.users.store') }}" method="POST" class="max-w-md">@csrf
<div class="mb-4"><label class="block">First name</label><input type="text" name="first_name" value="{{ old('first_name') }}" class="w-full border rounded px-2 py-1" required></div>
<div class="mb-4"><label class="block">Last name</label><input type="text" name="last_name" value="{{ old('last_name') }}" class="w-full border rounded px-2 py-1" required></div>
<div class="mb-4"><label class="block">Email</label><input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-2 py-1" required></div>
<div class="mb-4"><label class="block">Password</label><input type="password" name="password" class="w-full border rounded px-2 py-1" required></div>
<div class="mb-4"><label class="block">Password confirm</label><input type="password" name="password_confirmation" class="w-full border rounded px-2 py-1" required></div>
<div class="mb-4"><label class="block">Status</label><select name="status" class="w-full border rounded px-2 py-1"><option value="active">Active</option><option value="inactive">Inactive</option><option value="suspended">Suspended</option></select></div>
<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button></form>
@endsection
