<?php
/**
 * Secure batch export handlers.
 *
 * @package ExportUrlsAndMeta
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_ajax_eum_start_export', 'eum_ajax_start_export' );
add_action( 'wp_ajax_eum_process_batch', 'eum_ajax_process_batch' );
add_action( 'wp_ajax_eum_download_file', 'eum_ajax_download_file' );
add_action( 'wp_ajax_eum_cancel_export', 'eum_ajax_cancel_export' );

/**
 * Authorize batch AJAX request.
 *
 * @return void
 */
function eum_authorize_batch_request() {
	$nonce = isset( $_REQUEST['nonce'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ) : '';
	if ( ! wp_verify_nonce( $nonce, 'eum_export_nonce' ) ) {
		wp_send_json_error( array( 'message' => 'Security check failed.' ), 403 );
	}

	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( array( 'message' => 'You do not have permission to export data.' ), 403 );
	}
}

/**
 * Start batch export session.
 *
 * @return void
 */
function eum_ajax_start_export() {
	eum_authorize_batch_request();

	// Nonce verified in eum_authorize_batch_request(); values sanitized after parse_str.
	// phpcs:ignore WordPress.Security.NonceVerification.Missing,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	$serialized = isset( $_POST['form_data'] ) ? wp_unslash( $_POST['form_data'] ) : '';
	$form_data  = array();
	parse_str( is_string( $serialized ) ? $serialized : '', $form_data );
	$request = eum_normalize_export_request( $form_data );

	$request['post_types']     = array_map( 'sanitize_key', $request['post_types'] );
	$request['publish_status'] = array_map( 'sanitize_key', $request['publish_status'] );
	$request['post_types']     = array_values( array_intersect( $request['post_types'], array( 'page', 'post', 'product' ) ) );

	if ( empty( $request['publish_status'] ) ) {
		$request['publish_status'] = array( 'publish' );
	}

	if ( empty( $request['post_types'] ) && ! $request['include_wp_categories'] && ! $request['include_product_categories'] ) {
		wp_send_json_error( array( 'message' => 'Select at least one post type or category option.' ), 400 );
	}
	if ( $request['include_product_categories'] && ! class_exists( 'WooCommerce' ) ) {
		wp_send_json_error( array( 'message' => 'WooCommerce must be active to export product categories.' ), 400 );
	}
	if ( $request['include_product_categories'] && ! in_array( 'product', $request['post_types'], true ) ) {
		wp_send_json_error( array( 'message' => 'Select Products to export product categories.' ), 400 );
	}

	$seo_plugin = eum_detect_active_seo_plugin( false );
	if ( false === $seo_plugin ) {
		wp_send_json_error( array( 'message' => 'Multiple SEO plugins are active. Deactivate all but one before exporting.' ), 400 );
	}

	eum_cleanup_batch_export_files();
	$export_id = eum_create_export_session_id();
	$paths     = eum_get_export_manifest_paths( $export_id );
	$manifest  = eum_create_export_manifest( $request, $paths['manifest'] );
	if ( is_wp_error( $manifest ) ) {
		wp_send_json_error( array( 'message' => $manifest->get_error_message() ), 500 );
	}
	if ( 0 === $manifest['count'] ) {
		wp_delete_file( $paths['manifest'] );
		wp_send_json_error( array( 'message' => 'No items found for the selected criteria.' ), 404 );
	}

	$total  = $manifest['count'];
	$session   = array(
		'user_id'     => get_current_user_id(),
		'file_path'   => $paths['csv'],
		'manifest_path' => $paths['manifest'],
		'manifest_offset' => 0,
		'request'     => $request,
		'plugin_file' => $seo_plugin['plugin_file'],
		'processed'   => 0,
		'total'       => $total,
	);

	set_transient( $export_id, $session, $session['processed'] >= $session['total'] ? 10 * MINUTE_IN_SECONDS : HOUR_IN_SECONDS );

	update_option(
		'eum_export_settings',
		array(
			'post_types'                 => $request['post_types'],
			'include_homepage_latest'    => $request['include_homepage_latest'] ? 1 : 0,
			'include_wp_categories'      => $request['include_wp_categories'] ? 1 : 0,
			'include_product_categories' => $request['include_product_categories'] ? 1 : 0,
			'publish_status'             => $request['publish_status'],
			'include_character_count'    => $request['include_character_count'] ? 1 : 0,
		)
	);

	wp_send_json_success(
		array(
			'export_id'   => $export_id,
			'total_items' => $total,
		)
	);
}

