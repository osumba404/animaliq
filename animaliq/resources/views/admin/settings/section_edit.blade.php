@extends('layouts.admin')
@section('title', 'Edit ' . $title)
@section('heading', $title)
@section('content')
<form action="{{ route('admin.settings.sections.update', $section) }}" method="POST" class="max-w-2xl">
    @csrf
    @method('PUT')
    @foreach($keys as $key => $meta)
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">{{ $meta['label'] }}</label>
            @if(($meta['type'] ?? 'text') === 'text' && in_array($key, ['about_founder_story', 'mission_statement', 'vision_statement', 'homepage_mission_teaser', 'homepage_hero_subtitle']))
                <textarea name="{{ $key }}" rows="4" class="theme-input w-full">{{ old($key, $data[$key] ?? '') }}</textarea>
            @else
                <input type="text" name="{{ $key }}" value="{{ old($key, $data[$key] ?? '') }}" class="theme-input">
            @endif
        </div>
    @endforeach
    <button type="submit" class="theme-btn">Update</button>
    <a href="{{ route('admin.settings.index') }}" class="ml-2 theme-link">Back to Settings</a>
</form>
@endsection
