@extends('layouts.admin')
@section('title', 'Edit Slide')
@section('heading', 'Edit Homepage Slide')
@section('content')
<form action="{{ route('admin.settings.slides.update', $slide) }}" method="POST" class="max-w-md" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Title</label><input type="text" name="title" value="{{ old('title', $slide->title) }}" class="theme-input w-full"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Subtitle</label><textarea name="subtitle" rows="2" class="theme-input w-full">{{ old('subtitle', $slide->subtitle) }}</textarea></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Image</label>@if($slide->image_path)<p class="text-sm theme-text-secondary mb-1">Current: <img src="{{ asset('storage/' . $slide->image_path) }}" alt="" class="inline-block h-8 w-auto"></p>@endif<input type="file" name="image" accept="image/*" class="theme-input w-full"><span class="text-xs theme-text-secondary">Leave empty to keep current</span></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">CTA text (primary)</label><input type="text" name="cta_text" value="{{ old('cta_text', $slide->cta_text) }}" class="theme-input w-full" placeholder="Primary button"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">CTA link (primary)</label><input type="text" name="cta_link" value="{{ old('cta_link', $slide->cta_link) }}" class="theme-input w-full" placeholder="Primary button URL"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">CTA secondary text</label><input type="text" name="cta_secondary_text" value="{{ old('cta_secondary_text', $slide->cta_secondary_text) }}" class="theme-input w-full" placeholder="Secondary button"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">CTA secondary link</label><input type="text" name="cta_secondary_link" value="{{ old('cta_secondary_link', $slide->cta_secondary_link) }}" class="theme-input w-full" placeholder="Secondary button URL"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Display order</label><input type="number" name="display_order" value="{{ old('display_order', $slide->display_order) }}" class="theme-input w-full"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Status</label><select name="status" class="theme-input w-full"><option value="inactive" {{ ($slide->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option><option value="active" {{ ($slide->status ?? '') === 'active' ? 'selected' : '' }}>Active</option></select></div>
    <button type="submit" class="theme-btn">Update</button>
    <a href="{{ route('admin.settings.slides') }}" class="ml-2 theme-link">Cancel</a>
</form>
@endsection
