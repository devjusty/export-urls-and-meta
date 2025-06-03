<?php
/**
 * SEO plugin integration.
 *
 * @since      0.1.0
 * @package    ExportUrlsAndMeta
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * SEO Integration class.
 */
class Export_Urls_And_Meta_SEO_Integration {

	/**
	 * The active SEO plugin data.
	 *
	 * @since 0.1.0
	 * @var array|false
	 */
	private $active_plugin = false;

	/**
	 * Initialize the SEO integration.
	 *
	 * @since 0.1.0
	 */
	public function __construct() {
		$this->detect_active_seo_plugin();
	}

	/**
	 * Detect active SEO plugin.
	 *
	 * @since 0.1.0
	 * @return array|WP_Error Array of active SEO plugin data or WP_Error if multiple SEO plugins are active.
	 */
	public function detect_active_seo_plugin() {
		if ( false !== $this->active_plugin ) {
			return $this->active_plugin;
		}

		$seo_plugins = array(
			'wordpress-seo/wp-seo.php'           => 'Yoast SEO',
			'all-in-one-seo-pack/all_in_one_seo_pack.php' => 'All in One SEO Pack',
			'autodescription/autodescription.php' => 'The SEO Framework',
			'seo-by-rank-math/rank-math.php'     => 'Rank Math',
			'wp-seopress/seopress.php'           => 'SEOPress',
		);

		$active_plugins = get_option( 'active_plugins', array() );
		$active_seo_plugins = array();

		foreach ( $seo_plugins as $plugin_file => $plugin_name ) {
			if ( in_array( $plugin_file, $active_plugins, true ) ) {
				$active_seo_plugins[ $plugin_file ] = $plugin_name;
			}
		}

		if ( count( $active_seo_plugins ) > 1 ) {
			$this->active_plugin = new WP_Error(
				'multiple_seo_plugins',
				sprintf(
					/* translators: %s: List of active SEO plugins */
					__( 'Multiple SEO plugins are active: %s. Please deactivate all but one SEO plugin to ensure compatibility.', 'export-urls-and-meta' ),
					implode( ', ', $active_seo_plugins )
				)
			);
			return $this->active_plugin;
		}

		if ( empty( $active_seo_plugins ) ) {
			$this->active_plugin = array(
				'plugin_file' => false,
				'plugin_name' => __( 'None', 'export-urls-and-meta' ),
			);
		} else {
			$plugin_file = array_keys( $active_seo_plugins )[0];
			$this->active_plugin = array(
				'plugin_file' => $plugin_file,
				'plugin_name' => $active_seo_plugins[ $plugin_file ],
			);
		}

		return $this->active_plugin;
	}

