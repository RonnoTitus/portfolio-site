<?php
$profile = require __DIR__ . '/config.php';
$escape = static fn ($value): string => htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$description = $profile['intro'] . ' ' . $profile['bio'];
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $escape($profile['name']) ?> - <?= $escape($profile['role']) ?></title>
  <meta name="description" content="<?= $escape($description) ?>">
  <meta name="robots" content="index, follow">
  <meta name="theme-color" content="#f1efe7">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?= $escape($profile['name']) ?> — <?= $escape($profile['role']) ?>">
  <meta property="og:description" content="<?= $escape($profile['intro']) ?>">
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="<?= $escape($profile['name']) ?> — <?= $escape($profile['role']) ?>">
  <meta name="twitter:description" content="<?= $escape($profile['intro']) ?>">
  <link rel="icon" type="image/svg+xml" href="favicon.svg">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;1,500;1,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/site.css">
  <script>window.PORTFOLIO_PROFILE = <?= json_encode(['name' => $profile['name'], 'github' => $profile['github_username']], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;</script>
</head>
<body>
  <a class="skip-link" href="#main">Skip to content</a>
  <header class="site-header">
    
<a class="wordmark" href="#top"
   aria-label="<?= $escape($profile['name']) ?> home">

  
<span class="wordmark-mark" aria-hidden="true">
  <svg xmlns="http://www.w3.org/2000/svg"
       viewBox="0 0 128 128">

    <!-- Background -->
    <rect width="128" height="128" rx="14"
          fill="#234D40"/>

    <!-- TR Monogram -->
    <g fill="#F3F0E8">
      <!-- T -->
      <path d="M23 30 H72 V39 H53 V95 H43 V39 H23 Z"/>

      <!-- R -->
      <path d="M48 30 H73
               C89 30 98 38 98 51
               C98 61 92 68 81 71
               L99 95 H85
               L64 69 H69
               C80 69 87 62 87 52
               C87 43 81 39 72 39
               H61 V95 H48 Z"/>
    </g>

    <!-- Accent dot -->
    <circle cx="97" cy="22" r="8.5"
            fill="#D8DF9C"/>
  </svg>
</span>


  <span class="wordmark-name">
    <?= $escape($profile['name']) ?>
  </span>
</a>

    <nav class="main-nav" aria-label="Main navigation">
      <a href="#work">Selected work</a><a href="#about">About</a><a href="#github">GitHub</a>
    </nav>
    <button class="theme-toggle" id="theme-toggle" type="button" aria-label="Switch to dark mode" title="Toggle color theme">◐ <span>Theme</span></button><a class="header-cta" href="mailto:<?= $escape(str_replace('mailto:', '', $profile['email'])) ?>">Let’s talk <span aria-hidden="true">↗</span></a>
  </header>

  <main id="main">
    <section class="hero page-grid" id="top" aria-labelledby="hero-title">
      <div class="hero-copy">
        <p class="eyebrow"><span class="status-dot"></span><?= $escape($profile['availability']) ?></p>
        <h1 id="hero-title"><?= $escape($profile['intro']) ?></h1>
        <div class="hero-bottom">
          <p class="hero-role"><?= $escape($profile['role']) ?><br><span><?= $escape($profile['location']) ?></span></p>
          <a class="round-link" href="#work" aria-label="Explore selected work"><span>↓</span></a>
        </div>
      </div>
      <div class="hero-art" aria-label="Abstract sculptural illustration" role="img">
        <div class="art-caption">FIELD NOTES / 001</div>
        <div class="orbit orbit-one"></div><div class="orbit orbit-two"></div>
        <div class="art-disc"></div><div class="art-ribbon"></div><div class="art-sun"></div>
        <span class="art-label art-label-top">MAKE SPACE<br>FOR GOOD IDEAS</span>
        <span class="art-label art-label-bottom">FORM FOLLOWS<br>FEELING — ALWAYS</span>
        <span class="art-coordinate">UGANDA<br>EAST AFRICA</span>
      </div>
      <div class="hero-footnote"><span>INDEPENDENT PRACTICE</span><span>SOFTWARE DEVELOPMENT</span><span>SCROLL TO EXPLORE&nbsp; ↓</span></div>
    </section>

    <section class="work-section section-wrap" id="work" aria-labelledby="work-title">
      <div class="section-heading">
        <div><p class="eyebrow">01 / A FEW THINGS I’VE MADE</p><h2 id="work-title">Selected <em>work.</em></h2></div>
        <p class="heading-note">A small collection of ideas made tangible.<br>Selected projects and contributions.</p>
      </div>
      <div class="project-list">
        <?php foreach ($profile['projects'] as $project): ?>
          <article class="project-row">
            <div class="project-meta"><span><?= $escape($project['number']) ?></span><span><?= $escape($project['type']) ?></span></div>
            <div class="project-body"><h3><?= $escape($project['title']) ?></h3><p><?= $escape($project['description']) ?></p><div class="tag-list"><?php foreach ($project['tags'] as $tag): ?><span><?= $escape($tag) ?></span><?php endforeach; ?></div></div>
            <div class="project-art project-art-<?= $escape($project['tone']) ?>" aria-hidden="true"><span><?= nl2br($escape($project['mark'])) ?></span><i></i></div>
            <span class="project-arrow" aria-hidden="true">↗</span>
          </article>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="about-section" id="about" aria-labelledby="about-title">
      <div class="about-inner section-wrap">
        <div class="about-side"><p class="eyebrow">02 / A LITTLE CONTEXT</p><div class="about-stamp"><?= $escape($profile['initials']) ?><span>SOFTWARE<br>BUILT TO BE USEFUL</span></div></div>
        <div class="about-main"><h2 id="about-title">Good work starts<br>with <em>good questions.</em></h2><p class="about-copy"><?= $escape($profile['bio']) ?></p><div class="skills-block"><p class="eyebrow">THINGS I CAN HELP WITH</p><ul class="skills-list"><?php foreach ($profile['skills'] as $skill): ?><li><?= $escape($skill) ?></li><?php endforeach; ?></ul></div></div>
      </div>
      <div class="about-ribbon" aria-hidden="true">THOUGHTFUL BY NATURE&nbsp; · &nbsp;CURIOUS BY DEFAULT&nbsp; · &nbsp;THOUGHTFUL BY NATURE&nbsp; · &nbsp;CURIOUS BY DEFAULT&nbsp; · &nbsp;</div>
    </section>

    <section class="github-section section-wrap" id="github" aria-labelledby="github-title">
      <div class="section-heading github-heading">
        <div><p class="eyebrow">03 / OPEN SOURCE & SIDE QUESTS</p><h2 id="github-title">From the <em>workbench.</em></h2></div>
        <div class="repo-tools"><button type="button" class="text-button" id="edit-username">Set GitHub username <span aria-hidden="true">↗</span></button><button type="button" class="refresh-button" id="refresh-repos" aria-label="Refresh repositories"><span aria-hidden="true">↻</span> Refresh</button></div>
      </div>
      <form class="username-form" id="username-form" hidden>
        <label for="github-username">GitHub username</label><div class="username-controls"><span class="username-prefix">github.com/</span><input id="github-username" name="username" type="text" autocomplete="off" maxlength="39" pattern="[A-Za-z0-9-]+" placeholder="your-username" aria-describedby="username-help"><button type="submit" class="button-dark">Save username</button><button type="button" class="cancel-button" id="cancel-username">Cancel</button></div><p id="username-help">Your username is saved only in this browser. No token or sign-in required.</p>
      </form>
      <div class="repo-status" id="repo-status" role="status" aria-live="polite"><span class="status-mark"></span><span id="repo-status-text">Add a GitHub username to see recent public repositories.</span></div>
      <div class="repo-grid" id="repo-grid"></div>
      <noscript><p class="noscript-note">Enable JavaScript to load public repositories from GitHub.</p></noscript>
      <p class="github-footnote">PUBLIC REPOSITORIES · FETCHED DIRECTLY FROM THE GITHUB API</p>
    </section>

    <section class="contact-section" id="contact">
      <div class="contact-inner section-wrap"><p class="eyebrow">HAVE A GOOD ONE IN MIND?</p><h2>Let’s make<br><em>something matter.</em></h2><a class="contact-link" href="mailto:<?= $escape(str_replace('mailto:', '', $profile['email'])) ?>"><?= $escape($profile['email']) ?><span aria-hidden="true">↗</span></a><div class="contact-orbit" aria-hidden="true"></div></div>
    </section>
  </main>

  <footer class="site-footer"><a class="wordmark footer-mark" href="#top"><span class="wordmark-mark" aria-hidden="true">
  <svg xmlns="http://www.w3.org/2000/svg"
       viewBox="0 0 128 128">

    <!-- Background -->
    <rect width="128" height="128" rx="14"
          fill="#234D40"/>

    <!-- TR Monogram -->
    <g fill="#F3F0E8">
      <!-- T -->
      <path d="M23 30 H72 V39 H53 V95 H43 V39 H23 Z"/>

      <!-- R -->
      <path d="M48 30 H73
               C89 30 98 38 98 51
               C98 61 92 68 81 71
               L99 95 H85
               L64 69 H69
               C80 69 87 62 87 52
               C87 43 81 39 72 39
               H61 V95 H48 Z"/>
    </g>

    <!-- Accent dot -->
    <circle cx="97" cy="22" r="8.5"
            fill="#D8DF9C"/>
  </svg>
</span>
<!-- <span><?= $escape($profile['name']) ?></span>--></a><p>Software Developer</p><div class="footer-links"><?php foreach ($profile['links'] as $link): ?><a href="<?= $escape($link['url']) ?>"<?= str_starts_with($link['url'], 'http') ? ' target="_blank" rel="noopener noreferrer"' : '' ?>><?= $escape($link['label']) ?> <span aria-hidden="true">↗</span></a><?php endforeach; ?></div><span class="copyright">© <?= date('Y') ?> · MADE WITH CARE</span></footer> 
  <script src="assets/js/github.js" defer></script><script src="assets/js/portfolio-motion.js" defer></script>
</body>
</html>
