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
            
            <?php submit_button( __( 'Export to CSV', 'export-urls-and-meta' ), 'primary', 'eum_export', false, array( 'class' => 'export-button' ) ); ?>
        </form>
    </div>
    
    <!-- Export Modal -->
    <div class="export-modal" style="display: none;">
        <div class="modal-content">
            <button class="close-modal">&times;</button>
            <p><?php esc_html_e( 'Preparing your export...', 'export-urls-and-meta' ); ?></p>
            <p><span class="spinner is-active"></span></p>
        </div>
    </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
    // Handle form submission
    $('.export-form').on('submit', function(e) {
        e.preventDefault();
        
        var $form = $(this);
        var $submitBtn = $form.find('.export-button');
        var $modal = $('.export-modal');
        
        // Check if at least one post type is selected
        if ($form.find('input[name="eum_post_types[]"]:checked').length === 0) {
            alert('<?php esc_html_e( 'Please select at least one post type.', 'export-urls-and-meta' ); ?>');
            return false;
        }
        
        // Check if at least one status is selected
        if ($form.find('input[name="eum_publish_status[]"]:checked').length === 0) {
            alert('<?php esc_html_e( 'Please select at least one post status.', 'export-urls-and-meta' ); ?>');
            return false;
        }
        
        // Show the modal
        $modal.show();
        
        // Disable submit button to prevent double submission
        $submitBtn.prop('disabled', true);
        
        // Submit the form via AJAX
        $.ajax({
            url: eum_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'eum_export',
                eum_export_nonce: eum_ajax.nonce,
                eum_post_types: $form.find('input[name="eum_post_types[]"]:checked').map(function() {
                    return $(this).val();
                }).get(),
                eum_publish_status: $form.find('input[name="eum_publish_status[]"]:checked').map(function() {
                    return $(this).val();
                }).get(),
                eum_include_homepage: $form.find('input[name="eum_include_homepage"]').is(':checked') ? 1 : 0,
                eum_include_categories: $form.find('input[name="eum_include_categories"]').is(':checked') ? 1 : 0,
                eum_include_product_categories: $form.find('input[name="eum_include_product_categories"]').is(':checked') ? 1 : 0
            },
            xhrFields: {
                responseType: 'blob' // Important for file download
            },
            success: function(response, status, xhr) {
                // Hide the modal
                $modal.hide();
                
                // Handle the file download
                var filename = 'export-' + new Date().toISOString().slice(0, 10) + '.csv';
                var disposition = xhr.getResponseHeader('Content-Disposition');
                
                if (disposition && disposition.indexOf('attachment') !== -1) {
                    var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                    var matches = filenameRegex.exec(disposition);
                    if (matches != null && matches[1]) {
                        filename = matches[1].replace(/['"]/g, '');
                    }
                }
                
                var blob = new Blob([response], { type: xhr.getResponseHeader('Content-Type') || 'text/csv;charset=utf-8' });
                
                if (window.navigator && window.navigator.msSaveOrOpenBlob) {
                    // For IE and Edge
                    window.navigator.msSaveOrOpenBlob(blob, filename);
                } else {
                    // For other browsers
                    var downloadUrl = URL.createObjectURL(blob);
                    var a = document.createElement('a');
                    a.href = downloadUrl;
                    a.download = filename;
                    document.body.appendChild(a);
                    a.click();
                    setTimeout(function() {
                        document.body.removeChild(a);
                        window.URL.revokeObjectURL(downloadUrl);
                    }, 100);
                }
            },
            error: function(xhr, status, error) {
                $modal.hide();
                alert(eum_ajax.error_text || 'An error occurred during export. Please try again.');
                console.error('Export error:', error, xhr.responseText);
            },
            complete: function() {
                // Re-enable the submit button
                $submitBtn.prop('disabled', false);
            }
        });
        
        return false;
    });
    
    // Close modal when clicking the close button or outside the modal
    $(document).on('click', '.close-modal, .export-modal', function(e) {
        // Only close if clicking the close button or the modal overlay (not the modal content)
        if ($(e.target).hasClass('close-modal') || $(e.target).hasClass('export-modal')) {
            $('.export-modal').hide();
        }
    });
    
    // Prevent clicks inside the modal content from closing the modal
    $('.modal-content').on('click', function(e) {
        e.stopPropagation();
    });
});
</script>
