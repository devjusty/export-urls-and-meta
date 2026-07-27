=== Export URLs and Meta ===
Contributors: Justin Thompson
Tags: seo, meta, export
Requires at least: 5.8
Tested up to: 6.7.2
Requires PHP: 7.0
Stable tag: 0.0.14
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Export page/post/product URLs, meta titles, descriptions (including from popular SEO plugins), to CSV.

== Description ==

This plugin creates a tool under **Tools → Export URLs and Meta** that allows you to export:

* Posts, Pages, and Products
* Post Category Pages and Product Category Pages
* Meta titles and meta descriptions from Yoast, RankMath, and soon others.
* Character counts for each meta field (optional)
* Custom handling for sites with “latest posts” as the homepage
* Persistent admin settings to quickly repeat exports

== Installation ==

1. Upload `export-urls-and-meta` to the `/wp-content/plugins/` directory or install via the WordPress admin.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to **Tools → Export URLs and Meta**.
4. Select your desired options, then click **Export CSV**.

== Frequently Asked Questions ==

= What if I have no SEO plugin installed? =
The plugin will use basic fallback logic: “{Post Title} - {Site Name}” for the meta title, and only a manual excerpt if it exists for meta descriptions.

= What about the homepage if I’m using “Your latest posts”? =
The plugin can detect this scenario and optionally add a row for the root URL.

= Does it work with WooCommerce Products? =
Yes. Simply check “Products” and optionally “Include Product Category Pages” to get product_cat exports.

= How do I remove all plugin data upon deletion? =
Deleting the plugin from the WordPress admin runs `uninstall.php`, which removes saved settings, the last batch failure record, export locks/transients, and leftover export files under uploads.

== Changelog ==

= 0.0.14 =
* Fixed batch export lock refresh false failures under object caching
* Fixed AJAX error handling so real batch failure messages surface in the UI
* Fixed Rank Math post meta titles not being applied to exports
* Fixed export modal Close button overlapping status text
* Store export CSV/manifest files under uploads instead of volatile system temp
* Added uninstall.php so settings and last-failure data are removed on delete
* Added deactivate cleanup for in-progress export residue
* Expanded Diagnostics with storage health, last batch failure, and clear-leftovers
* Added local cross-platform package script, CI, and WPCS tooling

= 0.0.13 =
* Refactored export flow into include files and batch export classes
* Added plugin update checker for GitHub Releases
* Added release packaging workflow for installable zip assets
* Added diagnostics tooling and admin export flow cleanup
* Added developer tooling updates and editor configuration

= 0.0.12 =
* Fixed Rank Math data detection
* Added settings link to plugin list
* UI improvements for admin export flow

= 0.0.10 =
* Added Rank Math support
* Added an option to include the homepage if no static front page is set
* Added product category exports
* Improved WP_Filesystem usage
* Clean up settings with uninstall hook
