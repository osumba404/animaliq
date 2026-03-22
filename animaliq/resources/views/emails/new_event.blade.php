@php
    $badgeLabel    = 'New Event';
    $introText     = "A new event has been added to Animal IQ. Don't miss out — register your spot today!";
    $contentType   = 'Event';
    $contentTitle  = $event->title;
    $metaItems     = array_values(array_filter([
        $event->start_datetime  ? 'Date: ' . \Carbon\Carbon::parse($event->start_datetime)->format('D, M j Y · g:i A') : null,
        $event->location        ? 'Location: ' . $event->location                                                       : null,
        $event->program?->title ? 'Program: ' . $event->program->title                                                  : null,
        $event->capacity        ? 'Capacity: ' . $event->capacity . ' spots'                                            : null,
    ]));
    $excerpt       = $event->description ? \Illuminate\Support\Str::limit(strip_tags($event->description), 200) : null;
    $ctaUrl        = route('events.show', $event);
    $ctaLabel      = 'View & Register';
@endphp
@include('emails.layout')
