<?php

return [
    /*
    | Admin section keys that can be assigned to departments.
    | Super_admin always has access to everything.
    | Keys 'departments', 'users', 'audit' are super_admin only and not in this list.
    */
    'assignable_sections' => [
        'dashboard' => 'Dashboard',
        'programs' => 'Programs',
        'events' => 'Events',
        'research' => 'Research',
        'campaigns' => 'Campaigns',
        'posts' => 'Posts',
        'settings' => 'Site Settings',
        'team' => 'Team',
        'donations' => 'Donation Campaigns',
        'products' => 'Products',
    ],

    'super_admin_only_sections' => ['departments', 'users', 'audit'],

    /*
    | Map route names (prefix) to section key for permission check.
    */
    'route_to_section' => [
        'admin.dashboard' => 'dashboard',
        'admin.departments' => 'departments',
        'admin.programs' => 'programs',
        'admin.events' => 'events',
        'admin.research' => 'research',
        'admin.campaigns' => 'campaigns',
        'admin.posts' => 'posts',
        'admin.settings' => 'settings',
        'admin.team' => 'team',
        'admin.donations' => 'donations',
        'admin.products' => 'products',
        'admin.users' => 'users',
        'admin.audit' => 'audit',
    ],
];
