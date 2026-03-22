@php
    $badgeLabel    = 'New Program';
    $introText     = "A brand-new program has just been launched on Animal IQ. Explore what's in store and get involved!";
    $contentType   = 'Program';
    $contentTitle  = $program->title;
    $metaItems     = array_values(array_filter([
        $program->department?->name ? 'Department: ' . $program->department->name : null,
        $program->status            ? 'Status: ' . ucfirst($program->status)       : null,
    ]));
    $excerpt       = $program->description ? \Illuminate\Support\Str::limit(strip_tags($program->description), 200) : null;
    $ctaUrl        = route('programs.show', $program);
    $ctaLabel      = 'View Program';
@endphp
@include('emails.layout')
