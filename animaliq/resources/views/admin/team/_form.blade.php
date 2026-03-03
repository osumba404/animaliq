@php $isEdit = isset($member); @endphp
<form action="{{ $isEdit ? route('admin.team.update', $member) : route('admin.team.store') }}" method="POST" class="max-w-md">
    @csrf
    @if($isEdit) @method('PUT') @endif
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Name</label><input type="text" name="name" value="{{ old('name', $member->name ?? '') }}" class="theme-input w-full" required></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Image path</label><input type="text" name="image" value="{{ old('image', $member->image ?? '') }}" class="theme-input w-full" placeholder="path/to/photo.jpg"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Role</label><input type="text" name="role" value="{{ old('role', $member->role ?? '') }}" class="theme-input w-full" required placeholder="e.g. Director"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Remarks</label><textarea name="remarks" rows="2" class="theme-input w-full">{{ old('remarks', $member->remarks ?? '') }}</textarea></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Role description</label><textarea name="role_description" rows="2" class="theme-input w-full">{{ old('role_description', $member->role_description ?? '') }}</textarea></div>
    <div class="mb-4">
        <span class="block font-medium theme-text-secondary mb-1">Socials</span>
        @php $socials = $member->socials ?? []; @endphp
        <div class="grid grid-cols-2 gap-2 mt-1">
            <input type="text" name="socials[twitter]" value="{{ old('socials.twitter', $socials['twitter'] ?? '') }}" class="theme-input" placeholder="Twitter/X URL">
            <input type="text" name="socials[instagram]" value="{{ old('socials.instagram', $socials['instagram'] ?? '') }}" class="theme-input" placeholder="Instagram URL">
            <input type="text" name="socials[facebook]" value="{{ old('socials.facebook', $socials['facebook'] ?? '') }}" class="theme-input" placeholder="Facebook URL">
            <input type="text" name="socials[linkedin]" value="{{ old('socials.linkedin', $socials['linkedin'] ?? '') }}" class="theme-input" placeholder="LinkedIn URL">
        </div>
    </div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Display order</label><input type="number" name="display_order" value="{{ old('display_order', $member->display_order ?? 0) }}" class="theme-input w-full"></div>
    <button type="submit" class="theme-btn">{{ $isEdit ? 'Update' : 'Create' }}</button>
    <button type="button" class="ml-2 theme-btn-outline" onclick="document.getElementById('crud-modal').classList.add('hidden');document.body.style.overflow='';">Cancel</button>
</form>
