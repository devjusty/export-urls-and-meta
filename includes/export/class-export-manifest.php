<?php
/**
 * Export manifest helpers.
 *
 * @package ExportUrlsAndMeta
 */

if ( ! defined( 'ABSPATH' ) && ! defined( 'PHPUNIT_COMPOSER_INSTALL' ) ) {
	exit;
}

/**
 * Encode one manifest record as JSON line.
 *
 * @param array $record Manifest record.
 * @return string JSON line.
 */
function eum_encode_export_manifest_record( $record ) {
	$json = function_exists( 'wp_json_encode' ) ? wp_json_encode( $record ) : json_encode( $record );
	return $json . "\n";
}

/**
 * Decode and validate one manifest line.
 *
 * @param string $line JSON line.
 * @return array|null Valid record or null.
 */
function eum_decode_export_manifest_record( $line ) {
	$record = json_decode( trim( $line ), true );
	if ( ! is_array( $record ) || empty( $record['type'] ) ) {
		return null;
	}
	if ( 'homepage' !== $record['type'] && empty( $record['id'] ) ) {
		return null;
	}
	if ( 'term' === $record['type'] && empty( $record['taxonomy'] ) ) {
		return null;
	}
	return $record;
}

/**
 * Get private paths for export files.
 *
 * @param string $export_id Export ID.
 * @return array File paths.
 */
function eum_get_export_manifest_paths( $export_id ) {
	$export_id = preg_replace( '/[^A-Za-z0-9_-]/', '', (string) $export_id );
	$temp_dir  = function_exists( 'get_temp_dir' ) ? get_temp_dir() : sys_get_temp_dir();
	$base      = rtrim( $temp_dir, '/\\' ) . DIRECTORY_SEPARATOR . $export_id;

	return array(
		'manifest' => $base . '.manifest',
		'csv'      => $base . '.csv',
	);
}

/**
 * Write records to manifest stream without retaining them.
 *
 * @param resource $handle  Writable manifest handle.
 * @param array    $records Manifest records.
 * @return array|WP_Error Count and bytes written, or error.
 */
function eum_write_export_manifest_records( $handle, $records ) {
	$result = array( 'count' => 0, 'bytes' => 0 );

	foreach ( $records as $record ) {
		$line          = eum_encode_export_manifest_record( $record );
		$remaining     = $line;
		$record_bytes  = 0;
		while ( '' !== $remaining ) {
			$bytes = fwrite( $handle, $remaining );
			if ( false === $bytes || 0 === $bytes ) {
				return class_exists( 'WP_Error' ) ? new WP_Error( 'manifest_write_failed', 'Unable to write export manifest.' ) : false;
			}
			$record_bytes += $bytes;
			$remaining = substr( $remaining, $bytes );
		}
		$result['count']++;
		$result['bytes'] += $record_bytes;
	}

	return $result;
}

/**
 * Read bounded records from manifest byte offset.
 *
 * @param resource $handle Manifest handle.
 * @param int      $offset Byte offset.
 * @param int      $limit  Maximum records.
 * @return array|WP_Error Records and next offset, or error.
 */
function eum_read_export_manifest_batch( $handle, $offset, $limit ) {
	if ( 0 !== fseek( $handle, (int) $offset ) ) {
		return class_exists( 'WP_Error' ) ? new WP_Error( 'manifest_seek_failed', 'Unable to seek export manifest.' ) : false;
	}

	$records = array();
	while ( count( $records ) < max( 1, (int) $limit ) && false !== ( $line = fgets( $handle ) ) ) {
		$record = eum_decode_export_manifest_record( $line );
		if ( null === $record ) {
			return class_exists( 'WP_Error' ) ? new WP_Error( 'manifest_read_failed', 'Export manifest contains invalid data.' ) : false;
		}
		$records[] = $record;
	}

	return array(
		'records' => $records,
		'offset'  => ftell( $handle ),
	);
}

/**
 * Extract export ID from plugin-owned temp filename.
 *
 * @param string $path Temporary file path.
 * @return string|null Export ID or null for unrelated files.
 */
function eum_get_export_id_from_temp_filename( $path ) {
	$basename = basename( (string) $path );
	if ( 1 !== preg_match( '/^(eum_export_[A-Za-z0-9_-]+)\.(csv|manifest)$/', $basename, $matches ) ) {
		return null;
	}

	return $matches[1];
}

/**
 * Neutralize spreadsheet formula values before CSV output.
 *
 * @param mixed $value CSV value.
 * @return mixed Safe CSV value.
 */
function eum_escape_csv_formula( $value ) {
	if ( is_string( $value ) && preg_match( '/^[=+\-@]/', $value ) ) {
		return "\t" . $value;
	}

	return $value;
}
