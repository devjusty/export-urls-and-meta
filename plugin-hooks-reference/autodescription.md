## Filters (160)

### the_seo_framework_kill_core_robots
**File:** `autodescription/bootstrap/init-front.php`

**Context:**

```php
\add_filter( 'the_excerpt_rss', [ Front\Feed::class, 'modify_the_content_feed' ], 10, 1 );
}

/**
 * @since 4.1.4
 * @param bool $kill_core_robots Whether you lack sympathy for rocks tricked to think.
 */
if ( \apply_filters( 'the_seo_framework_kill_core_robots', true ) ) {
	\remove_filter( 'wp_robots', 'wp_robots_max_image_preview_large' );
	// Reconsider readding this to "supported" queries only?
	\remove_filter( 'wp_robots', 'wp_robots_noindex_search' );
}
```

### the_seo_framework_load
**File:** `autodescription/bootstrap/load.php`

**Context:**

```php
* @access private
 */
function _load_tsf() {
	/**
	 * @since 2.3.7
	 * @param bool $load
	 */
	if ( \apply_filters( 'the_seo_framework_load', true ) ) {
		if ( THE_SEO_FRAMEWORK_DEBUG )
			require \THE_SEO_FRAMEWORK_BOOTSTRAP_PATH . 'load-debug.php';

		require \THE_SEO_FRAMEWORK_BOOTSTRAP_PATH . 'init-compat.php';
```

### the_seo_framework_top_menu_args
**File:** `autodescription/inc/classes/admin/menu.class.php`

**Context:**

```php
$issue_count = static::get_top_menu_issue_count();

		/**
		 * @since 4.2.8
		 * @param array $args The menu arguments. All indexes must be maintained.
		 */
		return memo( \apply_filters(
			'the_seo_framework_top_menu_args',
			[
				'page_title' => \esc_html__( 'SEO Settings', 'autodescription' ),
				'menu_title' => \esc_html__( 'SEO', 'autodescription' )
					. ( $issue_count ? static::get_issue_badge( $issue_count ) : '' ),
				'capability' => \THE_SEO_FRAMEWORK_SETTINGS_CAP,
				'menu_slug'  => \THE_SEO_FRAMEWORK_SITE_OPTIONS_SLUG,
				'callback'   => [ Settings\Plugin::class, 'prepare_settings_wrap' ],
				'icon'       => 'dashicons-search',
				'position'   => '90.9001',
			],
		) );
	}

	/**
```

### the_seo_framework_top_menu_issue_count
**File:** `autodescription/inc/classes/admin/menu.class.php`

**Context:**

```php
if ( is_headless( 'settings' ) ) return 0;

		/**
		 * @since 4.2.8
		 * @param int The issue count. Don't overwrite, but increment it!
		 */
		return memo() ?? memo( \absint( \apply_filters( 'the_seo_framework_top_menu_issue_count', 0 ) ) );
	}

	/**
```

### wp_create_file_in_uploads
**File:** `autodescription/inc/classes/admin/script/ajax.class.php`

**Context:**

```php
* @param string $cropped       Path to the cropped image file.
				 */
				\do_action( 'wp_ajax_crop_image_pre_save', $context, $attachment_id, $cropped );

				/** This filter is documented in wp-admin/includes/class-custom-image-header.php */
				$cropped = \apply_filters( 'wp_create_file_in_uploads', $cropped, $attachment_id ); // For replication.

				$parent_url       = \wp_get_attachment_url( $attachment_id );
				$parent_basename  = \wp_basename( $parent_url );
				$cropped_basename = \wp_basename( $cropped );
				$url              = str_replace( $parent_basename, $cropped_basename, $parent_url );
```

### wp_ajax_cropped_attachment_metadata
**File:** `autodescription/inc/classes/admin/script/ajax.class.php`

**Context:**

```php
$attachment_id = \wp_insert_attachment( $attachment, $cropped );
				$metadata      = \wp_generate_attachment_metadata( $attachment_id, $cropped );

				/**
				 * @since 5.0.0 WordPress Core
				 * @see wp_generate_attachment_metadata()
				 * @param array $metadata Attachment metadata.
				 */
				$metadata = \apply_filters( 'wp_ajax_cropped_attachment_metadata', $metadata );
				\wp_update_attachment_metadata( $attachment_id, $metadata );

				/**
```

### wp_ajax_cropped_attachment_id
**File:** `autodescription/inc/classes/admin/script/ajax.class.php`

**Context:**

```php
$metadata = \apply_filters( 'wp_ajax_cropped_attachment_metadata', $metadata );
				\wp_update_attachment_metadata( $attachment_id, $metadata );

				/**
				 * @since 5.0.0 WordPress Core
				 * @param int    $attachment_id The attachment ID of the cropped image.
				 * @param string $context       The Customizer control requesting the cropped image.
				 */
				$attachment_id = \apply_filters( 'wp_ajax_cropped_attachment_id', $attachment_id, $context );
				break;

			default:
```

### the_seo_framework_scripts
**File:** `autodescription/inc/classes/admin/script/loader.class.php`

**Context:**

```php
$scripts[] = static::get_counter_scripts();
		}

		/**
		 * @since 3.1.0
		 * @since 4.0.0 1. Now holds all scripts.
		 *              2. Added $loader parameter.
		 * @since 4.2.7 Consolidated all input scripts into a list.
		 * @param array  $scripts  The default CSS and JS loader settings.
		 * @param string $registry The \The_SEO_Framework\Admin\Script\Registry registry class name.
		 * @param string $loader   The \The_SEO_Framework\Admin\Script\Loader loader class name.
		 */
		$scripts = \apply_filters(
			'the_seo_framework_scripts',
			// Flattening is 3% of this method's total time, we can improve by simplifying the getters above like do_meta_output().
			Arrays::flatten_list( $scripts ),
			Registry::class,
			Loader::class,
		);

		Registry::register( $scripts );
	}
```

### the_seo_framework_register_scripts
**File:** `autodescription/inc/classes/admin/script/registry.class.php`

**Context:**

```php
)
		);

		/**
		 * @since 5.0.0
		 * @param bool $register Whether to register scripts and hooks.
		 */
		if ( \apply_filters( 'the_seo_framework_register_scripts', $register ) )
			static::register_scripts_and_hooks();
	}

	/**
```

### the_seo_framework_bother_me_desc_length
**File:** `autodescription/inc/classes/admin/seobar/builder/page.class.php`

**Context:**

```php
/* translators: 1 = An assessment, 2 = Disclaimer, e.g. "take it with a grain of salt" */
					'disclaim'   => \__( '%1$s (%2$s)', 'autodescription' ),
					'estimated'  => \__( 'Estimated from the number of characters found. The pixel counter asserts the true length.', 'autodescription' ),
					/**
					 * @since 2.6.0
					 * @param int $short_word_length The minimum stringlength of words to find as dupes.
					 */
					'dupe_short' => (int) \apply_filters( 'the_seo_framework_bother_me_desc_length', 3 ),
				],
				'assess'   => [
					'empty'     => \__( 'There is no usable content, so no description could be generated.', 'autodescription' ),
					'builder'   => \__( 'A page builder is used that renders content dynamically, so no description can be generated for performance and privacy reasons. Consider providing a custom description.', 'autodescription' ),
					'protected' => \__( 'The page is protected, so no description is generated.', 'autodescription' ),
					'excerpt'   => \__( "It's built from the page excerpt field.", 'autodescription' ),
					/* translators: %s = list of repeated words */
					'dupes'     => \__( 'Found repeated words: %s', 'autodescription' ),
					'syntax'    => \__( "Markup syntax was found that isn't transformed. Consider rewriting the custom description.", 'autodescription' ),
				],
				'reason'   => [
					'empty'         => \__( 'Empty.', 'autodescription' ),
					'founddupe'     => \__( 'Found repeated words.', 'autodescription' ),
					'foundmanydupe' => \__( 'Found too many repeated words.', 'autodescription' ),
					'syntax'        => \__( 'Found markup syntax.', 'autodescription' ),
				],
				'defaults' => [
					'generated'   => [
						'symbol' => \_x( 'DG', 'Description Generated', 'autodescription' ),
						'title'  => \__( 'Description, generated', 'autodescription' ),
						'status' => Builder::STATE_GOOD,
						'reason' => \__( 'Automatically generated.', 'autodescription' ),
						'assess' => [
							'base' => \__( "It's built from the page content.", 'autodescription' ),
						],
					],
					'emptynoauto' => [
						'symbol' => \_x( 'D', 'Description', 'autodescription' ),
						'title'  => \__( 'Description', 'autodescription' ),
						'status' => Builder::STATE_UNKNOWN,
						'reason' => \__( 'Empty.', 'autodescription' ),
						'assess' => [
							'noauto' => \__( 'No page description is set.', 'autodescription' ),
						],
					],
					'custom'      => [
						'symbol' => \_x( 'D', 'Description', 'autodescription' ),
						'title'  => \__( 'Description', 'autodescription' ),
						'status' => Builder::STATE_GOOD,
						'reason' => \__( 'Obtained from the page SEO meta input.', 'autodescription' ),
						'assess' => [
							'base' => \__( "It's built from the page SEO meta input.", 'autodescription' ),
						],
					],
				],
			],
		);

		$generator_args = [ 'id' => static::$query['id'] ];
```

### the_seo_framework_seo_column_keys_order
**File:** `autodescription/inc/classes/admin/seobar/listtable.class.php`

**Context:**

```php
'tags',
		];

		/**
		 * @since 2.8.0
		 * @param string[] $order_keys The keys where the SEO column may be prepended to.
		 *                             The first key found will be used.
		 */
		$order_keys = (array) \apply_filters( 'the_seo_framework_seo_column_keys_order', $order_keys );

		foreach ( $order_keys as $key ) {
			// Put value in $offset, if not false, break loop.
```

### the_seo_framework_list_table_data
**File:** `autodescription/inc/classes/admin/settings/listedit.class.php`

**Context:**

```php
],
		];

		/**
		 * Tip: Prefix the indexes with your (plugin) name to prevent collisions.
		 * The index corresponds to field with the ID `autodescription-quick[%s]`, where %s is the index.
		 *
		 * Do not modify the structure or remove existing indexes!
		 *
		 * @since 4.0.5
		 * @since 4.1.0 Now has `doctitle` and `description` indexes in its first parameter.
		 * @since 4.2.3 Now supports the `placeholder` index for $data.
		 * @param array $data           {
		 *     The current data keyed by input field name.
		 *
		 *     @type mixed  $value       The current value.
		 *     @type bool   $isSelect    Optional. Whether the field is a select field.
		 *     @type string $default     Optional. Only works when $isSelect is true. The default value to be set in select index 0.
		 *     @type string $placeholder Optional. Only works when $isSelect is false. Sets a placeholder for the input field.
		 * }
		 * @param array $generator_args The query data. Contains 'id' or 'taxonomy'.
		 */
		$data = \apply_filters( 'the_seo_framework_list_table_data', $data, $generator_args );

		printf(
			// '<span class=hidden id=%s data-le="%s"></span>',
```

### the_seo_framework_general_metabox
**File:** `autodescription/inc/classes/admin/settings/plugin.class.php`

**Context:**

```php
*/
	public static function register_seo_settings_meta_boxes() {

		/**
		 * Various meta box filters.
		 * Set any to false if you wish the meta box to be removed.
		 *
		 * @since 2.2.4
		 * @since 2.8.0 Added `the_seo_framework_general_metabox` filter.
		 * @since 4.2.0 Added `the_seo_framework_post_type_archive_metabox` filter.
		 */
		$general           = (bool) \apply_filters( 'the_seo_framework_general_metabox', true );
		$title             = (bool) \apply_filters( 'the_seo_framework_title_metabox', true );
		$description       = (bool) \apply_filters( 'the_seo_framework_description_metabox', true );
		$robots            = (bool) \apply_filters( 'the_seo_framework_robots_metabox', true );
```

### the_seo_framework_title_metabox
**File:** `autodescription/inc/classes/admin/settings/plugin.class.php`

**Context:**

```php
* @since 4.2.0 Added `the_seo_framework_post_type_archive_metabox` filter.
		 */
		$general           = (bool) \apply_filters( 'the_seo_framework_general_metabox', true );
		$title             = (bool) \apply_filters( 'the_seo_framework_title_metabox', true );
		$description       = (bool) \apply_filters( 'the_seo_framework_description_metabox', true );
		$robots            = (bool) \apply_filters( 'the_seo_framework_robots_metabox', true );
		$home              = (bool) \apply_filters( 'the_seo_framework_home_metabox', true );
```

### the_seo_framework_description_metabox
**File:** `autodescription/inc/classes/admin/settings/plugin.class.php`

**Context:**

```php
*/
		$general           = (bool) \apply_filters( 'the_seo_framework_general_metabox', true );
		$title             = (bool) \apply_filters( 'the_seo_framework_title_metabox', true );
		$description       = (bool) \apply_filters( 'the_seo_framework_description_metabox', true );
		$robots            = (bool) \apply_filters( 'the_seo_framework_robots_metabox', true );
		$home              = (bool) \apply_filters( 'the_seo_framework_home_metabox', true );
		$post_type_archive = (bool) \apply_filters( 'the_seo_framework_post_type_archive_metabox', true );
```

### the_seo_framework_robots_metabox
**File:** `autodescription/inc/classes/admin/settings/plugin.class.php`

**Context:**

```php
$general           = (bool) \apply_filters( 'the_seo_framework_general_metabox', true );
		$title             = (bool) \apply_filters( 'the_seo_framework_title_metabox', true );
		$description       = (bool) \apply_filters( 'the_seo_framework_description_metabox', true );
		$robots            = (bool) \apply_filters( 'the_seo_framework_robots_metabox', true );
		$home              = (bool) \apply_filters( 'the_seo_framework_home_metabox', true );
		$post_type_archive = (bool) \apply_filters( 'the_seo_framework_post_type_archive_metabox', true );
		$social            = (bool) \apply_filters( 'the_seo_framework_social_metabox', true );
```

### the_seo_framework_home_metabox
**File:** `autodescription/inc/classes/admin/settings/plugin.class.php`

**Context:**

```php
$title             = (bool) \apply_filters( 'the_seo_framework_title_metabox', true );
		$description       = (bool) \apply_filters( 'the_seo_framework_description_metabox', true );
		$robots            = (bool) \apply_filters( 'the_seo_framework_robots_metabox', true );
		$home              = (bool) \apply_filters( 'the_seo_framework_home_metabox', true );
		$post_type_archive = (bool) \apply_filters( 'the_seo_framework_post_type_archive_metabox', true );
		$social            = (bool) \apply_filters( 'the_seo_framework_social_metabox', true );
		$schema            = (bool) \apply_filters( 'the_seo_framework_schema_metabox', true );
```

### the_seo_framework_post_type_archive_metabox
**File:** `autodescription/inc/classes/admin/settings/plugin.class.php`

**Context:**

```php
$description       = (bool) \apply_filters( 'the_seo_framework_description_metabox', true );
		$robots            = (bool) \apply_filters( 'the_seo_framework_robots_metabox', true );
		$home              = (bool) \apply_filters( 'the_seo_framework_home_metabox', true );
		$post_type_archive = (bool) \apply_filters( 'the_seo_framework_post_type_archive_metabox', true );
		$social            = (bool) \apply_filters( 'the_seo_framework_social_metabox', true );
		$schema            = (bool) \apply_filters( 'the_seo_framework_schema_metabox', true );
		$webmaster         = (bool) \apply_filters( 'the_seo_framework_webmaster_metabox', true );
```

### the_seo_framework_social_metabox
**File:** `autodescription/inc/classes/admin/settings/plugin.class.php`

**Context:**

```php
$robots            = (bool) \apply_filters( 'the_seo_framework_robots_metabox', true );
		$home              = (bool) \apply_filters( 'the_seo_framework_home_metabox', true );
		$post_type_archive = (bool) \apply_filters( 'the_seo_framework_post_type_archive_metabox', true );
		$social            = (bool) \apply_filters( 'the_seo_framework_social_metabox', true );
		$schema            = (bool) \apply_filters( 'the_seo_framework_schema_metabox', true );
		$webmaster         = (bool) \apply_filters( 'the_seo_framework_webmaster_metabox', true );
		$sitemap           = (bool) \apply_filters( 'the_seo_framework_sitemap_metabox', true );
```

### the_seo_framework_schema_metabox
**File:** `autodescription/inc/classes/admin/settings/plugin.class.php`

**Context:**

```php
$home              = (bool) \apply_filters( 'the_seo_framework_home_metabox', true );
		$post_type_archive = (bool) \apply_filters( 'the_seo_framework_post_type_archive_metabox', true );
		$social            = (bool) \apply_filters( 'the_seo_framework_social_metabox', true );
		$schema            = (bool) \apply_filters( 'the_seo_framework_schema_metabox', true );
		$webmaster         = (bool) \apply_filters( 'the_seo_framework_webmaster_metabox', true );
		$sitemap           = (bool) \apply_filters( 'the_seo_framework_sitemap_metabox', true );
		$feed              = (bool) \apply_filters( 'the_seo_framework_feed_metabox', true );
```

### the_seo_framework_webmaster_metabox
**File:** `autodescription/inc/classes/admin/settings/plugin.class.php`

**Context:**

```php
$post_type_archive = (bool) \apply_filters( 'the_seo_framework_post_type_archive_metabox', true );
		$social            = (bool) \apply_filters( 'the_seo_framework_social_metabox', true );
		$schema            = (bool) \apply_filters( 'the_seo_framework_schema_metabox', true );
		$webmaster         = (bool) \apply_filters( 'the_seo_framework_webmaster_metabox', true );
		$sitemap           = (bool) \apply_filters( 'the_seo_framework_sitemap_metabox', true );
		$feed              = (bool) \apply_filters( 'the_seo_framework_feed_metabox', true );
```

### the_seo_framework_sitemap_metabox
**File:** `autodescription/inc/classes/admin/settings/plugin.class.php`

**Context:**

```php
$social            = (bool) \apply_filters( 'the_seo_framework_social_metabox', true );
		$schema            = (bool) \apply_filters( 'the_seo_framework_schema_metabox', true );
		$webmaster         = (bool) \apply_filters( 'the_seo_framework_webmaster_metabox', true );
		$sitemap           = (bool) \apply_filters( 'the_seo_framework_sitemap_metabox', true );
		$feed              = (bool) \apply_filters( 'the_seo_framework_feed_metabox', true );

		$settings_page_hook = Admin\Menu::get_page_hook_name();
```

### the_seo_framework_feed_metabox
**File:** `autodescription/inc/classes/admin/settings/plugin.class.php`

**Context:**

```php
$schema            = (bool) \apply_filters( 'the_seo_framework_schema_metabox', true );
		$webmaster         = (bool) \apply_filters( 'the_seo_framework_webmaster_metabox', true );
		$sitemap           = (bool) \apply_filters( 'the_seo_framework_sitemap_metabox', true );
		$feed              = (bool) \apply_filters( 'the_seo_framework_feed_metabox', true );

		$settings_page_hook = Admin\Menu::get_page_hook_name();
```