/**
 * Create disk-backed manifest for one export.
 *
 * @param array  $request       Normalized request.
 * @param string $manifest_path Manifest path.
 * @return array|WP_Error Manifest count and bytes, or error.
 */
function eum_create_export_manifest( $request, $manifest_path ) {
	$handle = fopen( $manifest_path, 'wb' );
	if ( false === $handle ) {
		return new WP_Error( 'manifest_open_failed', 'Unable to create export manifest.' );
	}

	$result = array( 'count' => 0, 'bytes' => 0 );
	foreach ( $request['post_types'] as $post_type ) {
		$page = 1;
		while ( true ) {
			$query = new WP_Query(
				array(
					'post_type'      => $post_type,
					'post_status'    => $request['publish_status'],
					'posts_per_page' => 500,
					'paged'          => $page,
					'fields'         => 'ids',
					'no_found_rows'  => true,
				)
			);
			if ( empty( $query->posts ) ) {
				break;
			}
			$records = array();
			foreach ( $query->posts as $post_id ) {
				$records[] = array( 'type' => 'post', 'id' => (int) $post_id );
			}
			$written = eum_write_export_manifest_records( $handle, $records );
			if ( is_wp_error( $written ) ) {
				fclose( $handle );
				wp_delete_file( $manifest_path );
				return $written;
			}
			$result['count'] += $written['count'];
			$result['bytes'] += $written['bytes'];
			$page++;
		}
	}

	if ( $request['include_homepage_latest'] && 'posts' === get_option( 'show_on_front' ) ) {
		$written = eum_write_export_manifest_records( $handle, array( array( 'type' => 'homepage', 'id' => 0 ) ) );
		if ( is_wp_error( $written ) ) {
			fclose( $handle );
			wp_delete_file( $manifest_path );
			return $written;
		}
		$result['count'] += $written['count'];
		$result['bytes'] += $written['bytes'];
	}

	$term_sources = array();
	if ( $request['include_wp_categories'] ) {
		$term_sources[] = 'category';
	}
	if ( $request['include_product_categories'] && in_array( 'product', $request['post_types'], true ) && class_exists( 'WooCommerce' ) ) {
		$term_sources[] = 'product_cat';
	}
	foreach ( $term_sources as $taxonomy ) {
		$offset = 0;
		while ( true ) {
			$terms = get_terms( array( 'taxonomy' => $taxonomy, 'hide_empty' => false, 'number' => 500, 'offset' => $offset ) );
			if ( is_wp_error( $terms ) ) {
				fclose( $handle );
				wp_delete_file( $manifest_path );
				return $terms;
			}
			if ( empty( $terms ) ) {
				break;
			}
			$records = array();
			foreach ( $terms as $term ) {
				$records[] = array( 'type' => 'term', 'taxonomy' => $taxonomy, 'id' => (int) $term->term_id );
			}
			$written = eum_write_export_manifest_records( $handle, $records );
			if ( is_wp_error( $written ) ) {
				fclose( $handle );
				wp_delete_file( $manifest_path );
				return $written;
			}
			$result['count'] += $written['count'];
			$result['bytes'] += $written['bytes'];
			$offset += count( $terms );
		}
	}

	fclose( $handle );
	return $result;
}

/**
 * Process one batch of export items.
 *
 * @return void
 */
