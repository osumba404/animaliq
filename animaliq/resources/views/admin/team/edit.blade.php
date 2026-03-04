@extends('layouts.admin')
@section('title', 'Edit Team Member')
@section('heading', 'Edit Team Member')
@section('content')
<form action="{{ route('admin.team.update', $member) }}" method="POST" class="max-w-md" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Name</label><input type="text" name="name" value="{{ old('name', $member->name) }}" class="theme-input w-full" required></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Photo</label>@if($member->image)<p class="text-sm theme-text-secondary mb-1">Current: <img src="{{ asset('storage/' . $member->image) }}" alt="" class="inline-block h-10 w-10 object-cover rounded"></p>@endif<input type="file" name="image" accept="image/*" class="theme-input w-full"><span class="text-xs theme-text-secondary">Leave empty to keep current</span></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Role</label><input type="text" name="role" value="{{ old('role', $member->role) }}" class="theme-input w-full" required></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Remarks</label><textarea name="remarks" rows="2" class="theme-input w-full">{{ old('remarks', $member->remarks) }}</textarea></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Role description</label><textarea name="role_description" rows="2" class="theme-input w-full">{{ old('role_description', $member->role_description) }}</textarea></div>
    @php $socials = $member->socials ?? []; @endphp
    <div class="mb-4">
        <span class="block font-medium theme-text-secondary mb-1">Socials</span>
        <div class="grid grid-cols-2 gap-2 mt-1">
            <input type="text" name="socials[twitter]" value="{{ old('socials.twitter', $socials['twitter'] ?? '') }}" class="theme-input" placeholder="Twitter/X URL">
            <input type="text" name="socials[instagram]" value="{{ old('socials.instagram', $socials['instagram'] ?? '') }}" class="theme-input" placeholder="Instagram URL">
            <input type="text" name="socials[facebook]" value="{{ old('socials.facebook', $socials['facebook'] ?? '') }}" class="theme-input" placeholder="Facebook URL">
            <input type="text" name="socials[linkedin]" value="{{ old('socials.linkedin', $socials['linkedin'] ?? '') }}" class="theme-input" placeholder="LinkedIn URL">
        </div>
    </div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Display order</label><input type="number" name="display_order" value="{{ old('display_order', $member->display_order) }}" class="theme-input w-full"></div>
    <button type="submit" class="theme-btn">Update</button>
    <a href="{{ route('admin.team.index') }}" class="ml-2 theme-link">Cancel</a>
</form>
@endsection