### the_seo_framework_seobox_output
**File:** `autodescription/inc/classes/admin/settings/post.class.php`

**Context:**

```php
if (
			   ! Query::is_post_edit()
			|| ! Post_Type::is_supported( $post_type )
			|| ! \apply_filters( 'the_seo_framework_seobox_output', true )
		) return;

		$box_id = 'tsf-inpost-box';
```

### the_seo_framework_metabox_context
**File:** `autodescription/inc/classes/admin/settings/post.class.php`

**Context:**

```php
\esc_html__( 'SEO Settings', 'autodescription' ),
			[ static::class, 'meta_box' ],
			null, // We used to forward hook $post_type, which redundantly forces WP to regenerate the current screen type.
			/**
			 * @since 2.9.0
			 * @param string $context Accepts 'normal', 'side', and 'advanced'.
			 */
			(string) \apply_filters( 'the_seo_framework_metabox_context', 'normal' ),
			/**
			 * @since 2.6.0
			 * @param string $default Accepts 'high', 'default', 'low'
			 *                        Defaults to high, this box is seen right below the post/page edit screen.
			 */
			(string) \apply_filters( 'the_seo_framework_metabox_priority', 'high' )
		);

		$screen_id = \get_current_screen()->id;
```

### the_seo_framework_metabox_priority
**File:** `autodescription/inc/classes/admin/settings/post.class.php`

**Context:**

```php
* @param string $context Accepts 'normal', 'side', and 'advanced'.
			 */
			(string) \apply_filters( 'the_seo_framework_metabox_context', 'normal' ),
			/**
			 * @since 2.6.0
			 * @param string $default Accepts 'high', 'default', 'low'
			 *                        Defaults to high, this box is seen right below the post/page edit screen.
			 */
			(string) \apply_filters( 'the_seo_framework_metabox_priority', 'high' )
		);

		$screen_id = \get_current_screen()->id;
```

### the_seo_framework_term_metabox_priority
**File:** `autodescription/inc/classes/admin/settings/term.class.php`

**Context:**

```php
\add_action(
			"{$taxonomy}_edit_form",
			[ static::class, 'output_setting_fields' ],
			/**
			 * @since 2.6.0
			 * @param int $priority The meta box term priority.
			 *                      Defaults to a high priority, this box is seen soon below the default edit inputs.
			 */
			(int) \apply_filters( 'the_seo_framework_term_metabox_priority', 0 ),
			2,
		);
	}

	/**
```

### the_seo_framework_blog_name
**File:** `autodescription/inc/classes/data/blog.class.php`

**Context:**

```php
* @return string $blogname The sanitized blogname.
	 */
	public static function get_filtered_blog_name() {
		/**
		 * @since 4.2.0
		 * @param string The blog name.
		 */
		return (string) \apply_filters(
			'the_seo_framework_blog_name',
			trim( \get_bloginfo( 'name', 'display' ) )
		);
	}

	/**
```

### the_seo_framework_settings_update_sanitizers
**File:** `autodescription/inc/classes/data/filter/plugin.class.php`

**Context:**

```php
Data\Plugin::get_options(),
		);

		/**
		 * @since 5.0.0
		 * @param array $filters {
		 *     A map of option filters and their callbacks.
		 *
		 *     @type callable[] {$option} The callback to sanitize the option indexed by option name.
		 * }
		 */
		$sanitizers = \apply_filters(
			'the_seo_framework_settings_update_sanitizers',
			static::$sanitizers,
		);

		$store = [];
```

### the_seo_framework_get_options
**File:** `autodescription/inc/classes/data/plugin.class.php`

**Context:**

```php
$is_headless = is_headless( 'settings' );

		/**
		 * @since 2.0.0
		 * @since 4.1.4 1. Now considers headlessness.
		 *              2. Now returns a 3rd parameter: boolean $headless.
		 *
		 * @param array  $settings The settings
		 * @param string $setting  The settings name.
		 * @param bool   $headless Whether the options are headless.
		 */
		return static::$options_memo = \apply_filters(
			'the_seo_framework_get_options',
			$is_headless
				? Plugin\Setup::get_default_options()
				: (
					// May be empty during setup, let's return the defaults.
					\get_option( \THE_SEO_FRAMEWORK_SITE_OPTIONS ) ?: Plugin\Setup::get_default_options()
				),
			\THE_SEO_FRAMEWORK_SITE_OPTIONS,
			$is_headless,
		);
	}

	/**
```

### the_seo_framework_post_meta
**File:** `autodescription/inc/classes/data/plugin/post.class.php`

**Context:**

```php
$value = $value[0];
		}

		/**
		 * @since 4.0.5
		 * @since 4.1.4 1. Now considers headlessness.
		 *              2. Now returns a 3rd parameter: boolean $headless.
		 * @note Do not delete/unset/add indexes! It'll cause errors.
		 * @param array $meta    The current post meta.
		 * @param int   $post_id The post ID.
		 * @param bool  $headless Whether the meta are headless.
		 */
		return static::$meta_memo[ $post_id ] = \apply_filters(
			'the_seo_framework_post_meta',
			array_merge( $defaults, $meta ),
			$post_id,
			$is_headless,
		);
	}

	/**
```

### the_seo_framework_post_meta_defaults
**File:** `autodescription/inc/classes/data/plugin/post.class.php`

**Context:**

```php
* @return array The default post meta.
	 */
	public static function get_default_meta( $post_id = 0 ) {
		/**
		 * @since 4.1.4
		 * @since 4.2.0 1. Now corrects the $post_id when none is supplied.
		 *              2. No longer returns the third parameter.
		 * @param array    $defaults
		 * @param integer  $post_id Post ID.
		 * @param \WP_Post $post    Post object.
		 */
		return (array) \apply_filters(
			'the_seo_framework_post_meta_defaults',
			[
				'_genesis_title'          => '',
				'_tsf_title_no_blogname'  => 0, // The prefix I should've used from the start...
				'_genesis_description'    => '',
				'_genesis_canonical_uri'  => '',
				'redirect'                => '', //! Will be displayed in custom fields when set...
				'_social_image_url'       => '',
				'_social_image_id'        => 0,
				'_genesis_noindex'        => 0,
				'_genesis_nofollow'       => 0,
				'_genesis_noarchive'      => 0,
				'exclude_local_search'    => 0, //! Will be displayed in custom fields when set...
				'exclude_from_archive'    => 0, //! Will be displayed in custom fields when set...
				'_open_graph_title'       => '',
				'_open_graph_description' => '',
				'_twitter_title'          => '',
				'_twitter_description'    => '',
				'_tsf_twitter_card_type'  => '',
			],
			$post_id ?: Query::get_the_real_id(),
		);
	}

	/**
```

### the_seo_framework_save_post_meta
**File:** `autodescription/inc/classes/data/plugin/post.class.php`

**Context:**

```php
if ( empty( $post_id ) ) return;

		/**
		 * @NOTE Do not remove indexes. In the future, we'll store all data,
		 *       even if empty, to ensure defaults don't override them.
		 *       So, set an empty value if you wish to delete them.
		 * @see https://github.com/sybrew/the-seo-framework/issues/185
		 * @since 4.0.0
		 * @since 5.0.0 1. The second parameter is now an integer, instead of Post object.
		 *              2. No longer sends pre-sanitized data to the filter.
		 * @param array $data The data that's going to be saved.
		 * @param int   $post The post object.
		 */
		$data = (array) \apply_filters(
			'the_seo_framework_save_post_meta',
			array_merge(
				static::get_default_meta( $post_id ),
				$data,
			),
			$post_id,
		);

		unset( static::$meta_memo[ $post_id ] );
```

### the_seo_framework_primary_term
**File:** `autodescription/inc/classes/data/plugin/post.class.php`

**Context:**

```php
}
		}

		/**
		 * @since 5.0.0
		 * @param ?\WP_Term $primary_term The primary term. Null if cannot be generated.
		 * @param int       $post_id     The post ID.
		 * @param string    $taxonomy    The taxonomy name.
		 * @param bool      $is_headless Whether the meta are headless.
		 */
		static::$pt_memo[ $post_id ][ $taxonomy ] = \apply_filters(
			'the_seo_framework_primary_term',
			$primary_term,
			$post_id,
			$taxonomy,
			$is_headless,
		) ?: false;

		return static::$pt_memo[ $post_id ][ $taxonomy ] ?: null;
	}
```

### the_seo_framework_post_type_archive_meta
**File:** `autodescription/inc/classes/data/plugin/pta.class.php`

**Context:**

```php
$meta = Data\Plugin::get_option( 'pta', $post_type ) ?: [];
		}

		/**
		 * @since 4.2.0
		 * @note Do not delete/unset/add indexes! It'll cause errors.
		 * @param array $meta      The current post type archive meta.
		 * @param int   $post_type The post type.
		 * @param bool  $headless  Whether the meta are headless.
		 */
		return static::$meta_memo[ $post_type ] = \apply_filters(
			'the_seo_framework_post_type_archive_meta',
			array_merge(
				static::get_default_meta( $post_type ),
				$meta,
			),
			$post_type,
			$is_headless,
		);
	}

	/**
```

### the_seo_framework_get_post_type_archive_meta_defaults
**File:** `autodescription/inc/classes/data/plugin/pta.class.php`

**Context:**

```php
* @return array The Post Type Archive Metadata default options.
	 */
	public static function get_default_meta( $post_type = '' ) {
		/**
		 * @since 4.2.0
		 * @param array $defaults
		 * @param int   $term_id The current term ID.
		 */
		return (array) \apply_filters(
			'the_seo_framework_get_post_type_archive_meta_defaults',
			[
				'doctitle'           => '',
				'title_no_blog_name' => 0,
				'description'        => '',
				'og_title'           => '',
				'og_description'     => '',
				'tw_title'           => '',
				'tw_description'     => '',
				'tw_card_type'       => '',
				'social_image_url'   => '',
				'social_image_id'    => 0,
				'canonical'          => '',
				'noindex'            => 0,
				'nofollow'           => 0,
				'noarchive'          => 0,
				'redirect'           => '',
			],
			$post_type ?: Query::get_current_post_type(),
		);
	}
}
```

### the_seo_framework_default_site_options
**File:** `autodescription/inc/classes/data/plugin/setup.class.php`

**Context:**

```php
$titleloc = \is_rtl() ? 'left' : 'right';

		// phpcs:disable, WordPress.Arrays.MultipleStatementAlignment -- precision alignment OK.
		/**
		 * @since 2.2.7
		 * @param array $options The default site options.
		 */
		return static::$default_options = (array) \apply_filters(
			'the_seo_framework_default_site_options',
			[
				// General. Performance.
				'alter_search_query'  => 1, // Search query adjustments.
				'alter_archive_query' => 1, // Archive query adjustments.

				'alter_archive_query_type' => 'in_query', // Archive query type.
				'alter_search_query_type'  => 'in_query', // Search query type.

				// General. Layout.
				'display_seo_bar_tables'  => 1, // SEO Bar post-list tables.
				'display_seo_bar_metabox' => 0, // SEO Bar post SEO Settings.
				'seo_bar_low_contrast'    => 0, // SEO Bar contrast display settings.
				'seo_bar_symbols'         => 0, // SEO Bar symbol display settings.

				'display_pixel_counter'     => 1, // Pixel counter.
				'display_character_counter' => 1, // Character counter.

				// General. Canonical.
				'canonical_scheme' => 'automatic', // Canonical URL scheme.

				// General. Timestamps.
				'timestamps_format' => 1, // Timestamp format, numeric string.

				// General. Exclusions.
				'disabled_post_types' => [], // Post Type support.
				'disabled_taxonomies' => [], // Taxonomy support.

				// Title.
				'site_title'          => '',        // Blog name.
				'title_separator'     => 'hyphen',  // Title separator, radio selection.
				'title_location'      => $titleloc, // Title separation location.
				'title_rem_additions' => 0,         // Remove title additions.
				'title_rem_prefixes'  => 0,         // Remove title prefixes from archives.
				'title_strip_tags'    => 1,         // Apply 'strip tags' on titles.

				// Description.
				'auto_description'             => 1, // Enables auto description.
				'auto_description_html_method' => 'fast', // Auto description HTML passes.

				// Robots index.
				'author_noindex' => 0, // Author Archive robots noindex.
				'date_noindex'   => 1, // Date Archive robots noindex.
				'search_noindex' => 1, // Search Page robots noindex.
				'site_noindex'   => 0, // Site Page robots noindex.
				Helper::get_robots_option_index( 'post_type', 'noindex' ) => [
					'attachment' => 1,
				], // Post Type support.
				Helper::get_robots_option_index( 'taxonomy', 'noindex' ) => [
					'post_format' => 1,
				], // Taxonomy support.

				// Robots follow.
				'author_nofollow' => 0, // Author Archive robots nofollow.
				'date_nofollow'   => 0, // Date Archive robots nofollow.
				'search_nofollow' => 0, // Search Page robots nofollow.
				'site_nofollow'   => 0, // Site Page robots nofollow.
				Helper::get_robots_option_index( 'post_type', 'nofollow' ) => [], // Post Type support.
				Helper::get_robots_option_index( 'taxonomy', 'nofollow' ) => [], // Taxonomy support.

				// Robots archive.
				'author_noarchive' => 0, // Author Archive robots noarchive.
				'date_noarchive'   => 0, // Date Archive robots noarchive.
				'search_noarchive' => 0, // Search Page robots noarchive.
				'site_noarchive'   => 0, // Site Page robots noarchive.
				Helper::get_robots_option_index( 'post_type', 'noarchive' ) => [], // Post Type support.
				Helper::get_robots_option_index( 'taxonomy', 'noarchive' ) => [], // Taxonomy support.

				// Robots query protection.
				'advanced_query_protection' => 1,

				// Robots pagination index.
				'paged_noindex'      => 0, // Every second or later page noindex.
				'home_paged_noindex' => 0, // Every second or later homepage noindex.

				// Robots copyright.
				'set_copyright_directives' => 1,       // Allow copyright directive settings.
				'max_snippet_length'       => -1,      // Max text-snippet length. -1 = unlimited, 0 = disabled, R>0 = characters.
				'max_image_preview'        => 'large', // Max image-preview size. 'none', 'standard', 'large'.
				'max_video_preview'        => -1,      // Max video-preview size. -1 = unlimited, 0 = disabled, R>0 = seconds.

				// Robots.txt blocks.
				'robotstxt_block_ai'  => 0, // Blocks large learning models from training on the site content.
				'robotstxt_block_seo' => 0, // Block SEO crawlers like Ahrefs, Moz, and SEMRush.

				// Homepage visibility.
				'homepage_noindex'   => 0, // Homepage robots noindex.
				'homepage_nofollow'  => 0, // Homepage robots noarchive.
				'homepage_noarchive' => 0, // Homepage robots nofollow.

				'homepage_canonical' => '', // Homepage canonical URL.
				'homepage_redirect'  => '', // Homepage redirect URL.

				// Homepage meta.
				'homepage_title'         => '', // Homepage Title string.
				'homepage_tagline'       => 1,  // Homepage add blog Tagline.
				'homepage_description'   => '', // Homepage Description string.
				'homepage_title_tagline' => '', // Homepage Tagline string.
				'home_title_location'    => $titleloc, // Title separation location.

				// Homepage Social.
				'homepage_og_title'            => '',
				'homepage_og_description'      => '',
				'homepage_twitter_card_type'   => '',
				'homepage_twitter_title'       => '',
				'homepage_twitter_description' => '',

				'homepage_social_image_url' => '',
				'homepage_social_image_id'  => 0,

				// Post Type Archives. Prefill all of it for easy filtering, even though it's dynamically populated.
				'pta' => Data\Plugin\PTA::get_all_default_meta(),

				// Relationships.
				'shortlink_tag'       => 0, // Adds shortlink tag.
				'prev_next_posts'     => 1, // Adds next/prev tags.
				'prev_next_archives'  => 1, // Adds next/prev tags.
				'prev_next_frontpage' => 1, // Adds next/prev tags.

				// Facebook.
				'facebook_publisher' => '', // Facebook Business URL.
				'facebook_author'    => '', // Facebook User URL.

				// Dates.
				'post_publish_time' => 1, // Article Published Time.
				'post_modify_time'  => 1, // Article Modified Time.

				// Twitter.
				'twitter_card'    => 'summary_large_image', // Twitter Card layout. If no twitter:image image is found, it'll change to 'summary', radio
				'twitter_site'    => '', // Twitter business @username.
				'twitter_creator' => '', // Twitter user @username.

				// oEmbed.
				'oembed_use_og_title'     => 0, // Use custom meta titles in oEmbeds.
				'oembed_use_social_image' => 1, // Use social images in oEmbeds.
				'oembed_remove_author'    => 1, // Remove author from oEmbeds.

				// Social on/off.
				'og_tags'        => 1, // Output of Open Graph meta tags.
				'facebook_tags'  => 1, // Output the Facebook meta tags.
				'twitter_tags'   => 1, // Output the Twitter meta tags.
				'oembed_scripts' => 1, // Enable WordPress's oEmbed scripts.

				// Social title settings.
				'social_title_rem_additions' => 1, // Remove social title additions.

				// Social image settings.
				'multi_og_image' => 0, // Allow multiple images to be generated.

				// Theme color settings.
				'theme_color' => '', // Theme color metatag, default none.

				// Social FallBack images (fb = fallback)
				'social_image_fb_url' => '', // Fallback image URL.
				'social_image_fb_id'  => 0,  // Fallback image ID.

				// Webmasters.
				'google_verification' => '', // Google Verification Code.
				'bing_verification'   => '', // Bing Verification Code.
				'yandex_verification' => '', // Yandex Verification Code.
				'baidu_verification'  => '', // Baidu Verification Code.
				'pint_verification'   => '', // Pinterest Verification Code.

				// Schema.org.
				'ld_json_enabled'        => 1, // LD+Json toggle for Schema.
				'ld_json_searchbox'      => 1, // LD+Json Sitelinks Search Box.
				'ld_json_breadcrumbs'    => 1, // LD+Json Breadcrumbs.
				'knowledge_output'       => 1, // Default for outputting the Knowledge SEO.

				// Knowledge general <https://developers.google.com/structured-data/customize/contact-points> - This is extremely extended and valuable. Expect a premium version.
				'knowledge_type'   => 'organization', // Organization or Person, dropdown.

				// Knowledge business <https://developers.google.com/structured-data/customize/logos>.
				'knowledge_logo' => 1,  // Use Knowledge Logo from anywhere.
				'knowledge_name' => '', // Person or Organization name.

				// Knowledge Logo image.
				'knowledge_logo_url'   => '',
				'knowledge_logo_id'    => 0,

				// Knowledge sameas locations. TODO: Make this dynamic.
				'knowledge_facebook'   => '', // Facebook Account.
				'knowledge_twitter'    => '', // Twitter Account.
				'knowledge_instagram'  => '', // Instagram Account.
				'knowledge_youtube'    => '', // Youtube Account.
				'knowledge_linkedin'   => '', // Linkedin Account.
				'knowledge_pinterest'  => '', // Pinterest Account.
				'knowledge_soundcloud' => '', // SoundCloud Account.
				'knowledge_tumblr'     => '', // Tumblr Account.

				// Sitemaps.
				'sitemaps_output'         => 1,    // Output of sitemap.
				'sitemap_query_limit'     => 250, // Sitemap post limit.
				'cache_sitemap'           => 1, // Sitemap transient cache.
				'sitemap_cron_prerender'  => 0, // Sitemap cron-ping prerender.

				'sitemaps_modified' => 1, // Add sitemap modified time.

				'sitemaps_robots' => 1, // Add sitemap location to robots.txt.

				'sitemap_styles'       => 1,        // Whether to style the sitemap.
				'sitemap_logo'         => 1,        // Whether to add logo to sitemap.
				'sitemap_logo_url'     => '',       // Sitemap logo URL.
				'sitemap_logo_id'      => 0,        // Sitemap logo ID.
				'sitemap_color_main'   => '222222', // Sitemap main color.
				'sitemap_color_accent' => '00a0d2', // Sitemap accent color.

				// Feed.
				'excerpt_the_feed' => 1, // Generate feed Excerpts.
				'source_the_feed'  => 1, // Add backlink to the end of the feed.
				'index_the_feed'   => 0, // Add backlink to the end of the feed.
			],
		);
		// phpcs:enable, WordPress.Arrays.MultipleStatementAlignment
	}
```

