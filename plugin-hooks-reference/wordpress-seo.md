## Filters (249)

### $capability . '_roles'
**File:** `wordpress-seo/admin/capabilities/class-abstract-capability-manager.php`

**Context:**

```php
* @return array Filtered list of roles for the capability.
	 */
	protected function filter_roles( $capability, array $roles ) {
		/**
		 * Filter: Allow changing roles that a capability is added to.
		 *
		 * @param array $roles The default roles to be filtered.
		 */
		$filtered = apply_filters( $capability . '_roles', $roles );

		// Make sure we have the expected type.
		if ( ! is_array( $filtered ) ) {
```

### wpseo_editor_specific_replace_vars
**File:** `wordpress-seo/admin/class-admin-editor-specific-replace-vars.php`

**Context:**

```php
* @return array The editor specific replacement variables.
	 */
	public function get() {
		/**
		 * Filter: Adds the possibility to add extra editor specific replacement variables.
		 *
		 * @param array $replacement_variables Array of editor specific replace vars.
		 */
		$replacement_variables = apply_filters(
			'wpseo_editor_specific_replace_vars',
			$this->replacement_variables
		);

		if ( ! is_array( $replacement_variables ) ) {
			$replacement_variables = $this->replacement_variables;
```

### yoast_display_gutenberg_compat_notification
**File:** `wordpress-seo/admin/class-admin-gutenberg-compatibility-notification.php`

**Context:**

```php
* @return void
	 */
	public function manage_notification() {
		/**
		 * Filter: 'yoast_display_gutenberg_compat_notification' - Allows developer to disable the Gutenberg compatibility
		 * notification.
		 *
		 * @param bool $display_notification
		 */
		$display_notification = apply_filters( 'yoast_display_gutenberg_compat_notification', true );

		if (
			! $this->compatibility_checker->is_installed()
```

### wpseo_always_register_metaboxes_on_admin
**File:** `wordpress-seo/admin/class-admin-init.php`

**Context:**

```php
* @return bool true if we should load the meta box classes, false otherwise.
	 */
	private function should_load_meta_boxes() {
		/**
		 * Filter: 'wpseo_always_register_metaboxes_on_admin' - Allow developers to change whether
		 * the WPSEO metaboxes are only registered on the typical pages (lean loading) or always
		 * registered when in admin.
		 *
		 * @param bool $register_metaboxes Whether to always register the metaboxes or not. Defaults to false.
		 */
		if ( apply_filters( 'wpseo_always_register_metaboxes_on_admin', false ) ) {
			return true;
		}

		// If we are in a post editor.
```

### wpseo_manage_options_capability
**File:** `wordpress-seo/admin/class-admin.php`

**Context:**

```php
* @return string The capability to use.
	 */
	public function get_manage_options_cap() {
		/**
		 * Filter: 'wpseo_manage_options_capability' - Allow changing the capability users need to view the settings pages.
		 *
		 * @param string $capability The capability.
		 */
		return apply_filters( 'wpseo_manage_options_capability', 'wpseo_manage_options' );
	}

	/**
```

### wpseo_recommended_replace_vars
**File:** `wordpress-seo/admin/class-admin-recommended-replace-vars.php`

**Context:**

```php
* @return array The recommended replacement variables.
	 */
	public function get_recommended_replacevars() {
		/**
		 * Filter: Adds the possibility to add extra recommended replacement variables.
		 *
		 * @param array $additional_replace_vars Empty array to add the replacevars to.
		 */
		$recommended_replace_vars = apply_filters( 'wpseo_recommended_replace_vars', $this->recommended_replace_vars );

		if ( ! is_array( $recommended_replace_vars ) ) {
			return $this->recommended_replace_vars;
```

### wpseo_use_page_analysis
**File:** `wordpress-seo/admin/class-meta-columns.php`

**Context:**

```php
* When page analysis is enabled, just initialize the hooks.
	 */
	public function __construct() {
		if ( apply_filters( 'wpseo_use_page_analysis', true ) === true ) {
			add_action( 'admin_init', [ $this, 'setup_hooks' ] );
		}

		$this->analysis_seo         = new WPSEO_Metabox_Analysis_SEO();
```

### wpseo_change_keyphrase_filter_in_request
**File:** `wordpress-seo/admin/class-meta-columns.php`

**Context:**

```php
}

		if ( $this->is_valid_filter( $current_keyword_filter ) ) {
			/**
			 * Adapt the meta query used to filter the post overview on keyphrase.
			 *
			 * @internal
			 *
			 * @param array $keyphrase      The keyphrase used in the filter.
			 * @param array $keyword_filter The current keyword filter.
			 */
			$keyphrase_filter = apply_filters(
				'wpseo_change_keyphrase_filter_in_request',
				$this->get_keyword_filter( $current_keyword_filter ),
				$current_keyword_filter
			);

			if ( is_array( $keyphrase_filter ) ) {
				$active_filters = array_merge(
```

### wpseo_change_applicable_filters
**File:** `wordpress-seo/admin/class-meta-columns.php`

**Context:**

```php
}
		}

		/**
		 * Adapt the active applicable filters on the posts overview.
		 *
		 * @internal
		 *
		 * @param array $active_filters The current applicable filters.
		 */
		return apply_filters( 'wpseo_change_applicable_filters', $active_filters );
	}

	/**
```

### wpseo_change_order_by
**File:** `wordpress-seo/admin/class-meta-columns.php`

**Context:**

```php
// Based on the selected column, create a meta query.
			$order_by = $this->filter_order_by( $order_by_column );

			/**
			 * Adapt the order by part of the query on the posts overview.
			 *
			 * @internal
			 *
			 * @param array  $order_by        The current order by.
			 * @param string $order_by_column The current order by column.
			 */
			$order_by = apply_filters( 'wpseo_change_order_by', $order_by, $order_by_column );

			$vars = array_merge( $vars, $order_by );
		}
```

### wpseo_primary_term_taxonomies
**File:** `wordpress-seo/admin/class-primary-term-admin.php`

**Context:**

```php
$all_taxonomies = get_object_taxonomies( $post_type, 'objects' );
		$all_taxonomies = array_filter( $all_taxonomies, [ $this, 'filter_hierarchical_taxonomies' ] );

		/**
		 * Filters which taxonomies for which the user can choose the primary term.
		 *
		 * @param array  $taxonomies     An array of taxonomy objects that are primary_term enabled.
		 * @param string $post_type      The post type for which to filter the taxonomies.
		 * @param array  $all_taxonomies All taxonomies for this post types, even ones that don't have primary term
		 *                               enabled.
		 */
		$taxonomies = (array) apply_filters( 'wpseo_primary_term_taxonomies', $all_taxonomies, $post_type, $all_taxonomies );

		return $taxonomies;
	}
```

### yoast_notifications_before_storage
**File:** `wordpress-seo/admin/class-yoast-notification-center.php`

**Context:**

```php
$merged_notifications = array_merge( ...$notifications );
		}

		/**
		 * Filter: 'yoast_notifications_before_storage' - Allows developer to filter notifications before saving them.
		 *
		 * @param Yoast_Notification[] $notifications
		 */
		$filtered_merged_notifications = apply_filters( 'yoast_notifications_before_storage', $merged_notifications );

		// The notifications were filtered and therefore need to be stored.
		if ( $merged_notifications !== $filtered_merged_notifications ) {
```

### wpseo_notification_capabilities
**File:** `wordpress-seo/admin/class-yoast-notification.php`

**Context:**

```php
return true;
		}

		/**
		 * Filter capabilities that enable the displaying of this notification.
		 *
		 * @param array              $capabilities The capabilities that must be present for this notification.
		 * @param Yoast_Notification $notification The notification object.
		 *
		 * @return array Array of capabilities or empty for no restrictions.
		 *
		 * @since 3.2
		 */
		$capabilities = apply_filters( 'wpseo_notification_capabilities', $this->options['capabilities'], $this );

		// Should be an array.
		if ( ! is_array( $capabilities ) ) {
```

### wpseo_notification_capability_check
**File:** `wordpress-seo/admin/class-yoast-notification.php`

**Context:**

```php
$capabilities = (array) $capabilities;
		}

		/**
		 * Filter capability check to enable all or any capabilities.
		 *
		 * @param string             $capability_check The type of check that will be used to determine if an capability is present.
		 * @param Yoast_Notification $notification     The notification object.
		 *
		 * @return string self::MATCH_ALL or self::MATCH_ANY.
		 *
		 * @since 3.2
		 */
		$capability_check = apply_filters( 'wpseo_notification_capability_check', $this->options['capability_check'], $this );

		if ( ! in_array( $capability_check, [ self::MATCH_ALL, self::MATCH_ANY ], true ) ) {
			$capability_check = self::MATCH_ALL;
```

### wpseo_cornerstone_post_types
**File:** `wordpress-seo/admin/filters/class-cornerstone-filter.php`

**Context:**

```php
* @return array The post types to which this filter should be added.
	 */
	protected function get_post_types() {
		/**
		 * Filter: 'wpseo_cornerstone_post_types' - Filters post types to exclude the cornerstone feature for.
		 *
		 * @param array $post_types The accessible post types to filter.
		 */
		$post_types = apply_filters( 'wpseo_cornerstone_post_types', parent::get_post_types() );
		if ( ! is_array( $post_types ) ) {
			return [];
		}
```

### wpseo_enable_assessment_markers
**File:** `wordpress-seo/admin/formatter/class-metabox-formatter.php`

**Context:**

```php
'articleTypeOptions' => $schema_types->get_article_type_options(),
			],
			'twitterCardType'                    => 'summary_large_image',
			/**
			 * Filter to determine if the markers should be enabled or not.
			 *
			 * @param bool $showMarkers Should the markers being enabled. Default = true.
			 */
			'show_markers'                       => apply_filters( 'wpseo_enable_assessment_markers', true ),
		];

		$integration_information_repo = YoastSEO()->classes->get( Integration_Information_Repository::class );
```

### wpseo_post_edit_values
**File:** `wordpress-seo/admin/formatter/class-post-metabox-formatter.php`

**Context:**

```php
$values = ( $repo->get_seo_data() + $values );
		}

		/**
		 * Filter: 'wpseo_post_edit_values' - Allows changing the values Yoast SEO uses inside the post editor.
		 *
		 * @param array   $values The key-value map Yoast SEO uses inside the post editor.
		 * @param WP_Post $post   The post opened in the editor.
		 */
		return apply_filters( 'wpseo_post_edit_values', $values, $this->post );
	}

	/**
```

### wpseo_submenu_pages
**File:** `wordpress-seo/admin/menu/class-admin-menu.php`

**Context:**

```php
$this->get_submenu_page( __( 'Tools', 'wordpress-seo' ), 'wpseo_tools' ),
		];

		/**
		 * Filter: 'wpseo_submenu_pages' - Collects all submenus that need to be shown.
		 *
		 * @param array $submenu_pages List with all submenu pages.
		 */
		return (array) apply_filters( 'wpseo_submenu_pages', $submenu_pages );
	}

	/**
```

### wpseo_network_submenu_pages
**File:** `wordpress-seo/admin/menu/class-network-admin-menu.php`

**Context:**

```php
$submenu_pages[] = $this->get_submenu_page( __( 'Edit Files', 'wordpress-seo' ), 'wpseo_files' );
		}

		/**
		 * Filter: 'wpseo_network_submenu_pages' - Collects all network submenus that need to be shown.
		 *
		 * @internal For internal Yoast SEO use only.
		 *
		 * @param array $submenu_pages List with all submenu pages.
		 */
		return (array) apply_filters( 'wpseo_network_submenu_pages', $submenu_pages );
	}

	/**
```

### wpseo_metabox_prio
**File:** `wordpress-seo/admin/metabox/class-metabox.php`

**Context:**

```php
[ $this, 'render_internet_explorer_notice' ],
				$post_type,
				'normal',
				apply_filters( 'wpseo_metabox_prio', 'high' ),
				[ '__block_editor_compatible_meta_box' => true ]
			);
		}
	}
```

### wpseo_content_meta_section_content
**File:** `wordpress-seo/admin/metabox/class-metabox.php`

**Context:**

```php
echo new Meta_Fields_Presenter( $this->get_metabox_post(), 'social' );
		}

		/**
		 * Filter: 'wpseo_content_meta_section_content' - Allow filtering the metabox content before outputting.
		 *
		 * @param string $post_content The metabox content string.
		 */
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Output should be escaped in the filter.
		echo apply_filters( 'wpseo_content_meta_section_content', '' );
	}

	/**
```

### yoast_free_additional_metabox_sections
**File:** `wordpress-seo/admin/metabox/class-metabox.php`

**Context:**

```php
protected function get_additional_tabs() {
		$tabs = [];

		/**
		 * Private filter: 'yoast_free_additional_metabox_sections'.
		 *
		 * Meant for internal use only. Allows adding additional tabs to the Yoast SEO metabox.
		 *
		 * @since 11.9
		 *
		 * @param array[] $tabs {
		 *     An array of arrays with tab specifications.
		 *
		 *     @type array $tab {
		 *          A tab specification.
		 *
		 *          @type string $name         The name of the tab. Used in the HTML IDs, href and aria properties.
		 *          @type string $link_content The content of the tab link.
		 *          @type string $content      The content of the tab.
		 *          @type array $options {
		 *              Optional. Extra options.
		 *
		 *              @type string $link_class      Optional. The class for the tab link.
		 *              @type string $link_aria_label Optional. The aria label of the tab link.
		 *          }
		 *     }
		 * }
		 */
		$requested_tabs = apply_filters( 'yoast_free_additional_metabox_sections', [] );

		foreach ( $requested_tabs as $tab ) {
			if ( is_array( $tab ) && array_key_exists( 'name', $tab ) && array_key_exists( 'link_content', $tab ) && array_key_exists( 'content', $tab ) ) {
```

### wpseo_save_metaboxes
**File:** `wordpress-seo/admin/metabox/class-metabox.php`

**Context:**

```php
if ( $this->social_is_enabled ) {
			$social_fields = WPSEO_Meta::get_meta_field_defs( 'social' );
		}

		$meta_boxes = apply_filters( 'wpseo_save_metaboxes', [] );
		$meta_boxes = array_merge(
			$meta_boxes,
			WPSEO_Meta::get_meta_field_defs( 'general', $post->post_type ),
```

### wpseo_taxonomy_content_fields
**File:** `wordpress-seo/admin/taxonomy/class-taxonomy-fields.php`

**Context:**

```php
],
		];

		/**
		 * Filter: 'wpseo_taxonomy_content_fields' - Adds the possibility to register additional content fields.
		 *
		 * @param array $additional_fields The additional fields.
		 */
		$additional_fields = apply_filters( 'wpseo_taxonomy_content_fields', [] );

		return array_merge( $fields, $additional_fields );
	}
```

### yoast_free_additional_taxonomy_metabox_sections
**File:** `wordpress-seo/admin/taxonomy/class-taxonomy-metabox.php`

**Context:**

```php
protected function get_additional_tabs() {
		$tabs = [];

		/**
		 * Private filter: 'yoast_free_additional_taxonomy_metabox_sections'.
		 *
		 * Meant for internal use only. Allows adding additional tabs to the Yoast SEO metabox for taxonomies.
		 *
		 * @param array[] $tabs {
		 *     An array of arrays with tab specifications.
		 *
		 *     @type array $tab {
		 *          A tab specification.
		 *
		 *          @type string $name         The name of the tab. Used in the HTML IDs, href and aria properties.
		 *          @type string $link_content The content of the tab link.
		 *          @type string $content      The content of the tab.
		 *          @type array $options {
		 *              Optional. Extra options.
		 *
		 *              @type string $link_class      Optional. The class for the tab link.
		 *              @type string $link_aria_label Optional. The aria label of the tab link.
		 *          }
		 *     }
		 * }
		 */
		$requested_tabs = apply_filters( 'yoast_free_additional_taxonomy_metabox_sections', [] );

		foreach ( $requested_tabs as $tab ) {
			if ( is_array( $tab ) && array_key_exists( 'name', $tab ) && array_key_exists( 'link_content', $tab ) && array_key_exists( 'content', $tab ) ) {
```

### wpseo_enable_tracking
**File:** `wordpress-seo/admin/tracking/class-tracking.php`

**Context:**

```php
// Save this state.
		if ( $tracking === null ) {
			/**
			 * Filter: 'wpseo_enable_tracking' - Enables the data tracking of Yoast SEO Premium and add-ons.
			 *
			 * @param string|false $is_enabled The enabled state. Default is false.
			 */
			$tracking = apply_filters( 'wpseo_enable_tracking', false );

			WPSEO_Options::set( 'tracking', $tracking );
		}
```

### wpseo_tracking_settings_include_list
**File:** `wordpress-seo/admin/tracking/class-tracking-settings-data.php`

**Context:**

```php
* @return array The collection data.
	 */
	public function get() {
		/**
		 * Filter: 'wpseo_tracking_settings_include_list' - Allow filtering the settings included in tracking.
		 *
		 * @param string $include_list The list with included setting names.
		 */
		$this->include_list = apply_filters( 'wpseo_tracking_settings_include_list', $this->include_list );

		$options = WPSEO_Options::get_all();
		// Returns the settings of which the keys intersect with the values of the include list.
```

### wpseo_feature_toggles
**File:** `wordpress-seo/admin/views/class-yoast-feature-toggles.php`

**Context:**

```php
],
		];

		/**
		 * Filter to add feature toggles from add-ons.
		 *
		 * @param array $feature_toggles Array with feature toggle objects where each object
		 *                               should have a `name`, `setting` and `label` property.
		 */
		$feature_toggles = apply_filters( 'wpseo_feature_toggles', $feature_toggles );

		$feature_toggles = array_map( [ $this, 'ensure_toggle' ], $feature_toggles );
		usort( $feature_toggles, [ $this, 'sort_toggles_callback' ] );
```

### wpseo_integration_toggles
**File:** `wordpress-seo/admin/views/class-yoast-integration-toggles.php`

**Context:**

```php
],
		];

		/**
		 * Filter to add integration toggles from add-ons.
		 *
		 * @param array $integration_toggles Array with integration toggle objects where each object
		 *                                   should have a `name`, `setting` and `label` property.
		 */
		$integration_toggles = apply_filters( 'wpseo_integration_toggles', $integration_toggles );

		$integration_toggles = array_map( [ $this, 'ensure_toggle' ], $integration_toggles );
		usort( $integration_toggles, [ $this, 'sort_toggles_callback' ] );
```

### wpseo_handle_import
**File:** `wordpress-seo/admin/views/tool-import-export.php`

**Context:**

```php
$yoast_seo_import->import();
}

/**
 * Allow custom import actions.
 *
 * @param WPSEO_Import_Status $yoast_seo_import Contains info about the handled import.
 */
$yoast_seo_import = apply_filters( 'wpseo_handle_import', $yoast_seo_import );

if ( $yoast_seo_import ) {
```

### wpseo_import_message
**File:** `wordpress-seo/admin/views/tool-import-export.php`

**Context:**

```php
$yoast_seo_message = $yoast_seo_import->status->get_msg();
	}

	/**
	 * Allow customization of import/export message.
	 *
	 * @param string $yoast_seo_msg The message.
	 */
	$yoast_seo_msg = apply_filters( 'wpseo_import_message', $yoast_seo_message );

	if ( ! empty( $yoast_seo_msg ) ) {
		$yoast_seo_status = 'error';
```

### wpseo_pre_analysis_post_content
**File:** `wordpress-seo/inc/class-wpseo-content-images.php`

**Context:**

```php
return '';
		}

		/**
		 * Filter: 'wpseo_pre_analysis_post_content' - Allow filtering the content before analysis.
		 *
		 * @param string  $post_content The Post content string.
		 * @param WP_Post $post         The current post.
		 */
		$content = apply_filters( 'wpseo_pre_analysis_post_content', $post->post_content, $post );

		if ( ! is_string( $content ) ) {
			$content = '';
```

### postmeta_form_limit
**File:** `wordpress-seo/inc/class-wpseo-custom-fields.php`

**Context:**

