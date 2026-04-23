@php
    $badgeLabel   = 'New Like';
    $introText    = $likerName . ' liked your ' . $context . '.';
    $contentType  = ucfirst($context);
    $contentTitle = $contentTitle;
    $metaItems    = ['Liked by: ' . $likerName];
    $excerpt      = null;
    $ctaUrl       = $url;
    $ctaLabel     = 'View ' . ucfirst($context);
@endphp
@include('emails.layout')
