## Filters (130)

### rank_math/admin/dashboard_nav_links
**File:** `seo-by-rank-math/includes/admin/class-admin-dashboard-nav.php`

**Context:**

```php
if ( is_network_admin() ) {
			$links = [];
		}

		return apply_filters( 'rank_math/admin/dashboard_nav_links', $links );
	}
}
```

### rank_math/registration/do_url_check
**File:** `seo-by-rank-math/includes/admin/class-admin-helper.php`

**Context:**

```php
return false;
		}

		/**
		 * Filter whether we need to check for URL mismatch or not.
		 */
		$do_url_check = apply_filters( 'rank_math/registration/do_url_check', ! get_option( 'rank_math_siteurl_mismatch_notice_dismissed' ) );
		if ( $do_url_check && isset( $options['site_url'] ) && Helper::get_home_url() !== $options['site_url'] ) {
			$message = esc_html__( 'Seems like your site URL has changed since you connected to Rank Math.', 'rank-math' ) . ' <a href="' . self::get_activate_url() . '">' . esc_html__( 'Click here to reconnect.', 'rank-math' ) . '</a>';
			Helper::add_notification(
```

### rank_math/license/activate_url
**File:** `seo-by-rank-math/includes/admin/class-admin-helper.php`

**Context:**

```php
'site' => rawurlencode( home_url() ),
			'r'    => rawurlencode( $redirect_to ),
		];

		return apply_filters(
			'rank_math/license/activate_url',
			Security::add_query_arg_raw( $args, RANK_MATH_SITE_URL . '/auth' ),
			$args
		);
	}

	/**
```

### action_scheduler_pastdue_actions_seconds
**File:** `seo-by-rank-math/includes/admin/class-admin.php`

**Context:**

```php
$num_pastdue_actions -= $num_pastdue_rm_actions;
		}

		$threshold_seconds = (int) apply_filters( 'action_scheduler_pastdue_actions_seconds', DAY_IN_SECONDS );
		$threshhold_min    = (int) apply_filters( 'action_scheduler_pastdue_actions_min', 1 );

		$check = ( $num_pastdue_actions >= $threshhold_min );
```

### action_scheduler_pastdue_actions_min
**File:** `seo-by-rank-math/includes/admin/class-admin.php`

**Context:**

```php
}

		$threshold_seconds = (int) apply_filters( 'action_scheduler_pastdue_actions_seconds', DAY_IN_SECONDS );
		$threshhold_min    = (int) apply_filters( 'action_scheduler_pastdue_actions_min', 1 );

		$check = ( $num_pastdue_actions >= $threshhold_min );
		return (bool) apply_filters( 'action_scheduler_pastdue_actions_check', $check, $num_pastdue_actions, $threshold_seconds, $threshhold_min );
```

### action_scheduler_pastdue_actions_check
**File:** `seo-by-rank-math/includes/admin/class-admin.php`

**Context:**

```php
$threshhold_min    = (int) apply_filters( 'action_scheduler_pastdue_actions_min', 1 );

		$check = ( $num_pastdue_actions >= $threshhold_min );
		return (bool) apply_filters( 'action_scheduler_pastdue_actions_check', $check, $num_pastdue_actions, $threshold_seconds, $threshhold_min );
	}

	/**
```

### rank_math/settings/saved_data
**File:** `seo-by-rank-math/includes/admin/class-option-center.php`

**Context:**

```php
return [
			'notifications' => $notifications,
			'settings'      => apply_filters( 'rank_math/settings/saved_data', Helper::get_settings( $type ), $type ),
		];
	}

	/**
```

### rank_math/flush_fields
**File:** `seo-by-rank-math/includes/admin/class-option-center.php`

**Context:**

```php
return;
		}

		/**
		 * Filter: Allow developers to add option fields which will flush the rewrite rules when updated.
		 *
		 * @param array $flush_fields Array of field IDs for which we need to flush.
		 */
		$flush_fields = apply_filters(
			'rank_math/flush_fields',
			[
				'strip_category_base',
				'disable_author_archives',
				'url_author_base',
				'attachment_redirect_urls',
				'attachment_redirect_default',
				'nofollow_external_links',
				'nofollow_image_links',
				'nofollow_domains',
				'nofollow_exclude_domains',
				'new_window_external_links',
				'redirections_header_code',
				'redirections_post_redirect',
				'redirections_debug',
			]
		);

		foreach ( $flush_fields as $field_id ) {
			if ( in_array( $field_id, $updated, true ) ) {
```

### rank_math/admin/robots
**File:** `seo-by-rank-math/includes/admin/class-post-columns.php`

**Context:**

```php
*/
	public static function is_post_indexable( $post_id ) {
		$robots = Param::post( 'rank_math_robots', false, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );

		$robots = apply_filters( 'rank_math/admin/robots', $robots, $post_id );
		if ( ! empty( $robots ) ) {
			return in_array( 'index', $robots, true ) ? true : false;
		}
```

### rank_math/settings/sanitize_fields
**File:** `seo-by-rank-math/includes/admin/class-sanitize-settings.php`

**Context:**

```php
* @return mixed Sanitized value.
	 */
	public static function sanitize_field( $value, $type, $field_id ) {
		// First: Check field ID-specific logic.
		$field_specific = apply_filters( 'rank_math/settings/sanitize_fields', self::sanitize_by_field_id( $value, $field_id ), $value, $field_id );
		if ( $field_specific !== null ) {
			return $field_specific;
		}
```

### sanitize_text_field
**File:** `seo-by-rank-math/includes/admin/class-sanitize-settings.php`

**Context:**

```php
// Strip out the whitespace that may now exist after removing the octets.
			$filtered = trim( preg_replace( '/ +/', ' ', $filtered ) );
		}

		return apply_filters( 'sanitize_text_field', $filtered, $value );
	}

	/**
```

### rank_math/analytics/max_days_allowed
**File:** `seo-by-rank-math/includes/admin/class-sanitize-settings.php`

**Context:**

```php
* @param mixed $value The unsanitized value from the form.
	 */
	private static function sanitize_cache_control( $value ) {
		$max   = apply_filters( 'rank_math/analytics/max_days_allowed', 90 );
		$value = absint( $value );
		if ( $value > $max ) {
			$value = $max;
```

### rank_math/setup_wizard/$step/localized_data
**File:** `seo-by-rank-math/includes/admin/class-setup-wizard.php`

**Context:**

```php
'setup_mode'   => Helper::get_settings( 'general.setup_mode', 'advanced' ),
			'addImport'    => ! self::maybe_remove_import(),
		];

		return apply_filters(
			"rank_math/setup_wizard/$step/localized_data",
			array_merge(
				$data,
				$steps[ $step ]::get_localized_data()
			)
		);
	}

	/**
```

### rank_math/wizard/pre_remove_import_step
**File:** `seo-by-rank-math/includes/admin/class-setup-wizard.php`

**Context:**

```php
* @return bool
	 */
	private static function maybe_remove_import() {
		$pre = apply_filters( 'rank_math/wizard/pre_remove_import_step', null );
		if ( ! is_null( $pre ) ) {
			return $pre;
		}
```

### rank_math_clauses_{$type}
**File:** `seo-by-rank-math/includes/admin/database/class-clauses.php`

**Context:**

```php
$clauses = $this->sql_clauses[ $type ];
		}

		/**
		 * Filter SQL clauses by type and context.
		 *
		 * @param array  $clauses The original arguments for the request.
		 * @param string $context The data store context.
		 */
		$clauses = apply_filters( "rank_math_clauses_{$type}", $clauses, $this->context );
		/**
		 * Filter SQL clauses by type and context.
		 *
```

### rank_math_clauses_{$type}_{$this->context}
**File:** `seo-by-rank-math/includes/admin/database/class-clauses.php`

**Context:**

```php
* @param string $context The data store context.
		 */
		$clauses = apply_filters( "rank_math_clauses_{$type}", $clauses, $this->context );
		/**
		 * Filter SQL clauses by type and context.
		 *
		 * @param array  $clauses The original arguments for the request.
		 */
		$clauses = apply_filters( "rank_math_clauses_{$type}_{$this->context}", $clauses );

		return implode( $separator, $clauses );
	}
```

### rank_math/database/query/results
**File:** `seo-by-rank-math/includes/admin/database/class-query-builder.php`

**Context:**

```php
$results = $wpdb->get_results( $query, $output );
				break;
		}

		return apply_filters( 'rank_math/database/query/results', $results, $args, $start_time );
	}
}
```

### wp_helpers_notifications_before_storage
**File:** `seo-by-rank-math/includes/admin/notifications/class-notification-center.php`

**Context:**

```php
$notifications = $this->get_notifications();
		$notifications = array_filter( $notifications, [ $this, 'remove_notification' ] );

		/**
		 * Filter: 'wp_helpers_notifications_before_storage' - Allows developer to filter notifications before saving them.
		 *
		 * @param Notification[] $notifications
		 */
		$notifications = apply_filters( 'wp_helpers_notifications_before_storage', $notifications );

		// No notifications to store, clear storage.
		if ( empty( $notifications ) && $this->should_clear_storage ) {
```

### wp_helpers_notifications_render
**File:** `seo-by-rank-math/includes/admin/notifications/class-notification.php`

**Context:**

```php
// Build the output DIV.
		$output = '<div' . HTML::attributes_to_string( $attributes ) . '>' . wpautop( $this->message ) . '</div>' . PHP_EOL;

		/**
		 * Filter: 'wp_helpers_notifications_render' - Allows developer to filter notifications before the output is finalized.
		 *
		 * @param string $output  HTML output.
		 * @param string $message Notice message.
		 * @param array  $options Notice args.
		 */
		$output = apply_filters( 'wp_helpers_notifications_render', $output, $this->message, $this->options );

		return $output;
	}
```

### rank_math/analytics/connect_actions
**File:** `seo-by-rank-math/includes/admin/wizard/views/search-console-ui.php`

**Context:**

```php
'text'  => esc_html__( 'Test Connections', 'rank-math' ),
	];
}

$connections = apply_filters( 'rank_math/analytics/connect_actions', $connections );
?>
```

### rank_math/analytics/adsense
**File:** `seo-by-rank-math/includes/admin/wizard/views/search-console-ui.php`

**Context:**

```php
<?php echo apply_filters( 'rank_math/analytics/adsense', ob_get_clean(), $analytics, $all_services ); // phpcs:ignore ?>

<div id="rank-math-pro-cta" class="rank-math-privacy-box width-100">
	<div class="rank-math-cta-table">
		<div class="rank-math-cta-body less-padding">
			<i class="dashicons dashicons-lock"></i>
			<p>
			<?php
			/* translators: %s: Link to KB article */
			printf( esc_html__( 'We do not store any of the data from your Google account on our servers, everything is processed & stored on your server. We take your privacy extremely seriously and ensure it is never misused. %s', 'rank-math' ), '<a href="' . KB::get( 'usage-policy', 'Analytics Privacy Notice' ) . '" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Learn more.', 'rank-math' ) . '</a>' ); // phpcs:ignore
			?>
```

### rank_math/admin/sensitive_data_encryption
**File:** `seo-by-rank-math/includes/class-data-encryption.php`

**Context:**

```php
public static function is_available() {
		static $encryption_possible;
		if ( null === $encryption_possible ) {
			$encryption_possible = extension_loaded( 'openssl' ) && apply_filters( 'rank_math/admin/sensitive_data_encryption', true ) && self::get_key() && self::get_salt();
		}

		return (bool) $encryption_possible;
```

### rank_math/pre_clear_cache
**File:** `seo-by-rank-math/includes/class-helper.php`

**Context:**

