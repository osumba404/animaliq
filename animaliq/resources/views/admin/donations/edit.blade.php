@extends('layouts.admin') @section('title', 'Edit Donation Campaign') @section('content')
<h1 class="text-2xl font-bold mb-4">Edit Donation Campaign</h1>
<form action="{{ route('admin.donations.update', $donationCampaign) }}" method="POST" class="max-w-md">@csrf @method('PUT')
<div class="mb-4"><label class="block">Title</label><input type="text" name="title" value="{{ old('title', $donationCampaign->title) }}" class="w-full border rounded px-2 py-1" required></div>
<div class="mb-4"><label class="block">Target amount</label><input type="number" name="target_amount" value="{{ old('target_amount', $donationCampaign->target_amount) }}" class="w-full border rounded px-2 py-1" step="0.01"></div>
<div class="mb-4"><label class="block">Description</label><textarea name="description" class="w-full border rounded px-2 py-1">{{ old('description', $donationCampaign->description) }}</textarea></div>
<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button></form>
@endsection