### the_seo_framework_warned_site_options
**File:** `autodescription/inc/classes/data/plugin/setup.class.php`

**Context:**

```php
static::register_automated_refresh( 'warned_options' );

		/**
		 * Warned site settings. Only accepts checkbox options.
		 * When listed as 1, it's a feature which can destroy your website's SEO value when checked.
		 *
		 * Unchecking a box is simply "I'm not active." - Removing features generally do not negatively impact SEO value.
		 * Since it's all about the content.
		 *
		 * Only used within the SEO Settings page.
		 *
		 * @since 2.3.4
		 * @param array $options The warned site options.
		 */
		return static::$warned_options = (array) \apply_filters(
			'the_seo_framework_warned_site_options',
			[
				'title_rem_additions' => 1, // Title remove additions.
				'site_noindex'        => 1, // Site Page robots noindex.
				'site_nofollow'       => 1, // Site Page robots nofollow.
				'homepage_noindex'    => 1, // Homepage robots noindex.
				'homepage_nofollow'   => 1, // Homepage robots noarchive.
				Helper::get_robots_option_index( 'post_type', 'noindex' ) => [
					'post' => 1,
					'page' => 1,
				],
				Helper::get_robots_option_index( 'post_type', 'nofollow' ) => [
					'post' => 1,
					'page' => 1,
				],
			],
		);
	}

	/**
```

### the_seo_framework_term_meta
**File:** `autodescription/inc/classes/data/plugin/term.class.php`

**Context:**

```php
$meta = \get_term_meta( $term_id, \THE_SEO_FRAMEWORK_TERM_OPTIONS, true ) ?: [];
		}

		/**
		 * @since 4.0.5
		 * @since 4.1.4 1. Now considers headlessness.
		 *              2. Now returns a 3rd parameter: boolean $headless.
		 * @note Do not delete/unset/add indexes! It'll cause errors.
		 * @param array $meta        The current term meta.
		 * @param int   $term_id     The term ID.
		 * @param bool  $is_headless Whether the meta are headless.
		 */
		return static::$meta_memo[ $term_id ] = \apply_filters(
			'the_seo_framework_term_meta',
			array_merge(
				static::get_default_meta( $term_id ),
				$meta,
			),
			$term_id,
			$is_headless,
		);
	}

	/**
```

### the_seo_framework_term_meta_defaults
**File:** `autodescription/inc/classes/data/plugin/term.class.php`

**Context:**

```php
* @return array The Term Metadata default options.
	 */
	public static function get_default_meta( $term_id = 0 ) {
		/**
		 * @since 2.1.8
		 * @param array $defaults
		 * @param int   $term_id The current term ID.
		 */
		return (array) \apply_filters(
			'the_seo_framework_term_meta_defaults',
			[
				'doctitle'           => '',
				'title_no_blog_name' => 0,
				'description'        => '',
				'og_title'           => '',
				'og_description'     => '',
				'tw_title'           => '',
				'tw_description'     => '',
				'tw_card_type'       => '',
				'social_image_url'   => '',
				'social_image_id'    => 0,
				'canonical'          => '',
				'noindex'            => 0,
				'nofollow'           => 0,
				'noarchive'          => 0,
				'redirect'           => '',
			],
			$term_id ?: Query::get_the_real_id(),
		);
	}

	/**
```

### the_seo_framework_save_term_data
**File:** `autodescription/inc/classes/data/plugin/term.class.php`

**Context:**

```php
if ( empty( $term_id ) ) return;

		/**
		 * @NOTE Do not remove indexes. We store all data, even if empty,
		 *       to ensure defaults don't override them.
		 * @since 3.1.0
		 * @since 5.0.0 1. Removed 3rd and 4th parameters (`$tt_id` and `$taxonomy`).
		 *              2. No longer sends pre-sanitized data to the filter.
		 * @param array  $data     The data that's going to be saved.
		 * @param int    $term_id  The term ID.
		 */
		$data = (array) \apply_filters(
			'the_seo_framework_save_term_data',
			array_merge(
				static::get_default_meta( $term_id ),
				$data,
			),
			$term_id,
		);

		unset( static::$meta_memo[ $term_id ] );
```

### the_seo_framework_user_meta
**File:** `autodescription/inc/classes/data/plugin/user.class.php`

**Context:**

```php
$meta = (array) ( \get_user_meta( $user_id, \THE_SEO_FRAMEWORK_USER_OPTIONS, true ) ?: [] );
		}

		/**
		 * @since 4.1.4
		 * @param array $meta        The current user meta.
		 *                           If headless, it may still contain administration settings.
		 * @param int   $user_id     The user ID.
		 * @param bool  $is_headless Whether the meta are headless.
		 */
		return static::$meta_memo[ $user_id ] = \apply_filters(
			'the_seo_framework_user_meta',
			array_merge(
				static::get_default_meta( $user_id ),
				$meta,
			),
			$user_id,
			$is_headless['user'],
		);
	}

	/**
```

### the_seo_framework_user_meta_defaults
**File:** `autodescription/inc/classes/data/plugin/user.class.php`

**Context:**

```php
* @return array The user meta defaults.
	 */
	public static function get_default_meta( $user_id = 0 ) {
		/**
		 * @since 4.1.4
		 * @param array $defaults
		 * @param int   $user_id
		 */
		return (array) \apply_filters(
			'the_seo_framework_user_meta_defaults',
			[
				'counter_type'  => 3,
				'facebook_page' => '',
				'twitter_page'  => '',
			],
			$user_id ?: Query::get_current_user_id(),
		);
	}

	/**
```

### the_seo_framework_save_user_data
**File:** `autodescription/inc/classes/data/plugin/user.class.php`

**Context:**

```php
if ( empty( $user_id ) ) return;

		/**
		 * @since 4.1.4
		 * @since 5.0.0 No longer sends pre-sanitized data to the filter.
		 * @param array  $data     The data that's going to be saved.
		 * @param int    $user_id  The user ID.
		 */
		$data = (array) \apply_filters(
			'the_seo_framework_save_user_data',
			array_merge(
				static::get_default_meta( $user_id ),
				$data,
			),
			$user->ID,
		);

		unset( static::$meta_memo[ $user_id ] );
```

### the_seo_framework_detect_non_html_page_builder
**File:** `autodescription/inc/classes/data/post.class.php`

**Context:**

```php
$post_id = $post_id ?: Query::get_the_real_id();
		$meta    = \get_post_meta( $post_id );

		/**
		 * @since 4.1.0
		 * @param boolean|null $detected Whether a builder should be detected.
		 * @param int          $post_id The current Post ID.
		 * @param array        $meta The current post meta.
		 */
		$detected = \apply_filters( 'the_seo_framework_detect_non_html_page_builder', null, $post_id, $meta );

		if ( \is_bool( $detected ) )
			return $detected;
```

### the_seo_framework_max_content_feed_length
**File:** `autodescription/inc/classes/front/feed.class.php`

**Context:**

```php
* $feed_type is only set on 'the_content_feed' filter.
		 */
		if ( isset( $feed_type ) && Data\Plugin::get_option( 'excerpt_the_feed' ) ) {
			/**
			 * @since 2.5.2
			 * @param int $clamp_length The maximum feed (multibyte) string length.
			 */
			$clamp_length = (int) \apply_filters( 'the_seo_framework_max_content_feed_length', 400 );

			// Strip all code and lines, and AI-trim it.
			$excerpt = Format\HTML::extract_content(
```

### the_seo_framework_feed_source_link_text
**File:** `autodescription/inc/classes/front/feed.class.php`

**Context:**

```php
"\n" . '<p><a href="%s" rel="nofollow">%s</a></p>', // Keep XHTML valid!
				\esc_url( \get_permalink() ),
				\esc_html(
					/**
					 * @since 2.6.0
					 * @since 2.7.2 or 2.7.3: Escaped output.
					 * @param string $source The source indication string.
					 */
					\apply_filters(
						'the_seo_framework_feed_source_link_text',
						\_x( 'Source', 'The content source', 'autodescription' )
					)
				)
			);
		}

		return $content;
```

### the_seo_framework_meta_generator_pools
**File:** `autodescription/inc/classes/front/meta/head.class.php`

**Context:**

```php
$remove_pools[] = 'Twitter';
		}

		/**
		 * @since 5.0.0
		 * @param string[] $generator_pools A list of tag pools requested for the current query.
		 *                                  The tag pool names correspond directly to the classes'.
		 *                                  Do not register new pools, it'll cause a fatal error.
		 */
		$generator_pools = \apply_filters(
			'the_seo_framework_meta_generator_pools',
			isset( $remove_pools ) ? array_diff( $generator_pools, $remove_pools ) : $generator_pools,
		);

		$tag_generators   = &Tags::tag_generators();
		$generators_queue = [];
```

### the_seo_framework_meta_generators
**File:** `autodescription/inc/classes/front/meta/head.class.php`

**Context:**

```php
foreach ( $generator_pools as $pool )
			$generators_queue[] = ( "\The_SEO_Framework\Front\Meta\Generator\\$pool" )::GENERATORS;

		/**
		 * @since 5.0.0
		 * @param callable[] $tag_generators  A list of meta tag generator callbacks.
		 *                                    The generators may offload work to other generators.
		 * @param string[]   $generator_pools A list of tag pools requested for the current query.
		 *                                    The tag pool names correspond directly to the classes'.
		 */
		$tag_generators = \apply_filters(
			'the_seo_framework_meta_generators',
			array_merge( ...$generators_queue ),
			$generator_pools,
		);

		Tags::fill_render_data_from_registered_generators();
```

### the_seo_framework_indicator
**File:** `autodescription/inc/classes/front/meta/head.class.php`

**Context:**

```php
private static function print_plugin_indicator( $where = 'before', $meta_timer = 0, $bootstrap_timer = 0 ) {

		$cache = memo() ?? memo( [
			/**
			 * @since 2.0.0
			 * @param bool $run Whether to run and show the plugin indicator.
			 */
			'run'        => (bool) \apply_filters( 'the_seo_framework_indicator', true ),
			/**
			 * @since 2.4.0
			 * @param bool $show_timer Whether to show the generation time in the indicator.
			 */
			'show_timer' => (bool) \apply_filters( 'the_seo_framework_indicator_timing', true ),
			'annotation' => \esc_html( trim( vsprintf(
				/* translators: 1 = The SEO Framework, 2 = 'by Sybre Waaijer */
				\__( '%1$s %2$s', 'autodescription' ),
				[
					'The SEO Framework',
					/**
					 * @since 2.4.0
					 * @param bool $sybre Whether to show the author name in the indicator.
					 */
					\apply_filters( 'sybre_waaijer_<3', true ) // phpcs:ignore, WordPress.NamingConventions.ValidHookName -- Easter egg.
						? \__( 'by Sybre Waaijer', 'autodescription' )
						: '',
				]
			) ) ),
		] );

		if ( ! $cache['run'] ) return '';
```

### the_seo_framework_indicator_timing
**File:** `autodescription/inc/classes/front/meta/head.class.php`

**Context:**

```php
* @param bool $run Whether to run and show the plugin indicator.
			 */
			'run'        => (bool) \apply_filters( 'the_seo_framework_indicator', true ),
			/**
			 * @since 2.4.0
			 * @param bool $show_timer Whether to show the generation time in the indicator.
			 */
			'show_timer' => (bool) \apply_filters( 'the_seo_framework_indicator_timing', true ),
			'annotation' => \esc_html( trim( vsprintf(
				/* translators: 1 = The SEO Framework, 2 = 'by Sybre Waaijer */
				\__( '%1$s %2$s', 'autodescription' ),
				[
					'The SEO Framework',
					/**
					 * @since 2.4.0
					 * @param bool $sybre Whether to show the author name in the indicator.
					 */
					\apply_filters( 'sybre_waaijer_<3', true ) // phpcs:ignore, WordPress.NamingConventions.ValidHookName -- Easter egg.
						? \__( 'by Sybre Waaijer', 'autodescription' )
						: '',
				]
			) ) ),
		] );

		if ( ! $cache['run'] ) return '';
```

### sybre_waaijer_<3
**File:** `autodescription/inc/classes/front/meta/head.class.php`

**Context:**

```php
\__( '%1$s %2$s', 'autodescription' ),
				[
					'The SEO Framework',
					/**
					 * @since 2.4.0
					 * @param bool $sybre Whether to show the author name in the indicator.
					 */
					\apply_filters( 'sybre_waaijer_<3', true ) // phpcs:ignore, WordPress.NamingConventions.ValidHookName -- Easter egg.
						? \__( 'by Sybre Waaijer', 'autodescription' )
						: '',
				]
			) ) ),
		] );

		if ( ! $cache['run'] ) return '';
```

### the_seo_framework_do_adjust_archive_query
**File:** `autodescription/inc/classes/front/query.class.php`

**Context:**

```php
$has_filter ??= \has_filter( 'the_seo_framework_do_adjust_archive_query' );

		/**
		 * This filter affects both 'search-"archives"' and terms/taxonomies.
		 *
		 * @since 2.9.4
		 * @param bool      $do       True is unblocked (do adjustment), false is blocked (don't do adjustment).
		 * @param \WP_Query $wp_query The current query.
		 */
		if ( $has_filter && ! \apply_filters( 'the_seo_framework_do_adjust_archive_query', true, $wp_query ) )
			return true;

		if ( ! \did_action( 'wp_loaded' ) )
			return true;
```

### the_seo_framework_redirect_status_code
**File:** `autodescription/inc/classes/front/redirect.class.php`

**Context:**

```php
exit;
		}

		/**
		 * @since 2.8.0
		 * @param int <unsigned> $redirect_type
		 */
		$redirect_type = \absint( \apply_filters( 'the_seo_framework_redirect_status_code', 301 ) );

		if ( $redirect_type > 399 || $redirect_type < 300 )
			\tsf()->_doing_it_wrong( __METHOD__, 'You should use 3xx HTTP Status Codes. Recommended 301 and 302.', '2.8.0' );
```

### the_seo_framework_overwrite_titles
**File:** `autodescription/inc/classes/front/title.class.php`

**Context:**

```php
if (
			   ! Query\Utils::query_supports_seo()
			/**
			 * @since 2.9.3
			 * @param bool $overwrite_titles Whether to enable title overwriting.
			 */
			|| ! \apply_filters( 'the_seo_framework_overwrite_titles', true )
		) return;

		// Removes all pre_get_document_title filters.
		\remove_all_filters( 'pre_get_document_title', false );
```

### the_seo_framework_pre_get_document_title
**File:** `autodescription/inc/classes/front/title.class.php`

**Context:**

```php
* @return string The document title
	 */
	public static function set_document_title() {
		/**
		 * @since 3.1.0
		 * @param string $title The generated title.
		 * @param int    $id    The page or term ID.
		 */
		return \esc_html( \apply_filters(
			'the_seo_framework_pre_get_document_title',
			Meta\Title::get_title(),
			Query::get_the_real_id(),
		) );
	}
}
```

### the_seo_framework_conflicting_plugins
**File:** `autodescription/inc/classes/helper/compatibility.class.php`

**Context:**

```php
],
		];

		/**
		 * @since 2.6.0
		 * @since 5.0.0 Added indexes 'multilingual' and 'schema'.
		 * @param array[] $conflicting_plugins {
		 *     The conflicting plugins types. You should not unset any keys.
		 *
		 *     @type string[] $seo_tools    The conflicting SEO plugins base files, indexed by plugin name.
		 *     @type string[] $sitemaps     The conflicting sitemap plugins base files, indexed by plugin name.
		 *     @type string[] $open_graph   The conflicting Open Graph plugins base files, indexed by plugin name.
		 *     @type string[] $twitter_card The conflicting Twitter Card plugins base files, indexed by plugin name.
		 *     @type string[] $schema       The conflicting Schema plugins base files, indexed by plugin name.
		 *     @type string[] $multilingual The conflicting multilingual plugins base files, indexed by plugin name.
		 * }
		 */
		$conflicting_plugins = (array) \apply_filters(
			'the_seo_framework_conflicting_plugins',
			$conflicting_plugins,
		);

		if ( \has_filter( 'the_seo_framework_conflicting_plugins_type' ) ) {
			foreach ( $conflicting_plugins as $type => &$plugins ) {
```

### the_seo_framework_shortcode_based_page_builder_active
**File:** `autodescription/inc/classes/helper/compatibility.class.php`

**Context:**

```php
*/
	public static function is_non_html_builder_active() {
		return memo() ?? memo(
			/**
			 * @since 4.1.0
			 * @param bool $detected Whether an active page builder that renders content dynamically is detected.
			 * @NOTE not to be confused with `the_seo_framework_detect_non_html_page_builder`, which tests
			 *       the page builder status for each post individually.
			 */
			(bool) \apply_filters(
				'the_seo_framework_shortcode_based_page_builder_active',
				\defined( 'ET_BUILDER_VERSION' )
				|| \defined( 'WPB_VC_VERSION' )
				|| \defined( 'BRICKS_VERSION' ),
			)
		);
	}
}
```

### the_seo_framework_timestamp_format
**File:** `autodescription/inc/classes/helper/format/time.class.php`

**Context:**

```php
* @return string The timestamp format used in PHP date.
	 */
	public static function get_format( $get_time ) {
		/**
		 * @see For valid formats https://www.w3.org/TR/NOTE-datetime.
		 * @since 4.1.4
		 * @param string The full timestamp format. Must be XML safe and in ISO 8601 datetime notation.
		 * @param bool   True if time is requested, false if only date.
		 */
		return (string) \apply_filters(
			'the_seo_framework_timestamp_format',
			$get_time ? 'Y-m-d\TH:i:sP' : 'Y-m-d', // Could use 'c', but that specification is ambiguous
			$get_time,
		);
	}
}
```

### the_seo_framework_input_guidelines
**File:** `autodescription/inc/classes/helper/guidelines.class.php`

**Context:**

