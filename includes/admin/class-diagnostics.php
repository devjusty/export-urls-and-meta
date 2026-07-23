<?php
/**
 * Diagnostics page for maintainers.
 *
 * @package ExportUrlsAndMeta
 */

if ( ! defined( 'ABSPATH' ) && ! defined( 'PHPUNIT_COMPOSER_INSTALL' ) ) {
	exit;
}

/**
 * Get metadata sources shown on diagnostics page.
 *
 * @param string|false $plugin_file Detected plugin file.
 * @param string       $state       Detection state.
 * @return array Diagnostics source data.
 */
function eum_get_diagnostics_sources( $plugin_file, $state = 'none' ) {
	$sources = array(
		'posts'    => array( 'title' => '', 'desc' => '', 'notes' => '' ),
		'terms'    => array( 'title' => '', 'desc' => '', 'notes' => '' ),
		'homepage' => array( 'source' => '', 'notes' => '' ),
	);

	switch ( $plugin_file ) {
		case 'wordpress-seo/wp-seo.php':
			$sources['posts'] = array(
				'title' => '_yoast_wpseo_title',
				'desc'  => '_yoast_wpseo_metadesc',
				'notes' => 'Uses wpseo_replace_vars',
			);
			$sources['terms'] = array(
				'title' => '_yoast_wpseo_title',
				'desc'  => '_yoast_wpseo_metadesc',
				'notes' => 'Uses wpseo_replace_vars when available',
			);
			$sources['homepage'] = array(
				'source' => "get_option('wpseo_titles')['title-home'|'metadesc-home']",
				'notes'  => '',
			);
			break;
		case 'seo-by-rank-math/rank-math.php':
			$sources['posts'] = array(
				'title' => 'rank_math_title',
				'desc'  => 'rank_math_description',
				'notes' => '',
			);
			$sources['terms'] = $sources['posts'];
			$sources['homepage'] = array(
				'source' => "get_option('rank_math_titles_homepage_*')",
				'notes'  => '',
			);
			break;
		case 'wp-seopress/seopress.php':
			$sources['posts'] = array(
				'title' => '_seopress_titles_title',
				'desc'  => '_seopress_titles_desc',
				'notes' => '',
			);
			$sources['terms'] = array(
				'title' => '_seopress_titles_title_term',
				'desc'  => '_seopress_titles_desc_term',
				'notes' => '',
			);
			$sources['homepage'] = array(
				'source' => 'n/a',
				'notes'  => 'Homepage source is not currently exported',
			);
			break;
		case 'aioseo/aioseo.php':
		case 'all-in-one-seo-pack/all_in_one_seo_pack.php':
			$sources['posts'] = array(
				'title' => '_aioseo_title or legacy _aioseop_title',
				'desc'  => '_aioseo_description or legacy _aioseop_description',
				'notes' => 'Also checks _aioseo composite metadata',
			);
			$sources['terms'] = $sources['posts'];
			$sources['homepage'] = array(
				'source' => "get_option('aioseo_options')['searchAppearance']['homePage'] or ['global']['siteTitle'|'metaDescription']",
				'notes'  => 'Custom homepage values take precedence',
			);
			break;
		case 'autodescription/autodescription.php':
			$sources['posts'] = array(
				'title' => 'TSF API title()->get_post_title()',
				'desc'  => 'TSF API description()->get_post_description()',
				'notes' => 'Current exporter uses generic fallback metadata',
			);
			$sources['terms'] = array(
				'title' => 'Generic term title fallback',
				'desc'  => 'Term description',
				'notes' => 'TSF API is not currently called',
			);
			$sources['homepage'] = array(
				'source' => 'Site name and generic fallback',
				'notes'  => 'TSF API is not currently called',
			);
			break;
		default:
			$sources['posts'] = array(
				'title' => 'n/a',
				'desc'  => 'n/a',
				'notes' => 'multiple' === $state ? 'Multiple SEO plugins detected' : 'No SEO plugin detected',
			);
			$sources['terms'] = $sources['posts'];
			$sources['homepage'] = array(
				'source' => 'n/a',
				'notes'  => '',
			);
	}

	return $sources;
}

/**
 * Render diagnostics page.
 *
 * @return void
 */