```php
self::$custom_fields = [];

		/**
		 * Filters the number of custom fields to retrieve for the drop-down
		 * in the Custom Fields meta box.
		 *
		 * @param int $limit Number of custom fields to retrieve. Default 30.
		 */
		$limit  = apply_filters( 'postmeta_form_limit', 30 );
		$sql    = "SELECT DISTINCT meta_key
			FROM $wpdb->postmeta
			WHERE meta_key NOT BETWEEN '_' AND '_z' AND SUBSTRING(meta_key, 1, 1) != '_'
```

### wpseo_replacement_variables_custom_fields
**File:** `wordpress-seo/inc/class-wpseo-custom-fields.php`

**Context:**

```php
LIMIT %d";
		$fields = $wpdb->get_col( $wpdb->prepare( $sql, $limit ) );

		/**
		 * Filters the custom fields that are auto-completed and replaced as replacement variables
		 * in the meta box and sidebar.
		 *
		 * @param string[] $fields The custom field names.
		 */
		$fields = apply_filters( 'wpseo_replacement_variables_custom_fields', $fields );

		if ( is_array( $fields ) ) {
			self::$custom_fields = array_map( [ 'WPSEO_Custom_Fields', 'add_custom_field_prefix' ], $fields );
```

### wpseo_image_data
**File:** `wordpress-seo/inc/class-wpseo-image-utils.php`

**Context:**

```php
$image['type'] = get_post_mime_type( $attachment_id );
		}

		/**
		 * Filter: 'wpseo_image_data' - Filter image data.
		 *
		 * Elements with keys not listed in the section will be discarded.
		 *
		 * @param array $image_data {
		 *     Array of image data
		 *
		 *     @type int    id       Image's ID as an attachment.
		 *     @type string alt      Image's alt text.
		 *     @type string path     Image's path.
		 *     @type int    width    Width of image.
		 *     @type int    height   Height of image.
		 *     @type int    pixels   Number of pixels in the image.
		 *     @type string type     Image's MIME type.
		 *     @type string size     Image's size.
		 *     @type string url      Image's URL.
		 *     @type int    filesize The file size in bytes, if already set.
		 * }
		 * @param int   $attachment_id Attachment ID.
		 */
		$image = apply_filters( 'wpseo_image_data', $image, $attachment_id );

		// Keep only the keys we need, and nothing else.
		return array_intersect_key( $image, array_flip( [ 'id', 'alt', 'path', 'width', 'height', 'pixels', 'type', 'size', 'url', 'filesize' ] ) );
```

### wpseo_image_image_weight_limit
**File:** `wordpress-seo/inc/class-wpseo-image-utils.php`

**Context:**

```php
return false;
		}

		/**
		 * Filter: 'wpseo_image_image_weight_limit' - Determines what the maximum weight
		 * (in bytes) of an image is allowed to be, default is 2 MB.
		 *
		 * @param int $max_bytes The maximum weight (in bytes) of an image.
		 */
		$max_size = apply_filters( 'wpseo_image_image_weight_limit', 2097152 );

		// We cannot check without a path, so assume it's fine.
		if ( ! isset( $image['path'] ) ) {
```

### wpseo_image_sizes
**File:** `wordpress-seo/inc/class-wpseo-image-utils.php`

**Context:**

```php
* @return array An array of image sizes.
	 */
	public static function get_sizes() {
		/**
		 * Filter: 'wpseo_image_sizes' - Determines which image sizes we'll loop through to get an appropriate image.
		 *
		 * @param array<string> $sizes The array of image sizes to loop through.
		 */
		return apply_filters( 'wpseo_image_sizes', [ 'full', 'large', 'medium_large' ] );
	}

	/**
```

### add_extra_wpseo_meta_fields
**File:** `wordpress-seo/inc/class-wpseo-meta.php`

**Context:**

```php
}
		unset( $option, $network, $box, $type );

		/**
		 * Allow add-on plugins to register their meta fields for management by this class.
		 * Calls to add_filter() must be made before plugins_loaded prio 14.
		 */
		$extra_fields = apply_filters( 'add_extra_wpseo_meta_fields', [] );
		if ( is_array( $extra_fields ) ) {
			self::$meta_fields = self::array_merge_recursive_distinct( $extra_fields, self::$meta_fields );
		}
```

### wpseo_schema_article_types
**File:** `wordpress-seo/inc/class-wpseo-meta.php`

**Context:**

```php
$article_helper = new Article_Helper();
				if ( $article_helper->is_article_post_type( $post_type ) ) {
					$default_schema_article_type = WPSEO_Options::get( 'schema-article-type-' . $post_type );

					/** This filter is documented in inc/options/class-wpseo-option-titles.php */
					$allowed_article_types = apply_filters( 'wpseo_schema_article_types', Schema_Types::ARTICLE_TYPES );

					if ( ! array_key_exists( $default_schema_article_type, $allowed_article_types ) ) {
						$default_schema_article_type = WPSEO_Options::get_default( 'wpseo_titles', 'schema-article-type-' . $post_type );
```

### wpseo_posts_for_focus_keyword
**File:** `wordpress-seo/inc/class-wpseo-meta.php`

**Context:**

```php
* that the keyword has been used multiple times before.
		 */
		if ( count( $post_ids ) < 2 ) {
			/**
			 * Allows enhancing the array of posts' that share their focus keywords with the post's focus keywords.
			 *
			 * @param array  $post_ids The array of posts' ids that share their related keywords with the post.
			 * @param string $keyword  The keyword to search for.
			 * @param int    $post_id  The id of the post the keyword is associated to.
			 */
			$post_ids = apply_filters( 'wpseo_posts_for_focus_keyword', $post_ids, $keyword, $post_id );
		}

		return $post_ids;
```

### wpseo_replacements
**File:** `wordpress-seo/inc/class-wpseo-replace-vars.php`

**Context:**

```php
$replacements = $this->set_up_replacements( $matches, $omit );
		}

		/**
		 * Filter: 'wpseo_replacements' - Allow customization of the replacements before they are applied.
		 *
		 * @param array $replacements The replacements.
		 * @param array $args         The object some of the replacement values might come from,
		 *                            could be a post, taxonomy or term.
		 */
		$replacements = apply_filters( 'wpseo_replacements', $replacements, $this->args );

		// Do the actual replacements.
		if ( is_array( $replacements ) && $replacements !== [] ) {
```

### wpseo_replacements_final
**File:** `wordpress-seo/inc/class-wpseo-replace-vars.php`

**Context:**

```php
);
		}

		/**
		 * Filter: 'wpseo_replacements_final' - Allow overruling of whether or not to remove placeholders
		 * which didn't yield a replacement.
		 *
		 * @example <code>add_filter( 'wpseo_replacements_final', '__return_false' );</code>
		 *
		 * @param bool $final
		 */
		if ( apply_filters( 'wpseo_replacements_final', true ) === true && ( isset( $matches[1] ) && is_array( $matches[1] ) ) ) {
			// Remove non-replaced variables.
			$remove = array_diff( $matches[1], $omit ); // Make sure the $omit variables do not get removed.
			$remove = array_map( [ self::class, 'add_var_delimiter' ], $remove );
			$text   = str_replace( $remove, '', $text );
		}
```

### wpseo_terms
**File:** `wordpress-seo/inc/class-wpseo-replace-vars.php`

**Context:**

```php
}
		unset( $terms, $term );

		/**
		 * Allows filtering of the terms list used to replace %%category%%, %%tag%%
		 * and %%ct_<custom-tax-name>%% variables.
		 *
		 * @param string $output   Comma-delimited string containing the terms.
		 * @param string $taxonomy The taxonomy of the terms.
		 */
		return apply_filters( 'wpseo_terms', $output, $taxonomy );
	}

	/**
```

### wpseo_allow_system_file_edit
**File:** `wordpress-seo/inc/class-wpseo-utils.php`

**Context:**

```php
$allowed = false;
		}

		/**
		 * Filter: 'wpseo_allow_system_file_edit' - Allow developers to change whether the editing of
		 * .htaccess and robots.txt is allowed.
		 *
		 * @param bool $allowed Whether file editing is allowed.
		 */
		return apply_filters( 'wpseo_allow_system_file_edit', $allowed );
	}

	/**
```

### sanitize_text_field
**File:** `wordpress-seo/inc/class-wpseo-utils.php`

**Context:**

```php
$filtered = trim( preg_replace( '` +`', ' ', $filtered ) );
		}

		/**
		 * Filter a sanitized text field string.
		 *
		 * @since WP 2.9.0
		 *
		 * @param string $filtered The sanitized string.
		 * @param string $str      The string prior to being sanitized.
		 */
		return apply_filters( 'sanitize_text_field', $filtered, $value ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Using WP native filter.
	}

	/**
	 * Sanitize a url for saving to the database.
	 * Not to be confused with the old native WP function.
	 *
	 * @since 1.8.0
	 *
	 * @param string $value             String URL value to sanitize.
	 * @param array  $allowed_protocols Optional set of allowed protocols.
	 *
	 * @return string
	 */
	public static function sanitize_url( $value, $allowed_protocols = [ 'http', 'https' ] ) {

		$url   = '';
		$parts = wp_parse_url( $value );

		if ( isset( $parts['scheme'], $parts['host'] ) ) {
```

### wpseo_format_admin_url
**File:** `wordpress-seo/inc/class-wpseo-utils.php`

**Context:**

```php
if ( ! empty( $parsed_url['query'] ) ) {
			$formatted_url .= '?' . $parsed_url['query'];
		}

		return apply_filters( 'wpseo_format_admin_url', $formatted_url );
	}

	/**
```

### yoast_seo_development_mode
**File:** `wordpress-seo/inc/class-wpseo-utils.php`

**Context:**

```php
$development_mode = true;
		}

		/**
		 * Filter the Yoast SEO development mode.
		 *
		 * @since 3.0
		 *
		 * @param bool $development_mode Is Yoast SEOs development mode active.
		 */
		return apply_filters( 'yoast_seo_development_mode', $development_mode );
	}

	/**
```

### wpseo_admin_l10n
**File:** `wordpress-seo/inc/class-wpseo-utils.php`

**Context:**

```php
'isBreadcrumbsDisabled' => WPSEO_Options::get( 'breadcrumbs-enable', false ) !== true && ! current_theme_supports( 'yoast-seo-breadcrumbs' ),
			'isAiFeatureActive'     => (bool) WPSEO_Options::get( 'enable_ai_generator' ),
		];

		$additional_entries = apply_filters( 'wpseo_admin_l10n', [] );
		if ( is_array( $additional_entries ) ) {
			$wpseo_admin_l10n = array_merge( $wpseo_admin_l10n, $additional_entries );
		}
```

### wpseo_debug_json_data
**File:** `wordpress-seo/inc/class-wpseo-utils.php`

**Context:**

```php
if ( self::is_development_mode() ) {
			$flags = ( $flags | JSON_PRETTY_PRINT );

			/**
			 * Filter the Yoast SEO development mode.
			 *
			 * @param array $data Allows filtering of the JSON data for debug purposes.
			 */
			$data = apply_filters( 'wpseo_debug_json_data', $data );
		}

		// phpcs:ignore Yoast.Yoast.JsonEncodeAlternative.FoundWithAdditionalParams -- This is the definition of format_json_encode.
```

### wpseo_defaults
**File:** `wordpress-seo/inc/options/class-wpseo-option.php`

**Context:**

```php
if ( method_exists( $this, 'enrich_defaults' ) ) {
			$this->enrich_defaults();
		}

		return apply_filters( 'wpseo_defaults', $this->defaults, $this->option_name );
	}

	/**
```

### wpseo_options
**File:** `wordpress-seo/inc/options/class-wpseo-options.php`

**Context:**

```php
}
		}

		/**
		 * Filter: wpseo_options - Allow developers to change the option name to include.
		 *
		 * @param array $option_names The option names to include in get_all and reset().
		 */
		return apply_filters( 'wpseo_options', $option_names );
	}

	/**
```

### default_option_{$option}
**File:** `wordpress-seo/inc/options/class-wpseo-options.php`

**Context:**

```php
$value = wp_cache_get( $option, 'options' );
		if ( $value === false ) {
			$passed_default = func_num_args() > 1;

			// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Using WP native filter.
			return apply_filters( "default_option_{$option}", $default_value, $option, $passed_default );
		}

		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Using WP native filter.
```

### option_{$option}
**File:** `wordpress-seo/inc/options/class-wpseo-options.php`

**Context:**

```php
// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Using WP native filter.
			return apply_filters( "default_option_{$option}", $default_value, $option, $passed_default );
		}

		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Using WP native filter.
		return apply_filters( "option_{$option}", maybe_unserialize( $value ), $option );
	}

	/**
```

### wpseo_separator_options
**File:** `wordpress-seo/inc/options/class-wpseo-option-titles.php`

**Context:**

```php
public function get_separator_options() {
		$separators = wp_list_pluck( self::get_separator_option_list(), 'option' );

		/**
		 * Allow altering the array with separator options.
		 *
		 * @param array $separator_options Array with the separator options.
		 */
		$filtered_separators = apply_filters( 'wpseo_separator_options', $separators );

		if ( is_array( $filtered_separators ) && $filtered_separators !== [] ) {
			$separators = array_merge( $separators, $filtered_separators );
```

### wpseo_option_titles_variable_array_key_patterns
**File:** `wordpress-seo/inc/options/class-wpseo-option-titles.php`

**Context:**

```php
$patterns   = $this->variable_array_key_patterns;
			$patterns[] = 'tax-hideeditbox-';

			/**
			 * Allow altering the array with variable array key patterns.
			 *
			 * @param array $patterns Array with the variable array key patterns.
			 */
			$patterns = apply_filters( 'wpseo_option_titles_variable_array_key_patterns', $patterns );

			foreach ( $dirty as $key => $value ) {
```

### wpseo_separator_option_list
**File:** `wordpress-seo/inc/options/class-wpseo-option-titles.php`

**Context:**

```php
],
		];

		/**
		 * Allows altering the separator options array.
		 *
		 * @param array $separators Array with the separator options.
		 */
		$separator_list = apply_filters( 'wpseo_separator_option_list', $separators );

		if ( ! is_array( $separator_list ) ) {
			return $separators;
```

### wpseo_option_wpseo_defaults
**File:** `wordpress-seo/inc/options/class-wpseo-option-wpseo.php`

**Context:**

```php
add_filter( 'admin_title', [ 'Yoast_Input_Validation', 'add_yoast_admin_document_title_errors' ] );

		/**
		 * Filter the `wpseo` option defaults.
		 *
		 * @param array $defaults Array the defaults for the `wpseo` option attributes.
		 */
		$this->defaults = apply_filters( 'wpseo_option_wpseo_defaults', $this->defaults );
	}

	/**
```

### wpseo_add_extra_taxmeta_term_defaults
**File:** `wordpress-seo/inc/options/class-wpseo-taxonomy-meta.php`

**Context:**

```php
* @return void
	 */
	public function enrich_defaults() {
		$extra_defaults_per_term = apply_filters( 'wpseo_add_extra_taxmeta_term_defaults', [] );
		if ( is_array( $extra_defaults_per_term ) ) {
			self::$defaults_per_term = array_merge( $extra_defaults_per_term, self::$defaults_per_term );
		}
```

### wpseo_sitemap_entry
**File:** `wordpress-seo/inc/sitemaps/class-author-sitemap-provider.php`

**Context:**

```php
'chf' => 'daily',
				'pri' => 1,
			];

			/** This filter is documented at inc/sitemaps/class-post-type-sitemap-provider.php */
			$url = apply_filters( 'wpseo_sitemap_entry', $url, 'user', $user );

			if ( ! empty( $url ) ) {
				$links[] = $url;
```

### wpseo_sitemap_exclude_author
**File:** `wordpress-seo/inc/sitemaps/class-author-sitemap-provider.php`

**Context:**

```php
*/
	protected function exclude_users( $users ) {

		/**
		 * Filter the authors, included in XML sitemap.
		 *
		 * @param array $users Array of user objects to filter.
		 */
		return apply_filters( 'wpseo_sitemap_exclude_author', $users );
	}
}
```

### wpseo_xml_sitemap_include_images
**File:** `wordpress-seo/inc/sitemaps/class-post-type-sitemap-provider.php`

**Context:**

```php
public function __construct() {
		add_action( 'save_post', [ $this, 'save_post' ] );

		/**
		 * Filter - Allows excluding images from the XML sitemap.
		 *
		 * @param bool $include True to include, false to exclude.
		 */
		$this->include_images = apply_filters( 'wpseo_xml_sitemap_include_images', true );
	}

	/**
```

### wpseo_sitemap_exclude_post_type
**File:** `wordpress-seo/inc/sitemaps/class-post-type-sitemap-provider.php`

**Context:**

```php
return false;
		}

		/**
		 * Filter decision if post type is excluded from the XML sitemap.
		 *
		 * @param bool   $exclude   Default false.
		 * @param string $post_type Post type name.
		 */
		if ( apply_filters( 'wpseo_sitemap_exclude_post_type', false, $post_type ) ) {
			return false;
		}

		return true;
```

### wpseo_exclude_from_sitemap_by_post_ids
**File:** `wordpress-seo/inc/sitemaps/class-post-type-sitemap-provider.php`

**Context:**

```php
$excluded_posts_ids[] = $page_on_front_id;
		}

		/**
		 * Filter: 'wpseo_exclude_from_sitemap_by_post_ids' - Allow extending and modifying the posts to exclude.
		 *
		 * @param array $posts_to_exclude The posts to exclude.
		 */
		$excluded_posts_ids = apply_filters( 'wpseo_exclude_from_sitemap_by_post_ids', $excluded_posts_ids );
		if ( ! is_array( $excluded_posts_ids ) ) {
			$excluded_posts_ids = [];
		}
```

### wpseo_typecount_join
**File:** `wordpress-seo/inc/sitemaps/class-post-type-sitemap-provider.php`

**Context:**

```php
global $wpdb;

		/**
		 * Filter JOIN query part for type count of post type.
		 *
		 * @param string $join      SQL part, defaults to empty string.
		 * @param string $post_type Post type name.
		 */
		$join_filter = apply_filters( 'wpseo_typecount_join', '', $post_type );

		/**
		 * Filter WHERE query part for type count of post type.
```

### wpseo_typecount_where
**File:** `wordpress-seo/inc/sitemaps/class-post-type-sitemap-provider.php`

**Context:**

```php
*/
		$join_filter = apply_filters( 'wpseo_typecount_join', '', $post_type );

		/**
		 * Filter WHERE query part for type count of post type.
		 *
		 * @param string $where     SQL part, defaults to empty string.
		 * @param string $post_type Post type name.
		 */
		$where_filter = apply_filters( 'wpseo_typecount_where', '', $post_type );

		$where = $this->get_sql_where_clause( $post_type );
```

### wpseo_sitemap_urlimages_front_page
**File:** `wordpress-seo/inc/sitemaps/class-post-type-sitemap-provider.php`

**Context:**

```php
$images = ( $front_page['images'] ?? [] );

			/**
			 * Filter images to be included for the term in XML sitemap.
			 *
			 * @param array  $images Array of image items.
			 * @return array $image_list Array of image items.
			 */
			$image_list = apply_filters( 'wpseo_sitemap_urlimages_front_page', $images );
			if ( is_array( $image_list ) ) {
				$front_page['images'] = $image_list;
			}
```

### wpseo_sitemap_post_type_archive_link
**File:** `wordpress-seo/inc/sitemaps/class-post-type-sitemap-provider.php`

**Context:**

```php
$links[] = $front_page;
		}
		elseif ( $post_type !== 'page' ) {
			/**
			 * Filter the URL Yoast SEO uses in the XML sitemap for this post type archive.
			 *
			 * @param string $archive_url The URL of this archive
			 * @param string $post_type   The post type this archive is for.
			 */
			$archive_url = apply_filters(
				'wpseo_sitemap_post_type_archive_link',
				$this->get_post_type_archive_link( $post_type ),
				$post_type
			);
		}

		if ( $archive_url ) {
```

### wpseo_sitemap_post_type_first_links
**File:** `wordpress-seo/inc/sitemaps/class-post-type-sitemap-provider.php`

**Context:**

```php
];
		}

		/**
		 * Filters the first post type links.
		 *
		 * @param array  $links     The first post type links.
		 * @param string $post_type The post type this archive is for.
		 */
		return apply_filters( 'wpseo_sitemap_post_type_first_links', $links, $post_type );
	}

	/**
```

### wpseo_sitemap_page_for_post_type_archive
**File:** `wordpress-seo/inc/sitemaps/class-post-type-sitemap-provider.php`

