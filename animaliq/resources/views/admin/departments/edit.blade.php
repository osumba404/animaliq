@extends('layouts.admin')

@section('title', 'Edit Department')
@section('heading', 'Edit Department')

@section('content')
    <h1 class="text-2xl font-bold mb-4 theme-text-primary">Edit Department</h1>
    <form action="{{ route('admin.departments.update', $department) }}" method="POST" class="max-w-md" id="department-form">
        @csrf @method('PUT')
        <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Name</label><input type="text" name="name" id="dept-name" value="{{ old('name', $department->name) }}" class="theme-input w-full" required></div>
        <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Slug</label><input type="text" name="slug" id="dept-slug" value="{{ old('slug', $department->slug) }}" class="theme-input w-full" placeholder="Leave blank to auto-generate from name"></div>
        <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Mandate</label><textarea name="mandate" class="theme-input w-full" rows="3">{{ old('mandate', $department->mandate) }}</textarea></div>
        <div class="mb-4">
            <span class="block font-medium theme-text-secondary mb-1">Admin sections (which admin areas members of this department can access)</span>
            <p class="text-sm theme-text-secondary mb-2">Select the admin menu sections that admins in this department are allowed to see and edit.</p>
            <div class="flex flex-wrap gap-4">
                @foreach(config('admin_sections.assignable_sections', []) as $key => $label)
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="admin_sections[]" value="{{ $key }}" class="rounded theme-border" {{ in_array($key, old('admin_sections', $department->admin_sections ?? [])) ? 'checked' : '' }}>
                        <span class="theme-text-primary">{{ $label }}</span>
                    </label>
                @endforeach
            </div>
        </div>
        <button type="submit" class="theme-btn">Update</button>
        <a href="{{ route('admin.departments.index') }}" class="ml-2 theme-link">Cancel</a>
    </form>

    <section class="mt-10 pt-8 border-t theme-border">
        <h2 class="text-lg font-semibold theme-text-primary mb-2">Department members</h2>
        <p class="text-sm theme-text-secondary mb-4">Members of this department who have the <strong>admin</strong> role will only see admin menu sections selected above. Add users here to grant them access to those sections.</p>
        @if($department->departmentMembers->isNotEmpty())
            <ul class="space-y-2 mb-4">
                @foreach($department->departmentMembers as $dm)
                    <li class="flex justify-between items-center py-2 theme-table-cell border-b">
                        <span class="theme-text-primary">{{ $dm->user->first_name }} {{ $dm->user->last_name }} ({{ $dm->user->email }}) @if($dm->position_title)– {{ $dm->position_title }}@endif @if($dm->is_lead)<span class="theme-badge text-xs">Lead</span>@endif</span>
                        <form action="{{ route('admin.departments.members.destroy', [$department, $dm]) }}" method="POST" class="inline" onsubmit="return confirm('Remove this member?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-sm">Remove</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="theme-text-secondary text-sm mb-4">No members yet.</p>
        @endif
        <form action="{{ route('admin.departments.members.store', $department) }}" method="POST" class="flex flex-wrap items-end gap-2">
            @csrf
            <div class="min-w-[200px]">
                <label class="block font-medium theme-text-secondary mb-1 text-sm">Add user</label>
                <select name="user_id" class="theme-input w-full" required>
                    <option value="">Select user…</option>
                    @foreach($users as $u)
                        @if(!in_array($u->id, $memberUserIds ?? []))
                            <option value="{{ $u->id }}">{{ $u->first_name }} {{ $u->last_name }} ({{ $u->email }})</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-medium theme-text-secondary mb-1 text-sm">Position (optional)</label>
                <input type="text" name="position_title" class="theme-input w-full" placeholder="e.g. Coordinator" style="min-width: 140px;">
            </div>
            <label class="flex items-center gap-2 pb-2">
                <input type="checkbox" name="is_lead" value="1" class="rounded theme-border">
                <span class="text-sm theme-text-primary">Lead</span>
            </label>
            <button type="submit" class="theme-btn">Add member</button>
        </form>
    </section>
    <script>
    (function(){
        var nameEl = document.getElementById('dept-name');
        var slugEl = document.getElementById('dept-slug');
        if (!nameEl || !slugEl) return;
        function slugify(s) {
            return s.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '') || 'department';
        }
        nameEl.addEventListener('input', function(){
            if (!slugEl.dataset.manual) slugEl.value = slugify(nameEl.value);
        });
        nameEl.addEventListener('blur', function(){
            if (!slugEl.dataset.manual && !slugEl.value) slugEl.value = slugify(nameEl.value);
        });
        slugEl.addEventListener('input', function(){ slugEl.dataset.manual = '1'; });
    })();
    </script>
@endsection
