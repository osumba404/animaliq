@php
    $badgeLabel    = 'New Research';
    $introText     = 'Animal IQ has published a new research project. Dive into the findings and expand your knowledge!';
    $contentType   = 'Research Project';
    $contentTitle  = $research->title;
    $metaItems     = array_values(array_filter([
        $research->department?->name ? 'Department: ' . $research->department->name                                       : null,
        $research->status            ? 'Status: ' . ucfirst($research->status)                                            : null,
        $research->start_date        ? 'Started: ' . \Carbon\Carbon::parse($research->start_date)->format('M j, Y')      : null,
    ]));
    $excerpt       = $research->summary ? \Illuminate\Support\Str::limit(strip_tags($research->summary), 200) : null;
    $ctaUrl        = route('research.show', $research);
    $ctaLabel      = 'Explore Research';
@endphp
@include('emails.layout')
