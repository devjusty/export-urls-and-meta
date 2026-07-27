# AGENTS.md

- WordPress plugin repo. Main runtime file is `export-urls-and-meta.php`; admin JS/CSS live in `assets/js/` and `assets/css/`.
- `readme.txt` is WordPress.org format. `README.md` is human-facing overview.
- `.wp-env.json` pins local WP env to PHP 8.3 and loads this plugin from repo root.
- Composer scripts: `composer test` (PHPUnit), `composer phpcs` / `composer phpcbf` (WPCS via `phpcs.xml.dist`), `composer package` (installable zip via `bin/package-plugin.php` + `.distignore`), `composer lint` (phpcs + test). No npm/package.json, bundler, or asset build step is committed.
- Keep plugin header version, hard-coded asset version strings in `export-urls-and-meta.php`, and `readme.txt` stable tag in sync when releasing.
- Main PHP file is intentionally procedural and large; prefer small local edits there over splitting files unless refactor is clearly needed.
- Preserve existing WordPress security patterns: nonce checks, `manage_options`, `wp_unslash`, sanitization on input, escaping on output.
- Deactivate clears in-progress export residue (files/locks/transients) but keeps `eum_export_settings`; uninstall also deletes settings, last failure, and the uploads storage dir when empty.
- Use `wp-env` for local WP testing if you need a site. CI runs lint + PHPUnit on PRs; release zips use the same `bin/package-plugin.php` script as local `composer package`.
- Avoid committing generated artifacts or dependency directories unless explicitly required.
