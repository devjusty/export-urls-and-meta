<?php
/**
 * SEO metadata helpers.
 *
 * @package ExportUrlsAndMeta
 */

if ( ! defined( 'ABSPATH' ) && ! defined( 'PHPUNIT_COMPOSER_INSTALL' ) ) {
	exit;
}

/**
 * Extract title and description from AIOSEO metadata.
 *
 * @param mixed  $stored_metadata Stored metadata array or JSON string.
 * @param string $fallback_title Legacy title value.
 * @param string $fallback_desc  Legacy description value.
 * @return array Normalized metadata values.
 */
function eum_extract_aioseo_meta( $stored_metadata, $fallback_title = '', $fallback_desc = '' ) {
	if ( is_string( $stored_metadata ) ) {
		$decoded = json_decode( $stored_metadata, true );
		$stored_metadata = JSON_ERROR_NONE === json_last_error() ? $decoded : array();
	}

	if ( ! is_array( $stored_metadata ) ) {
		$stored_metadata = array();
	}

	return array(
		'title'       => ! empty( $stored_metadata['title'] ) ? (string) $stored_metadata['title'] : (string) $fallback_title,
		'description' => ! empty( $stored_metadata['description'] ) ? (string) $stored_metadata['description'] : (string) $fallback_desc,
	);
}

/**
 * Extract homepage metadata from AIOSEO options.
 *
 * @param mixed $options AIOSEO options array.
 * @return array Normalized homepage metadata.
 */
function eum_extract_aioseo_homepage_meta( $options ) {
	$options  = is_array( $options ) ? $options : array();
	$homepage = $options['searchAppearance']['homePage'] ?? array();
	$global   = $options['searchAppearance']['global'] ?? array();
	$title    = ! empty( $homepage['title'] ) ? $homepage['title'] : ( $global['siteTitle'] ?? ( $options['home_title'] ?? '' ) );
	$desc     = ! empty( $homepage['metaDescription'] ) ? $homepage['metaDescription'] : ( $global['metaDescription'] ?? ( $options['home_description'] ?? '' ) );

	return array(
		'title'       => (string) $title,
		'description' => (string) $desc,
	);
}
