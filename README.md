# Export URLs and Meta Plugin

## Description

The Export URLs and Meta plugin is a WordPress plugin designed to export a CSV file containing information about published pages. It includes the page title, URL, Yoast meta title, meta description, post type, and publish status.

## Features

- Export URLs, titles, and meta descriptions of published pages
- Select specific post types to include in the export (pages, posts, products)
- Option to include product category pages (requires WooCommerce)
- Add character count for titles and descriptions in the CSV
- Choose the publish status of the exported posts (published, drafts, private, all)

## Installation

1. Download the plugin zip file.
2. Log in to your WordPress dashboard.
3. Go to Plugins > Add New.
4. Click on the "Upload Plugin" button.
5. Choose the plugin zip file you downloaded and click "Install Now".
6. After installation, click on "Activate Plugin" to activate it.

## Usage

1. After activating the plugin, go to Settings > Export URLs and Meta in the WordPress admin panel.
2. Select the desired post types to include in the export.
3. Choose additional options such as including product categories and character count.
4. Select the publish status of the exported posts.
5. Click the "Export CSV" button to generate the CSV file.

## Options

- **Post Types:** Choose which post types to include in the CSV export (e.g., pages, posts, products).
- **Additional Options:** Include character counts for titles and descriptions.
- **Publish Status:** Select the publish status of the posts to include in the export (e.g., published, drafts, private, all).

## Requirements

- WordPress 4.0 or higher
- Yoast SEO plugin (for meta title and description)

## License

This plugin is licensed under the [GNU GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html) license.

## Support

For support or feature requests, please contact [plugin author](mailto:devjusty@gmail.com).

## Changelog

### Version 0.0.3

- Added error handling for form submissions without selected post types.
- Improved handling of Yoast SEO meta titles for pages, posts, and products.

### Version 0.0.2

- Fixed bugs related to CSV generation.
- Added support for WooCommerce product categories.

### Version 0.0.1

- Initial release.
