@extends('layouts.admin')
@section('title', 'Edit ' . $title)
@section('heading', $title)
@section('content')
<form action="{{ route('admin.settings.sections.update', $section) }}" method="POST" class="max-w-2xl" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @foreach($keys as $key => $meta)
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">{{ $meta['label'] }}</label>
            @if(($meta['type'] ?? 'text') === 'image')
                @if(!empty($data[$key]))
                    <p class="text-sm theme-text-secondary mb-1">Current: <img src="{{ asset('storage/' . $data[$key]) }}" alt="" class="inline-block h-12 max-w-[140px] object-cover rounded"></p>
                @endif
                <input type="file" name="{{ $key }}" accept="image/*" class="theme-input w-full">
                <span class="text-xs theme-text-secondary">Leave empty to keep current</span>
            @elseif(($meta['type'] ?? 'text') === 'file')
                @if(!empty($data[$key]))
                    <p class="text-sm theme-text-secondary mb-1">Current: <a href="{{ asset('storage/' . $data[$key]) }}" target="_blank" class="theme-link">{{ basename($data[$key]) }}</a></p>
                @endif
                <input type="file" name="{{ $key }}" class="theme-input w-full">
                <span class="text-xs theme-text-secondary">Leave empty to keep current</span>
            @elseif(($meta['type'] ?? 'text') === 'text' && in_array($key, ['about_founder_story', 'mission_statement', 'vision_statement', 'homepage_mission_teaser', 'homepage_hero_subtitle', 'core_values']))
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