**Context:**

```php
return false;
		}

		/**
		 * Filter the page which is dedicated to this post type archive.
		 *
		 * @since 9.3
		 *
		 * @param string $archive_page_id The post_id of the page.
		 * @param string $post_type       The post type this archive is for.
		 */
		$archive_page_id = (int) apply_filters( 'wpseo_sitemap_page_for_post_type_archive', $archive_page_id, $post_type );

		if ( $archive_page_id > 0 && WPSEO_Meta::get_value( 'meta-robots-noindex', $archive_page_id ) === '1' ) {
			return false;
```

### wpseo_posts_join
**File:** `wordpress-seo/inc/sitemaps/class-post-type-sitemap-provider.php`

**Context:**

```php
if ( ! isset( $filters[ $post_type ] ) ) {
			// Make sure you're wpdb->preparing everything you throw into this!!
			$filters[ $post_type ] = [
				/**
				 * Filter JOIN query part for the post type.
				 *
				 * @param string $join      SQL part, defaults to false.
				 * @param string $post_type Post type name.
				 */
				'join'  => apply_filters( 'wpseo_posts_join', false, $post_type ),

				/**
				 * Filter WHERE query part for the post type.
				 *
				 * @param string $where     SQL part, defaults to false.
				 * @param string $post_type Post type name.
				 */
				'where' => apply_filters( 'wpseo_posts_where', false, $post_type ),
			];
		}

		$join_filter  = $filters[ $post_type ]['join'];
```

### wpseo_posts_where
**File:** `wordpress-seo/inc/sitemaps/class-post-type-sitemap-provider.php`

**Context:**

```php
*/
				'join'  => apply_filters( 'wpseo_posts_join', false, $post_type ),

				/**
				 * Filter WHERE query part for the post type.
				 *
				 * @param string $where     SQL part, defaults to false.
				 * @param string $post_type Post type name.
				 */
				'where' => apply_filters( 'wpseo_posts_where', false, $post_type ),
			];
		}

		$join_filter  = $filters[ $post_type ]['join'];
```

### wpseo_xml_sitemap_post_url
**File:** `wordpress-seo/inc/sitemaps/class-post-type-sitemap-provider.php`

**Context:**

```php
$url = [];

		/**
		 * Filter the URL Yoast SEO uses in the XML sitemap.
		 *
		 * Note that only absolute local URLs are allowed as the check after this removes external URLs.
		 *
		 * @param string $url  URL to use in the XML sitemap
		 * @param object $post Post object for the URL.
		 */
		$url['loc'] = apply_filters( 'wpseo_xml_sitemap_post_url', get_permalink( $post ), $post );
		$link_type  = YoastSEO()->helpers->url->get_link_type(
			wp_parse_url( $url['loc'] ),
			$this->get_parsed_home_url()
```

### wpseo_sitemap_content_before_parse_html_images
**File:** `wordpress-seo/inc/sitemaps/class-sitemap-image-parser.php`

**Context:**

```php
$images[] = $this->get_image_item( $post, $src );
		}

		/**
		 * Filter: 'wpseo_sitemap_content_before_parse_html_images' - Filters the post content
		 * before it is parsed for images.
		 *
		 * @param string $content The raw/unprocessed post content.
		 */
		$content = apply_filters( 'wpseo_sitemap_content_before_parse_html_images', $post->post_content );

		$unfiltered_images = $this->parse_html_images( $content );
```

### wpseo_sitemap_urlimages
**File:** `wordpress-seo/inc/sitemaps/class-sitemap-image-parser.php`

**Context:**

```php
}
		}

		/**
		 * Filter images to be included for the post in XML sitemap.
		 *
		 * @param array $images  Array of image items.
		 * @param int   $post_id ID of the post.
		 */
		$image_list = apply_filters( 'wpseo_sitemap_urlimages', $images, $post->ID );
		if ( isset( $image_list ) && is_array( $image_list ) ) {
			$images = $image_list;
		}
```

### wpseo_sitemap_urlimages_term
**File:** `wordpress-seo/inc/sitemaps/class-sitemap-image-parser.php`

**Context:**

```php
];
		}

		/**
		 * Filter images to be included for the term in XML sitemap.
		 *
		 * @param array $image_list Array of image items.
		 * @param int   $term_id    ID of the post.
		 */
		$image_list = apply_filters( 'wpseo_sitemap_urlimages_term', $images, $term->term_id );
		if ( isset( $image_list ) && is_array( $image_list ) ) {
			$images = $image_list;
		}
```

### wpseo_xml_sitemap_img_src
**File:** `wordpress-seo/inc/sitemaps/class-sitemap-image-parser.php`

**Context:**

```php
$image = [];

		/**
		 * Filter image URL to be included in XML sitemap for the post.
		 *
		 * @param string $src  Image URL.
		 * @param object $post Post object.
		 */
		$image['src'] = apply_filters( 'wpseo_xml_sitemap_img_src', $src, $post );

		/**
		 * Filter image data to be included in XML sitemap for the post.
```

### wpseo_xml_sitemap_img
**File:** `wordpress-seo/inc/sitemaps/class-sitemap-image-parser.php`

**Context:**

```php
*/
		$image['src'] = apply_filters( 'wpseo_xml_sitemap_img_src', $src, $post );

		/**
		 * Filter image data to be included in XML sitemap for the post.
		 *
		 * @param array  $image {
		 *     Array of image data.
		 *
		 *     @type string  $src   Image URL.
		 * }
		 *
		 * @param object $post  Post object.
		 */
		return apply_filters( 'wpseo_xml_sitemap_img', $image, $post );
	}

	/**
```

### wp_get_attachment_url
**File:** `wordpress-seo/inc/sitemaps/class-sitemap-image-parser.php`

**Context:**

```php
// It's a newly uploaded file, therefore $file is relative to the baseurl.
			$src = $uploads['baseurl'] . '/' . $file;
		}

		return apply_filters( 'wp_get_attachment_url', $src, $post_id );
	}

	/**
```

### wpseo_enable_xml_sitemap_transient_caching
**File:** `wordpress-seo/inc/sitemaps/class-sitemaps-cache.php`

**Context:**

```php
*/
	public function is_enabled() {

		/**
		 * Filter if XML sitemap transient cache is enabled.
		 *
		 * @param bool $unsigned Enable cache or not, defaults to true.
		 */
		return apply_filters( 'wpseo_enable_xml_sitemap_transient_caching', false );
	}

	/**
```

### wpseo_sitemaps_providers
**File:** `wordpress-seo/inc/sitemaps/class-sitemaps.php`

**Context:**

```php
new WPSEO_Taxonomy_Sitemap_Provider(),
			new WPSEO_Author_Sitemap_Provider(),
		];

		$external_providers = apply_filters( 'wpseo_sitemaps_providers', [] );

		foreach ( $external_providers as $provider ) {
			if ( is_object( $provider ) && $provider instanceof WPSEO_Sitemap_Provider ) {
```

### wpseo_build_sitemap_post_type
**File:** `wordpress-seo/inc/sitemaps/class-sitemaps.php`

**Context:**

```php
*/
	public function build_sitemap( $type ) {

		/**
		 * Filter the type of sitemap to build.
		 *
		 * @param string $type Sitemap type, determined by the request.
		 */
		$type = apply_filters( 'wpseo_build_sitemap_post_type', $type );

		if ( $type === '1' ) {
			$this->build_root_map();
```

### wpseo_sitemap_index_links
**File:** `wordpress-seo/inc/sitemaps/class-sitemaps.php`

**Context:**

```php
$links = array_merge( $links, $provider->get_index_links( $entries_per_page ) );
		}

		/**
		 * Filter the sitemap links array before the index sitemap is built.
		 *
		 * @param array  $links Array of sitemap links
		 */
		$links = apply_filters( 'wpseo_sitemap_index_links', $links );

		if ( empty( $links ) ) {
			$this->bad_sitemap = true;
```

### wpseo_sitemap_entries_per_page
**File:** `wordpress-seo/inc/sitemaps/class-sitemaps.php`

**Context:**

```php
* @return int The maximum number of entries.
	 */
	protected function get_entries_per_page() {
		/**
		 * Filter the maximum number of entries per XML sitemap.
		 *
		 * After changing the output of the filter, make sure that you disable and enable the
		 * sitemaps to make sure the value is picked up for the sitemap cache.
		 *
		 * @param int $entries The maximum number of entries per XML sitemap.
		 */
		$entries = (int) apply_filters( 'wpseo_sitemap_entries_per_page', 1000 );

		return $entries;
	}
```

### wpseo_sitemap_post_statuses
**File:** `wordpress-seo/inc/sitemaps/class-sitemaps.php`

**Context:**

```php
* @return array List of post statuses.
	 */
	public static function get_post_statuses( $type = self::SITEMAP_INDEX_TYPE ) {
		/**
		 * Filter post status list for sitemap query for the post type.
		 *
		 * @param array  $post_statuses Post status list, defaults to array( 'publish' ).
		 * @param string $type          Post type or SITEMAP_INDEX_TYPE.
		 */
		$post_statuses = apply_filters( 'wpseo_sitemap_post_statuses', [ 'publish' ], $type );

		if ( ! is_array( $post_statuses ) || empty( $post_statuses ) ) {
			$post_statuses = [ 'publish' ];
```

### wpseo_sitemap_http_headers
**File:** `wordpress-seo/inc/sitemaps/class-sitemaps.php`

**Context:**

```php
'Content-Type: text/xml; charset=' . esc_attr( $this->renderer->get_output_charset() ) => '',
		];

		/**
		 * Filter the HTTP headers we send before an XML sitemap.
		 *
		 * @param array  $headers The HTTP headers we're going to send out.
		 */
		$headers = apply_filters( 'wpseo_sitemap_http_headers', $headers );

		foreach ( $headers as $header => $status ) {
			if ( is_numeric( $status ) ) {
```

### wpseo_sitemaps_base_url
**File:** `wordpress-seo/inc/sitemaps/class-sitemaps-router.php`

**Context:**

```php
$base = $wp_rewrite->using_index_permalinks() ? 'index.php/' : '/';

		/**
		 * Filter the base URL of the sitemaps.
		 *
		 * @param string $base The string that should be added to home_url() to make the full base URL.
		 */
		$base = apply_filters( 'wpseo_sitemaps_base_url', $base );

		/*
		 * Get the scheme from the configured home URL instead of letting WordPress
```

### wpseo_sitemap_exclude_empty_terms
**File:** `wordpress-seo/inc/sitemaps/class-taxonomy-sitemap-provider.php`

**Context:**

```php
// Retrieve all the taxonomies and their terms so we can do a proper count on them.

		/**
		 * Filter the setting of excluding empty terms from the XML sitemap.
		 *
		 * @param bool  $exclude        Defaults to true.
		 * @param array $taxonomy_names Array of names for the taxonomies being processed.
		 */
		$hide_empty = apply_filters( 'wpseo_sitemap_exclude_empty_terms', true, $taxonomy_names );

		$all_taxonomies = [];
```

### wpseo_sitemap_exclude_empty_terms_taxonomy
**File:** `wordpress-seo/inc/sitemaps/class-taxonomy-sitemap-provider.php`

**Context:**

```php
$all_taxonomies = [];

		foreach ( $taxonomy_names as $taxonomy_name ) {
			/**
			 * Filter the setting of excluding empty terms from the XML sitemap for a specific taxonomy.
			 *
			 * @param bool   $exclude       Defaults to the sitewide setting.
			 * @param string $taxonomy_name The name of the taxonomy being processed.
			 */
			$hide_empty_tax = apply_filters( 'wpseo_sitemap_exclude_empty_terms_taxonomy', $hide_empty, $taxonomy_name );

			$term_args      = [
				'taxonomy'   => $taxonomy_name,
```

### wpseo_exclude_from_sitemap_by_term_ids
**File:** `wordpress-seo/inc/sitemaps/class-taxonomy-sitemap-provider.php`

**Context:**

```php
[ 'post_password' ]
		);

		/**
		 * Filter: 'wpseo_exclude_from_sitemap_by_term_ids' - Allow excluding terms by ID.
		 *
		 * @param array $terms_to_exclude The terms to exclude.
		 */
		$terms_to_exclude = apply_filters( 'wpseo_exclude_from_sitemap_by_term_ids', [] );

		foreach ( $terms as $term ) {
```

### wpseo_sitemap_exclude_taxonomy
**File:** `wordpress-seo/inc/sitemaps/class-taxonomy-sitemap-provider.php`

**Context:**

```php
return false;
		}

		/**
		 * Filter to exclude the taxonomy from the XML sitemap.
		 *
		 * @param bool   $exclude       Defaults to false.
		 * @param string $taxonomy_name Name of the taxonomy to exclude..
		 */
		if ( apply_filters( 'wpseo_sitemap_exclude_taxonomy', false, $taxonomy_name ) ) {
			return false;
		}

		return true;
```

### wpseo_allowed_dismissable_alerts
**File:** `wordpress-seo/src/actions/alert-dismissal-action.php`

**Context:**

```php
* @return string[] The allowed dismissable alerts.
	 */
	protected function get_allowed_dismissable_alerts() {
		/**
		 * Filter: 'wpseo_allowed_dismissable_alerts' - List of allowed dismissable alerts.
		 *
		 * @param string[] $allowed_dismissable_alerts Allowed dismissable alerts list.
		 */
		$allowed_dismissable_alerts = \apply_filters( 'wpseo_allowed_dismissable_alerts', [] );

		if ( \is_array( $allowed_dismissable_alerts ) === false ) {
			return [];
```

### wpseo_aioseo_cleanup_limit
**File:** `wordpress-seo/src/actions/importing/aioseo/aioseo-cleanup-action.php`

**Context:**

```php
* @return int The limit.
	 */
	public function get_limit() {
		/**
		 * Filter 'wpseo_aioseo_cleanup_limit' - Allow filtering the number of posts indexed during each indexing pass.
		 *
		 * @param int $max_posts The maximum number of posts cleaned up.
		 */
		$limit = \apply_filters( 'wpseo_aioseo_cleanup_limit', 25 );

		if ( ! \is_int( $limit ) || $limit < 1 ) {
			$limit = 25;
```

### wpseo_aioseo_post_indexation_limit
**File:** `wordpress-seo/src/actions/importing/aioseo/aioseo-posts-importing-action.php`

**Context:**

```php
* @return int The limit.
	 */
	public function get_limit() {
		/**
		 * Filter 'wpseo_aioseo_post_indexation_limit' - Allow filtering the number of posts indexed during each indexing pass.
		 *
		 * @param int $max_posts The maximum number of posts indexed.
		 */
		$limit = \apply_filters( 'wpseo_aioseo_post_indexation_limit', 25 );

		if ( ! \is_int( $limit ) || $limit < 1 ) {
			$limit = 25;
```

### wpseo_aioseo_post_import_cursor
**File:** `wordpress-seo/src/actions/importing/aioseo/aioseo-posts-importing-action.php`

**Context:**

```php
$cursor_id = $this->get_cursor_id();
		$cursor    = $this->import_cursor->get_cursor( $cursor_id );

		/**
		 * Filter 'wpseo_aioseo_post_cursor' - Allow filtering the value of the aioseo post import cursor.
		 *
		 * @param int $import_cursor The value of the aioseo post import cursor.
		 */
		$cursor = \apply_filters( 'wpseo_aioseo_post_import_cursor', $cursor );

		$replacements = [ $cursor ];
```

### wpseo_aioseo_validation_limit
**File:** `wordpress-seo/src/actions/importing/aioseo/aioseo-validate-data-action.php`

**Context:**

```php
* @return int The limit.
	 */
	public function get_limit() {
		/**
		 * Filter 'wpseo_aioseo_cleanup_limit' - Allow filtering the number of validations during each action pass.
		 *
		 * @param int $limit The maximum number of validations.
		 */
		$limit = \apply_filters( 'wpseo_aioseo_validation_limit', 25 );

		if ( ! \is_int( $limit ) || $limit < 1 ) {
			$limit = 25;
```

### wpseo_link_indexing_limit
**File:** `wordpress-seo/src/actions/indexing/abstract-link-indexing-action.php`

**Context:**

```php
* @return int The limit.
	 */
	public function get_limit() {
		/**
		 * Filter 'wpseo_link_indexing_limit' - Allow filtering the number of texts indexed during each link indexing pass.
		 *
		 * @param int $limit The maximum number of texts indexed.
		 */
		return \apply_filters( 'wpseo_link_indexing_limit', 5 );
	}

	/**
```

### wpseo_post_indexation_limit
**File:** `wordpress-seo/src/actions/indexing/indexable-post-indexation-action.php`

**Context:**

```php
* @return int The limit.
	 */
	public function get_limit() {
		/**
		 * Filter 'wpseo_post_indexation_limit' - Allow filtering the amount of posts indexed during each indexing pass.
		 *
		 * @param int $limit The maximum number of posts indexed.
		 */
		$limit = \apply_filters( 'wpseo_post_indexation_limit', 25 );

		if ( ! \is_int( $limit ) || $limit < 1 ) {
			$limit = 25;
```

### wpseo_post_type_archive_indexation_limit
**File:** `wordpress-seo/src/actions/indexing/indexable-post-type-archive-indexation-action.php`

**Context:**

```php
* @return int The limit.
	 */
	public function get_limit() {
		/**
		 * Filter 'wpseo_post_type_archive_indexation_limit' - Allow filtering the number of posts indexed during each indexing pass.
		 *
		 * @param int $limit The maximum number of posts indexed.
		 */
		$limit = \apply_filters( 'wpseo_post_type_archive_indexation_limit', 25 );

		if ( ! \is_int( $limit ) || $limit < 1 ) {
			$limit = 25;
```

### wpseo_term_indexation_limit
**File:** `wordpress-seo/src/actions/indexing/indexable-term-indexation-action.php`

**Context:**

```php
* @return int The limit.
	 */
	public function get_limit() {
		/**
		 * Filter 'wpseo_term_indexation_limit' - Allow filtering the number of terms indexed during each indexing pass.
		 *
		 * @param int $limit The maximum number of terms indexed.
		 */
		$limit = \apply_filters( 'wpseo_term_indexation_limit', 25 );

		if ( ! \is_int( $limit ) || $limit < 1 ) {
			$limit = 25;
```

### wpseo_wincher_keyphrases_from_post
**File:** `wordpress-seo/src/actions/wincher/wincher-keyphrases-action.php`

**Context:**

```php
$keyphrases[] = $primary_keyphrase->primary_focus_keyword;
		}

		/**
		 * Filters the keyphrases collected by the Wincher integration from the post.
		 *
		 * @param array $keyphrases The keyphrases array.
		 * @param int   $post_id    The ID of the post.
		 */
		return \apply_filters( 'wpseo_wincher_keyphrases_from_post', $keyphrases, $post->ID );
	}

	/**
```

### wpseo_wincher_all_keyphrases
**File:** `wordpress-seo/src/actions/wincher/wincher-keyphrases-action.php`

**Context:**

```php
'primary_focus_keyword'
		);

		/**
		 * Filters the keyphrases collected by the Wincher integration from all the posts.
		 *
		 * @param array $keyphrases The keyphrases array.
		 */
		$keyphrases = \apply_filters( 'wpseo_wincher_all_keyphrases', $keyphrases );

		// Filter out empty entries.
		return \array_filter( $keyphrases );
```

### Yoast\WP\SEO\ai_api_url
**File:** `wordpress-seo/src/ai-http-request/infrastructure/api-client.php`

**Context:**

```php
$arguments['body'] = WPSEO_Utils::format_json_encode( $body );
		}

		/**
		 * Filter: 'Yoast\WP\SEO\ai_api_url' - Replaces the default URL for the AI API with a custom one.
		 *
		 * @internal
		 *
		 * @param string $url The default URL for the AI API.
		 */
		$url      = \apply_filters( 'Yoast\WP\SEO\ai_api_url', $this->base_url );
		$response = ( $is_post ) ? \wp_remote_post( $url . $action_path, $arguments ) : \wp_remote_get( $url . $action_path, $arguments );

		if ( \is_wp_error( $response ) ) {
```

### Yoast\WP\SEO\ai_suggestions_timeout
**File:** `wordpress-seo/src/ai-http-request/infrastructure/api-client.php`

**Context:**

