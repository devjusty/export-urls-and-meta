<?php
/**
 * Export functionality for the plugin.
 *
 * @since      0.1.0
 * @package    ExportUrlsAndMeta
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load WordPress core functions if not already loaded.
if ( ! function_exists( 'get_terms' ) ) {
    require_once ABSPATH . 'wp-includes/taxonomy.php';
    require_once ABSPATH . 'wp-includes/post.php';
    require_once ABSPATH . 'wp-includes/category.php';
}

/**
 * Export class.
 */
class Export_Urls_And_Meta_Export {

	/**
	 * The SEO integration instance.
	 *
	 * @since 0.1.0
	 * @var Export_Urls_And_Meta_SEO_Integration
	 */
	private $seo_integration;

	/**
	 * Initialize the export class.
	 *
	 * @since 0.1.0
	 * @param Export_Urls_And_Meta_SEO_Integration $seo_integration The SEO integration instance.
	 */
	public function __construct( $seo_integration ) {
		$this->seo_integration = $seo_integration;
	}

	/**
	 * Generate CSV file with exported data.
	 *
	 * @since 0.1.0
	 *
	 * @param array   $post_types              Post types to include in export.
	 * @param array   $post_status          Post statuses to include.
	 * @param boolean $include_homepage        Whether to include the homepage.
	 * @param boolean $include_categories      Whether to include post categories.
	 * @param boolean $include_product_categories Whether to include WooCommerce product categories.
	 * @return void
	 * @throws Exception If there's an error during export.
	 */
	public function generate_csv( $post_types = array( 'post', 'page' ), $post_status = array( 'publish' ), $include_homepage = false, $include_categories = false, $include_product_categories = false ) {
		error_log('Starting CSV generation with params: ' . print_r(func_get_args(), true));
		
		try {
			// Validate post types and statuses
			if ( empty( $post_types ) ) {
				throw new Exception( __( 'No post types selected for export.', 'export-urls-and-meta' ) );
			}

			if ( empty( $post_status ) ) {
				throw new Exception( __( 'No post statuses selected for export.', 'export-urls-and-meta' ) );
			}

			// Get posts based on criteria
			$args = array(
				'post_type'      => $post_types,
				'post_status'    => $post_status,
				'posts_per_page' => -1,
				'orderby'        => 'title',
				'order'          => 'ASC',
			);

			error_log('Query args: ' . print_r($args, true));

			$query = new WP_Query( $args );
			$posts = $query->posts;
			
			// Add homepage if needed (for both static page and latest posts)
			if ( $include_homepage ) {
				$home_url = home_url( '/' );
				$homepage_added = false;
				
				// Add static homepage if set
				if ( 'page' === get_option( 'show_on_front' ) ) {
					$homepage_id = (int) get_option( 'page_on_front' );
					if ( $homepage_id > 0 ) {
						$homepage = get_post( $homepage_id );
						if ( $homepage ) {
							array_unshift( $posts, $homepage );
							$homepage_added = true;
						}
					}
				}
				
				// Add latest posts homepage if not already added
				if ( ! $homepage_added && 'posts' === get_option( 'show_on_front' ) ) {
					// Get site name and description for fallback
					$site_name = get_bloginfo( 'name' );
					$site_description = get_bloginfo( 'description' );
					
					// Default to site name
					$meta_title = $site_name;
					$meta_description = $site_description;
					
					// Check if Yoast is active and get the homepage title format
					if ( $this->seo_integration->is_seo_plugin_active() && 'wordpress-seo/wp-seo.php' === $this->seo_integration->detect_active_seo_plugin()['plugin_file'] ) {
						// Use the SEO integration to get the title and description
						$meta_title = $this->seo_integration->get_post_meta_title( 0 );
						$meta_description = $this->seo_integration->get_post_meta_description( 0 );
						
						// Fallback to site name if empty
						if ( empty( $meta_title ) ) {
							$meta_title = $site_name;
						}
						if ( empty( $meta_description ) ) {
							$meta_description = $site_description;
						}
					}
					
					$homepage = (object) array(
						'ID' => 0,
						'post_title' => $meta_title,
						'post_type' => 'home',
						'post_status' => 'publish',
						'post_content' => $meta_description,
						'is_home' => true // Flag to indicate this is the homepage
					);
					array_unshift( $posts, $homepage );
				}
			}

			error_log('Found ' . count($posts) . ' posts to export');
			if ( empty( $posts ) ) {
				throw new Exception( __( 'No posts found matching the selected criteria.', 'export-urls-and-meta' ) );
			}

			// Set headers for file download
			header( 'Content-Type: text/csv; charset=utf-8' );
			header( 'Content-Disposition: attachment; filename=export-' . date( 'Y-m-d' ) . '.csv' );
			header( 'Pragma: no-cache' );
			header( 'Expires: 0' );

			// Create a file pointer connected to the output stream
			$output = fopen( 'php://output', 'w' );

			// Add BOM for Excel compatibility
			fputs( $output, "\xEF\xBB\xBF" );

			// Set CSV headers
			$headers = array(
				__( 'URL', 'export-urls-and-meta' ),
				__( 'Title', 'export-urls-and-meta' ),
				__( 'Post Type', 'export-urls-and-meta' ),
			);

			// Add SEO meta headers if SEO plugin is active
			if ( $this->seo_integration->is_seo_plugin_active() ) {
				$headers[] = __( 'Meta Title', 'export-urls-and-meta' );
				$headers[] = __( 'Meta Description', 'export-urls-and-meta' );
			}

			// Add status column
			$headers[] = __( 'Status', 'export-urls-and-meta' );

			// Add categories if enabled
			if ( $include_categories ) {
				$headers[] = __( 'Categories', 'export-urls-and-meta' );
			}

			// Add product categories if enabled and WooCommerce is active
			if ( $include_product_categories && class_exists( 'WooCommerce' ) ) {
				$headers[] = __( 'Product Categories', 'export-urls-and-meta' );
			}

			// Output headers
			fputcsv( $output, $headers );

			// Process each post
			foreach ( $posts as $post ) {
				$row = array();

				// Handle homepage URL for latest posts
				if ( $post->ID === 0 && isset( $post->post_type ) && $post->post_type === 'home' ) {
					$row[] = home_url( '/' );
					// Use the title we set earlier (either from Yoast or fallback)
					$row[] = $post->post_title;
					$row[] = 'home';
					
					// Add empty meta title and description for homepage
					if ( $this->seo_integration->is_seo_plugin_active() ) {
						$row[] = $this->seo_integration->get_post_meta_title( 0 );
						$row[] = $this->seo_integration->get_post_meta_description( 0 );
					}
					
					// Add status for homepage
					$row[] = 'publish';
				} else {
					// Get post URL
					$row[] = get_permalink( $post->ID );
					// Get post title and type
					$row[] = $post->post_title;
					$row[] = $post->post_type;
					
					// Get SEO meta if available
					if ( $this->seo_integration->is_seo_plugin_active() ) {
						// Get meta title and description
						$meta_title = $this->seo_integration->get_post_meta_title( $post->ID );
						$meta_description = $this->seo_integration->get_post_meta_description( $post->ID );
						$row[] = $meta_title;
						$row[] = $meta_description;
					} else {
						// Add empty values for meta title and description if SEO plugin is not active
						$row[] = '';
						$row[] = '';
					}
					
					// Add status
					$row[] = $post->post_status;
				}

				// Get categories if enabled (just add the category names, not as separate rows)
				if ( $include_categories ) {
					$categories = get_the_category( $post->ID );
					$category_names = wp_list_pluck( $categories, 'name' );
					$row[] = implode( ', ', $category_names );
				}

				// Get product categories if enabled and WooCommerce is active
				if ( $include_product_categories && class_exists( 'WooCommerce' ) ) {
					$product_terms = get_the_terms( $post->ID, 'product_cat' );
					$product_categories = is_wp_error( $product_terms ) || ! $product_terms ? array() : wp_list_pluck( $product_terms, 'name' );
					$row[] = implode( ', ', $product_categories );
				}

				// Output the row
				fputcsv( $output, $row );
			}

			// Close the file
			fclose( $output );

			// Exit to prevent any additional output
			die();

		} catch ( Exception $e ) {
			error_log( 'Export error: ' . $e->getMessage() );
			throw $e; // Re-throw to be handled by the caller
		}
	}

