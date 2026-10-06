<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Identity
    |--------------------------------------------------------------------------
    |
    | Everything on the public portfolio is driven from this file so it can be
    | updated without touching templates.
    |
    */

    'name' => env('PORTFOLIO_NAME', 'Durolord'),

    'role' => env('PORTFOLIO_ROLE', 'Full-Stack Laravel Developer'),

    'headline' => 'I forge web applications that feel as good as they work.',

    'summary' => 'Laravel, Livewire and Tailwind specialist building admin panels, HR and operations systems, and custom design systems — from the database schema to the last pixel of polish.',

    'availability' => env('PORTFOLIO_AVAILABILITY', 'Available for new projects'),

    'location' => env('PORTFOLIO_LOCATION', 'Remote · Worldwide'),

    'email' => env('PORTFOLIO_EMAIL', 'hello@durolord.com'),

    'socials' => [
        'GitHub' => env('PORTFOLIO_GITHUB', 'https://github.com/durolord'),
        'LinkedIn' => env('PORTFOLIO_LINKEDIN'),
        'X' => env('PORTFOLIO_X'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Services
    |--------------------------------------------------------------------------
    */

    'services' => [
        [
            'icon' => 'code',
            'title' => 'Custom Web Applications',
            'body' => 'Full-stack Laravel builds with Livewire and Alpine: real-time UIs without the SPA overhead.',
            'points' => ['Laravel 12 & PHP 8.4', 'Livewire 3 + Volt', 'Tested with PHPUnit'],
        ],
        [
            'icon' => 'grid',
            'title' => 'Admin Panels & Dashboards',
            'body' => 'Filament-grade back offices: tables, filters, forms, analytics and role-based access.',
            'points' => ['Searchable data tables', 'Charts & KPIs', 'Policies & permissions'],
        ],
        [
            'icon' => 'shield',
            'title' => 'HR & Operations Systems',
            'body' => 'Employees, departments, leave, attendance and payroll scales modelled cleanly and securely.',
            'points' => ['Fortify auth + 2FA', 'Audit-friendly data', 'Session management'],
        ],
        [
            'icon' => 'palette',
            'title' => 'Design Systems & UI Kits',
            'body' => 'Token-driven component libraries with multiple themes, dark mode and accessible defaults.',
            'points' => ['Tailwind v4 tokens', 'Reusable Blade components', 'Multi-theme support'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Selected Work
    |--------------------------------------------------------------------------
    |
    | "route" may be a named route for an internal demo; "url" for an external
    | link. Leave both empty for projects that cannot be shown publicly.
    |
    */

    'projects' => [
        [
            'title' => 'Duro UI Kit',
            'category' => 'Design System',
            'summary' => 'A Filament-inspired Blade component library with forms, tables, overlays and five complete visual themes.',
            'outcomes' => ['40+ components', '5 swappable themes', 'Livewire-ready APIs'],
            'stack' => ['Blade', 'Alpine.js', 'Tailwind v4'],
            'route' => 'showcase',
            'icon' => 'palette',
        ],
        [
            'title' => 'Duro HRMS',
            'category' => 'Operations Platform',
            'summary' => 'Human-resources core covering departments, job positions, employees, pay scales, leave requests and attendance.',
            'outcomes' => ['Normalised HR schema', 'Leave & attendance flows', 'Secure by default'],
            'stack' => ['Laravel 12', 'Livewire 3', 'Fortify'],
            'route' => null,
            'icon' => 'shield',
        ],
        [
            'title' => 'Service Planner',
            'category' => 'Content Management',
            'summary' => 'Plans weekly services end-to-end: messages, speakers, hymn usage and tagging, with fast filters and pagination.',
            'outcomes' => ['Nested repeaters', 'Tag-driven search', 'Speaker tracking'],
            'stack' => ['Livewire', 'Eloquent', 'SQLite / MySQL'],
            'route' => 'services.index',
            'icon' => 'cube',
        ],
        [
            'title' => 'Realm Analytics',
            'category' => 'Data & Reporting',
            'summary' => 'Dashboards that surface monthly activity, top hymns and unique speakers from operational data.',
            'outcomes' => ['Aggregated KPIs', 'Trend reporting', 'Role-gated access'],
            'stack' => ['Eloquent aggregates', 'Livewire', 'Tailwind'],
            'route' => null,
            'icon' => 'signal',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Stack
    |--------------------------------------------------------------------------
    */

    'stack' => [
        'Laravel', 'PHP 8.4', 'Livewire 3', 'Volt', 'Alpine.js', 'Tailwind CSS v4',
        'Fortify', 'Eloquent', 'MySQL', 'SQLite', 'PHPUnit', 'Vite', 'REST APIs', 'Git',
    ],

    /*
    |--------------------------------------------------------------------------
    | Process
    |--------------------------------------------------------------------------
    */

    'process' => [
        ['title' => 'Discover', 'body' => 'We map goals, users and constraints, then agree on a clear, written scope.'],
        ['title' => 'Design', 'body' => 'Data model, flows and UI direction — validated early with clickable previews.'],
        ['title' => 'Build', 'body' => 'Short iterations with demos you can click, backed by automated tests.'],
        ['title' => 'Launch & Support', 'body' => 'Deployment, handover docs and ongoing improvements when you need them.'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Frequently Asked Questions
    |--------------------------------------------------------------------------
    */

    'faq' => [
        [
            'question' => 'What kind of projects do you take on?',
            'answer' => 'Laravel web applications of all sizes: internal tools, admin panels, HR and operations systems, customer portals and design systems.',
        ],
        [
            'question' => 'Can you work on an existing codebase?',
            'answer' => 'Yes. I regularly join existing Laravel projects to add features, modernise the UI, upgrade versions or untangle legacy code.',
        ],
        [
            'question' => 'How do we get started?',
            'answer' => 'Send a short brief through the contact form. I reply with questions, then a written scope with milestones and an estimate.',
        ],
        [
            'question' => 'Do you offer support after launch?',
            'answer' => 'Absolutely — from a quick handover to an ongoing retainer for maintenance, monitoring and new features.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Contact Form Options
    |--------------------------------------------------------------------------
    */

    'budgets' => [
        'under-2k' => 'Under $2k',
        '2k-5k' => '$2k – $5k',
        '5k-15k' => '$5k – $15k',
        '15k-plus' => '$15k+',
        'unsure' => 'Not sure yet',
    ],

    'project_types' => [
        'web-app' => 'Web application',
        'admin-panel' => 'Admin panel / dashboard',
        'design-system' => 'Design system / UI kit',
        'existing' => 'Work on an existing project',
        'other' => 'Something else',
    ],

];