```php
* @return int The timeout of the suggestion requests in seconds.
	 */
	public function get_request_timeout(): int {
		/**
		 * Filter: 'Yoast\WP\SEO\ai_suggestions_timeout' - Replaces the default timeout with a custom one, for testing purposes.
		 *
		 * @since 22.7
		 * @internal
		 *
		 * @param int $timeout The default timeout in seconds.
		 */
		return (int) \apply_filters( 'Yoast\WP\SEO\ai_suggestions_timeout', 60 );
	}
}
```

### wpseo_indexable_collector_add_indexation_actions
**File:** `wordpress-seo/src/analytics/application/missing-indexables-collector.php`

**Context:**

```php
* @return void
	 */
	private function add_additional_indexing_actions() {
		/**
		 * Filter: Adds the possibility to add additional indexation actions to be included in the count routine.
		 *
		 * @internal
		 * @param Indexation_Action_Interface $actions This filter expects a list of Indexation_Action_Interface instances
		 *                                             and expects only Indexation_Action_Interface implementations to be
		 *                                             added to the list.
		 */
		$indexing_actions = (array) \apply_filters( 'wpseo_indexable_collector_add_indexation_actions', $this->indexation_actions );

		$this->indexation_actions = \array_filter(
			$indexing_actions,
```

### wpseo_should_build_and_save_user_indexable
**File:** `wordpress-seo/src/builders/indexable-author-builder.php`

**Context:**

```php
$exception = Author_Not_Built_Exception::author_archives_are_not_indexed_for_users_without_posts( $user_id );
		}

		/**
		 * Filter: Include or exclude a user from being build and saved as an indexable.
		 * Return an `Author_Not_Built_Exception` when the indexable should not be build, with an appropriate message telling why it should not be built.
		 * Return `null` if the indexable should be build.
		 *
		 * @param Author_Not_Built_Exception|null $exception An exception if the indexable is not being built, `null` if the indexable should be built.
		 * @param string                          $user_id   The ID of the user that should or should not be excluded.
		 */
		return \apply_filters( 'wpseo_should_build_and_save_user_indexable', $exception, $user_id );
	}
}
```

### the_content
**File:** `wordpress-seo/src/builders/indexable-link-builder.php`

**Context:**

```php
// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited -- To setup the post we need to do this explicitly.
			$post = $this->post_helper->get_post( $indexable->object_id );
			\setup_postdata( $post );
			$content = \apply_filters( 'the_content', $content );
			\wp_reset_postdata();
			// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited -- To setup the post we need to do this explicitly.
			$post = $post_backup;
```

### wpseo_force_creating_and_using_attachment_indexables
**File:** `wordpress-seo/src/builders/indexable-link-builder.php`

**Context:**

```php
if ( $model->type === SEO_Links::TYPE_INTERNAL_IMAGE ) {
			$permalink = $this->build_permalink( $url, $home_url );

			/** The `wpseo_force_creating_and_using_attachment_indexables` filter is documented in indexable-link-builder.php */
			if ( ! $this->options_helper->get( 'disable-attachment' ) || \apply_filters( 'wpseo_force_creating_and_using_attachment_indexables', false ) ) {
				$model = $this->enhance_link_from_indexable( $model, $permalink );
			}
			else {
				$target_post_id = ( $image_id !== 0 ) ? $image_id : WPSEO_Image_Utils::get_attachment_by_url( $permalink );
```

### googlesitekit_is_feature_enabled
**File:** `wordpress-seo/src/conditionals/google-site-kit-feature-conditional.php`

**Context:**

```php
* @return bool `true` when the Site Kit feature is enabled.
	 */
	public function is_met() {
		return $this->options->get( 'google_site_kit_feature_enabled' ) === true || \apply_filters( 'googlesitekit_is_feature_enabled', false, 'yoastIntegration' );
	}
}
```

### wpseo_primary_category_admin_pages
**File:** `wordpress-seo/src/conditionals/primary-category-conditional.php`

**Context:**

```php
return true;
		}

		/**
		 * Filter: Adds the possibility to use primary category at additional admin pages.
		 *
		 * @param array $admin_pages List of additional admin pages.
		 */
		$additional_pages = \apply_filters( 'wpseo_primary_category_admin_pages', [] );
		return \in_array( $current_page, \array_merge( [ 'edit.php', 'post.php', 'post-new.php' ], $additional_pages ), true );
	}
}
```

### wpseo_should_index_links
**File:** `wordpress-seo/src/conditionals/should-index-links-conditional.php`

**Context:**

```php
public function is_met() {
		$should_index_links = $this->options_helper->get( 'enable_text_link_counter' );

		/**
		 * Filter: 'wpseo_should_index_links' - Allows disabling of Yoast's links indexation.
		 *
		 * @param bool $enable To disable the indexation, return false.
		 */
		return \apply_filters( 'wpseo_should_index_links', $should_index_links );
	}
}
```

### wpseo_schema_article_types_labels
**File:** `wordpress-seo/src/config/schema-types.php`

**Context:**

```php
* @return array[] The schema article type options.
	 */
	public function get_article_type_options() {
		/**
		 * Filter: 'wpseo_schema_article_types_labels' - Allow developers to filter the available article types and their labels.
		 *
		 * Make sure when you filter this to also filter `wpseo_schema_article_types`.
		 *
		 * @param array $schema_article_types_labels The available schema article types and their labels.
		 */
		return \apply_filters(
			'wpseo_schema_article_types_labels',
			[
				[
					'name'  => \__( 'Article', 'wordpress-seo' ),
					'value' => 'Article',
				],
				[
					'name'  => \__( 'Blog Post', 'wordpress-seo' ),
					'value' => 'BlogPosting',
				],
				[
					'name'  => \__( 'Social Media Posting', 'wordpress-seo' ),
					'value' => 'SocialMediaPosting',
				],
				[
					'name'  => \__( 'News Article', 'wordpress-seo' ),
					'value' => 'NewsArticle',
				],
				[
					'name'  => \__( 'Advertiser Content Article', 'wordpress-seo' ),
					'value' => 'AdvertiserContentArticle',
				],
				[
					'name'  => \__( 'Satirical Article', 'wordpress-seo' ),
					'value' => 'SatiricalArticle',
				],
				[
					'name'  => \__( 'Scholarly Article', 'wordpress-seo' ),
					'value' => 'ScholarlyArticle',
				],
				[
					'name'  => \__( 'Tech Article', 'wordpress-seo' ),
					'value' => 'TechArticle',
				],
				[
					'name'  => \__( 'Report', 'wordpress-seo' ),
					'value' => 'Report',
				],
				[
					'name'  => \__( 'None', 'wordpress-seo' ),
					'value' => 'None',
				],
			]
		);
	}
}
```

### wpseo_schema_company_name
**File:** `wordpress-seo/src/context/meta-tags-context.php`

**Context:**

```php
* @return string The company name.
	 */
	public function generate_company_name() {
		/**
		 * Filter: 'wpseo_schema_company_name' - Allows filtering company name
		 *
		 * @param string $company_name.
		 */
		$company_name = \apply_filters( 'wpseo_schema_company_name', $this->options->get( 'company_name' ) );

		if ( empty( $company_name ) ) {
			$company_name = $this->site_name;
```

### wpseo_schema_person_logo_id
**File:** `wordpress-seo/src/context/meta-tags-context.php`

**Context:**

```php
$person_logo_id = $this->fallback_to_site_logo();
		}

		/**
		 * Filter: 'wpseo_schema_person_logo_id' - Allows filtering person logo id.
		 *
		 * @param int $person_logo_id.
		 */
		return \apply_filters( 'wpseo_schema_person_logo_id', $person_logo_id );
	}

	/**
```

### wpseo_schema_person_logo_meta
**File:** `wordpress-seo/src/context/meta-tags-context.php`

**Context:**

```php
$person_logo_meta = $this->image->get_best_attachment_variation( $person_logo_id );
		}

		/**
		 * Filter: 'wpseo_schema_person_logo_meta' - Allows filtering person logo meta.
		 *
		 * @param string $person_logo_meta.
		 */
		return \apply_filters( 'wpseo_schema_person_logo_meta', $person_logo_meta );
	}

	/**
```

### wpseo_schema_company_logo_id
**File:** `wordpress-seo/src/context/meta-tags-context.php`

**Context:**

```php
$company_logo_id = $this->fallback_to_site_logo();
		}

		/**
		 * Filter: 'wpseo_schema_company_logo_id' - Allows filtering company logo id.
		 *
		 * @param int $company_logo_id.
		 */
		return \apply_filters( 'wpseo_schema_company_logo_id', $company_logo_id );
	}

	/**
```

### wpseo_schema_company_logo_meta
**File:** `wordpress-seo/src/context/meta-tags-context.php`

**Context:**

```php
public function generate_company_logo_meta() {
		$company_logo_meta = $this->image->get_attachment_meta_from_settings( 'company_logo' );

		/**
		 * Filter: 'wpseo_schema_company_logo_meta' - Allows filtering company logo meta.
		 *
		 * @param string $company_logo_meta.
		 */
		return \apply_filters( 'wpseo_schema_company_logo_meta', $company_logo_meta );
	}

	/**
```

### wpseo_schema_webpage_type
**File:** `wordpress-seo/src/context/meta-tags-context.php`

**Context:**

```php
$type = \array_filter( \array_values( \array_unique( $type ) ) );
		}

		/**
		 * Filter: 'wpseo_schema_webpage_type' - Allow changing the WebPage type.
		 *
		 * @param string|array $type The WebPage type.
		 */
		return \apply_filters( 'wpseo_schema_webpage_type', $type );
	}

	/**
```

### wpseo_schema_article_type
**File:** `wordpress-seo/src/context/meta-tags-context.php`

**Context:**

```php
// If the additional type is a subtype of Article, we're fine, and we can bail here.
		if ( \stripos( $additional_type, 'Article' ) !== false ) {
			/**
			 * Filter: 'wpseo_schema_article_type' - Allow changing the Article type.
			 *
			 * @param string|string[] $type      The Article type.
			 * @param Indexable       $indexable The indexable.
			 */
			return \apply_filters( 'wpseo_schema_article_type', $additional_type, $this->indexable );
		}

		$type = 'Article';
```

### wpseo_schema_main_image_id
**File:** `wordpress-seo/src/context/meta-tags-context.php`

**Context:**

```php
break;
		}

		/**
		 * Filter: 'wpseo_schema_main_image_id' - Allow changing the main image ID.
		 *
		 * @param int|array $image_id The image ID.
		 */
		return \apply_filters( 'wpseo_schema_main_image_id', $image_id );
	}

	/**
```

### googlesitekit_apifetch_preload_paths
**File:** `wordpress-seo/src/dashboard/infrastructure/integrations/site-kit.php`

**Context:**

```php
* @return array<array|null> The array with all the now filled in preloaded data.
	 */
	public function get_preloaded_data( array $paths ): array {
		$preload_paths = \apply_filters( 'googlesitekit_apifetch_preload_paths', [] );
		$actual_paths  = \array_intersect( $paths, $preload_paths );

		return \array_reduce(
```

### wpseo_transform_dashboard_subject_for_testing
**File:** `wordpress-seo/src/dashboard/infrastructure/search-console/site-kit-search-console-adapter.php`

**Context:**

```php
throw new Unexpected_Response_Exception();
			}

			/**
			 * Filter: 'wpseo_transform_dashboard_subject_for_testing' - Allows overriding subjects like URLs for the dashboard, to facilitate testing in local environments.
			 *
			 * @param string $url The subject to be transformed.
			 *
			 * @internal
			 */
			$subject = \apply_filters( 'wpseo_transform_dashboard_subject_for_testing', $ranking->getKeys()[0] );

			$search_ranking_data_container->add_data( new Search_Ranking_Data( $ranking->getClicks(), $ranking->getCtr(), $ranking->getImpressions(), $ranking->getPosition(), $subject ) );
		}
```

### wpseo_{$content_type}_filtering_taxonomy
**File:** `wordpress-seo/src/dashboard/infrastructure/taxonomies/taxonomies-collector.php`

**Context:**

```php
* @return Taxonomy|null The hooked filtering taxonomy.
	 */
	public function get_custom_filtering_taxonomy( string $content_type ) {
		/**
		 * Filter: 'wpseo_{$content_type}_filtering_taxonomy' - Allows overriding which taxonomy filters the content type.
		 *
		 * @internal
		 *
		 * @param string $filtering_taxonomy The taxonomy that filters the content type.
		 */
		$filtering_taxonomy = \apply_filters( "wpseo_{$content_type}_filtering_taxonomy", '' );
		if ( $filtering_taxonomy !== '' ) {
			$taxonomy = $this->get_taxonomy( $filtering_taxonomy, $content_type );
```

### wpseo_custom_site_kit_base_date
**File:** `wordpress-seo/src/dashboard/user-interface/time-based-seo-metrics/time-based-seo-metrics-route.php`

**Context:**

```php
* @return DateTime The base date.
	 */
	private function get_base_date() {
		/**
		 * Filter: 'wpseo_custom_site_kit_base_date' - Allow the base date for Site Kit requests to be dynamically set.
		 *
		 * @param string $base_date The custom base date for Site Kit requests, defaults to 'now'.
		 */
		$base_date = \apply_filters( 'wpseo_custom_site_kit_base_date', 'now' );

		try {
			return new DateTime( $base_date, new DateTimeZone( 'UTC' ) );
```

### wpseo_frontend_presentation
**File:** `wordpress-seo/src/deprecated/frontend/breadcrumbs.php`

**Context:**

```php
private function render() {
		$presenter = new Breadcrumbs_Presenter();
		$context   = $this->context_memoizer->for_current_page();

		/** This filter is documented in src/integrations/front-end-integration.php */
		$presentation            = apply_filters( 'wpseo_frontend_presentation', $context->presentation, $context );
		$presenter->presentation = $presentation;
		$presenter->replace_vars = $this->replace_vars;
		$presenter->helpers      = $this->helpers;
```

### wpseo_is_markdown_enabled
**File:** `wordpress-seo/src/editors/framework/integrations/jetpack-markdown.php`

**Context:**

```php
$is_markdown = \in_array( 'markdown', $active_modules, true );
		}

		/**
		 * Filters whether markdown support is active in the readability- and seo-analysis.
		 *
		 * @since 11.3
		 *
		 * @param array $is_markdown Is markdown support for Yoast SEO active.
		 */
		return \apply_filters( 'wpseo_is_markdown_enabled', $is_markdown );
	}
}
```

### wpseo_previously_used_keyword_active
**File:** `wordpress-seo/src/editors/framework/previously-used-keyphrase.php`

**Context:**

```php
* @return bool If this analysis is enabled.
	 */
	public function is_enabled(): bool {
		/**
		 * Filter to determine If the PreviouslyUsedKeyphrase assessment should run.
		 *
		 * @param bool $previouslyUsedKeyphraseActive If the PreviouslyUsedKeyphrase assessment should run.
		 */
		return (bool) \apply_filters( 'wpseo_previously_used_keyword_active', true );
	}

	/**
```

### wpseo_posts_for_related_keywords
**File:** `wordpress-seo/src/editors/framework/seo/posts/keyphrase-data-provider.php`

**Context:**

```php
$keyphrase = $this->meta_helper->get_value( 'focuskw', $this->post->ID );
		$usage     = [ $keyphrase => $this->get_keyphrase_usage_for_current_post( $keyphrase ) ];

		/**
		 * Allows enhancing the array of posts' that share their focus Keyphrase with the post's related Keyphrase.
		 *
		 * @param array<string> $usage   The array of posts' ids that share their focus Keyphrase with the post.
		 * @param int           $post_id The id of the post we're finding the usage of related Keyphrase for.
		 */
		return \apply_filters( 'wpseo_posts_for_related_keywords', $usage, $this->post->ID );
	}

	/**
```

### wpseo_social_template_post_type
**File:** `wordpress-seo/src/editors/framework/seo/posts/social-data-provider.php`

**Context:**

```php
* @return string
	 */
	private function get_social_template( $template_option_name ) {
		/**
		 * Filters the social template value for a given post type.
		 *
		 * @param string $template             The social template value, defaults to empty string.
		 * @param string $template_option_name The subname of the option in which the template you want to get is saved.
		 * @param string $post_type            The name of the post type.
		 */
		return \apply_filters( 'wpseo_social_template_post_type', '', $template_option_name, $this->post->post_type );
	}

	/**
```

### wpseo_social_template_taxonomy
**File:** `wordpress-seo/src/editors/framework/seo/terms/social-data-provider.php`

**Context:**

```php
* @return string
	 */
	private function get_social_template( $template_option_name ) {
		/**
		 * Filters the social template value for a given taxonomy.
		 *
		 * @param string $template             The social template value, defaults to empty string.
		 * @param string $template_option_name The subname of the option in which the template you want to get is saved.
		 * @param string $taxonomy             The name of the taxonomy.
		 */
		return \apply_filters( 'wpseo_social_template_taxonomy', '', $template_option_name, $this->term->taxonomy );
	}

	/**
```

### wpseo_breadcrumb_indexables
**File:** `wordpress-seo/src/generators/breadcrumbs-generator.php`

**Context:**

```php
if ( ! empty( $static_ancestors ) ) {
			\array_unshift( $indexables, ...$static_ancestors );
		}

		$indexables = \apply_filters( 'wpseo_breadcrumb_indexables', $indexables, $context );
		$indexables = \is_array( $indexables ) ? $indexables : [];
		$indexables = \array_filter(
			$indexables,
```

### wpseo_breadcrumb_links
**File:** `wordpress-seo/src/generators/breadcrumbs-generator.php`

**Context:**

```php
$crumbs = $this->add_paged_crumb( $crumbs, $context->indexable );

		/**
		 * Filter: 'wpseo_breadcrumb_links' - Allow the developer to filter the Yoast SEO breadcrumb links, add to them, change order, etc.
		 *
		 * @param array $crumbs The crumbs array.
		 */
		$filtered_crumbs = \apply_filters( 'wpseo_breadcrumb_links', $crumbs );

		// Basic check to make sure the filtered crumbs are in an array.
		if ( ! \is_array( $filtered_crumbs ) ) {
```

### wpseo_breadcrumb_single_link_info
**File:** `wordpress-seo/src/generators/breadcrumbs-generator.php`

**Context:**

```php
}

		$filter_callback = static function ( $link_info, $index ) use ( $crumbs ) {
			/**
			 * Filter: 'wpseo_breadcrumb_single_link_info' - Allow developers to filter the Yoast SEO Breadcrumb link information.
			 *
			 * @param array $link_info The breadcrumb link information.
			 * @param int   $index     The index of the breadcrumb in the list.
			 * @param array $crumbs    The complete list of breadcrumbs.
			 */
			return \apply_filters( 'wpseo_breadcrumb_single_link_info', $link_info, $index, $crumbs );
		};
		return \array_map( $filter_callback, $crumbs, \array_keys( $crumbs ) );
	}
```

### wpseo_add_opengraph_images
**File:** `wordpress-seo/src/generators/open-graph-image-generator.php`

**Context:**

```php
$backup_image_container = $this->get_image_container();

		try {
			/**
			 * Filter: wpseo_add_opengraph_images - Allow developers to add images to the Open Graph tags.
			 *
			 * @param Yoast\WP\SEO\Values\Open_Graph\Images $image_container The current object.
			 */
			\apply_filters( 'wpseo_add_opengraph_images', $image_container );
		} catch ( Error $error ) {
			$image_container = $backup_image_container;
		}
```

### wpseo_add_opengraph_additional_images
**File:** `wordpress-seo/src/generators/open-graph-image-generator.php`

**Context:**

```php
$backup_image_container = $image_container;

		try {
			/**
			 * Filter: wpseo_add_opengraph_additional_images - Allows to add additional images to the Open Graph tags.
			 *
			 * @param Yoast\WP\SEO\Values\Open_Graph\Images $image_container The current object.
			 */
			\apply_filters( 'wpseo_add_opengraph_additional_images', $image_container );
		} catch ( Error $error ) {
			$image_container = $backup_image_container;
		}
```

### wpseo_locale
**File:** `wordpress-seo/src/generators/open-graph-locale-generator.php`

**Context:**

