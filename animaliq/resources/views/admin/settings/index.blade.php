@extends('layouts.admin')
@section('title', 'Site Settings')
@section('heading', 'Site Settings')
@section('content')
<p class="mb-4"><a href="{{ route('admin.settings.create') }}" class="theme-btn inline-block">Add Setting</a></p>
<ul class="space-y-0">
    @foreach($settings as $s)
    <li class="flex justify-between items-center py-3 theme-table-cell border-b">
        <span class="theme-text-primary">{{ $s->setting_key }}</span>
        <span>
            <a href="{{ route('admin.settings.edit', $s) }}" class="theme-link font-medium">Edit</a>
            <form action="{{ route('admin.settings.destroy', $s) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Delete this setting?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline bg-transparent border-none cursor-pointer p-0">Delete</button>
            </form>
        </span>
    </li>
    @endforeach
</ul>
{{ $settings->links() }}
@endsection