	/**
	 * Get data for export.
	 *
	 * @since 0.1.0
	 *
	 * @param array  $post_types              Post types to include.
	 * @param array  $publish_status          Post statuses to include.
	 * @param bool   $include_homepage        Whether to include the homepage.
	 * @param bool   $include_categories      Whether to include post categories.
	 * @param bool   $include_product_categories Whether to include WooCommerce product categories.
	 * @return array Array of data to export.
	 */
	private function get_export_data( $post_types, $publish_status, $include_homepage, $include_categories, $include_product_categories = false ) {
		$data = array();

		// Get posts data.
		$posts = $this->get_posts( $post_types, $publish_status );
		foreach ( $posts as $post ) {
			$data[] = $this->prepare_post_data( $post );
		}

		// Get homepage data if needed.
		if ( $include_homepage && 'page' === get_option( 'show_on_front' ) ) {
			$homepage_id = (int) get_option( 'page_on_front' );
			if ( $homepage_id > 0 ) {
				$homepage = get_post( $homepage_id );
				if ( $homepage ) {
					$data[] = $this->prepare_post_data( $homepage );
				}
			}
		}

		// Get categories data if needed.
		if ( $include_categories ) {
			$categories = $this->get_terms( 'category' );
			$category_rows = array();
			
			foreach ( $categories as $category ) {
				$category_data = $this->prepare_term_data( $category, 'category' );
				
				// Create a row for each category
				$row = array(
					$category_data['url'],
					$category_data['post_title'],
					'category',
				);
				
				// Add SEO meta if available
				if ( $this->seo_integration->is_seo_plugin_active() ) {
					$row[] = $category_data['meta_title'];
					$row[] = $category_data['meta_desc'];
				}
				
				// Add status (always publish for terms)
				$row[] = 'publish';
				
				// Add empty categories column (categories don't have categories)
				$row[] = '';
				
				// Add to category rows
				$category_rows[] = $row;
			}
			
			// Add category rows to the beginning of the data array
			$data = array_merge($category_rows, $data);
		}

		// Get WooCommerce product categories if needed.
		if ( $include_product_categories && taxonomy_exists( 'product_cat' ) ) {
			$product_categories = $this->get_terms( 'product_cat' );
			foreach ( $product_categories as $category ) {
				$data[] = $this->prepare_term_data( $category, 'product_cat' );
			}
		}

		return $data;
	}