```php
* @return string The OG locale.
	 */
	public function generate( Meta_Tags_Context $context ) {
		/**
		 * Filter: 'wpseo_locale' - Allow changing the locale output.
		 *
		 * Note that this filter is different from `wpseo_og_locale`, which is run _after_ the OG specific filtering.
		 *
		 * @param string $locale Locale string.
		 */
		$locale = \apply_filters( 'wpseo_locale', \get_locale() );

		// Catch some weird locales served out by WP that are not easily doubled up.
		$fix_locales = [
```

### wpseo_schema_article_keywords_taxonomy
**File:** `wordpress-seo/src/generators/schema/article.php`

**Context:**

```php
* @return array Article data.
	 */
	private function add_keywords( $data ) {
		/**
		 * Filter: 'wpseo_schema_article_keywords_taxonomy' - Allow changing the taxonomy used to assign keywords to a post type Article data.
		 *
		 * @param string $taxonomy The chosen taxonomy.
		 */
		$taxonomy = \apply_filters( 'wpseo_schema_article_keywords_taxonomy', 'post_tag' );

		return $this->add_terms( $data, 'keywords', $taxonomy );
	}
```

### wpseo_schema_article_sections_taxonomy
**File:** `wordpress-seo/src/generators/schema/article.php`

**Context:**

```php
* @return array Article data.
	 */
	private function add_sections( $data ) {
		/**
		 * Filter: 'wpseo_schema_article_sections_taxonomy' - Allow changing the taxonomy used to assign keywords to a post type Article data.
		 *
		 * @param string $taxonomy The chosen taxonomy.
		 */
		$taxonomy = \apply_filters( 'wpseo_schema_article_sections_taxonomy', 'category' );

		return $this->add_terms( $data, 'articleSection', $taxonomy );
	}
```

### wpseo_schema_article_potential_action_target
**File:** `wordpress-seo/src/generators/schema/article.php`

**Context:**

```php
* @return array The Article data with the potential action added.
	 */
	private function add_potential_action( $data ) {
		/**
		 * Filter: 'wpseo_schema_article_potential_action_target' - Allows filtering of the schema Article potentialAction target.
		 *
		 * @param array $targets The URLs for the Article potentialAction target.
		 */
		$targets = \apply_filters( 'wpseo_schema_article_potential_action_target', [ $this->context->canonical . '#respond' ] );

		$data['potentialAction'][] = [
			'@type'  => 'CommentAction',
```

### wpseo_schema_person_user_id
**File:** `wordpress-seo/src/generators/schema/author.php`

**Context:**

```php
$user_id = $this->context->indexable->object_id;
		}

		/**
		 * Filter: 'wpseo_schema_person_user_id' - Allows filtering of user ID used for person output.
		 *
		 * @param int|bool $user_id The user ID currently determined.
		 */
		$user_id = \apply_filters( 'wpseo_schema_person_user_id', $user_id );

		if ( \is_int( $user_id ) && $user_id > 0 ) {
			return $user_id;
```

### wpseo_schema_graph
**File:** `wordpress-seo/src/generators/schema-generator.php`

**Context:**

```php
}
		}

		/**
		 * Filter: 'wpseo_schema_graph' - Allows changing graph output.
		 *
		 * @param array             $graph   The graph to filter.
		 * @param Meta_Tags_Context $context A value object with context variables.
		 */
		$graph = \apply_filters( 'wpseo_schema_graph', $graph, $context );

		return $graph;
	}
```

### wpseo_schema_graph_pieces
**File:** `wordpress-seo/src/generators/schema-generator.php`

**Context:**

```php
];
		}

		/**
		 * Filter: 'wpseo_schema_graph_pieces' - Allows adding pieces to the graph.
		 *
		 * @param array             $pieces  The schema pieces.
		 * @param Meta_Tags_Context $context An object with context variables.
		 */
		return \apply_filters( 'wpseo_schema_graph_pieces', $schema_pieces, $context );
	}

	/**
```

### wpseo_schema_organization_social_profiles
**File:** `wordpress-seo/src/generators/schema/organization.php`

**Context:**

```php
$profiles = \array_merge( $profiles, $other_social_urls );
		}

		/**
		 * Filter: 'wpseo_schema_organization_social_profiles' - Allows filtering social profiles for the
		 * represented organization.
		 *
		 * @param string[] $profiles
		 */
		$profiles = \apply_filters( 'wpseo_schema_organization_social_profiles', $profiles );

		return $profiles;
	}
```

### wpseo_schema_person_social_profiles
**File:** `wordpress-seo/src/generators/schema/person.php`

**Context:**

```php
* @return string[] A list of SameAs URLs.
	 */
	protected function get_social_profiles( $same_as_urls, $user_id ) {
		/**
		 * Filter: 'wpseo_schema_person_social_profiles' - Allows filtering of social profiles per user.
		 *
		 * @param string[] $social_profiles The array of social profiles to retrieve. Each should be a user meta field
		 *                                  key. As they are retrieved using the WordPress function `get_the_author_meta`.
		 * @param int      $user_id         The current user we're grabbing social profiles for.
		 */
		$social_profiles = \apply_filters( 'wpseo_schema_person_social_profiles', $this->social_profiles, $user_id );

		// We can only handle an array.
		if ( ! \is_array( $social_profiles ) ) {
```

### wpseo_schema_person_data
**File:** `wordpress-seo/src/generators/schema/person.php`

**Context:**

```php
}
		$data = $this->add_same_as_urls( $data, $user_data, $user_id );

		/**
		 * Filter: 'wpseo_schema_person_data' - Allows filtering of schema data per user.
		 *
		 * @param array $data    The schema data we have for this person.
		 * @param int   $user_id The current user we're collecting schema data for.
		 */
		$data = \apply_filters( 'wpseo_schema_person_data', $data, $user_id );

		return $data;
	}
```

### wpseo_schema_webpage_potential_action_target
**File:** `wordpress-seo/src/generators/schema/webpage.php`

**Context:**

```php
return $data;
		}

		/**
		 * Filter: 'wpseo_schema_webpage_potential_action_target' - Allows filtering of the schema WebPage potentialAction target.
		 *
		 * @param array<string> $targets The URLs for the WebPage potentialAction target.
		 */
		$targets = \apply_filters( 'wpseo_schema_webpage_potential_action_target', [ $url ] );

		$data['potentialAction'][] = [
			'@type'  => 'ReadAction',
```

### disable_wpseo_json_ld_search
**File:** `wordpress-seo/src/generators/schema/website.php`

**Context:**

```php
* @return array
	 */
	private function internal_search_section( $data ) {
		/**
		 * Filter: 'disable_wpseo_json_ld_search' - Allow disabling of the json+ld output.
		 *
		 * @param bool $display_search Whether or not to display json+ld search on the frontend.
		 */
		if ( \apply_filters( 'disable_wpseo_json_ld_search', false ) ) {
			return $data;
		}

		/**
```

### wpseo_json_ld_search_url
**File:** `wordpress-seo/src/generators/schema/website.php`

**Context:**

```php
return $data;
		}

		/**
		 * Filter: 'wpseo_json_ld_search_url' - Allows filtering of the search URL for Yoast SEO.
		 *
		 * @param string $search_url The search URL for this site with a `{search_term_string}` variable.
		 */
		$search_url = \apply_filters( 'wpseo_json_ld_search_url', $this->context->site_url . '?s={search_term_string}' );

		$data['potentialAction'][] = [
			'@type'       => 'SearchAction',
```

### script_loader_src
**File:** `wordpress-seo/src/helpers/asset-helper.php`

**Context:**

```php
if ( ! empty( $ver ) ) {
			$src = \add_query_arg( 'ver', $ver, $src );
		}

		/** This filter is documented in wp-includes/class.wp-scripts.php */
		return \esc_url( \apply_filters( 'script_loader_src', $src, $handle ) );
	}
}
```

### wpseo_author_archive_post_types
**File:** `wordpress-seo/src/helpers/author-archive-helper.php`

**Context:**

```php
* @return array The post types that are shown on an author's archive.
	 */
	public function get_author_archive_post_types() {
		/**
		 * Filters the array of post types that are shown on an author's archive.
		 *
		 * @param array $args The post types that are shown on an author archive.
		 */
		return \apply_filters( 'wpseo_author_archive_post_types', [ 'post' ] );
	}

	/**
```

### Yoast\WP\SEO\allowlist_permalink_vars
**File:** `wordpress-seo/src/helpers/crawl-cleanup-helper.php`

**Context:**

```php
'gtm_debug',
		];

		/**
		 * Filter: 'Yoast\WP\SEO\allowlist_permalink_vars' - Allows plugins to register their own variables not to clean.
		 *
		 * @since 19.2.0
		 *
		 * @param array $allowed_extravars The list of the allowed vars (empty by default).
		 */
		$allowed_extravars = \apply_filters( 'Yoast\WP\SEO\allowlist_permalink_vars', $default_allowed_extravars );

		$clean_permalinks_extra_variables = $this->options_helper->get( 'clean_permalinks_extra_variables' );
```

### wpseo_frontend_page_type_simple_page_id
**File:** `wordpress-seo/src/helpers/current-page-helper.php`

**Context:**

```php
return \get_option( 'page_for_posts' );
		}

		/**
		 * Filter: Allow changing the default page id.
		 *
		 * @param int $page_id The default page id.
		 */
		return \apply_filters( 'wpseo_frontend_page_type_simple_page_id', 0 );
	}

	/**
```

### wpseo_should_save_indexable
**File:** `wordpress-seo/src/helpers/indexable-helper.php`

**Context:**

```php
public function should_index_indexable( $indexable ) {
		$intend_to_save = $this->should_index_indexables();

		/**
		 * Filter: 'wpseo_should_save_indexable' - Allow developers to enable / disable
		 * saving the indexable when the indexable is updated. Warning: overriding
		 * the intended action may cause problems when moving from a staging to a
		 * production environment because indexable permalinks may get set incorrectly.
		 *
		 * @param bool      $intend_to_save True if YoastSEO intends to save the indexable.
		 * @param Indexable $indexable      The indexable to be saved.
		 */
		return \apply_filters( 'wpseo_should_save_indexable', $intend_to_save, $indexable );
	}

	/**
```

### Yoast\WP\SEO\should_index_indexables
**File:** `wordpress-seo/src/helpers/indexable-helper.php`

**Context:**

```php
// Currently, the only reason to index is when we're on a production website.
		$should_index = $this->environment_helper->is_production_mode();

		/**
		 * Filter: 'Yoast\WP\SEO\should_index_indexables' - Allow developers to enable / disable
		 * creating indexables. Warning: overriding
		 * the intended action may cause problems when moving from a staging to a
		 * production environment because indexable permalinks may get set incorrectly.
		 *
		 * @since 18.2
		 *
		 * @param bool $should_index Whether the site's indexables should be created.
		 */
		return (bool) \apply_filters( 'Yoast\WP\SEO\should_index_indexables', $should_index );
	}

	/**
```

### wpseo_dynamic_permalinks_enabled
**File:** `wordpress-seo/src/helpers/indexable-helper.php`

**Context:**

```php
* @return bool Whether or not the dynamic permalinks should be used.
	 */
	public function dynamic_permalinks_enabled() {
		/**
		 * Filters the value of the `dynamic_permalinks` option.
		 *
		 * @param bool $value The value of the `dynamic_permalinks` option.
		 */
		return (bool) \apply_filters( 'wpseo_dynamic_permalinks_enabled', $this->options_helper->get( 'dynamic_permalinks', false ) );
	}

	/**
```

### wpseo_indexing_get_unindexed_count
**File:** `wordpress-seo/src/helpers/indexing-helper.php`

**Context:**

```php
public function get_filtered_unindexed_count() {
		$unindexed_count = $this->get_unindexed_count();

		/**
		 * Filter: 'wpseo_indexing_get_unindexed_count' - Allow changing the amount of unindexed objects.
		 *
		 * @param int $unindexed_count The amount of unindexed objects.
		 */
		return \apply_filters( 'wpseo_indexing_get_unindexed_count', $unindexed_count );
	}

	/**
```

### wpseo_indexing_get_limited_unindexed_count
**File:** `wordpress-seo/src/helpers/indexing-helper.php`

**Context:**

```php
return $unindexed_count;
		}

		/**
		 * Filter: 'wpseo_indexing_get_limited_unindexed_count' - Allow changing the amount of unindexed objects,
		 * and allow for a maximum number of items counted to improve performance.
		 *
		 * @param int       $unindexed_count The amount of unindexed objects.
		 * @param int|false $limit           Limit the number of unindexed objects that need to be counted.
		 *                                   False if it doesn't need to be limited.
		 */
		return \apply_filters( 'wpseo_indexing_get_limited_unindexed_count', $unindexed_count, $limit );
	}

	/**
```

### wpseo_indexing_get_limited_unindexed_count_background
**File:** `wordpress-seo/src/helpers/indexing-helper.php`

**Context:**

```php
return $unindexed_count;
		}

		/**
		 * Filter: 'wpseo_indexing_get_limited_unindexed_count_background' - Allow changing the amount of unindexed objects that can be indexed in the background,
		 * and allow for a maximum number of items counted to improve performance.
		 *
		 * @param int       $unindexed_count The amount of unindexed objects.
		 * @param int|false $limit           Limit the number of unindexed objects that need to be counted.
		 *                                   False if it doesn't need to be limited.
		 */
		return \apply_filters( 'wpseo_indexing_get_limited_unindexed_count_background', $unindexed_count, $limit );
	}
}
```

### wpseo_opengraph_is_valid_image_url
**File:** `wordpress-seo/src/helpers/open-graph/image-helper.php`

**Context:**

```php
$image_extension = $this->url->get_extension_from_url( $image['url'] );
		$is_valid        = $this->image->is_extension_valid( $image_extension );

		/**
		 * Filter: 'wpseo_opengraph_is_valid_image_url' - Allows extra validation for an image url.
		 *
		 * @param bool   $is_valid Current validation result.
		 * @param string $url      The image url to validate.
		 */
		return (bool) \apply_filters( 'wpseo_opengraph_is_valid_image_url', $is_valid, $image['url'] );
	}

	/**
```

### wpseo_opengraph_image_size
**File:** `wordpress-seo/src/helpers/open-graph/image-helper.php`

**Context:**

```php
* @return string|null The image size when overriden by filter or null when not.
	 */
	public function get_override_image_size() {
		/**
		 * Filter: 'wpseo_opengraph_image_size' - Allow overriding the image size used
		 * for Open Graph sharing. If this filter is used, the defined size will always be
		 * used for the og:image. The image will still be rejected if it is too small.
		 *
		 * Only use this filter if you manually want to determine the best image size
		 * for the `og:image` tag.
		 *
		 * Use the `wpseo_image_sizes` filter if you want to use our logic. That filter
		 * can be used to add an image size that needs to be taken into consideration
		 * within our own logic.
		 *
		 * @param string|false $size Size string.
		 */
		return \apply_filters( 'wpseo_opengraph_image_size', null );
	}

	/**
```

### wpseo_replacements_filter_sep
**File:** `wordpress-seo/src/helpers/options-helper.php`

**Context:**

```php
$replacement = \reset( $seperator_options );
		}

		/**
		 * Filter: 'wpseo_replacements_filter_sep' - Allow customization of the separator character(s).
		 *
		 * @param string $replacement The current separator.
		 */
		return \apply_filters( 'wpseo_replacements_filter_sep', $replacement );
	}

	/**
```

### wpseo_disable_adjacent_rel_links
**File:** `wordpress-seo/src/helpers/pagination-helper.php`

**Context:**

```php
* @return bool Whether adjacent rel links are disabled or not.
	 */
	public function is_rel_adjacent_disabled() {
		/**
		 * Filter: 'wpseo_disable_adjacent_rel_links' - Allows disabling of Yoast adjacent links if this is being handled by other code.
		 *
		 * @param bool $links_generated Indicates if other code has handled adjacent links.
		 */
		return \apply_filters( 'wpseo_disable_adjacent_rel_links', false );
	}

	/**
```

### wpseo_public_post_statuses
**File:** `wordpress-seo/src/helpers/post-helper.php`

**Context:**

```php
* @return array The public post statuses.
	 */
	public function get_public_post_statuses() {
		/**
		 * Filter: 'wpseo_public_post_statuses' - List of public post statuses.
		 *
		 * @param array $post_statuses Post status list, defaults to array( 'publish' ).
		 */
		return \apply_filters( 'wpseo_public_post_statuses', [ 'publish' ] );
	}
}
```

### wpseo_accessible_post_types
**File:** `wordpress-seo/src/helpers/post-type-helper.php`

**Context:**

```php
$post_types = \get_post_types( [ 'public' => true ] );
		$post_types = \array_filter( $post_types, 'is_post_type_viewable' );

		/**
		 * Filter: 'wpseo_accessible_post_types' - Allow changing the accessible post types.
		 *
		 * @param array $post_types The public post types.
		 */
		$post_types = \apply_filters( 'wpseo_accessible_post_types', $post_types );

		// When the array gets messed up somewhere.
		if ( ! \is_array( $post_types ) ) {
```

### wpseo_indexable_excluded_post_types
**File:** `wordpress-seo/src/helpers/post-type-helper.php`

**Context:**

```php
* @return array The excluded post types.
	 */
	public function get_excluded_post_types_for_indexables() {
		/**
		 * Filter: 'wpseo_indexable_excluded_post_types' - Allows excluding posts of a certain post
		 * type from being saved to the indexable table.
		 *
		 * @param array $excluded_post_types The currently excluded post types that indexables will not be created for.
		 */
		$excluded_post_types = \apply_filters( 'wpseo_indexable_excluded_post_types', [] );

		// Failsafe, to always make sure that `excluded_post_types` is an array.
		if ( ! \is_array( $excluded_post_types ) ) {
```

### wpseo_indexable_forced_included_post_types
**File:** `wordpress-seo/src/helpers/post-type-helper.php`

**Context:**

```php
* @return array The filtered post types that are included to be indexed.
	 */
	protected function filter_included_post_types( $included_post_types ) {
		/**
		 * Filter: 'wpseo_indexable_forced_included_post_types' - Allows force including posts of a certain post
		 * type to be saved to the indexable table.
		 *
		 * @param array $included_post_types The currently included post types that indexables will be created for.
		 */
		$filtered_included_post_types = \apply_filters( 'wpseo_indexable_forced_included_post_types', $included_post_types );

		if ( ! \is_array( $filtered_included_post_types ) ) {
			// If the filter got misused, let's return the unfiltered array.
```

### wpseo_schema_piece_language
**File:** `wordpress-seo/src/helpers/schema/language-helper.php`

**Context:**

```php
* @return array The Schema piece data with added language property
	 */
	public function add_piece_language( $data ) {
		/**
		 * Filter: 'wpseo_schema_piece_language' - Allow changing the Schema piece language.
		 *
		 * @param string $type The Schema piece language.
		 * @param array  $data The Schema piece data.
		 */
		$data['inLanguage'] = \apply_filters( 'wpseo_schema_piece_language', \get_bloginfo( 'language' ), $data );

		return $data;
	}
```

### wpseo_person_social_profile_fields
**File:** `wordpress-seo/src/helpers/social-profiles-helper.php`

**Context:**

```php
* @return array The social profile fields.
	 */
	public function get_person_social_profile_fields() {
		/**
		 * Filter: Allow changes to the social profiles fields available for a person.
		 *
		 * @param array $person_social_profile_fields The social profile fields.
		 */
		$person_social_profile_fields = \apply_filters( 'wpseo_person_social_profile_fields', $this->person_social_profile_fields );

		return (array) $person_social_profile_fields;
	}
```

### wpseo_organization_social_profile_fields
**File:** `wordpress-seo/src/helpers/social-profiles-helper.php`

**Context:**

```php
* @return array The organization profile fields.
	 */
	public function get_organization_social_profile_fields() {
		/**
		 * Filter: Allow changes to the social profiles fields available for an organization.
		 *
		 * @param array $organization_social_profile_fields The social profile fields.
		 */
		$organization_social_profile_fields = \apply_filters( 'wpseo_organization_social_profile_fields', $this->organization_social_profile_fields );

		return (array) $organization_social_profile_fields;
	}
```

### wpseo_indexable_excluded_taxonomies
**File:** `wordpress-seo/src/helpers/taxonomy-helper.php`

**Context:**

