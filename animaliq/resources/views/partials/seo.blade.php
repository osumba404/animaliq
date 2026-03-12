@php
    $siteName = config('app.name', 'Animal IQ');
    $title = $seoTitle ?? ($title ?? 'Animal IQ');
    $description = $seoDescription ?? $seo_description ?? null;
    $descriptionText = $description ? Str::limit(strip_tags($description), 160) : 'Animal IQ – Education, conservation, and community at the heart of wildlife protection. Programs, events, research, and ways to get involved.';
    $canonical = $seoCanonical ?? $canonical ?? url()->current();
    $image = $seoImage ?? $seo_image ?? null;
    $imageUrl = $image ? (str_starts_with($image, 'http') ? $image : asset('storage/' . $image)) : asset('images/og-default.png');
    $type = $seoType ?? 'website';
    $publishedTime = $seoPublishedTime ?? null;
    $modifiedTime = $seoModifiedTime ?? null;
@endphp
<meta name="description" content="{{ $descriptionText }}">
<link rel="canonical" href="{{ $canonical }}">
<meta name="robots" content="index, follow">
<meta property="og:type" content="{{ $type }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:description" content="{{ Str::limit($descriptionText, 200) }}">
<meta property="og:image" content="{{ $imageUrl }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ Str::limit($descriptionText, 200) }}">
<meta name="twitter:image" content="{{ $imageUrl }}">
@if($publishedTime)
<meta property="article:published_time" content="{{ $publishedTime }}">
@endif
@if($modifiedTime)
<meta property="article:modified_time" content="{{ $modifiedTime }}">
@endif
@if(!empty($jsonLd))
<script type="application/ld+json">{!! is_string($jsonLd) ? $jsonLd : json_encode($jsonLd) !!}</script>
@endif