	/**
	 * Get meta description for a post.
	 *
	 * @since 0.1.0
	 *
	 * @param int $post_id Post ID.
	 * @return string Meta description.
	 */
	public function get_post_meta_description( $post_id ) {
		// Handle homepage for latest posts
		if ( $post_id === 0 || ( is_numeric( $post_id ) && 'home' === get_post_type( $post_id ) ) ) {
			$seo_plugin = $this->detect_active_seo_plugin();
			
			if ( 'wordpress-seo/wp-seo.php' === $seo_plugin['plugin_file'] ) {
				// Get Yoast front page description
				$yoast_titles = get_option( 'wpseo_titles' );
				if ( ! empty( $yoast_titles['metadesc-home-wpseo'] ) ) {
					// Replace Yoast variables
					$description = $yoast_titles['metadesc-home-wpseo'];
					$description = str_replace( '%%sitename%%', get_bloginfo( 'name' ), $description );
					$description = str_replace( '%%sitedesc%%', get_bloginfo( 'description' ), $description );
					$description = str_replace( '%%sep%%', '|', $description );
					return $description;
				}
			} elseif ( 'seo-by-rank-math/rank-math.php' === $seo_plugin['plugin_file'] ) {
				// Get Rank Math front page description
				$rank_math = get_option( 'rank_math_options' );
				if ( ! empty( $rank_math['titles_pt_archive_post'] ) ) {
					return $rank_math['titles_pt_archive_post'];
				}
			}
			return get_bloginfo( 'description' );
		}

		$seo_plugin = $this->detect_active_seo_plugin();

		if ( is_wp_error( $seo_plugin ) || ! $seo_plugin['plugin_file'] ) {
			return '';
		}

		switch ( $seo_plugin['plugin_file'] ) {
			case 'wordpress-seo/wp-seo.php':
				// Yoast SEO
				$description = get_post_meta( $post_id, '_yoast_wpseo_metadesc', true );
				
				// If no custom meta description, try to generate one from excerpt or content
				if ( empty( $description ) ) {
					$post = get_post( $post_id );
					
					// First try the excerpt
					if ( ! empty( $post->post_excerpt ) ) {
						$description = $post->post_excerpt;
					} 
					// Then try to generate from content
					else if ( ! empty( $post->post_content ) ) {
						$description = wp_trim_words( strip_shortcodes( strip_tags( $post->post_content ) ), 30 );
					}
				}
				
				return $description;

			case 'seo-by-rank-math/rank-math.php':
				// Rank Math
				$description = get_post_meta( $post_id, 'rank_math_description', true );
				
				// If no custom description is set, get the default format
				if ( empty( $description ) ) {
					$post = get_post( $post_id );
					$post_type = $post->post_type;
					
					// Get the default format for this post type
					$default_format = get_option( "rank_math_pt_{$post_type}_description" );
					
					// Fallback to global default if no post type specific format
					if ( empty( $default_format ) ) {
						$default_format = get_option( 'rank_math_global_description' );
					}
					
					// If we have a format, replace placeholders
					if ( ! empty( $default_format ) ) {
						$description = $this->replace_rank_math_placeholders( $default_format, $post );
					}
				}
				
				// If still no description, use the post excerpt
				if ( empty( $description ) ) {
					$post = get_post( $post_id );
					$description = has_excerpt( $post ) ? get_the_excerpt( $post ) : '';
				}
				
				return $description;

			// Add more SEO plugins as needed

			default:
				return '';
		}
	}

	/**
	 * Get meta title for a post.
	 *
	 * @since 0.1.0
	 *
	 * @param int $post_id Post ID.
	 * @return string Meta title.
	 */
	public function get_post_meta_title( $post_id ) {
		// Handle homepage for latest posts
		if ( $post_id === 0 || ( is_numeric( $post_id ) && 'home' === get_post_type( $post_id ) ) ) {
			$seo_plugin = $this->detect_active_seo_plugin();
			
			if ( 'wordpress-seo/wp-seo.php' === $seo_plugin['plugin_file'] ) {
				// Get Yoast front page title
				$yoast_titles = get_option( 'wpseo_titles' );
				if ( ! empty( $yoast_titles['title-home-wpseo'] ) ) {
					// Replace Yoast variables
					$title = $yoast_titles['title-home-wpseo'];
					$title = str_replace( '%%sitename%%', get_bloginfo( 'name' ), $title );
					$title = str_replace( '%%sitedesc%%', get_bloginfo( 'description' ), $title );
					$title = str_replace( '%%page%%', '', $title );
					$title = str_replace( '%%sep%%', '|', $title );
					$title = str_replace( '  ', ' ', $title ); // Clean up double spaces
					$title = trim( $title, ' |' ); // Clean up leading/trailing separators
					
					// If no title after replacements, use site name
					if ( empty( $title ) ) {
						return get_bloginfo( 'name' );
					}
					return $title;
				}
			} elseif ( 'seo-by-rank-math/rank-math.php' === $seo_plugin['plugin_file'] ) {
				// Get Rank Math front page title
				$title = get_option( 'rank_math_options' );
				if ( ! empty( $title['titles_pt_archive_post'] ) ) {
					return $title['titles_pt_archive_post'];
				}
			}
			return get_bloginfo( 'name' );
		}

		$seo_plugin = $this->detect_active_seo_plugin();

		if ( is_wp_error( $seo_plugin ) || ! $seo_plugin['plugin_file'] ) {
			return '';
		}

		switch ( $seo_plugin['plugin_file'] ) {
			case 'wordpress-seo/wp-seo.php':
				// Yoast SEO
				$title = get_post_meta( $post_id, '_yoast_wpseo_title', true );
				
				// If no custom title, use post title with site name
				if ( empty( $title ) ) {
					$post = get_post( $post_id );
					$title = get_the_title( $post_id );
					
					// Add site name if it's not already in the title
					$site_name = get_bloginfo( 'name' );
					if ( ! empty( $site_name ) && strpos( $title, $site_name ) === false ) {
						$title = $title . ' | ' . $site_name;
					}
				}
				
				return $title;

			case 'seo-by-rank-math/rank-math.php':
				// Rank Math
				$title = get_post_meta( $post_id, 'rank_math_title', true );
				
				// If no custom title is set, get the default format
				if ( empty( $title ) ) {
					$post = get_post( $post_id );
					$post_type = $post->post_type;
					
					// Get the default format for this post type
					$default_format = get_option( "rank_math_pt_{$post_type}_title" );
					
					// Fallback to global default if no post type specific format
					if ( empty( $default_format ) ) {
						$default_format = get_option( 'rank_math_global_title' );
					}
					
					// If we have a format, replace placeholders
					if ( ! empty( $default_format ) ) {
						$title = $this->replace_rank_math_placeholders( $default_format, $post );
					}
				}
				
				// If still no title, use the post title
				if ( empty( $title ) ) {
					$title = get_the_title( $post_id );
				}
				
				return $title;

			// Add more SEO plugins as needed.

			default:
				return '';
		}
	}

