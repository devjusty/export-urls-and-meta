# Export URLs and Meta - Manual Test Plan

This document outlines the manual testing process to ensure the plugin is working correctly before release.

## I. Core Export Functionality

**Objective:** Verify that the basic export options work as expected.

- [ ] **Test Case 1.1: Post Types**

  - [ ] Select only "Posts" and export. Verify CSV contains only posts.
  - [ ] Select only "Pages" and export. Verify CSV contains only pages.
  - [ ] Select both "Posts" and "Pages". Verify CSV contains both.

- [ ] **Test Case 1.2: Taxonomies**

  - [ ] Select only "Categories". Verify CSV contains only categories.
  - [ ] Select only "Product Categories" (if WooCommerce is active). Verify CSV contains only product categories.

- [ ] **Test Case 1.3: Homepage**

  - [ ] Select only "Homepage". Verify CSV contains the homepage SEO data.

- [ ] **Test Case 1.4: Post Status**

  - [ ] Select "Published" status. Verify only published items are exported.
  - [ ] Select "Draft" status. Verify only draft items are exported.
  - [ ] Select multiple statuses. Verify items with those statuses are exported.

- [ ] **Test Case 1.5: Character Counts**
  - [ ] Check "Include character count". Verify CSV has Title and Description length columns.
  - [ ] Uncheck "Include character count". Verify CSV does not have the length columns.

## II. AJAX Batch Processing & UI

**Objective:** Verify the asynchronous export process and user feedback mechanisms.

- [ ] **Test Case 2.1: Progress Bar**

  - [ ] Start an export with a significant number of items (>100).
  - [ ] Verify the progress bar appears and animates from 0% to 100%.
  - [ ] Verify the progress status text (e.g., "50 / 150 items processed") updates correctly.

- [ ] **Test Case 2.2: Completion & Download**

  - [ ] Verify "Export complete!" message appears when done.
  - [ ] Verify the "Download Export" button appears.
  - [ ] Click the download button and verify the correct CSV file is downloaded.
  - [ ] Verify the downloaded CSV contains all the expected data.

- [ ] **Test Case 2.3: Cancellation**
  - [ ] Start a large export.
  - [ ] While it is processing, click the "Close" button.
  - [ ] Verify the loader overlay disappears and the form is reset.
  - [ ] (Manual Server Check) Verify the `eum-export-*.csv` file and the export transient are deleted.

## III. SEO Plugin Compatibility

**Objective:** Ensure the plugin correctly extracts metadata from all supported SEO plugins.

_For each test, activate only the specified SEO plugin, create sample data (posts/pages/terms) with SEO titles and descriptions, and then export._

- [ ] **Test Case 3.1: Yoast SEO**

  - [ ] Activate Yoast SEO. Export data. Verify Yoast titles/descriptions are in the CSV.

- [ ] **Test Case 3.2: Rank Math**

  - [ ] Activate Rank Math. Export data. Verify Rank Math titles/descriptions are in the CSV.

- [ ] **Test Case 3.3: All in One SEO**

  - [ ] Activate All in One SEO. Export data. Verify AIOSEO titles/descriptions are in the CSV.

- [ ] **Test Case 3.4: SEOPress**

  - [ ] Activate SEOPress. Export data. Verify SEOPress titles/descriptions are in the CSV.

- [ ] **Test Case 3.5: The SEO Framework**

  - [ ] Activate The SEO Framework. Export data. Verify TSF titles/descriptions are in the CSV.

- [ ] **Test Case 3.6: No SEO Plugin**
  - [ ] Deactivate all SEO plugins. Export data. Verify the plugin falls back gracefully (e.g., to post titles and excerpts).

## IV. Error Handling & Edge Cases

**Objective:** Test how the plugin handles unexpected situations.

- [ ] **Test Case 4.1: No Items Selected**

  - [ ] Uncheck all post types and taxonomies.
  - [ ] Click "Generate CSV".
  - [ ] Verify an error message "No items found to export." is displayed.

- [ ] **Test Case 4.2: Zero Items Found**
  - [ ] Select a post type that has no entries (e.g., a CPT with no posts).
  - [ ] Click "Generate CSV".
  - [ ] Verify the "No items found to export." error is handled correctly.

## V. Environment Compatibility

**Objective:** Ensure the plugin functions correctly across different server environments and WordPress versions.

_It is recommended to use a local development environment (like Local by Flywheel, XAMPP, etc.) that allows easy switching between PHP and WordPress versions._

- [ ] **Test Case 5.1: PHP Version Compatibility**

  - [ ] Test on PHP 7.4 (current minimum recommended for WordPress).
  - [ ] Test on PHP 8.0.
  - [ ] Test on PHP 8.1.
  - [ ] Test on PHP 8.2 / latest stable.
  - **For each PHP version, perform a "smoke test":**
    - [ ] Activate the plugin.
    - [ ] Run a simple export (e.g., Posts only).
    - [ ] Verify the export completes and the CSV is valid.
    - [ ] Check the browser console and PHP error logs for any fatal errors or warnings.

- [ ] **Test Case 5.2: WordPress Version Compatibility**
  - [ ] Test on the latest major WordPress version (e.g., 6.x).
  - [ ] Test on the previous major WordPress version (e.g., 5.x).
  - [ ] Test on the oldest supported WordPress version as defined in `readme.txt`.
  - **For each WordPress version, perform a "smoke test":**
    - [ ] Activate the plugin.
    - [ ] Run a simple export.
    - [ ] Verify the export UI works and the download is successful.
