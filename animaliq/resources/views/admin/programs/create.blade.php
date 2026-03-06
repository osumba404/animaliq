@extends('layouts.admin')

@section('title', 'Create Program')
@section('heading', 'Create Program')

@section('content')
    <h1 class="text-2xl font-bold mb-6 theme-text-primary">Create Program</h1>
    <form action="{{ route('admin.programs.store') }}" method="POST" class="max-w-md" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="theme-input w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Description</label>
            <textarea name="description" class="theme-input w-full" rows="4">{{ old('description') }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Image</label>
            <input type="file" name="image" accept="image/*" class="theme-input w-full">
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Department</label>
            <select name="department_id" class="theme-input w-full">
                <option value="">—</option>
                @foreach($departments as $d)
                    <option value="{{ $d->id }}" {{ old('department_id') == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Status</label>
            <select name="status" class="theme-input w-full">
                <option value="active">Active</option>
                <option value="archived">Archived</option>
            </select>
        </div>
        <button type="submit" class="theme-btn">Save</button>
        <a href="{{ route('admin.programs.index') }}" class="ml-2 theme-link">Cancel</a>
    </form>
@endsection
