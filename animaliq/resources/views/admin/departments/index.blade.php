@extends('layouts.admin')

@section('title', 'Departments')
@section('heading', 'Departments')

@section('content')
    <h1 class="text-2xl font-bold mb-4 theme-text-primary">Departments</h1>
    <p class="mb-4"><a href="{{ route('admin.departments.create-form') }}" class="theme-btn inline-block" data-crud-modal>Add Department</a></p>

    <ul class="space-y-4">
        @foreach($departments as $d)
            <li class="theme-card rounded-lg p-4">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div class="min-w-0 flex-1">
                        <h2 class="font-semibold theme-text-primary text-lg">{{ $d->name }}</h2>
                        @if(auth()->user()->isSuperAdmin())
                            <p class="text-sm theme-text-secondary mt-1"><span class="font-medium">Slug:</span> {{ $d->slug ?? '—' }}</p>
                            @if($d->mandate)
                                <p class="text-sm theme-text-secondary mt-1 line-clamp-2"><span class="font-medium">Mandate:</span> {{ Str::limit($d->mandate, 120) }}</p>
                            @endif
                            <p class="text-sm theme-text-secondary mt-2"><span class="font-medium">Members:</span> {{ $d->department_members_count ?? $d->departmentMembers->count() }}</p>
                            @if(!empty($d->admin_sections))
                                <p class="text-sm theme-text-secondary mt-1"><span class="font-medium">Allowed in admin:</span>
                                    @php $labels = config('admin_sections.assignable_sections', []); @endphp
                                    @foreach($d->admin_sections as $key)
                                        <span class="inline-block theme-badge mr-1 mt-1">{{ $labels[$key] ?? $key }}</span>
                                    @endforeach
                                </p>
                            @else
                                <p class="text-sm theme-text-secondary mt-1"><span class="font-medium">Allowed in admin:</span> <em>none selected</em></p>
                            @endif
                        @endif
                    </div>
                    <div class="flex flex-wrap items-center gap-2 shrink-0">
                        <a href="{{ route('admin.departments.edit-form', $d) }}" class="theme-link font-medium" data-crud-modal>Edit</a>
                        @if(auth()->user()->isSuperAdmin())
                            <a href="{{ route('admin.departments.edit', $d) }}" class="theme-link font-medium">Manage members</a>
                        @endif
                        <form action="{{ route('admin.departments.destroy', $d) }}" method="POST" class="inline" onsubmit="return confirm('Delete this department?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{ $departments->links() }}
@endsection
