# AGENTS.md

- WordPress plugin repo. Main runtime file is `export-urls-and-meta.php`; admin JS/CSS live in `assets/js/` and `assets/css/`.
- `readme.txt` is WordPress.org format. `README.md` is human-facing overview.
- `.wp-env.json` pins local WP env to PHP 8.3 and loads this plugin from repo root.
- `composer.json` only defines `composer test` -> `phpunit`. No npm/package.json, bundler, or build step is committed.
- Keep plugin header version, hard-coded asset version strings in `export-urls-and-meta.php`, and `readme.txt` stable tag in sync when releasing.
- Main PHP file is intentionally procedural and large; prefer small local edits there over splitting files unless refactor is clearly needed.
- Preserve existing WordPress security patterns: nonce checks, `manage_options`, `wp_unslash`, sanitization on input, escaping on output.
- Use `wp-env` for local WP testing if you need a site; run `composer test` when PHPUnit is installed. No repo-local phpcs/phpunit config files are present.
- Avoid committing generated artifacts or dependency directories unless explicitly required.
