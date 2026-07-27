# Export URLs and Meta Test Plan

## Automated

- Run `composer phpcs`.
- Run `composer test`.
- Run `php -l export-urls-and-meta.php`.
- Run `php -l includes/export/class-batch-export.php`.
- Run `php -l includes/export/class-export-manifest.php`.
- Run `php -l includes/class-plugin-lifecycle.php`.
- Run `node --check assets/js/export-urls-and-meta.js`.
- Run `git diff --check`.

## Batch Export

- Verify invalid AJAX nonce returns JSON error without HTML output.
- Verify users without `manage_options` cannot start, process, download, or cancel exports.
- Verify export session cannot be accessed by another user.
- Verify manifest contains posts, categories, product categories, and homepage in requested order.
- Verify batches advance by manifest byte offset.
- Delete or modify content after manifest creation and verify later batches do not duplicate or skip records.
- Verify deleted records advance cursor without fatal errors.
- Verify concurrent batch requests receive a lock response instead of writing duplicate rows.
- Verify incomplete exports cannot be downloaded.
- Verify successful download removes CSV, manifest, and transient.
- Verify cancellation removes CSV, manifest, and transient.
- Verify expired CSV and manifest files without matching transient are removed during next export start.
- Verify unrelated temp files are never removed.

## Lifecycle

- Deactivate the plugin and confirm `eum_export_settings` is preserved while leftover export CSV/manifest files and locks are removed.
- Uninstall the plugin and confirm settings, last failure option, export locks/transients, and `uploads/export-urls-and-meta` residue are removed.
- After a forced batch failure, confirm Diagnostics shows the failure timestamp and message.

## Diagnostics

- Verify diagnostics submenu appears under Tools for administrators.
- Verify non-administrators cannot view diagnostics data.
- Verify diagnostics output escapes plugin names, paths, and metadata values.
- Verify diagnostics reports no-plugin and multiple-plugin states distinctly.
- Verify AIOSEO homepage custom values take precedence over global values.
- Verify Export Storage shows the storage path, writable status, and leftover file count.
- Verify Clear leftover export files removes residue and shows a success notice.
- Verify Last Batch Failure shows None when no failure has been recorded.