```php
*/
	public static function clear_cache( $context = '' ) {

		/**
		 * Filter: 'rank_math/pre_clear_cache' - Allow developers to extend/override cache clearing.
		 * Pass a truthy value to override the cache clearing.
		 */
		if ( apply_filters( 'rank_math/pre_clear_cache', false, $context ) ) {
			return;
		}

		// Clean WordPress cache.
```

### rank_math/enable_big_selects
**File:** `seo-by-rank-math/includes/class-helper.php`

**Context:**

```php
*/
	public static function enable_big_selects_for_queries() {
		static $rank_math_enable_big_select;

		if ( $rank_math_enable_big_select || ! apply_filters( 'rank_math/enable_big_selects', true ) ) {
			return;
		}

		$rank_math_enable_big_select = DB_Helper::query( 'SET SESSION SQL_BIG_SELECTS=1' );
```

### rank_math/admin/create_tables
**File:** `seo-by-rank-math/includes/class-installer.php`

**Context:**

```php
PRIMARY KEY  (object_id)
			) $collate;";
		}

		$table_schema = apply_filters( 'rank_math/admin/create_tables', $table_schema, $modules );

		require_once ABSPATH . 'wp-admin/includes/upgrade.php'; // @phpstan-ignore-line
		foreach ( $table_schema as $table ) {
```

### rank_math/json_data
**File:** `seo-by-rank-math/includes/class-json-manager.php`

**Context:**

```php
if ( empty( $object_data ) ) {
			return '';
		}

		$object_data = apply_filters( 'rank_math/json_data', $object_data );
		foreach ( (array) $object_data as $key => $value ) {
			if ( ! is_string( $value ) ) {
				continue;
```

### rank_math/pre_simple_page_id
**File:** `seo-by-rank-math/includes/class-post.php`

**Context:**

```php
* @return int The ID of the page.
	 */
	public static function get_page_id() {
		/**
		 * Filter: Allow changing the page ID before we process anything.
		 *
		 * @param bool|int $page_id The default page ID.
		 */
		$page_id = apply_filters( 'rank_math/pre_simple_page_id', false );
		if ( false !== $page_id ) {
			return $page_id;
		}
```

### rank_math/simple_page_id
**File:** `seo-by-rank-math/includes/class-post.php`

**Context:**

```php
return self::get_shop_page_id();
		}

		/**
		 * Filter: Allow changing the page ID.
		 *
		 * @param int $page_id The page ID.
		 */
		return apply_filters( 'rank_math/simple_page_id', 0 );
	}

	/**
```

### rank_math/author_base
**File:** `seo-by-rank-math/includes/class-rewrite.php`

**Context:**

```php
public static function change_author_base() {
		global $wp_rewrite;

		/**
		 * Filter: Change the author base.
		 *
		 * @param string $base The author base.
		 */
		$base = apply_filters( 'rank_math/author_base', sanitize_title_with_dashes( Helper::get_settings( 'titles.url_author_base' ), '', 'save' ) );
		if ( empty( $base ) ) {
			return;
		}
```

### rank_math/shortcode/contact/address_parts_format
**File:** `seo-by-rank-math/includes/frontend/class-shortcodes.php`

**Context:**

```php
* @param string $format Address format.
	 */
	public static function get_address( $hash, $address, $format ) {
		$parts_format = apply_filters( 'rank_math/shortcode/contact/address_parts_format', '<span class="contact-address-%1$s">%2$s</span>' );

		foreach ( $hash as $key => $tag ) {
			$value = '';
```

### rank_math/frontend/canonical
**File:** `seo-by-rank-math/includes/frontend/paper/class-paper.php`

**Context:**

```php
$canonical = Str::is_non_empty( $canonical ) && true === Url::is_relative( $canonical ) ? $this->base_url( $canonical ) : $canonical;
		$canonical = Str::is_non_empty( $canonical_override ) ? $canonical_override : $canonical;

		/**
		 * Filter the canonical URL.
		 *
		 * @param string $canonical The canonical URL.
		 */
		$this->canonical['canonical'] = apply_filters( 'rank_math/frontend/canonical', $canonical );
	}

	/**
```

### rank_math/paper/auto_generated_description/apply_shortcode
**File:** `seo-by-rank-math/includes/frontend/paper/class-paper.php`

**Context:**

```php
) {
			return false;
		}

		return apply_filters( 'rank_math/paper/auto_generated_description/apply_shortcode', false );
	}

	/**
```

### rank_math/analytics/frontend_stats
**File:** `seo-by-rank-math/includes/helpers/class-analytics.php`

**Context:**

```php
return Authentication::is_authorized() &&
			Console::is_console_connected() &&
			Helper::has_cap( 'analytics' ) &&
			apply_filters( 'rank_math/analytics/frontend_stats', Helper::get_settings( 'general.analytics_stats' ) );
	}

	/**
```

### rank_math/admin/add_notification
**File:** `seo-by-rank-math/includes/helpers/class-api.php`

**Context:**

```php
$options['classes'] = ! empty( $options['classes'] ) ? $options['classes'] . ' rank-math-notice' : 'rank-math-notice';
		$notification       = compact( 'message', 'options' );

		/**
		 * Filter notification message & arguments before adding.
		 * Pass a falsy value to stop the notification from getting added.
		 */
		apply_filters( 'rank_math/admin/add_notification', $notification );

		if ( empty( $notification ) || ! is_array( $notification ) ) {
			return;
```

### rank_math/social/overlay_images
**File:** `seo-by-rank-math/includes/helpers/class-choices.php`

**Context:**

```php
$uri = rank_math()->plugin_url() . 'assets/admin/img/';
		$dir = rank_math()->plugin_dir() . 'assets/admin/img/';

		/**
		 * Allow developers to add/remove overlay images.
		 *
		 * @param array $images Image data as array of arrays.
		 */
		$list = apply_filters(
			'rank_math/social/overlay_images',
			[
				'play' => [
					'name' => esc_html__( 'Play icon', 'rank-math' ),
					'url'  => $uri . 'icon-play.png',
					'path' => $dir . 'icon-play.png',
				],
				'gif'  => [
					'name' => esc_html__( 'GIF icon', 'rank-math' ),
					'url'  => $uri . 'icon-gif.png',
					'path' => $dir . 'icon-gif.png',
				],
			]
		);

		// Allow custom positions.
		foreach ( $list as $name => $data ) {
```

### rank_math/social/overlay_image_position
**File:** `seo-by-rank-math/includes/helpers/class-choices.php`

**Context:**

```php
// Allow custom positions.
		foreach ( $list as $name => $data ) {
			$list[ $name ]['position'] = apply_filters( 'rank_math/social/overlay_image_position', 'middle_center', $name );
		}

		return 'names' === $output ? wp_list_pluck( $list, 'name' ) : $list;
```

### rank_math/json_ld/business_types
**File:** `seo-by-rank-math/includes/helpers/class-choices.php`

**Context:**

```php
* @return array
	 */
	public static function choices_business_types( $none = false ) {
		$data = apply_filters(
			'rank_math/json_ld/business_types',
			[
				[
					'label' => 'Organization',
					'child' => [
						[ 'label' => 'Airline' ],
						[ 'label' => 'Consortium' ],
						[ 'label' => 'Corporation' ],
						[
							'label' => 'Educational Organization',
							'child' => [
								[ 'label' => 'College Or University' ],
								[ 'label' => 'Elementary School' ],
								[ 'label' => 'High School' ],
								[ 'label' => 'Middle School' ],
								[ 'label' => 'Preschool' ],
								[ 'label' => 'School' ],
							],
						],
						[ 'label' => 'Funding Scheme' ],
						[ 'label' => 'Government Organization' ],
						[ 'label' => 'Library System' ],
						[
							'label' => 'Local Business',
							'child' => [
								[ 'label' => 'Animal Shelter' ],
								[ 'label' => 'Archive Organization' ],
								[
									'label' => 'Automotive Business',
									'child' => [
										[ 'label' => 'Auto Body Shop' ],
										[ 'label' => 'Auto Dealer' ],
										[ 'label' => 'Auto Parts Store' ],
										[ 'label' => 'Auto Rental' ],
										[ 'label' => 'Auto Repair' ],
										[ 'label' => 'Auto Wash' ],
										[ 'label' => 'Gas Station' ],
										[ 'label' => 'Motorcycle Dealer' ],
										[ 'label' => 'Motorcycle Repair' ],
									],
								],
								[ 'label' => 'Child Care' ],
								[ 'label' => 'Dry Cleaning Or Laundry' ],
								[
									'label' => 'Emergency Service',
									'child' => [
										[ 'label' => 'Fire Station' ],
										[ 'label' => 'Hospital' ],
										[ 'label' => 'Police Station' ],
									],
								],
								[ 'label' => 'Employment Agency' ],
								[
									'label' => 'Entertainment Business',
									'child' => [
										[ 'label' => 'Adult Entertainment' ],
										[ 'label' => 'Amusement Park' ],
										[ 'label' => 'Art Gallery' ],
										[ 'label' => 'Casino' ],
										[ 'label' => 'Comedy Club' ],
										[ 'label' => 'Movie Theater' ],
										[ 'label' => 'Night Club' ],
									],
								],
								[
									'label' => 'Financial Service',
									'child' => [
										[ 'label' => 'Accounting Service' ],
										[ 'label' => 'Automated Teller' ],
										[ 'label' => 'Bank Or CreditUnion' ],
										[ 'label' => 'Insurance Agency' ],
									],
								],
								[
									'label' => 'Food Establishment',
									'child' => [
										[ 'label' => 'Bakery' ],
										[ 'label' => 'Bar Or Pub' ],
										[ 'label' => 'Brewery' ],
										[ 'label' => 'Cafe Or CoffeeShop' ],
										[ 'label' => 'Distillery' ],
										[ 'label' => 'Fast Food Restaurant' ],
										[ 'label' => 'IceCream Shop' ],
										[ 'label' => 'Restaurant' ],
										[ 'label' => 'Winery' ],
									],
								],
								[
									'label' => 'Government Office',
									'child' => [
										[ 'label' => 'Post Office' ],
									],
								],
								[
									'label' => 'Health And Beauty Business',
									'child' => [
										[ 'label' => 'Beauty Salon' ],
										[ 'label' => 'Day Spa' ],
										[ 'label' => 'Hair Salon' ],
										[ 'label' => 'Health Club' ],
										[ 'label' => 'Nail Salon' ],
										[ 'label' => 'Tattoo Parlor' ],
									],
								],
								[
									'label' => 'Home And Construction Business',
									'child' => [
										[ 'label' => 'Electrician' ],
										[ 'label' => 'General Contractor' ],
										[ 'label' => 'HVAC Business' ],
										[ 'label' => 'House Painter' ],
										[ 'label' => 'Locksmith' ],
										[ 'label' => 'Moving Company' ],
										[ 'label' => 'Plumber' ],
										[ 'label' => 'Roofing Contractor' ],
									],
								],
								[ 'label' => 'Internet Cafe' ],
								[
									'label' => 'Legal Service',
									'child' => [
										[ 'label' => 'Notary' ],
									],
								],
								[ 'label' => 'Library' ],
								[
									'label' => 'Lodging Business',
									'child' => [
										[ 'label' => 'Bed And Breakfast' ],
										[ 'label' => 'Campground' ],
										[ 'label' => 'Hostel' ],
										[ 'label' => 'Hotel' ],
										[ 'label' => 'Motel' ],
										[
											'label' => 'Resort',
											'child' => [
												[ 'label' => 'Ski Resort' ],
											],
										],
									],
								],
								[
									'label' => 'Medical Business',
									'child' => [
										[ 'label' => 'Community Health' ],
										[ 'label' => 'Dentist' ],
										[ 'label' => 'Dermatology' ],
										[ 'label' => 'Diet Nutrition' ],
										[ 'label' => 'Emergency' ],
										[ 'label' => 'Geriatric' ],
										[ 'label' => 'Gynecologic' ],
										[ 'label' => 'Medical Clinic' ],
										[ 'label' => 'Optician' ],
										[ 'label' => 'Pharmacy' ],
										[ 'label' => 'Physician' ],
									],
								],
								[ 'label' => 'Professional Service' ],
								[ 'label' => 'Radio Station' ],
								[ 'label' => 'Real Estate Agent' ],
								[ 'label' => 'Recycling Center' ],
								[ 'label' => 'Self Storage' ],
								[ 'label' => 'Shopping Center' ],
								[
									'label' => 'Sports Activity Location',
									'child' => [
										[ 'label' => 'Bowling Alley' ],
										[ 'label' => 'Exercise Gym' ],
										[ 'label' => 'Golf Course' ],
										[ 'label' => 'Health Club' ],
										[ 'label' => 'Public Swimming Pool' ],
										[ 'label' => 'Ski Resort' ],
										[ 'label' => 'Sports Club' ],
										[ 'label' => 'Stadium Or Arena' ],
										[ 'label' => 'Tennis Complex' ],
									],
								],
								[
									'label' => 'Store',
									'child' => [
										[ 'label' => 'Auto Parts Store' ],
										[ 'label' => 'Bike Store' ],
										[ 'label' => 'Book Store' ],
										[ 'label' => 'Clothing Store' ],
										[ 'label' => 'Computer Store' ],
										[ 'label' => 'Convenience Store' ],
										[ 'label' => 'Department Store' ],
										[ 'label' => 'Electronics Store' ],
										[ 'label' => 'Florist' ],
										[ 'label' => 'Furniture Store' ],
										[ 'label' => 'Garden Store' ],
										[ 'label' => 'Grocery Store' ],
										[ 'label' => 'Hardware Store' ],
										[ 'label' => 'Hobby Shop' ],
										[ 'label' => 'Home Goods Store' ],
										[ 'label' => 'Jewelry Store' ],
										[ 'label' => 'Liquor Store' ],
										[ 'label' => 'Mens Clothing Store' ],
										[ 'label' => 'Mobile Phone Store' ],
										[ 'label' => 'Movie Rental Store' ],
										[ 'label' => 'Music Store' ],
										[ 'label' => 'Office Equipment Store' ],
										[ 'label' => 'Outlet Store' ],
										[ 'label' => 'Pawn Shop' ],
										[ 'label' => 'Pet Store' ],
										[ 'label' => 'Shoe Store' ],
										[ 'label' => 'Sporting GoodsStore' ],
										[ 'label' => 'Tire Shop' ],
										[ 'label' => 'Toy Store' ],
										[ 'label' => 'Wholesale Store' ],
									],
								],
								[ 'label' => 'Television Station' ],
								[ 'label' => 'Tourist Information Center' ],
								[ 'label' => 'Travel Agency' ],
							],
						],
						[
							'label' => 'Medical Organization',
							'child' => [
								[ 'label' => 'Diagnostic Lab' ],
								[ 'label' => 'Veterinary Care' ],
							],
						],
						[ 'label' => 'NGO' ],
						[ 'label' => 'News Media Organization' ],
						[
							'label' => 'Performing Group',
							'child' => [
								[ 'label' => 'Dance Group' ],
								[ 'label' => 'Music Group' ],
								[ 'label' => 'Theater Group' ],
							],
						],
						[
							'label' => 'Project',
							'child' => [
								[ 'label' => 'Funding Agency' ],
								[ 'label' => 'Research Project' ],
							],
						],
						[
							'label' => 'Sports Organization',
							'child' => [
								[ 'label' => 'Sports Team' ],
							],
						],
						[ 'label' => 'Workers Union' ],
					],
				],
			]
		);

		$business = [];
		if ( $none ) {
```

