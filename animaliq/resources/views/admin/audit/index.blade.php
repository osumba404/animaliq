@extends('layouts.admin')
@section('title', 'Audit Log')
@section('heading', 'Audit Log')
@section('content')
<h1 class="text-2xl font-bold mb-4">Audit Log</h1>
<ul class="space-y-2">@foreach($logs as $log)<li class="py-2 border-b text-sm">{{ $log->created_at?->format('Y-m-d H:i') }} – {{ $log->user?->email }} – {{ $log->action }} ({{ $log->table_name }})</li>@endforeach</ul>
{{ $logs->links() }} @endsection