```php
* @param string                     $locale The current locale.
		 */
		return memo(
			(array) \apply_filters(
				'the_seo_framework_input_guidelines',
				[
					'title' => [
						'search' => [
							'chars'  => [
								'lower'     => (int) ( 25 * $c_adjust ),
								'goodLower' => (int) ( 35 * $c_adjust ),
								'goodUpper' => (int) ( 65 * $c_adjust ),
								'upper'     => (int) ( 75 * $c_adjust ),
							],
							'pixels' => [
								'lower'     => (int) ( 200 * $p_adjust ),
								'goodLower' => (int) ( 280 * $p_adjust ),
								'goodUpper' => (int) ( 520 * $p_adjust ),
								'upper'     => (int) ( 600 * $p_adjust ),
							],
						],
						'opengraph' => [
							'chars'  => [
								'lower'     => 15,
								'goodLower' => 25,
								'goodUpper' => 88,
								'upper'     => 100,
							],
							'pixels' => [],
						],
						'twitter' => [
							'chars'  => [
								'lower'     => 15,
								'goodLower' => 25,
								'goodUpper' => 69,
								'upper'     => 70,
							],
							'pixels' => [],
						],
					],
					'description' => [
						'search' => [
							'chars'  => [
								'lower'     => (int) ( 45 * $c_adjust ),
								'goodLower' => (int) ( 80 * $c_adjust ),
								'goodUpper' => (int) ( 160 * $c_adjust ),
								'upper'     => (int) ( 320 * $c_adjust ),
							],
							'pixels' => [
								'lower'     => (int) ( 256 * $p_adjust ),
								'goodLower' => (int) ( 455 * $p_adjust ),
								'goodUpper' => (int) ( 910 * $p_adjust ),
								'upper'     => (int) ( 1820 * $p_adjust ),
							],
						],
						'opengraph' => [
							'chars'  => [
								'lower'     => 45,
								'goodLower' => 80,
								'goodUpper' => 200,
								'upper'     => 300,
							],
							'pixels' => [],
						],
						'twitter' => [
							'chars'  => [
								'lower'     => 45,
								'goodLower' => 80,
								'goodUpper' => 200,
								'upper'     => 200,
							],
							'pixels' => [],
						],
					],
				],
				[ $c_adjust, $p_adjust ],
				$locale,
			),
			$locale,
		);
		// phpcs:enable, WordPress.Arrays.MultipleStatementAlignment.DoubleArrowNotAligned
	}
```

### the_seo_framework_set_noindex_header
**File:** `autodescription/inc/classes/helper/headers.class.php`

**Context:**

```php
* @since 5.0.0
	 */
	public static function output_robots_noindex_headers() {
		/**
		 * @since 4.0.5
		 * @param bool $noindex Whether a noindex header must be set.
		 */
		if ( \apply_filters( 'the_seo_framework_set_noindex_header', true ) )
			headers_sent() or header( 'X-Robots-Tag: noindex', true );
	}
}
```

### the_seo_framework_post_type_disabled
**File:** `autodescription/inc/classes/helper/post-type.class.php`

**Context:**

```php
$post_type = $post_type ?: Query::get_current_post_type();

		/**
		 * @since 3.1.2
		 * @param bool   $disabled
		 * @param string $post_type
		 */
		return (bool) \apply_filters(
			'the_seo_framework_post_type_disabled',
			Data\Plugin::get_option( 'disabled_post_types', $post_type ),
			$post_type,
		);
	}

	/**
```

### the_seo_framework_supported_post_type
**File:** `autodescription/inc/classes/helper/post-type.class.php`

**Context:**

```php
$post_type = $post_type ?: Query::get_current_post_type();

		/**
		 * @since 2.6.2
		 * @since 3.1.0 The first parameter is always a boolean now.
		 * @param bool   $supported           Whether the post type is supported.
		 * @param string $post_type_evaluated The evaluated post type.
		 */
		return (bool) \apply_filters(
			'the_seo_framework_supported_post_type',
			$post_type
				&& ! static::is_disabled( $post_type )
				&& \in_array( $post_type, static::get_all_public(), true ),
			$post_type,
		);
	}

	/**
```

### the_seo_framework_supported_post_type_archive
**File:** `autodescription/inc/classes/helper/post-type.class.php`

**Context:**

```php
$post_type = $post_type ?: Query::get_current_post_type();

		/**
		 * @since 4.2.8
		 * @param bool   $supported           Whether the post type archive is supported.
		 * @param string $post_type_evaluated The evaluated post type.
		 */
		return (bool) \apply_filters(
			'the_seo_framework_supported_post_type_archive',
			$post_type
				&& static::is_supported( $post_type )
				&& \in_array( $post_type, static::get_public_pta(), true ),
			$post_type,
		);
	}

	/**
```

### the_seo_framework_public_post_type_archives
**File:** `autodescription/inc/classes/helper/post-type.class.php`

**Context:**

```php
return umemo( __METHOD__ )
			?? umemo(
				__METHOD__,
				/**
				 * Do not consider using this filter. Properly register your post type, noob.
				 *
				 * @since 4.2.8
				 * @param string[] $post_types The public post types.
				 */
				(array) \apply_filters(
					'the_seo_framework_public_post_type_archives',
					array_values(
						array_filter(
							static::get_all_public(),
							fn( $post_type ) => \get_post_type_object( $post_type )->has_archive ?? false,
						)
					)
				)
			);
	}

	/**
```

### the_seo_framework_public_post_types
**File:** `autodescription/inc/classes/helper/post-type.class.php`

**Context:**

```php
return umemo( __METHOD__ )
			?? umemo(
				__METHOD__,
				/**
				 * Do not consider using this filter. Properly register your post type, noob.
				 *
				 * @since 4.2.0
				 * @param string[] $post_types The public post types.
				 */
				(array) \apply_filters(
					'the_seo_framework_public_post_types',
					array_values( array_filter(
						array_unique( array_merge(
							static::get_all_forced_supported(),
							// array_keys() because get_post_types() gives a sequential array.
							array_keys( (array) \get_post_types( [ 'public' => true ] ) )
						) ),
						'is_post_type_viewable',
					) )
				)
			);
	}

	/**
```

### the_seo_framework_forced_supported_post_types
**File:** `autodescription/inc/classes/helper/post-type.class.php`

**Context:**

```php
* @return string[] Forced supported post types.
	 */
	public static function get_all_forced_supported() {
		/**
		* @since 3.1.0
		* @param string[] $forced Forced supported post types.
		*/
		return (array) \apply_filters(
			'the_seo_framework_forced_supported_post_types',
			array_values( \get_post_types( [
				'public'   => true,
				'_builtin' => true,
			] ) ),
		);
	}

	/**
```

### the_seo_framework_real_id
**File:** `autodescription/inc/classes/helper/query.class.php`

**Context:**

```php
// Try to get ID from plugins or feed when caching is available.
		if ( $use_cache ) {
			/**
			 * @since 2.5.0
			 * @param int $id
			 */
			$id = \apply_filters(
				'the_seo_framework_real_id',
				\is_feed() ? \get_the_id() : 0,
			);
		}

		/**
```

### the_seo_framework_current_object_id
**File:** `autodescription/inc/classes/helper/query.class.php`

**Context:**

```php
);
		}

		/**
		 * @since 2.6.2
		 * @param int  $id        Can be either the Post ID, or the Term ID.
		 * @param bool $use_cache Whether this value is stored in runtime caching.
		 */
		$id = (int) \apply_filters(
			'the_seo_framework_current_object_id',
			( $id ?? 0 ) ?: \get_queried_object_id(), // This catches most IDs. Even Post IDs.
			$use_cache,
		);

		// Do not overwrite cache when not requested. Otherwise, we'd have two "initial" states, causing incongruities.
		return $use_cache ? umemo( __METHOD__, $id ) : $id;
```

### the_seo_framework_current_admin_id
**File:** `autodescription/inc/classes/helper/query.class.php`

**Context:**

```php
* @return int The admin ID.
	 */
	public static function get_the_real_admin_id() {
		/**
		 * @since 2.9.0
		 * @param int $id
		 */
		return (int) \apply_filters(
			'the_seo_framework_current_admin_id',
			// Get in the loop first, fall back to globals or get parameters.
			   \get_the_id()
			?: static::get_admin_post_id()
			?: static::get_admin_term_id()
		);
	}

	/**
```

### the_seo_framework_is_singular_archive
**File:** `autodescription/inc/classes/helper/query.class.php`

**Context:**

```php
return Query\Cache::memo( null, $id )
			?? Query\Cache::memo(
				/**
				 * @since 4.0.5
				 * @since 4.0.7 The $id can now be null, when no post is given.
				 * @param bool     $is_singular_archive Whether the post ID is a singular archive.
				 * @param int|null $id                  The supplied post ID. Null when in the loop.
				 */
				(bool) \apply_filters(
					'the_seo_framework_is_singular_archive',
					static::is_blog_as_page( $id ),
					$id,
				),
				$id,
			);
	}

	/**
```

### the_seo_framework_is_shop
**File:** `autodescription/inc/classes/helper/query.class.php`

**Context:**

```php
public static function is_shop( $post = null ) {
		return Query\Cache::memo( null, $post )
			?? Query\Cache::memo(
				/**
				 * @since 4.0.5
				 * @since 4.1.4 Now has its return value memoized.
				 * @param bool $is_shop Whether the post ID is a shop.
				 * @param int  $id      The current or supplied post ID.
				 */
				(bool) \apply_filters( 'the_seo_framework_is_shop', false, $post ),
				$post,
			);
	}

	/**
```

### the_seo_framework_is_product
**File:** `autodescription/inc/classes/helper/query.class.php`

**Context:**

```php
return Query\Cache::memo( null, $post )
			?? Query\Cache::memo(
				/**
				 * @since 4.0.5
				 * @since 4.1.4 Now has its return value memoized.
				 * @param bool $is_product
				 * @param int|WP_Post|null $post (Optional) Post ID or post object.
				 */
				(bool) \apply_filters( 'the_seo_framework_is_product', false, $post ),
				$post,
			);
	}

	/**
```

### the_seo_framework_is_product_admin
**File:** `autodescription/inc/classes/helper/query.class.php`

**Context:**

```php
public static function is_product_admin() {
		return Query\Cache::memo()
			?? Query\Cache::memo(
				/**
				 * @since 4.0.5
				 * @since 4.1.4 Now has its return value memoized.
				 * @param bool $is_product_admin
				 */
				(bool) \apply_filters( 'the_seo_framework_is_product_admin', false )
			);
	}

	/**
```

### content_pagination
**File:** `autodescription/inc/classes/helper/query.class.php`

**Context:**

```php
$pages = [ $content ];
			}

			/**
			 * Filter the "pages" derived from splitting the post content.
			 *
			 * "Pages" are determined by splitting the post content based on the presence
			 * of `<!-- nextpage -->` tags.
			 *
			 * @since 4.4.0 WordPress core
			 *
			 * @param array    $pages Array of "pages" derived from the post content.
			 *                 of `<!-- nextpage -->` tags..
			 * @param \WP_Post $post  Current post object.
			 */
			$pages = \apply_filters( 'content_pagination', $pages, $post );

			$numpages = \count( $pages );
		} elseif ( isset( $wp_query->max_num_pages ) ) {
```

### the_seo_framework_query_supports_seo
**File:** `autodescription/inc/classes/helper/query/utils.class.php`

**Context:**

```php
if ( ! $supported && static::is_query_exploited() )
			$supported = true;

		/**
		 * @since 4.0.0
		 * @param bool $supported Whether the query supports SEO.
		 */
		return memo( (bool) \apply_filters( 'the_seo_framework_query_supports_seo', $supported ) );
	}

	/**
```

### the_seo_framework_exploitable_query_endpoints
**File:** `autodescription/inc/classes/helper/query/utils.class.php`

**Context:**

```php
if ( ! isset( $wp_query->query ) )
			return false;

		/**
		 * @since 4.0.5
		 * @since 4.2.7 Added index `not_home_as_page` with value `search`.
		 * @since 5.0.5 Added index `not_front_page` with values `sitemap` and `sitemap-subtype`.
		 * @param array $exploitables The exploitable endpoints by type.
		 */
		$exploitables = \apply_filters(
			'the_seo_framework_exploitable_query_endpoints',
			[
				'numeric'          => [
					'page_id',
					'attachment_id',
					'year',
					'monthnum',
					'day',
					'w',
					'm',
					'p',
					'paged', // 'page' is mitigated by WordPress.
					'hour',
					'minute',
					'second',
					'subpost_id',
				],
				'numeric_array'    => [
					'cat',
					'author',
				],
				'requires_s'       => [
					'sentence',
				],
				// When the blog (home) is a page then these requests to any registered query variable will cause issues,
				// but only when the page ID returns 0. (We already tested for `if ( Query::get_the_real_id() )` above).
				// This global's property is only populated with requested parameters that match registered `public_query_vars`.
				// We only need one to pass this test. We could use array_key_first()... but that may be nulled (out of our control).
				'not_home_as_page' => array_keys( $GLOBALS['wp']->query_vars ?? [] ),
				// Another WordPress bug type mitigation: https://core.trac.wordpress.org/ticket/51117.
				'should_be_404'    => [
					'sitemap',
					'sitemap-subtype',
				],
			],
		);

		$query = $wp_query->query;
```

### the_seo_framework_allow_external_redirect
**File:** `autodescription/inc/classes/helper/redirect.class.php`

**Context:**

```php
* @return bool Whether external redirect is allowed.
	 */
	public static function allow_external_redirect() {
		/**
		 * @since 2.1.0
		 * @param bool $allowed Whether external redirect is allowed.
		 */
		return memo() ?? memo( (bool) \apply_filters( 'the_seo_framework_allow_external_redirect', true ) );
	}
}
```

### the_seo_framework_taxonomy_disabled
**File:** `autodescription/inc/classes/helper/taxonomy.class.php`

**Context:**

```php
}
		}

		/**
		 * @since 4.1.0
		 * @param bool    $disabled Whether the taxonomy is disabled.
		 * @param ?string $taxonomy The taxonomy name. Left null to automatically determine.
		 */
		return \apply_filters(
			'the_seo_framework_taxonomy_disabled',
			$disabled,
			$taxonomy,
		);
	}

	/**
```

### the_seo_framework_supported_taxonomy
**File:** `autodescription/inc/classes/helper/taxonomy.class.php`

**Context:**

```php
$taxonomy = $taxonomy ?: Query::get_current_taxonomy();

		/**
		 * @since 3.1.0
		 * @since 4.0.0 Now returns only returns false when all post types in the taxonomy aren't supported.
		 * @param bool   $post_type Whether the post type is supported
		 * @param string $post_type_evaluated The evaluated post type.
		 */
		return (bool) \apply_filters(
			'the_seo_framework_supported_taxonomy',
			$taxonomy
				&& ! static::is_disabled( $taxonomy )
				&& \in_array( $taxonomy, static::get_all_public(), true ),
			$taxonomy,
		);
	}

	/**
```

### the_seo_framework_public_taxonomies
**File:** `autodescription/inc/classes/helper/taxonomy.class.php`

**Context:**

```php
return umemo( __METHOD__ )
			?? umemo(
				__METHOD__,
				/**
				 * Do not consider using this filter. Properly register your taxonomy, noob.
				 *
				 * @since 4.2.0
				 * @param string[] $taxonomies The public taxonomies.
				 */
				(array) \apply_filters(
					'the_seo_framework_public_taxonomies',
					array_filter(
						array_unique( array_merge(
							static::get_all_forced_supported(),
							// array_values() because get_taxonomies() gives a sequential array.
							array_values( \get_taxonomies( [
								'public'   => true,
								'_builtin' => false,
							] ) )
						) ),
						'is_taxonomy_viewable',
					)
				)
			);
	}

	/**
```

### the_seo_framework_forced_supported_taxonomies
**File:** `autodescription/inc/classes/helper/taxonomy.class.php`

**Context:**

```php
* @return string[] Forced supported taxonomies
	 */
	public static function get_all_forced_supported() {
		/**
		 * @since 4.1.0
		 * @param string[] $forced Forced supported taxonomies.
		 */
		return (array) \apply_filters(
			'the_seo_framework_forced_supported_taxonomies',
			array_values( \get_taxonomies( [
				'public'   => true,
				'_builtin' => true,
			] ) ),
		);
	}

	/**
```

### deprecated_function_trigger_error
**File:** `autodescription/inc/classes/internal/debug.class.php`

**Context:**

```php
*/
		\do_action( 'deprecated_function_run', $function, $replacement, $version );

		/**
		 * Filter whether to trigger an error for deprecated functions.
		 *
		 * @since WP Core 2.5.0
		 *
		 * @param bool $trigger Whether to trigger the error for deprecated functions. Default true.
		 */
		if ( \WP_DEBUG && \apply_filters( 'deprecated_function_trigger_error', true ) ) {

			if ( isset( $replacement ) ) {
				$message = \sprintf(
					/* translators: 1: Function name, 2: 'Deprecated', 3: Plugin Version notification, 4: Replacement function */
					\esc_html__( '%1$s is %2$s since version %3$s of The SEO Framework! Use %4$s instead.', 'autodescription' ),
					\esc_html( $function ),
					'<strong>' . \esc_html__( 'deprecated', 'autodescription' ) . '</strong>',
					\esc_html( $version ) ?: 'unknown',
					$replacement, // phpcs:ignore, WordPress.Security.EscapeOutput -- See doc comment.
				);
			} else {
				$message = \sprintf(
					/* translators: 1: Function name, 2: 'Deprecated', 3: Plugin Version notification */
```

### doing_it_wrong_trigger_error
**File:** `autodescription/inc/classes/internal/debug.class.php`

**Context:**

```php
*/
		\do_action( 'doing_it_wrong_run', $function, $message, $version );

		/**
		 * @since WP Core 3.1.0
		 * @param bool $trigger Whether to trigger the error for _doing_it_wrong() calls. Default true.
		 */
		if ( \WP_DEBUG && \apply_filters( 'doing_it_wrong_trigger_error', true ) ) {

			$ver_message = $version
				/* translators: 1: plugin version */
				? \sprintf( \__( '(This message was added in version %s of The SEO Framework.)', 'autodescription' ), $version )
				: '';

			$message = \sprintf(
				/* translators: 1: Function name, 2: 'Incorrectly', 3: Error message 4: Plugin Version notification */
```

### the_seo_framework_inaccessible_p_or_m_trigger_error
**File:** `autodescription/inc/classes/internal/debug.class.php`

**Context:**

```php
*/
		\do_action( 'the_seo_framework_inaccessible_p_or_m_run', $p_or_m, $message );

		/**
		 * Filter whether to trigger an error for _doing_it_wrong() calls.
		 *
		 * @since WP Core 3.1.0
		 *
		 * @param bool $trigger Whether to trigger the error for _doing_it_wrong() calls. Default true.
		 */
		if ( \WP_DEBUG && \apply_filters( 'the_seo_framework_inaccessible_p_or_m_trigger_error', true ) ) {
			$message = \sprintf(
				/* translators: 1: Method or Property name, 2: "inaccessible", 3: Class name. 4: Message */
				\esc_html__( '%1$s is %2$s in %3$s. %4$s', 'autodescription' ),
				'<code>' . \esc_html( $p_or_m ) . '</code>',
				'<strong>' . \esc_html__( 'inaccessible', 'autodescription' ) . '</strong>',
				\sprintf( '<b>%s</b>', \esc_html( $handle ) ),
				\esc_html( $message ),
			);

			trigger_error(
				// phpcs:ignore, WordPress.Security.EscapeOutput.OutputNotEscaped -- combobulate_error_message escapes.
```