### rank_math/settings/snippet/types
**File:** `seo-by-rank-math/includes/helpers/class-choices.php`

**Context:**

```php
$types = [ 'off' => $none ] + $types;
		}

		/**
		 * Allow developers to add/remove Schema type choices.
		 *
		 * @param array  $types     Schema types.
		 * @param string $post_type Post type.
		 */
		return apply_filters( 'rank_math/settings/snippet/types', $types, $post_type );
	}

	/**
```

### rank_math/post_type_icons
**File:** `seo-by-rank-math/includes/helpers/class-choices.php`

**Context:**

```php
* @return array
	 */
	public static function choices_post_type_icons() {
		/**
		 * Allow developer to change post types icons.
		 *
		 * @param array $icons Array of available icons.
		 */
		return apply_filters(
			'rank_math/post_type_icons',
			[
				'default'    => 'rm-icon rm-icon-post',
				'post'       => 'rm-icon rm-icon-post',
				'page'       => 'rm-icon rm-icon-page',
				'attachment' => 'rm-icon rm-icon-attachment',
				'product'    => 'rm-icon rm-icon-cart',
				'web-story'  => 'rm-icon rm-icon-stories',
			]
		);
	}

	/**
```

### rank_math/taxonomy_icons
**File:** `seo-by-rank-math/includes/helpers/class-choices.php`

**Context:**

```php
* @return array
	 */
	public static function choices_taxonomy_icons() {
		/**
		 * Allow developer to change taxonomies icons.
		 *
		 * @param array $icons Array of available icons.
		 */
		return apply_filters(
			'rank_math/taxonomy_icons',
			[
				'default'     => 'rm-icon rm-icon-category',
				'category'    => 'rm-icon rm-icon-category',
				'post_tag'    => 'rm-icon rm-icon-tag',
				'product_cat' => 'rm-icon rm-icon-category',
				'product_tag' => 'rm-icon rm-icon-tag',
				'post_format' => 'rm-icon rm-icon-post-format',
			]
		);
	}

	/**
```

### rank_math/whitelabel
**File:** `seo-by-rank-math/includes/helpers/class-conditional.php`

**Context:**

```php
* @return boolean
	 */
	public static function is_whitelabel() {
		/**
		 * Enable whitelabel.
		 *
		 * @param bool $whitelabel Enable whitelabel.
		 */
		return apply_filters( 'rank_math/whitelabel', false );
	}

	/**
```

### rank_math/can_edit_file
**File:** `seo-by-rank-math/includes/helpers/class-conditional.php`

**Context:**

```php
* @return bool
	 */
	public static function is_edit_allowed() {
		/**
		 * Allow editing the robots.txt & htaccess data.
		 *
		 * @param bool $can_edit Can edit the robots & htacess data.
		 */
		return apply_filters(
			'rank_math/can_edit_file',
			( ! defined( 'DISALLOW_FILE_EDIT' ) || ! DISALLOW_FILE_EDIT ) &&
			( ! defined( 'DISALLOW_FILE_MODS' ) || ! DISALLOW_FILE_MODS )
		);
	}

	/**
```

### rank_math/show_score
**File:** `seo-by-rank-math/includes/helpers/class-conditional.php`

**Context:**

```php
* @return boolean
	 */
	public static function is_score_enabled() {
		/**
		 * Enable SEO Score.
		 *
		 * @param bool $score_enabled Enable SEO Score.
		 */
		return apply_filters( 'rank_math/show_score', true );
	}

	/**
```

### rank_math/setup_mode
**File:** `seo-by-rank-math/includes/helpers/class-conditional.php`

**Context:**

```php
* @return boolean
	 */
	public static function is_advanced_mode() {
		return 'advanced' === apply_filters( 'rank_math/setup_mode', Helper::get_settings( 'general.setup_mode', 'advanced' ) );
	}

	/**
```

### rank_math/is_react_enabled
**File:** `seo-by-rank-math/includes/helpers/class-conditional.php`

**Context:**

```php
*/
	public static function is_react_enabled() {
		$is_react_enabled = get_option( 'rank_math_react_settings_ui', 'on' );
		return apply_filters( 'rank_math/is_react_enabled', $is_react_enabled === 'on' );
	}

	/**
```

### https_local_ssl_verify
**File:** `seo-by-rank-math/includes/helpers/class-conditional.php`

**Context:**

```php
[
				'timeout'   => 5,
				'blocking'  => true,
				'sslverify' => apply_filters( 'https_local_ssl_verify', true ),
			]
		);

		if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) !== 200 ) {
			return false;
```

### rank_math/determine_search_intent
**File:** `seo-by-rank-math/includes/helpers/class-content-ai.php`

**Context:**

```php
* Whether to add Keyword Intent.
	 */
	public static function should_determine_search_intent() {
		return apply_filters( 'rank_math/determine_search_intent', true );
	}
}
```

### rank_math/lock_modified_date
**File:** `seo-by-rank-math/includes/helpers/class-editor.php`

**Context:**

```php
* @return bool
	 */
	public static function can_add_lock_modified_date() {
		return apply_filters( 'rank_math/lock_modified_date', true );
	}
}
```

### rank_math/sitemap/posts_to_exclude
**File:** `seo-by-rank-math/includes/helpers/class-post-type.php`

**Context:**

```php
if ( ! isset( $posts_to_exclude ) ) {
			$posts_to_exclude = wp_parse_id_list( Helper::get_settings( 'sitemap.exclude_posts' ) );
			$posts_to_exclude = apply_filters( 'rank_math/sitemap/posts_to_exclude', $posts_to_exclude );
		}

		return in_array( $post_id, $posts_to_exclude, true );
```

### rank_math/excluded_post_types
**File:** `seo-by-rank-math/includes/helpers/class-post-type.php`

**Context:**

```php
$accessible_post_types = get_post_types( [ 'public' => true ] );
		$accessible_post_types = array_filter( $accessible_post_types, 'is_post_type_viewable' );

		/**
		 * Changing the list of accessible post types.
		 *
		 * @api array $accessible_post_types The post types.
		 */
		$accessible_post_types = apply_filters( 'rank_math/excluded_post_types', $accessible_post_types );

		if ( ! is_array( $accessible_post_types ) ) {
			$accessible_post_types = [];
```

### rank_math/metabox/add_seo_metabox
**File:** `seo-by-rank-math/includes/helpers/class-post-type.php`

**Context:**

```php
$rank_math_allowed_post_types = [];
		foreach ( self::get_accessible_post_types() as $post_type ) {
			if ( false === apply_filters( 'rank_math/metabox/add_seo_metabox', Helper::get_settings( 'titles.pt_' . $post_type . '_add_meta_box', 'web-story' !== $post_type ) ) ) {
				continue;
			}

			$rank_math_allowed_post_types[] = $post_type;
```

### rank_math/schema/default_type
**File:** `seo-by-rank-math/includes/helpers/class-schema.php`

**Context:**

```php
}

		if ( 'article' === $schema ) {
			/**
			 * Filter: Allow changing the default schema type.
			 *
			 * @param string $schema    Schema type.
			 * @param string $post_type Post type.
			 * @param int    $post_id   Post ID.
			 */
			$schema = apply_filters(
				'rank_math/schema/default_type',
				Helper::get_settings( "titles.pt_{$post_type}_default_article_type" ),
				$post_type,
				$post_id
			);
		}

		if ( class_exists( 'WooCommerce' ) && 'product' === $post_type ) {
```

### rank_math/schema/use_default_product
**File:** `seo-by-rank-math/includes/helpers/class-schema.php`

**Context:**

```php
* @return bool
	 */
	public static function can_use_default_product_schema() {
		return apply_filters( 'rank_math/schema/use_default_product', true );
	}
}
```

