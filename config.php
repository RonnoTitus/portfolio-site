<?php
/**
 * Portfolio content. Edit this file only; index.php renders it.
 * Any optional field left empty ('' or []) is simply not shown.
 */
return [
    'name'         => 'Titus Ronno',
    'initials'     => 'TR',
    'role'         => 'Software Developer',
    'stack_line'   => 'PHP · MySQL · Python · Django · React',
    'location'     => 'Uganda · Open to remote',
    'site_url'     => '',   // e.g. https://titusronno.dev (enables canonical + social tags)
    'github_username' => 'RonnoTitus',
    'email'        => 'titusronno113ac@gmail.com',
    'og_image'     => '',   // e.g. 'assets/og-image.png' (1200x630). Needs site_url to be set.
    'resume_url'   => '',   // e.g. 'assets/Titus-Ronno-CV.pdf' (adds a "Download CV" button)
    'availability' => 'Open to software development opportunities',
    'intro'        => 'I build reliable web software that solves real problems.',
    'bio'          => 'I’m a software developer focused on database-backed web applications and clean, usable interfaces. I work mainly with PHP, MySQL, Python and Django, and I enjoy taking an idea from a rough requirement to a working, maintainable product.',
    'focus'        => ['Web applications', 'Database design', 'Admin dashboards', 'Responsive UI'],
    'skill_groups' => [
        'Backend'   => ['PHP', 'Python', 'Django', 'MySQL'],
        'Frontend'  => ['JavaScript', 'React', 'HTML/CSS', 'Bootstrap'],
        'Practices' => ['Git & GitHub', 'CI/CD', 'Responsive design'],
    ],
    'links' => [
        ['label' => 'GitHub',   'url' => 'https://github.com/RonnoTitus'],
        ['label' => 'LinkedIn', 'url' => 'https://www.linkedin.com/in/titus-ronno'],
    ],
    // Add 'repo' => 'https://github.com/...' and/or 'demo' => 'https://...' to show links on a project.
    'projects' => [
        [
            'title' => 'UtilityHub', 'type' => 'Web application', 'year' => '',
            'description' => 'A collection of practical browser-based utilities, built as a PHP/MySQL web project.',
            'role' => 'Design and development',
            'highlights' => ['Server-side PHP with MySQL persistence', 'Multiple small tools behind one consistent interface'],
            'tags' => ['PHP', 'MySQL', 'JavaScript'], 'tone' => 'sage', 'mark' => "UTILITY\nHUB",
            'repo' => '', 'demo' => '',
        ],
        [
            'title' => 'Library Management System', 'type' => 'Academic project', 'year' => '',
            'description' => 'A database-backed library workflow covering authentication, books, members and borrowing transactions.',
            'role' => 'Design and development',
            'highlights' => ['User authentication and role-based access', 'Relational schema for books, members and loans'],
            'tags' => ['PHP', 'MySQL', 'Bootstrap'], 'tone' => 'clay', 'mark' => "LIBRARY\nSYSTEM",
            'repo' => '', 'demo' => '',
        ],
        [
            'title' => 'Plan-Hub', 'type' => 'Team project', 'year' => '',
            'description' => 'A to-do and scheduling application built with Django as part of a team.',
            'role' => 'Admin dashboard developer',
            'highlights' => ['Built the admin dashboard', 'Collaborated through Git branches and pull requests'],
            'tags' => ['Python', 'Django', 'Git'], 'tone' => 'blue', 'mark' => "PLAN\nHUB",
            'repo' => '', 'demo' => '',
        ],
    ],
];
