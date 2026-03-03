@extends('layouts.admin') @section('title', 'Edit Setting') @section('content')
<h1 class="text-2xl font-bold mb-4">Edit: {{ $setting->setting_key }}</h1>
<form action="{{ route('admin.settings.update', $setting) }}" method="POST" class="max-w-md">@csrf @method('PUT')
<div class="mb-4"><label class="block">Value</label><textarea name="setting_value" class="w-full border rounded px-2 py-1">{{ old('setting_value', $setting->setting_value) }}</textarea></div>
<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button></form>
@endsection
