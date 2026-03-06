@extends('layouts.admin')

@section('title', 'Edit Program')
@section('heading', 'Edit Program')

@section('content')
    <h1 class="text-2xl font-bold mb-6 theme-text-primary">Edit Program</h1>
    <form action="{{ route('admin.programs.update', $program) }}" method="POST" class="max-w-md" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title', $program->title) }}" class="theme-input w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Description</label>
            <textarea name="description" class="theme-input w-full" rows="4">{{ old('description', $program->description) }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Image</label>
            @if($program->image)
                <p class="text-sm theme-text-secondary mb-1">Current: <img src="{{ asset('storage/' . $program->image) }}" alt="" class="inline-block h-12 w-12 object-cover rounded"></p>
            @endif
            <input type="file" name="image" accept="image/*" class="theme-input w-full">
            <span class="text-xs theme-text-secondary">Leave empty to keep current</span>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Department</label>
            <select name="department_id" class="theme-input w-full">
                <option value="">—</option>
                @foreach($departments as $d)
                    <option value="{{ $d->id }}" {{ old('department_id', $program->department_id) == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Status</label>
            <select name="status" class="theme-input w-full">
                <option value="active" {{ ($program->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="archived" {{ ($program->status ?? '') == 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
        </div>
        <button type="submit" class="theme-btn">Update</button>
        <a href="{{ route('admin.programs.index') }}" class="ml-2 theme-link">Cancel</a>
    </form>
@endsection
