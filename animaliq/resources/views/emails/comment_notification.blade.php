@php
    $badgeLabel   = 'New Comment';
    $introText    = $commenterName . ' ' . $actionLabel . '.';
    $contentType  = ucfirst($context);
    $contentTitle = $contentTitle;
    $metaItems    = ['Comment: ' . \Illuminate\Support\Str::limit($commentBody, 120)];
    $excerpt      = null;
    $ctaUrl       = $url;
    $ctaLabel     = 'View Comment';
@endphp
@include('emails.layout')