```php
* @return array The excluded taxonomies.
	 */
	public function get_excluded_taxonomies_for_indexables() {
		/**
		 * Filter: 'wpseo_indexable_excluded_taxonomies' - Allow developers to prevent a certain taxonomy
		 * from being saved to the indexable table.
		 *
		 * @param array $excluded_taxonomies The currently excluded taxonomies.
		 */
		$excluded_taxonomies = \apply_filters( 'wpseo_indexable_excluded_taxonomies', [] );

		// Failsafe, to always make sure that `excluded_taxonomies` is an array.
		if ( ! \is_array( $excluded_taxonomies ) ) {
```

### wpseo_twitter_image_size
**File:** `wordpress-seo/src/helpers/twitter/image-helper.php`

**Context:**

```php
* @return string Image size string.
	 */
	public function get_image_size() {
		/**
		 * Filter: 'wpseo_twitter_image_size' - Allow changing the Twitter Card image size.
		 *
		 * @param string $featured_img Image size string.
		 */
		return (string) \apply_filters( 'wpseo_twitter_image_size', 'full' );
	}

	/**
```

### wpseo_force_skip_image_content_parsing
**File:** `wordpress-seo/src/images/Application/image-content-extractor.php`

**Context:**

```php
* @since 21.1
		 */
		$should_not_parse_content = \apply_filters( 'wpseo_force_creating_and_using_attachment_indexables', false );
		/**
		 * Filter 'wpseo_force_skip_image_content_parsing' - Filters if we should force skip scanning the content to parse images.
		 * This filter can be used if the regex gives a faster result than scanning the code.
		 *
		 * The default value is false.
		 *
		 * @since 21.1
		 */
		$should_not_parse_content = \apply_filters( 'wpseo_force_skip_image_content_parsing', $should_not_parse_content );

		if ( ! $should_not_parse_content && \class_exists( WP_HTML_Tag_Processor::class ) ) {
			return $this->gather_images_wp( $content );
```

### wpseo_image_attribute_containing_id
**File:** `wordpress-seo/src/images/Application/image-content-extractor.php`

**Context:**

```php
'tag_name' => 'img',
		];

		/**
		 * Filter 'wpseo_image_attribute_containing_id' - Allows filtering what attribute will be used to extract image IDs from.
		 *
		 * Defaults to "class", which is where WP natively stores the image IDs, in a `wp-image-<ID>` format.
		 *
		 * @api string The attribute to be used to extract image IDs from.
		 */
		$attribute = \apply_filters( 'wpseo_image_attribute_containing_id', 'class' );
		while ( $processor->next_tag( $query ) ) {
			$src_raw = $processor->get_attribute( 'src' );
			if ( ! $src_raw ) {
```

### wpseo_extract_id_pattern
**File:** `wordpress-seo/src/images/Application/image-content-extractor.php`

**Context:**

```php
return 0;
		}

		/**
		 * Filter 'wpseo_extract_id_pattern' - Allows filtering the regex patern to be used to extract image IDs from class/attribute names.
		 *
		 * Defaults to the pattern that extracts image IDs from core's `wp-image-<ID>` native format in image classes.
		 *
		 * @api string The regex pattern to be used to extract image IDs from class names. Empty string if the whole class/attribute should be returned.
		 */
		$pattern = \apply_filters( 'wpseo_extract_id_pattern', '/(?<!\S)wp-image-(\d+)(?!\S)/i' );

		if ( $pattern === '' ) {
			return (int) $classes;
```

### wpseo_unindexed_count_queries_ran
**File:** `wordpress-seo/src/integrations/admin/background-indexing-integration.php`

**Context:**

```php
* @return void
	 */
	public function schedule_cron_indexing() {
		/**
		 * Filter: 'wpseo_unindexed_count_queries_ran' - Informs whether the expensive unindexed count queries have been ran already.
		 *
		 * @internal
		 *
		 * @param bool $have_queries_ran
		 */
		$have_queries_ran = \apply_filters( 'wpseo_unindexed_count_queries_ran', false );

		if ( ( ! $this->yoast_admin_and_dashboard_conditional->is_met() || ! $this->get_request_conditional->is_met() ) && ! $have_queries_ran ) {
			return;
```

### wpseo_cron_indexing_limit_size
**File:** `wordpress-seo/src/integrations/admin/background-indexing-integration.php`

**Context:**

```php
*/
	public function throttle_cron_indexing( $indexation_limit ) {
		if ( \wp_doing_cron() ) {
			/**
			 * Filter: 'wpseo_cron_indexing_limit_size' - Adds the possibility to limit the number of items that are indexed when in cron action.
			 *
			 * @param int $limit Maximum number of indexables to be indexed per indexing action.
			 */
			return \apply_filters( 'wpseo_cron_indexing_limit_size', 15 );
		}

		return $indexation_limit;
```

### wpseo_cron_link_indexing_limit_size
**File:** `wordpress-seo/src/integrations/admin/background-indexing-integration.php`

**Context:**

```php
*/
	public function throttle_cron_link_indexing( $link_indexation_limit ) {
		if ( \wp_doing_cron() ) {
			/**
			 * Filter: 'wpseo_cron_link_indexing_limit_size' - Adds the possibility to limit the number of links that are indexed when in cron action.
			 *
			 * @param int $limit Maximum number of link indexables to be indexed per link indexing action.
			 */
			return \apply_filters( 'wpseo_cron_link_indexing_limit_size', 3 );
		}

		return $link_indexation_limit;
```

### Yoast\WP\SEO\enable_cron_indexing
**File:** `wordpress-seo/src/integrations/admin/background-indexing-integration.php`

**Context:**

```php
if ( ! $this->indexable_helper->should_index_indexables() ) {
			return false;
		}

		// The filter supersedes everything when preventing cron indexation.
		if ( \apply_filters( 'Yoast\WP\SEO\enable_cron_indexing', true ) !== true ) {
			return false;
		}

		return $this->indexing_helper->get_limited_filtered_unindexed_count_background( 1 ) > 0;
```

### wpseo_shutdown_indexation_limit
**File:** `wordpress-seo/src/integrations/admin/background-indexing-integration.php`

**Context:**

```php
* @return int The shutdown limit.
	 */
	protected function get_shutdown_limit() {
		/**
		 * Filter 'wpseo_shutdown_indexation_limit' - Allow filtering the number of objects that can be indexed during shutdown.
		 *
		 * @param int $limit The maximum number of objects indexed.
		 */
		return \apply_filters( 'wpseo_shutdown_indexation_limit', 25 );
	}

	/**
```

### wpseo_indexing_data
**File:** `wordpress-seo/src/integrations/admin/first-time-configuration-integration.php`

**Context:**

```php
],
		];

		/**
		 * Filter: 'wpseo_indexing_data' Filter to adapt the data used in the indexing process.
		 *
		 * @param array $data The indexing data to adapt.
		 */
		$data = \apply_filters( 'wpseo_indexing_data', $data );

		$this->admin_asset_manager->localize_script( 'indexation', 'yoastIndexingData', $data );
```

### wpseo_knowledge_graph_setting_msg
**File:** `wordpress-seo/src/integrations/admin/first-time-configuration-integration.php`

**Context:**

```php
$person_id       = $this->get_person_id();
		$social_profiles = $this->get_social_profiles();

		// This filter is documented in admin/views/tabs/metas/paper-content/general/knowledge-graph.php.
		$knowledge_graph_message = \apply_filters( 'wpseo_knowledge_graph_setting_msg', '' );

		$finished_steps        = $this->get_finished_steps();
		$options               = $this->get_company_or_person_options();
```

### wpseo_indexing_endpoints
**File:** `wordpress-seo/src/integrations/admin/first-time-configuration-integration.php`

**Context:**

```php
'post_link'          => Indexing_Route::FULL_POST_LINKS_INDEXING_ROUTE,
			'term_link'          => Indexing_Route::FULL_TERM_LINKS_INDEXING_ROUTE,
		];

		$endpoints = \apply_filters( 'wpseo_indexing_endpoints', $endpoints );

		$endpoints['complete'] = Indexing_Route::FULL_COMPLETE_ROUTE;
```

### wpseo_helpscout_show_beacon
**File:** `wordpress-seo/src/integrations/admin/helpscout-beacon.php`

**Context:**

```php
$return = true;
		}

		/**
		 * Filter: 'wpseo_helpscout_show_beacon' - Allows overriding whether we show the HelpScout beacon.
		 *
		 * @param bool $show_beacon Whether we show the beacon or not.
		 */
		return \apply_filters( 'wpseo_helpscout_show_beacon', $return );
	}

	/**
```

### wpseo_helpscout_beacon_settings
**File:** `wordpress-seo/src/integrations/admin/helpscout-beacon.php`

**Context:**

```php
'pages_ids' => $this->pages_ids,
		];

		/**
		 * Filter: 'wpseo_helpscout_beacon_settings' - Allows overriding the HelpScout beacon settings.
		 *
		 * @param string $beacon_settings The HelpScout beacon settings.
		 */
		$helpscout_settings = \apply_filters( 'wpseo_helpscout_beacon_settings', $filterable_helpscout_setting );

		$this->products  = $helpscout_settings['products'];
		$this->pages_ids = $helpscout_settings['pages_ids'];
```

### wpseo_importing_data
**File:** `wordpress-seo/src/integrations/admin/import-integration.php`

**Context:**

```php
],
		];

		/**
		 * Filter: 'wpseo_importing_data' Filter to adapt the data used in the import process.
		 *
		 * @param array $data The import data to adapt.
		 */
		$data = \apply_filters( 'wpseo_importing_data', $data );

		$this->asset_manager->localize_script( 'import', 'yoastImportData', $data );
	}
```

### wpseo_mastodon_active
**File:** `wordpress-seo/src/integrations/admin/integrations-page.php`

**Context:**

```php
* @return bool
	 */
	private function is_mastodon_active() {
		return \apply_filters( 'wpseo_mastodon_active', false );
	}
}
```

### wpseo_link_count_post_types
**File:** `wordpress-seo/src/integrations/admin/link-count-columns-integration.php`

**Context:**

```php
* @return void
	 */
	public function register_init_hooks() {
		$public_post_types = \apply_filters( 'wpseo_link_count_post_types', $this->post_type_helper->get_accessible_post_types() );

		if ( ! \is_array( $public_post_types ) || empty( $public_post_types ) ) {
			return;
```

### Yoast\WP\SEO\workouts_options
**File:** `wordpress-seo/src/integrations/admin/workouts-integration.php`

**Context:**

```php
*/
	private function get_workouts_option() {
		$workouts_option = $this->options_helper->get( 'workouts_data' );

		// This filter is documented in src/routes/workouts-route.php.
		return \apply_filters( 'Yoast\WP\SEO\workouts_options', $workouts_option );
	}

	/**
```

### wpseo_enable_structured_data_blocks
**File:** `wordpress-seo/src/integrations/blocks/structured-data-blocks.php`

**Context:**

```php
* @return void
	 */
	public function register_blocks() {
		/**
		 * Filter: 'wpseo_enable_structured_data_blocks' - Allows disabling Yoast's schema blocks entirely.
		 *
		 * @param bool $enable If false, our structured data blocks won't show.
		 */
		if ( ! \apply_filters( 'wpseo_enable_structured_data_blocks', true ) ) {
			return;
		}

		\register_block_type(
```

### wpseo_structured_data_blocks_image_size
**File:** `wordpress-seo/src/integrations/blocks/structured-data-blocks.php`

**Context:**

```php
$image_style = '';
				}

				/**
				 * Filter: 'wpseo_structured_data_blocks_image_size' - Allows adjusting the image size in structured data blocks.
				 *
				 * @since 18.2
				 *
				 * @param string|int[] $image_size     The image size. Accepts any registered image size name, or an array of width and height values in pixels (in that order).
				 * @param int          $attachment_id  The id of the attachment.
				 * @param string       $attachment_src The attachment src.
				 */
				$image_size = \apply_filters(
					'wpseo_structured_data_blocks_image_size',
					$image_size,
					$attachment_id,
					$src_matches[1]
				);
				$image_html = \wp_get_attachment_image(
					$attachment_id,
					$image_size,
```

### wpseo_cleanup_tasks
**File:** `wordpress-seo/src/integrations/cleanup-integration.php`

**Context:**

```php
*/
	private function get_additional_indexable_cleanups() {

		/**
		 * Filter: Adds the possibility to add additional indexable cleanup functions.
		 *
		 * @param array $additional_tasks Associative array with unique keys. Value should be a cleanup function that receives a limit.
		 */
		$additional_tasks = \apply_filters( 'wpseo_cleanup_tasks', [] );

		return $this->validate_additional_tasks( $additional_tasks );
	}
```

### wpseo_misc_cleanup_tasks
**File:** `wordpress-seo/src/integrations/cleanup-integration.php`

**Context:**

```php
*/
	private function get_additional_misc_cleanups() {

		/**
		 * Filter: Adds the possibility to add additional non-indexable cleanup functions.
		 *
		 * @param array $additional_tasks Associative array with unique keys. Value should be a cleanup function that receives a limit.
		 */
		$additional_tasks = \apply_filters( 'wpseo_misc_cleanup_tasks', [] );

		return $this->validate_additional_tasks( $additional_tasks );
	}
```

### wpseo_cron_query_limit_size
**File:** `wordpress-seo/src/integrations/cleanup-integration.php`

**Context:**

```php
* @return int The limit for the amount of entities to be cleaned.
	 */
	private function get_limit() {
		/**
		 * Filter: Adds the possibility to limit the number of items that are deleted from the database on cleanup.
		 *
		 * @param int $limit Maximum number of indexables to be cleaned up per query.
		 */
		$limit = \apply_filters( 'wpseo_cron_query_limit_size', 1000 );

		if ( ! \is_int( $limit ) ) {
			$limit = 1000;
```

### wpseo_enable_feature
**File:** `wordpress-seo/src/integrations/feature-flag-integration.php`

**Context:**

```php
* @return string[] The (possibly adapted) list of enabled features.
	 */
	protected function filter_enabled_features( $enabled_features ) {
		/**
		 * Filters the list of currently enabled feature flags.
		 *
		 * @param string[] $enabled_features The current list of enabled feature flags.
		 */
		$filtered_enabled_features = \apply_filters( 'wpseo_enable_feature', $enabled_features );

		if ( ! \is_array( $filtered_enabled_features ) ) {
			$filtered_enabled_features = $enabled_features;
```

### wpseo_output_twitter_card
**File:** `wordpress-seo/src/integrations/front-end/backwards-compatibility.php`

**Context:**

```php
if ( $this->options->get( 'opengraph' ) === true ) {
			\add_action( 'wpseo_head', [ $this, 'call_wpseo_opengraph' ], 30 );
		}
		if ( $this->options->get( 'twitter' ) === true && \apply_filters( 'wpseo_output_twitter_card', true ) !== false ) {
			\add_action( 'wpseo_head', [ $this, 'call_wpseo_twitter' ], 40 );
		}
	}
```

### wpseo_remove_reply_to_com
**File:** `wordpress-seo/src/integrations/front-end/comment-link-fixer.php`

**Context:**

```php
* @return bool True to remove, false not to remove.
	 */
	private function clean_reply_to_com() {
		/**
		 * Filter: 'wpseo_remove_reply_to_com' - Allow disabling the feature that removes ?replytocom query parameters.
		 *
		 * @param bool $return True to remove, false not to remove.
		 */
		return (bool) \apply_filters( 'wpseo_remove_reply_to_com', true );
	}
}
```

### wpseo_frontend_presenters
**File:** `wordpress-seo/src/integrations/front-end-integration.php`

**Context:**

```php
};
		$presenters = \array_filter( \array_map( $callback, $needed_presenters ) );

		/**
		 * Filter 'wpseo_frontend_presenters' - Allow filtering the presenter instances in or out of the request.
		 *
		 * @param Abstract_Indexable_Presenter[] $presenters List of presenter instances.
		 * @param Meta_Tags_Context              $context    The meta tags context for the current page.
		 */
		$presenter_instances = \apply_filters( 'wpseo_frontend_presenters', $presenters, $context );

		if ( ! \is_array( $presenter_instances ) ) {
			$presenter_instances = $presenters;
```

### wpseo_frontend_presenter_classes
**File:** `wordpress-seo/src/integrations/front-end-integration.php`

**Context:**

```php
};
		$presenters = \array_map( $callback, $presenters );

		/**
		 * Filter 'wpseo_frontend_presenter_classes' - Allow filtering presenters in or out of the request.
		 *
		 * @param array  $presenters List of presenters.
		 * @param string $page_type  The current page type.
		 */
		$presenters = \apply_filters( 'wpseo_frontend_presenter_classes', $presenters, $page_type );

		return $presenters;
	}
```

### wpseo_output_enhanced_slack_data
**File:** `wordpress-seo/src/integrations/front-end-integration.php`

**Context:**

```php
if ( $this->options->get( 'twitter' ) === true && \apply_filters( 'wpseo_output_twitter_card', true ) !== false ) {
			$presenters = \array_merge( $presenters, $this->twitter_card_presenters );
		}
		if ( $this->options->get( 'enable_enhanced_slack_sharing' ) === true && \apply_filters( 'wpseo_output_enhanced_slack_data', true ) !== false ) {
			$presenters = \array_merge( $presenters, $this->slack_presenters );
		}

		return \array_merge( $presenters, $this->closing_presenters );
```

### wpseo_attachment_redirect_url
**File:** `wordpress-seo/src/integrations/front-end/redirects.php`

**Context:**

```php
* @return string The attachment url.
	 */
	protected function get_attachment_url() {
		/**
		 * Allows the developer to change the target redirection URL for attachments.
		 *
		 * @since 7.5.3
		 *
		 * @param string $attachment_url The attachment URL for the queried object.
		 * @param object $queried_object The queried object.
		 */
		return \apply_filters(
			'wpseo_attachment_redirect_url',
			\wp_get_attachment_url( \get_queried_object_id() ),
			\get_queried_object()
		);
	}

	/**
```

### wpseo_remove_cat_parameter
**File:** `wordpress-seo/src/integrations/front-end/redirects.php`

**Context:**

```php
* @return void
	 */
	public function category_redirect() {
		/**
		 * Allows the developer to keep cat=-1 GET parameters
		 *
		 * @since 19.9
		 *
		 * @param bool $remove_cat_parameter Whether to remove the `cat=-1` GET parameter. Default true.
		 */
		$should_remove_parameter = \apply_filters( 'wpseo_remove_cat_parameter', true );

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Data is not processed or saved.
		if ( $should_remove_parameter && isset( $_GET['cat'] ) && $_GET['cat'] === '-1' ) {
```

### wpseo_should_add_subdirectory_multisite_xml_sitemaps
**File:** `wordpress-seo/src/integrations/front-end/robots-txt-integration.php`

**Context:**

```php
$robots_txt = $this->remove_default_robots( $robots_txt );
		$this->maybe_add_xml_sitemap();

		/**
		 * Filter: 'wpseo_should_add_subdirectory_multisite_xml_sitemaps' - Disabling this filter removes subdirectory sites from xml sitemaps.
		 *
		 * @since 19.8
		 *
		 * @param bool $show Whether to display multisites in the xml sitemaps.
		 */
		if ( \apply_filters( 'wpseo_should_add_subdirectory_multisite_xml_sitemaps', true ) ) {
			$this->add_subdirectory_multisite_xml_sitemaps();
		}

		/**
```

### wpseo_include_rss_footer
**File:** `wordpress-seo/src/integrations/front-end/rss-footer-embed.php`

**Context:**

```php
return false;
		}

		/**
		 * Filter: 'wpseo_include_rss_footer' - Allow the RSS footer to be dynamically shown/hidden.
		 *
		 * @param bool   $show_embed Indicates if the RSS footer should be shown or not.
		 * @param string $context    The context of the RSS content - 'full' or 'excerpt'.
		 */
		if ( ! \apply_filters( 'wpseo_include_rss_footer', true, $context ) ) {
			return false;
		}

		return $this->is_configured();
```

### nofollow_rss_links
**File:** `wordpress-seo/src/integrations/front-end/rss-footer-embed.php`

**Context:**