### the_seo_framework_breadcrumb_list
**File:** `autodescription/inc/classes/meta/breadcrumbs.class.php`

**Context:**

```php
$list = memo() ?? memo( static::get_breadcrumb_list_from_query() );
		}

		/**
		 * @since 5.0.0
		 * @param array[] {
		 *     The breadcrumb list items in order of appearance.
		 *
		 *     @type string $url  The breadcrumb URL.
		 *     @type string $name The breadcrumb page title.
		 * }
		 * @param array|null $args The query arguments. Contains 'id', 'tax', 'pta', and 'uid'.
		 *                         Is null when the query is auto-determined.
		 */
		return (array) \apply_filters(
			'the_seo_framework_breadcrumb_list',
			$list,
			$args,
		);
	}

	/**
```

### the_seo_framework_custom_field_description
**File:** `autodescription/inc/classes/meta/description.class.php`

**Context:**

```php
$desc = static::get_custom_description_from_query();
		}

		/**
		 * @since 2.9.0
		 * @since 4.2.0 1. No longer gets supplied custom query arguments when in the loop.
		 *              2. Now supports the `$args['pta']` index.
		 * @param string     $desc The custom-field description.
		 * @param array|null $args The query arguments. Contains 'id', 'tax', 'pta', and 'uid'.
		 *                         Is null when the query is auto-determined.
		 */
		return Sanitize::metadata_content( \apply_filters(
			'the_seo_framework_custom_field_description',
			$desc,
			$args,
		) );
	}

	/**
```

### the_seo_framework_description_excerpt
**File:** `autodescription/inc/classes/meta/description.class.php`

**Context:**

```php
'the_seo_framework_description_excerpt',
		);

		/**
		 * @since 5.0.0
		 * @param string     $excerpt The excerpt to use.
		 * @param array|null $args    The query arguments. Contains 'id', 'tax', 'pta', and 'uid'.
		 *                            Is null when the query is auto-determined.
		 * @param string     $type    Type of description. Accepts 'search', 'opengraph', 'twitter'.
		 */
		$excerpt = (string) \apply_filters(
			'the_seo_framework_description_excerpt',
			$excerpt,
			$args,
			$type,
		);

		// This page has a generated description that's far too short: https://theseoframework.com/em-changelog/1-0-0-amplified-seo/.
		// A direct directory-'site:' query will accept the description outputted--anything else will ignore it...
```

### the_seo_framework_generated_description
**File:** `autodescription/inc/classes/meta/description.class.php`

**Context:**

```php
Guidelines::get_text_size_guidelines()['description'][ $type ]['chars']['goodUpper'],
		);

		/**
		 * @since 2.9.0
		 * @since 3.1.0 No longer passes 3rd and 4th parameter.
		 * @since 4.2.0 Now supports the `$args['pta']` index.
		 * @since 5.0.0 Added third parameter `$type`.
		 * @param string     $desc The generated description.
		 * @param array|null $args The query arguments. Contains 'id', 'tax', 'pta', and 'uid'.
		 *                         Is null when the query is auto-determined.
		 * @param string     $type Type of description. Accepts 'search', 'opengraph', 'twitter'.
		 */
		$desc = (string) \apply_filters(
			'the_seo_framework_generated_description',
			$desc,
			$args,
			$type,
		);

		return memo(
			\strlen( $desc ) ? Sanitize::metadata_content( $desc ) : '',
```

### the_seo_framework_enable_auto_description
**File:** `autodescription/inc/classes/meta/description.class.php`

**Context:**

```php
isset( $args ) and normalize_generation_args( $args );

		/**
		 * @since 2.5.0
		 * @since 3.0.0 Now passes $args as the second parameter.
		 * @since 3.1.0 Now listens to option.
		 * @since 4.2.0 Now supports the `$args['pta']` index.
		 * @param bool       $autodescription Enable or disable the automated descriptions.
		 * @param array|null $args            The query arguments. Contains 'id', 'tax', 'pta', and 'uid'.
		 *                                    Is null when the query is auto-determined.
		 */
		return (bool) \apply_filters(
			'the_seo_framework_enable_auto_description',
			Data\Plugin::get_option( 'auto_description' ),
			$args,
		);
	}
}
```

### the_seo_framework_get_excerpt
**File:** `autodescription/inc/classes/meta/description/excerpt.class.php`

**Context:**

```php
* @return string The post, term, pta, or user excerpt.
	 */
	public static function get_excerpt( $args = null ) {
		/**
		 * @since 5.1.0
		 * @param string     $excerpt The generated excerpt.
		 * @param array|null $args    The query arguments. Accepts 'id', 'tax', 'pta', and 'uid'.
		 *                            Leave null to autodetermine query.
		 * @return string The post, term, pta, or user excerpt.
		 */
		return \apply_filters(
			'the_seo_framework_get_excerpt',
			isset( $args )
				? static::get_excerpt_from_args( $args )
				: static::get_excerpt_from_query(),
			$args,
		);
	}

	/**
```

### the_seo_framework_custom_image_details
**File:** `autodescription/inc/classes/meta/image.class.php`

**Context:**

```php
* }
	 */
	public static function get_custom_image_details( $args = null, $single = false, $context = 'social' ) {
		/**
		 * @since 5.0.0
		 * @param array      $details {
		 *     The image details array, sequential.
		 *
		 *     @type string $url      The image URL.
		 *     @type int    $id       The image ID.
		 *     @type int    $width    The image width in pixels.
		 *     @type int    $height   The image height in pixels.
		 *     @type string $alt      The image alt tag.
		 *     @type string $caption  The image caption.
		 *     @type int    $filesize The image filesize in bytes.
		 * }
		 * @param array|null $args    The query arguments. Accepts 'id', 'tax', 'pta', and 'uid'.
		 *                            Is null when the query is auto-determined.
		 * @param bool       $single  Whether to fetch one image, or multiple.
		 */
		return \apply_filters(
			'the_seo_framework_custom_image_details',
			$single
				? array_filter( [ static::generate_custom_image_details( $args, $context )->current() ] )
				: [ ...static::generate_custom_image_details( $args, $context ) ],
			$args,
			$single,
		);
	}

	/**
```

### the_seo_framework_generated_image_details
**File:** `autodescription/inc/classes/meta/image.class.php`

**Context:**

```php
* }
	 */
	public static function get_generated_image_details( $args = null, $single = false, $context = 'social' ) {
		/**
		 * @since 5.0.0
		 * @param array      $details {
		 *     The image details array, sequential.
		 *
		 *     @type string $url      The image URL.
		 *     @type int    $id       The image ID.
		 *     @type int    $width    The image width in pixels.
		 *     @type int    $height   The image height in pixels.
		 *     @type string $alt      The image alt tag.
		 *     @type string $caption  The image caption.
		 *     @type int    $filesize The image filesize in bytes.
		 * }
		 * @param array|null $args    The query arguments. Accepts 'id', 'tax', 'pta', and 'uid'.
		 *                            Is null when the query is auto-determined.
		 * @param bool       $single  Whether to fetch one image, or multiple.
		 * @param string     $context Caller context. Internally supports 'organization', 'social', and 'oembed'. Default 'social'.
		 */
		return \apply_filters(
			'the_seo_framework_generated_image_details',
			$single
				? array_filter( [ static::generate_generated_image_details( $args, $context )->current() ] )
				: [ ...static::generate_generated_image_details( $args, $context ) ],
			$args,
			$single,
			$context,
		);
	}

	/**
```

### the_seo_framework_image_generation_params
**File:** `autodescription/inc/classes/meta/image.class.php`

**Context:**

```php
];
		}

		/**
		 * @since 4.0.0
		 * @since 4.2.0 Now supports the `$args['pta']` index.
		 * @param array      $params  {
		 *     The image generation parameters.
		 *
		 *     @type string  $size     The image size to use.
		 *     @type boolean $multi    Whether to allow multiple images to be returned. This may be overwritten by generators to 'false'.
		 *     @type array   $cbs      The callbacks to parse. Ideally be generators, so we can halt remotely.
		 *     @type array   $fallback The callbacks to parse. Ideally be generators, so we can halt remotely.
		 * ];
		 * @param array|null $args    The query arguments. Contains 'id', 'tax', 'pta', and 'uid'.
		 *                            Is null when the query is auto-determined.
		 * @param string     $context Caller context. Internally supports 'organization', 'social', and 'oembed'. Default 'social'.
		 *                            May be (for example) 'breadcrumb' or 'article' for structured data.
		 */
		return \apply_filters(
			'the_seo_framework_image_generation_params',
			[
				'size'     => 'full',
				'multi'    => true,
				'cbs'      => $cbs ?? [],
				'fallback' => $fallback ?? [],
			],
			$args,
			$context,
		);
	}

	/**
```

### the_seo_framework_robots_meta_array
**File:** `autodescription/inc/classes/meta/robots.class.php`

**Context:**

```php
}
		}

		/**
		 * Filters the front-end robots array, and strips empty indexes thereafter.
		 *
		 * @since 2.6.0
		 * @since 4.0.0 Added two parameters ($args and $ignore).
		 * @since 4.0.2 Now contains the copyright directive values.
		 * @since 4.0.3 Changed `$meta` key `max_snippet_length` to `max_snippet`
		 * @since 4.2.0 Now supports the `$args['pta']` index.
		 *
		 * @param array      $meta {
		 *     The current robots meta.
		 *
		 *     @type ?string $noindex           If set, it should be 'noindex'.
		 *     @type ?string $nofollow          If set, it should be 'nofollow'.
		 *     @type ?string $noarchive         If set, it should be 'noarchive'.
		 *     @type ?string $max_snippet       If set, it should be 'max-snippet:<R>=-1>',
		 *                                      where '<R>=-1>' is a number of or above -1.
		 *     @type ?string $max_image_preview If set, it should be 'max-image-preview:<none|standard|large>',
		 *                                      where any of 'none', 'standard', or 'large' is chosen.
		 *     @type ?string $max_video_preview If set, it should be 'max-video-preview:<R>=-1>',
		 *                                      where '<R>=-1>' is a number of or above -1.
		 * }
		 * @param array|null $args The query arguments. Contains 'id', 'tax', 'pta', and 'uid'.
		 *                         Is null when the query is auto-determined.
		 * @param int <bit>  $options The ignore level. {
		 *    0 = 0b000: Ignore nothing. Collect nothing. (Default front-end.)
		 *    1 = 0b001: Ignore protection. (\The_SEO_Framework\ROBOTS_IGNORE_PROTECTION)
		 *    2 = 0b010: Ignore post/term setting. (\The_SEO_Framework\ROBOTS_IGNORE_SETTINGS)
		 *    4 = 0b100: Collect assertions. (\The_SEO_Framework\ROBOTS_ASSERT)
		 * }
		 */
		return array_filter( (array) \apply_filters(
			'the_seo_framework_robots_meta_array',
			$meta,
			$args,
			$options,
		) );
	}

	/**
```

### the_seo_framework_enable_noindex_no_posts
**File:** `autodescription/inc/classes/meta/robots/front.class.php`

**Context:**

```php
if ( $GLOBALS['wp_query']->post_count ?? true ) {
						yield '404' => false;
					} else {
						/**
						 * We recommend using this filter ONLY for archives that have useful content but no "posts" attached.
						 * For example: a specially custom-developed author page for an author that never published a post.
						 *
						 * This filter won't run when a few other conditions for noindex have been met.
						 *
						 * @since 4.1.4
						 * @link <https://github.com/sybrew/the-seo-framework/issues/194#issuecomment-864298702>
						 * @param bool $noindex Whether to enable no posts protection.
						 */
						yield '404' => (bool) \apply_filters( 'the_seo_framework_enable_noindex_no_posts', true );
					}
				}
				break;
```

### the_seo_framework_enable_noindex_comment_pagination
**File:** `autodescription/inc/classes/meta/robots/front.class.php`

**Context:**

```php
break;

			case 'cpage':
				/**
				 * We do not recommend using this filter as it'll likely get those pages flagged as
				 * duplicated by Google anyway; unless the theme strips or trims the content.
				 *
				 * This filter won't run when other conditions for noindex have been met.
				 *
				 * @since 4.0.5
				 * @param bool $noindex Whether to enable comment pagination protection.
				 */
				yield 'cpage' => \apply_filters( 'the_seo_framework_enable_noindex_comment_pagination', true );
		}
	}
}
```

### the_seo_framework_schema_entity_builders
**File:** `autodescription/inc/classes/meta/schema.class.php`

**Context:**

```php
foreach ( $primaries as $class )
			$builders_queue[] = ( "\The_SEO_Framework\Meta\Schema\Entities\\$class" )::BUILDERS;

		/**
		 * @since 5.0.0
		 * @param callable[] $entity_builders A list of Schema.org entity builders.
		 * @param array|null $args            The query arguments. Accepts 'id', 'tax', 'pta', and 'uid'.
		 *                                    Is null when being autodetermined.
		 */
		$entity_builders = \apply_filters(
			'the_seo_framework_schema_entity_builders',
			array_merge( ...$builders_queue ),
			$args,
		);

		$graph = [];
		// Build the primary objects in the graph.
```

### the_seo_framework_schema_queued_graph_data
**File:** `autodescription/inc/classes/meta/schema.class.php`

**Context:**

```php
foreach ( $entity_builders as $builder )
			$graph[] = \call_user_func( $builder, $args );

		/**
		 * For consistency, data should be filtered deep, such as (WordPress) title
		 * filters for breadcrumb and page titles. Use this only if those aren't available.
		 *
		 * Use this only to adjust write dynamic references.
		 * Use `the_seo_framework_schema_graph_data` for direct alteration instead.
		 *
		 * @since 5.1.0
		 * @param array[]    $graph A sequential list of graph entities.
		 * @param array|null $args  The query arguments. Accepts 'id', 'tax', 'pta', and 'uid'.
		 *                          Is null when the query is autodetermined.
		 */
		$graph = \apply_filters(
			'the_seo_framework_schema_queued_graph_data',
			$graph,
			$args,
		);

		// Fill the graph's references dynamically. Append extra graphs when given.
		foreach ( static::$writer_queue as $writer )
```

### the_seo_framework_schema_graph_data
**File:** `autodescription/inc/classes/meta/schema.class.php`

**Context:**

```php
// Reset queue.
		static::$writer_queue = [];

		/**
		 * For consistency, data should be filtered deep, such as (WordPress) title
		 * filters for breadcrumb and page titles. Use this only if those aren't available.
		 *
		 * @since 5.0.0
		 * @param array[]    $graph A sequential list of graph entities.
		 * @param array|null $args  The query arguments. Accepts 'id', 'tax', 'pta', and 'uid'.
		 *                          Is null when the query is autodetermined.
		 */
		$graph = \apply_filters(
			'the_seo_framework_schema_graph_data',
			$graph,
			$args,
		);

		if ( empty( $graph ) ) return [];
```

### the_seo_framework_title_from_custom_field
**File:** `autodescription/inc/classes/meta/title.class.php`

**Context:**

```php
$title = static::get_custom_title_from_query();
		}

		/**
		 * Filters the title from custom field, if any.
		 *
		 * @since 3.1.0
		 * @since 4.2.0 Now supports the `$args['pta']` index.
		 *
		 * @param string     $title The title.
		 * @param array|null $args  The query arguments. Contains 'id', 'tax', 'pta', and 'uid'.
		 *                          Is null when the query is auto-determined.
		 */
		return Sanitize::metadata_content( (string) \apply_filters(
			'the_seo_framework_title_from_custom_field',
			$title,
			$args,
		) );
	}

	/**
```

### the_seo_framework_title_from_generation
**File:** `autodescription/inc/classes/meta/title.class.php`

**Context:**

```php
Title\Utils::reset_default_title_filters();

		/**
		 * Filters the title from query.
		 *
		 * @NOTE: This filter doesn't consistently run on the SEO Settings page.
		 *        You may want to avoid this filter for the homepage and pta, by returning the default value.
		 * @since 3.1.0
		 * @since 4.2.0 Now supports the `$args['pta']` index.
		 * @param string     $title The title.
		 * @param array|null $args  The query arguments. Contains 'id', 'tax', 'pta', and 'uid'.
		 *                          Is null when the query is auto-determined.
		 */
		$title = (string) \apply_filters(
			'the_seo_framework_title_from_generation',
			$title ?: static::get_untitled_title(),
			$args,
		);

		return memo(
			\strlen( $title ) ? Sanitize::metadata_content( $title ) : '',
```

### the_seo_framework_generated_archive_title_items
**File:** `autodescription/inc/classes/meta/title.class.php`

**Context:**

```php
'the_seo_framework_generated_archive_title_items'
		);

		/**
		 * @since 5.0.0
		 * @param String[title,prefix,title_without_prefix] $items                The generated archive title items.
		 * @param \WP_Term|\WP_User|\WP_Post_Type|null      $object               The archive object.
		 *                                                                        Is null when query is autodetermined.
		 * @param string                                    $title_without_prefix Archive title without prefix.
		 * @param string                                    $prefix               Archive title prefix.
		 */
		return \apply_filters(
			'the_seo_framework_generated_archive_title_items',
			[
				$title,
				$prefix,
				$title_without_prefix,
			],
			$object,
			$title,
			$title_without_prefix,
			$prefix,
		);
	}

	/**
```

### single_post_title
**File:** `autodescription/inc/classes/meta/title.class.php`

**Context:**

```php
$post = \get_post( $id ?: Query::get_the_real_id() );

		if ( isset( $post->post_title ) && \post_type_supports( $post->post_type, 'title' ) ) {
			/**
			 * Filters the page title for a single post.
			 *
			 * @since WP Core 0.71
			 *
			 * @param string   $post_title The single post page title.
			 * @param \WP_Post $post       The current queried object as returned by get_queried_object().
			 */
			$title = \apply_filters( 'single_post_title', $post->post_title, $post );
		}

		if ( isset( $title ) && \strlen( $title ) )
```

### single_cat_title
**File:** `autodescription/inc/classes/meta/title.class.php`

**Context:**

```php
switch ( $term->taxonomy ) {
			case 'category':
				/**
				 * Filter the category archive page title.
				 *
				 * @since WP Core 2.0.10
				 *
				 * @param string $term_name Category name for archive being displayed.
				 */
				$title = \apply_filters( 'single_cat_title', $term->name );
				break;
			case 'post_tag':
				/**
```

### single_tag_title
**File:** `autodescription/inc/classes/meta/title.class.php`

**Context:**

```php
$title = \apply_filters( 'single_cat_title', $term->name );
				break;
			case 'post_tag':
				/**
				 * Filter the tag archive page title.
				 *
				 * @since WP Core 2.3.0
				 *
				 * @param string $term_name Tag name for archive being displayed.
				 */
				$title = \apply_filters( 'single_tag_title', $term->name );
				break;
			default:
				/**
```

