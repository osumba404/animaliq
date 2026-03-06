@extends('layouts.admin')

@section('title', 'Edit Post')
@section('heading', 'Edit Post')

@section('content')
    <div class="max-w-4xl">
        <h1 class="text-2xl font-bold mb-6 theme-text-primary">Edit Post</h1>

        @if($errors->any())
            <div class="theme-card rounded-xl p-4 mb-6 theme-alert-error">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="post-form" data-upload-url="{{ route('admin.posts.upload-image') }}">
            @csrf
            @method('PUT')

            <div class="theme-card rounded-xl p-6 space-y-4">
                <h2 class="text-lg font-semibold theme-text-primary theme-section-title">Basic info</h2>
                <div>
                    <label class="block font-medium theme-text-secondary mb-1">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="post-title" value="{{ old('title', $post->title) }}" class="theme-input w-full" required placeholder="Post title">
                </div>
                <div>
                    <label class="block font-medium theme-text-secondary mb-1">Slug (optional, auto from title)</label>
                    <input type="text" name="slug" id="post-slug" value="{{ old('slug', $post->slug) }}" class="theme-input w-full" placeholder="url-friendly-slug">
                </div>
            </div>

            <div class="theme-card rounded-xl p-6 space-y-4">
                <h2 class="text-lg font-semibold theme-text-primary theme-section-title">Featured image</h2>
                @if($post->featured_image)
                    <p class="text-sm theme-text-secondary mb-1">Current image:</p>
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="" class="h-32 w-auto object-cover rounded-lg border border-[var(--border-color)] mb-2">
                    <p class="text-xs theme-text-secondary">Upload a new image to replace, or leave empty to keep.</p>
                @endif
                <div>
                    <label class="block font-medium theme-text-secondary mb-1">Upload image</label>
                    <input type="file" name="featured_image" accept="image/*" class="theme-input w-full">
                </div>
            </div>

            <div class="theme-card rounded-xl p-6 space-y-4">
                <h2 class="text-lg font-semibold theme-text-primary theme-section-title">Content</h2>
                <p class="text-sm theme-text-secondary">Write your post below. Use the toolbar for headings, bold, italic, lists, quotes, and links—no coding required.</p>

                <div class="cms-toolbar flex flex-wrap gap-2 p-2 rounded-lg theme-bg-secondary border border-[var(--border-color)] mb-2" id="cms-toolbar-wrap">
                    <button type="button" class="cms-cmd theme-btn-outline text-sm py-1 px-2" data-cmd="formatBlock" data-value="h1">H1</button>
                    <button type="button" class="cms-cmd theme-btn-outline text-sm py-1 px-2" data-cmd="formatBlock" data-value="h2">H2</button>
                    <button type="button" class="cms-cmd theme-btn-outline text-sm py-1 px-2" data-cmd="formatBlock" data-value="h3">H3</button>
                    <button type="button" class="cms-cmd theme-btn-outline text-sm py-1 px-2" data-cmd="formatBlock" data-value="h4">H4</button>
                    <button type="button" class="cms-cmd theme-btn-outline text-sm py-1 px-2" data-cmd="formatBlock" data-value="p">Paragraph</button>
                    <button type="button" class="cms-cmd theme-btn-outline text-sm py-1 px-2" data-cmd="bold">Bold</button>
                    <button type="button" class="cms-cmd theme-btn-outline text-sm py-1 px-2" data-cmd="italic">Italic</button>
                    <button type="button" class="cms-cmd theme-btn-outline text-sm py-1 px-2" data-cmd="insertUnorderedList">Bullet list</button>
                    <button type="button" class="cms-cmd theme-btn-outline text-sm py-1 px-2" data-cmd="insertOrderedList">Numbered list</button>
                    <button type="button" class="cms-cmd theme-btn-outline text-sm py-1 px-2" data-cmd="formatBlock" data-value="blockquote">Quote</button>
                    <button type="button" class="cms-cmd theme-btn-outline text-sm py-1 px-2" data-cmd="insertHorizontalRule">Line</button>
                    <button type="button" class="cms-cmd theme-btn-outline text-sm py-1 px-2" data-cmd="createLink" data-prompt="true">Link</button>
                    <input type="file" id="cms-image-input" accept="image/*" class="hidden">
                    <button type="button" class="cms-insert-image theme-btn-outline text-sm py-1 px-2">Image</button>
                </div>

                <input type="hidden" name="content" id="post-content">
                <div id="post-content-editor" class="cms-editor theme-input w-full min-h-[320px] p-4 text-left" contenteditable="true" data-placeholder="Write your post here…">{!! old('content', $post->content) !!}</div>

                <div class="flex flex-wrap items-center gap-4 text-sm theme-text-secondary cms-counters">
                    <span id="cms-words">Words: 0</span>
                    <span id="cms-chars">Characters: 0</span>
                    <span id="cms-tags" class="ml-auto">Tags: —</span>
                </div>
            </div>

            <div class="theme-card rounded-xl p-6 space-y-4">
                <h2 class="text-lg font-semibold theme-text-primary theme-section-title">Publish</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium theme-text-secondary mb-1">Status</label>
                        <select name="status" class="theme-input w-full">
                            <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium theme-text-secondary mb-1">Published at</label>
                        <input type="datetime-local" name="published_at" value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}" class="theme-input w-full">
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap gap-2">
                <button type="submit" class="theme-btn">Update post</button>
                <a href="{{ route('admin.posts.index') }}" class="theme-btn-outline">Cancel</a>
            </div>
        </form>
    </div>

    @include('admin.posts.partials.cms-script')
@endsection
