@php
    $badgeLabel   = 'New Forum Discussion';
    $introText    = $posterName . ' has started a new discussion in the Animal IQ community forum.';
    $contentType  = 'Forum Post';
    $contentTitle = $post->title;
    $metaItems    = [
        'Posted by: ' . $posterName,
        'Posted: ' . $post->created_at->format('M j, Y'),
    ];
    $excerpt      = \Illuminate\Support\Str::limit(strip_tags($post->body), 200);
    $ctaUrl       = route('forum.show', $post);
    $ctaLabel     = 'Join the Discussion';
@endphp
@include('emails.layout')
