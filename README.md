# Titus Ronno — Developer Portfolio

A fast, responsive portfolio site. It showcases selected projects, technical skills and live public GitHub repositories, and is built with plain PHP, CSS and JavaScript, with no build step or framework.

## Features

- **Single-file content:** all text, projects, skills and links live in `config.php`
- **Live GitHub repositories:** the latest public repos load automatically from GitHub's public API
- **Light and dark themes:** follows the system setting, with a manual toggle that is remembered
- **Responsive and accessible:** mobile-first layout, skip link, keyboard focus styles, reduced-motion support
- **SEO-ready:** meta description, Open Graph and Twitter tags, canonical URL and Person structured data
- **Print-friendly:** prints cleanly as a one-page summary

## Tech stack

PHP 8+ · HTML5 · CSS3 (custom properties) · Vanilla JavaScript

## Project structure

```
├── index.php              # Page template
├── config.php             # All editable content
├── assets/
│   ├── css/site.css       # Styles and themes
│   └── js/
│       ├── github.js          # Fetches and renders repositories
│       └── portfolio-motion.js # Theme toggle, scroll reveals, copy-email
├── favicon.svg
└── robots.txt
```


