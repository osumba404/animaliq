@extends('layouts.admin')

@section('title', 'Team')
@section('heading', 'Team')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold theme-text-primary">Team</h1>
        <a href="{{ route('admin.team.create-form') }}" class="theme-btn" data-crud-modal>Add Team Member</a>
    </div>

    @if($members->isEmpty())
        <div class="theme-card rounded-lg p-8 text-center">
            <p class="theme-text-secondary mb-4">No team members yet.</p>
            <a href="{{ route('admin.team.create-form') }}" class="theme-btn" data-crud-modal>Add your first member</a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($members as $m)
                <article class="theme-card rounded-lg p-4 transition hover:shadow-lg">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div class="min-w-0 flex-1 flex flex-wrap items-start gap-4">
                            @if($m->image)
                                <img src="{{ asset('storage/' . $m->image) }}" alt="" class="w-14 h-14 object-cover rounded-full shrink-0">
                            @else
                                <div class="w-14 h-14 rounded-full theme-bg-secondary flex items-center justify-center text-lg font-semibold theme-text-primary shrink-0">{{ strtoupper(mb_substr($m->name ?? '?', 0, 1)) }}</div>
                            @endif
                            <div class="min-w-0 flex-1">
                                <h2 class="font-semibold theme-text-primary text-lg">{{ $m->name }}</h2>
                                <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-2 text-sm theme-text-secondary">
                                    <span><span class="font-medium">Role:</span> {{ $m->role ?? '—' }}</span>
                                    <span><span class="font-medium">Order:</span> {{ $m->display_order ?? 0 }}</span>
                                </div>
                                @if($m->remarks)
                                    <p class="text-sm theme-text-secondary mt-2 line-clamp-2">{{ Str::limit($m->remarks, 140) }}</p>
                                @elseif($m->role_description)
                                    <p class="text-sm theme-text-secondary mt-2 line-clamp-2">{{ Str::limit($m->role_description, 140) }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 shrink-0">
                            <a href="{{ route('admin.team.edit-form', $m) }}" class="theme-link font-medium" data-crud-modal>Edit</a>
                            <form action="{{ route('admin.team.destroy', $m) }}" method="POST" class="inline" onsubmit="return confirm('Delete this team member?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        {{ $members->links() }}
    @endif
@endsection
