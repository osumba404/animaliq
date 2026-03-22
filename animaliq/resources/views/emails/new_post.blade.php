@php
    $badgeLabel    = 'New Blog Post';
    $introText     = 'A new article has just been published on the Animal IQ blog. Read it and stay informed!';
    $contentType   = 'Blog Post';
    $contentTitle  = $post->title;
    $metaItems     = array_values(array_filter([
        $post->author       ? 'By ' . $post->author->first_name . ' ' . $post->author->last_name          : null,
        $post->published_at ? 'Published: ' . \Carbon\Carbon::parse($post->published_at)->format('M j, Y') : null,
        $post->campaign?->title ? 'Campaign: ' . $post->campaign->title                                   : null,
    ]));
    $excerpt       = $post->content ? \Illuminate\Support\Str::limit(strip_tags($post->content), 200) : null;
    $ctaUrl        = route('blog.show', $post);
    $ctaLabel      = 'Read Article';
@endphp
@include('emails.layout')
