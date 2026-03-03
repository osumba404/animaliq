@extends('layouts.public')

@section('title', 'Blog')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Blog</h1>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($posts as $post)
            <a href="{{ route('blog.show', $post) }}" class="block p-4 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] hover:border-[#19140035]">
                <h2 class="font-semibold">{{ $post->title }}</h2>
                <p class="text-sm text-[#706f6c]">By {{ $post->author->first_name }} {{ $post->author->last_name }} · {{ $post->published_at?->format('M j, Y') }}</p>
            </a>
        @empty
            <p class="text-[#706f6c] col-span-full">No posts yet.</p>
        @endforelse
    </div>
    {{ $posts->links() }}
@endsection