### rank_math/excluded_taxonomies
**File:** `seo-by-rank-math/includes/helpers/class-taxonomy.php`

**Context:**

```php
public static function filter_exclude_taxonomies( $taxonomies, $filter = true ) {
		$taxonomies = $filter ? array_filter( $taxonomies, [ __CLASS__, 'is_taxonomy_viewable' ] ) : $taxonomies;

		/**
		 * Filter: 'rank_math_excluded_taxonomies' - Allow changing the accessible taxonomies.
		 *
		 * @api array $taxonomies The public taxonomies.
		 */
		$taxonomies = apply_filters( 'rank_math/excluded_taxonomies', $taxonomies );

		return $taxonomies;
	}
```

### wp_helpers_is_affiliate_link
**File:** `seo-by-rank-math/includes/helpers/class-url.php`

**Context:**

```php
return false;
		}

		/**
		 * Filter: 'wp_helpers_is_affiliate_link' - Allows developer to consider a link as affiliate.
		 *
		 * @param bool   $value Default false.
		 * @param string $url URL.
		 */
		return apply_filters( 'wp_helpers_is_affiliate_link', false, $url );
	}

	/**
```

### use_block_editor_for_post_type
**File:** `seo-by-rank-math/includes/helpers/class-wordpress.php`

**Context:**

```php
return false;
		}

		/**
		 * Filter whether a post is able to be edited in the block editor.
		 *
		 * @since 5.0.0
		 *
		 * @param bool   $use_block_editor  Whether the post type can be edited or not. Default true.
		 * @param string $post_type         The post type being checked.
		 */
		return apply_filters( 'use_block_editor_for_post_type', true, $post_type );
	}

	/**
```

### rank_math/404_monitor/get_logs_args
**File:** `seo-by-rank-math/includes/modules/404-monitor/class-db.php`

**Context:**

```php
'uri'     => '',
			]
		);

		$args = apply_filters( 'rank_math/404_monitor/get_logs_args', $args );

		$table = self::table()->found_rows()->page( $args['paged'] - 1, $args['limit'] );
```

### rank_math/analytics/check_all_services
**File:** `seo-by-rank-math/includes/modules/analytics/class-ajax.php`

**Context:**

```php
$result['hasAnalytics']         = true;
			$result['hasAnalyticsProperty'] = $this->is_site_in_analytics( $result['accounts'] );
		}

		$result = apply_filters( 'rank_math/analytics/check_all_services', $result );

		update_option( 'rank_math_analytics_all_services', $result );
```

### rank_math/analytics/user_preference
**File:** `seo-by-rank-math/includes/modules/analytics/class-analytics.php`

**Context:**

```php
wp_set_script_translations( 'rank-math-analytics', 'rank-math', plugin_dir_path( __FILE__ ) . 'languages/' );

		$this->action( 'admin_footer', 'dequeue_cmb2' );

		$preference = apply_filters(
			'rank_math/analytics/user_preference',
			[
				'topPosts'        => [
					'seo_score'       => false,
					'schemas_in_use'  => false,
					'impressions'     => true,
					'pageviews'       => true,
					'clicks'          => false,
					'position'        => true,
					'positionHistory' => true,
				],
				'siteAnalytics'   => [
					'seo_score'       => true,
					'schemas_in_use'  => true,
					'impressions'     => false,
					'pageviews'       => true,
					'links'           => true,
					'clicks'          => false,
					'position'        => false,
					'positionHistory' => false,
				],
				'performance'     => [
					'seo_score'       => true,
					'schemas_in_use'  => true,
					'impressions'     => true,
					'pageviews'       => true,
					'ctr'             => false,
					'clicks'          => true,
					'position'        => true,
					'positionHistory' => true,
				],
				'keywords'        => [
					'impressions'     => true,
					'ctr'             => false,
					'clicks'          => true,
					'position'        => true,
					'positionHistory' => true,
				],
				'topKeywords'     => [
					'impressions'     => true,
					'ctr'             => true,
					'clicks'          => true,
					'position'        => true,
					'positionHistory' => true,
				],
				'trackKeywords'   => [
					'impressions'     => true,
					'ctr'             => false,
					'clicks'          => true,
					'position'        => true,
					'positionHistory' => true,
				],
				'rankingKeywords' => [
					'impressions'     => true,
					'ctr'             => false,
					'clicks'          => true,
					'position'        => true,
					'positionHistory' => true,
				],
				'indexing'        => [
					'index_verdict'      => true,
					'indexing_state'     => true,
					'rich_results_items' => true,
					'page_fetch_state'   => false,
				],
			]
		);

		$user_id = get_current_user_id();
		if ( metadata_exists( 'user', $user_id, 'rank_math_analytics_table_columns' ) ) {
```

### rank_math/analytics/options/data
**File:** `seo-by-rank-math/includes/modules/analytics/class-analytics.php`

**Context:**

```php
/* translators: Link to kb article */
					'desc'  => sprintf( esc_html__( 'See your Google Search Console, Analytics and AdSense data without leaving your WP dashboard. %s.', 'rank-math' ), '<a href="' . KB::get( 'analytics-settings', 'Options Panel Analytics Tab' ) . '" target="_blank">' . esc_html__( 'Learn more', 'rank-math' ) . '</a>' ),
					'file'  => $this->directory . '/views/options.php',
					'json'  => apply_filters(
						'rank_math/analytics/options/data',
						[
							'analytics' => \RankMath\Wizard\Search_Console::get_localized_data(),
							'isSettingsPage' => true,
							'homeUrl' => home_url(),
							'fields' => [
								'console_caching_control' => [
									'description' => $this->get_description( 'console_caching_control' ),
								],
							],
							'dbInfo' => [
								'days'    => $db_info['days'] ?? 0,
								'rows'    => Str::human_number( $db_info['rows'] ?? 0 ),
								'size'    => size_format( $db_info['size'] ?? 0 ),
							],
							'isFetching' => 'fetching' === get_option( 'rank_math_analytics_first_fetch' ),
							'nextFetch'  => $next_fetch,
							'isAuthorized' => Authentication::is_authorized(),
						]
					),
				],
			],
			9
		);

		return $tabs;
	}
```

### rank_math/analytics/options/cache_control/description
**File:** `seo-by-rank-math/includes/modules/analytics/class-analytics.php`

**Context:**

```php
// Translators: placeholder is a link to rankmath.com, with "free version" as the anchor text.
				$description = sprintf( __( 'Enter the number of days to keep Analytics data in your database. The maximum allowed days are 90 in the %s. Though, 2x data will be stored in the DB for calculating the difference properly.', 'rank-math' ), '<a href="' . KB::get( 'pro', 'Analytics DB Option' ) . '" target="_blank" rel="noopener noreferrer">' . __( 'free version', 'rank-math' ) . '</a>' );
				$description = apply_filters_deprecated( 'rank_math/analytics/options/cahce_control/description', [ $description ], '1.0.61.1', 'rank_math/analytics/options/cache_control/description' );
				$description = apply_filters( 'rank_math/analytics/options/cache_control/description', $description );
				break;
			default:
				$description = apply_filters( 'rank_math/analytics/options/' . $field_id . '/description', '' );
```

### rank_math/analytics/analytics_tables_info
**File:** `seo-by-rank-math/includes/modules/analytics/class-db.php`

**Context:**

```php
$size = DB_Helper::get_var( "SELECT SUM((data_length + index_length)) AS size FROM information_schema.TABLES WHERE table_schema='" . $wpdb->dbname . "' AND (table_name='" . $wpdb->prefix . "rank_math_analytics_gsc')" );
		$data = compact( 'days', 'rows', 'size' );

		$data = apply_filters( 'rank_math/analytics/analytics_tables_info', $data );

		set_transient( $key, $data, DAY_IN_SECONDS );
```

### rank_math/analytics/date_exists_tables
**File:** `seo-by-rank-math/includes/modules/analytics/class-db.php`

**Context:**

```php
public static function date_exists( $date, $action = 'console' ) {
		$tables['console'] = DB_Helper::check_table_exists( 'rank_math_analytics_gsc' ) ? 'rank_math_analytics_gsc' : '';

		/**
		 * Filter: 'rank_math/analytics/date_exists_tables' - Allow developers to add more tables to check.
		 */
		$tables = apply_filters( 'rank_math/analytics/date_exists_tables', $tables, $date, $action );

		if ( empty( $tables[ $action ] ) ) {
			return true; // Should return true to avoid further data fetch action.
```

### rank_math/analytics/inspection_defaults
**File:** `seo-by-rank-math/includes/modules/analytics/class-db.php`

**Context:**

```php
'referring_urls'       => '',
			'raw_api_response'     => '',
		];

		return apply_filters( 'rank_math/analytics/inspection_defaults', $defaults );
	}

	/**
```

### rank_math/analytics/position_limit
**File:** `seo-by-rank-math/includes/modules/analytics/class-db.php`

**Context:**

```php
* @return int
	 */
	private static function get_position_filter() {
		$number = apply_filters( 'rank_math/analytics/position_limit', false );
		if ( false === $number ) {
			return 100;
		}
```

### rank_math/analytics/get_inspections_results
**File:** `seo-by-rank-math/includes/modules/analytics/class-db.php`

**Context:**

```php
do_action_ref_array( 'rank_math/analytics/get_inspections_query', [ &$query, $params ] );

		$results = $query->get();

		return apply_filters( 'rank_math/analytics/get_inspections_results', $results );
	}

	/**
```

### rank_math/analytics/email_report_periods
**File:** `seo-by-rank-math/includes/modules/analytics/class-email-reports.php`

**Context:**

```php
$periods = [
			'monthly' => 30,
		];

		$periods = apply_filters( 'rank_math/analytics/email_report_periods', $periods );

		if ( empty( $frequency ) ) {
			$frequency = self::get_setting( 'frequency', 'monthly' );
```

### rank_math/analytics/hide_email_report_options
**File:** `seo-by-rank-math/includes/modules/analytics/class-email-reports.php`

**Context:**

```php
* @return bool
	 */
	public static function are_fields_hidden() {
		return apply_filters( 'rank_math/analytics/hide_email_report_options', false );
	}
}
```

### rank_math/analytics/keywords
**File:** `seo-by-rank-math/includes/modules/analytics/class-keywords.php`

**Context:**

```php
]
			);
		}

		$rows = apply_filters( 'rank_math/analytics/keywords', $rows );
		if ( empty( $rows ) ) {
			$rows['response'] = 'No Data';
		}
```

### rank_math/analytics/post_data
**File:** `seo-by-rank-math/includes/modules/analytics/class-posts.php`

**Context:**

```php
$post->admin_url = admin_url();
		$post->home_url  = home_url();

		return apply_filters( 'rank_math/analytics/post_data', (array) $post, $request );
	}

	/**
```

### rank_math/analytics/get_posts_rows_by_objects
**File:** `seo-by-rank-math/includes/modules/analytics/class-posts.php`

**Context:**

```php
* @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
	 */
	public function get_posts_rows_by_objects( WP_REST_Request $request ) {
		$pre = apply_filters( 'rank_math/analytics/get_posts_rows_by_objects', false, $request );
		if ( false !== $pre ) {
			return $pre;
		}
```

### rank_math/analytics/get_widget
**File:** `seo-by-rank-math/includes/modules/analytics/class-summary.php`

**Context:**

```php
];

		$stats->keywords = $this->get_keywords_summary();

		$stats = apply_filters( 'rank_math/analytics/get_widget', $stats );

		set_transient( $cache_key, $stats, DAY_IN_SECONDS * Stats::get()->days );
```

### rank_math/analytics/summary
**File:** `seo-by-rank-math/includes/modules/analytics/class-summary.php`

**Context:**