### single_term_title
**File:** `autodescription/inc/classes/meta/title.class.php`

**Context:**

```php
$title = \apply_filters( 'single_tag_title', $term->name );
				break;
			default:
				/**
				 * Filter the custom taxonomy archive page title.
				 *
				 * @since WP Core 3.1.0
				 *
				 * @param string $term_name Term name for archive being displayed.
				 */
				$title = \apply_filters( 'single_term_title', $term->name );
		}

		return \strlen( $title ) ? Sanitize::metadata_content( $title ) : '';
```

### post_type_archive_title
**File:** `autodescription/inc/classes/meta/title.class.php`

**Context:**

```php
if ( ! \in_array( $post_type, Post_Type::get_public_pta(), true ) )
			return '';

		/**
		 * Filters the post type archive title.
		 *
		 * @since WP Core 3.1.0
		 *
		 * @param string $post_type_name Post type 'name' label.
		 * @param string $post_type      Post type.
		 */
		$title = \apply_filters(
			'post_type_archive_title',
			Post_Type::get_label( $post_type, false ),
			$post_type,
		);

		return \strlen( $title ) ? Sanitize::metadata_content( $title ) : '';
	}
```

### the_seo_framework_404_title
**File:** `autodescription/inc/classes/meta/title.class.php`

**Context:**

```php
*/
	public static function get_404_title() {
		return Sanitize::metadata_content(
			/**
			 * @since 2.5.2
			 * @since 5.0.0 Now defaults to Core translatable "Page not found."
			 * @param string $title The 404 title.
			 */
			(string) \apply_filters(
				'the_seo_framework_404_title',
				\__( 'Page not found', 'default' )
			)
		);
	}

	/**
```

### protected_title_format
**File:** `autodescription/inc/classes/meta/title.class.php`

**Context:**

```php
if ( ! empty( $post->post_password ) ) {
			return \sprintf(
				/**
				 * Filters the text prepended to the post title of private posts.
				 *
				 * The filter is only applied on the front end.
				 *
				 * @since WP Core 2.8.0
				 *
				 * @param string  $prepend Text displayed before the post title.
				 *                         Default 'Private: %s'.
				 * @param WP_Post $post    Current post object.
				 */
				(string) \apply_filters(
					'protected_title_format',
					/* translators: %s: Protected post title. */
					\__( 'Protected: %s', 'default' ),
					$post,
				),
				$title,
			);
		} elseif ( 'private' === ( $post->post_status ?? null ) ) {
			return \sprintf(
				/**
```

### private_title_format
**File:** `autodescription/inc/classes/meta/title.class.php`

**Context:**

```php
);
		} elseif ( 'private' === ( $post->post_status ?? null ) ) {
			return \sprintf(
				/**
				 * Filters the text prepended to the post title of private posts.
				 *
				 * The filter is only applied on the front end.
				 *
				 * @since WP Core 2.8.0
				 *
				 * @param string  $prepend Text displayed before the post title.
				 *                         Default 'Private: %s'.
				 * @param WP_Post $post    Current post object.
				 */
				$private_title_format = (string) \apply_filters(
					'private_title_format',
					/* translators: %s: Private post title. */
					\__( 'Private: %s', 'default' ),
					$post,
				),
				$title,
			);
		}

		return $title;
```

### the_seo_framework_title_separator
**File:** `autodescription/inc/classes/meta/title.class.php`

**Context:**

```php
* @param string $eparator The title separator
		 */
		return memo() ?? memo(
			(string) \apply_filters(
				'the_seo_framework_title_separator',
				Title\Utils::get_separator_list()[ Data\Plugin::get_option( 'title_separator' ) ] ?? '&#x2d;',
			)
		);
	}
}
```

### the_seo_framework_use_title_branding
**File:** `autodescription/inc/classes/meta/title/conditions.class.php`

**Context:**

```php
}
		}

		/**
		 * @since 3.1.2
		 * @since 4.1.0 Added the third $social parameter.
		 * @param bool       $use    Whether to use branding.
		 * @param array|null $args   The query arguments. Contains 'id', 'tax', 'pta', and 'uid'.
		 *                           Is null when the query is auto-determined.
		 * @param bool       $social Whether the title is meant for social display.
		 */
		return \apply_filters(
			'the_seo_framework_use_title_branding',
			$use,
			$args,
			(bool) $social,
		);
	}

	/**
```

### the_seo_framework_use_archive_prefix
**File:** `autodescription/inc/classes/meta/title/conditions.class.php`

**Context:**

```php
* @return bool
	 */
	public static function use_generated_archive_prefix( $term = null ) {
		/**
		 * @since 4.0.5
		 * @param bool                            $use  Whether to use the prefix.
		 * @param \WP_Term|\WP_User|\WP_Post_Type $term The current term object.
		 */
		return \apply_filters(
			'the_seo_framework_use_archive_prefix',
			! Data\Plugin::get_option( 'title_rem_prefixes' ),
			$term ?? \get_queried_object(),
		);
	}
}
```

### the_seo_framework_separator_list
**File:** `autodescription/inc/classes/meta/title/utils.class.php`

**Context:**

```php
* @return array Title separators.
	 */
	public static function get_separator_list() {
		/**
		 * @since 3.1.0
		 * @since 4.0.0 Removed the hyphen (then known as 'dash') key.
		 * @since 4.0.5 Reintroduced hyphen.
		 * @param array $list The separator list in { option_name > display_value } format.
		 *                    The option name should be translatable within `&...;` tags.
		 *                    'pipe' is excluded from this rule.
		 */
		return (array) \apply_filters(
			'the_seo_framework_separator_list',
			[
				'hyphen' => '&#x2d;',
				'pipe'   => '|',
				'ndash'  => '&ndash;',
				'mdash'  => '&mdash;',
				'bull'   => '&bull;',
				'middot' => '&middot;',
				'lsaquo' => '&lsaquo;',
				'rsaquo' => '&rsaquo;',
				'frasl'  => '&frasl;',
				'laquo'  => '&laquo;',
				'raquo'  => '&raquo;',
				'le'     => '&le;',
				'ge'     => '&ge;',
				'lt'     => '&lt;',
				'gt'     => '&gt;',
			],
		);
	}

	/**
```

### the_seo_framework_supported_twitter_card_types
**File:** `autodescription/inc/classes/meta/twitter.class.php`

**Context:**

```php
* @return array Supported Twitter Card types.
	 */
	public static function get_supported_cards() {
		/**
		 * @since 5.0.0
		 * @param string[] The supported Twitter card types.
		 *                 These are used for settings population, validation, and sanitization.
		 */
		return \apply_filters(
			'the_seo_framework_supported_twitter_card_types',
			[
				'summary',
				'summary_large_image',
			],
		);
	}

	/**
```

### the_seo_framework_preferred_url_scheme
**File:** `autodescription/inc/classes/meta/uri/utils.class.php`

**Context:**

```php
$scheme = static::detect_site_url_scheme();
		}

		/**
		 * @since 2.8.0
		 * @param string $scheme The current URL scheme.
		 */
		return memo( (string) \apply_filters( 'the_seo_framework_preferred_url_scheme', $scheme ) );
	}

	/**
```

### the_seo_framework_robots_txt_sections
**File:** `autodescription/inc/classes/robotstxt/main.class.php`

**Context:**

```php
}
		}

		/**
		 * @since 5.1.0
		 * @param array  $robots_sections {
		 *     The robots directives, associative by key.
		 *     All input is expected to be escaped.
		 *
		 *     @type array {$key} {
		 *         The default or custom directives.
		 *
		 *         @type string   $raw        The raw output to prepend.
		 *         @type string[] $user-agent The user agent to apply the directives for.
		 *         @type string[] $disallow   The disallow directives.
		 *         @type string[] $allow      The allow directives.
		 *         @type int      $priority   The priority of the output, a lower priority means earlier output.
		 *                                    Defaults to 10.
		 *     }
		 * }
		 * @param string $site_path The determined site path. Use this path to prefix URLs.
		 */
		$robots_sections = (array) \apply_filters(
			'the_seo_framework_robots_txt_sections',
			[
				'deprecated_before' => [
					/**
					 * @since 2.5.0
					 * @since 5.1.0 Deprecated.
					 * @deprecated
					 * @param string $pre The output before this plugin's output.
					 *                    Don't forget to add line breaks ( "\n" )!
					 */
					'raw'      => (string) \apply_filters_deprecated(
						'the_seo_framework_robots_txt_pre',
						[ '' ],
						'5.1.0 of The SEO Framework',
						'the_seo_framework_robots_txt_sections',
					),
					'priority' => 0,
				],
				'default'           => [
					'user-agent' => [ '*' ],
					'disallow'   => [ "$site_path/wp-admin/", $disallow_queries ],
					'allow'      => [ "$site_path/wp-admin/admin-ajax.php" ],
				],
				'block_ai'          => Data\Plugin::get_option( 'robotstxt_block_ai' ) ? [
					'user-agent' => array_keys( RobotsTXT\Utils::get_blocked_user_agents( 'ai' ) ),
					'disallow'   => [ '/' ],
				] : [],
				'block_seo'         => Data\Plugin::get_option( 'robotstxt_block_seo' ) ? [
					'user-agent' => array_keys( RobotsTXT\Utils::get_blocked_user_agents( 'seo' ) ),
					'disallow'   => [ '/' ],
				] : [],
				'deprecated_after'  => [
					/**
					 * @since 2.5.0
					 * @since 5.1.0 Deprecated.
					 * @deprecated
					 * @param string $pro The output after this plugin's output.
					 *                    Don't forget to add line breaks ( "\n" )!
					 */
					'raw'      => (string) \apply_filters_deprecated(
						'the_seo_framework_robots_txt_pro',
						[ '' ],
						'5.1.0 of The SEO Framework',
						'the_seo_framework_robots_txt_sections',
					),
					'priority' => 500,
				],
				'sitemaps'          => [
					'sitemaps' => $sitemaps,
					'priority' => 1000,
				],
			],
			$site_path,
		);

		// We need to use uasort to maintain index association, but we don't read the indexes.
		usort( $robots_sections, fn( $a, $b ) => ( $a['priority'] ?? 10 ) <=> ( $b['priority'] ?? 10 ) );
```

### the_seo_framework_robots_txt
**File:** `autodescription/inc/classes/robotstxt/main.class.php`

**Context:**

```php
$output .= implode( "\n", $pieces );

		/**
		 * The robots.txt output.
		 *
		 * @since 4.0.5
		 * @param string $output The robots.txt output.
		 */
		return (string) \apply_filters( 'the_seo_framework_robots_txt', $output );
	}
}
```

### the_seo_framework_robots_blocked_user_agents
**File:** `autodescription/inc/classes/robotstxt/utils.class.php`

**Context:**

```php
];
		}

		/**
		 * @since 5.1.0
		 * @param array $agents The user-agent list for $type.
		 * @param arrary $type  The agent type requested by the method caller.
		 */
		return (array) \apply_filters(
			'the_seo_framework_robots_blocked_user_agents',
			$agents ?? [],
			$type,
		);
	}

	/**
```

### the_seo_framework_sitemap_timestamp
**File:** `autodescription/inc/classes/sitemap/optimized/base.class.php`

**Context:**

```php
$show_modified = (bool) Data\Plugin::get_option( 'sitemaps_modified' );

		/**
		 * @since 2.2.9
		 * @param bool $timestamp Whether to display the timestamp.
		 */
		$timestamp = (bool) \apply_filters( 'the_seo_framework_sitemap_timestamp', true );

		if ( $timestamp )
			$content .= \sprintf(
```

### the_seo_framework_sitemap_supported_post_types
**File:** `autodescription/inc/classes/sitemap/optimized/base.class.php`

**Context:**

```php
$post_types = array_diff( Post_Type::get_all_supported(), [ 'attachment' ] );

		/**
		 * @since 4.0.0
		 * @param array $post_types The supported post types.
		 */
		$post_types = (array) \apply_filters( 'the_seo_framework_sitemap_supported_post_types', $post_types );

		$non_hierarchical_post_types = [];
		$hierarchical_post_types     = [];
```

### the_seo_framework_sitemap_hpt_query_args
**File:** `autodescription/inc/classes/sitemap/optimized/base.class.php`

**Context:**

```php
$_hierarchical_posts_limit = Sitemap\Utils::get_sitemap_post_limit( 'hierarchical' );

			/**
			 * @since 4.0.0
			 * @since 5.0.5 1. Now sets orderby to 'lastmod', from 'date'.
			 *              2. Now sets order to 'DESC', from 'ASC'.
			 * @param array $args The query arguments.
			 * @link <https://w.org/support/topic/sitemap-and-memory-exhaustion/#post-13331896>
			 */
			$_args = (array) \apply_filters(
				'the_seo_framework_sitemap_hpt_query_args',
				[
					'posts_per_page' => $_hierarchical_posts_limit + \count( $_exclude_ids ),
					'post_type'      => $hierarchical_post_types,
					'orderby'        => 'lastmod',
					'order'          => 'DESC',
					'post_status'    => 'publish',
					'has_password'   => false,
					'fields'         => 'ids',
					'cache_results'  => false,
					'no_found_rows'  => true,
				],
			);

			if ( $_args['post_type'] ) {
				$wp_query->query = $wp_query->query_vars = $_args;
```

### the_seo_framework_sitemap_nhpt_query_args
**File:** `autodescription/inc/classes/sitemap/optimized/base.class.php`

**Context:**

```php
}

		if ( $non_hierarchical_post_types ) {
			/**
			 * @since 4.0.0
			 * @param array $args The query arguments.
			 */
			$_args = (array) \apply_filters(
				'the_seo_framework_sitemap_nhpt_query_args',
				[
					// phpcs:ignore, WordPress.WP.PostsPerPage -- This is a sitemap, it will be slow.
					'posts_per_page' => Sitemap\Utils::get_sitemap_post_limit( 'nonhierarchical' ),
					'post_type'      => $non_hierarchical_post_types,
					'orderby'        => 'lastmod',
					'order'          => 'DESC',
					'post_status'    => 'publish',
					'has_password'   => false,
					'fields'         => 'ids',
					'cache_results'  => false,
					'no_found_rows'  => true,
				],
			);

			if ( $_args['post_type'] ) {
				$wp_query->query = $wp_query->query_vars = $_args;
```

### the_seo_framework_sitemap_items
**File:** `autodescription/inc/classes/sitemap/optimized/base.class.php`

**Context:**

```php
// Destroy query instance.
		$wp_query = null;

		/**
		 * @since 4.1.0
		 * @param int[] $_items                    The post IDs that will be parsed in the sitemap.
		 *                                         When it totals for more than 49998 items, they'll be spliced.
		 * @param int[] $hierarchical_post_ids     The post IDs from hierarchical post types.
		 * @param int[] $non_hierarchical_post_ids The post IDs from non-hierarchical post types.
		 */
		$_items      = (array) \apply_filters(
			'the_seo_framework_sitemap_items',
			array_merge( $hierarchical_post_ids, $non_hierarchical_post_ids ),
			$hierarchical_post_ids,
			$non_hierarchical_post_ids,
		);
		$total_items = \count( $_items );

		// 49998 = 50000-2 (home+blog), max sitemap items.
```

### the_seo_framework_sitemap_extend
**File:** `autodescription/inc/classes/sitemap/optimized/base.class.php`

**Context:**

```php
}
		}

		/**
		 * This filter accepts a simple string, which may strain the memory usage if not generated (via co-routine).
		 *
		 * @since 2.5.2
		 * @since 4.0.0 Added $args parameter.
		 * @since 4.2.0 No longer forwards the 'show_priority' index in the second ($args) parameter.
		 * @param string $extend Custom sitemap extension. Must be escaped.
		 * @param array $args {
		 *     The sitemap extension arguments.
		 *
		 *     @type bool $show_modified Whether to display modified date.
		 *     @type int  $count         The total sitemap items before adding additional URLs.
		 * }
		 */
		$extend = (string) \apply_filters(
			'the_seo_framework_sitemap_extend',
			'',
			[
				'show_modified' => $show_modified,
				'count'         => $this->url_count,
			],
		);

		if ( $extend )
			$content .= "\t$extend\n";
```

### the_seo_framework_sitemap_blog_lastmod
**File:** `autodescription/inc/classes/sitemap/optimized/base.class.php`

**Context:**

```php
$_publish_post = $latests_posts[0]->post_date_gmt ?? '0000-00-00 00:00:00';
						$_lastmod_blog = $_values['lastmod']; // Inferred from generator generate_url_item_values()

						/**
						 * @since 4.1.1
						 * @param string $lastmod The lastmod time in SQL notation (`Y-m-d H:i:s`). Expected to explicitly follow that format!
						 */
						$_values['lastmod'] = (string) \apply_filters(
							'the_seo_framework_sitemap_blog_lastmod',
							strtotime( $_publish_post ) > strtotime( $_lastmod_blog )
								? $_publish_post
								: $_lastmod_blog,
						);
					}

					yield $_values;
```

### the_seo_framework_sitemap_additional_urls
**File:** `autodescription/inc/classes/sitemap/optimized/base.class.php`

**Context:**

```php
* }
	 */
	protected function generate_additional_base_urls( $args ) {
		/**
		 * @since 2.5.2
		 * @since 3.2.2 Invalid URLs are now skipped.
		 * @since 4.0.0 Added $args parameter.
		 * @since 4.2.0 No longer forwards the 'show_priority' index in the second ($args) parameter.
		 * @example return value: [ 'http://example.com' => [ 'lastmod' => '2024-04-10 14:52:06' ] ]
		 * @param array $custom_urls {
		 *     An array of custom URLs, keyed by the absolute url to the page.
		 *
		 *     @type string $lastmod UNIXTIME <GMT+0> Last modified date, e.g. "2016-01-26 13:04:55"
		 * }
		 * @param array $args {
		 *     The sitemap URL extension arguments.
		 *
		 *     @type bool $show_modified Whether to display modified date.
		 *     @type int  $count         Estimate: The total sitemap items before adding additional URLs.
		 * }
		 */
		$custom_urls = (array) \apply_filters( 'the_seo_framework_sitemap_additional_urls', [], $args );

		foreach ( $custom_urls as $url => $values ) {
			if ( ! \is_array( $values ) ) {
```

### the_seo_framework_indicator_sitemap
**File:** `autodescription/inc/classes/sitemap/optimized/xsl.class.php`

**Context:**

```php
* @access private
	 */
	public static function _print_xsl_footer() {
		/**
		 * @since 2.8.0
		 * @param bool $indicator
		 */
		\apply_filters( 'the_seo_framework_indicator_sitemap', true )
			and Template::output_view( 'sitemap/xsl/footer' );
	}

	/**
```

### the_seo_framework_sitemap_endpoint_list
**File:** `autodescription/inc/classes/sitemap/registry.class.php`

**Context:**