function eum_ajax_process_batch() {
	try {
		eum_process_batch_export_request();
	} catch ( Throwable $exception ) {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log -- Surface unexpected batch fatals when debugging.
			error_log( '[Export URLs and Meta] Uncaught batch error: ' . $exception->getMessage() );
		}
		if ( function_exists( 'eum_record_last_batch_failure' ) ) {
			eum_record_last_batch_failure( $exception->getMessage() );
		}
		wp_send_json_error(
			array(
				'message' => 'A critical error occurred while processing a batch: ' . $exception->getMessage(),
			),
			500
		);
	}
}

/**
 * Process one batch of export items.
 *
 * @return void
 */
function eum_process_batch_export_request() {
	eum_authorize_batch_request();

	// phpcs:ignore WordPress.Security.NonceVerification.Missing -- Verified in eum_authorize_batch_request().
	$export_id = isset( $_POST['export_id'] ) ? sanitize_text_field( wp_unslash( $_POST['export_id'] ) ) : '';
	$session   = get_transient( $export_id );
	if ( ! eum_export_session_user_can_access( $session, get_current_user_id() ) ) {
		wp_send_json_error( array( 'message' => 'Export session is invalid or expired.' ), 404 );
	}

	$lock_key   = '_eum_export_lock_' . $export_id;
	$lock       = get_option( $lock_key );
	$lock_token = eum_create_export_session_id();
	if ( is_array( $lock ) && (int) $lock['expires'] > time() ) {
		wp_send_json_error( array( 'message' => 'Export batch is already processing.' ), 409 );
	}
	if ( $lock ) {
		if ( ! eum_delete_batch_export_lock_value( $lock_key, $lock ) ) {
			wp_send_json_error( array( 'message' => 'Export batch is already processing.' ), 409 );
		}
	}
	$lock = array( 'token' => $lock_token, 'expires' => time() + 600 );
	if ( ! add_option( $lock_key, $lock, '', false ) ) {
		wp_send_json_error( array( 'message' => 'Export batch is already processing.' ), 409 );
	}

	$batch_size = max( 1, (int) apply_filters( 'eum_export_batch_size', 50 ) );
	$processed  = (int) $session['processed'];
	$handle     = fopen( $session['file_path'], 0 === $processed ? 'wb' : 'ab' );
	if ( false === $handle ) {
		eum_fail_batch_export( $export_id, $session, $lock_key, 'Unable to open export file.', $lock_token );
	}

	if ( 0 === $processed ) {
		if ( 3 !== fwrite( $handle, "\xEF\xBB\xBF" ) ) {
			fclose( $handle );
			eum_fail_batch_export( $export_id, $session, $lock_key, 'Unable to write export file.', $lock_token );
		}
		$headers = array( 'Page Title', 'URL', 'Meta Title', 'Meta Description', 'Type', 'Categories', 'Status' );
		if ( $session['request']['include_character_count'] ) {
			$headers[] = 'Meta Title Char. Count';
			$headers[] = 'Description Char. Count';
		}
		if ( false === fputcsv( $handle, $headers ) ) {
			fclose( $handle );
			eum_fail_batch_export( $export_id, $session, $lock_key, 'Unable to write export headers.', $lock_token );
		}
	}

	$batch = eum_get_batch_export_manifest_items( $session, $batch_size );
	if ( is_wp_error( $batch ) ) {
		fclose( $handle );
		eum_fail_batch_export( $export_id, $session, $lock_key, $batch->get_error_message(), $lock_token );
	}
	if ( empty( $batch['items'] ) && $processed < $session['total'] ) {
		fclose( $handle );
		eum_fail_batch_export( $export_id, $session, $lock_key, 'Unable to read the next export batch. Retry export.', $lock_token );
	}
	$row_index = 0;
	foreach ( $batch['items'] as $item ) {
		$row = eum_get_batch_export_row( $item, $session['plugin_file'], $session['request'] );
		if ( ! empty( $row ) ) {
			$row = array_map( 'eum_escape_csv_formula', $row );
			if ( false === fputcsv( $handle, $row ) ) {
				fclose( $handle );
				eum_fail_batch_export( $export_id, $session, $lock_key, 'Unable to write export row.', $lock_token );
			}
		}
		$row_index++;
		// Refresh periodically on large batches; avoid per-row CAS which false-fails under object caches.
		if ( 0 === $row_index % 25 && ! eum_refresh_batch_export_lock( $lock_key, $lock_token ) ) {
			fclose( $handle );
			eum_fail_batch_export( $export_id, $session, $lock_key, 'Export lock expired. Retry export.', $lock_token );
		}
	}
	if ( ! eum_refresh_batch_export_lock( $lock_key, $lock_token ) ) {
		fclose( $handle );
		eum_fail_batch_export( $export_id, $session, $lock_key, 'Export lock expired. Retry export.', $lock_token );
	}
	if ( get_transient( 'eum_export_cancel_' . $export_id ) ) {
		fclose( $handle );
		delete_transient( 'eum_export_cancel_' . $export_id );
		eum_fail_batch_export( $export_id, $session, $lock_key, 'Export cancelled.', $lock_token );
	}
	fclose( $handle );
	if ( get_transient( 'eum_export_cancel_' . $export_id ) ) {
		delete_transient( 'eum_export_cancel_' . $export_id );
		eum_fail_batch_export( $export_id, $session, $lock_key, 'Export cancelled.', $lock_token );
	}

	$session['manifest_offset'] = $batch['offset'];
	$session['processed']       = min( $session['total'], $processed + $batch['read'] );
	set_transient( $export_id, $session, HOUR_IN_SECONDS );
	eum_release_batch_export_lock( $lock_key, $lock_token );

	if ( $session['processed'] >= $session['total'] ) {
		wp_send_json_success( array( 'status' => 'complete', 'processed' => $session['total'], 'total' => $session['total'] ) );
	}

	wp_send_json_success( array( 'status' => 'processing', 'processed' => $session['processed'], 'total' => $session['total'] ) );
}

