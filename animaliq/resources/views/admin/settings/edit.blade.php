@extends('layouts.admin')
@section('title', 'Edit ' . $setting->setting_key)
@section('heading', 'Edit: ' . $setting->setting_key)
@section('content')
<form action="{{ route('admin.settings.update', $setting) }}" method="POST" class="max-w-md">
    @csrf
    @method('PUT')
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Value</label><textarea name="setting_value" rows="4" class="theme-input w-full">{{ old('setting_value', $setting->setting_value) }}</textarea></div>
    <button type="submit" class="theme-btn">Update</button>
    <a href="{{ route('admin.settings.index') }}" class="ml-2 theme-link">Cancel</a>
</form>
@endsection
