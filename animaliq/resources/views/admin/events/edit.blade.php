@extends('layouts.admin')

@section('title', 'Edit Event')
@section('heading', 'Edit Event')

@section('content')
    <h1 class="text-2xl font-bold mb-6 theme-text-primary">Edit Event</h1>
    <form action="{{ route('admin.events.update', $event) }}" method="POST" class="max-w-lg" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Program</label>
            <select name="program_id" class="theme-input w-full">
                <option value="">—</option>
                @foreach($programs as $p)
                    <option value="{{ $p->id }}" {{ old('program_id', $event->program_id) == $p->id ? 'selected' : '' }}>{{ $p->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title', $event->title) }}" class="theme-input w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Description</label>
            <textarea name="description" class="theme-input w-full" rows="4">{{ old('description', $event->description) }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Location</label>
            <input type="text" name="location" value="{{ old('location', $event->location) }}" class="theme-input w-full" placeholder="Venue or address">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-medium theme-text-secondary mb-1">Start date & time</label>
                <input type="datetime-local" name="start_datetime" value="{{ old('start_datetime', $event->start_datetime?->format('Y-m-d\TH:i')) }}" class="theme-input w-full">
            </div>
            <div>
                <label class="block font-medium theme-text-secondary mb-1">End date & time</label>
                <input type="datetime-local" name="end_datetime" value="{{ old('end_datetime', $event->end_datetime?->format('Y-m-d\TH:i')) }}" class="theme-input w-full">
            </div>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Capacity</label>
            <input type="number" name="capacity" value="{{ old('capacity', $event->capacity) }}" class="theme-input w-full" min="0" placeholder="Leave empty for unlimited">
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Banner image</label>
            @if($event->banner_image)
                <p class="text-sm theme-text-secondary mb-1">Current: <img src="{{ asset('storage/' . $event->banner_image) }}" alt="" class="inline-block h-16 w-auto object-cover rounded mt-1"></p>
            @endif
            <input type="file" name="banner_image" accept="image/*" class="theme-input w-full">
            <span class="text-xs theme-text-secondary">Leave empty to keep current image</span>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Status</label>
            <select name="status" class="theme-input w-full">
                <option value="active" {{ old('status', $event->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="archived" {{ old('status', $event->status) == 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
            <p class="text-xs theme-text-secondary mt-1">Upcoming / Completed is determined automatically by the start and end dates.</p>
        </div>

        {{-- Existing Documents --}}
        @if($event->documents->isNotEmpty())
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-2">Existing Documents</label>
            <div class="space-y-2">
                @foreach($event->documents as $doc)
                <div class="flex items-center gap-3 theme-card rounded-lg p-3">
                    <svg class="w-5 h-5 theme-accent shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium theme-text-primary truncate">{{ $doc->name }}</p>
                        <p class="text-xs theme-text-secondary">{{ $doc->formatted_size }}</p>
                    </div>
                    <label class="flex items-center gap-1 text-sm text-red-500 cursor-pointer">
                        <input type="checkbox" name="delete_documents[]" value="{{ $doc->id }}"> Delete
                    </label>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Upload New Documents --}}
        <div class="mb-6">
            <label class="block font-medium theme-text-secondary mb-1">Add New Documents</label>
            <p class="text-xs theme-text-secondary mb-2">Upload PDFs, Word docs, spreadsheets, etc. (Max 10MB each)</p>
            <div id="doc-upload-list">
                <div class="doc-upload-row flex gap-2 mb-2">
                    <input type="text" name="document_names[]" placeholder="Document name (optional)" class="theme-input flex-1">
                    <input type="file" name="documents[]" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip" class="theme-input flex-1">
                    <button type="button" class="theme-btn-outline text-sm px-3 add-doc-row">+</button>
                </div>
            </div>
        </div>

        <button type="submit" class="theme-btn">Update</button>
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
