@extends('layouts.admin')

@section('title', 'Animal Awareness Days Calendar')
@section('heading', 'Awareness Days')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold theme-text-primary">Animal Awareness Days / Environmental Holidays</h1>
        <a href="{{ route('admin.awareness-days.create') }}" class="theme-btn">+ Add Day</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 rounded theme-alert-success">{{ session('success') }}</div>
    @endif

    <div class="theme-card rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b theme-border">
                    <th class="px-4 py-3 text-left theme-text-secondary font-medium">Date</th>
                    <th class="px-4 py-3 text-left theme-text-secondary font-medium">Title</th>
                    <th class="px-4 py-3 text-left theme-text-secondary font-medium">Image</th>
                    <th class="px-4 py-3 text-left theme-text-secondary font-medium">Status</th>
                    <th class="px-4 py-3 text-right theme-text-secondary font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y" style="border-color:var(--border-color)">
                @forelse($days as $day)
                <tr class="hover:bg-[var(--bg-warm)] transition">
                    <td class="px-4 py-3 theme-text-primary font-medium">{{ $day->celebration_date->format('M j, Y') }}</td>
                    <td class="px-4 py-3 theme-text-primary">{{ $day->title }}</td>
                    <td class="px-4 py-3">
                        @if($day->image)
                            <img src="{{ asset('storage/' . $day->image) }}" alt="" class="h-10 w-16 object-cover rounded">
                        @else
                            <span class="theme-text-secondary text-xs">—</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        @if($day->active)
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">Active</span>
                        @else
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">Inactive</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <a href="{{ route('admin.awareness-days.edit', $day) }}" class="theme-link text-xs">Edit</a>
                        <form action="{{ route('admin.awareness-days.destroy', $day) }}" method="POST" class="inline" onsubmit="return confirm('Delete this awareness day?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs text-red-500 hover:text-red-700">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center theme-text-secondary">No awareness days yet. <a href="{{ route('admin.awareness-days.create') }}" class="theme-link">Add one</a></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $days->links() }}</div>
@endsection
