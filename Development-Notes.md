## Next Goals

- test parsing of variables from rankmath, yoast, seopress, all in one seo, the seo framework
- switch to OOP
- Add Process Indicator

## Post Types

Add support for additional post types?

- Landing Page
- Templates
- Custom Post Types (Detect and Select or ALL)

## Fields

Consider adding the following fields to exported CSV, these should be selectable on our admin tools page.

- Post ID
- Tags
- Author
- Published Date
- Modified Date
- Indexing Status
- Focus Keyword

## Status

Select by post status:

- Pending
- Auto Draft
- Scheduled
- Private
- Trashed
- All

## Filter

Add ability to filter by:

- Author
- Date Range
- Category

## Export Options

Add additional export options:

- strip domain name
- customize file name
- export special urls, image urls, what else? 404 and search? date archives? author archives? sitemap urls?

## Prepare for Submission to WordPress Plugin Repo

- Develop build process for our plugin to create a zip file for submission to the WordPress Plugin Repo
- Develop documentation for our plugin
- Plan for Premium Version - Include Donation link in base version for now.

## Helper

Not sure if this is possible in PHP, but if so, we should convert to excel file and dynamic character counts for meta title and meta description.

## Premium Ideas

### 1. **Custom Post Type Support**

- Allow users to select custom post types (besides just pages, posts, and WooCommerce products) to export SEO data. This would be useful for sites using custom post types for other content like portfolios, events, testimonials, etc.

### 2. **Advanced Filtering and Sorting**

- Enable advanced filtering options based on categories, tags, or custom taxonomies. Also, provide sorting by various fields such as title, URL, date, etc.
- Filter export by publish status (e.g., only draft posts or published ones).

### 3. **Scheduled Export**

- Allow users to schedule exports to run automatically at set intervals (daily, weekly, monthly). This feature would be useful for large sites that need regular data exports.

### 4. **Export to Multiple Formats**

- In addition to CSV, allow exports to other formats such as Excel (XLSX), JSON, or even XML.

### 5. **Meta Data Field Customization**

- Give users the ability to select which meta fields to export (besides just title and description). This could include other Yoast SEO fields such as keywords, focus keyword, schema markup, etc.

### 6. **Export SEO Data for Taxonomies**

- Include the ability to export SEO meta data for custom taxonomies, like product categories, tags, or any other taxonomy in use on the site.

### 7. **Bulk Edit Support**

- Allow users to directly bulk edit SEO titles or descriptions from the exported data within the plugin interface. Once the CSV is modified, they can re-upload it, and the plugin can automatically update the posts or pages with the new SEO data.

### 8. **Integration with Google Analytics and Search Console**

- Integrate SEO export data with Google Analytics or Google Search Console data for richer insights, such as impressions, clicks, and CTR for pages/posts, alongside SEO metadata.

### 9. **Multilingual Support**

- For sites with multiple languages (e.g., using WPML or Polylang), enable export of SEO metadata in multiple languages, helping users manage their SEO data across different languages.

### 10. **Support for Other SEO Plugins**

- Expand compatibility with other popular SEO plugins like Rank Math and All In One SEO. This would allow users to export SEO data regardless of which plugin they are using.

### 11. **Data Previews**

- Add a preview option before export, so users can see what the exported file will look like and ensure that all the correct data is included. This would save time for users who want to avoid exporting unwanted data.

### 12. **Customizable Column Headers**

- Allow users to create custom column headers for the exported data. This would let users include things like custom meta fields, images, or any other post metadata they wish.

### 13. **Export with Filtered SEO Analysis**

- Implement a feature that allows users to filter out SEO content that is incomplete or not fully optimized. For instance, the plugin could flag posts that are missing a meta description or have a title that’s too short.

### 14. **Cloud Storage Integration**

- Integrate the plugin with popular cloud storage services such as Google Drive, Dropbox, or Amazon S3 to automatically upload the exported files to a cloud account after they are generated.

### 15. **Email Notifications for Export Results**

- Allow users to receive email notifications when a scheduled export is completed, or when a bulk export is ready for download.

### 16. **Data Security & Privacy Compliance Features**

- Include tools for GDPR compliance, such as the option to anonymize or remove sensitive user data before export (useful for sites dealing with personal data).

