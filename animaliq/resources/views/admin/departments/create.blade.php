@extends('layouts.admin')

@section('title', 'Create Department')
@section('heading', 'Create Department')

@section('content')
    <h1 class="text-2xl font-bold mb-4 theme-text-primary">Create Department</h1>
    <form action="{{ route('admin.departments.store') }}" method="POST" class="max-w-md" id="department-form">
        @csrf
        <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Name</label><input type="text" name="name" id="dept-name" value="{{ old('name') }}" class="theme-input w-full" required></div>
        <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Slug</label><input type="text" name="slug" id="dept-slug" value="{{ old('slug') }}" class="theme-input w-full" placeholder="Leave blank to auto-generate from name"></div>
        <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Mandate</label><textarea name="mandate" class="theme-input w-full" rows="3">{{ old('mandate') }}</textarea></div>
        <button type="submit" class="theme-btn">Save</button>
        <a href="{{ route('admin.departments.index') }}" class="ml-2 theme-link">Cancel</a>
    </form>
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