```php
*/
	public static function get_sitemap_endpoint_list() {
		return memo() ?? memo(
			/**
			 * @since 4.0.0
			 * @since 4.0.2 Made the endpoints' regex case-insensitive.
			 * @link Example: https://github.com/sybrew/tsf-term-sitemap
			 * @param array[] $list {
			 *     A list of sitemap endpoints keyed by ID.
			 *
			 *     @type string|false $lock_id  Optional. The cache key to use for locking. Defaults to index 'id'.
			 *                                  Set to false to disable locking.
			 *     @type string|false $cache_id Optional. The cache key to use for storing. Defaults to index 'id'.
			 *                                  Set to false to disable caching.
			 *     @type string       $endpoint The expected "pretty" endpoint, meant for administrative display.
			 *     @type string       $epregex  The endpoint regex, following the home path regex.
			 *                                  N.B. Be wary of case sensitivity. Append the i-flag.
			 *                                  N.B. Trailing slashes will cause the match to fail.
			 *                                  N.B. Use ASCII-endpoints only. Don't play with UTF-8 or translation strings.
			 *     @type callable     $callback The callback for the sitemap output.
			 *                                  Tip: You can pass arbitrary indexes. Prefix them with an underscore to ensure forward compatibility.
			 *                                  Tip: In the callback, use
			 *                                       `\The_SEO_Framework\Sitemap\Registry::get_sitemap_endpoint_list()[$sitemap_id]`
			 *                                       It returns the arguments you've passed in this filter; including your arbitrary indexes.
			 *     @type bool         $robots   Whether the endpoint should be mentioned in the robots.txt file.
			 * }
			 */
			(array) \apply_filters(
				'the_seo_framework_sitemap_endpoint_list',
				[
					'base'           => [
						'lock_id'  => 'base', // Example, real usage is with "index" using base.
						'cache_id' => 'base', // Example, real usage is with "index" using base.
						'endpoint' => 'sitemap.xml',
						'regex'    => '/^sitemap\.xml/i',
						'callback' => [ static::class, 'output_base_sitemap' ],
						'robots'   => true,
					],
					'index'          => [
						'lock_id'  => 'base',
						'cache_id' => 'base',
						'endpoint' => 'sitemap_index.xml',
						'regex'    => '/^sitemap_index\.xml/i',
						'callback' => [ static::class, 'output_base_sitemap' ],
						'robots'   => false,
					],
					'xsl-stylesheet' => [
						'lock_id'  => false,
						'cache_id' => false,
						'endpoint' => 'sitemap.xsl',
						'regex'    => '/^sitemap\.xsl/i',
						'callback' => [ static::class, 'output_stylesheet' ],
						'robots'   => false,
					],
				],
			),
		);
	}

	/**
```

### the_seo_framework_sitemap_post_limit
**File:** `autodescription/inc/classes/sitemap/utils.class.php`

**Context:**

```php
* @return int The post limit
	 */
	public static function get_sitemap_post_limit( $type = 'nonhierarchical' ) {
		/**
		 * @since 2.2.9
		 * @since 2.8.0 Increased to 1200 from 700.
		 * @since 3.1.0 Now returns an option value; it falls back to the default value if not set.
		 * @since 4.0.0 1. The default is now 3000, from 1200.
		 *              2. Now passes a second parameter.
		 * @param int $total_post_limit
		 * @param bool $hierarchical Whether the query is for hierarchical post types or not.
		 */
		return (int) \apply_filters(
			'the_seo_framework_sitemap_post_limit',
			Data\Plugin::get_option( 'sitemap_query_limit' ),
			'hierarchical' === $type,
		);
	}

	/**
```

### the_seo_framework_sitemap_exclude_ids
**File:** `autodescription/inc/classes/sitemap/utils.class.php`

**Context:**

```php
static $excluded;

		if ( ! isset( $excluded ) ) {
			/**
			 * @since 2.5.2
			 * @since 2.8.0 No longer accepts '0' as entry.
			 * @since 3.1.0 '0' is accepted again.
			 * @param int[] $excluded Sequential list of excluded IDs: [ int ...post_id ]
			 */
			$excluded = (array) \apply_filters( 'the_seo_framework_sitemap_exclude_ids', [] );

			// isset() is faster than in_array(). And since we memoize, it's faster to flip.
			$excluded = $excluded ? array_flip( $excluded ) : [];
```

### the_seo_framework_sitemap_exclude_term_ids
**File:** `autodescription/inc/classes/sitemap/utils.class.php`

**Context:**

```php
static $excluded;

		if ( ! isset( $excluded ) ) {
			/**
			 * @since 4.0.0
			 * @param int[] $excluded Sequential list of excluded IDs: [ int ...term_id ]
			 */
			$excluded = (array) \apply_filters( 'the_seo_framework_sitemap_exclude_term_ids', [] );

			// isset() is faster than in_array(). And since we memoize, it's faster to flip.
			$excluded = $excluded ? array_flip( $excluded ) : [];
```

### wp_sitemaps_posts_pre_url_list
**File:** `autodescription/inc/classes/sitemap/wp/posts.class.php`

**Context:**

```php
if ( ! isset( $supported_types[ $post_type ] ) )
			return [];

		/**
		 * Filters the posts URL list before it is generated.
		 *
		 * Passing a non-null value will effectively short-circuit the generation,
		 * returning that value instead.
		 *
		 * @since WP Core 5.5.0
		 *
		 * @param array  $url_list  The URL list. Default null.
		 * @param string $post_type Post type name.
		 * @param int    $page_num  Page of results.
		 */
		$url_list = \apply_filters(
			'wp_sitemaps_posts_pre_url_list',
			null,
			$post_type,
			$page_num,
		);

		if ( null !== $url_list )
			return $url_list;
```

### wp_sitemaps_posts_show_on_front_entry
**File:** `autodescription/inc/classes/sitemap/wp/posts.class.php`

**Context:**

```php
}
				}

				/**
				 * Filters the sitemap entry for the home page when the 'show_on_front' option equals 'posts'.
				 *
				 * @since WP Core 5.5.0
				 *
				 * @param array $sitemap_entry Sitemap entry for the home page.
				 */
				$sitemap_entry = \apply_filters( 'wp_sitemaps_posts_show_on_front_entry', $sitemap_entry );
				$url_list[]    = $sitemap_entry;
			}
		}
```

### wp_sitemaps_posts_entry
**File:** `autodescription/inc/classes/sitemap/wp/posts.class.php`

**Context:**

```php
}
			}

			/**
			 * Filters the sitemap entry for an individual post.
			 *
			 * @since WP Core 5.5.0
			 *
			 * @param array   $sitemap_entry Sitemap entry for the post.
			 * @param WP_Post $post          Post object.
			 * @param string  $post_type     Name of the post_type.
			 */
			$sitemap_entry = \apply_filters( 'wp_sitemaps_posts_entry', $sitemap_entry, $post, $post_type );
			$url_list[]    = $sitemap_entry;
		}
```

### wp_sitemaps_taxonomies_pre_url_list
**File:** `autodescription/inc/classes/sitemap/wp/taxonomies.class.php`

**Context:**

```php
if ( ! isset( $supported_types[ $taxonomy ] ) )
			return [];

		/**
		 * Filters the taxonomies URL list before it is generated.
		 *
		 * Passing a non-null value will effectively short-circuit the generation,
		 * returning that value instead.
		 *
		 * @since WP Core 5.5.0
		 *
		 * @param array  $url_list The URL list. Default null.
		 * @param string $taxonomy Taxonomy name.
		 * @param int    $page_num Page of results.
		 */
		$url_list = \apply_filters(
			'wp_sitemaps_taxonomies_pre_url_list',
			null,
			$taxonomy,
			$page_num,
		);

		if ( null !== $url_list )
			return $url_list;
```

### wp_sitemaps_taxonomies_entry
**File:** `autodescription/inc/classes/sitemap/wp/taxonomies.class.php`

**Context:**

```php
'loc' => $term_link,
			];

			/**
			 * Filters the sitemap entry for an individual term.
			 *
			 * @since WP Core 5.5.0
			 * @since WP Core 6.0.0 Added `$term` argument containing the term object.
			 *
			 * @param array   $sitemap_entry Sitemap entry for the term.
			 * @param int     $term_id       Term ID.
			 * @param string  $taxonomy      Taxonomy name.
			 * @param WP_Term $term          Term object.
			 */
			$sitemap_entry = \apply_filters( 'wp_sitemaps_taxonomies_entry', $sitemap_entry, $term->term_id, $taxonomy, $term );
			$url_list[]    = $sitemap_entry;
		}
```

### bbp_raw_title_array
**File:** `autodescription/inc/compat/plugin-bbpress.php`

**Context:**

```php
} elseif ( \bbp_is_search() ) {
		$new_title['text'] = \bbp_get_search_title();
	}

	// This filter is deprecated. Use 'bbp_before_title_parse_args' instead.
	$new_title = \apply_filters( 'bbp_raw_title_array', $new_title );

	// Set title array defaults
	$new_title = \bbp_parse_args(
```

### bbp_raw_title
**File:** `autodescription/inc/compat/plugin-bbpress.php`

**Context:**

```php
// Get the formatted raw title
	$new_title = \sprintf( $new_title['format'], $new_title['text'] );

	// Filter the raw title.
	$new_title = \apply_filters( 'bbp_raw_title', $new_title, $sep = '&raquo;', $seplocation = '' ); // phpcs:ignore,VariableAnalysis -- readability.

	// Compare new title with original title
	if ( $new_title === $title ) {
		return $title;
	}

	// phpcs:enable, Squiz.Commenting.BlockComment, Generic.WhiteSpace.ScopeIndent, WordPress.WP.I18n, Generic.Formatting.MultipleStatementAlignment -- Not my code.
```

### the_seo_framework_breadcrumb_shortcode_css
**File:** `autodescription/inc/functions/api.php`

**Context:**

```php
HTML;
		}

		/**
		 * @since 5.0.0
		 * @param array  $css   The CSS selectors and their attributes.
		 * @param string $class The class name of the breadcrumb wrapper.
		 */
		$css = (array) apply_filters(
			'the_seo_framework_breadcrumb_shortcode_css',
			[
				"nav.$class ol"                            => [
					'display:inline',
					'list-style:none',
					'margin-inline-start:0',
				],
				"nav.$class ol li"                         => [ // We could combine it the above; but this is easier for other devs.
					'display:inline',
				],
				"nav.$class ol li:not(:last-child)::after" => [
					"content:'$sep'",
					'margin-inline-end:1ch',
					'margin-inline-start:1ch',
				],
			],
			$class,
		);

		$styles = '';
```

### the_seo_framework_breadcrumb_shortcode_output
**File:** `autodescription/inc/functions/api.php`

**Context:**

```php
<nav aria-label="Breadcrumb" class="$class"><ol>$html</ol></nav>
			HTML;

		/**
		 * @since 5.0.0
		 * @param string $output The entire breadcrumb navigation element output.
		 * @param array  $crumbs The breadcrumbs found.
		 * @param string $nav    The breadcrumb navigation element.
		 * @param string $style  The CSS style element appended.
		 */
		return apply_filters(
			'the_seo_framework_breadcrumb_shortcode_output',
			"$nav$style",
			$crumbs,
			$nav,
			$style,
		);
	}
}
```

### the_seo_framework_inpost_settings_tabs
**File:** `autodescription/inc/views/post/settings.php`

**Context:**

```php
],
		];

		/**
		 * Allows for altering the inpost SEO settings meta box tabs.
		 *
		 * @since 2.9.0
		 * @since 4.0.0 Removed the second parameter (post type label)
		 *
		 * @param array $default_tabs The default tabs.
		 * @param null  $depr         The post type label. Deprecated.
		 */
		$tabs = (array) \apply_filters( 'the_seo_framework_inpost_settings_tabs', $default_tabs, null );

		echo '<div class="tsf-flex tsf-flex-inside-wrap">';
		Admin\Settings\Post::flex_nav_tab_wrapper( 'inpost', $tabs );
```

### the_seo_framework_auto_description_html_method_methods
**File:** `autodescription/inc/views/settings/metaboxes/description.php`

**Context:**

```php
\__( 'The HTML content of your pages can be used to generate descriptions. The generator processes this HTML in passing layers to understand the layout. If the HTML is complex, not all layers may be processed, and you might find spaces missing between sentences. Increasing the maximum number of passes reduces the chance of this happening, but at the cost of performance.', 'autodescription' )
		);

		/**
		 * @since 5.0.0
		 * @param array $html_passes_method The HTML pass option by [ 'option_value' => 'Name' ]
		 */
		$html_passes_methods = (array) \apply_filters(
			'the_seo_framework_auto_description_html_method_methods',
			[
				'fast'     => \__( 'Fast (max. 2 passes)', 'autodescription' ),
				'accurate' => \__( 'Accurate (max. 6 passes)', 'autodescription' ),
				'thorough' => \__( 'Thorough (max. 12 passes)', 'autodescription' ),
			],
		);

		$html_passes_select_options = '';
		$_current                   = Data\Plugin::get_option( 'auto_description_html_method' );
```

### the_seo_framework_general_settings_tabs
**File:** `autodescription/inc/views/settings/metaboxes/general.php`

**Context:**

```php
Admin\Settings\Plugin::nav_tab_wrapper(
			'general',
			/**
			 * @since 2.8.0
			 * @param array $tabs The default tabs.
			 */
			(array) \apply_filters( 'the_seo_framework_general_settings_tabs', $tabs )
		);
		break;

	case 'layout':
```

### the_seo_framework_query_alteration_types
**File:** `autodescription/inc/views/settings/metaboxes/general.php`

**Context:**

```php
. '<br>' .
			\esc_html__( 'Altering the query on the site is much faster, but can lead to inconsistent pagination. It can also lead to 404 error messages if all queried pages have been excluded.', 'autodescription' )
		);

		$query_types = (array) \apply_filters(
			'the_seo_framework_query_alteration_types',
			[
				'in_query'   => \_x( 'In the database', 'Perform query alteration: In the database', 'autodescription' ),
				'post_query' => \_x( 'On the site', 'Perform query alteration: On the site', 'autodescription' ),
			],
		);

		$search_query_select_options = '';
		$_current                    = Data\Plugin::get_option( 'alter_search_query_type' );
```

### the_seo_framework_canonical_scheme_types
**File:** `autodescription/inc/views/settings/metaboxes/general.php`

**Context:**

```php
$scheme_options  = '';
		$detected_scheme = Meta\URI\Utils::detect_site_url_scheme();
		$current_scheme  = Data\Plugin::get_option( 'canonical_scheme' );
		$scheme_types    = (array) \apply_filters(
			'the_seo_framework_canonical_scheme_types',
			[
				'automatic' => \sprintf(
					/* translators: %s = HTTP or HTTPS */
					\__( 'Detect automatically (%s)', 'autodescription' ),
					strtoupper( $detected_scheme ),
				),
				'http'      => 'HTTP',
				'https'     => 'HTTPS',
			],
		);
		foreach ( $scheme_types as $value => $name ) {
			$scheme_options .= \sprintf(
				'<option value="%s" %s>%s</option>',
```

### the_seo_framework_homepage_settings_tabs
**File:** `autodescription/inc/views/settings/metaboxes/homepage.php`

**Context:**

```php
Admin\Settings\Plugin::nav_tab_wrapper(
			'homepage',
			/**
			 * @since 2.6.0
			 * @param array $tabs The default tabs.
			 */
			(array) \apply_filters( 'the_seo_framework_homepage_settings_tabs', $tabs )
		);
		break;

	case 'general':
```

### the_seo_framework_post_type_archive_settings_tabs
**File:** `autodescription/inc/views/settings/metaboxes/post-type-archive.php`

**Context:**

```php
Admin\Settings\Plugin::nav_tab_wrapper(
						"post_type_archive_{$post_type}",
						/**
						 * @since 4.2.0
						 * @param array   $tabs      The default tabs.
						 * @param strring $post_type The post type archive's name.
						 */
						(array) \apply_filters(
							'the_seo_framework_post_type_archive_settings_tabs',
							$tabs,
							$post_type,
						)
					);
					?>
```

### the_seo_framework_robots_settings_tabs
**File:** `autodescription/inc/views/settings/metaboxes/robots.php`

**Context:**

```php
Admin\Settings\Plugin::nav_tab_wrapper(
			'robots',
			/**
			 * @since 2.2.4
			 * @param array $tabs The default tabs.
			 */
			(array) \apply_filters( 'the_seo_framework_robots_settings_tabs', $tabs )
		);
		break;

	case 'general':
```

### the_seo_framework_schema_settings_tabs
**File:** `autodescription/inc/views/settings/metaboxes/schema.php`

**Context:**

```php
Admin\Settings\Plugin::nav_tab_wrapper(
			'schema',
			/**
			 * @since 2.8.0
			 * @since 5.0.0 Removed the 'structure' index and added the 'general' index.
			 * @param array $defaults The default tabs.
			 */
			(array) \apply_filters( 'the_seo_framework_schema_settings_tabs', $tabs )
		);
		break;

	case 'general':
```

### the_seo_framework_knowledge_types
**File:** `autodescription/inc/views/settings/metaboxes/schema.php`

**Context:**

```php
<?php
				$knowledge_type = (array) \apply_filters(
					'the_seo_framework_knowledge_types',
					[
						'organization' => \__( 'An Organization', 'autodescription' ),
						'person'       => \__( 'A Person', 'autodescription' ),
					],
				);
				$_current       = Data\Plugin::get_option( 'knowledge_type' );
				foreach ( $knowledge_type as $value => $name )
					printf(
```

### the_seo_framework_sitemaps_settings_tabs
**File:** `autodescription/inc/views/settings/metaboxes/sitemaps.php`

**Context:**

```php
Admin\Settings\Plugin::nav_tab_wrapper(
			'sitemaps',
			/**
			 * @since 2.6.0
			 * @param array $tabs The default tabs.
			 */
			(array) \apply_filters( 'the_seo_framework_sitemaps_settings_tabs', $tabs )
		);
		break;

	case 'general':
```

### the_seo_framework_social_settings_tabs
**File:** `autodescription/inc/views/settings/metaboxes/social.php`

**Context:**

```php
Admin\Settings\Plugin::nav_tab_wrapper(
			'social',
			/**
			 * @since 2.2.2
			 * @param array $defaults The default tabs.
			 */
			(array) \apply_filters( 'the_seo_framework_social_settings_tabs', $tabs )
		);
		break;

	case 'general':
```

### the_seo_framework_title_settings_tabs
**File:** `autodescription/inc/views/settings/metaboxes/title.php`

**Context:**

```php
Admin\Settings\Plugin::nav_tab_wrapper(
			'title',
			/**
			 * @since 2.6.0
			 * @param array $tabs The default tabs.
			 */
			(array) \apply_filters( 'the_seo_framework_title_settings_tabs', $tabs )
		);
		break;

	case 'general':
```

### the_seo_framework_sitemap_logo
**File:** `autodescription/inc/views/sitemap/xsl/description.php`

**Context:**