/**
 * Delete abandoned temporary export files.
 *
 * @return void
 */
function eum_cleanup_batch_export_files() {
	$files = glob( eum_get_export_storage_dir() . 'eum_export_*' );
	if ( ! is_array( $files ) ) {
		return;
	}

	foreach ( $files as $file ) {
		$export_id = eum_get_export_id_from_temp_filename( $file );
		$lock = null !== $export_id ? get_option( '_eum_export_lock_' . $export_id ) : false;
		if ( is_array( $lock ) && (int) $lock['expires'] > time() ) {
			continue;
		}
		if ( null !== $export_id && false === get_transient( $export_id ) && is_file( $file ) ) {
			wp_delete_file( $file );
		}
	}
}

/**
 * Refresh export lock only when current request owns it.
 *
 * @param string $lock_key   Lock option key.
 * @param string $lock_token Lock owner token.
 * @return bool Whether lock was refreshed.
 */
function eum_refresh_batch_export_lock( $lock_key, $lock_token ) {
	$lock = get_option( $lock_key );
	if ( ! is_array( $lock ) || empty( $lock['token'] ) || $lock['token'] !== $lock_token || (int) $lock['expires'] <= time() ) {
		return false;
	}

	$lock['expires'] = time() + 600;

	// Token ownership is already verified. Prefer update_option over SQL CAS: object caches
	// and serialized-value mismatches commonly make WHERE option_value = %s affect 0 rows.
	$updated = update_option( $lock_key, $lock, false );
	wp_cache_delete( $lock_key, 'options' );

	// update_option returns false when the value is unchanged; treat still-owned lock as success.
	if ( false === $updated ) {
		$current = get_option( $lock_key );
		return is_array( $current )
			&& isset( $current['token'] )
			&& $current['token'] === $lock_token
			&& (int) $current['expires'] > time();
	}

	return true;
}

