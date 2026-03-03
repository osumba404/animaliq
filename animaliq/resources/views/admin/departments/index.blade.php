@extends('layouts.admin')

@section('title', 'Departments')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Departments</h1>
    <p><a href="{{ route('admin.departments.create') }}" class="text-blue-600 hover:underline">Add Department</a></p>
    <ul class="mt-4 space-y-2">
        @foreach($departments as $d)
            <li class="flex justify-between items-center py-2 border-b">
                <span>{{ $d->name }}</span>
                <span><a href="{{ route('admin.departments.edit', $d) }}" class="text-blue-600 hover:underline">Edit</a> |
                    <form action="{{ route('admin.departments.destroy', $d) }}" method="POST" class="inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:underline">Delete</button></form></span>
            </li>
        @endforeach
    </ul>
    {{ $departments->links() }}
@endsection