```php
];
		$stats->keywords = $this->get_keywords_summary();
		$stats->graph    = $this->get_analytics_summary_graph();

		$stats = apply_filters( 'rank_math/analytics/summary', $stats );

		$stats = array_filter( (array) $stats );
```

### rank_math/analytics/posts_summary
**File:** `seo-by-rank-math/includes/modules/analytics/class-summary.php`

**Context:**

```php
->selectAvg( 'ctr', 'ctr' )
			->whereBetween( $wpdb->prefix . 'rank_math_analytics_gsc.created', [ $this->start_date, $this->end_date ] );
		$summary = $query->one();
		$summary = apply_filters( 'rank_math/analytics/posts_summary', $summary, $post_type, $query );
		$summary = wp_parse_args(
			array_filter( (array) $summary ),
			[
```

### rank_math/analytics/analytics_summary_graph
**File:** `seo-by-rank-math/includes/modules/analytics/class-summary.php`

**Context:**

```php
// Merge for performance.
		$data->merged = $this->get_merge_data_graph( $data->analytics, $data->merged, $intervals['map'] );

		// For developers.
		$data = apply_filters( 'rank_math/analytics/analytics_summary_graph', $data, $intervals );

		$data->merged = $this->get_graph_data_flat( $data->merged );
		$data->merged = array_values( $data->merged );
```

### rank_math/analytics/get_translated_objects
**File:** `seo-by-rank-math/includes/modules/analytics/class-watcher.php`

**Context:**

```php
'is_indexable'        => Helper::is_post_indexable( $post_id ),
			'pagespeed_refreshed' => 'NULL',
		];

		// Get translated object info in case multi-language plugin is installed.
		$translated_objects = apply_filters( 'rank_math/analytics/get_translated_objects', $post_id );
		if ( false !== $translated_objects && is_array( $translated_objects ) ) {
			// Remove current object info from objects table.
			DB::objects()
```

### wpml_post_language_details
**File:** `seo-by-rank-math/includes/modules/analytics/class-watcher.php`

**Context:**

```php
if ( ! $language_domains ) {
			return $permalink;
		}

		$details   = apply_filters( 'wpml_post_language_details', null, $post_id );
		$code      = $details['language_code'] ?? '';
		$permalink = apply_filters( 'wpml_permalink', get_the_permalink( $post_id ), $code );
		foreach ( $language_domains as $key => $domain ) {
```

### wpml_permalink
**File:** `seo-by-rank-math/includes/modules/analytics/class-watcher.php`

**Context:**

```php
$details   = apply_filters( 'wpml_post_language_details', null, $post_id );
		$code      = $details['language_code'] ?? '';
		$permalink = apply_filters( 'wpml_permalink', get_the_permalink( $post_id ), $code );
		foreach ( $language_domains as $key => $domain ) {
			$permalink = preg_replace( "#https?://{$domain}#i", '', $permalink );
		}
```

### rank_math/analytics/row_limit
**File:** `seo-by-rank-math/includes/modules/analytics/google/class-api.php`

**Context:**

```php
* @return int
	 */
	public function get_row_limit() {
		return apply_filters( 'rank_math/analytics/row_limit', 10000 );
	}

	/**
```

### rank_math/analytics/app_url
**File:** `seo-by-rank-math/includes/modules/analytics/google/class-authentication.php`

**Context:**

```php
* @return string
	 */
	public static function get_auth_app_url() {
		return apply_filters( 'rank_math/analytics/app_url', 'https://oauth.rankmath.com' );
	}

	/**
```

### rank_math/analytics/log_response
**File:** `seo-by-rank-math/includes/modules/analytics/google/class-request.php`

**Context:**

```php
*/
	private function log_response( $http_verb = '', $url = '', $args = [], $response = [], $formatted_response = '', $params = [], $text = '' ) {
		do_action( 'rank_math/analytics/log', $http_verb, $url, $args, $response, $formatted_response, $params );

		if ( ! apply_filters( 'rank_math/analytics/log_response', false ) ) {
			return;
		}

		$uploads = wp_upload_dir();
```

### rank_math/analytics/url_inspection_map_properties
**File:** `seo-by-rank-math/includes/modules/analytics/google/class-url-inspection.php`

**Context:**

```php
];

		$this->assign_inspection_values( $incoming, $map_properties, $normalized );

		$normalized = apply_filters( 'rank_math/analytics/url_inspection_map_properties', $normalized, $incoming );

		return $normalized;
	}
```

### rank_math/analytics/keywords_overview
**File:** `seo-by-rank-math/includes/modules/analytics/rest/class-rest.php`

**Context:**

```php
*/
	public function get_keywords_overview() {
		return rest_ensure_response(
			apply_filters(
				'rank_math/analytics/keywords_overview',
				[
					'topKeywords'   => Stats::get()->get_top_keywords(),
					'positionGraph' => Stats::get()->get_top_position_graph(),
				]
			)
		);
	}

	/**
```

### rank_math/content_ai/call_api
**File:** `seo-by-rank-math/includes/modules/content-ai/class-rest.php`

**Context:**

```php
'data' => esc_html__( 'Content AI is not enabled on this Post type.', 'rank-math' ),
			];
		}

		if ( ! apply_filters( 'rank_math/content_ai/call_api', true ) ) {
			return [
				'data' => 'show_dummy_data',
			];
		}

		if (
```

### rank_math/database/tools
**File:** `seo-by-rank-math/includes/modules/database-tools/class-database-tools.php`

**Context:**

```php
);
		}

		/**
		 * Filters the list of tools available on the Database Tools page.
		 *
		 * @param array $tools The tools.
		 */
		$tools = apply_filters( 'rank_math/database/tools', $tools );

		return $tools;
	}
```

### rank_math/recalculate_scores_batch_size
**File:** `seo-by-rank-math/includes/modules/database-tools/class-update-score.php`

**Context:**

```php
* Constructor.
	 */
	public function __construct() {
		$this->batch_size = absint( apply_filters( 'rank_math/recalculate_scores_batch_size', 25 ) );

		$this->filter( 'rank_math/tools/update_seo_score', 'update_seo_score' );
```

### rank_math/links/link_type
**File:** `seo-by-rank-math/includes/modules/links/class-contentprocessor.php`

**Context:**

```php
$type = false;
		}

		/**
		 * Filter: 'rank_math/links/link_type' - Allow developers to filter the link type.
		 */
		return apply_filters( 'rank_math/links/link_type', $type, $link );
	}

	/**
```

### the_content
**File:** `seo-by-rank-math/includes/modules/links/class-links.php`

**Context:**

```php
* @param string $content The content.
	 */
	private function process( $post_id, $content ) {
		$content = apply_filters( 'the_content', $content );

		/**
		 * Filter to change the content passed to the Link processor.
```

### rank_math/redirection/get_clean_pattern
**File:** `seo-by-rank-math/includes/modules/redirections/class-db.php`

**Context:**

```php
}

		$cleaned = 'regex' === $comparison ? ( '@' . stripslashes( $pattern ) . '@' ) : $pattern;

		return apply_filters( 'rank_math/redirection/get_clean_pattern', $cleaned, $pattern, $comparison );
	}

	/**
```

### rank_math/redirection/admin_column_{$column_name}
**File:** `seo-by-rank-math/includes/modules/redirections/class-table.php`

**Context:**

```php
* @param string $column_name The current column name.
	 */
	public function column_default( $item, $column_name ) {
		/**
		 * Filters the default column output. Pass non-empty value to enable.
		 *
		 * @param bool   $false The column value.
		 * @param object $item  The current item.
		 */
		$default = apply_filters( "rank_math/redirection/admin_column_{$column_name}", false, $item );
		if ( ! empty( $default ) ) {
			return $default;
		}
```

### rank_math/redirection/admin_columns
**File:** `seo-by-rank-math/includes/modules/redirections/class-table.php`

**Context:**

```php
* @return array
	 */
	public function get_columns() {
		/**
		 * Filters the columns displayed in the Redirections table.
		 *
		 * @param array $columns Array of columns.
		 */
		return apply_filters(
			'rank_math/redirection/admin_columns',
			[
				'cb'            => '<input type="checkbox" />',
				'sources'       => esc_html__( 'From', 'rank-math' ),
				'url_to'        => esc_html__( 'To', 'rank-math' ),
				'header_code'   => esc_html__( 'Type', 'rank-math' ),
				'hits'          => esc_html__( 'Hits', 'rank-math' ),
				'created'       => esc_html__( 'Created', 'rank-math' ),
				'last_accessed' => esc_html__( 'Last Accessed', 'rank-math' ),
			]
		);
	}

	/**
```

### rank_math/redirection/bulk_actions
**File:** `seo-by-rank-math/includes/modules/redirections/class-table.php`

**Context:**

```php
];
		}

		/**
		 * Filters the list of bulk actions available on the Redirections table.
		 *
		 * @param array $actions Array of bulk actions.
		 */
		return apply_filters( 'rank_math/redirection/bulk_actions', $actions );
	}

	/**
```

### rank_math/redirection/row_classes
**File:** `seo-by-rank-math/includes/modules/redirections/class-table.php`

**Context:**

```php
public function single_row( $item ) {
		$classes = 'rank-math-redirection-' . ( 'inactive' === $item['status'] ? 'deactivated' : 'activated' );

		/**
		 * Filters the row class.
		 *
		 * @param string $classes The row class.
		 * @param object $item    The current item.
		 */
		$classes = apply_filters( 'rank_math/redirection/row_classes', $classes, $item );

		echo '<tr class="' . esc_attr( $classes ) . '">';
		$this->single_row_columns( $item );
```

### robots_txt
**File:** `seo-by-rank-math/includes/modules/robots-txt/class-robots-txt.php`

**Context:**

```php
$default .= "Disallow: /wp-admin/\n";
			$default .= "Allow: /wp-admin/admin-ajax.php\n";
		}
		$default = apply_filters( 'robots_txt', $default, $public );

		if ( empty( $wp_filesystem ) || ! Helper::is_filesystem_direct() ) {
			return [
```

### rank_math/blocks/{$block}/title_wrapper
**File:** `seo-by-rank-math/includes/modules/schema/blocks/class-block.php`

**Context:**

```php
*/
	protected function get_title_wrapper( $title_wrapper, $block = 'faq' ) {
		$wrapper = in_array( $title_wrapper, [ 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'div' ], true ) ? $title_wrapper : 'h2';

		return apply_filters( "rank_math/blocks/{$block}/title_wrapper", $wrapper );
	}

	/**
```

### rank_math/block/preserve_line_breaks
**File:** `seo-by-rank-math/includes/modules/schema/blocks/class-block.php`

**Context:**

```php
* @return string
	 */
	protected function normalize_text( $text, $block ) {
		/**
		 * Filter: Allow developers to preserve line breaks.
		 *
		 * @param bool   $return If set, this will convert all remaining line breaks after paragraphing.
		 * @param string $block  Block name.
		 */
		return wpautop( wp_kses_post( $text ), apply_filters( 'rank_math/block/preserve_line_breaks', true, $block ) );
	}
}
```

### rank_math/schema/block/faq/content
**File:** `seo-by-rank-math/includes/modules/schema/blocks/faq/class-block-faq.php`

**Context:**

```php
$out[] = sprintf( '</%1$s>', $list_tag );
		$out[] = '</div>';

		return apply_filters(
			'rank_math/schema/block/faq/content',
			wp_kses_post( join( "\n", $out ) ),
			$out,
			$attributes
		);
	}

	/**
```

### rank_math/schema/block/howto/content
**File:** `seo-by-rank-math/includes/modules/schema/blocks/howto/class-block-howto.php`

**Context:**

