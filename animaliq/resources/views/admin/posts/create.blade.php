@extends('layouts.admin')

@section('title', 'Create Post')
@section('heading', 'Create Post')

@section('content')
    <div class="max-w-4xl">
        <h1 class="text-2xl font-bold mb-6 theme-text-primary">Create Post</h1>

        @if($errors->any())
            <div class="theme-card rounded-xl p-4 mb-6 theme-alert-error">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="post-form">
            @csrf

            <div class="theme-card rounded-xl p-6 space-y-4">
                <h2 class="text-lg font-semibold theme-text-primary theme-section-title">Basic info</h2>
                <div>
                    <label class="block font-medium theme-text-secondary mb-1">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="post-title" value="{{ old('title') }}" class="theme-input w-full" required placeholder="Post title">
                </div>
                <div>
                    <label class="block font-medium theme-text-secondary mb-1">Slug (optional, auto from title)</label>
                    <input type="text" name="slug" id="post-slug" value="{{ old('slug') }}" class="theme-input w-full" placeholder="url-friendly-slug">
                </div>
                <div>
                    <label class="block font-medium theme-text-secondary mb-1">Campaign</label>
                    <select name="campaign_id" class="theme-input w-full">
                        <option value="">— None —</option>
                        @foreach($campaigns as $c)
                            <option value="{{ $c->id }}" {{ old('campaign_id') == $c->id ? 'selected' : '' }}>{{ $c->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="theme-card rounded-xl p-6 space-y-4">
                <h2 class="text-lg font-semibold theme-text-primary theme-section-title">Featured image</h2>
                <div>
                    <label class="block font-medium theme-text-secondary mb-1">Upload image</label>
                    <input type="file" name="featured_image" accept="image/*" class="theme-input w-full">
                </div>
            </div>

            <div class="theme-card rounded-xl p-6 space-y-4">
                <h2 class="text-lg font-semibold theme-text-primary theme-section-title">Content (HTML supported)</h2>
                <p class="text-sm theme-text-secondary">Use the toolbar to insert headings, lists, links, and more. You can also write HTML directly.</p>

                <div class="cms-toolbar flex flex-wrap gap-2 p-2 rounded-lg theme-bg-secondary border border-[var(--border-color)] mb-2">
                    <button type="button" class="cms-insert theme-btn-outline text-sm py-1 px-2" data-open="&lt;h1&gt;" data-close="&lt;/h1&gt;">H1</button>
                    <button type="button" class="cms-insert theme-btn-outline text-sm py-1 px-2" data-open="&lt;h2&gt;" data-close="&lt;/h2&gt;">H2</button>
                    <button type="button" class="cms-insert theme-btn-outline text-sm py-1 px-2" data-open="&lt;h3&gt;" data-close="&lt;/h3&gt;">H3</button>
                    <button type="button" class="cms-insert theme-btn-outline text-sm py-1 px-2" data-open="&lt;h4&gt;" data-close="&lt;/h4&gt;">H4</button>
                    <button type="button" class="cms-insert theme-btn-outline text-sm py-1 px-2" data-open="&lt;p&gt;" data-close="&lt;/p&gt;">P</button>
                    <button type="button" class="cms-insert theme-btn-outline text-sm py-1 px-2" data-open="&lt;strong&gt;" data-close="&lt;/strong&gt;">B</button>
                    <button type="button" class="cms-insert theme-btn-outline text-sm py-1 px-2" data-open="&lt;em&gt;" data-close="&lt;/em&gt;">I</button>
                    <button type="button" class="cms-insert theme-btn-outline text-sm py-1 px-2" data-open="&lt;ul&gt;&#10;&lt;li&gt;" data-close="&lt;/li&gt;&#10;&lt;/ul&gt;">UL</button>
                    <button type="button" class="cms-insert theme-btn-outline text-sm py-1 px-2" data-open="&lt;ol&gt;&#10;&lt;li&gt;" data-close="&lt;/li&gt;&#10;&lt;/ol&gt;">OL</button>
                    <button type="button" class="cms-insert theme-btn-outline text-sm py-1 px-2" data-open="&lt;blockquote&gt;" data-close="&lt;/blockquote&gt;">Quote</button>
                    <button type="button" class="cms-insert theme-btn-outline text-sm py-1 px-2" data-open="&lt;hr&gt;" data-close="">HR</button>
                    <button type="button" class="cms-insert theme-btn-outline text-sm py-1 px-2" data-open="&lt;a href=&quot;&quot;&gt;" data-close="&lt;/a&gt;">Link</button>
                </div>

                <textarea name="content" id="post-content" class="theme-input w-full font-mono text-sm min-h-[320px]" rows="16" placeholder="Write your post content (HTML allowed)...">{{ old('content') }}</textarea>

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
                            <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium theme-text-secondary mb-1">Published at</label>
                        <input type="datetime-local" name="published_at" value="{{ old('published_at') }}" class="theme-input w-full">
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap gap-2">
                <button type="submit" class="theme-btn">Save post</button>
                <a href="{{ route('admin.posts.index') }}" class="theme-btn-outline">Cancel</a>
            </div>
        </form>
    </div>

    @include('admin.posts.partials.cms-script')
@endsection
