# Repository Guidelines

## Project Structure & Modules

- `export-urls-and-meta.php`: Main plugin file (admin UI, AJAX, CSV/export logic).
- `assets/css/`, `assets/js/`: Styles and admin scripts for the Tools page (Preview + progress UI).
- Diagnostics page: Tools → Export URLs and Meta: Diagnostics (`tools.php?page=export-urls-and-meta-diagnostics`).
- Docs: `README.md`, `readme.txt` (user docs), `Development-Notes.md`, `Test-Plan.md` (internal/testing).

## Build, Test, and Development

- Local run: place under `wp-content/plugins/`, activate, then use Tools → Export URLs and Meta.
- Preview: configure options, click “Preview” to render the first 10 rows (uses `eum_get_row_data`).
- Diagnostics: open the Diagnostics page to see detected plugin, meta keys/sources, computed homepage, and environment checks.
- Lint: `php -l export-urls-and-meta.php`. Logs: enable `WP_DEBUG`/`WP_DEBUG_LOG` to view `[EUM]` entries.
- Package: `zip -r export-urls-and-meta.zip . -x "*.git*" "*.DS_Store"`.

## Coding Style & Naming

- PHP: 2-space indentation; escape output (`esc_html`, `esc_attr`), sanitize all input; prefix plugin functions `eum_`.
- JavaScript: jQuery module pattern; prefix DOM hooks `eum-`.
- Logging: use `eum_log('message', ['context' => 'value'])`; guard external APIs with `function_exists`/`method_exists`.
- WordPress: validate nonces/capabilities; enqueue assets via `wp_enqueue_*`.

## Testing Guidelines

- SEO plugins: verify mapping via Diagnostics and Preview for Yoast, Rank Math, SEOPress, AIOSEO (v3/v4), and The SEO Framework.
- Homepage: confirm computed values match the active plugin’s settings (templates/options).
- Export: run a small export, validate CSV header order and character counts (if enabled).
- Environment: ensure `wp-content/uploads` is writable; errors surface via AJAX and `[EUM]` logs.

## Commit & Pull Request Guidelines

- Commits: short, imperative (≤72 chars). Examples: `Fix Rank Math home options`, `Add diagnostics page`.
- PRs: include steps to reproduce/test (admin paths + options), screenshots/GIFs for UI, and linked issues.

## SEO Plugins & Fallbacks

- Yoast: posts `_yoast_wpseo_title`/`_yoast_wpseo_metadesc`; terms `wpseo_title`/`wpseo_desc`; templates via `wpseo_replace_vars`.
- Rank Math: `rank_math_title`/`rank_math_description`; homepage from `rank-math-options-titles` (legacy keys supported).
- SEOPress: posts `_seopress_titles_title`/`_seopress_titles_desc`; terms `_seopress_titles_title_term`/`_seopress_titles_desc_term`; homepage via `seopress_titles_option_name`.
- AIOSEO: `_aioseo` array (or JSON), fall back to `_aioseo_title`/`_aioseo_description`, legacy `_aioseop_*`.
- TSF: prefer `the_seo_framework()` APIs; fall back to `_tsf_title`/`_tsf_description`.

## Security & Configuration Tips

- Nonces: validate on all AJAX actions; sanitize every request field.
- File I/O: writes to uploads; `fopen` failures return clear AJAX errors; temporary files/transients are cleaned up on cancel/complete.

## Future Features & Improvements

- Preview enhancements: paging (next/prev), column sorting, highlight missing/overlong meta.
- Diagnostics: test-write button for uploads, sample resolution for first N posts/terms, show filter that sets batch size.
- Export formats: add XLSX/JSON; BOM toggle; streaming output to reduce memory use.
- Filters: author/date/taxonomy filters; include/exclude IDs; custom post types auto-detection and selection.
- Columns: optional fields (ID, author, dates, tags), plugin-specific fields (focus keyword, index status).
- Scheduling: cron-based recurring exports; email or S3 delivery.
- Extensibility: more `do_action`/`apply_filters` hooks to inject sources/columns.
- UI: “Select all” post types; progress ETA; cancel/rollback robustness.
- AIOSEO/TSF/SEOPress: expand homepage and template handling via vendor APIs where available.
