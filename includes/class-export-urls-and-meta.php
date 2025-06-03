<?php
/**
 * The main plugin class.
 *
 * @since      0.1.0
 * @package    ExportUrlsAndMeta
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The main plugin class.
 */
class Export_Urls_And_Meta {

	/**
	 * The single instance of the class.
	 *
	 * @since 0.1.0
	 * @var   Export_Urls_And_Meta
	 */
	private static $instance = null;

	/**
	 * The admin object.
	 *
	 * @since 0.1.0
	 * @var   Export_Urls_And_Meta_Admin
	 */
	public $admin;

	/**
	 * The export object.
	 *
	 * @since 0.1.0
	 * @var   Export_Urls_And_Meta_Export
	 */
	public $export;

	/**
	 * The SEO integration object.
	 *
	 * @since 0.1.0
	 * @var   Export_Urls_And_Meta_SEO_Integration
	 */
	public $seo_integration;

	/**
	 * Main Export_Urls_And_Meta Instance.
	 *
	 * Ensures only one instance of the plugin is loaded or can be loaded.
	 *
	 * @since 0.1.0
	 * @return Export_Urls_And_Meta - Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->init();
		}
		return self::$instance;
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 0.1.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cloning is forbidden.', 'export-urls-and-meta' ), '0.1.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 0.1.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Unserializing instances of this class is forbidden.', 'export-urls-and-meta' ), '0.1.0' );
	}

	/**
	 * Initialize the plugin.
	 *
	 * @since 0.1.0
	 */
	private function init() {
		// Load plugin text domain.
		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );

		// Include required files.
		$this->includes();

		// Initialize classes.
		$this->init_classes();

		// Hook into actions and filters.
		$this->init_hooks();
	}

	/**
	 * Include required core files.
	 *
	 * @since 0.1.0
	 */
	private function includes() {
		// Include admin class.
		require_once EXPORT_URLS_AND_META_PLUGIN_DIR . 'includes/admin/class-admin.php';

		// Include export class.
		require_once EXPORT_URLS_AND_META_PLUGIN_DIR . 'includes/export/class-export.php';

		// Include SEO integration class.
		require_once EXPORT_URLS_AND_META_PLUGIN_DIR . 'includes/integrations/class-seo-integration.php';

		// Include helper functions.
		require_once EXPORT_URLS_AND_META_PLUGIN_DIR . 'includes/functions.php';
	}

	/**
	 * Initialize plugin classes.
	 *
	 * @since 0.1.0
	 */
	private function init_classes() {
		$this->seo_integration = new Export_Urls_And_Meta_SEO_Integration();
		$this->admin = new Export_Urls_And_Meta_Admin( $this->seo_integration );
		$this->export = new Export_Urls_And_Meta_Export( $this->seo_integration );
	}

	/**
	 * Hook into actions and filters.
	 *
	 * @since 0.1.0
	 */
	private function init_hooks() {
		// Plugin action links.
		add_filter( 'plugin_action_links_' . plugin_basename( EXPORT_URLS_AND_META_PLUGIN_FILE ), array( $this, 'plugin_action_links' ) );

		// Load admin assets.
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Load plugin text domain.
	 *
	 * @since 0.1.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'export-urls-and-meta',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}

	/**
	 * Add plugin action links.
	 *
	 * @since 0.1.0
	 *
	 * @param array $links Plugin action links.
	 * @return array Modified plugin action links.
	 */
	public function plugin_action_links( $links ) {
		$plugin_links = array(
			'<a href="' . admin_url( 'tools.php?page=export-urls-and-meta' ) . '">' . __( 'Export', 'export-urls-and-meta' ) . '</a>',
		);
		return array_merge( $plugin_links, $links );
	}

	/**
	 * Enqueue admin scripts and styles.
	 *
	 * @since 0.1.0
	 *
	 * @param string $hook The current admin page.
	 */
	public function admin_enqueue_scripts( $hook ) {
		// Only load on our export page.
		if ( 'tools_page_export-urls-and-meta' !== $hook ) {
			return;
		}

		wp_enqueue_style(
			'export-urls-and-meta-admin',
			export_urls_and_meta()->plugin_url( 'assets/css/export-urls-and-meta.css' ),
			array(),
			EXPORT_URLS_AND_META_VERSION
		);

		wp_enqueue_script(
			'export-urls-and-meta-admin',
			export_urls_and_meta()->plugin_url( 'assets/js/export-urls-and-meta.js' ),
			array( 'jquery' ),
			EXPORT_URLS_AND_META_VERSION,
			true
		);

		// Localize script with translations.
		wp_localize_script(
			'export-urls-and-meta-admin',
			'exportUrlsAndMeta',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'nonce'    => wp_create_nonce( 'export-urls-and-meta-nonce' ),
				'i18n'     => array(
					'exporting' => __( 'Exporting...', 'export-urls-and-meta' ),
					'error'     => __( 'An error occurred. Please try again.', 'export-urls-and-meta' ),
				),
			)
		);
	}

	/**
	 * Get the plugin URL.
	 *
	 * @since 0.1.0
	 *
	 * @param string $path Optional. Path relative to the plugin URL.
	 * @return string
	 */
	public function plugin_url( $path = '' ) {
		return untrailingslashit( EXPORT_URLS_AND_META_PLUGIN_URL ) . ( $path ? '/' . ltrim( $path, '/' ) : '' );
	}

	/**
	 * Get the plugin path.
	 *
	 * @since 0.1.0
	 *
	 * @param string $path Optional. Path relative to the plugin directory.
	 * @return string
	 */
	public function plugin_path( $path = '' ) {
		return untrailingslashit( EXPORT_URLS_AND_META_PLUGIN_DIR ) . ( $path ? '/' . ltrim( $path, '/' ) : '' );
	}

	/**
	 * Activation hook.
	 *
	 * @since 0.1.0
	 */
	public static function activate() {
		// Add any activation code here.
	}

	/**
	 * Deactivation hook.
	 *
	 * @since 0.1.0
	 */
	public static function deactivate() {
		// Add any deactivation code here.
	}

	/**
	 * Uninstall hook.
	 *
	 * @since 0.1.0
	 */
	public static function uninstall() {
		if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
			exit;
		}

		// Delete plugin options.
		delete_option( 'eum_export_settings' );

		// Add any other cleanup code here.
	}
}

// Register uninstall hook.
register_uninstall_hook( __FILE__, array( 'Export_Urls_And_Meta', 'uninstall' ) );