	/**
	 * Replace Rank Math placeholders in a string.
	 *
	 * @since 0.1.0
	 *
	 * @param string $string The string to replace placeholders in.
	 * @param WP_Post $post The post object.
	 * @return string The string with placeholders replaced.
	 */
	private function replace_rank_math_placeholders( $string, $post ) {
		// Get post data
		$post_id = $post->ID;
		$post_type = $post->post_type;
		$post_title = get_the_title( $post_id );
		
		// Basic replacements
		$replacements = array(
			'%title%' => $post_title,
			'%postname%' => $post->post_name,
			'%excerpt%' => has_excerpt( $post_id ) ? get_the_excerpt( $post ) : '',
			'%excerpt_only%' => has_excerpt( $post_id ) ? get_the_excerpt( $post ) : '',
			'%date%' => get_the_date( '', $post ),
			'%modified%' => get_the_modified_date( '', $post ),
			'%currentdate%' => date_i18n( get_option( 'date_format' ) ),
			'%currenttime%' => date_i18n( get_option( 'time_format' ) ),
			'%sitename%' => get_bloginfo( 'name' ),
			'%sitedesc%' => get_bloginfo( 'description' ),
		);

		// Handle categories and tags
		$categories = get_the_terms( $post_id, 'category' );
		$category = ! empty( $categories ) ? $categories[0]->name : '';
		$tags = get_the_terms( $post_id, 'post_tag' );
		$tag = ! empty( $tags ) ? $tags[0]->name : '';

		$replacements['%category%'] = $category;
		$replacements['%category_description%'] = ! empty( $categories[0] ) ? $categories[0]->description : '';
		$replacements['%tag%'] = $tag;
		$replacements['%tag_description%'] = ! empty( $tags[0] ) ? $tags[0]->description : '';

		// Handle custom taxonomies
		$taxonomies = get_object_taxonomies( $post_type, 'objects' );
		foreach ( $taxonomies as $taxonomy ) {
			if ( 'post_format' === $taxonomy->name ) {
				continue;
			}
			$terms = get_the_terms( $post_id, $taxonomy->name );
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				$term = $terms[0];
				$replacements[ "%{$taxonomy->name}%" ] = $term->name;
				$replacements[ "%{$taxonomy->name}_description%" ] = $term->description;
			}
		}

