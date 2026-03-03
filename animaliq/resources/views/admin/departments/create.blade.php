@extends('layouts.admin')

@section('title', 'Create Department')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Create Department</h1>
    <form action="{{ route('admin.departments.store') }}" method="POST" class="max-w-md">
        @csrf
        <div class="mb-4"><label class="block">Name</label><input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-2 py-1" required></div>
        <div class="mb-4"><label class="block">Slug</label><input type="text" name="slug" value="{{ old('slug') }}" class="w-full border rounded px-2 py-1"></div>
        <div class="mb-4"><label class="block">Mandate</label><textarea name="mandate" class="w-full border rounded px-2 py-1">{{ old('mandate') }}</textarea></div>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
    </form>
@endsection
