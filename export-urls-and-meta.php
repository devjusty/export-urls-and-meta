<?php
/**
 * Plugin Name: Export URLs and Meta
 * Plugin URI: https://github.com/devjusty/export-urls-and-meta
 * Description: Plugin to export SEO titles, URLs, and meta descriptions to a CSV.
 * Version: 1.0.0
 * Author: Justin Thompson
 * Requires PHP: 7.0
 * Tested up to: 6.7.2
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: export-urls-and-meta
 *
 * @package ExportUrlsAndMeta
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
exit;
}

// Plugin version.
define( 'EXPORT_URLS_AND_META_VERSION', '0.1.0' );

// Plugin Folder Path.
define( 'EXPORT_URLS_AND_META_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// Plugin Folder URL.
define( 'EXPORT_URLS_AND_META_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Plugin Root File.
define( 'EXPORT_URLS_AND_META_PLUGIN_FILE', __FILE__ );

// Include the main plugin class.
if ( ! class_exists( 'Export_Urls_And_Meta' ) ) {
require_once EXPORT_URLS_AND_META_PLUGIN_DIR . 'includes/class-export-urls-and-meta.php';
}

/**
 * Main instance of the plugin.
 *
 * @since 0.1.0
 * @return Export_Urls_And_Meta
 */
function export_urls_and_meta() {
return Export_Urls_And_Meta::instance();
}

// Initialize the plugin.
export_urls_and_meta();

// Register activation and deactivation hooks.
register_activation_hook( __FILE__, array( 'Export_Urls_And_Meta', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Export_Urls_And_Meta', 'deactivate' ) );

// Register uninstall hook.
register_uninstall_hook( __FILE__, array( 'Export_Urls_And_Meta', 'uninstall' ) );
