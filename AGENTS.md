# Cioccolato Website Project Instructions

Read `README.md` before changing site structure, the advertising form, consent, analytics, metadata, policies, or deployment behavior.

## Existing work

- Treat every existing modification as user or prior-agent work unless provenance is certain.
- Inspect `git status` and the relevant diff before editing. Never discard, rewrite, reformat, or revert unrelated changes.
- When resuming interrupted work, identify completed, partial, and unverified work and continue instead of restarting.
- Do not change branches, commit, merge, push, publish, deploy, or alter production services unless the user explicitly requests it.
- Never add AI, Claude, or Codex co-author trailers to commits or public attribution.

## Manager policy

- The primary agent is the manager. Delegate only bounded independent work or noisy read-heavy investigation, starting with the cheapest adequate profile.
- Keep at most three subagents active. Parallelize only lightweight read-only work; serialize edits, local servers, link checks, browser automation, and media processing.
- Never assign overlapping write scopes. Wait for implementation to finish before verification.
- Require concise evidence-backed results with exact file references, residual risks, and the next action. Specialized subagents must not spawn descendants unless explicitly requested.

## Project routing

- Use `scout` for targeted page, asset, form, consent, and prior-work discovery.
- Use `reviewer` for correctness, security, privacy, SEO, accessibility, link, policy, and regression analysis.
- Use `web_auditor` for the PHP email form, input and header handling, abuse resistance, consent, analytics, external links, security headers, and hosting exposure.
- Use `worker` for one bounded implementation after the behavior is understood.
- Use `verifier` for focused validation after edits are complete.
- For complex changes, prefer `scout` or `reviewer`, then one `worker`, then `verifier`; do not overlap write and verification phases.

## Public-site safeguards

- Treat advertising-form names, email addresses, messages, consent state, analytics identifiers, and operational email details as sensitive or privacy-relevant.
- Do not send real email or load analytics, Gumroad, affiliate, or other external tracking during development or verification.
- Validate and bound form input server-side. Browser validation and `strip_tags` alone are not security boundaries; protect email headers and add abuse controls when the task crosses that flow.
- Keep privacy and cookie policies aligned with actual consent and analytics behavior.
- When adding or renaming pages, update navigation, footer, canonical URLs, social metadata, internal links, and `sitemap.xml` consistently.
- Preserve explicit commercial disclosure and safe link attributes for affiliate or third-party destinations.

## Verification and resource safety

- Prefer targeted PHP syntax, HTML, JavaScript, link, metadata, consent, and sitemap checks before local servers or browser automation.
- This machine has 8 GB of RAM. Serialize browser automation, local servers, media processing, and other memory-intensive work.
- Prefer targeted `rg -I` searches. If `git grep` is necessary, use `--threads=1 -I` and exclude images, media, generated files, and other binary assets.
- If a command times out or exits abnormally, inspect and terminate only the exact orphaned process before continuing.
