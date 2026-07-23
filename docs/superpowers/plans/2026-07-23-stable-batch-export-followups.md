# Stable Batch Export Follow-ups Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Make batch exports deterministic during content changes and make temporary-file cleanup safe for simultaneous export sessions.

**Architecture:** Replace mutable offset pagination with a disk-backed manifest containing one export record per line. Batch processing advances by manifest byte offset, so post or term changes cannot reorder, duplicate, or skip records. Replace shared `eum_export_files` option registry with export-ID-derived filenames and transient validation during cleanup, eliminating concurrent option update races.

**Tech Stack:** PHP 7+, WordPress APIs, PHPUnit 9, wp-env, jQuery AJAX.

---

### Task 1: Add Manifest Primitives

**Files:**
- Create: `includes/export/class-export-manifest.php`
- Modify: `export-urls-and-meta.php`
- Test: `tests/ExportManifestTest.php`

- [ ] **Step 1: Write failing manifest tests**

Add tests for these pure behaviors:

```php
public function test_manifest_record_is_encoded_as_one_json_line(): void {
    $line = eum_encode_export_manifest_record( array( 'type' => 'post', 'id' => 42 ) );

    $this->assertSame( "{\"type\":\"post\",\"id\":42}\n", $line );
}

public function test_manifest_line_is_decoded_and_rejects_invalid_records(): void {
    $this->assertSame(
        array( 'type' => 'term', 'taxonomy' => 'category', 'id' => 9 ),
        eum_decode_export_manifest_record( "{\"type\":\"term\",\"taxonomy\":\"category\",\"id\":9}\n" )
    );
    $this->assertNull( eum_decode_export_manifest_record( "not-json\n" ) );
    $this->assertNull( eum_decode_export_manifest_record( "{\"type\":\"post\"}\n" ) );
}

public function test_manifest_filename_is_bound_to_export_id(): void {
    $paths = eum_get_export_manifest_paths( 'eum_export_abc123' );

    $this->assertStringEndsWith( 'eum_export_abc123.manifest', $paths['manifest'] );
    $this->assertStringEndsWith( 'eum_export_abc123.csv', $paths['csv'] );
}
```

- [ ] **Step 2: Run the focused test and verify RED**

Run:

```bash
composer test -- --filter ExportManifestTest
```

Expected: failure because manifest helper functions do not exist.

- [ ] **Step 3: Implement manifest helpers**

Implement in `includes/export/class-export-manifest.php`:

```php
function eum_encode_export_manifest_record( $record ) {
    return wp_json_encode( $record ) . "\n";
}

function eum_decode_export_manifest_record( $line ) {
    $record = json_decode( trim( $line ), true );
    if ( ! is_array( $record ) || empty( $record['type'] ) || empty( $record['id'] ) ) {
        return null;
    }
    if ( 'term' === $record['type'] && empty( $record['taxonomy'] ) ) {
        return null;
    }
    return $record;
}

function eum_get_export_manifest_paths( $export_id ) {
    $base = trailingslashit( get_temp_dir() ) . sanitize_file_name( $export_id );
    return array(
        'manifest' => $base . '.manifest',
        'csv'      => $base . '.csv',
    );
}
```

Use `ABSPATH` guard for runtime loading and `PHPUNIT_COMPOSER_INSTALL` guard for unit tests, matching existing helper files.

- [ ] **Step 4: Include the module and run GREEN**

Require the new file before `class-batch-export.php` in `export-urls-and-meta.php`, then run:

```bash
composer test -- --filter ExportManifestTest
```

Expected: all focused manifest tests pass.

### Task 2: Build Deterministic Export Manifests

**Files:**
- Modify: `includes/export/class-batch-export.php`
- Modify: `includes/export/class-export-manifest.php`
- Test: `tests/ExportManifestTest.php`

- [ ] **Step 1: Add failing tests for bounded manifest creation**

Test manifest writing with a temporary stream:

```php
public function test_manifest_writer_tracks_record_count_and_byte_offset(): void {
    $handle = fopen( 'php://temp', 'w+' );
    $result = eum_write_export_manifest_records(
        $handle,
        array(
            array( 'type' => 'post', 'id' => 3 ),
            array( 'type' => 'homepage', 'id' => 0 ),
        )
    );

    $this->assertSame( 2, $result['count'] );
    $this->assertGreaterThan( 0, $result['bytes'] );
}
```

