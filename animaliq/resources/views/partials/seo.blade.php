@php
    $siteName       = config('app.name', 'Animal IQ');
    $title          = $seoTitle ?? ($title ?? 'Animal IQ');
    $description    = $seoDescription ?? $seo_description ?? null;
    $descriptionText = $description
        ? Str::limit(strip_tags($description), 160)
        : 'Animal IQ – Education, conservation, and community at the heart of wildlife protection. Programs, events, research, and ways to get involved.';
    $canonical      = $seoCanonical ?? $canonical ?? url()->current();
    $image          = $seoImage ?? $seo_image ?? null;
    $imageUrl       = $image
        ? (str_starts_with($image, 'http') ? $image : asset('storage/' . $image))
        : asset('images/og-default.png');
    $type           = $seoType ?? 'website';
    $publishedTime  = $seoPublishedTime ?? null;
    $modifiedTime   = $seoModifiedTime  ?? null;
    $keywords       = $seoKeywords      ?? null;
    $siteLogo       = \App\Models\SiteSetting::getByKey('site_logo');
    $twitterHandle  = \App\Models\SiteSetting::getByKey('twitter_handle', '');
@endphp
@if($siteLogo)
<link rel="icon" href="{{ asset('storage/' . $siteLogo) }}">
<link rel="apple-touch-icon" href="{{ asset('storage/' . $siteLogo) }}">
@endif
<meta name="description" content="{{ $descriptionText }}">
@if($keywords)
<meta name="keywords" content="{{ $keywords }}">
@endif
<link rel="canonical" href="{{ $canonical }}">
<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
<meta name="theme-color" content="#ea6c1a">
{{-- Open Graph --}}
<meta property="og:type" content="{{ $type }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:description" content="{{ Str::limit($descriptionText, 200) }}">
<meta property="og:image" content="{{ $imageUrl }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
@if($twitterHandle)
<meta name="twitter:site" content="{{ $twitterHandle }}">
@endif
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
<script type="application/ld+json">{!! is_string($jsonLd) ? $jsonLd : json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endif
