<?php
/**
 * Admin functionality for the plugin.
 *
 * @since      0.1.0
 * @package    ExportUrlsAndMeta
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Admin class.
 */
class Export_Urls_And_Meta_Admin {

	/**
	 * The plugin's text domain.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	private $text_domain;

	/**
	 * The plugin's settings.
	 *
	 * @since 0.1.0
	 * @var array
	 */
	private $settings;
	
	/**
	 * The SEO integration instance.
	 *
	 * @since 0.1.0
	 * @var Export_Urls_And_Meta_SEO_Integration
	 */
	protected $seo_integration;

	/**
	 * Initialize the admin class.
	 *
	 * @since 0.1.0
	 */
	/**
	 * @param Export_Urls_And_Meta_SEO_Integration $seo_integration The SEO integration instance.
	 */
	public function __construct( $seo_integration ) {
		$this->text_domain = 'export-urls-and-meta';
		$this->settings = get_option( 'eum_export_settings', array() );
		$this->seo_integration = $seo_integration;

		// Add AJAX handlers
		add_action( 'wp_ajax_eum_export', array( $this, 'handle_ajax_export' ) );

		// Add admin menu.
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );

		// Add admin notices.
		add_action( 'admin_notices', array( $this, 'display_admin_notices' ) );

		// Save settings.
		add_action( 'admin_init', array( $this, 'save_settings' ) );
		
