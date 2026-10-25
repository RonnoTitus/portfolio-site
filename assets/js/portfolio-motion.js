(() => {
  const root = document.documentElement;
  const toggle = document.querySelector('#theme-toggle');
  const key = 'portfolio-theme';

  function apply(dark, save) {
    root.classList.toggle('dark-mode', dark);
    if (toggle) {
      toggle.setAttribute('aria-label', dark ? 'Switch to light mode' : 'Switch to dark mode');
      toggle.innerHTML = (dark ? '☼' : '◐') + ' <span>Theme</span>';
    }
    if (save) { try { localStorage.setItem(key, dark ? 'dark' : 'light'); } catch {} }
  }
  let stored = null;
  try { stored = localStorage.getItem(key); } catch {}
  apply(stored ? stored === 'dark' : matchMedia('(prefers-color-scheme: dark)').matches, false);
  toggle?.addEventListener('click', () => apply(!root.classList.contains('dark-mode'), true));

  const copyBtn = document.getElementById('copy-email');
  copyBtn?.addEventListener('click', async () => {
    try {
      await navigator.clipboard.writeText(copyBtn.dataset.email);
      copyBtn.textContent = 'Copied ✓';
    } catch { copyBtn.textContent = copyBtn.dataset.email; }
    setTimeout(() => { copyBtn.textContent = 'Copy email'; }, 2200);
  });

  const targets = document.querySelectorAll('.section-heading,.project-row,.about-inner,.repo-status,.repo-grid,.contact-inner,.hero-copy,.hero-card');
  targets.forEach(el => el.classList.add('reveal'));
  if ('IntersectionObserver' in window) {
    const io = new IntersectionObserver(entries => entries.forEach(e => {
      if (e.isIntersecting) { e.target.classList.add('is-visible'); io.unobserve(e.target); }
    }), { threshold: .12, rootMargin: '0px 0px -35px 0px' });
    targets.forEach(el => io.observe(el));
  } else targets.forEach(el => el.classList.add('is-visible'));
})();