```php
* @return string The link template.
	 */
	protected function get_link_template() {
		/**
		 * Filter: 'nofollow_rss_links' - Allow the developer to determine whether or not to follow the links in
		 * the bits Yoast SEO adds to the RSS feed, defaults to false.
		 *
		 * @since 1.4.20
		 *
		 * @param bool $unsigned Whether or not to follow the links in RSS feed, defaults to true.
		 */
		if ( \apply_filters( 'nofollow_rss_links', false ) ) {
			return '<a rel="nofollow" href="%1$s">%2$s</a>';
		}

		return '<a href="%1$s">%2$s</a>';
```

### wpseo_elementor_hidden_fields
**File:** `wordpress-seo/src/integrations/third-party/elementor.php`

**Context:**

```php
*/
			\esc_attr( $this->get_metabox_post()->post_name )
		);

		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Output should be escaped in the filter.
		echo \apply_filters( 'wpseo_elementor_hidden_fields', '' );

		echo '</form>';
	}
```

### wpseo_post_types_reset_permalinks
**File:** `wordpress-seo/src/integrations/watchers/indexable-permalink-watcher.php`

**Context:**

```php
* @return array The post types.
	 */
	protected function get_post_types() {
		/**
		 * Filter: Gives the possibility to filter out post types.
		 *
		 * @param array $post_types The post type names.
		 *
		 * @return array The post types.
		 */
		$post_types = \apply_filters( 'wpseo_post_types_reset_permalinks', $this->post_type->get_public_post_types() );

		return $post_types;
	}
```

### wpseo_introductions
**File:** `wordpress-seo/src/introductions/application/introductions-collector.php`

**Context:**

```php
* @return Introduction_Interface[]
	 */
	private function add_introductions( Introduction_Interface ...$introductions ) {
		/**
		 * Filter: Adds the possibility to add additional introductions to be included.
		 *
		 * @internal
		 *
		 * @param Introduction_Interface $introductions This filter expects a list of Introduction_Interface instances and
		 *                                              expects only Introduction_Interface implementations to be added to the list.
		 */
		$filtered_introductions = (array) \apply_filters( 'wpseo_introductions', $introductions );

		return \array_filter(
			$filtered_introductions,
```

### wpseo_llmstxt_encoding_prefix
**File:** `wordpress-seo/src/llms-txt/application/file/commands/populate-file-command-handler.php`

**Context:**

```php
*/
	private function encode_content( string $content ): string {

		/**
		 * Filter: 'wpseo_llmstxt_encoding_prefix' - Allows editing the Byte Order Mark (BOM) for UTF-8 we prepend to the llmst.txt file.
		 *
		 * @param string $encoding_prefix The Byte Order Mark (BOM) for UTF-8 we prepend to the llmst.txt file.
		 */
		$encoding_prefix = \apply_filters( 'wpseo_llmstxt_encoding_prefix', "\xEF\xBB\xBF" );

		return $encoding_prefix . $content;
	}
```

### wpseo_llmstxt_filesystem_path
**File:** `wordpress-seo/src/llms-txt/infrastructure/file/wordpress-file-system-adapter.php`

**Context:**

```php
}
		// phpcs:enable WordPress.Security.ValidatedSanitizedInput

		/**
		 * Filter: 'wpseo_llmstxt_filesystem_path' - Allows editing the filesystem path of the llmst.txt file to account for server restrictions to the filesystem.
		 *
		 * @param string $llms_filesystem_path The filesystem path of the llmst.txt file that defaults to get_home_path() or the $_SERVER['DOCUMENT_ROOT'] if the home path is not writeable.
		 */
		$llms_filesystem_path = \apply_filters( 'wpseo_llmstxt_filesystem_path', $llms_filesystem_path );

		return \trailingslashit( $llms_filesystem_path ) . 'llms.txt';
	}
```

### wpseo_logger
**File:** `wordpress-seo/src/loggers/logger.php`

**Context:**

```php
public function __construct() {
		$this->wrapped_logger = new NullLogger();

		/**
		 * Gives the possibility to set override the logger interface.
		 *
		 * @param LoggerInterface $logger Instance of NullLogger.
		 *
		 * @return LoggerInterface The logger object.
		 */
		$this->wrapped_logger = \apply_filters( 'wpseo_logger', $this->wrapped_logger );
	}

	/**
```

### wpseo_opengraph_show_publish_date
**File:** `wordpress-seo/src/presentations/indexable-post-type-presentation.php`

**Context:**

```php
*/
	public function generate_open_graph_article_published_time() {
		if ( $this->model->object_sub_type !== 'post' ) {
			/**
			 * Filter: 'wpseo_opengraph_show_publish_date' - Allow showing publication date for other post types.
			 *
			 * @param bool   $show      Whether or not to show publish date.
			 * @param string $post_type The current URL's post type.
			 */
			if ( ! \apply_filters( 'wpseo_opengraph_show_publish_date', false, $this->post->get_post_type( $this->source ) ) ) {
				return '';
			}
		}
```

### wpseo_twitter_creator_account
**File:** `wordpress-seo/src/presentations/indexable-post-type-presentation.php`

**Context:**

```php
$twitter_creator = \ltrim( \trim( \get_the_author_meta( 'twitter', $this->source->post_author ) ), '@' );

		/**
		 * Filter: 'wpseo_twitter_creator_account' - Allow changing the X account as output in the X card by Yoast SEO.
		 *
		 * @param string $twitter The twitter account name string.
		 */
		$twitter_creator = \apply_filters( 'wpseo_twitter_creator_account', $twitter_creator );

		if ( \is_string( $twitter_creator ) && $twitter_creator !== '' ) {
			return '@' . $twitter_creator;
```

### wpseo_robots
**File:** `wordpress-seo/src/presentations/indexable-presentation.php`

**Context:**

```php
$robots_string = \implode( ', ', \array_filter( $robots ) );

		/**
		 * Filter: 'wpseo_robots' - Allows filtering of the meta robots output of Yoast SEO.
		 *
		 * @param string                 $robots       The meta robots directives to be echoed.
		 * @param Indexable_Presentation $presentation The presentation of an indexable.
		 */
		$robots_filtered = \apply_filters( 'wpseo_robots', $robots_string, $this );

		// Convert the robots string back to an array.
		if ( \is_string( $robots_filtered ) ) {
```

### wpseo_robots_array
**File:** `wordpress-seo/src/presentations/indexable-presentation.php`

**Context:**

```php
return [];
		}

		/**
		 * Filter: 'wpseo_robots_array' - Allows filtering of the meta robots output array of Yoast SEO.
		 *
		 * @param array                  $robots       The meta robots directives to be used.
		 * @param Indexable_Presentation $presentation The presentation of an indexable.
		 */
		return \apply_filters( 'wpseo_robots_array', \array_filter( $robots ), $this );
	}

	/**
```

### wpseo_indexables_indexation_alert
**File:** `wordpress-seo/src/presenters/admin/indexing-notification-presenter.php`

**Context:**

```php
$text = \esc_html__( 'You can speed up your site and get insight into your internal linking structure by letting us perform a few optimizations to the way SEO data is stored.', 'wordpress-seo' );
		}

		/**
		 * Filter: 'wpseo_indexables_indexation_alert' - Allow developers to filter the reason of the indexation
		 *
		 * @param string $text   The text to show as reason.
		 * @param string $reason The reason value.
		 */
		return (string) \apply_filters( 'wpseo_indexables_indexation_alert', $text, $reason );
	}

	/**
```

### wpseo_breadcrumb_output
**File:** `wordpress-seo/src/presenters/breadcrumbs-presenter.php`

**Context:**

```php
* @return string The filtered output.
	 */
	protected function filter( $output ) {
		/**
		 * Filter: 'wpseo_breadcrumb_output' - Allow changing the HTML output of the Yoast SEO breadcrumbs class.
		 *
		 * @param string                 $output       The HTML output.
		 * @param Indexable_Presentation $presentation The presentation of an indexable.
		 */
		return \apply_filters( 'wpseo_breadcrumb_output', $output, $this->presentation );
	}

	/**
```

### wpseo_breadcrumb_single_link
**File:** `wordpress-seo/src/presenters/breadcrumbs-presenter.php`

**Context:**

```php
$link .= '<' . $this->get_element() . '>' . $text . '</' . $this->get_element() . '>';
		}

		/**
		 * Filter: 'wpseo_breadcrumb_single_link' - Allow changing of each link being put out by the Yoast SEO breadcrumbs class.
		 *
		 * @param string $link_output The output string.
		 * @param array  $link        The breadcrumb link array.
		 */
		return \apply_filters( 'wpseo_breadcrumb_single_link', $link, $breadcrumb );
	}

	/**
```

### wpseo_breadcrumb_output_id
**File:** `wordpress-seo/src/presenters/breadcrumbs-presenter.php`

**Context:**

```php
*/
	protected function get_id() {
		if ( ! $this->id ) {
			/**
			 * Filter: 'wpseo_breadcrumb_output_id' - Allow changing the HTML ID on the Yoast SEO breadcrumbs wrapper element.
			 *
			 * @param string $unsigned ID to add to the wrapper element.
			 */
			$this->id = \apply_filters( 'wpseo_breadcrumb_output_id', '' );
			if ( ! \is_string( $this->id ) ) {
				return '';
			}
```

### wpseo_breadcrumb_output_class
**File:** `wordpress-seo/src/presenters/breadcrumbs-presenter.php`

**Context:**

```php
*/
	protected function get_class() {
		if ( ! $this->class ) {
			/**
			 * Filter: 'wpseo_breadcrumb_output_class' - Allow changing the HTML class on the Yoast SEO breadcrumbs wrapper element.
			 *
			 * @param string $unsigned Class to add to the wrapper element.
			 */
			$this->class = \apply_filters( 'wpseo_breadcrumb_output_class', '' );
			if ( ! \is_string( $this->class ) ) {
				return '';
			}
```

### wpseo_breadcrumb_output_wrapper
**File:** `wordpress-seo/src/presenters/breadcrumbs-presenter.php`

**Context:**

```php
*/
	protected function get_wrapper() {
		if ( ! $this->wrapper ) {
			$this->wrapper = \apply_filters( 'wpseo_breadcrumb_output_wrapper', 'span' );
			$this->wrapper = \tag_escape( $this->wrapper );
			if ( ! \is_string( $this->wrapper ) || $this->wrapper === '' ) {
				$this->wrapper = 'span';
```

### wpseo_breadcrumb_separator
**File:** `wordpress-seo/src/presenters/breadcrumbs-presenter.php`

**Context:**

```php
*/
	protected function get_separator() {
		if ( ! $this->separator ) {
			$this->separator = \apply_filters( 'wpseo_breadcrumb_separator', $this->helpers->options->get( 'breadcrumbs-sep' ) );
			$this->separator = ' ' . $this->separator . ' ';
		}
```

### wpseo_breadcrumb_single_link_wrapper
**File:** `wordpress-seo/src/presenters/breadcrumbs-presenter.php`

**Context:**

```php
*/
	protected function get_element() {
		if ( ! $this->element ) {
			$this->element = \esc_attr( \apply_filters( 'wpseo_breadcrumb_single_link_wrapper', 'span' ) );
		}

		return $this->element;
```

### wpseo_canonical
**File:** `wordpress-seo/src/presenters/canonical-presenter.php`

**Context:**

```php
return '';
		}

		/**
		 * Filter: 'wpseo_canonical' - Allow filtering of the canonical URL put out by Yoast SEO.
		 *
		 * @param string                 $canonical    The canonical URL.
		 * @param Indexable_Presentation $presentation The presentation of an indexable.
		 */
		return \urldecode( \trim( (string) \apply_filters( 'wpseo_canonical', $this->presentation->canonical, $this->presentation ) ) );
	}
}
```

### wpseo_debug_markers
**File:** `wordpress-seo/src/presenters/debug/marker-close-presenter.php`

**Context:**

```php
* @return string The debug close marker.
	 */
	public function present() {
		/**
		 * Filter: 'wpseo_debug_markers' - Allow disabling the debug markers.
		 *
		 * @param bool $show_markers True when the debug markers should be shown.
		 */
		if ( ! \apply_filters( 'wpseo_debug_markers', true ) ) {
			return '';
		}

		return \sprintf(
```

### wpseo_hide_version
**File:** `wordpress-seo/src/presenters/debug/marker-open-presenter.php`

**Context:**

```php
* @return string The constructed version information.
	 */
	private function construct_version_info() {
		/**
		 * Filter: 'wpseo_hide_version' - can be used to hide the Yoast SEO version in the debug marker (only available in Yoast SEO Premium).
		 *
		 * @param bool $hide_version
		 */
		if ( \apply_filters( 'wpseo_hide_version', false ) ) {
			return '';
		}

		return 'v' . \WPSEO_PREMIUM_VERSION . ' (Yoast SEO v' . \WPSEO_VERSION . ')';
```

### wpseo_meta_author
**File:** `wordpress-seo/src/presenters/meta-author-presenter.php`

**Context:**

```php
return '';
		}

		/**
		 * Filter: 'wpseo_meta_author' - Allow developers to filter the article's author meta tag.
		 *
		 * @param string                 $author_name  The article author's display name. Return empty to disable the tag.
		 * @param Indexable_Presentation $presentation The presentation of an indexable.
		 */
		return \trim( $this->helpers->schema->html->smart_strip_tags( \apply_filters( 'wpseo_meta_author', $user_data->display_name, $this->presentation ) ) );
	}
}
```

### wpseo_metadesc
**File:** `wordpress-seo/src/presenters/meta-description-presenter.php`

**Context:**

```php
public function get() {
		$meta_description = $this->replace_vars( $this->presentation->meta_description );

		/**
		 * Filter: 'wpseo_metadesc' - Allow changing the Yoast SEO meta description sentence.
		 *
		 * @param string                 $meta_description The description sentence.
		 * @param Indexable_Presentation $presentation     The presentation of an indexable.
		 */
		$meta_description = \apply_filters( 'wpseo_metadesc', $meta_description, $this->presentation );
		$meta_description = $this->helpers->string->strip_all_tags( \stripslashes( $meta_description ) );
		return \trim( $meta_description );
	}
```

### wpseo_opengraph_author_facebook
**File:** `wordpress-seo/src/presenters/open-graph/article-author-presenter.php`

**Context:**

```php
* @return string The filtered article author's Facebook URL.
	 */
	public function get() {
		/**
		 * Filter: 'wpseo_opengraph_author_facebook' - Allow developers to filter the article author's Facebook URL.
		 *
		 * @param bool|string            $article_author The article author's Facebook URL, return false to disable.
		 * @param Indexable_Presentation $presentation   The presentation of an indexable.
		 */
		return \trim( \apply_filters( 'wpseo_opengraph_author_facebook', $this->presentation->open_graph_article_author, $this->presentation ) );
	}
}
```

### wpseo_og_article_publisher
**File:** `wordpress-seo/src/presenters/open-graph/article-publisher-presenter.php`

**Context:**

```php
* @return string The filtered article publisher's Facebook URL.
	 */
	public function get() {
		/**
		 * Filter: 'wpseo_og_article_publisher' - Allow developers to filter the article publisher's Facebook URL.
		 *
		 * @param bool|string            $article_publisher The article publisher's Facebook URL, return false to disable.
		 * @param Indexable_Presentation $presentation      The presentation of an indexable.
		 */
		return \trim( \apply_filters( 'wpseo_og_article_publisher', $this->presentation->open_graph_article_publisher, $this->presentation ) );
	}
}
```

### wpseo_opengraph_desc
**File:** `wordpress-seo/src/presenters/open-graph/description-presenter.php`

**Context:**

```php
public function get() {
		$meta_og_description = $this->replace_vars( $this->presentation->open_graph_description );

		/**
		 * Filter: 'wpseo_opengraph_desc' - Allow changing the Yoast SEO generated Open Graph description.
		 *
		 * @param string                 $description  The description.
		 * @param Indexable_Presentation $presentation The presentation of an indexable.
		 */
		$meta_og_description = \apply_filters( 'wpseo_opengraph_desc', $meta_og_description, $this->presentation );
		$meta_og_description = $this->helpers->string->strip_all_tags( \stripslashes( $meta_og_description ) );
		return \trim( $meta_og_description );
	}
```

### wpseo_opengraph_image
**File:** `wordpress-seo/src/presenters/open-graph/image-presenter.php`

**Context:**

```php
* @return array<string, string|int> The filtered image.
	 */
	protected function filter( $image ) {
		/**
		 * Filter: 'wpseo_opengraph_image' - Allow changing the Open Graph image url.
		 *
		 * @param string                 $image_url    The URL of the Open Graph image.
		 * @param Indexable_Presentation $presentation The presentation of an indexable.
		 */
		$image_url = \apply_filters( 'wpseo_opengraph_image', $image['url'], $this->presentation );
		if ( ! empty( $image_url ) && \is_string( $image_url ) ) {
			$image['url'] = \trim( $image_url );
		}
```

### wpseo_opengraph_image_type
**File:** `wordpress-seo/src/presenters/open-graph/image-presenter.php`

**Context:**

```php
}

		$image_type = ( $image['type'] ?? '' );
		/**
		 * Filter: 'wpseo_opengraph_image_type' - Allow changing the Open Graph image type.
		 *
		 * @param string                 $image_type   The type of the Open Graph image.
		 * @param Indexable_Presentation $presentation The presentation of an indexable.
		 */
		$image_type = \apply_filters( 'wpseo_opengraph_image_type', $image_type, $this->presentation );
		if ( ! empty( $image_type ) && \is_string( $image_type ) ) {
			$image['type'] = \trim( $image_type );
		}
```

### wpseo_opengraph_image_width
**File:** `wordpress-seo/src/presenters/open-graph/image-presenter.php`

**Context:**

```php
}

		$image_width = ( $image['width'] ?? '' );
		/**
		 * Filter: 'wpseo_opengraph_image_width' - Allow changing the Open Graph image width.
		 *
		 * @param int                    $image_width  The width of the Open Graph image.
		 * @param Indexable_Presentation $presentation The presentation of an indexable.
		 */
		$image_width = (int) \apply_filters( 'wpseo_opengraph_image_width', $image_width, $this->presentation );
		if ( ! empty( $image_width ) && $image_width > 0 ) {
			$image['width'] = $image_width;
		}
```

### wpseo_opengraph_image_height
**File:** `wordpress-seo/src/presenters/open-graph/image-presenter.php`

**Context:**

```php
}

		$image_height = ( $image['height'] ?? '' );
		/**
		 * Filter: 'wpseo_opengraph_image_height' - Allow changing the Open Graph image height.
		 *
		 * @param int                    $image_height The height of the Open Graph image.
		 * @param Indexable_Presentation $presentation The presentation of an indexable.
		 */
		$image_height = (int) \apply_filters( 'wpseo_opengraph_image_height', $image_height, $this->presentation );
		if ( ! empty( $image_height ) && $image_height > 0 ) {
			$image['height'] = $image_height;
		}
```

### wpseo_og_locale
**File:** `wordpress-seo/src/presenters/open-graph/locale-presenter.php`

**Context:**

```php
* @return string The filtered locale.
	 */
	public function get() {
		/**
		 * Filter: 'wpseo_og_locale' - Allow changing the Yoast SEO Open Graph locale.
		 *
		 * @param string                 $locale       The locale string
		 * @param Indexable_Presentation $presentation The presentation of an indexable.
		 */
		return (string) \trim( \apply_filters( 'wpseo_og_locale', $this->presentation->open_graph_locale, $this->presentation ) );
	}
}
```

### wpseo_opengraph_site_name
**File:** `wordpress-seo/src/presenters/open-graph/site-name-presenter.php`

**Context:**

```php
* @return string The filtered site_name.
	 */
	public function get() {
		/**
		 * Filter: 'wpseo_opengraph_site_name' - Allow changing the Yoast SEO generated Open Graph site name.
		 *
		 * @param string                 $site_name    The site_name.
		 * @param Indexable_Presentation $presentation The presentation of an indexable.
		 */
		return (string) \trim( \apply_filters( 'wpseo_opengraph_site_name', $this->presentation->open_graph_site_name, $this->presentation ) );
	}
}
```

### wpseo_opengraph_title
**File:** `wordpress-seo/src/presenters/open-graph/title-presenter.php`

**Context:**

```php
public function get() {
		$title = $this->replace_vars( $this->presentation->open_graph_title );

		/**
		 * Filter: 'wpseo_opengraph_title' - Allow changing the Yoast SEO generated title.
		 *
		 * @param string                 $title        The title.
		 * @param Indexable_Presentation $presentation The presentation of an indexable.
		 */
		$title = \trim( (string) \apply_filters( 'wpseo_opengraph_title', $title, $this->presentation ) );
		return $this->helpers->string->strip_all_tags( $title );
	}
}
```

