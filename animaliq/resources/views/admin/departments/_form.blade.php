@php $isEdit = isset($department); @endphp
<form action="{{ $isEdit ? route('admin.departments.update', $department) : route('admin.departments.store') }}" method="POST" class="max-w-md" id="department-form">
    @csrf
    @if($isEdit) @method('PUT') @endif
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Name</label><input type="text" name="name" id="dept-name" value="{{ old('name', $department->name ?? '') }}" class="theme-input w-full" required></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Slug</label><input type="text" name="slug" id="dept-slug" value="{{ old('slug', $department->slug ?? '') }}" class="theme-input w-full" placeholder="Leave blank to auto-generate"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Mandate</label><textarea name="mandate" class="theme-input w-full" rows="3">{{ old('mandate', $department->mandate ?? '') }}</textarea></div>
    <div class="mb-4">
        <span class="block font-medium theme-text-secondary mb-1">Admin sections (what members of this department can access)</span>
        <div class="flex flex-wrap gap-3">
            @foreach(config('admin_sections.assignable_sections', []) as $key => $label)
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="admin_sections[]" value="{{ $key }}" class="rounded theme-border" {{ in_array($key, old('admin_sections', $department->admin_sections ?? [])) ? 'checked' : '' }}>
                    <span class="theme-text-primary text-sm">{{ $label }}</span>
                </label>
            @endforeach
        </div>
    </div>
    <button type="submit" class="theme-btn">{{ $isEdit ? 'Update' : 'Create' }}</button>
    <button type="button" class="ml-2 theme-btn-outline" onclick="document.getElementById('crud-modal').classList.add('hidden');document.body.style.overflow='';">Cancel</button>
</form>
<script>
(function(){
    var nameEl = document.getElementById('dept-name');
    var slugEl = document.getElementById('dept-slug');
    if (!nameEl || !slugEl) return;
    function slugify(s) { return (s || '').toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '') || 'department'; }
    nameEl.addEventListener('input', function(){ if (!slugEl.dataset.manual) slugEl.value = slugify(nameEl.value); });
    nameEl.addEventListener('blur', function(){ if (!slugEl.dataset.manual && !slugEl.value) slugEl.value = slugify(nameEl.value); });
    slugEl.addEventListener('input', function(){ slugEl.dataset.manual = '1'; });
})();
</script>