/**
 * Release export lock only when current request owns it.
 *
 * @param string $lock_key   Lock option key.
 * @param string $lock_token Lock owner token.
 * @return void
 */
function eum_release_batch_export_lock( $lock_key, $lock_token ) {
	$lock = get_option( $lock_key );
	if ( is_array( $lock ) && isset( $lock['token'] ) && $lock['token'] === $lock_token ) {
		eum_delete_batch_export_lock_value( $lock_key, $lock );
	}
}

/**
 * Delete exact lock value atomically.
 *
 * @param string $lock_key Lock option key.
 * @param array  $lock     Lock value.
 * @return bool Whether lock was deleted.
 */
function eum_delete_batch_export_lock_value( $lock_key, $lock ) {
	global $wpdb;

	$deleted = $wpdb->query(
		$wpdb->prepare(
			"DELETE FROM {$wpdb->options} WHERE option_name = %s AND option_value = %s",
			$lock_key,
			maybe_serialize( $lock )
		)
	);
	wp_cache_delete( $lock_key, 'options' );
	return 1 === $deleted;
}

/**
 * Fail and remove batch export session.
 *
 * @param string $export_id Export ID.
 * @param array  $session   Export session.
 * @param string $lock_key  Lock option key.
 * @param string $message    Error message.
 * @param string $lock_token Lock owner token.
 * @return void
 */
function eum_fail_batch_export( $export_id, $session, $lock_key, $message, $lock_token = '' ) {
	if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
		// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log -- Intentional debug aid for batch failures.
		error_log( '[Export URLs and Meta] Batch export failed: ' . $message );
	}
	if ( function_exists( 'eum_record_last_batch_failure' ) ) {
		eum_record_last_batch_failure( $message );
	}

	if ( $lock_token ) {
		$lock = get_option( $lock_key );
		if ( ! is_array( $lock ) || empty( $lock['token'] ) || $lock['token'] !== $lock_token ) {
			wp_send_json_error( array( 'message' => 'Export lock lost. Retry export.' ), 409 );
		}
	}
	if ( is_file( $session['file_path'] ) ) {
		unlink( $session['file_path'] );
	}
	if ( ! empty( $session['manifest_path'] ) && is_file( $session['manifest_path'] ) ) {
		unlink( $session['manifest_path'] );
	}
	if ( $lock_token ) {
		eum_release_batch_export_lock( $lock_key, $lock_token );
	} else {
		delete_option( $lock_key );
	}
	delete_transient( $export_id );
	wp_send_json_error( array( 'message' => $message ), 500 );
}

/**
 * Read and resolve one manifest batch.
 *
 * @param array $session   Export session.
 * @param int   $batch_size Maximum records.
 * @return array|WP_Error Batch data, or error.
 */
function eum_get_batch_export_manifest_items( $session, $batch_size ) {
	$handle = fopen( $session['manifest_path'], 'rb' );
	if ( false === $handle ) {
		return new WP_Error( 'manifest_open_failed', 'Unable to open export manifest.' );
	}

	$manifest = eum_read_export_manifest_batch( $handle, $session['manifest_offset'], $batch_size );
	fclose( $handle );
	if ( is_wp_error( $manifest ) ) {
		return $manifest;
	}

	$items = array();
	foreach ( $manifest['records'] as $record ) {
		if ( 'post' === $record['type'] ) {
			$items[] = array( 'type' => 'post', 'object' => get_post( $record['id'] ) );
		} elseif ( 'term' === $record['type'] ) {
			$items[] = array(
				'type'     => 'term',
				'taxonomy' => $record['taxonomy'],
				'object'   => get_term( $record['id'], $record['taxonomy'] ),
			);
		} elseif ( 'homepage' === $record['type'] ) {
			$items[] = array( 'type' => 'homepage' );
		}
	}

	return array(
		'items'  => $items,
		'read'   => count( $manifest['records'] ),
		'offset' => $manifest['offset'],
	);
}

