<?php
/**
 * Normalize export request values shared by form and AJAX handlers.
 *
 * @package ExportUrlsAndMeta
 */

if ( ! defined( 'ABSPATH' ) && ! defined( 'PHPUNIT_COMPOSER_INSTALL' ) ) {
	exit;
}

/**
 * Normalize export request values.
 *
 * @param array $form_data Raw form values.
 * @return array Normalized export request.
 */
function eum_normalize_export_request( $form_data ) {
	$form_data = is_array( $form_data ) ? $form_data : array();

	return array(
		'post_types'                 => isset( $form_data['eum_post_types'] ) ? array_values( (array) $form_data['eum_post_types'] ) : array(),
		'include_homepage_latest'    => eum_export_request_flag_enabled( $form_data, 'include_homepage_latest' ),
		'include_wp_categories'      => eum_export_request_flag_enabled( $form_data, 'eum_include_wp_categories' ),
		'include_product_categories' => eum_export_request_flag_enabled( $form_data, 'eum_include_product_categories' ),
		'publish_status'             => ! empty( $form_data['eum_publish_status'] ) ? array_values( (array) $form_data['eum_publish_status'] ) : array( 'publish' ),
		'include_character_count'    => eum_export_request_flag_enabled( $form_data, 'eum_character_count' ),
	);
}

/**
 * Check whether form flag is enabled.
 *
 * @param array  $form_data Form values.
 * @param string $key       Form field name.
 * @return bool Whether flag is enabled.
 */
function eum_export_request_flag_enabled( $form_data, $key ) {
	return isset( $form_data[ $key ] ) && in_array( (string) $form_data[ $key ], array( '1', 'on', 'true' ), true );
}
