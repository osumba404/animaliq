@php
    $recipientName = $user->first_name;
    $badgeLabel    = 'Welcome';
    $introText     = 'Thank you for joining Animal IQ! Your account is ready. Explore programs, events, research, and connect with a community passionate about wildlife and conservation.';
    $contentType   = 'Your Account';
    $contentTitle  = 'Welcome, ' . $user->first_name . '!';
    $metaItems     = [
        'Name: ' . $user->first_name . ' ' . $user->last_name,
        'Email: ' . $user->email,
        'Role: Member',
    ];
    $excerpt       = 'You can now register for events, follow research projects, read our blog, and be part of the Animal IQ community.';
    $ctaUrl        = route('community.dashboard');
    $ctaLabel      = 'Go to My Dashboard';
@endphp
@include('emails.layout')
