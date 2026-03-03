@extends('layouts.admin') @section('title', 'Homepage Slides') @section('content')
<h1 class="text-2xl font-bold mb-4">Homepage Slides</h1>
<ul class="space-y-2">@foreach($slides as $s)<li>{{ $s->title }} ({{ $s->status }})</li>@endforeach</ul>
@endsection
