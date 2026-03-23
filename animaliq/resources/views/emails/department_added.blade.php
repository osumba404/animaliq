@php
    $recipientName = $user->first_name;
    $badgeLabel    = 'Department Update';
    $introText     = 'You have been added as a member of a department on Animal IQ. You now have access to manage content for this department through the admin panel.';
    $contentType   = 'Department';
    $contentTitle  = $department->name;
    $metaItems     = array_values(array_filter([
        $positionTitle ? 'Position: ' . $positionTitle : null,
        $department->mandate ? 'Mandate: ' . \Illuminate\Support\Str::limit($department->mandate, 80) : null,
    ]));
    $excerpt       = 'Log in to the admin panel to start managing content for this department.';
    $ctaUrl        = route('admin.dashboard');
    $ctaLabel      = 'Go to Admin Panel';
@endphp
@include('emails.layout')
