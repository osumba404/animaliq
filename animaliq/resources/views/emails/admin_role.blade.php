@php
    $recipientName = $user->first_name;
    $isSuperAdmin  = $user->role === 'super_admin';
    $badgeLabel    = $isSuperAdmin ? 'Super Admin Access' : 'Admin Access';
    $introText     = $isSuperAdmin
        ? 'You have been granted Super Admin access on Animal IQ. You now have full control over the admin panel including departments, users, and the audit log.'
        : 'You have been granted Admin access on Animal IQ. You can now log in to the admin panel and manage content for your assigned department(s).';
    $contentType   = 'Access Update';
    $contentTitle  = $isSuperAdmin ? 'You are now a Super Admin' : 'You are now an Admin';
    $metaItems     = [
        'Account: ' . $user->email,
        'Role: ' . ($isSuperAdmin ? 'Super Admin' : 'Admin'),
    ];
    $excerpt       = 'Log in and visit the admin panel to get started. If you have any questions, contact the team.';
    $ctaUrl        = route('admin.dashboard');
    $ctaLabel      = 'Go to Admin Panel';
@endphp
@include('emails.layout')