/**
 * Build one CSV row.
 *
 * @param array       $item        Export item.
 * @param string|false $plugin_file SEO plugin file.
 * @param array       $request     Export request.
 * @return array CSV row.
 */
function eum_get_batch_export_row( $item, $plugin_file, $request ) {
	$character_count = ! empty( $request['include_character_count'] );
	if ( 'post' === $item['type'] ) {
		$post      = $item['object'];
		if ( ! $post instanceof WP_Post ) {
			return array();
		}
		$meta      = eum_get_post_meta( $post, $plugin_file );
		$type      = get_post_type_object( $post->post_type );
		$categories = '';
		$taxonomy  = 'post' === $post->post_type ? 'category' : ( 'product' === $post->post_type ? 'product_cat' : '' );
		if ( $taxonomy ) {
			$terms = wp_get_post_terms( $post->ID, $taxonomy, array( 'fields' => 'names' ) );
			$categories = ! is_wp_error( $terms ) ? implode( ', ', $terms ) : '';
		}
		$status_object = get_post_status_object( $post->post_status );
		$status_label  = $status_object ? $status_object->label : $post->post_status;
		$row = array( get_the_title( $post ), get_permalink( $post ), $meta['title'], $meta['desc'], $type ? $type->labels->singular_name : $post->post_type, $categories, $status_label );
	} elseif ( 'term' === $item['type'] ) {
		$term = $item['object'];
		if ( ! $term instanceof WP_Term ) {
			return array();
		}
		$meta = eum_get_term_meta( $term, $plugin_file, $item['taxonomy'] );
		$url  = get_term_link( $term );
		$url  = is_wp_error( $url ) ? '' : $url;
		$type       = 'product_cat' === $item['taxonomy'] ? 'Product Category' : 'Post Category';
		$categories = 'product_cat' === $item['taxonomy'] ? $term->name : '';
		$row        = array( $term->name, $url, $meta['title'], $meta['desc'], $type, $categories, 'Published' );
	} elseif ( 'homepage' === $item['type'] ) {
		$meta = eum_get_homepage_meta( $plugin_file );
		$row  = array( 'Homepage', home_url( '/' ), $meta['title'], $meta['desc'], 'Front Page', '', 'Published' );
	} else {
		return array();
	}

	if ( $character_count ) {
		$row[] = strlen( (string) $row[2] );
		$row[] = strlen( (string) $row[3] );
	}

	return $row;
}

/**
 * Stream and delete completed export.
 *
 * @return void
 */
