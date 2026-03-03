@extends('layouts.admin')
@section('title', 'Add Slide')
@section('heading', 'Add Homepage Slide')
@section('content')
<form action="{{ route('admin.settings.slides.store') }}" method="POST" class="max-w-md">
    @csrf
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Title</label><input type="text" name="title" value="{{ old('title') }}" class="theme-input w-full"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Subtitle</label><textarea name="subtitle" rows="2" class="theme-input w-full">{{ old('subtitle') }}</textarea></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Image path</label><input type="text" name="image_path" value="{{ old('image_path') }}" class="theme-input w-full" placeholder="path/to/image.jpg"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">CTA text</label><input type="text" name="cta_text" value="{{ old('cta_text') }}" class="theme-input w-full" placeholder="Primary button"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">CTA link</label><input type="text" name="cta_link" value="{{ old('cta_link') }}" class="theme-input w-full" placeholder="Primary button URL"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">CTA secondary text</label><input type="text" name="cta_secondary_text" value="{{ old('cta_secondary_text') }}" class="theme-input w-full" placeholder="Secondary button"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">CTA secondary link</label><input type="text" name="cta_secondary_link" value="{{ old('cta_secondary_link') }}" class="theme-input w-full" placeholder="Secondary button URL"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Display order</label><input type="number" name="display_order" value="{{ old('display_order', 0) }}" class="theme-input w-full"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Status</label><select name="status" class="theme-input w-full"><option value="inactive">Inactive</option><option value="active">Active</option></select></div>
    <button type="submit" class="theme-btn">Create</button>
    <a href="{{ route('admin.settings.slides') }}" class="ml-2 theme-link">Cancel</a>
</form>
@endsection