### 17. **Export for Specific Date Ranges**

- Enable users to export SEO data for posts or pages published within specific date ranges. This can help with audits or reporting on specific campaigns.

### 18. **User Role-Based Permissions**

- Offer the ability to restrict access to the export functionality based on user roles, giving admins more control over who can generate exports.

### 19. **Advanced Export for WooCommerce**

- Provide additional export options specific to WooCommerce, such as exporting product SEO data, product categories, prices, stock status, etc., along with meta titles/descriptions.

### 20. **SEO Score and Optimization Report**

- Include a feature that analyzes the exported SEO metadata and gives the user an optimization score. The report could provide suggestions for improvement (e.g., missing focus keywords, duplicate meta descriptions).

These features could provide significant value to power users and website managers who need more flexibility and control over their SEO data exports, thus justifying the premium version of the plugin.

### Excel Helper

```
=LEN(C2)
```

JS

```js
(function ($) {
  $(document).ready(function () {
    // Create a spinner overlay element
    var spinnerHTML =
      '<div id="eum-spinner-overlay" style="display:none; position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(255,255,255,0.8); z-index: 9999;">' +
      '<div class="eum-spinner" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 60px; height: 60px; border: 8px solid #f3f3f3; border-top: 8px solid #3498db; border-radius: 50%; animation: eum-spin 2s linear infinite;"></div>' +
      "</div>";
    $("body").append(spinnerHTML);

    // Add keyframes for spinner animation
    var css =
      "@keyframes eum-spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }";
    $("<style>" + css + "</style>").appendTo("head");

    // When the export form is submitted, show the spinner and disable the button
    $("form").on("submit", function () {
      $("#eum-spinner-overlay").show();
      $(this).find('button[type="submit"]').attr("disabled", "disabled");
    });
  });
})(jQuery);

(function ($) {
  $(document).ready(function () {
    // Create a loader overlay with a message and a close button.
    var loaderHTML =
      '<div id="eum-loader-overlay" style="display:none; position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5); z-index:9999;">' +
      '<div id="eum-loader-message" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #fff; padding: 20px; border-radius: 5px; text-align: center; min-width: 200px;">' +
      '<button id="eum-loader-close" style="position: absolute; top: 5px; right: 5px; border: none; background: transparent; font-size: 16px; cursor: pointer;">X</button>' +
      '<div id="eum-loader-text" style="margin-top: 20px;">Download has started...</div>' +
      "</div>" +
      "</div>";
    $("body").append(loaderHTML);

    // When the close button is clicked, hide the loader
    $("#eum-loader-close").on("click", function (e) {
      e.preventDefault();
      $("#eum-loader-overlay").hide();
    });

    // When the export form is submitted, show the loader and disable the submit button
    $("form").on("submit", function () {
      $("#eum-loader-overlay").show();
      $(this).find('button[type="submit"]').attr("disabled", "disabled");
    });
  });
})(jQuery);
```

## Issues to Confirm / Optimizations

I've reviewed the "Export URLs and Meta" WordPress plugin code, and here are my findings on potential bugs and optimization opportunities:

## Potential Bugs

1. **Multiple SEO Plugin Detection**:

   - The logic in `eum_detect_active_seo_plugin()` returns `false` when multiple SEO plugins are detected, but the condition check in `eum_render_admin_page()` uses `$active_seo_plugin === false` instead of checking for a specific error condition. This might lead to unclear error states.

2. **Incomplete Error Handling**:

   - In `eum_handle_export_csv()`, if `eum_detect_active_seo_plugin()` returns false, an error message is added to admin notices but the function continues execution.

3. **Tempfile Management**:

   - The CSV export function creates a temporary file but doesn't include sufficient error handling if the file operations fail.

4. **SEO Plugin Compatibility**:

   - There's inconsistent handling of different SEO plugins in the meta retrieval functions. Some plugins may not be detected correctly or their meta might not be retrieved properly.

5. **Yoast Function Dependency**:

   - The code depends on `wpseo_replace_vars()` but doesn't fully validate if that function exists before using it in multiple places.

## Optimization Opportunities

