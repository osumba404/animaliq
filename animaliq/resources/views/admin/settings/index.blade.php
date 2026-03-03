@extends('layouts.admin') @section('title', 'Site Settings') @section('content')
<h1 class="text-2xl font-bold mb-4">Site Settings</h1>
<p><a href="{{ route('admin.settings.slides') }}" class="text-blue-600 hover:underline">Homepage Slides</a></p>
<ul class="mt-4 space-y-2">@foreach($settings as $s)<li class="flex justify-between py-2 border-b"><span>{{ $s->setting_key }}</span><a href="{{ route('admin.settings.edit', $s) }}" class="text-blue-600 hover:underline">Edit</a></li>@endforeach</ul>
{{ $settings->links() }} @endsection