function eum_ajax_download_file() {
	eum_authorize_batch_request();

	$export_id = isset( $_GET['export_id'] ) ? sanitize_text_field( wp_unslash( $_GET['export_id'] ) ) : '';
	$session   = get_transient( $export_id );
	if ( ! eum_export_session_user_can_access( $session, get_current_user_id() ) || ! is_file( $session['file_path'] ) ) {
		wp_send_json_error( array( 'message' => 'Export file is invalid or expired.' ), 404 );
	}
	if ( (int) $session['processed'] < (int) $session['total'] ) {
		wp_send_json_error( array( 'message' => 'Export is still processing.' ), 409 );
	}
	$lock_key   = '_eum_export_lock_' . $export_id;
	$lock_token = eum_create_export_session_id();
	$existing_lock = get_option( $lock_key );
	if ( is_array( $existing_lock ) && (int) $existing_lock['expires'] <= time() && ! eum_delete_batch_export_lock_value( $lock_key, $existing_lock ) ) {
		wp_send_json_error( array( 'message' => 'Export lock changed. Retry download.' ), 409 );
	}
	if ( ! add_option( $lock_key, array( 'token' => $lock_token, 'expires' => time() + 600 ), '', false ) ) {
		wp_send_json_error( array( 'message' => 'Export is already being downloaded.' ), 409 );
	}
	if ( ! is_readable( $session['file_path'] ) ) {
		eum_release_batch_export_lock( $lock_key, $lock_token );
		wp_send_json_error( array( 'message' => 'Unable to read export file.' ), 500 );
	}
	$download_handle = fopen( $session['file_path'], 'rb' );
	if ( false === $download_handle || ! flock( $download_handle, LOCK_EX ) ) {
		if ( is_resource( $download_handle ) ) {
			fclose( $download_handle );
		}
		eum_release_batch_export_lock( $lock_key, $lock_token );
		wp_send_json_error( array( 'message' => 'Unable to lock export file.' ), 500 );
	}

	$filename = eum_generate_csv_filename();
	header( 'Content-Type: text/csv; charset=UTF-8' );
	header( 'Content-Disposition: attachment; filename="' . sanitize_file_name( $filename ) . '"' );
	header( 'Cache-Control: no-store, no-cache, must-revalidate, max-age=0' );
	header( 'Pragma: no-cache' );
	header( 'Content-Length: ' . filesize( $session['file_path'] ) );
	if ( false === fpassthru( $download_handle ) ) {
		flock( $download_handle, LOCK_UN );
		fclose( $download_handle );
		eum_release_batch_export_lock( $lock_key, $lock_token );
		exit;
	}
	flock( $download_handle, LOCK_UN );
	fclose( $download_handle );
	if ( ! unlink( $session['file_path'] ) ) {
		eum_release_batch_export_lock( $lock_key, $lock_token );
		exit;
	}
	if ( ! empty( $session['manifest_path'] ) && is_file( $session['manifest_path'] ) ) {
		unlink( $session['manifest_path'] );
	}
	delete_transient( $export_id );
	eum_release_batch_export_lock( $lock_key, $lock_token );
	exit;
}

/**
 * Cancel and delete export session.
 *
 * @return void
 */
function eum_ajax_cancel_export() {
	eum_authorize_batch_request();

	// phpcs:ignore WordPress.Security.NonceVerification.Missing -- Verified in eum_authorize_batch_request().
	$export_id = isset( $_POST['export_id'] ) ? sanitize_text_field( wp_unslash( $_POST['export_id'] ) ) : '';
	$session   = get_transient( $export_id );
	if ( ! eum_export_session_user_can_access( $session, get_current_user_id() ) ) {
		wp_send_json_error( array( 'message' => 'Export session is invalid or expired.' ), 404 );
	}

	$lock_key = '_eum_export_lock_' . $export_id;
	$lock     = get_option( $lock_key );
	if ( is_array( $lock ) && (int) $lock['expires'] > time() ) {
		set_transient( 'eum_export_cancel_' . $export_id, get_current_user_id(), 120 );
		wp_send_json_success( array( 'message' => 'Export cancellation requested.' ) );
	}
	if ( $lock ) {
		if ( ! eum_delete_batch_export_lock_value( $lock_key, $lock ) ) {
			wp_send_json_error( array( 'message' => 'Export batch is currently processing.' ), 409 );
		}
	}
	$lock_token = eum_create_export_session_id();
	if ( ! add_option( $lock_key, array( 'token' => $lock_token, 'expires' => time() + 600 ), '', false ) ) {
		wp_send_json_error( array( 'message' => 'Export batch is currently processing.' ), 409 );
	}

	if ( is_file( $session['file_path'] ) ) {
		unlink( $session['file_path'] );
	}
	if ( ! empty( $session['manifest_path'] ) && is_file( $session['manifest_path'] ) ) {
		unlink( $session['manifest_path'] );
	}
	delete_transient( $export_id );
	eum_release_batch_export_lock( $lock_key, $lock_token );
	wp_send_json_success( array( 'message' => 'Export cancelled.' ) );
}
