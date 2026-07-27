<?php
/**
 * Plugin lifecycle helpers: deactivate, uninstall, and runtime purge.
 *
 * @package ExportUrlsAndMeta
 */

if ( ! defined( 'ABSPATH' ) && ! defined( 'PHPUNIT_COMPOSER_INSTALL' ) ) {
	exit;
}

/**
 * Build a normalized last-batch-failure payload.
 *
 * @param string $message Failure message.
 * @param int    $time    Unix timestamp.
 * @return array{time:int,message:string}
 */
function eum_normalize_last_batch_failure( $message, $time = null ) {
	return array(
		'time'    => null === $time ? time() : (int) $time,
		'message' => is_string( $message ) ? $message : '',
	);
}

/**
 * Persist the most recent batch failure for diagnostics.
 *
 * @param string $message Failure message.
 * @return array{time:int,message:string} Stored payload.
 */
function eum_record_last_batch_failure( $message ) {
	$data = eum_normalize_last_batch_failure( $message );
	if ( function_exists( 'update_option' ) ) {
		update_option( 'eum_last_batch_failure', $data, false );
	}
	return $data;
}

/**
 * Get the most recent batch failure, if any.
 *
 * @return array{time:int,message:string}|null
 */
function eum_get_last_batch_failure() {
	if ( ! function_exists( 'get_option' ) ) {
		return null;
	}

	$data = get_option( 'eum_last_batch_failure', null );
	if ( ! is_array( $data ) || empty( $data['message'] ) || ! isset( $data['time'] ) ) {
		return null;
	}

	return array(
		'time'    => (int) $data['time'],
		'message' => (string) $data['message'],
	);
}

/**
 * List export artifact files in a storage directory.
 *
 * @param string|null $storage_dir Optional trailing-slashed directory.
 * @return array<int, string> Absolute file paths.
 */
function eum_list_export_storage_files( $storage_dir = null ) {
	$dir = null !== $storage_dir ? $storage_dir : ( function_exists( 'eum_get_export_storage_dir' ) ? eum_get_export_storage_dir() : '' );
	if ( '' === $dir ) {
		return array();
	}

	$dir   = rtrim( str_replace( '\\', '/', $dir ), '/' ) . '/';
	$files = glob( $dir . 'eum_export_*' );
	return is_array( $files ) ? $files : array();
}

/**
 * Count leftover export artifact files.
 *
 * @param string|null $storage_dir Optional storage directory.
 * @return int
 */
function eum_count_export_storage_files( $storage_dir = null ) {
	return count( eum_list_export_storage_files( $storage_dir ) );
}

/**
 * Delete one export artifact file.
 *
 * @param string $file Absolute path.
 * @return bool Whether the file was removed or already absent.
 */
function eum_delete_export_storage_file( $file ) {
	if ( ! is_file( $file ) ) {
		return true;
	}

	if ( function_exists( 'wp_delete_file' ) ) {
		wp_delete_file( $file );
		return ! is_file( $file );
	}

	return unlink( $file );
}

/**
 * Clear session/lock state for one export ID.
 *
 * @param string $export_id Export ID.
 * @return array{locks:int,transients:int}
 */
function eum_purge_export_id_runtime_state( $export_id ) {
	$cleared = array(
		'locks'      => 0,
		'transients' => 0,
	);

	$export_id = preg_replace( '/[^A-Za-z0-9_-]/', '', (string) $export_id );
	if ( '' === $export_id ) {
		return $cleared;
	}

	$lock_key = '_eum_export_lock_' . $export_id;
	if ( function_exists( 'delete_option' ) && function_exists( 'get_option' ) && false !== get_option( $lock_key, false ) ) {
		delete_option( $lock_key );
		$cleared['locks']++;
	}

	if ( function_exists( 'delete_transient' ) && function_exists( 'get_transient' ) ) {
		if ( false !== get_transient( $export_id ) ) {
			delete_transient( $export_id );
			$cleared['transients']++;
		}
		$cancel_key = 'eum_export_cancel_' . $export_id;
		if ( false !== get_transient( $cancel_key ) ) {
			delete_transient( $cancel_key );
			$cleared['transients']++;
		}
	}

	return $cleared;
}

/**
 * Sweep orphan lock options from the options table.
 *
 * @return array{locks:int,export_ids:array<int,string>}
 */
