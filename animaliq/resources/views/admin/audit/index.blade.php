@extends('layouts.admin')

@section('title', 'Audit Log')
@section('heading', 'Audit Log')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold theme-text-primary">Audit Log</h1>
        <p class="text-sm theme-text-secondary mt-1">Recent system activity. Newest first.</p>
    </div>

    @if($logs->isEmpty())
        <div class="theme-card rounded-lg p-8 text-center">
            <p class="theme-text-secondary">No audit entries yet.</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($logs as $log)
                <article class="theme-card rounded-lg p-4 transition hover:shadow-lg">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div class="min-w-0 flex-1">
                            <p class="theme-text-primary font-medium">{{ $log->action }}</p>
                            <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-2 text-sm theme-text-secondary">
                                <span><span class="font-medium">When:</span> {{ $log->created_at?->format('M j, Y H:i') ?? '—' }}</span>
                                <span><span class="font-medium">User:</span> {{ $log->user?->email ?? '—' }}</span>
                                <span><span class="font-medium">Table:</span> {{ $log->table_name ?? '—' }}</span>
                                @if($log->record_id)
                                    <span><span class="font-medium">Record ID:</span> {{ $log->record_id }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        {{ $logs->links() }}
    @endif
@endsection
