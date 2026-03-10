@props(['event'])
@if($event->isPast())
    See what happened
@else
    View event
@endif