- [ ] **Step 2: Run focused test and verify RED**

Run `composer test -- --filter test_manifest_writer_tracks_record_count_and_byte_offset`.

Expected: failure because manifest writer does not exist.

- [ ] **Step 3: Implement streaming manifest creation**

Add `eum_write_export_manifest_records( $handle, $records )`. It must call `fwrite()` for each encoded record, return `WP_Error` on write failure, and never retain the complete record set in memory.

Add `eum_create_export_manifest( $request, $paths )` in `class-batch-export.php`:

- Open manifest path with `fopen( $paths['manifest'], 'wb' )`.
- Query selected posts in pages of 500 IDs using `WP_Query` with `fields => 'ids'`, sorted by ID ascending.
- Write each post record as `{"type":"post","id":123}`.
- Query categories and product categories in pages using `get_terms()` with `number` and `offset`.
- Write term records with taxonomy.
- Write homepage record only when latest-posts homepage is selected.
- Close the handle on every success and failure path.
- Return `array( 'count' => $count, 'bytes' => $bytes )` or `WP_Error`.

- [ ] **Step 4: Make start handler create manifest before session**

In `eum_ajax_start_export()`:

- Generate export ID first with `eum_create_export_session_id()`.
- Get CSV/manifest paths from `eum_get_export_manifest_paths()`.
- Create the manifest before creating the transient.
- Delete manifest and CSV if manifest creation fails.
- Store `manifest_path`, `manifest_bytes`, `manifest_offset` set to `0`, and `total` set to manifest count in the transient.
- Stop storing `counts` as the batch cursor source.

- [ ] **Step 5: Run focused and full tests**

Run:

```bash
composer test -- --filter ExportManifestTest
composer test
```

Expected: all tests pass.

### Task 3: Process Manifest Cursor Instead of Mutable Offsets

**Files:**
- Modify: `includes/export/class-batch-export.php`
- Test: `tests/ExportManifestTest.php`

- [ ] **Step 1: Add failing cursor tests**

Test that reading a batch advances by bytes and preserves record order:

```php
public function test_manifest_reader_advances_by_byte_offset(): void {
    $handle = fopen( 'php://temp', 'w+' );
    fwrite( $handle, "{\"type\":\"post\",\"id\":1}\n" );
    fwrite( $handle, "{\"type\":\"post\",\"id\":2}\n" );
    rewind( $handle );

    $first = eum_read_export_manifest_batch( $handle, 0, 1 );
    $second = eum_read_export_manifest_batch( $handle, $first['offset'], 1 );

    $this->assertSame( 1, $first['records'][0]['id'] );
    $this->assertSame( 2, $second['records'][0]['id'] );
    $this->assertGreaterThan( $first['offset'], $second['offset'] );
}
```

- [ ] **Step 2: Run focused test and verify RED**

Run `composer test -- --filter test_manifest_reader_advances_by_byte_offset`.

Expected: failure because manifest reader does not exist.

- [ ] **Step 3: Implement bounded manifest reader**

Implement `eum_read_export_manifest_batch( $handle, $offset, $limit )`:

- Seek to `$offset` with `fseek()`.
- Read at most `$limit` lines with `fgets()`.
- Decode each line with `eum_decode_export_manifest_record()`.
- Return `array( 'records' => $records, 'offset' => ftell( $handle ) )`.
- Return `WP_Error` if seek or read fails.

- [ ] **Step 4: Replace batch item selection**

Replace `eum_get_batch_export_items()` offset logic with manifest records:

- Open `manifest_path` in read mode.
- Read from `manifest_offset` using the batch limit.
- Resolve each record at processing time with `get_post()` or `get_term()`.
- Keep records for deleted content as processed records so cursor still advances.
- Build homepage item without database lookup.
- Close manifest handle.
- Update `manifest_offset` and increment `processed` by records read, not rows successfully written.
- Complete only when `processed >= total`.
- Return retry error for malformed or unreadable manifest data.

- [ ] **Step 5: Add content-change regression test**

Create a manifest with IDs 1 and 2, simulate a missing object for ID 1, and assert the second batch still reads ID 2 rather than repeating or skipping it.