		// Handle author data
		$author_id = $post->post_author;
		$author = get_userdata( $author_id );
		if ( $author ) {
			$replacements['%name%'] = $author->display_name;
			$replacements['%userid%'] = $author_id;
			$replacements['%user_description%'] = get_the_author_meta( 'description', $author_id );
		}

		// Handle custom fields
		if ( preg_match_all( '/%cf_([^%]*)%/', $string, $matches ) ) {
			foreach ( $matches[1] as $field ) {
				$custom_field = get_post_meta( $post_id, $field, true );
				if ( ! empty( $custom_field ) ) {
					$replacements[ "%cf_{$field}%" ] = is_array( $custom_field ) ? implode( ', ', $custom_field ) : $custom_field;
				}
			}
		}

		// Handle separators
		$replacements['%sep%'] = '|';
		$replacements['%sep-raquo%'] = '»';
		$replacements['%sep-larr%'] = '←';
		$replacements['%sep-rarr%'] = '→';

		// Apply all replacements
		foreach ( $replacements as $placeholder => $replacement ) {
			$string = str_ireplace( $placeholder, $replacement, $string );
		}

		// Clean up any remaining placeholders
		$string = preg_replace( '/%[^%]*%/', '', $string );

		return trim( $string );
	}

	/**
	 * Get meta title for a term.
	 *
	 * @since 0.1.0
	 *
	 * @param WP_Term $term     Term object.
	 * @param string  $taxonomy Taxonomy name.
	 * @return string Meta title.
	 */
	public function get_term_meta_title( $term, $taxonomy = 'category' ) {
		$seo_plugin = $this->detect_active_seo_plugin();

		if ( is_wp_error( $seo_plugin ) || ! $seo_plugin['plugin_file'] ) {
			return '';
		}

		switch ( $seo_plugin['plugin_file'] ) {
			case 'wordpress-seo/wp-seo.php':
				// Yoast SEO.
				return get_term_meta( $term->term_id, 'wpseo_title', true );

			case 'seo-by-rank-math/rank-math.php':
				// Rank Math.
				return get_term_meta( $term->term_id, 'rank_math_title', true );

			// Add more SEO plugins as needed.


			default:
				return '';
		}
	}

	/**
	 * Get meta description for a term.
	 *
	 * @since 0.1.0
	 *
	 * @param WP_Term $term     Term object.
	 * @param string  $taxonomy Taxonomy name.
	 * @return string Meta description.
	 */
	public function get_term_meta_description( $term, $taxonomy = 'category' ) {
		$seo_plugin = $this->detect_active_seo_plugin();

		if ( is_wp_error( $seo_plugin ) || ! $seo_plugin['plugin_file'] ) {
			return '';
		}

		switch ( $seo_plugin['plugin_file'] ) {
			case 'wordpress-seo/wp-seo.php':
				// Yoast SEO.
				return get_term_meta( $term->term_id, 'wpseo_desc', true );

			case 'seo-by-rank-math/rank-math.php':
				// Rank Math.
				return get_term_meta( $term->term_id, 'rank_math_description', true );

			// Add more SEO plugins as needed.


			default:
				return '';
		}
	}

	/**
	 * Get the active SEO plugin name.
	 *
	 * @since 0.1.0
	 *
	 * @return string Active SEO plugin name or empty string if none.
	 */
	public function get_active_plugin_name() {
		$seo_plugin = $this->detect_active_seo_plugin();

		if ( is_wp_error( $seo_plugin ) ) {
			return $seo_plugin->get_error_message();
		}

		return $seo_plugin['plugin_name'];
	}

	/**
	 * Check if an SEO plugin is active.
	 *
	 * @since 0.1.0
	 *
	 * @return bool True if an SEO plugin is active, false otherwise.
	 */
	public function is_seo_plugin_active() {
		$seo_plugin = $this->detect_active_seo_plugin();
		return ! is_wp_error( $seo_plugin ) && false !== $seo_plugin['plugin_file'];
	}
}
