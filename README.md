# Personal portfolio

A PHP-rendered, responsive portfolio with live public GitHub repositories. Profile copy, links, skills, sample work, and the site's default `github_username` are in `config.php`; replace the example values before sharing the site. Setting `github_username` there makes repositories load automatically for every visitor. The project list is intentionally sample content and should be edited to reflect real work.

The GitHub section’s **Set GitHub username** control saves an optional visitor-specific username in that browser (`localStorage`); the public default is set by the site owner in `config.php`. The page calls GitHub’s unauthenticated public endpoint directly from the browser; no token, OAuth, server-side proxy, or private repository access is used. This requires JavaScript and a browser/network that can reach `api.github.com`.

Serve the directory with a PHP-capable web server and open `index.php`. PHP 8+ is recommended (the template uses `str_starts_with`).
