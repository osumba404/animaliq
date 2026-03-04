@extends('layouts.admin')
@section('title', 'Homepage Slides')
@section('heading', 'Homepage Slides')
@section('content')
<p class="mb-4"><a href="{{ route('admin.settings.slides.create-form') }}" class="theme-btn inline-block" data-crud-modal>Add Slide</a></p>
<ul class="space-y-0">
    @foreach($slides as $s)
    <li class="flex justify-between items-center py-3 theme-table-cell border-b">
        <span class="theme-text-primary">{{ $s->title ?: '(No title)' }} — {{ $s->status }} (order: {{ $s->display_order ?? 0 }})</span>
        <span>
            <a href="{{ route('admin.settings.slides.edit-form', $s) }}" class="theme-link font-medium" data-crud-modal>Edit</a>
            <form action="{{ route('admin.settings.slides.destroy', $s) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Delete this slide?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline bg-transparent border-none cursor-pointer p-0">Delete</button>
            </form>
        </span>
    </li>
    @endforeach
</ul>
@if($slides->isEmpty())
    <p class="theme-text-secondary mt-4">No slides yet. Add one above.</p>
@endif
@endsection