function eum_sweep_export_lock_options() {
	$result = array(
		'locks'      => 0,
		'export_ids' => array(),
	);

	global $wpdb;
	if ( ! isset( $wpdb ) || ! is_object( $wpdb ) || empty( $wpdb->options ) ) {
		return $result;
	}

	// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching -- Lifecycle cleanup sweep.
	$lock_names = $wpdb->get_col(
		$wpdb->prepare(
			"SELECT option_name FROM {$wpdb->options} WHERE option_name LIKE %s",
			$wpdb->esc_like( '_eum_export_lock_' ) . '%'
		)
	);

	if ( ! is_array( $lock_names ) ) {
		return $result;
	}

	foreach ( $lock_names as $lock_name ) {
		if ( ! is_string( $lock_name ) || 0 !== strpos( $lock_name, '_eum_export_lock_' ) ) {
			continue;
		}
		$export_id = substr( $lock_name, strlen( '_eum_export_lock_' ) );
		if ( '' === $export_id ) {
			continue;
		}
		$result['export_ids'][] = $export_id;
		if ( function_exists( 'delete_option' ) ) {
			delete_option( $lock_name );
			$result['locks']++;
		}
	}

	return $result;
}

/**
 * Force-clear export runtime residue (files, locks, session/cancel transients).
 *
 * Does not delete saved export form settings.
 *
 * @param string|null $storage_dir Optional storage directory override (for tests).
 * @return array{files:int,locks:int,transients:int}
 */
function eum_purge_export_runtime_state( $storage_dir = null ) {
	$cleared = array(
		'files'      => 0,
		'locks'      => 0,
		'transients' => 0,
	);

	$export_ids = array();
	foreach ( eum_list_export_storage_files( $storage_dir ) as $file ) {
		$export_id = function_exists( 'eum_get_export_id_from_temp_filename' )
			? eum_get_export_id_from_temp_filename( $file )
			: null;
		if ( null !== $export_id ) {
			$export_ids[ $export_id ] = true;
		}
		if ( eum_delete_export_storage_file( $file ) ) {
			$cleared['files']++;
		}
	}

	$swept = eum_sweep_export_lock_options();
	$cleared['locks'] += $swept['locks'];
	foreach ( $swept['export_ids'] as $export_id ) {
		$export_ids[ $export_id ] = true;
	}

	foreach ( array_keys( $export_ids ) as $export_id ) {
		$id_cleared = eum_purge_export_id_runtime_state( $export_id );
		// Locks may already have been removed by the options sweep.
		$cleared['transients'] += $id_cleared['transients'];
		if ( 0 === $swept['locks'] ) {
			$cleared['locks'] += $id_cleared['locks'];
		}
	}

	return $cleared;
}

/**
 * Remove the plugin uploads storage directory when it only has protectors left.
 *
 * @return bool Whether the directory was removed.
 */
function eum_remove_export_storage_directory() {
	if ( ! function_exists( 'eum_get_export_storage_dir' ) || ! function_exists( 'wp_upload_dir' ) ) {
		return false;
	}

	$upload = wp_upload_dir();
	if ( ! empty( $upload['error'] ) || empty( $upload['basedir'] ) ) {
		return false;
	}

	$expected = rtrim( str_replace( '\\', '/', $upload['basedir'] ), '/' ) . '/export-urls-and-meta';
	$current  = rtrim( str_replace( '\\', '/', eum_get_export_storage_dir() ), '/' );
	if ( $current !== $expected || ! is_dir( $current ) ) {
		return false;
	}

	foreach ( eum_list_export_storage_files( $current . '/' ) as $file ) {
		eum_delete_export_storage_file( $file );
	}

	foreach ( array( 'index.php', '.htaccess' ) as $protector ) {
		$path = $current . '/' . $protector;
		if ( is_file( $path ) ) {
			unlink( $path );
		}
	}

	$remaining = scandir( $current );
	if ( ! is_array( $remaining ) ) {
		return false;
	}
	$remaining = array_diff( $remaining, array( '.', '..' ) );
	if ( ! empty( $remaining ) ) {
		return false;
	}

	return rmdir( $current );
}

/**
 * Deactivation callback: clear in-progress export residue, keep settings.
 *
 * @return void
 */
function eum_deactivate_plugin() {
	eum_purge_export_runtime_state();
}

/**
 * Uninstall callback: clear runtime residue and persisted plugin options.
 *
 * @return void
 */
function eum_uninstall_plugin() {
	if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
		return;
	}

	eum_purge_export_runtime_state();
	if ( function_exists( 'delete_option' ) ) {
		delete_option( 'eum_export_settings' );
		delete_option( 'eum_last_batch_failure' );
	}
	eum_remove_export_storage_directory();
}