```php
$out[] = sprintf( '</%1$s>', $list_tag );
		$out[] = '</div>';

		return apply_filters(
			'rank_math/schema/block/howto/content',
			wp_kses_post( join( "\n", $out ) ),
			$out,
			$attributes
		);
	}

	/**
```

### rank_math/schema/block/toc/content
**File:** `seo-by-rank-math/includes/modules/schema/blocks/toc/class-block-toc.php`

**Context:**

```php
$block_content
		);
		$block_content = str_replace( 'class=""', '', $block_content );

		return apply_filters(
			'rank_math/schema/block/toc/content',
			wp_kses_post( $block_content ),
			$block_content,
			$parsed_block['attrs'],
		);
	}

	/**
```

### rank_math/snippet/breadcrumb
**File:** `seo-by-rank-math/includes/modules/schema/snippets/class-breadcrumbs.php`

**Context:**

```php
++$position;
		}

		$entity = apply_filters( 'rank_math/snippet/breadcrumb', $entity );
		if ( empty( $entity['itemListElement'] ) ) {
			return $data;
		}
```

### rank_math/snippet/remove_taxonomy_data
**File:** `seo-by-rank-math/includes/modules/schema/snippets/class-products-page.php`

**Context:**

```php
! is_shop() &&
			(
				true === Helper::get_settings( 'titles.remove_' . $queried_object->taxonomy . '_snippet_data' ) ||
				true === apply_filters( 'rank_math/snippet/remove_taxonomy_data', false, $queried_object->taxonomy )
			)
		) {
			return false;
		}

		return true;
```

### rank_math/snippet/remove_shop_data
**File:** `seo-by-rank-math/includes/modules/schema/snippets/class-products-page.php`

**Context:**

```php
is_shop() &&
			(
				true === Helper::get_settings( 'general.remove_shop_snippet_data' ) ||
				true === apply_filters( 'rank_math/snippet/remove_shop_data', false )
			)
		) {
			return false;
		}

		return true;
```

### rank_math/json_ld/disable_search
**File:** `seo-by-rank-math/includes/modules/schema/snippets/class-website.php`

**Context:**

```php
$jsonld->add_prop( 'publisher', $data['WebSite'], 'publisher', $data );
		$jsonld->add_prop( 'language', $data['WebSite'] );

		/**
		 * Disable the JSON-LD output for the Sitelinks Searchbox.
		 *
		 * @param bool $disable Display or not the JSON-LD for the Sitelinks Searchbox.
		 */
		if ( apply_filters( 'rank_math/json_ld/disable_search', ! is_front_page() || is_paged() ) ) {
			return $data;
		}

		/**
```

### rank_math/json_ld/search_url
**File:** `seo-by-rank-math/includes/modules/schema/snippets/class-website.php`

**Context:**

```php
return $data;
		}

		/**
		 * Change the search URL in the JSON-LD.
		 *
		 * @param string $search_url The search URL with `{search_term_string}` placeholder.
		 */
		$search_url = apply_filters( 'rank_math/json_ld/search_url', home_url( '/?s={search_term_string}' ) );

		$data['WebSite']['potentialAction'] = [
			'@type'       => 'SearchAction',
```

### rank_math/seo_analysis/is_test_hidden
**File:** `seo-by-rank-math/includes/modules/seo-analysis/class-result.php`

**Context:**

```php
];

		$is_hidden = in_array( $this->id, $always_hidden, true ) || ( ! Helper::is_advanced_mode() && in_array( $this->id, $hidden_tests, true ) );

		return apply_filters( 'rank_math/seo_analysis/is_test_hidden', $is_hidden, $this->id );
	}

	/**
```

### rank_math/seo_analysis/postmeta_table_limit
**File:** `seo-by-rank-math/includes/modules/seo-analysis/seo-analysis-tests.php`

**Context:**

```php
*/
function rank_math_analyze_focus_keywords() {
	global $wpdb;

	$postmeta_table_limit = apply_filters( 'rank_math/seo_analysis/postmeta_table_limit', 200000 );
	if ( DB::table_size_exceeds( $wpdb->postmeta, $postmeta_table_limit ) ) {
		return [
			'status'  => 'warning',
```

### rank_math/sitemap/cache_mode
**File:** `seo-by-rank-math/includes/modules/sitemap/class-cache.php`

**Context:**

```php
$this->wp_filesystem = Helper::get_filesystem();
		$this->mode          = $this->is_writable() ? 'file' : 'db';

		/**
		 * Change sitemap caching mode (can be "file" or "db").
		 */
		$this->mode = apply_filters( 'rank_math/sitemap/cache_mode', $this->mode );
	}

	/**
```

### rank_math/sitemap/cache_directory
**File:** `seo-by-rank-math/includes/modules/sitemap/class-cache.php`

**Context:**

```php
$dir     = wp_upload_dir();
		$default = $dir['basedir'] . '/rank-math';

		/**
		 * Filter XML sitemap cache directory.
		 *
		 * @param string $unsigned Default cache directory
		 */
		$filtered = apply_filters( 'rank_math/sitemap/cache_directory', $default );

		if ( ! is_string( $filtered ) || '' === $filtered ) {
			$filtered = $default;
```

### rank_math/sitemap/invalidate_storage
**File:** `seo-by-rank-math/includes/modules/sitemap/class-cache.php`

**Context:**

```php
* @param null|string $type The type to get the key for. Null for all caches.
	 */
	public static function invalidate_storage( $type = null ) {
		/**
		 * Filter: 'rank_math/sitemap/invalidate_storage' - Allow developers to disable sitemap cache invalidation.
		 */
		if ( ! apply_filters( 'rank_math/sitemap/invalidate_storage', true, $type ) ) {
			return;
		}

		$wp_filesystem = Helper::get_filesystem();
```

### rank_math/links/is_external
**File:** `seo-by-rank-math/includes/modules/sitemap/class-classifier.php`

**Context:**

```php
if ( ! is_array( $url_parts ) ) {
			$url_parts = [];
		}

		// Short-circuit if filter returns non-null.
		$filtered = apply_filters( 'rank_math/links/is_external', null, $url_parts );
		if ( null !== $filtered ) {
			return $filtered ? self::TYPE_EXTERNAL : self::TYPE_INTERNAL;
		}
```

### wp_get_attachment_url
**File:** `seo-by-rank-math/includes/modules/sitemap/class-image-parser.php`

**Context:**

```php
*/
	private function image_url( $post_id ) {
		$src = $this->normalize_image_url( $post_id );

		return false === $src ? '' : apply_filters( 'wp_get_attachment_url', $src, $post_id ); // phpcs:ignore
	}

	/**
	 * Get attached image URL.
	 *
	 * @param int $post_id ID of the post.
	 *
	 * @return bool|string
	 */
	private function normalize_image_url( $post_id ) {
		$uploads    = $this->get_upload_dir();
		$attachment = get_post_meta( $post_id, '_wp_attached_file', true );

		if ( false !== $uploads['error'] || empty( $attachment ) ) {
```

### rank_math/sitemap/base_url
**File:** `seo-by-rank-math/includes/modules/sitemap/class-router.php`

**Context:**

```php
$base = $wp_rewrite->using_index_permalinks() ? $wp_rewrite->index . '/' : '';

		/**
		 * Filter the base URL of the sitemaps.
		 *
		 * @param string $base The string that should be added to home_url() to make the full base URL.
		 */
		return apply_filters( 'rank_math/sitemap/base_url', $base );
	}

	/**
```

### rank_math/sitemap/{$type}/slug
**File:** `seo-by-rank-math/includes/modules/sitemap/class-router.php`

**Context:**

```php
* @return string
	 */
	public static function get_sitemap_slug( $type ) {
		/**
		 * Filter the slug of the sitemap.
		 *
		 * @param string $slug Slug of the sitemap.
		 */
		return apply_filters( "rank_math/sitemap/{$type}/slug", $type );
	}

	/**
```

### rank_math/sitemap/enable_caching
**File:** `seo-by-rank-math/includes/modules/sitemap/class-sitemap.php`

**Context:**

```php
return $xml_sitemap_caching;
		}

		/**
		 * Filter to enable/disable XML sitemap caching.
		 *
		 * @param boolean $true Enable or disable caching.
		 */
		$xml_sitemap_caching = apply_filters( 'rank_math/sitemap/enable_caching', true );
		return $xml_sitemap_caching;
	}
```

### rank_math/sitemap/include_noindex
**File:** `seo-by-rank-math/includes/modules/sitemap/class-sitemap.php`

**Context:**

```php
* @return boolean
	 */
	public static function is_object_indexable( $data_object, $type = 'post' ) {
		/**
		 * Filter: 'rank_math/sitemap/include_noindex' - Include noindex data in Sitemap.
		 *
		 * @param bool   $value Whether to include noindex terms in Sitemap.
		 * @param string $type  Object Type.
		 *
		 * @return boolean
		 */
		if ( apply_filters( 'rank_math/sitemap/include_noindex', false, $type ) ) {
			return true;
		}

		$method = 'post' === $type ? 'is_post_indexable' : 'is_term_indexable';
```

### rank_math/sitemap/index/slug
**File:** `seo-by-rank-math/includes/modules/sitemap/class-sitemap.php`

**Context:**

```php
* Get the sitemap index slug.
	 */
	public static function get_sitemap_index_slug() {
		/**
		 * Filter: 'rank_math/sitemap/index_slug' - Modify the sitemap index slug.
		 *
		 * @param string $slug Sitemap index slug.
		 *
		 * @return string
		 */
		return apply_filters( 'rank_math/sitemap/index/slug', 'sitemap_index' );
	}
}
```

### rank_math/sitemap/html_sitemap_post_types
**File:** `seo-by-rank-math/includes/modules/sitemap/html-sitemap/class-sitemap.php`

**Context:**

```php
$post_types[] = $post_type;
		}

		/**
		 * Filter: 'rank_math/sitemap/html_sitemap_post_types' - Allow changing the post types to be included in the HTML sitemap.
		 *
		 * @var array $post_types The post types to be included in the HTML sitemap.
		 */
		return apply_filters( 'rank_math/sitemap/html_sitemap_post_types', $post_types );
	}

	/**
```

### rank_math/sitemap/html_sitemap_taxonomies
**File:** `seo-by-rank-math/includes/modules/sitemap/html-sitemap/class-sitemap.php`

**Context:**

```php
$taxonomies[ $taxonomy->name ] = $taxonomy;
		}

		/**
		 * Filter: 'rank_math/sitemap/html_sitemap_taxonomies' - Allow changing the taxonomies to be included in the HTML sitemap.
		 *
		 * @var array $taxonomies The taxonomies to be included in the HTML sitemap.
		 */
		return apply_filters( 'rank_math/sitemap/html_sitemap_taxonomies', $taxonomies );
	}

	/**
```

### rank_math/export/settings
**File:** `seo-by-rank-math/includes/modules/status/class-import-export-settings.php`

**Context:**

```php
$data['redirections'] = $items['redirections'];
			}

			$data = apply_filters( 'rank_math/export/settings', $data, $panel );
		}

		$data['modules'] = get_option( 'rank_math_modules', [] );
```

### rank_math/status/$view/json_data
**File:** `seo-by-rank-math/includes/modules/status/class-rest.php`

**Context:**

```php
if ( ! isset( $hash[ $view ] ) ) {
			return [];
		}

		return apply_filters(
			"rank_math/status/$view/json_data",
			$hash[ $view ]::get_json_data()
		);
	}

	/**
```

### rank_math/status/rank_math_info
**File:** `seo-by-rank-math/includes/modules/status/class-system-status.php`

**Context:**

