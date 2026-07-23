<?php
/**
 * SEO plugin detection helpers.
 *
 * @package ExportUrlsAndMeta
 */

if ( ! defined( 'ABSPATH' ) && ! defined( 'PHPUNIT_COMPOSER_INSTALL' ) ) {
	exit;
}

/**
 * Detect supported SEO plugin from active plugin paths.
 *
 * @param array $active_plugins Active plugin paths.
 * @return array|false Plugin data, or false when multiple plugins are active.
 */
function eum_detect_seo_plugin_from_active_plugins( $active_plugins ) {
	$definitions = array(
		'wordpress-seo/wp-seo.php'                         => 'Yoast SEO',
		'all-in-one-seo-pack/all_in_one_seo_pack.php'      => 'All in One SEO Pack',
		'aioseo/aioseo.php'                                => 'All in One SEO',
		'autodescription/autodescription.php'              => 'The SEO Framework',
		'seo-by-rank-math/rank-math.php'                   => 'Rank Math',
		'wp-seopress/seopress.php'                         => 'SEOPress',
	);

	$active_plugins = is_array( $active_plugins ) ? $active_plugins : array();
	$active_seo_plugins = array();

	foreach ( $definitions as $plugin_file => $plugin_name ) {
		if ( in_array( $plugin_file, $active_plugins, true ) ) {
			$active_seo_plugins[ $plugin_file ] = $plugin_name;
		}
	}

	if ( count( $active_seo_plugins ) > 1 ) {
		return false;
	}

	if ( empty( $active_seo_plugins ) ) {
		return array(
			'plugin_file' => false,
			'plugin_name' => 'None',
		);
	}

	$plugin_file = array_keys( $active_seo_plugins )[0];

	return array(
		'plugin_file' => $plugin_file,
		'plugin_name' => $active_seo_plugins[ $plugin_file ],
	);
}