	/**
	 * Get posts based on post types and statuses.
	 *
	 * @since 0.1.0
	 *
	 * @param array $post_types     Post types to get.
	 * @param array $post_status Post statuses to include.
	 * @return WP_Post[] Array of post objects.
	 */
	private function get_posts( $post_types, $post_status ) {
		error_log('Preparing WP_Query');
		$args = array(
			'post_type'      => $post_types,
			'post_status'    => $post_status,
			'posts_per_page' => -1,
			'fields'         => 'ids',
			'orderby'        => 'title',
			'order'          => 'ASC',
		);

		error_log('WP_Query Args: ' . print_r($args, true));
		$query = new WP_Query( $args );
		error_log('Found ' . $query->found_posts . ' posts');
		return $query->have_posts() ? $query->posts : array();
	}

	/**
	 * Prepare post data for export.
	 *
	 * @since 0.1.0
	 *
	 * @param WP_Post $post        Post object.
	 * @param array   $seo_plugin  Active SEO plugin data.
	 * @return array Prepared post data.
	 */
	private function prepare_post_data( $post ) {
		// Get SEO meta based on active plugin.
		$seo_meta = array(
			'title' => $this->seo_integration->get_post_meta_title( $post->ID ),
			'description' => $this->seo_integration->get_post_meta_description( $post->ID )
		);

		// Format dates
		$post_date = $post->post_date ? date_i18n( 'Y-m-d H:i:s', strtotime( $post->post_date ) ) : '';
		$modified_date = $post->post_modified ? date_i18n( 'Y-m-d H:i:s', strtotime( $post->post_modified ) ) : '';

		return array(
			get_permalink( $post ),
			$post->post_title,
			$seo_meta['title'],
			$seo_meta['description'],
			$post->post_type,
			$post->post_status,
			$post_date,
			$modified_date
		);
	}