1. **Query Optimization**:

   - The plugin uses WP_Query in a loop with pagination, which is inefficient for large datasets. Consider using `'nopaging' => true` or a more efficient batch processing approach.

2. **Caching**:

   - Add caching for repeated calls to `eum_get_yoast_title_template()` to reduce database queries.

3. **Code Organization**:

   - Separate concerns by moving SEO plugin-specific logic into dedicated handler classes that implement a common interface.

4. **Memory Usage**:

   - For sites with many posts, the plugin loads all data into memory before creating the CSV. This could be optimized to stream directly to the output instead.

5. **Security Enhancements**:

   - While the plugin uses nonce validation and capability checks, additional sanitization of output data would be beneficial.

6. **Performance**:

   - The homepage and term meta retrieval could be optimized to avoid redundant database calls.

7. **Refactor Repetitive Code**:

   - There's duplicate logic in the meta retrieval functions that could be abstracted.

8. **WordPress Standards**:

   - The code could better follow WordPress coding standards for function naming and organization.

## Recommendations

1. **Improve SEO Plugin Detection**:

   - Create a more robust detection system with clear error states and fallback behaviors.

2. **Refactor Meta Retrieval**:

   - Create a factory pattern for SEO plugins to centralize and standardize meta retrieval.

3. **Add Streaming Export**:

   - Implement direct streaming to avoid memory limitations with large datasets.

4. **Add Logging**:

   - Include better error logging for troubleshooting.

5. **Enhance UI Feedback**:

   - Provide more user feedback during long-running exports.

6. **Add Testing**:

   - Implement unit tests for core functionality.

7. **Extend Documentation**:

   - Add better inline documentation for complex functions.

- **Progress Indicator**: For large sites, add an AJAX-based progress indicator during export
- **Error Handling**: Improve error handling with try/catch blocks and proper error logging:
- **Extension Hooks**: Add action/filter hooks to allow other plugins to modify export behavior
- **Transient Caching**: Use WordPress transients to cache certain complex operations:

**Potential Bugs and Optimizations:**

1. **Performance with Large Datasets:**
   - The `eum_generate_csv` function uses `WP_Query` with `posts_per_page` set to 100. For very large sites, this could still lead to memory issues. Consider implementing a more robust batch processing or chunking mechanism.
   - The `stream_get_contents` function after reading the temporary file into memory could be a memory hog with very large datasets. Consider using a streaming output method directly to the browser, bypassing the need to load the entire file into memory at once.
2. **SEO Plugin Compatibility:**
   - While the plugin detects major SEO plugins, it might need updates as those plugins evolve. Thorough testing with different SEO plugin versions is essential.
   - The code that gets the meta data from the different SEO plugins, could be made more flexible, by using filters, so other plugins could also add their own SEO meta data.
3. **Error Handling and User Feedback:**
   - While error messages are displayed, consider adding more specific error codes or log entries for debugging purposes.
   - Add a loading indicator to the export button, so the user knows, that the export is running.
4. **Code Readability and Maintainability:**
   - Some functions, like `eum_generate_csv`, are quite long. Consider breaking them down into smaller, more focused functions.
   - Add more comments to the code, especially in the `eum_get_post_meta` and `eum_get_term_meta` functions, to explain the logic for different SEO plugins.
5. **UTF-8 BOM:**
   - While including the UTF-8 BOM (`\xEF\xBB\xBF`) is often recommended for Excel compatibility, it might cause issues with other applications. Consider making this an option or providing a warning.
6. **Security:**
   - Double check that all user input is correctly sanitized.
7. **Yoast SEO Template Handling:**
   - The `eum_get_yoast_title_template` function uses a static variable. While this works, it could be made more robust by using `apply_filters` to allow other plugins to modify the templates.
8. **Character Count:**
   - The character count is based on `strlen`. This might not accurately reflect character counts for multi-byte characters. Consider using `mb_strlen` for more accurate counts.

**Recommendations:**

- Implement batch processing for large datasets.
- Add more detailed error logging.
- Refactor long functions into smaller, more manageable ones.
- Thoroughly test with various SEO plugin versions.
- Add filters to allow other plugins to add their own SEO data.
- Use `mb_strlen` for accurate character counts.
- Add loading indicators.
