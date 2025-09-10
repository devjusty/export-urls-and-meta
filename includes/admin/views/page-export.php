<?php
/**
 * Export page template.
 *
 * @since      0.1.0
 * @package    ExportUrlsAndMeta
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get available post types.
$post_types = get_post_types(
	array(
		'public' => true,
	),
	'objects'
);

// Remove attachment post type.
unset( $post_types['attachment'] );

// Get available post statuses and filter out WooCommerce order statuses
$post_statuses = get_post_stati( array( 'show_in_admin_all_list' => true ), 'objects' );

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

// Remove WooCommerce order statuses
foreach ($woocommerce_order_statuses as $status) {
    if (isset($post_statuses[$status])) {
        unset($post_statuses[$status]);
    }
}

// Get saved settings with defaults
$saved_settings = get_option( 'eum_export_settings', array() );
$saved_post_types = isset( $saved_settings['post_types'] ) ? (array) $saved_settings['post_types'] : array( 'post', 'page' );
$saved_statuses = isset( $saved_settings['post_status'] ) ? (array) $saved_settings['post_status'] : array( 'publish' );
$include_homepage = ! empty( $saved_settings['include_homepage'] );
$include_categories = ! empty( $saved_settings['include_categories'] );
$include_product_categories = ! empty( $saved_settings['include_product_categories'] );

// Ensure arrays are properly initialized
$saved_post_types = is_array( $saved_post_types ) ? $saved_post_types : array();
$saved_statuses = is_array( $saved_statuses ) ? $saved_statuses : array( 'publish' );

// Set default values if not set
$defaults = array(
    'post_types' => array( 'post', 'page' ),
    'post_status' => array( 'publish' ),
    'include_homepage' => false,
    'include_categories' => false,
    'include_product_categories' => false,
);

// Merge with defaults
$settings = wp_parse_args( array(
    'post_types' => $saved_post_types,
    'post_status' => $saved_statuses,
    'include_homepage' => $include_homepage,
    'include_categories' => $include_categories,
    'include_product_categories' => $include_product_categories,
), $defaults );

// Set default values if not set.
$has_seo_plugin = isset( $has_seo_plugin ) ? $has_seo_plugin : false;
$is_latest_posts = isset( $is_latest_posts ) ? $is_latest_posts : false;
$woocommerce_active = isset( $woocommerce_active ) ? $woocommerce_active : false;

// Enqueue scripts and styles
wp_enqueue_style( 'export-urls-and-meta-admin' );
wp_enqueue_script( 'export-urls-and-meta-admin' );
?>

<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

    <?php 
    if ( is_wp_error( $seo_plugin_name ) ) {
        echo '<div class="notice notice-error"><p>' . esc_html( $seo_plugin_name->get_error_message() ) . '</p></div>';
    } elseif ( ! $has_seo_plugin ) {
        echo '<div class="notice notice-warning"><p>' . esc_html__( 'No active SEO plugin detected. The export will only include basic post data.', 'export-urls-and-meta' ) . '</p></div>';
    } else {
        echo '<div class="notice notice-info"><p>' . sprintf( esc_html__( 'Using SEO plugin: %s', 'export-urls-and-meta' ), esc_html( $seo_plugin_name ) ) . '</p></div>';
    }
    ?>

    <div class="card">
        <h2><?php esc_html_e( 'Export Settings', 'export-urls-and-meta' ); ?></h2>
        <form method="post" action="" class="export-form">
        <?php wp_nonce_field( 'eum_export_nonce', 'eum_export_nonce' ); ?>
            
            <table class="form-table">
                <tr>
                    <th scope="row"><?php esc_html_e( 'Post Types', 'export-urls-and-meta' ); ?></th>
                    <td>
                        <fieldset>
                            <?php 
                            foreach ( $post_types as $post_type ) {
                                echo '<label>';
                                echo '<input type="checkbox" name="eum_post_types[]" value="' . esc_attr( $post_type->name ) . '" ';
                                checked( in_array( $post_type->name, (array) $settings['post_types'], true ) );
                                echo '> ' . esc_html( $post_type->labels->name ) . '</label><br>';
                            }
                            ?>
                        </fieldset>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><?php esc_html_e( 'Post Status', 'export-urls-and-meta' ); ?></th>
                    <td>
                        <fieldset>
                            <?php 
                            foreach ( $post_statuses as $status => $status_obj ) {
                                echo '<label>';
                                echo '<input type="checkbox" name="eum_publish_status[]" value="' . esc_attr( $status ) . '" ';
                                checked( in_array( $status, (array) $settings['post_status'], true ) );
                                echo '> ' . esc_html( $status_obj->label ) . '</label><br>';
                            }
                            ?>
                        </fieldset>
                    </td>
                </tr>
                
                <?php if ( $is_latest_posts ) : ?>
                <tr>
                    <th scope="row"><?php esc_html_e( 'Include Homepage', 'export-urls-and-meta' ); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="eum_include_homepage" value="1" 
                                <?php checked( ! empty( $settings['include_homepage'] ) ); ?>>
                            <?php esc_html_e( 'Include homepage (latest posts) in export', 'export-urls-and-meta' ); ?>
                        </label>
                    </td>
                </tr>
                <?php endif; ?>
                
                <tr>
                    <th scope="row"><?php esc_html_e( 'Categories', 'export-urls-and-meta' ); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="eum_include_categories" value="1" 
                                <?php checked( ! empty( $settings['include_categories'] ) ); ?>>
                            <?php esc_html_e( 'Include post categories in export', 'export-urls-and-meta' ); ?>
                        </label>
                    </td>
                </tr>
                
                <?php if ( $woocommerce_active ) : ?>
                <tr>
                    <th scope="row"><?php esc_html_e( 'Product Categories', 'export-urls-and-meta' ); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="eum_include_product_categories" value="1" 
                                <?php checked( ! empty( $settings['include_product_categories'] ) ); ?>>
                            <?php esc_html_e( 'Include WooCommerce product categories in export', 'export-urls-and-meta' ); ?>
                        </label>
                    </td>
                </tr>
                <?php endif; ?>
            </table>
            
            <div class="eum-form-actions">
                <?php 
                submit_button( 
                    __( 'Preview Export', 'export-urls-and-meta' ), 
                    'secondary', 
                    'eum_preview', 
                    false, 
                    array( 'class' => 'preview-button' ) 
                );
                
                submit_button( 
                    __( 'Export to CSV', 'export-urls-and-meta' ), 
                    'primary', 
                    'eum_export', 
                    false, 
                    array( 'class' => 'export-button' ) 
                );
                ?>
            </div>
        </form>
    </div>
    
    <!-- Export Modal -->
    <div class="export-modal">
        <!-- Content will be dynamically inserted here by JavaScript -->
    </div>
</div>

<script type="text/javascript">
// Localize script with translations and URLs
var eumVars = {
    ajaxUrl: '<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>',
    nonce: '<?php echo esc_js( wp_create_nonce( 'eum_export_nonce' ) ); ?>',
    messages: {
        generatingPreview: '<?php echo esc_js( __( 'Generating preview...', 'export-urls-and-meta' ) ); ?>',
        exporting: '<?php echo esc_js( __( 'Preparing your export...', 'export-urls-and-meta' ) ); ?>',
        previewTitle: '<?php echo esc_js( __( 'Export Preview', 'export-urls-and-meta' ) ); ?>',
        itemsFound: '<?php echo esc_js( __( 'items found', 'export-urls-and-meta' ) ); ?>',
        exportAll: '<?php echo esc_js( __( 'Export All', 'export-urls-and-meta' ) ); ?>',
        closePreview: '<?php echo esc_js( __( 'Close Preview', 'export-urls-and-meta' ) ); ?>',
        close: '<?php echo esc_js( __( 'Close', 'export-urls-and-meta' ) ); ?>',
        error: '<?php echo esc_js( __( 'An error occurred. Please try again.', 'export-urls-and-meta' ) ); ?>'
    }
};

jQuery(document).ready(function($) {
    // Handle form submission
    $('.export-form').on('submit', function(e) {
        e.preventDefault();
    });
    
    // Add nonce to AJAX requests
    $(document).ajaxSend(function(event, xhr, settings) {
        if (settings.data && settings.data.indexOf('action=eum_export') !== -1) {
            settings.data += '&eum_export_nonce=' + eumVars.nonce;
        }
    });
});
</script>
