(() => {
  "use strict";

  const storageKey = "portfolio.github.username";
  const status = document.getElementById("repo-status");
  const statusText = document.getElementById("repo-status-text");
  const grid = document.getElementById("repo-grid");
  const refreshButton = document.getElementById("refresh-repos");
  const form = document.getElementById("username-form");
  const input = document.getElementById("github-username");
  const editButton = document.getElementById("edit-username");
  const cancelButton = document.getElementById("cancel-username");
  const languageColors = { JavaScript: "#d4a72c", TypeScript: "#527ac4", PHP: "#777bb4", Python: "#4b8a73", HTML: "#d16b4b", CSS: "#6f8dbd", Rust: "#b45d48", Go: "#61a9a6" };
  let activeController = null;

  const setStatus = (message, state = "idle") => {
    statusText.textContent = message;
    status.dataset.state = state;
  };

  const safeDate = value => {
    const date = new Date(value);
    return Number.isNaN(date.getTime()) ? "" : new Intl.DateTimeFormat(undefined, { month: "short", year: "numeric" }).format(date);
  };

  const makeRepoCard = repo => {
    const card = document.createElement("a");
    card.className = "repo-card";
    card.href = repo.html_url;
    card.target = "_blank";
    card.rel = "noopener noreferrer";
    card.setAttribute("aria-label", `Open GitHub repository ${repo.name}`);

    const top = document.createElement("div");
    top.className = "repo-card-top";
    const owner = document.createElement("span");
    owner.textContent = repo.fork ? "FORKED PROJECT" : "PUBLIC REPOSITORY";
    const external = document.createElement("span");
    external.className = "repo-icon";
    external.setAttribute("aria-hidden", "true");
    external.textContent = "↗";
    top.append(owner, external);

    const title = document.createElement("h3");
    title.textContent = repo.name;
    const description = document.createElement("p");
    description.textContent = repo.description || "A public project, shared from the workbench.";
    const footer = document.createElement("div");
    footer.className = "repo-card-foot";
    if (repo.language) {
      const language = document.createElement("span");
      language.className = "repo-language";
      const dot = document.createElement("i");
      dot.className = "language-dot";
      dot.style.backgroundColor = languageColors[repo.language] || "#8a907c";
      const label = document.createElement("span");
      label.textContent = repo.language;
      language.append(dot, label);
      footer.append(language);
    }
    const stars = document.createElement("span");
    stars.textContent = `☆ ${Number(repo.stargazers_count) || 0}`;
    const updated = document.createElement("span");
    updated.textContent = safeDate(repo.updated_at);
    footer.append(stars, updated);
    card.append(top, title, description, footer);
    return card;
  };

  const renderRepos = repos => {
    grid.replaceChildren();
    if (!repos.length) {
      const empty = document.createElement("p");
      empty.className = "repo-empty";
      empty.textContent = "No public repositories to show just yet.";
      grid.append(empty);
      setStatus("Connected — no public repositories found.", "success");
      return;
    }
    repos.forEach(repo => grid.append(makeRepoCard(repo)));
    setStatus(`Showing ${repos.length} recently updated public ${repos.length === 1 ? "repository" : "repositories"}.`, "success");
  };

  const showSkeletons = () => {
    grid.replaceChildren();
    for (let index = 0; index < 3; index += 1) {
      const skeleton = document.createElement("div");
      skeleton.className = "repo-skeleton";
      skeleton.setAttribute("aria-hidden", "true");
      grid.append(skeleton);
    }
  };

  const loadRepos = async (username, force = false) => {
    const cleanUsername = username.trim().replace(/^@/, "");
    if (!cleanUsername) {
      if (activeController) activeController.abort();
      grid.replaceChildren();
      setStatus("Add a GitHub username to see recent public repositories.", "idle");
      return;
    }
    if (!/^[A-Za-z0-9-]{1,39}$/.test(cleanUsername)) {
      grid.replaceChildren();
      setStatus("That username doesn’t look right. Use letters, numbers, or hyphens.", "error");
      return;
    }
    if (activeController) activeController.abort();
    activeController = new AbortController();
    const controller = activeController;
    refreshButton.classList.add("is-loading");
    refreshButton.disabled = true;
    setStatus(`Looking for ${cleanUsername}’s public repositories…`, "loading");
    showSkeletons();
    try {
      const response = await fetch(`https://api.github.com/users/${encodeURIComponent(cleanUsername)}/repos?sort=updated&direction=desc&per_page=6&type=owner`, {
        headers: { Accept: "application/vnd.github+json" },
        signal: controller.signal,
        cache: force ? "no-store" : "default"
      });
      if (response.status === 404) throw new Error("We couldn’t find that GitHub username. Check it and try again.");
      if (response.status === 403 || response.status === 429) throw new Error("GitHub’s public API is temporarily rate-limited. Try refreshing in a little while.");
      if (!response.ok) throw new Error("GitHub couldn’t load repositories right now. Please try again.");
      const data = await response.json();
      if (!Array.isArray(data)) throw new Error("GitHub returned an unexpected response. Please try again.");
      const repos = data.filter(repo => repo && !repo.private && typeof repo.name === "string" && typeof repo.html_url === "string").slice(0, 6);
      if (controller === activeController) renderRepos(repos);
    } catch (error) {
      if (error.name === "AbortError") return;
      grid.replaceChildren();
      const retry = document.createElement("button");
      retry.type = "button";
      retry.className = "repo-empty";
      retry.textContent = `${error.message} Click to retry.`;
      retry.addEventListener("click", () => loadRepos(cleanUsername, true));
      grid.append(retry);
      setStatus("Repositories couldn’t be loaded.", "error");
    } finally {
      if (controller === activeController) {
        refreshButton.classList.remove("is-loading");
        refreshButton.disabled = false;
      }
    }
  };

  const saved = localStorage.getItem(storageKey) || window.PORTFOLIO_PROFILE?.github || "";
  input.value = saved;
  if (saved) loadRepos(saved);

  editButton.addEventListener("click", () => {
    form.hidden = !form.hidden;
    if (!form.hidden) {
      input.value = localStorage.getItem(storageKey) || "";
      input.focus();
    }
  });
  cancelButton.addEventListener("click", () => { form.hidden = true; });
  form.addEventListener("submit", event => {
    event.preventDefault();
    const username = input.value.trim().replace(/^@/, "");
    if (username && !/^[A-Za-z0-9-]{1,39}$/.test(username)) {
      input.setCustomValidity("Enter a GitHub username using letters, numbers, or hyphens.");
      input.reportValidity();
      return;
    }
    input.setCustomValidity("");
    if (username) localStorage.setItem(storageKey, username);
    else localStorage.removeItem(storageKey);
    form.hidden = true;
    loadRepos(username);
  });
  input.addEventListener("input", () => input.setCustomValidity(""));
  refreshButton.addEventListener("click", () => loadRepos(localStorage.getItem(storageKey) || input.value, true));
})();
