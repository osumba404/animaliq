@extends('layouts.admin')

@section('title', 'Create Event')
@section('heading', 'Create Event')

@section('content')
    <h1 class="text-2xl font-bold mb-6 theme-text-primary">Create Event</h1>
    <form action="{{ route('admin.events.store') }}" method="POST" class="max-w-lg" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Program</label>
            <select name="program_id" class="theme-input w-full">
                <option value="">—</option>
                @foreach($programs as $p)
                    <option value="{{ $p->id }}" {{ old('program_id') == $p->id ? 'selected' : '' }}>{{ $p->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="theme-input w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Description</label>
            <textarea name="description" class="theme-input w-full" rows="4">{{ old('description') }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Location</label>
            <input type="text" name="location" value="{{ old('location') }}" class="theme-input w-full" placeholder="Venue or address">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-medium theme-text-secondary mb-1">Start date & time</label>
                <input type="datetime-local" name="start_datetime" value="{{ old('start_datetime') }}" class="theme-input w-full">
            </div>
            <div>
                <label class="block font-medium theme-text-secondary mb-1">End date & time</label>
                <input type="datetime-local" name="end_datetime" value="{{ old('end_datetime') }}" class="theme-input w-full">
            </div>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Capacity</label>
            <input type="number" name="capacity" value="{{ old('capacity') }}" class="theme-input w-full" min="0" placeholder="Leave empty for unlimited">
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Banner image</label>
            <input type="file" name="banner_image" accept="image/*" class="theme-input w-full">
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Status</label>
            <select name="status" class="theme-input w-full">
                <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
            <p class="text-xs theme-text-secondary mt-1">Upcoming / Completed is determined automatically by the start and end dates.</p>
        </div>

        {{-- Documents --}}
        <div class="mb-6">
            <label class="block font-medium theme-text-secondary mb-1">Event Documents</label>
            <p class="text-xs theme-text-secondary mb-2">Upload PDFs, Word docs, spreadsheets, etc. that attendees can download. (Max 10MB each)</p>
            <div id="doc-upload-list">
                <div class="doc-upload-row flex gap-2 mb-2">
                    <input type="text" name="document_names[]" placeholder="Document name (optional)" class="theme-input flex-1">
                    <input type="file" name="documents[]" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip" class="theme-input flex-1">
                    <button type="button" class="theme-btn-outline text-sm px-3 add-doc-row">+</button>
                </div>
            </div>
        </div>

        <button type="submit" class="theme-btn">Save</button>
        <a href="{{ route('admin.events.index') }}" class="ml-2 theme-link">Cancel</a>
    </form>
    <script>
    document.querySelectorAll('.add-doc-row').forEach(btn => {
        btn.addEventListener('click', function() {
            const list = document.getElementById('doc-upload-list');
            const row = document.createElement('div');
            row.className = 'doc-upload-row flex gap-2 mb-2';
            row.innerHTML = '<input type="text" name="document_names[]" placeholder="Document name (optional)" class="theme-input flex-1"><input type="file" name="documents[]" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip" class="theme-input flex-1"><button type="button" class="theme-btn-outline text-sm px-3 remove-doc-row">×</button>';
            list.appendChild(row);
            row.querySelector('.remove-doc-row').addEventListener('click', () => row.remove());
        });
    });
    </script>
@endsection