### wpseo_opengraph_type
**File:** `wordpress-seo/src/presenters/open-graph/type-presenter.php`

**Context:**

```php
* @return string The filtered type.
	 */
	public function get() {
		/**
		 * Filter: 'wpseo_opengraph_type' - Allow changing the opengraph type.
		 *
		 * @param string                 $type         The type.
		 * @param Indexable_Presentation $presentation The presentation of an indexable.
		 */
		return (string) \apply_filters( 'wpseo_opengraph_type', $this->presentation->open_graph_type, $this->presentation );
	}
}
```

### wpseo_opengraph_url
**File:** `wordpress-seo/src/presenters/open-graph/url-presenter.php`

**Context:**

```php
* @return string The filtered url.
	 */
	public function get() {
		/**
		 * Filter: 'wpseo_opengraph_url' - Allow changing the Yoast SEO generated open graph URL.
		 *
		 * @param string                 $url          The open graph URL.
		 * @param Indexable_Presentation $presentation The presentation of an indexable.
		 */
		return \urldecode( (string) \apply_filters( 'wpseo_opengraph_url', $this->presentation->open_graph_url, $this->presentation ) );
	}
}
```

### wpseo_next_rel_link
**File:** `wordpress-seo/src/presenters/rel-next-presenter.php`

**Context:**

```php
$output = parent::present();

		if ( ! empty( $output ) ) {
			/**
			 * Filter: 'wpseo_next_rel_link' - Allow changing link rel output by Yoast SEO.
			 *
			 * @param string $unsigned The full `<link` element.
			 */
			return \apply_filters( 'wpseo_next_rel_link', $output );
		}

		return '';
```

### wpseo_adjacent_rel_url
**File:** `wordpress-seo/src/presenters/rel-next-presenter.php`

**Context:**

```php
return '';
		}

		/**
		 * Filter: 'wpseo_adjacent_rel_url' - Allow filtering of the rel next URL put out by Yoast SEO.
		 *
		 * @param string                 $rel_next     The rel next URL.
		 * @param string                 $rel          Link relationship, prev or next.
		 * @param Indexable_Presentation $presentation The presentation of an indexable.
		 */
		return (string) \trim( \apply_filters( 'wpseo_adjacent_rel_url', $this->presentation->rel_next, 'next', $this->presentation ) );
	}
}
```

### wpseo_prev_rel_link
**File:** `wordpress-seo/src/presenters/rel-prev-presenter.php`

**Context:**

```php
$output = parent::present();

		if ( ! empty( $output ) ) {
			/**
			 * Filter: 'wpseo_prev_rel_link' - Allow changing link rel output by Yoast SEO.
			 *
			 * @param string $unsigned The full `<link` element.
			 */
			return \apply_filters( 'wpseo_prev_rel_link', $output );
		}

		return '';
```

### wpseo_json_ld_output
**File:** `wordpress-seo/src/presenters/schema-presenter.php`

**Context:**

```php
'_deprecated' => 'Please use the "wpseo_schema_*" filters to extend the Yoast SEO schema data - see the WPSEO_Schema class.',
		];

		/**
		 * Filter: 'wpseo_json_ld_output' - Allows disabling Yoast's schema output entirely.
		 *
		 * @param mixed  $deprecated If false or an empty array is returned, disable our output.
		 * @param string $empty
		 */
		$return = \apply_filters( 'wpseo_json_ld_output', $deprecated_data, '' );
		if ( $return === [] || $return === false ) {
			return '';
		}
```

### wpseo_enhanced_slack_data
**File:** `wordpress-seo/src/presenters/slack/enhanced-data-presenter.php`

**Context:**

```php
$data[ \__( 'Est. reading time', 'wordpress-seo' ) ] = \sprintf( \_n( '%s minute', '%s minutes', $estimated_reading_time, 'default' ), $estimated_reading_time );
		}

		/**
		 * Filter: 'wpseo_enhanced_slack_data' - Allows filtering of the enhanced data for sharing on Slack.
		 *
		 * @param array                  $data         The enhanced Slack sharing data.
		 * @param Indexable_Presentation $presentation The presentation of an indexable.
		 */
		return \apply_filters( 'wpseo_enhanced_slack_data', $data, $this->presentation );
	}
}
```

### wpseo_title
**File:** `wordpress-seo/src/presenters/title-presenter.php`

**Context:**

```php
public function get_title() {
		$title = $this->replace_vars( $this->presentation->title );

		/**
		 * Filter: 'wpseo_title' - Allow changing the Yoast SEO generated title.
		 *
		 * @param string                 $title        The title.
		 * @param Indexable_Presentation $presentation The presentation of an indexable.
		 */
		$title = \apply_filters( 'wpseo_title', $title, $this->presentation );
		$title = $this->helpers->string->strip_all_tags( $title );
		return \trim( $title );
	}
```

### wpseo_twitter_card_type
**File:** `wordpress-seo/src/presenters/twitter/card-presenter.php`

**Context:**

```php
* @return string The filtered card type.
	 */
	public function get() {
		/**
		 * Filter: 'wpseo_twitter_card_type' - Allow changing the Twitter card type.
		 *
		 * @param string $card_type The card type.
		 * @param Indexable_Presentation $presentation The presentation of an indexable.
		 */
		return \trim( \apply_filters( 'wpseo_twitter_card_type', $this->presentation->twitter_card, $this->presentation ) );
	}
}
```

### wpseo_twitter_description
**File:** `wordpress-seo/src/presenters/twitter/description-presenter.php`

**Context:**

```php
* @return string The filtered Twitter description.
	 */
	public function get() {
		/**
		 * Filter: 'wpseo_twitter_description' - Allow changing the Twitter description as output in the Twitter card by Yoast SEO.
		 *
		 * @param string                 $twitter_description The description string.
		 * @param Indexable_Presentation $presentation        The presentation of an indexable.
		 */
		return \apply_filters( 'wpseo_twitter_description', $this->replace_vars( $this->presentation->twitter_description ), $this->presentation );
	}
}
```

### wpseo_twitter_image
**File:** `wordpress-seo/src/presenters/twitter/image-presenter.php`

**Context:**

```php
* @return string The filtered Twitter image.
	 */
	public function get() {
		/**
		 * Filter: 'wpseo_twitter_image' - Allow changing the Twitter Card image.
		 *
		 * @param string                 $twitter_image Image URL string.
		 * @param Indexable_Presentation $presentation  The presentation of an indexable.
		 */
		return (string) \apply_filters( 'wpseo_twitter_image', $this->presentation->twitter_image, $this->presentation );
	}
}
```

### wpseo_twitter_site
**File:** `wordpress-seo/src/presenters/twitter/site-presenter.php`

**Context:**

```php
* @return string The filtered Twitter site.
	 */
	public function get() {
		/**
		 * Filter: 'wpseo_twitter_site' - Allow changing the Twitter site account as output in the Twitter card by Yoast SEO.
		 *
		 * @param string                 $twitter_site Twitter site account string.
		 * @param Indexable_Presentation $presentation The presentation of an indexable.
		 */
		$twitter_site = \apply_filters( 'wpseo_twitter_site', $this->presentation->twitter_site, $this->presentation );
		$twitter_site = $this->get_twitter_id( $twitter_site );

		if ( ! \is_string( $twitter_site ) || $twitter_site === '' ) {
```

### wpseo_twitter_title
**File:** `wordpress-seo/src/presenters/twitter/title-presenter.php`

**Context:**

```php
* @return string The filtered Twitter title.
	 */
	public function get() {
		/**
		 * Filter: 'wpseo_twitter_title' - Allow changing the Twitter title.
		 *
		 * @param string                 $twitter_title The Twitter title.
		 * @param Indexable_Presentation $presentation  The presentation of an indexable.
		 */
		return \trim( \apply_filters( 'wpseo_twitter_title', $this->replace_vars( $this->presentation->twitter_title ), $this->presentation ) );
	}
}
```

## Actions (25)

### wpseo_publishbox_misc_actions
**File:** `wordpress-seo/admin/class-admin-init.php`

**Context:**

```php
<?php
			/**
			 * Fires after the post time/date setting in the Publish meta box.
			 *
			 * @param WP_Post $post The current post object.
			 */
			do_action( 'wpseo_publishbox_misc_actions', $post );
		}
	}
}
```

### wpseo_admin_footer
**File:** `wordpress-seo/admin/class-yoast-form.php`

**Context:**

```php
</form>';
		}

		/**
		 * Apply general admin_footer hooks.
		 */
		do_action( 'wpseo_admin_footer', $this );

		/**
		 * Run possibly set actions to add for example an i18n box.
```

### wpseo_admin_below_content
**File:** `wordpress-seo/admin/class-yoast-form.php`

**Context:**

```php
}

		echo '</div><!-- end of div wpseo_content_wrapper -->';

		do_action( 'wpseo_admin_below_content', $this );

		echo '
			</div><!-- end of wrap -->';
```

### wpseo_save_compare_data
**File:** `wordpress-seo/admin/metabox/class-metabox.php`

**Context:**

```php
// Non-existent post.
			return false;
		}

		do_action( 'wpseo_save_compare_data', $post );

		$social_fields = [];
		if ( $this->social_is_enabled ) {
```

### wpseo_settings_tab_site_analysis_internal
**File:** `wordpress-seo/admin/views/tabs/dashboard/site-analysis.php`

**Context:**

```php
exit();
}

/**
 * WARNING: This hook is intended for internal use only.
 * Don't use it in your code as it will be removed shortly.
 */
do_action( 'wpseo_settings_tab_site_analysis_internal', $yform );
```

### wpseo_settings_tab_crawl_cleanup_network
**File:** `wordpress-seo/admin/views/tabs/network/crawl-settings.php`

**Context:**

```php
);
	echo '</p>';

	/**
	 * Fires when displaying the crawl cleanup network tab.
	 *
	 * @param Yoast_Form $yform The yoast form object.
	 */
	do_action( 'wpseo_settings_tab_crawl_cleanup_network', $yform );
	?>
```

### Yoast\WP\SEO\admin_network_integration_after
**File:** `wordpress-seo/admin/views/tabs/network/integrations.php`

**Context:**

```php
'premium_upsell_url'      => $premium_upsell_url,
				]
			);

			do_action( 'Yoast\WP\SEO\admin_network_integration_after', $integration );
		}
		?>
```

### wpseo_render_user_profile
**File:** `wordpress-seo/admin/views/user-profile.php`

**Context:**

```php
<?php do_action( 'wpseo_render_user_profile', $user ); ?>
</div>
```

### wpseo_run_upgrade
**File:** `wordpress-seo/inc/class-upgrade.php`

**Context:**

```php
add_action( 'init', [ $this, 'upgrade_125' ] );
		}

		/**
		 * Filter: 'wpseo_run_upgrade' - Runs the upgrade hook which are dependent on Yoast SEO.
		 *
		 * @param string $version The current version of Yoast SEO
		 */
		do_action( 'wpseo_run_upgrade', $version );

		$this->finish_up( $version );
	}
```

### wpseo_add_adminbar_submenu
**File:** `wordpress-seo/inc/class-wpseo-admin-bar-menu.php`

**Context:**

```php
$this->add_root_menu( $wp_admin_bar );

		/**
		 * Adds a submenu item in the top of the adminbar.
		 *
		 * @param WP_Admin_Bar $wp_admin_bar    Admin bar instance to add the menu to.
		 * @param string       $menu_identifier The menu identifier.
		 */
		do_action( 'wpseo_add_adminbar_submenu', $wp_admin_bar, self::MENU_IDENTIFIER );

		if ( ! is_admin() ) {
```

### delete_post_meta
**File:** `wordpress-seo/inc/class-wpseo-meta.php`

**Context:**

```php
$meta_ids = $wpdb->get_col( $query );

		if ( is_array( $meta_ids ) && $meta_ids !== [] ) {
			// WP native action.
			do_action( 'delete_post_meta', $meta_ids, null, null, null );

			$query = "DELETE FROM {$wpdb->postmeta} WHERE meta_id IN( " . implode( ',', $meta_ids ) . ' )';
			$count = $wpdb->query( $query );
```

### deleted_post_meta
**File:** `wordpress-seo/inc/class-wpseo-meta.php`

**Context:**

```php
foreach ( $meta_ids as $object_id ) {
					wp_cache_delete( $object_id, 'post_meta' );
				}

				// WP native action.
				do_action( 'deleted_post_meta', $meta_ids, null, null, null );
			}
		}
		unset( $query, $meta_ids, $count, $object_id );
```

### yoast_add_dynamic_rewrite_rules
**File:** `wordpress-seo/inc/class-yoast-dynamic-rewrites.php`

**Context:**

```php
*/
	public function trigger_dynamic_rewrite_rules_hook() {

		/**
		 * Fires when the plugin's dynamic rewrite rules should be added.
		 *
		 * @param self $dynamic_rewrites Dynamic rewrites handler instance. Use its `add_rule()` method
		 *                               to add dynamic rewrite rules.
		 */
		do_action( 'yoast_add_dynamic_rewrite_rules', $this );
	}

	/**
```

### wpseo_ftc_post_update_site_representation
**File:** `wordpress-seo/src/actions/configuration/first-time-configuration-action.php`

**Context:**

```php
$this->options_helper->set( 'company_logo_meta', false );
		$this->options_helper->set( 'person_logo_meta', false );

		/**
		 * Action: 'wpseo_post_update_site_representation' - Allows for Hiive event tracking.
		 *
		 * @param array $params     The new values of the options.
		 * @param array $old_values The old values of the options.
		 * @param array $failures   The options that failed to be saved.
		 *
		 * @internal
		 */
		\do_action( 'wpseo_ftc_post_update_site_representation', $params, $old_values, $failures );

		if ( \count( $failures ) === 0 ) {
			return (object) [
```

### wpseo_ftc_post_update_social_profiles
**File:** `wordpress-seo/src/actions/configuration/first-time-configuration-action.php`

**Context:**

```php
$old_values = $this->get_old_values( \array_keys( $this->social_profiles_helper->get_organization_social_profile_fields() ) );
		$failures   = $this->social_profiles_helper->set_organization_social_profiles( $params );

		/**
		 * Action: 'wpseo_post_update_social_profiles' - Allows for Hiive event tracking.
		 *
		 * @param array $params     The new values of the options.
		 * @param array $old_values The old values of the options.
		 * @param array $failures   The options that failed to be saved.
		 *
		 * @internal
		 */
		\do_action( 'wpseo_ftc_post_update_social_profiles', $params, $old_values, $failures );

		if ( empty( $failures ) ) {
			return (object) [
```

### wpseo_ftc_post_update_enable_tracking
**File:** `wordpress-seo/src/actions/configuration/first-time-configuration-action.php`

**Context:**

```php
$success = $this->options_helper->set( 'tracking', $params['tracking'] );
		}

		/**
		 * Action: 'wpseo_post_update_enable_tracking' - Allows for Hiive event tracking.
		 *
		 * @param array $new_value The new value.
		 * @param array $old_value The old value.
		 * @param bool  $failure   Whether the option failed to be stored.
		 *
		 * @internal
		 */
		// $success is negated to be aligned with the other two actions which pass $failures.
		\do_action( 'wpseo_ftc_post_update_enable_tracking', $params['tracking'], $option_value, ! $success );

		if ( $success ) {
			return (object) [
```

### wpseo_indexables_unindexed_calculated
**File:** `wordpress-seo/src/actions/indexing/abstract-indexing-action.php`

**Context:**

```php
\set_transient( static::UNINDEXED_COUNT_TRANSIENT, $count, \DAY_IN_SECONDS );

		/**
		 * Action: 'wpseo_indexables_unindexed_calculated' - sets an option to timestamp when there are no unindexed indexables left.
		 *
		 * @internal
		 */
		\do_action( 'wpseo_indexables_unindexed_calculated', static::UNINDEXED_COUNT_TRANSIENT, $count );

		return (int) $count;
	}
```

### wpseo_add_cleanup_counts_to_indexable_bucket
**File:** `wordpress-seo/src/analytics/application/to-be-cleaned-indexables-collector.php`

**Context:**

```php
* @return void
	 */
	private function add_additional_counts( $to_be_cleaned_indexable_bucket ) {
		/**
		 * Action: Adds the possibility to add additional to be cleaned objects.
		 *
		 * @internal
		 * @param To_Be_Cleaned_Indexable_Bucket $bucket An indexable cleanup bucket. New values are instances of To_Be_Cleaned_Indexable_Count.
		 */
		\do_action( 'wpseo_add_cleanup_counts_to_indexable_bucket', $to_be_cleaned_indexable_bucket );
	}
}
```

### wpseo_save_indexable
**File:** `wordpress-seo/src/helpers/indexable-helper.php`

**Context:**

```php
$indexable->save();

		if ( $indexable_before ) {
			/**
			 * Action: 'wpseo_save_indexable' - Allow developers to perform an action
			 * when the indexable is updated.
			 *
			 * @param Indexable $indexable        The saved indexable.
			 * @param Indexable $indexable_before The indexable before saving.
			 */
			\do_action( 'wpseo_save_indexable', $indexable, $indexable_before );
		}

		return $indexable;
```

### Yoast\WP\SEO\register_robots_rules
**File:** `wordpress-seo/src/integrations/front-end/robots-txt-integration.php`

**Context:**

```php
$this->add_subdirectory_multisite_xml_sitemaps();
		}

		/**
		 * Allow registering custom robots rules to be outputted within the Yoast content block in robots.txt.
		 *
		 * @param Robots_Txt_Helper $robots_txt_helper The Robots_Txt_Helper object.
		 */
		\do_action( 'Yoast\WP\SEO\register_robots_rules', $this->robots_txt_helper );

		return \trim( $robots_txt . \PHP_EOL . $this->robots_txt_presenter->present() . \PHP_EOL );
	}
```

### wpseo_indexable_deleted
**File:** `wordpress-seo/src/integrations/watchers/indexable-author-watcher.php`

**Context:**

```php
}

		$indexable->delete();
		\do_action( 'wpseo_indexable_deleted', $indexable );
	}

	/**
```

### new_public_post_type_notifications
**File:** `wordpress-seo/src/integrations/watchers/indexable-post-type-change-watcher.php`

**Context:**

```php
\delete_transient( Indexable_Post_Indexation_Action::UNINDEXED_LIMITED_COUNT_TRANSIENT );

			$this->indexing_helper->set_reason( Indexing_Reasons::REASON_POST_TYPE_MADE_PUBLIC );

			\do_action( 'new_public_post_type_notifications', $newly_made_public_post_types );
		}

		// There are post types that have been made private.
```

### clean_new_public_post_type_notifications
**File:** `wordpress-seo/src/integrations/watchers/indexable-post-type-change-watcher.php`

**Context:**

```php
if ( $cleanup_not_yet_scheduled ) {
				\wp_schedule_single_event( ( \time() + ( \MINUTE_IN_SECONDS * 5 ) ), Cleanup_Integration::START_HOOK );
			}

			\do_action( 'clean_new_public_post_type_notifications', $newly_made_non_public_post_types );
		}
	}
}
```

### new_public_taxonomy_notifications
**File:** `wordpress-seo/src/integrations/watchers/indexable-taxonomy-change-watcher.php`

**Context:**

```php
\delete_transient( Indexable_Term_Indexation_Action::UNINDEXED_LIMITED_COUNT_TRANSIENT );

			$this->indexing_helper->set_reason( Indexing_Reasons::REASON_TAXONOMY_MADE_PUBLIC );
			\do_action( 'new_public_taxonomy_notifications', $newly_made_public_taxonomies );
		}

		// There are taxonomies that have been made private.
```

### clean_new_public_taxonomy_notifications
**File:** `wordpress-seo/src/integrations/watchers/indexable-taxonomy-change-watcher.php`

**Context:**

```php
if ( $cleanup_not_yet_scheduled ) {
				\wp_schedule_single_event( ( \time() + ( \MINUTE_IN_SECONDS * 5 ) ), Cleanup_Integration::START_HOOK );
			}

			\do_action( 'clean_new_public_taxonomy_notifications', $newly_made_non_public_taxonomies );
		}
	}
}
```

