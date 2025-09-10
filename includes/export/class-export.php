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
     * @param array   $post_status             Post statuses to include.
     * @param boolean $include_homepage        Whether to include the homepage.
     * @param boolean $include_categories      Whether to include post categories.
     * @param boolean $include_product_categories Whether to include WooCommerce product categories.
     * @return string|WP_Error File URL on success, WP_Error on failure.
     */
    public function generate_csv( $post_types = array( 'post', 'page' ), $post_status = array( 'publish' ), $include_homepage = false, $include_categories = false, $include_product_categories = false ) {
        try {
            // Validate input
            if ( empty( $post_types ) ) {
                return new WP_Error( 'invalid_input', __( 'No post types selected for export.', 'export-urls-and-meta' ) );
            }

            // Get upload directory
            $upload_dir = wp_upload_dir();
            $export_dir = trailingslashit( $upload_dir['basedir'] ) . 'export-urls-and-meta';

            // Create directory if it doesn't exist
            if ( ! file_exists( $export_dir ) ) {
                if ( ! wp_mkdir_p( $export_dir ) ) {
                    return new WP_Error( 'directory_error', __( 'Could not create export directory.', 'export-urls-and-meta' ) );
                }
            }

            // Generate filename
            $filename = 'export-' . current_time( 'Y-m-d-H-i-s' ) . '.csv';
            $filepath = trailingslashit( $export_dir ) . $filename;

            // Get the export data
            $export_data = $this->get_export_data( $post_types, $post_status, $include_homepage, $include_categories, $include_product_categories );

            if ( empty( $export_data ) ) {
                return new WP_Error( 'no_data', __( 'No data to export.', 'export-urls-and-meta' ) );
            }

            // Open file for writing
            $handle = @fopen( $filepath, 'w' );
            if ( false === $handle ) {
                return new WP_Error( 'file_error', __( 'Could not create export file.', 'export-urls-and-meta' ) );
            }

            // Add BOM for UTF-8
            fputs( $handle, "\xEF\xBB\xBF" );

            // Get headers from the first item
            $headers = array_keys( reset( $export_data ) );

            // Write headers
            fputcsv( $handle, $headers );

            // Write data rows
            foreach ( $export_data as $row ) {
                // Ensure the row has the same keys as headers, in the same order
                $ordered_row = array();
                foreach ( $headers as $header ) {
                    $ordered_row[] = isset( $row[ $header ] ) ? $row[ $header ] : '';
                }
                fputcsv( $handle, $ordered_row );
            }

            // Close the file
            fclose( $handle );

            // Verify the file was created and is not empty
            if ( ! file_exists( $filepath ) || 0 === filesize( $filepath ) ) {
                return new WP_Error( 'export_failed', __( 'Failed to generate export file.', 'export-urls-and-meta' ) );
            }

            // Return the URL to the file
            return trailingslashit( $upload_dir['baseurl'] ) . 'export-urls-and-meta/' . $filename;

        } catch ( Exception $e ) {
            if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
                trigger_error( 'Export error: ' . $e->getMessage(), E_USER_WARNING );
            }
            return new WP_Error( 'export_error', $e->getMessage() );
        }
    }

    /**
     * Get export data as an array.
     *
     * @since 1.0.0
     *
     * @param array   $post_types              Post types to include in export.
     * @param array   $post_status             Post statuses to include.
     * @param boolean $include_homepage        Whether to include the homepage.
     * @param boolean $include_categories      Whether to include post categories.
     * @param boolean $include_product_categories Whether to include WooCommerce product categories.
     * @param int     $limit                   Maximum number of items to return (0 for no limit).
     * @return array Array of export data.
     */
    public function get_export_data( $post_types = array( 'post', 'page' ), $post_status = array( 'publish' ), $include_homepage = false, $include_categories = false, $include_product_categories = false, $limit = 0 ) {
        $data = array();

        // Handle homepage if needed
        if ( $include_homepage ) {
            $home_url = home_url( '/' );
            $home_title = get_bloginfo( 'name' );
            $home_meta_title = $this->seo_integration->get_post_meta_title( 0 );
            $home_meta_desc = $this->seo_integration->get_post_meta_description( 0 );

            $data[] = array(
                'url' => $home_url,
                'title' => $home_title,
                'type' => 'home',
                'meta_title' => $home_meta_title,
                'meta_description' => $home_meta_desc,
                'status' => 'publish',
                'categories' => '',
                'product_categories' => ''
            );

            if ( $limit > 0 && count( $data ) >= $limit ) {
                return $data;
            }
        }

        // Get posts
        $args = array(
            'post_type'      => $post_types,
            'post_status'    => $post_status,
            'posts_per_page' => $limit > 0 ? $limit - count( $data ) : -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        );

        $query = new WP_Query( $args );

        foreach ( $query->posts as $post ) {
            $data[] = $this->prepare_post_data( $post, $include_categories, $include_product_categories );
            
            if ( $limit > 0 && count( $data ) >= $limit ) {
                break;
            }
        }

        // Get categories if needed and we haven't reached the limit
        if ( $include_categories && ( $limit === 0 || count( $data ) < $limit ) ) {
            $categories = get_terms( array(
                'taxonomy' => 'category',
                'hide_empty' => false,
                'number' => $limit > 0 ? $limit - count( $data ) : 0,
            ) );

            foreach ( $categories as $category ) {
                $data[] = $this->prepare_term_data( $category, 'category' );
                
                if ( $limit > 0 && count( $data ) >= $limit ) {
                    break;
                }
            }
        }

        // Get product categories if WooCommerce is active and needed
        if ( $include_product_categories && ( $limit === 0 || count( $data ) < $limit ) 
            && class_exists( 'WooCommerce' ) ) {
            
            $product_cats = get_terms( array(
                'taxonomy' => 'product_cat',
                'hide_empty' => false,
                'number' => $limit > 0 ? $limit - count( $data ) : 0,
            ) );

            foreach ( $product_cats as $cat ) {
                $data[] = $this->prepare_term_data( $cat, 'product_cat' );
                
                if ( $limit > 0 && count( $data ) >= $limit ) {
                    break;
                }
            }
        }

        return $data;
    }

    /**
     * Prepare post data for export.
     *
     * @since 1.0.0
     *
     * @param WP_Post $post                    Post object.
     * @param boolean $include_categories      Whether to include categories.
     * @param boolean $include_product_categories Whether to include product categories.
     * @return array Prepared post data.
     */
    private function prepare_post_data( $post, $include_categories = false, $include_product_categories = false ) {
        $post_data = array(
            'url' => get_permalink( $post->ID ),
            'title' => get_the_title( $post->ID ),
            'type' => $post->post_type,
            'meta_title' => $this->seo_integration->get_post_meta_title( $post->ID ),
            'meta_description' => $this->seo_integration->get_post_meta_description( $post->ID ),
            'status' => $post->post_status,
            'categories' => '',
            'product_categories' => ''
        );

        // Add categories if needed
        if ( $include_categories && $post->post_type === 'post' ) {
            $categories = get_the_terms( $post->ID, 'category' );
            if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
                $post_data['categories'] = implode( ', ', wp_list_pluck( $categories, 'name' ) );
            }
        }

        // Add product categories if WooCommerce is active and needed
        if ( $include_product_categories && $post->post_type === 'product' 
            && class_exists( 'WooCommerce' ) ) {
            
            $product_cats = get_the_terms( $post->ID, 'product_cat' );
            if ( ! is_wp_error( $product_cats ) && ! empty( $product_cats ) ) {
                $post_data['product_categories'] = implode( ', ', wp_list_pluck( $product_cats, 'name' ) );
            }
        }

        return $post_data;
    }

    /**
     * Prepare term data for export.
     *
     * @since 1.0.0
     *
     * @param WP_Term $term Term object.
     * @param string  $taxonomy Taxonomy name.
     * @return array Prepared term data.
     */
    private function prepare_term_data( $term, $taxonomy ) {
        $term_type = ( 'product_cat' === $taxonomy ) ? 'product_category' : 'category';
        
        return array(
            'url' => get_term_link( $term, $taxonomy ),
            'title' => $term->name,
            'type' => $term_type,
            'meta_title' => $this->seo_integration->get_term_meta_title( $term->term_id, $taxonomy ),
            'meta_description' => $this->seo_integration->get_term_meta_description( $term->term_id, $taxonomy ),
            'status' => 'publish',
            'categories' => ( 'category' === $taxonomy ) ? $term->name : '',
            'product_categories' => ( 'product_cat' === $taxonomy ) ? $term->name : ''
        );
    }
}