```php
$id   = Data\Plugin::get_option( 'sitemap_logo_id' ) ?: \get_theme_mod( 'custom_logo' ) ?: \get_option( 'site_icon' );
	$_src = $id ? \wp_get_attachment_image_src( $id, [ 29, 29 ] ) : []; // Magic number "SITEMAP_LOGO_PX"

	/**
	 * @since 2.8.0
	 * @param array $_src {
	 *     An empty array or the logo details.
	 *
	 *     @type string $0 The image URL.
	 *     @type int    $1 The width in pixels.
	 *     @type int    $2 The height in pixels.
	 * }
	 */
	$_src = (array) \apply_filters( 'the_seo_framework_sitemap_logo', $_src );

	if ( ! empty( $_src[0] ) ) {
		$logo = \sprintf(
```

### the_seo_framework_sitemap_styles
**File:** `autodescription/inc/views/sitemap/xsl/styles.php`

**Context:**

```php
<?php
// phpcs:disable, WordPress.Security.EscapeOutput
/**
 * @since 3.1.0
 * @param string $styles The sitemap XHTML styles. Must be escaped.
 */
echo Minify::css( \apply_filters( 'the_seo_framework_sitemap_styles', $styles ) );
// phpcs:enable, WordPress.Security.EscapeOutput
?>
```

### the_seo_framework_sitemap_color_main
**File:** `autodescription/inc/views/sitemap/xsl/vars.php`

**Context:**

```php
printf(
	'<xsl:variable name="colorMain" select="\'%s\'"/>',
	'#' . Sanitize::rgb_hex(
		/**
		 * @since 2.8.0
		 * @since 3.1.0 It now filters the mail color, instead of accent.
		 * @param string $colorMain A hexadecimal color.
		 */
		\apply_filters( 'the_seo_framework_sitemap_color_main', $colors['main'] )
	)
);
printf(
	'<xsl:variable name="colorAccent" select="\'%s\'"/>',
	'#' . Sanitize::rgb_hex(
```

### the_seo_framework_sitemap_color_accent
**File:** `autodescription/inc/views/sitemap/xsl/vars.php`

**Context:**

```php
printf(
	'<xsl:variable name="colorAccent" select="\'%s\'"/>',
	'#' . Sanitize::rgb_hex(
		/**
		 * @since 2.8.0
		 * @since 3.1.0 It now filters the accent color, instead of main.
		 * @param string $colorAccent A hexadecimal color.
		 */
		\apply_filters( 'the_seo_framework_sitemap_color_accent', $colors['accent'] )
	)
);
printf(
	'<xsl:variable name="relativeFontColor" select="\'%s\'"/>',
	'#' . Sanitize::rgb_hex(
```

### the_seo_framework_sitemap_relative_font_color
**File:** `autodescription/inc/views/sitemap/xsl/vars.php`

**Context:**

```php
printf(
	'<xsl:variable name="relativeFontColor" select="\'%s\'"/>',
	'#' . Sanitize::rgb_hex(
		/**
		 * @since 2.8.0
		 * @param string $relativeFontColor A hexadecimal color.
		 */
		\apply_filters(
			'the_seo_framework_sitemap_relative_font_color',
			Format\Color::get_relative_fontcolor( $colors['main'] )
		)
	)
);
// phpcs:enable, WordPress.Security.EscapeOutput.OutputNotEscaped
```

## Actions (29)

### the_seo_framework_do_downgrade
**File:** `autodescription/bootstrap/upgrade.php`

**Context:**

```php
// Don't run the upgrade cycle if the user downgraded. Downgrade, instead.
	if ( $previous_version > \THE_SEO_FRAMEWORK_DB_VERSION ) {
		// Novel idea: Allow webmasters to register custom upgrades. Maybe later. See file PHPDoc's TODO.
		// If we do, add it in function _downgrade()'s loop instead.
		// \do_action( 'the_seo_framework_do_downgrade', $previous_version, \THE_SEO_FRAMEWORK_DB_VERSION );

		$current_version = _downgrade( $previous_version );
```

### the_seo_framework_downgraded
**File:** `autodescription/bootstrap/upgrade.php`

**Context:**

```php
$current_version = _downgrade( $previous_version );

		/**
		 * @since 4.1.0
		 * @internal
		 * @param string $previous_version The previous version the site downgraded from, if any.
		 * @param string $current_version  The current version of the site.
		 */
		\do_action( 'the_seo_framework_downgraded', (string) $previous_version, (string) $current_version );
	} else {
		// Novel idea: Allow webmasters to register custom upgrades. Maybe later. See file PHPDoc's TODO.
		// If we do, add it in function _upgrade()'s loop instead.
```

### the_seo_framework_do_upgrade
**File:** `autodescription/bootstrap/upgrade.php`

**Context:**

```php
*/
		\do_action( 'the_seo_framework_downgraded', (string) $previous_version, (string) $current_version );
	} else {
		// Novel idea: Allow webmasters to register custom upgrades. Maybe later. See file PHPDoc's TODO.
		// If we do, add it in function _upgrade()'s loop instead.
		// \do_action( 'the_seo_framework_do_upgrade', $previous_version, \THE_SEO_FRAMEWORK_DB_VERSION );

		$current_version = _upgrade( $previous_version );
```

### the_seo_framework_upgraded
**File:** `autodescription/bootstrap/upgrade.php`

**Context:**

```php
$current_version = _upgrade( $previous_version );

		/**
		 * @since 2.7.0
		 * @since 4.1.0 Added first parameter, $previous_version
		 * @internal
		 * @param string $previous_version The previous version the site upgraded from, if any.
		 * @param string $current_version The current version of the site.
		 */
		\do_action( 'the_seo_framework_upgraded', (string) $previous_version, (string) $current_version );
	}
}
```

### wp_ajax_crop_image_pre_save
**File:** `autodescription/inc/classes/admin/script/ajax.class.php`

**Context:**

```php
switch ( $context ) {
			case 'tsf-image':
				/**
				 * Fires before a cropped image is saved.
				 *
				 * Allows to add filters to modify the way a cropped image is saved.
				 *
				 * @since 5.0.0 WordPress Core
				 *
				 * @param string $context       The Customizer control requesting the cropped image.
				 * @param int    $attachment_id The attachment ID of the original image.
				 * @param string $cropped       Path to the cropped image file.
				 */
				\do_action( 'wp_ajax_crop_image_pre_save', $context, $attachment_id, $cropped );

				/** This filter is documented in wp-admin/includes/class-custom-image-header.php */
				$cropped = \apply_filters( 'wp_create_file_in_uploads', $cropped, $attachment_id ); // For replication.
```

### the_seo_framework_prepare_seo_bar
**File:** `autodescription/inc/classes/admin/seobar/builder.class.php`

**Context:**

```php
? Builder\Term::get_instance()
			: Builder\Page::get_instance();

		/**
		 * Adjust interpreter and builder items here, before the tests have run.
		 *
		 * The only use we can think of here is removing items from `$builder::$tests`,
		 * and reading `$builder::$query{_cache}`. Do not add tests here. Do not alter the query.
		 *
		 * @link Example: https://gist.github.com/sybrew/03dd428deadc860309879e1d5208e1c4
		 * @see related (recommended) action 'the_seo_framework_seo_bar'
		 * @since 4.0.0
		 * @param string                                       $interpreter The current class name.
		 * @param \The_SEO_Framework\Admin\SEOBar\Builder\Main $builder     The builder object.
		 */
		\do_action( 'the_seo_framework_prepare_seo_bar', static::class, $builder );

		$items = &static::collect_seo_bar_items();
```

### the_seo_framework_seo_bar
**File:** `autodescription/inc/classes/admin/seobar/builder.class.php`

**Context:**

```php
foreach ( $builder->run_all_tests( $query ) as $key => $data )
			$items[ $key ] = $data;

		/**
		 * Add or adjust SEO Bar items here, after the tests have run.
		 *
		 * @link Example: https://gist.github.com/sybrew/59130560fcbeb98f7580dc11c54ba174
		 * @since 4.0.0
		 * @since 5.0.0 Added the builder's instance as the third parameter.
		 * @param string $interpreter The interpreter class name.
		 * @param object $builder     The builder's class instance.
		 */
		\do_action( 'the_seo_framework_seo_bar', static::class, $builder );

		$bar = static::create_seo_bar( static::$items );
```

### the_seo_framework_before_redirect
**File:** `autodescription/inc/classes/front/redirect.class.php`

**Context:**

```php
$url = Meta\URI::get_redirect_url();

		if ( $url ) {
			/**
			 * @since 4.1.2
			 * @param string $url The URL we're redirecting to.
			 */
			\do_action( 'the_seo_framework_before_redirect', $url );

			static::do_redirect( $url );
		}
```

### deprecated_function_run
**File:** `autodescription/inc/classes/internal/debug.class.php`

**Context:**

```php
*                             Expected to be escaped.
	 */
	public static function _deprecated_function( $function, $version, $replacement = null ) { // phpcs:ignore -- Wrong asserts, copied method name.
		/**
		 * Fires when a deprecated function is called.
		 *
		 * @since WP Core 2.5.0
		 *
		 * @param string $function    The function that was called.
		 * @param string $replacement The function that should have been called.
		 * @param string $version     The version of WordPress that deprecated the function.
		 */
		\do_action( 'deprecated_function_run', $function, $replacement, $version );

		/**
		 * Filter whether to trigger an error for deprecated functions.
```

### doing_it_wrong_run
**File:** `autodescription/inc/classes/internal/debug.class.php`

**Context:**

```php
* @param string $version  The version of WordPress where the message was added.
	 */
	public static function _doing_it_wrong( $function, $message, $version = null ) { // phpcs:ignore -- Wrong asserts, copied method name.
		/**
		 * Fires when the given function is being used incorrectly.
		 *
		 * @since WP Core 3.1.0
		 *
		 * @param string $function The function that was called.
		 * @param string $message  A message explaining what has been done incorrectly.
		 * @param string $version  The version of WordPress where the message was added.
		 */
		\do_action( 'doing_it_wrong_run', $function, $message, $version );

		/**
		 * @since WP Core 3.1.0
```

### the_seo_framework_inaccessible_p_or_m_run
**File:** `autodescription/inc/classes/internal/debug.class.php`

**Context:**

```php
*/
	public static function _inaccessible_p_or_m( $p_or_m, $message = '', $handle = 'tsf()' ) {

		/**
		 * Fires when the inaccessible property or method is being used.
		 *
		 * @since 2.7.0
		 *
		 * @param string $p_or_m  The Property or Method.
		 * @param string $message A message explaining what has been done incorrectly.
		 */
		\do_action( 'the_seo_framework_inaccessible_p_or_m_run', $p_or_m, $message );

		/**
		 * Filter whether to trigger an error for _doing_it_wrong() calls.
```

### the_seo_framework_build_sitemap_base
**File:** `autodescription/inc/classes/sitemap/optimized/base.class.php`

**Context:**

```php
*/
	public function build_sitemap() {

		/**
		 * @since 4.2.7
		 * @param \The_SEO_Framework\Sitemap\Optimized\Base
		 */
		\do_action( 'the_seo_framework_build_sitemap_base', $this );

		$content         = '';
		$this->url_count = 0;
```

### the_seo_framework_sitemap_header
**File:** `autodescription/inc/classes/sitemap/registry.class.php`

**Context:**

```php
*/
		static::clean_up_globals();

		/**
		 * @since 4.0.0
		 * @param string $sitemap_id The sitemap ID. See `static::get_sitemap_endpoint_list()`.
		 */
		\do_action( 'the_seo_framework_sitemap_header', $sitemap_id );

		\call_user_func( static::get_sitemap_endpoint_list()[ $sitemap_id ]['callback'], $sitemap_id );
	}
```

### the_seo_framework_sitemap_transient_cleared
**File:** `autodescription/inc/classes/sitemap/registry.class.php`

**Context:**

```php
Cache::clear_sitemap_caches();

		/**
		 * @since 4.1.1
		 * @since 5.0.5 Removed indexes `ping_use_cron` and `ping_use_cron_prerender`.
		 * @param array $deprecated Deprecated; do not use the first parameter.
		 */
		\do_action( 'the_seo_framework_sitemap_transient_cleared', [] );

		Cron::schedule_single_event();
```

### the_seo_framework_before_bulk_edit
**File:** `autodescription/inc/views/list/bulk-post.php`

**Context:**

```php
<?php
	/**
	 * @since 4.0.5
	 * @param string $post_type The current post type.
	 * @param string $taxonomy  The current taxonomy type (if any).
	 */
	\do_action( 'the_seo_framework_before_bulk_edit', $post_type, $taxonomy );
	?>
```

### the_seo_framework_after_bulk_edit
**File:** `autodescription/inc/views/list/bulk-post.php`

**Context:**

```php
<?php
	/**
	 * @since 4.0.5
	 * @param string $post_type The current post type.
	 * @param string $taxonomy  The current taxonomy type (if any).
	 */
	\do_action( 'the_seo_framework_after_bulk_edit', $post_type, $taxonomy );
	?>
```

### the_seo_framework_before_quick_edit
**File:** `autodescription/inc/views/list/quick-post.php`

**Context:**

```php
<?php
	/**
	 * @since 4.0.5
	 * @param string $post_type The post type slug, or current screen name if this is a taxonomy list table.
	 * @param string $taxonomy  The current taxonomy type (if any).
	 */
	\do_action( 'the_seo_framework_before_quick_edit', $post_type, $taxonomy );
	?>
```

### the_seo_framework_after_quick_edit
**File:** `autodescription/inc/views/list/quick-post.php`

**Context:**

```php
</div>
	</fieldset>
	<?php
	/**
	 * @since 4.0.5
	 * @param string $post_type The post type slug, or current screen name if this is a taxonomy list table.
	 * @param string $post_type The current taxonomy type (if any).
	 */
	\do_action( 'the_seo_framework_after_quick_edit', $post_type, $taxonomy );
	?>
```

### the_seo_framework_flex_tab_content
**File:** `autodescription/inc/views/post/wrap-content.php`

**Context:**

```php
if ( ! empty( $args['callback'] ) )
			\call_user_func_array( $args['callback'], ( $args['args'] ?? [] ) );

		/**
		 * @since 4.2.0
		 * @since 5.1.0 Renamed 'params' to 'args'.
		 * @param array $args {
		 *     The tab creation data.
		 *
		 *     @type string $id     The nav-tab ID.
		 *     @type string $tab    The tab name.
		 *     @type array  $params {
		 *         The tab creation arguments.
		 *
		 *         @type string   $name     Tab name.
		 *         @type callable $callback Output function.
		 *         @type string   $dashicon The dashicon to use.
		 *         @type mixed    $args     Optional callback function args. These arguments
		 *                                  will be extracted to variables in scope of the view.
		 *     }
		 * }
		 */
		\do_action(
			'the_seo_framework_flex_tab_content',
			[
				'id'   => $id,
				'tab'  => $tab,
				'args' => $args,
			],
		);
	?>
```

### the_seo_framework_before_siteadmin_metaboxes
**File:** `autodescription/inc/views/settings/columns.php`

**Context:**

```php
<?php
		\do_action( 'the_seo_framework_before_siteadmin_metaboxes', $hook_name );

		\do_meta_boxes( $hook_name, 'main', null );
```

### the_seo_framework_after_siteadmin_metaboxes
**File:** `autodescription/inc/views/settings/columns.php`

**Context:**

```php
if ( isset( $GLOBALS['wp_meta_boxes'][ $hook_name ]['main_extra'] ) )
			\do_meta_boxes( $hook_name, 'main_extra', null );

		\do_action( 'the_seo_framework_after_siteadmin_metaboxes', $hook_name );
		?>
```

### the_seo_framework_before_siteadmin_metaboxes_side
**File:** `autodescription/inc/views/settings/columns.php`

**Context:**

```php
<?php
		\do_action( 'the_seo_framework_before_siteadmin_metaboxes_side', $hook_name );

		/**
		 * @TODO fill this in...? Is this even styled?
```

### the_seo_framework_after_siteadmin_metaboxes_side
**File:** `autodescription/inc/views/settings/columns.php`

**Context:**

```php
<?php
		\do_action( 'the_seo_framework_before_siteadmin_metaboxes_side', $hook_name );

		/**
		 * @TODO fill this in...? Is this even styled?
		 */

		\do_action( 'the_seo_framework_after_siteadmin_metaboxes_side', $hook_name );
		?>
```

### the_seo_framework_tab_content
**File:** `autodescription/inc/views/settings/wrap-content.php`

**Context:**

```php
if ( ! empty( $args['callback'] ) )
			\call_user_func_array( $args['callback'], [ ( $args['args'] ?? [] ) ] );

		/**
		 * @since 4.2.0
		 * @since 5.0.0 Renamed 'params' to 'args'.
		 * @param array $args {
		 *     The tab creation data.
		 *
		 *     @type string $id   The nav-tab ID.
		 *     @type string $tab  The tab name.
		 *     @type array  $args {
		 *         The tab creation arguments.
		 *
		 *         @type string   $name     Tab name.
		 *         @type callable $callback Output function.
		 *         @type string   $dashicon The dashicon to use.
		 *         @type mixed    $args     Optional callback function args. These arguments
		 *                                  will be extracted to variables in scope of the view.
		 *    }
		 * }
		 */
		\do_action(
			'the_seo_framework_tab_content',
			[
				'id'   => $id,
				'tab'  => $tab,
				'args' => $args,
			],
		);
	?>
```

### {$hook_name}_settings_page_boxes
**File:** `autodescription/inc/views/settings/wrap.php`

**Context:**

```php
<?php
		\do_action( "{$hook_name}_settings_page_boxes", $hook_name );
		?>
```

### the_seo_framework_xsl_head
**File:** `autodescription/inc/views/sitemap/xsl-stylesheet.php`

**Context:**

```php
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
				<meta name="viewport" content="width=device-width, initial-scale=1" />
				<?php
				/**
				 * @since 3.1.0
				 * @param \The_SEO_Framework\Load Alias of `tsf()`
				 * @TODO 5.1.0 Remove first parameter. It's useless now.
				 */
				\do_action( 'the_seo_framework_xsl_head', \tsf() );
				?>
```

### the_seo_framework_xsl_description
**File:** `autodescription/inc/views/sitemap/xsl-stylesheet.php`

**Context:**

```php
<?php
						/**
						 * @since 3.1.0
						 * @param \The_SEO_Framework\Load Alias of `tsf()`
						 * @TODO 5.1.0 Remove first parameter. It's useless now.
						 */
						\do_action( 'the_seo_framework_xsl_description', \tsf() );
						?>
```

### the_seo_framework_xsl_content
**File:** `autodescription/inc/views/sitemap/xsl-stylesheet.php`

**Context:**

```php
<?php
						/**
						 * @since 3.1.0
						 * @param \The_SEO_Framework\Load Alias of `tsf()`
						 * @TODO 5.1.0 Remove first parameter. It's useless now.
						 */
						\do_action( 'the_seo_framework_xsl_content', \tsf() );
						?>
```

### the_seo_framework_xsl_footer
**File:** `autodescription/inc/views/sitemap/xsl-stylesheet.php`

**Context:**

```php
<?php
						/**
						 * @since 3.1.0
						 * @param \The_SEO_Framework\Load Alias of `tsf()`
						 * @TODO 5.1.0 Remove first parameter. It's useless now.
						 */
						\do_action( 'the_seo_framework_xsl_footer', \tsf() );
						?>
```

