# Export URLs and Meta Plugin

## Description

Export URLs and Meta is a WordPress plugin that lets you generate a CSV file containing page/post/product URLs, SEO titles, meta descriptions, publish status, and more. It supports multiple SEO plugins (e.g., Yoast, Rank Math, SEOPress) and includes WooCommerce product categories, homepage handling when “latest posts” is used, and more.

## Features

- Export titles, URLs, meta titles, and meta descriptions for:
  - Pages, Posts, and Products
  - Post Category Pages, Product Category Pages
  - Optional homepage (latest posts scenario)
- Detects Yoast, Rank Math, and SEOPress to grab correct meta fields
- Option to include character counts for titles and descriptions
- Supports multiple publish statuses (published, drafts, private)
- Stores your export settings for convenience
- Cleans up plugin settings on uninstall

## Usage

1. **Install and Activate**: Upload the plugin to `/wp-content/plugins/`, then activate it.
2. **Go to Tools → Export URLs and Meta**: Within the WordPress admin.
3. **Select Desired Options**:
   - Post types (pages, posts, products)
   - Include post category pages, product categories
   - Character counts, homepage export, etc.
4. **Choose Publish Status**: (published, drafts, private).
5. **Export**: Click “Export CSV” to download the generated file.

## Options

- **Post Types**: Choose which to include (e.g., pages, posts, products).
- **Homepage (Latest Posts)**: Optionally add a row for the root URL if no static front page is set.
- **Category Pages**: Include product categories (WooCommerce) and/or default post categories.
- **Character Counts**: Add extra columns showing length of meta title and meta description.
- **Publish Status**: Filter for published, drafts, private, or all.
- **SEO Plugin Detection**: Automatically retrieves meta from Yoast, Rank Math, or SEOPress if installed.

## Requirements

- WordPress 5.0 or higher
- PHP 7.0 or higher
- For SEO meta title/description:
  - Yoast SEO, Rank Math, or SEOPress (fallback logic if none detected)

## License

This plugin is licensed under the [GNU GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html).

## Support

For bug reports or feature requests, please [open an issue on GitHub](https://github.com/devjusty/export-urls-and-meta/issues) or email [devjusty@gmail.com](mailto:devjusty@gmail.com).

## Changelog

### Version 0.0.10

- Added support for Rank Math SEO
- Option to include homepage if “Your latest posts” is used
- Support for post category pages in addition to product categories
- Stores user export settings and cleans up on uninstall
- Various minor fixes and performance improvements

### Version 0.0.3

- Added error handling for forms with no selected post types
- Improved Yoast SEO meta title handling for pages, posts, and products

### Version 0.0.2

- Fixed CSV generation bugs
- Added support for WooCommerce product categories

### Version 0.0.1

- Initial release

## TO DO

- Confirm full compatibility with All-In-One SEO, SEOPress, and The SEO Framework.
- Add custom post type selection logic
- Potentially add JSON or XML export
- Option for password-protected and scheduled posts
- Explore advanced category selection
- Investigate special pages (404, search results)
- Add a “select all” option for faster setup
- Possibly store indexing status from SEO plugin (as a column)
