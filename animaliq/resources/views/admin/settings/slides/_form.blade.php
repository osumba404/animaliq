@php $isEdit = isset($slide); @endphp
<form action="{{ $isEdit ? route('admin.settings.slides.update', $slide) : route('admin.settings.slides.store') }}" method="POST" class="max-w-md" enctype="multipart/form-data">
    @csrf
    @if($isEdit) @method('PUT') @endif
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Title</label><input type="text" name="title" value="{{ old('title', $slide->title ?? '') }}" class="theme-input w-full"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Subtitle</label><textarea name="subtitle" rows="2" class="theme-input w-full">{{ old('subtitle', $slide->subtitle ?? '') }}</textarea></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Image</label>@if($isEdit && $slide->image_path)<p class="text-sm theme-text-secondary mb-1">Current: <img src="{{ asset('storage/' . $slide->image_path) }}" alt="" class="inline-block h-8 w-auto"></p>@endif<input type="file" name="image" accept="image/*" class="theme-input w-full">@if($isEdit)<span class="text-xs theme-text-secondary">Leave empty to keep current</span>@endif</div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">CTA text</label><input type="text" name="cta_text" value="{{ old('cta_text', $slide->cta_text ?? '') }}" class="theme-input w-full" placeholder="Primary button"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">CTA link</label><input type="text" name="cta_link" value="{{ old('cta_link', $slide->cta_link ?? '') }}" class="theme-input w-full" placeholder="Primary button URL"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">CTA secondary text</label><input type="text" name="cta_secondary_text" value="{{ old('cta_secondary_text', $slide->cta_secondary_text ?? '') }}" class="theme-input w-full"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">CTA secondary link</label><input type="text" name="cta_secondary_link" value="{{ old('cta_secondary_link', $slide->cta_secondary_link ?? '') }}" class="theme-input w-full"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Display order</label><input type="number" name="display_order" value="{{ old('display_order', $slide->display_order ?? 0) }}" class="theme-input w-full"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Status</label><select name="status" class="theme-input w-full"><option value="inactive" {{ old('status', $slide->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option><option value="active" {{ old('status', $slide->status ?? '') === 'active' ? 'selected' : '' }}>Active</option></select></div>
    <button type="submit" class="theme-btn">{{ $isEdit ? 'Update' : 'Create' }}</button>
    <button type="button" class="ml-2 theme-btn-outline" onclick="document.getElementById('crud-modal').classList.add('hidden');document.body.style.overflow='';">Cancel</button>
</form>
