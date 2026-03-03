@extends('layouts.admin')
@section('title', 'Team')
@section('heading', 'Team')
@section('content')
<p class="mb-4"><a href="{{ route('admin.team.create') }}" class="theme-btn inline-block">Add Team Member</a></p>
<ul class="space-y-0">
    @foreach($members as $m)
    <li class="flex justify-between items-center py-3 theme-table-cell border-b">
        <span class="theme-text-primary">{{ $m->name }} — {{ $m->role }}</span>
        <span>
            <a href="{{ route('admin.team.edit', $m) }}" class="theme-link font-medium">Edit</a>
            <form action="{{ route('admin.team.destroy', $m) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Delete this team member?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline bg-transparent border-none cursor-pointer p-0">Delete</button>
            </form>
        </span>
    </li>
    @endforeach
</ul>
{{ $members->links() }}
@if($members->isEmpty())
    <p class="theme-text-secondary mt-4">No team members yet.</p>
@endif
@endsection