function eum_render_diagnostics_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$detected    = eum_detect_active_seo_plugin();
	$plugin_file = is_array( $detected ) ? $detected['plugin_file'] : false;
	$plugin_name = is_array( $detected ) ? $detected['plugin_name'] : 'Multiple plugins';
	$state       = false === $detected ? 'multiple' : 'none';
	$sources     = eum_get_diagnostics_sources( $plugin_file, $state );
	$upload_dir  = wp_upload_dir();
	$basedir     = isset( $upload_dir['basedir'] ) ? $upload_dir['basedir'] : '';
	$computed    = function_exists( 'eum_get_homepage_meta' ) ? eum_get_homepage_meta( $plugin_file ) : array( 'title' => '', 'desc' => '' );
	$batch_size  = apply_filters( 'eum_export_batch_size', 50 );
	?>
	<div class="wrap">
		<h1><?php echo esc_html__( 'Export URLs and Meta - Diagnostics', 'export-urls-and-meta' ); ?></h1>

		<h2><?php echo esc_html__( 'Detection', 'export-urls-and-meta' ); ?></h2>
		<table class="widefat striped">
			<tbody>
				<tr>
					<th scope="row"><?php echo esc_html__( 'Detected SEO Plugin', 'export-urls-and-meta' ); ?></th>
					<td><?php echo esc_html( $plugin_name ); ?> (<?php echo esc_html( $plugin_file ? $plugin_file : '' ); ?>)</td>
				</tr>
				<tr>
					<th scope="row">wpseo_replace_vars()</th>
					<td><?php echo function_exists( 'wpseo_replace_vars' ) ? esc_html__( 'Yes', 'export-urls-and-meta' ) : esc_html__( 'No', 'export-urls-and-meta' ); ?></td>
				</tr>
				<tr>
					<th scope="row">the_seo_framework()</th>
					<td><?php echo function_exists( 'the_seo_framework' ) ? esc_html__( 'Yes', 'export-urls-and-meta' ) : esc_html__( 'No', 'export-urls-and-meta' ); ?></td>
				</tr>
			</tbody>
		</table>

		<h2><?php echo esc_html__( 'Metadata Sources', 'export-urls-and-meta' ); ?></h2>
		<table class="widefat striped">
			<thead>
				<tr>
					<th><?php echo esc_html__( 'Entity', 'export-urls-and-meta' ); ?></th>
					<th><?php echo esc_html__( 'Title Source', 'export-urls-and-meta' ); ?></th>
					<th><?php echo esc_html__( 'Description Source', 'export-urls-and-meta' ); ?></th>
					<th><?php echo esc_html__( 'Notes', 'export-urls-and-meta' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr><td><?php echo esc_html__( 'Posts', 'export-urls-and-meta' ); ?></td><td><?php echo esc_html( $sources['posts']['title'] ); ?></td><td><?php echo esc_html( $sources['posts']['desc'] ); ?></td><td><?php echo esc_html( $sources['posts']['notes'] ); ?></td></tr>
				<tr><td><?php echo esc_html__( 'Terms', 'export-urls-and-meta' ); ?></td><td><?php echo esc_html( $sources['terms']['title'] ); ?></td><td><?php echo esc_html( $sources['terms']['desc'] ); ?></td><td><?php echo esc_html( $sources['terms']['notes'] ); ?></td></tr>
				<tr><td><?php echo esc_html__( 'Homepage', 'export-urls-and-meta' ); ?></td><td colspan="2"><?php echo esc_html( $sources['homepage']['source'] ); ?></td><td><?php echo esc_html( $sources['homepage']['notes'] ); ?></td></tr>
			</tbody>
		</table>

		<h2><?php echo esc_html__( 'Computed Homepage', 'export-urls-and-meta' ); ?></h2>
		<table class="widefat striped">
			<tbody>
				<tr><th scope="row"><?php echo esc_html__( 'Title', 'export-urls-and-meta' ); ?></th><td><?php echo esc_html( $computed['title'] ); ?></td></tr>
				<tr><th scope="row"><?php echo esc_html__( 'Description', 'export-urls-and-meta' ); ?></th><td><?php echo esc_html( $computed['desc'] ); ?></td></tr>
			</tbody>
		</table>

		<h2><?php echo esc_html__( 'Environment', 'export-urls-and-meta' ); ?></h2>
		<table class="widefat striped">
			<tbody>
				<tr><th scope="row"><?php echo esc_html__( 'Uploads Base Directory', 'export-urls-and-meta' ); ?></th><td><?php echo esc_html( $basedir ? 'Configured' : 'Unavailable' ); ?></td></tr>
				<tr><th scope="row"><?php echo esc_html__( 'Uploads Writable', 'export-urls-and-meta' ); ?></th><td><?php echo esc_html( $basedir && is_writable( $basedir ) ? 'Yes' : 'No' ); ?></td></tr>
				<tr><th scope="row"><?php echo esc_html__( 'Batch Size', 'export-urls-and-meta' ); ?></th><td><?php echo esc_html( (string) (int) $batch_size ); ?></td></tr>
				<tr><th scope="row">WP_DEBUG</th><td><?php echo defined( 'WP_DEBUG' ) && WP_DEBUG ? esc_html__( 'Yes', 'export-urls-and-meta' ) : esc_html__( 'No', 'export-urls-and-meta' ); ?></td></tr>
				<tr><th scope="row">WP_DEBUG_LOG</th><td><?php echo defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG ? esc_html__( 'Yes', 'export-urls-and-meta' ) : esc_html__( 'No', 'export-urls-and-meta' ); ?></td></tr>
			</tbody>
		</table>
	</div>
	<?php
}
