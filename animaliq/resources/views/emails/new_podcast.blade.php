@php
    $badgeLabel   = 'New Podcast';
    $introText    = 'A new podcast episode has just been published on the Animal IQ Initiative. Watch it now!';
    $contentType  = 'Podcast';
    $contentTitle = $podcast->title;
    $metaItems    = array_values(array_filter([
        $podcast->description ? null : null,
        'Published: ' . $podcast->created_at->format('M j, Y'),
    ]));
    $excerpt      = $podcast->description ? \Illuminate\Support\Str::limit($podcast->description, 200) : null;
    $ctaUrl       = route('podcasts.index');
    $ctaLabel     = 'Watch Podcast';
@endphp
@include('emails.layout')