	/**
	 * Prepare term data for export.
	 *
	 * @since 0.1.0
	 *
	 * @param WP_Term $term        Term object.
	 * @param string  $taxonomy    Taxonomy name.
	 * @param array   $seo_plugin  Active SEO plugin data.
	 * @return array Prepared term data.
	 */
	private function prepare_term_data( $term, $taxonomy ) {
		// Get SEO meta based on active plugin.
		$seo_meta = array(
			'title' => $this->seo_integration->get_term_meta_title( $term, $taxonomy ),
			'description' => $this->seo_integration->get_term_meta_description( $term, $taxonomy )
		);

		return array(
			'post_title'   => $term->name,
			'url'          => get_term_link( $term, $taxonomy ),
			'meta_title'   => $seo_meta['title'],
			'meta_desc'    => $seo_meta['description'],
			'type'         => $taxonomy,
			'status'       => 'publish', // Terms don't have status.
			'modified'     => '', // Terms don't have modified date.
		);
	}

	/**
	 * Get SEO meta for a post.
	 *
	 * @since 0.1.0
	 * Validate post types before processing.
	 *
	 * @since 0.1.0
	 * @param array $post_types Post types to validate.
	 * @return array Validated post types.
	 * @throws Exception If no valid post types are provided.
	 */
	private function validate_post_types( $post_types ) {
		if ( ! is_array( $post_types ) || empty( $post_types ) ) {
			throw new Exception( __( 'No post types selected for export.', 'export-urls-and-meta' ) );
		}

		$valid_post_types = get_post_types( array( 'public' => true ) );
		$validated = array();

		foreach ( $post_types as $post_type ) {
			if ( in_array( $post_type, $valid_post_types, true ) ) {
				$validated[] = $post_type;
			}
		}

		if ( empty( $validated ) ) {
			throw new Exception( __( 'No valid post types selected for export.', 'export-urls-and-meta' ) );
		}

		return $validated;
	}

	/**
	 * Validate post statuses before processing.
	 *
	 * @since 0.1.0
	 * @param array $statuses Post statuses to validate.
	 * @return array Validated post statuses.
	 * @throws Exception If no valid statuses are provided.
	 */
	private function validate_post_statuses( $statuses ) {
		error_log('Validating statuses: ' . print_r($statuses, true));
		if ( ! is_array( $statuses ) || empty( $statuses ) ) {
			error_log('No valid statuses provided, defaulting to publish');
			return array( 'publish' ); // Default to publish if none provided
		}

		// Get all available statuses
		$all_statuses = get_post_stati();
		$validated = array();

		// Define WooCommerce order statuses to exclude
		$woocommerce_order_statuses = array(
			'wc-pending',
			'wc-processing',
			'wc-on-hold',
			'wc-completed',
			'wc-cancelled',
			'wc-refunded',
			'wc-failed',
			'wc-checkout-draft',
			'wc-pending-payment',
			'wc-processing-order',
			'wc-on-hold-order',
			'wc-completed-order',
			'wc-cancelled-order',
			'wc-refunded-order',
			'wc-failed-order'
		);

		// Filter out WooCommerce order statuses
		$filtered_statuses = array_diff_key($all_statuses, array_flip($woocommerce_order_statuses));

		// Validate requested statuses against filtered list
		foreach ( $statuses as $status ) {
			if ( in_array( $status, $filtered_statuses, true ) ) {
				$validated[] = $status;
			}
		}

		if ( empty( $validated ) ) {
			return array( 'publish' ); // Default to publish if none valid after filtering
		}

		return $validated;
	}

	/**
	 * Get terms for a taxonomy.
	 *
	 * @since 1.0.0
	 * @param string $taxonomy Taxonomy name.
	 * @return array Array of term objects.
	 */
	private function get_terms( $taxonomy ) {
		if ( ! function_exists( 'get_terms' ) ) {
			require_once ABSPATH . 'wp-includes/taxonomy.php';
		}

		$terms = get_terms( array(
			'taxonomy'   => $taxonomy,
			'hide_empty' => false,
		) );

		return is_wp_error( $terms ) ? array() : $terms;
	}

	/**
	 * Get categories.
	 *
	 * @since 0.1.0
	 * @deprecated 1.0.0 Use get_terms() instead.
	 * @return array Array of category term objects.
	 */
	private function get_categories() {
		return $this->get_terms( 'category' );
	}

	/**
	 * Generate filename for the exported CSV.
	 *
	 * @since 0.1.0
	 * @return string Filename for the export.
	 */
	private function generate_filename() {
		$site_name = sanitize_title( get_bloginfo( 'name' ) );
		$date      = gmdate( 'Y-m-d' );
		return sprintf( 'export-urls-meta-%1$s-%2$s.csv', $site_name, $date );
	}
}
