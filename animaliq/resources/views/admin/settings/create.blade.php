@extends('layouts.admin')
@section('title', 'Create Setting')
@section('heading', 'Create Setting')
@section('content')
<form action="{{ route('admin.settings.store') }}" method="POST" class="max-w-md">
    @csrf
    <div class="mb-4">
        <label class="block font-medium theme-text-secondary mb-1">Key</label>
        <input type="text" name="setting_key" value="{{ old('setting_key') }}" class="theme-input" required placeholder="e.g. site_name">
    </div>
    <div class="mb-4">
        <label class="block font-medium theme-text-secondary mb-1">Value</label>
        <textarea name="setting_value" rows="3" class="theme-input">{{ old('setting_value') }}</textarea>
    </div>
    <div class="mb-4">
        <label class="block font-medium theme-text-secondary mb-1">Type</label>
        <select name="type" class="theme-input">
            <option value="text" {{ old('type', 'text') === 'text' ? 'selected' : '' }}>Text</option>
            <option value="image" {{ old('type') === 'image' ? 'selected' : '' }}>Image</option>
            <option value="json" {{ old('type') === 'json' ? 'selected' : '' }}>JSON</option>
            <option value="boolean" {{ old('type') === 'boolean' ? 'selected' : '' }}>Boolean</option>
        </select>
    </div>
    <button type="submit" class="theme-btn">Create</button>
    <a href="{{ route('admin.settings.index') }}" class="ml-2 theme-link">Cancel</a>
</form>
@endsection