		// Enqueue scripts and styles
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
	}

	/**
	 * Add admin menu item.
	 *
	 * @since 0.1.0
	 */
	public function add_admin_menu() {
		add_submenu_page(
			'tools.php',
			__( 'Export URLs and Meta', $this->text_domain ),
			__( 'Export URLs and Meta', $this->text_domain ),
			'manage_options',
			'export-urls-and-meta',
			array( $this, 'render_admin_page' )
		);
	}

	/**
	 * Render the admin page.
	 *
	 * @since 0.1.0
	 */
	public function render_admin_page() {
		// Check user capabilities.
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Check if WooCommerce is active.
		$woocommerce_active = class_exists( 'WooCommerce' );
		
		// Set default values for settings
		$defaults = array(
			'post_types' => array( 'post', 'page' ),
			'post_status' => array( 'publish' ),
			'include_homepage' => false,
			'include_categories' => false,
			'include_product_categories' => false,
		);
	
		// Ensure settings is an array and merge with defaults
		$settings = is_array( $this->settings ) ? $this->settings : array();
		$settings = wp_parse_args( $settings, $defaults );
	
		// Ensure array values are properly set
		$settings['post_types'] = isset( $settings['post_types'] ) ? (array) $settings['post_types'] : $defaults['post_types'];
		$settings['post_status'] = isset( $settings['post_status'] ) ? (array) $settings['post_status'] : $defaults['post_status'];
		$settings['include_homepage'] = ! empty( $settings['include_homepage'] );
		$settings['include_categories'] = ! empty( $settings['include_categories'] );
		$settings['include_product_categories'] = ! empty( $settings['include_product_categories'] );

		// Check if homepage is set to latest posts.
		$front_page_id = (int) get_option( 'page_on_front' );
		$is_latest_posts = ( 0 === $front_page_id );

		// Get saved settings.
		$saved_post_types = ! empty( $this->settings['post_types'] ) ? $this->settings['post_types'] : array( 'post', 'page' );
		$saved_statuses = ! empty( $this->settings['post_status'] ) ? $this->settings['post_status'] : array( 'publish' );
		$include_homepage = ! empty( $this->settings['include_homepage'] );
		$include_categories = ! empty( $this->settings['include_categories'] );
		$include_product_categories = ! empty( $this->settings['include_product_categories'] );

		// Get available post types.
		$post_types = get_post_types(
			array(
				'public' => true,
			),
			'objects'
		);

		// Remove attachment post type.
		unset( $post_types['attachment'] );

		// Get available post statuses.
		$post_statuses = get_post_stati( array( 'show_in_admin_all_list' => true ), 'objects' );

		// Prepare view data
		$view_data = array(
			'seo_plugin_name' => $this->seo_integration->get_active_plugin_name(),
			'has_seo_plugin' => $this->seo_integration->is_seo_plugin_active(),
			'post_types' => $post_types,
			'post_statuses' => $post_statuses,
			'settings' => array(
				'selected_post_types' => $saved_post_types,
				'selected_status' => $saved_statuses,
				'include_homepage' => $include_homepage,
				'include_categories' => $include_categories,
			),
			'is_latest_posts' => $is_latest_posts,
			'woocommerce_active' => $woocommerce_active
		);

		// Extract variables for the template
		extract($view_data, EXTR_SKIP);

		// Include the admin page template.
		include_once EXPORT_URLS_AND_META_PLUGIN_DIR . 'includes/admin/views/page-export.php';
	}

	/**
	 * Handle export form submission.
	 *
	 * @since 0.1.0
	 */
	public function handle_ajax_export() {
		try {
			// Verify nonce
			check_ajax_referer( 'eum_export_nonce', 'eum_export_nonce' );
			
			// Check user capabilities
			if ( ! current_user_can( 'manage_options' ) ) {
				throw new Exception( __( 'You do not have sufficient permissions to access this page.', 'export-urls-and-meta' ) );
			}
			
			// Get form data
			$action = isset( $_POST['eum_action'] ) ? sanitize_text_field( $_POST['eum_action'] ) : 'export';
			$post_types = isset( $_POST['eum_post_types'] ) ? array_map( 'sanitize_text_field', (array) $_POST['eum_post_types'] ) : array( 'post', 'page' );
			$publish_status = isset( $_POST['eum_publish_status'] ) ? array_map( 'sanitize_text_field', (array) $_POST['eum_publish_status'] ) : array( 'publish' );
			$include_homepage = isset( $_POST['eum_include_homepage'] ) ? (bool) $_POST['eum_include_homepage'] : false;
			$include_categories = isset( $_POST['eum_include_categories'] ) ? (bool) $_POST['eum_include_categories'] : false;
			$include_product_categories = isset( $_POST['eum_include_product_categories'] ) ? (bool) $_POST['eum_include_product_categories'] : false;

			error_log('AJAX ' . strtoupper($action) . ' - Form data: ' . print_r($_POST, true));

			// Save settings
			$this->settings = array(
				'post_types' => $post_types,
				'post_status' => $publish_status,
				'include_homepage' => $include_homepage,
				'include_categories' => $include_categories,
				'include_product_categories' => $include_product_categories,
			);
			update_option( 'eum_export_settings', $this->settings );

			// Include the export class if not already loaded
			if ( ! class_exists( 'Export_Urls_And_Meta_Export' ) ) {
				require_once EXPORT_URLS_AND_META_PLUGIN_DIR . 'includes/export/class-export.php';
			}

			// Initialize the export class with the SEO integration instance
			$export = new Export_Urls_And_Meta_Export( $this->get_seo_integration() );
			
			if ( 'preview' === $action ) {
				// Get preview data (first 10 items)
				$preview_data = $export->get_export_data( 
					$post_types, 
					$publish_status, 
					$include_homepage, 
					$include_categories, 
					$include_product_categories, 
					10 
				);
				
				// Get headers from the first item if available
				$headers = ! empty( $preview_data ) ? array_keys( $preview_data[0] ) : array();
				
				// Return preview data
				wp_send_json_success( array(
					'message' => __( 'Preview generated successfully!', 'export-urls-and-meta' ),
					'preview' => true,
					'headers' => $headers,
					'rows' => $preview_data,
					'count' => count( $preview_data ),
				) );
			} else {
				// Generate the actual export file
				$file_url = $export->generate_csv( $post_types, $publish_status, $include_homepage, $include_categories, $include_product_categories );

				if ( is_wp_error( $file_url ) ) {
					throw new Exception( $file_url->get_error_message() );
				}
				
				$result = $file_url;

				// Return success response
				wp_send_json_success( array(
					'message' => __( 'Export completed successfully!', 'export-urls-and-meta' ),
					'file' => $result,
					'preview' => false
				) );
			}
		} catch ( Exception $e ) {
			status_header( 500 );
			header( 'Content-Type: application/json; charset=utf-8' );
			echo json_encode( array( 'success' => false, 'message' => $e->getMessage() ) );
			die();
		}
	}

	/**
	 * Handle export form submission (legacy).
	 *
	 * @since 0.1.0
	 * @deprecated Use handle_ajax_export() instead
	 */
	public function handle_export_request() {
		error_log('Export request received');
		// Check if this is an export request.
		if ( ! isset( $_POST['eum_export_nonce'] ) ) {
			error_log('Export nonce not set');
			return;
		}

		if ( ! wp_verify_nonce( sanitize_key( $_POST['eum_export_nonce'] ), 'eum_export_nonce' ) ) {
			error_log('Invalid nonce');
			return;
		}

		// Check user capabilities.
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'export-urls-and-meta' ) );
		}

		try {
			error_log('Processing export form data');
			// Get form data.
			$post_types = isset( $_POST['eum_post_types'] ) ? array_map( 'sanitize_text_field', (array) $_POST['eum_post_types'] ) : array( 'post', 'page' );
			$publish_status = isset( $_POST['eum_publish_status'] ) ? array_map( 'sanitize_text_field', (array) $_POST['eum_publish_status'] ) : array( 'publish' );
			$include_homepage = isset( $_POST['eum_include_homepage'] ) ? (bool) $_POST['eum_include_homepage'] : false;
			$include_categories = isset( $_POST['eum_include_categories'] ) ? (bool) $_POST['eum_include_categories'] : false;
			$include_product_categories = isset( $_POST['eum_include_product_categories'] ) ? (bool) $_POST['eum_include_product_categories'] : false;

			error_log('Form data - Post Types: ' . print_r($post_types, true));
			error_log('Form data - Statuses: ' . print_r($publish_status, true));
			error_log('Form data - Include Homepage: ' . ($include_homepage ? 'true' : 'false'));
			error_log('Form data - Include Categories: ' . ($include_categories ? 'true' : 'false'));
			error_log('Form data - Include Product Categories: ' . ($include_product_categories ? 'true' : 'false'));

			// Save settings.
			update_option( 'eum_export_settings', array(
				'post_types' => $post_types,
				'post_status' => $publish_status,
				'include_homepage' => $include_homepage,
				'include_categories' => $include_categories,
				'include_product_categories' => $include_product_categories,
			) );

			// Include the export class if not already loaded
			if ( ! class_exists( 'Export_Urls_And_Meta_Export' ) ) {
				require_once EXPORT_URLS_AND_META_PLUGIN_DIR . 'includes/export/class-export.php';
			}

			// Initialize the export class with the SEO integration instance
			$export = new Export_Urls_And_Meta_Export( $this->seo_integration );

			// Save the settings before export
			$this->settings = array(
				'post_types' => $post_types,
				'post_status' => $publish_status,
				'include_homepage' => $include_homepage,
				'include_categories' => $include_categories,
				'include_product_categories' => $include_product_categories,
			);
			update_option( 'eum_export_settings', $this->settings );

			// Generate the export file.
			$export->generate_csv( $post_types, $publish_status, $include_homepage, $include_categories, $include_product_categories );

			exit;
		} catch ( Exception $e ) {
			// Add error notice.
			add_settings_error(
				'eum_export_error',
				'eum_export_failed',
				sprintf( __( 'Export failed: %s', 'export-urls-and-meta' ), $e->getMessage() ),
				'error'
			);
			?>
			<div class="notice notice-error">
				<p><?php echo esc_html( sprintf( __( 'Export failed: %s', 'export-urls-and-meta' ), $e->getMessage() ) ); ?></p>
			</div>
			<?php
		}
	}

	/**
	 * Save plugin settings.
	 *
	 * @since 0.1.0
	 */
	public function save_settings() {
		// Check if this is a settings save request.
		if ( ! isset( $_POST['eum_settings_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['eum_settings_nonce'] ), 'eum_save_settings' ) ) {
			return;
		}

		// Check user capabilities.
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		try {
			// Sanitize and save settings.
			$settings = array(
				// Add settings fields here.
			);

			update_option( 'eum_export_settings', $settings );

			// Set success message.
			set_transient( 'eum_settings_updated', __( 'Settings saved successfully.', 'export-urls-and-meta' ), 30 );

		} catch ( Exception $e ) {
			// Log the error.
			error_log( 'Export URLs and Meta Settings Error: ' . $e->getMessage() );

			// Set error message.
			set_transient( 'eum_settings_error', $e->getMessage(), 30 );
		}

		// Redirect back to the settings page.
		wp_safe_redirect( admin_url( 'tools.php?page=export-urls-and-meta&tab=settings' ) );
		exit;
	}

	/**
	 * Get active SEO plugin.
	 *
	 * @since 0.1.0
	 * @return array|WP_Error Array of active SEO plugin data or WP_Error if multiple SEO plugins are active.
	 */
	private function get_active_seo_plugin() {
		$seo_plugins = array(
			'wordpress-seo/wp-seo.php' => 'Yoast SEO',
			'all-in-one-seo-pack/all_in_one_seo_pack.php' => 'All in One SEO Pack',
			'autodescription/autodescription.php' => 'The SEO Framework',
			'seo-by-rank-math/rank-math.php' => 'Rank Math',
			'wp-seopress/seopress.php' => 'SEOPress',
		);

		$active_plugins = get_option( 'active_plugins', array() );
		$active_seo_plugins = array();

		foreach ( $seo_plugins as $plugin_file => $plugin_name ) {
			if ( in_array( $plugin_file, $active_plugins, true ) ) {
				$active_seo_plugins[ $plugin_file ] = $plugin_name;
			}
		}

		if ( count( $active_seo_plugins ) > 1 ) {
			return new WP_Error(
				'multiple_seo_plugins',
				sprintf(
					/* translators: %s: List of active SEO plugins */
					__( 'Multiple SEO plugins are active: %s. Please deactivate all but one SEO plugin to ensure compatibility.', 'export-urls-and-meta' ),
					implode( ', ', $active_seo_plugins )
				)
			);
		}

		if ( empty( $active_seo_plugins ) ) {
			return array(
				'plugin_file' => false,
				'plugin_name' => __( 'None', 'export-urls-and-meta' ),
			);
		}

		$plugin_file = array_keys( $active_seo_plugins )[0];
		return array(
			'plugin_file' => $plugin_file,
			'plugin_name' => $active_seo_plugins[ $plugin_file ],
		);
	}

	/**
	 * Enqueue admin scripts.
	 *
	 * @since 1.0.0
	 * @param string $hook The current admin page.
	 */
	public function enqueue_scripts( $hook ) {
		// Only load on our plugin page
		if ( 'tools_page_export-urls-and-meta' !== $hook ) {
			return;
		}

		// Get the plugin version from the main plugin file
		$plugin_data = get_file_data(
			EXPORT_URLS_AND_META_PLUGIN_FILE,
			array('Version' => 'Version'),
			'plugin'
		);
		$version = !empty($plugin_data['Version']) ? $plugin_data['Version'] : '1.0.0';

		// Register and enqueue the admin script
		wp_register_script(
			'export-urls-and-meta-admin',
			trailingslashit(EXPORT_URLS_AND_META_PLUGIN_URL) . 'assets/js/export-urls-and-meta-admin.js',
			array('jquery'),
			$version,
			true
		);

		// Add script attributes
		wp_script_add_data('export-urls-and-meta-admin', 'crossorigin', 'anonymous');

		// Enqueue the script
		wp_enqueue_script('export-urls-and-meta-admin');

		// Localize the script with data needed by JS
		wp_localize_script(
			'export-urls-and-meta-admin',
			'eumVars',
			array(
				'ajaxUrl' => esc_url(admin_url('admin-ajax.php')),
				'nonce' => wp_create_nonce('eum_export_nonce'),
				'messages' => array(
					'exporting' => esc_html__('Exporting...', 'export-urls-and-meta'),
					'exportComplete' => esc_html__('Export complete!', 'export-urls-and-meta'),
					'generatingPreview' => esc_html__('Generating preview...', 'export-urls-and-meta'),
					'closePreview' => esc_html__('Close Preview', 'export-urls-and-meta'),
					'noData' => esc_html__('No data found matching your criteria.', 'export-urls-and-meta'),
					'error' => esc_html__('An error occurred. Please try again.', 'export-urls-and-meta')
				)
			)
		);

		// Add inline script to handle any immediate JavaScript needs
		wp_add_inline_script(
			'export-urls-and-meta-admin',
			'console.log("Export URLs and Meta admin script loaded");',
			'after'
		);
	}

	/**
	 * Enqueue admin styles.
	 *
	 * @since 1.0.0
	 * @param string $hook The current admin page.
	 */
	public function enqueue_styles($hook) {
		// Only load on our plugin page
		if ('tools_page_export-urls-and-meta' !== $hook) {
			return;
		}

		// Get the plugin version from the main plugin file
		$plugin_data = get_file_data(
			EXPORT_URLS_AND_META_PLUGIN_FILE,
			array('Version' => 'Version'),
			'plugin'
		);
		$version = !empty($plugin_data['Version']) ? $plugin_data['Version'] : '1.0.0';

		// Enqueue the admin styles
		wp_enqueue_style(
			'export-urls-and-meta-admin',
			trailingslashit(EXPORT_URLS_AND_META_PLUGIN_URL) . 'assets/css/admin.css',
			array(),
			$version,
			'all'
		);
	}

	/**
	 * Get the SEO integration instance.
	 *
	 * @since 1.0.0
	 * @return Export_Urls_And_Meta_SEO_Integration The SEO integration instance.
	 */
	public function get_seo_integration() {
		return $this->seo_integration;
	}

	/**
	 * Display admin notices.
	 *
	 * @since 0.1.0
	 */
	public function display_admin_notices() {
		// Display settings updated notice.
		if ( $message = get_transient( 'eum_settings_updated' ) ) {
			?>
			<div class="notice notice-success is-dismissible">
				<p><?php echo esc_html( $message ); ?></p>
			</div>
			<?php
			delete_transient( 'eum_settings_updated' );
		}

		// Display settings error notice.
		if ( $error = get_transient( 'eum_settings_error' ) ) {
			?>
			<div class="notice notice-error is-dismissible">
				<p><?php echo esc_html( $error ); ?></p>
			</div>
			<?php
			delete_transient( 'eum_settings_error' );
		}

		// Display export error notice.
		if ( $error = get_transient( 'eum_export_error' ) ) {
			?>
			<div class="notice notice-error is-dismissible">
				<p><?php echo esc_html( $error ); ?></p>
			</div>
			<?php
			delete_transient( 'eum_export_error' );
		}

		// Display multiple SEO plugins notice.
		$seo_plugin = $this->get_active_seo_plugin();
		if ( is_wp_error( $seo_plugin ) ) {
			?>
			<div class="notice notice-error">
				<p><?php echo esc_html( $seo_plugin->get_error_message() ); ?></p>
			</div>
			<?php
		}
	}
}