```php
if ( ! class_exists( 'WP_Site_Health' ) ) {
			require_once ABSPATH . 'wp-admin/includes/class-wp-site-health.php'; // @phpstan-ignore-line
		}

		$rankmath_data = apply_filters( 'rank_math/status/rank_math_info', $rankmath );
		$core_data     = \WP_Debug_Data::debug_data();

		// Keep only relevant data.
```

### rank_math/woocommerce/product_brand
**File:** `seo-by-rank-math/includes/modules/woocommerce/class-base.php`

**Context:**

```php
$brands = get_the_terms( $product_id, $taxonomy );
			$brand  = is_wp_error( $brands ) || empty( $brands[0] ) ? '' : $brands[0]->name;
		}

		return apply_filters( 'rank_math/woocommerce/product_brand', $brand );
	}
}
```

### rank_math/replacements
**File:** `seo-by-rank-math/includes/replace-variables/class-replacer.php`

**Context:**

```php
$this->pre_replace( $args, $exclude );
		$replacements = $this->set_up_replacements( $variable );

		/**
		 * Filter: Allow customizing the replacements.
		 *
		 * @param array  $replacements The replacements.
		 * @param object $args The object some of the replacement values might come from,
		 *                    could be a post, taxonomy or term.
		 */
		$replacements = apply_filters( 'rank_math/replacements', $replacements, self::$args );

		// Do the replacements.
		if ( is_array( $replacements ) && [] !== $replacements ) {
```

### rank_math/replacements/non_cacheable
**File:** `seo-by-rank-math/includes/replace-variables/class-replacer.php`

**Context:**

```php
}
		}

		/**
		 * Filter: Allow changing the non-cacheable variables.
		 *
		 * @param array $non_cacheable The non-cacheable variable IDs.
		 */
		self::$non_cacheable_replacements = apply_filters( 'rank_math/replacements/non_cacheable', $non_cacheable );

		return self::$non_cacheable_replacements;
	}
```

### rank_math/filter_metadata
**File:** `seo-by-rank-math/includes/rest/class-shared.php`

**Context:**

```php
public function update_metadata( WP_REST_Request $request ) {
		$object_id   = $request->get_param( 'objectID' );
		$object_type = $request->get_param( 'objectType' );
		$meta        = apply_filters( 'rank_math/filter_metadata', $request->get_param( 'meta' ), $request );
		$content     = $request->get_param( 'content' );

		if ( $object_id === 0 ) {
```

### rank_math/schema/filter_data
**File:** `seo-by-rank-math/includes/rest/class-shared.php`

**Context:**

```php
public function update_schemas( WP_REST_Request $request ) {
		$object_id   = $request->get_param( 'objectID' );
		$object_type = $request->get_param( 'objectType' );
		$schemas     = apply_filters( 'rank_math/schema/filter_data', $request->get_param( 'schemas' ), $request );
		$new_ids     = [];

		do_action( 'rank_math/pre_update_schema', $object_id, $object_type );
```

### rank_math/gutenberg/enabled
**File:** `seo-by-rank-math/includes/template-tags.php`

**Context:**

```php
* @return bool
 */
function rank_math_is_gutenberg() {
	return apply_filters( 'rank_math/gutenberg/enabled', true );
}

/**
```

### rank_math/cache/enabled
**File:** `seo-by-rank-math/includes/traits/class-cache.php`

**Context:**

```php
if ( wp_using_ext_object_cache() === false ) {
			return false;
		}

		return apply_filters( 'rank_math/cache/enabled', true );
	}
}
```

### rank_math_clear_data_on_uninstall
**File:** `seo-by-rank-math/rank-math.php`

**Context:**

```php
* @return void
	 */
	public function plugin_row_deactivate_notice( $file ) {
		if ( false === apply_filters( 'rank_math_clear_data_on_uninstall', false ) ) {
			return;
		}

		if ( is_multisite() && ! is_network_admin() && is_plugin_active_for_network( $file ) ) {
```

### plugin_locale
**File:** `seo-by-rank-math/rank-math.php`

**Context:**

```php
*/
	public function localization_setup() {
		$locale = get_user_locale();
		$locale = apply_filters( 'plugin_locale', $locale, 'rank-math' ); // phpcs:ignore

		unload_textdomain( 'rank-math' );
		if ( false === load_textdomain( 'rank-math', WP_LANG_DIR . '/plugins/seo-by-rank-math-' . $locale . '.mo' ) ) {
			load_textdomain( 'rank-math', WP_LANG_DIR . '/seo-by-rank-math/seo-by-rank-math-' . $locale . '.mo' );
		}
```

## Actions (45)

### admin/editor_scripts
**File:** `seo-by-rank-math/includes/3rdparty/divi/class-divi.php`

**Context:**

```php
$this->print_react_containers();

		/**
		 * Allow other plugins to enqueue/dequeue admin styles or scripts after plugin assets.
		 */
		$this->do_action( 'admin/editor_scripts', $this->screen );
	}

	/**
```

### sitemap/invalidate_object_type
**File:** `seo-by-rank-math/includes/admin/class-admin-bar-menu.php`

**Context:**

```php
$this->update_meta( $object_type, $object_id, 'rank_math_robots', $robots );

			if ( 'noindex' === $what ) {
				$this->do_action( 'sitemap/invalidate_object_type', $object_type, $object_id );
			}

			die( '1' );
```

### admin_bar/items
**File:** `seo-by-rank-math/includes/admin/class-admin-bar-menu.php`

**Context:**

```php
$this->add_mark_page_menu();
		}

		/**
		 * Add item to rank math admin bar node.
		 *
		 * @param Admin_Bar_Menu $this Class instance.
		 */
		$this->do_action( 'admin_bar/items', $this );

		$this->add_order();
		uasort( $this->items, [ $this, 'sort_by_priority' ] );
```

### rank_math/connect/account_connected
**File:** `seo-by-rank-math/includes/admin/class-admin-helper.php`

**Context:**

```php
Helper::remove_notification( 'rank-math-site-url-mismatch' );
			update_option( 'rank_math_registration_skip', 1 );
			$connected = update_option( $row, $data );

			do_action( 'rank_math/connect/account_connected', $data );
			return $connected;
		}
```

### admin/settings/{$id}
**File:** `seo-by-rank-math/includes/admin/class-cmb2-options.php`

**Context:**

```php
);

			include $located;

			$this->do_action( "admin/settings/{$id}", $cmb, $tab );

			$cmb->add_field(
				[
```

### rank_math/settings/before_save
**File:** `seo-by-rank-math/includes/admin/class-option-center.php`

**Context:**

```php
if ( ! empty( $update_analytics ) ) {
			$notifications[] = $update_analytics;
		}

		do_action( 'rank_math/settings/before_save', $type, $settings );
		foreach (
			[
				'htaccess_allow_editing',
```

### rank_math/settings/after_save
**File:** `seo-by-rank-math/includes/admin/class-option-center.php`

**Context:**

```php
Helper::update_all_settings( ...$map[ $type ] );
		rank_math()->settings->reset();

		do_action( 'rank_math/settings/after_save', $type, $changed_settings );

		return [
			'notifications' => $notifications,
```

### $column_name
**File:** `seo-by-rank-math/includes/admin/class-post-columns.php`

**Context:**

```php
*/
	public function columns_contents( $column_name, $post_id ) {
		if ( Str::starts_with( 'rank_math', $column_name ) ) {
			do_action( $column_name, $post_id );
		}
	}
```

### post/column/seo_details
**File:** `seo-by-rank-math/includes/admin/class-post-columns.php`

**Context:**

```php
if ( ! self::is_post_indexable( $post_id ) ) {
			echo '<span class="rank-math-column-display seo-score no-score "><strong>N/A</strong></span>';
			echo '<strong>' . esc_html__( 'No Index', 'rank-math' ) . '</strong>';
			$this->do_action( 'post/column/seo_details', $post_id, $data, $this->data );
			return;
		}
```

### rank_math/setup_wizard/$step/save_data
**File:** `seo-by-rank-math/includes/admin/class-setup-wizard.php`

**Context:**

```php
if ( ! isset( $steps[ $step ] ) ) {
			return '';
		}

		do_action( "rank_math/setup_wizard/$step/save_data", $values );

		return $steps[ $step ]::save( $values );
	}
```

### rank_math/redirection/after_import
**File:** `seo-by-rank-math/includes/admin/importers/class-redirections.php`

**Context:**

```php
$id = $item->save();
			if ( false !== $id ) {
				do_action( 'rank_math/redirection/after_import', $id, $row );
				++$count;
			}
		}
```

### metabox/process_fields
**File:** `seo-by-rank-math/includes/admin/metabox/class-metabox.php`

**Context:**

```php
* @param  CMB2 $cmb CMB2 metabox object.
	 */
	public function save_meta( $cmb ) {
		/**
		 * Hook into save handler for main metabox.
		 *
		 * @param CMB2 $cmb CMB2 object.
		 */
		$this->do_action( 'metabox/process_fields', $cmb );
	}

	/**
```

### wp_helpers_notification_dismissed
**File:** `seo-by-rank-math/includes/admin/notifications/class-notification-center.php`

**Context:**

```php
$notification = $this->remove_by_id( $notification_id );

		/**
		 * Filter: 'wp_helpers_notification_dismissed' - Allows developer to perform action after dismissed.
		 *
		 * @param string  $notification_id
		 * @param Notification $notifications
		 */
		do_action( 'wp_helpers_notification_dismissed', $notification_id, $notification );
	}

	/**
```

### rank_math/settings/toggle_auto_update
**File:** `seo-by-rank-math/includes/helpers/class-api.php`

**Context:**

```php
* @return void
	 */
	public static function toggle_auto_update_setting( $toggle ) {
		do_action( 'rank_math/settings/toggle_auto_update', $toggle );

		$auto_updates = (array) get_site_option( 'auto_update_plugins', [] );
		if ( ! empty( $toggle ) && 'off' !== $toggle ) {
```

### rank_math/404_monitor/before_list_table
**File:** `seo-by-rank-math/includes/modules/404-monitor/views/main.php`

**Context:**

```php
<?php \do_action( 'rank_math/404_monitor/before_list_table', $monitor ); ?>

	<form method="get">
		<input type="hidden" name="page" value="rank-math-404-monitor">
		<?php $monitor->table->search_box( esc_html__( 'Search', 'rank-math' ), 's' ); ?>
```

### rank_math/analytics/delete_by_days
**File:** `seo-by-rank-math/includes/modules/analytics/class-db.php`

**Context:**

```php
self::analytics()->whereBetween( 'created', [ $end, $start ] )->delete();
			}
		}

		// Delete analytics, adsense data.
		do_action( 'rank_math/analytics/delete_by_days', $days );
		self::purge_cache();

		return true;
```

### rank_math/analytics/delete_data_log
**File:** `seo-by-rank-math/includes/modules/analytics/class-db.php`

**Context:**

```php
$start = date_i18n( 'Y-m-d H:i:s', strtotime( '-' . ( $days * 2 ) . ' days' ) );

		self::analytics()->where( 'created', '<', $start )->delete();

		// Delete old analytics and adsense data.
		do_action( 'rank_math/analytics/delete_data_log', $start );
	}

	/**
```

### rank_math/analytics/purge_cache
**File:** `seo-by-rank-math/includes/modules/analytics/class-db.php`

**Context:**

```php
$table->whereLike( 'option_name', 'top_keywords_graph' )->delete();
		$table->whereLike( 'option_name', 'dashboard_stats_widget' )->delete();
		$table->whereLike( 'option_name', 'rank_math_analytics_data_info' )->delete();

		do_action( 'rank_math/analytics/purge_cache', $table );

		wp_cache_flush();
	}
```

