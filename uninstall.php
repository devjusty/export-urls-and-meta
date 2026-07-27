<?php
/**
 * Uninstall Export URLs and Meta.
 *
 * WordPress defines WP_UNINSTALL_PLUGIN before loading this file when the
 * plugin is deleted from wp-admin. Prefer uninstall.php over
 * register_uninstall_hook(): the hook path does not define that constant, so
 * guarded callbacks can no-op and leave options behind.
 *
 * @package ExportUrlsAndMeta
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

require_once __DIR__ . '/includes/export/class-export-manifest.php';
require_once __DIR__ . '/includes/class-plugin-lifecycle.php';

eum_uninstall_plugin();
