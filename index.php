<?php
$p = require __DIR__ . '/config.php';
$e = static fn ($v): string => htmlspecialchars((string) $v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$email = preg_replace('/^mailto:/', '', $p['email']);
$title = $p['name'] . ' — ' . $p['role'];
$desc = $p['intro'] . ' ' . $p['stack_line'] . '.';
$url = rtrim($p['site_url'], '/');
$sameAs = array_values(array_filter(array_map(static fn ($l) => $l['url'], $p['links'])));
$schema = ['@context' => 'https://schema.org', '@type' => 'Person', 'name' => $p['name'], 'jobTitle' => $p['role'], 'email' => $email, 'sameAs' => $sameAs, 'knowsAbout' => array_merge(...array_values($p['skill_groups']))];
if ($url) $schema['url'] = $url;
$mark = '<span class="wordmark-mark" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128"><rect width="128" height="128" rx="14" fill="#234D40"/><g fill="#F3F0E8"><path d="M23 30H72V39H53V95H43V39H23Z"/><path d="M48 30H73C89 30 98 38 98 51C98 61 92 68 81 71L99 95H85L64 69H69C80 69 87 62 87 52C87 43 81 39 72 39H61V95H48Z"/></g><circle cx="97" cy="22" r="8.5" fill="#D8DF9C"/></svg></span>';
$ogImage = ($url && $p['og_image']) ? $url . '/' . ltrim($p['og_image'], '/') : '';
$ext = static fn (string $u): string => str_starts_with($u, 'http') ? ' target="_blank" rel="noopener noreferrer"' : '';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $e($title) ?></title>
  <meta name="description" content="<?= $e($desc) ?>">
  <meta name="robots" content="index, follow">
  <meta name="theme-color" content="#f1efe7">
<?php if ($url): ?>  <link rel="canonical" href="<?= $e($url) ?>/">
  <meta property="og:url" content="<?= $e($url) ?>/">
<?php endif; ?>
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="<?= $e($p['name']) ?>">
  <meta property="og:title" content="<?= $e($title) ?>">
  <meta property="og:description" content="<?= $e($desc) ?>">
<?php if ($ogImage): ?>  <meta property="og:image" content="<?= $e($ogImage) ?>">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta name="twitter:image" content="<?= $e($ogImage) ?>">
<?php endif; ?>
  <meta name="twitter:card" content="<?= $ogImage ? 'summary_large_image' : 'summary' ?>">
  <meta name="twitter:title" content="<?= $e($title) ?>">
  <meta name="twitter:description" content="<?= $e($desc) ?>">
  <link rel="icon" type="image/svg+xml" href="favicon.svg">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;1,500;1,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/site.css">
  <script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) ?></script>
  <script>window.PORTFOLIO_PROFILE = <?= json_encode(['github' => $p['github_username']], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;try{if(localStorage.getItem('portfolio-theme')==='dark')document.documentElement.classList.add('dark-mode')}catch(e){}</script>
</head>
<body>
  <a class="skip-link" href="#main">Skip to content</a>
  <header class="site-header">
    <a class="wordmark" href="#top" aria-label="<?= $e($p['name']) ?> home"><?= $mark ?><span class="wordmark-name"><?= $e($p['name']) ?></span></a>
    <nav class="main-nav" aria-label="Main navigation">
      <a href="#work">Work</a><a href="#about">About</a><a href="#skills">Skills</a><a href="#github">GitHub</a><a href="#contact">Contact</a>
    </nav>
    <button class="theme-toggle" id="theme-toggle" type="button" aria-label="Switch to dark mode" title="Toggle color theme">◐ <span>Theme</span></button>
    <a class="header-cta" href="mailto:<?= $e($email) ?>">Get in touch <span aria-hidden="true">↗</span></a>
  </header>

  <main id="main">
    <section class="hero page-grid" id="top" aria-labelledby="hero-title">
      <div class="hero-copy">
        <p class="eyebrow"><span class="status-dot"></span><?= $e($p['availability']) ?></p>
        <h1 id="hero-title"><?= $e($p['intro']) ?></h1>
        <p class="hero-lede"><?= $e($p['role']) ?> specialising in <?= $e($p['stack_line']) ?>.</p>
        <div class="hero-actions">
          <a class="btn btn-primary" href="#work">View selected work</a>
          <?php if ($p['resume_url']): ?><a class="btn" href="<?= $e($p['resume_url']) ?>" download>Download CV</a><?php endif; ?>
          <a class="btn" href="mailto:<?= $e($email) ?>">Email me</a>
        </div>
      </div>
      <aside class="hero-card" aria-label="Profile summary">
        <p class="eyebrow">PROFILE</p>
        <dl>
          <div><dt>Role</dt><dd><?= $e($p['role']) ?></dd></div>
          <?php if ($p['location']): ?><div><dt>Location</dt><dd><?= $e($p['location']) ?></dd></div><?php endif; ?>
          <div><dt>Focus</dt><dd><?= $e(implode(' · ', $p['focus'])) ?></dd></div>
          <div><dt>Core stack</dt><dd><?= $e($p['stack_line']) ?></dd></div>
          <div><dt>Contact</dt><dd><a href="mailto:<?= $e($email) ?>"><?= $e($email) ?></a></dd></div>
        </dl>
      </aside>
    </section>

    <section class="work-section section-wrap" id="work" aria-labelledby="work-title">
      <div class="section-heading">
        <div><p class="eyebrow">01 / SELECTED WORK</p><h2 id="work-title">Projects I’ve <em>built.</em></h2></div>
        <p class="heading-note">What each project is, what I did, and the tools behind it.</p>
      </div>
      <div class="project-list">
        <?php foreach ($p['projects'] as $i => $pr): ?>
          <article class="project-row">
            <div class="project-meta"><span><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span><span><?= $e(strtoupper($pr['type'])) ?><?= $pr['year'] ? ' · ' . $e($pr['year']) : '' ?></span></div>
            <div class="project-body">
              <h3><?= $e($pr['title']) ?></h3>
              <p><?= $e($pr['description']) ?></p>
              <p class="project-role"><strong>My role:</strong> <?= $e($pr['role']) ?></p>
              <?php if (!empty($pr['highlights'])): ?><ul class="project-points"><?php foreach ($pr['highlights'] as $h): ?><li><?= $e($h) ?></li><?php endforeach; ?></ul><?php endif; ?>
              <div class="tag-list"><?php foreach ($pr['tags'] as $t): ?><span><?= $e($t) ?></span><?php endforeach; ?></div>
              <?php if ($pr['repo'] || $pr['demo']): ?><div class="project-links"><?php if ($pr['demo']): ?><a href="<?= $e($pr['demo']) ?>"<?= $ext($pr['demo']) ?>>Live demo ↗</a><?php endif; ?><?php if ($pr['repo']): ?><a href="<?= $e($pr['repo']) ?>"<?= $ext($pr['repo']) ?>>Source code ↗</a><?php endif; ?></div><?php endif; ?>
            </div>
            <div class="project-art project-art-<?= $e($pr['tone']) ?>" aria-hidden="true"><span><?= nl2br($e($pr['mark'])) ?></span></div>
          </article>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="about-section" id="about" aria-labelledby="about-title">
      <div class="about-inner section-wrap">
        <div class="about-side"><p class="eyebrow">02 / ABOUT</p><div class="about-stamp"><?= $e($p['initials']) ?></div></div>
        <div class="about-main">
          <h2 id="about-title">Software built to be <em>useful.</em></h2>
          <p class="about-copy"><?= $e($p['bio']) ?></p>
          <div class="skills-block" id="skills">
            <p class="eyebrow">TECHNICAL SKILLS</p>
            <?php foreach ($p['skill_groups'] as $group => $skills): ?>
              <div class="skill-group"><h3><?= $e($group) ?></h3><ul class="skills-list"><?php foreach ($skills as $s): ?><li><?= $e($s) ?></li><?php endforeach; ?></ul></div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>

    <section class="github-section section-wrap" id="github" aria-labelledby="github-title">
      <div class="section-heading github-heading">
        <div><p class="eyebrow">03 / OPEN SOURCE</p><h2 id="github-title">Latest on <em>GitHub.</em></h2></div>
        <div class="repo-tools"><a class="text-button" href="https://github.com/<?= $e($p['github_username']) ?>" target="_blank" rel="noopener noreferrer">View all repositories <span aria-hidden="true">↗</span></a></div>
      </div>
      <div class="repo-status" id="repo-status" role="status" aria-live="polite"><span class="status-mark"></span><span id="repo-status-text">Loading recent repositories…</span></div>
      <div class="repo-grid" id="repo-grid"></div>
      <noscript><p class="noscript-note">Enable JavaScript to see recent repositories, or visit <a href="https://github.com/<?= $e($p['github_username']) ?>">my GitHub profile</a>.</p></noscript>
    </section>

    <section class="contact-section" id="contact" aria-labelledby="contact-title">
      <div class="contact-inner section-wrap">
        <p class="eyebrow">CONTACT</p>
        <h2 id="contact-title">Let’s work <em>together.</em></h2>
        <p class="contact-copy">I’m open to software development roles, internships and freelance projects. I usually reply within a couple of days.</p>
        <div class="contact-actions">
          <a class="contact-link" href="mailto:<?= $e($email) ?>"><?= $e($email) ?><span aria-hidden="true">↗</span></a>
          <button type="button" class="copy-email" id="copy-email" data-email="<?= $e($email) ?>">Copy email</button>
        </div>
        <div class="contact-orbit" aria-hidden="true"></div>
      </div>
    </section>
  </main>

  <footer class="site-footer">
    <a class="wordmark footer-mark" href="#top" aria-label="Back to top"><?= $mark ?></a>
    <p><?= $e($p['name']) ?> · <?= $e($p['role']) ?></p>
    <div class="footer-links"><?php foreach ($p['links'] as $l): ?><a href="<?= $e($l['url']) ?>"<?= $ext($l['url']) ?>><?= $e($l['label']) ?> <span aria-hidden="true">↗</span></a><?php endforeach; ?></div>
    <span class="copyright">© <?= date('Y') ?> <?= $e($p['name']) ?></span>
  </footer>
  <script src="assets/js/github.js" defer></script><script src="assets/js/portfolio-motion.js" defer></script>
</body>
</html>