### rank_math/analytics/get_inspections_query
**File:** `seo-by-rank-math/includes/modules/analytics/class-db.php`

**Context:**

```php
->where( "$objects.page", '!=', '' )
			->orderBy( 'id', 'DESC' )
			->limit( $per_page, $offset );

		do_action_ref_array( 'rank_math/analytics/get_inspections_query', [ &$query, $params ] );

		$results = $query->get();
```

### rank_math/analytics/get_inspections_count_query
**File:** `seo-by-rank-math/includes/modules/analytics/class-db.php`

**Context:**

```php
->selectCount( "$inspections.id", 'total' )
		->leftJoin( $objects, "$inspections.page", "$objects.page" )
		->where( "$objects.page", '!=', '' );

		do_action_ref_array( 'rank_math/analytics/get_inspections_count_query', [ &$query, $params ] );

		return $query->getVar();
	}
```

### rank_math/analytics/log
**File:** `seo-by-rank-math/includes/modules/analytics/google/class-request.php`

**Context:**

```php
* @param string         $text               Text to append at the end of the response.
	 */
	private function log_response( $http_verb = '', $url = '', $args = [], $response = [], $formatted_response = '', $params = [], $text = '' ) {
		do_action( 'rank_math/analytics/log', $http_verb, $url, $args, $response, $formatted_response, $params );

		if ( ! apply_filters( 'rank_math/analytics/log_response', false ) ) {
			return;
```

### rank_math/content_ai/generate_alt
**File:** `seo-by-rank-math/includes/modules/content-ai/class-rest.php`

**Context:**

```php
if ( empty( $ids ) ) {
			return false;
		}

		do_action( 'rank_math/content_ai/generate_alt', $ids );

		return true;
	}
```

### rank_math/redirection/get_redirections_query
**File:** `seo-by-rank-math/includes/modules/redirections/class-db.php`

**Context:**

```php
if ( ! empty( $args['orderby'] ) && in_array( $args['orderby'], [ 'id', 'url_to', 'header_code', 'hits', 'created', 'last_accessed' ], true ) ) {
			$table->orderBy( $args['orderby'], $args['order'] );
		}

		do_action_ref_array( 'rank_math/redirection/get_redirections_query', [ &$table, $args ] );

		$redirections = $table->get( ARRAY_A );
		$count        = $table->get_found_rows();
```

### rank_math/redirection/deleted
**File:** `seo-by-rank-math/includes/modules/redirections/class-db.php`

**Context:**

```php
Cache::purge( $ids );
		$deleted = self::table()->whereIn( 'id', (array) $ids )->delete();

		/**
		 * Fires after deleting redirections.
		 */
		do_action( 'rank_math/redirection/deleted', $ids, $deleted );

		return $deleted;
	}
```

### rank_math/redirection/extra_tablenav
**File:** `seo-by-rank-math/includes/modules/redirections/class-table.php`

**Context:**

```php
*/
	public function extra_tablenav( $which ) {
		parent::extra_tablenav( $which );

		do_action( 'rank_math/redirection/extra_tablenav', $which );

		if ( ! $this->is_trashed_page() ) {
			return;
```

### redirection/post_updated
**File:** `seo-by-rank-math/includes/modules/redirections/class-watcher.php`

**Context:**

```php
if ( 'edit-post' === Param::post( 'screen' ) ) {
				update_post_meta( $post_id, 'rank_math_permalink', $post->post_name );
			}

			$this->do_action( 'redirection/post_updated', $redirection_id, $post_id );
			return;
		}
	}
```

### redirection/term_updated
**File:** `seo-by-rank-math/includes/modules/redirections/class-watcher.php`

**Context:**

```php
$this->get_edit_redirection_url( $redirection_id )
			);
			$this->add_notification( $message, true );

			$this->do_action( 'redirection/term_updated', $redirection_id, $term_id );
		}
	}
```

### snippet/after_schema_content
**File:** `seo-by-rank-math/includes/modules/schema/class-snippet-shortcode.php`

**Context:**

```php
if ( file_exists( $file ) ) {
					include $file;
				}

				$this->do_action( 'snippet/after_schema_content', $this );
				?>
```

### seo_analysis/after_set_url
**File:** `seo-by-rank-math/includes/modules/seo-analysis/class-seo-analyzer.php`

**Context:**

```php
$this->analyse_subpage = true;
		}

		/**
		 * Action: 'rank_math/seo_analysis/after_set_url' - Fires after setting the URL.
		 */
		$this->do_action( 'seo_analysis/after_set_url', $this );

		if ( $this->analyse_subpage ) {
			return;
```

### seo_analysis/after_analyze
**File:** `seo-by-rank-math/includes/modules/seo-analysis/class-seo-analyzer.php`

**Context:**

```php
update_option( 'rank_math_seo_analysis_date', time(), false );
		}

		/**
		 * Action: 'rank_math/seo_analysis/after_analyze' - Fires after the SEO analysis is done.
		 */
		$this->do_action( 'seo_analysis/after_analyze', $this );
		$this->build_results();

		$this->success( $this->get_results() );
```

### rank_math/sitemap/invalidated_storage
**File:** `seo-by-rank-math/includes/modules/sitemap/class-cache.php`

**Context:**

```php
self::cached_files( $data );
		Helper::clear_cache( 'sitemap/' . $type );

		/**
		 * Action: 'rank_math/sitemap/invalidated_storage' - Runs after sitemap cache invalidation.
		 */
		do_action( 'rank_math/sitemap/invalidated_storage', $type );
	}

	/**
```

### sitemap/xsl_{$type}
**File:** `seo-by-rank-math/includes/modules/sitemap/class-stylesheet.php`

**Context:**

```php
$kml_title = sprintf( __( 'Locations Sitemap %1$s %2$s', 'rank-math' ), '-', get_bloginfo( 'name', 'display' ) );

		if ( 'main' !== $type ) {
			/**
			 * Fires for the output of XSL for XML sitemaps, other than type "main".
			 */
			$this->do_action( "sitemap/xsl_{$type}", $title, $kml_title );
			die;
		}
```

### opengraph/{$this->network}/add_images
**File:** `seo-by-rank-math/includes/opengraph/class-image.php`

**Context:**

```php
* Check if page is front page or singular and call the corresponding functions.
	 */
	private function set_images() {
		/**
		 * Allow developers to add images to the OpenGraph tags.
		 *
		 * The dynamic part of the hook name. $this->network, is the network slug.
		 *
		 * @param Image The current object.
		 */
		$this->do_action( "opengraph/{$this->network}/add_images", $this );

		switch ( true ) {
			case is_front_page():
```

### opengraph/{$this->network}/add_additional_images
**File:** `seo-by-rank-math/includes/opengraph/class-image.php`

**Context:**

```php
break;
		}

		/**
		 * Allow developers to add images to the OpenGraph tags.
		 *
		 * The dynamic part of the hook name. $this->network, is the network slug.
		 *
		 * @param Image The current object.
		 */
		$this->do_action( "opengraph/{$this->network}/add_additional_images", $this );

		/**
		 * Passing a truthy value to the filter will effectively short-circuit the
```

### opengraph/pre_attachment_image_check
**File:** `seo-by-rank-math/includes/opengraph/class-image.php`

**Context:**

```php
* @return array The different variations possible for this attachment ID.
	 */
	private function get_image_variations( $attachment_id ) {
		/**
		 * Allow plugins to change the blog in a multisite environment. This hook can be used by plugins that uses a global media library from the main site.
		 */
		$this->do_action( 'opengraph/pre_attachment_image_check', $attachment_id );

		/**
		 * Filter to change the attachment ID.
```

### opengraph/post_attachment_image_check
**File:** `seo-by-rank-math/includes/opengraph/class-image.php`

**Context:**

```php
$variations = $this->get_variations( $attachment_id );

		/**
		 * Allow plugins to reset the blog in a multisite environment. This hook can be used by plugins that utilize a global media library from the main site.
		 */
		$this->do_action( 'opengraph/post_attachment_image_check', $attachment_id );

		return $variations;
	}
```

### opengraph/{$this->network}
**File:** `seo-by-rank-math/includes/opengraph/class-opengraph.php`

**Context:**

```php
public function output_tags() {
		wp_reset_query(); //phpcs:ignore

		/**
		 * Hook to add all OpenGraph metadata
		 *
		 * The dynamic part of the hook name. $this->network, is the network slug.
		 *
		 * @param OpenGraph $this The current opengraph network object.
		 */
		$this->do_action( "opengraph/{$this->network}", $this );
	}

	/**
```

### rank_math/module_changed
**File:** `seo-by-rank-math/includes/rest/class-admin.php`

**Context:**

```php
if ( $module === 'react-settings' ) {
			update_option( 'rank_math_react_settings_ui', $state );
			do_action( 'rank_math/module_changed', $module, $state );
			return true;
		}
```

### redirection/saved
**File:** `seo-by-rank-math/includes/rest/class-admin.php`

**Context:**

```php
if ( false === $redirection->save() ) {
				return __( 'Please add at least one valid source URL.', 'rank-math' );
			}

			$this->do_action( 'redirection/saved', $redirection, $settings );
			return true;
		}
```

### rank_math/setup_wizard/step_viewed
**File:** `seo-by-rank-math/includes/rest/class-setup-wizard.php`

**Context:**

```php
*/
	public function get_step_data( WP_REST_Request $request ) {
		$step = $request->get_param( 'step' );

		// Track step change.
		do_action( 'rank_math/setup_wizard/step_viewed', $step );

		return \RankMath\Admin\Setup_Wizard::get_localized_data( $step );
	}
```

### rank_math/setup_wizard/enable_tracking
**File:** `seo-by-rank-math/includes/rest/class-setup-wizard.php`

**Context:**

```php
*/
	public function update_tracking_optin( WP_REST_Request $request ) {
		$enable_tracking = $request->get_param( 'enable_tracking' );
		do_action( 'rank_math/setup_wizard/enable_tracking', $enable_tracking === 'on' );

		return [
			'success' => true,
```

### rank_math/pre_update_metadata
**File:** `seo-by-rank-math/includes/rest/class-shared.php`

**Context:**

```php
'schemas' => [],
			];
		}

		do_action( 'rank_math/pre_update_metadata', $object_id, $object_type, $content );
		$new_slug = true;
		if ( isset( $meta['permalink'] ) && ! empty( $meta['permalink'] ) && 'post' === $object_type ) {
			$post     = get_post( $object_id );
```

### rank_math/pre_update_schema
**File:** `seo-by-rank-math/includes/rest/class-shared.php`

**Context:**

```php
$object_type = $request->get_param( 'objectType' );
		$schemas     = apply_filters( 'rank_math/schema/filter_data', $request->get_param( 'schemas' ), $request );
		$new_ids     = [];

		do_action( 'rank_math/pre_update_schema', $object_id, $object_type );
		$sanitizer = Sanitize::get();
		foreach ( $schemas as $meta_id => $schema ) {
			$schema   = $sanitizer->sanitize( 'rank_math_schema', $schema );
```

### rank_math/schema/update
**File:** `seo-by-rank-math/includes/rest/class-shared.php`

**Context:**

```php
delete_metadata( $object_type, $object_id, 'rank_math_shortcode_schema_' . $prev_value['metadata']['shortcode'] );
			}
		}

		do_action( 'rank_math/schema/update', $object_id, $schemas, $object_type );

		return $new_ids;
	}
```

### $action
**File:** `seo-by-rank-math/includes/traits/class-hooker.php`

**Context:**

```php
$action = 'rank_math/' . $args[0];
		unset( $args[0] );

		\do_action_ref_array( $action, \array_merge( [], $args ) );
	}

	/**
```