- [ ] **Step 6: Run full verification**

Run:

```bash
composer test
php -l includes/export/class-batch-export.php
wp-env run cli wp eval 'wp_set_current_user(1); echo has_action("wp_ajax_eum_process_batch") ? "process-hooked" : "missing";'
```

Expected: tests pass, syntax check passes, and runtime reports `process-hooked`.

### Task 4: Replace Shared File Registry With ID-Derived Cleanup

**Files:**
- Modify: `includes/export/class-batch-export.php`
- Modify: `includes/class-export-session.php`
- Test: `tests/ExportManifestTest.php`

- [ ] **Step 1: Add failing cleanup tests**

Test that cleanup recognizes only this plugin’s files and preserves files with active sessions:

```php
public function test_cleanup_file_id_is_derived_from_plugin_filename(): void {
    $this->assertSame( 'eum_export_abc123', eum_get_export_id_from_temp_filename( '/tmp/eum_export_abc123.csv' ) );
    $this->assertNull( eum_get_export_id_from_temp_filename( '/tmp/other-plugin.csv' ) );
}
```

- [ ] **Step 2: Run focused test and verify RED**

Run `composer test -- --filter test_cleanup_file_id_is_derived_from_plugin_filename`.

Expected: failure because filename parser does not exist.

- [ ] **Step 3: Implement filename parser and cleanup**

Implement `eum_get_export_id_from_temp_filename( $path )` using `basename()` and a strict `eum_export_*.csv` or `eum_export_*.manifest` pattern. Reject path traversal and unrelated filenames.

Replace `eum_export_files` option registration with cleanup that:

- Scans only `get_temp_dir()` for `eum_export_*` files.
- Extracts export ID from each filename.
- Keeps files when `get_transient( $export_id )` exists.
- Deletes expired files only when no matching transient exists and `filemtime()` is older than `HOUR_IN_SECONDS`.
- Deletes both CSV and manifest files for the same export ID.
- Runs cleanup at export start and after successful download/cancel.

- [ ] **Step 4: Remove obsolete registry functions and calls**

Delete `eum_register_batch_export_file()`, `eum_unregister_batch_export_file()`, and all `eum_export_files` option reads/writes. Keep transient ownership checks unchanged.

- [ ] **Step 5: Test simultaneous sessions**

Create two distinct export IDs and assert cleanup/path generation keeps their CSV and manifest paths independent.

- [ ] **Step 6: Run full verification**

Run:

```bash
composer test
php -l includes/export/class-batch-export.php
git diff --check
```

### Task 5: End-to-End Runtime Verification

**Files:**
- Modify: `Test-Plan.md`

- [ ] **Step 1: Verify AJAX security responses**

Run:

```bash
wp-env run cli wp eval 'wp_set_current_user(1); $_POST = array("nonce" => "invalid", "form_data" => ""); eum_ajax_start_export();'
```

Expected JSON response contains `"success":false` and `"Security check failed."`, with no HTML notice output.

- [ ] **Step 2: Verify manifest and batch hooks**

Run:

```bash
wp-env run cli wp eval 'echo has_action("wp_ajax_eum_start_export") && has_action("wp_ajax_eum_process_batch") ? "batch-hooks-ok" : "batch-hooks-missing";'
```

Expected: `batch-hooks-ok`.

- [ ] **Step 3: Verify changed-content behavior manually**

Start an export containing at least two posts, modify or delete the first post after manifest creation, process remaining batches, and confirm CSV contains one row per manifest record with no duplicated second post.

- [ ] **Step 4: Verify abandoned-file cleanup**

Create expired `eum_export_<id>.csv` and `.manifest` files in the WordPress temp directory with no matching transient, start a new export, and confirm both files are removed.

- [ ] **Step 5: Update test plan documentation**

Add manifest determinism, simultaneous exports, abandoned-file cleanup, and content-change cases to `Test-Plan.md`.

- [ ] **Step 6: Run final checks**

Run:

```bash
composer test
php -l export-urls-and-meta.php
php -l includes/export/class-batch-export.php
node --check assets/js/export-urls-and-meta.js
git diff --check
```

Expected: all tests and syntax checks pass with no diff-check output.
