## Filters (135)

### aioseo_disable_link_format
**File:** `all-in-one-seo-pack/app/Common/Admin/Admin.php`

**Context:**

```php
* @return void
	 */
	private function registerLinkFormatHooks() {
		if ( apply_filters( 'aioseo_disable_link_format', false ) ) {
			return;
		}

		add_action( 'wp_enqueue_editor', [ $this, 'addClassicLinkFormatScript' ], 999999 );
```

### aioseo_show_in_admin_bar
**File:** `all-in-one-seo-pack/app/Common/Admin/Admin.php`

**Context:**

```php
* @return void
	 */
	public function adminBarMenu() {
		if ( false === apply_filters( 'aioseo_show_in_admin_bar', true ) ) {
			return;
		}

		$firstPageSlug = $this->getFirstAvailablePageSlug();
```

### aioseo_manage_seo
**File:** `all-in-one-seo-pack/app/Common/Admin/Admin.php`

**Context:**

```php
* @return string           The required capability.
	 */
	public function getPageRequiredCapability( $pageSlug ) { // phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable
		return apply_filters( 'aioseo_manage_seo', 'aioseo_manage_seo' );
	}

	/**
```

### aioseo_hide_action_scheduler_menu
**File:** `all-in-one-seo-pack/app/Common/Admin/Admin.php`

**Context:**

```php
* @return void
	 */
	public function hideScheduledActionsMenu() {
		if ( ! apply_filters( 'aioseo_hide_action_scheduler_menu', true ) ) {
			return;
		}

		global $submenu;
```

### aioseo_debug_unslash_escaped_posts
**File:** `all-in-one-seo-pack/app/Common/Admin/Admin.php`

**Context:**

```php
* @return void
	 */
	public function unslashEscapedDataPosts() {
		$postsToUnslash = apply_filters( 'aioseo_debug_unslash_escaped_posts', 200 );
		$timeStarted    = gmdate( 'Y-m-d H:i:s', aioseo()->core->cache->get( 'unslash_escaped_data_posts' ) );

		$posts = aioseo()->core->db->start( 'aioseo_posts' )
```

### aioseo_redirects_disable_trashed_posts_suggestions
**File:** `all-in-one-seo-pack/app/Common/Admin/Admin.php`

**Context:**

```php
* @return array           The modified messages.
	 */
	public function appendTrashedMessage( $messages ) {
		// Let advanced users override this.

		if ( apply_filters( 'aioseo_redirects_disable_trashed_posts_suggestions', false ) ) {
			return $messages;
		}

		if ( function_exists( 'aioseoRedirects' ) && aioseoRedirects()->options->monitor->trash ) {
```

### aioseo_show_seo_setup
**File:** `all-in-one-seo-pack/app/Common/Admin/Dashboard.php`

**Context:**

```php
// Add the SEO Setup widget.
		if (
			$this->canShowWidget( 'seoSetup' ) &&
			apply_filters( 'aioseo_show_seo_setup', true ) &&
			( aioseo()->access->isAdmin() || aioseo()->access->hasCapability( 'aioseo_setup_wizard' ) ) &&
			! aioseo()->standalone->setupWizard->isCompleted()
		) {
			wp_add_dashboard_widget(
				'aioseo-seo-setup',
				// Translators: 1 - The plugin short name ("AIOSEO").
				sprintf( esc_html__( '%s Setup', 'all-in-one-seo-pack' ), AIOSEO_PLUGIN_SHORT_NAME ),
				[
					$this,
					'outputSeoSetup',
				],
				null,
				null,
				'normal',
				'high'
			);
		}

		// Add the Overview widget.
```

### aioseo_show_seo_overview
**File:** `all-in-one-seo-pack/app/Common/Admin/Dashboard.php`

**Context:**

```php
// Add the Overview widget.
		if (
			$this->canShowWidget( 'seoOverview' ) &&
			apply_filters( 'aioseo_show_seo_overview', true ) &&
			( aioseo()->access->isAdmin() || aioseo()->access->hasCapability( 'aioseo_page_analysis' ) ) &&
			aioseo()->options->advanced->truSeo
		) {
			wp_add_dashboard_widget(
				'aioseo-overview',
				// Translators: 1 - The plugin short name ("AIOSEO").
				sprintf( esc_html__( '%s Overview', 'all-in-one-seo-pack' ), AIOSEO_PLUGIN_SHORT_NAME ),
				[
					$this,
					'outputSeoOverview',
				]
			);
		}

		// Add the News widget.
```

### aioseo_show_seo_news
**File:** `all-in-one-seo-pack/app/Common/Admin/Dashboard.php`

**Context:**

```php
// Add the News widget.
		if (
			$this->canShowWidget( 'seoNews' ) &&
			apply_filters( 'aioseo_show_seo_news', true ) &&
			aioseo()->access->isAdmin()
		) {
			wp_add_dashboard_widget(
				'aioseo-rss-feed',
				esc_html__( 'SEO News', 'all-in-one-seo-pack' ),
				[
					$this,
					'displayRssDashboardWidget',
				]
			);
		}
	}
```

### aioseo_post_metabox_priority
**File:** `all-in-one-seo-pack/app/Common/Admin/PostSettings.php`

**Context:**

```php
[ $this, 'postSettingsMetabox' ],
				[ $postType ],
				'normal',
				apply_filters( 'aioseo_post_metabox_priority', 'high' )
			);
		}
	}
```

### aioseo_redirects_disable_slug_monitor
**File:** `all-in-one-seo-pack/app/Common/Admin/SlugMonitor.php`

**Context:**

```php
if ( $this->automaticRedirect( $post->post_type, $before, $after ) ) {
			return;
		}

		// Filter to allow users to disable the slug monitor messages.
		if ( apply_filters( 'aioseo_redirects_disable_slug_monitor', false ) ) {
			return;
		}

		$redirectUrl = $this->manualRedirectUrl( [
```

### aioseo_analysis_content
**File:** `all-in-one-seo-pack/app/Common/Api/PostsTerms.php`

**Context:**

```php
* @return string             The custom field content.
	 */
	private static function getAnalysisContent( $post = null ) {
		$analysisContent = apply_filters( 'aioseo_analysis_content', aioseo()->helpers->getPostContent( $post ) );

		return sanitize_post_field( 'post_content', $analysisContent, $post->ID, 'display' );
	}
```

### the_content
**File:** `all-in-one-seo-pack/app/Common/Api/PostsTerms.php`

**Context:**

```php
return new \WP_REST_Response( [
			'success' => true,
			'content' => apply_filters( 'the_content', $content ),
		], 200 );
	}
}
```

### aioseo_search_statistics_auth_url
**File:** `all-in-one-seo-pack/app/Common/Api/SearchStatistics.php`

**Context:**

```php
'return'  => urlencode( admin_url( 'admin.php?page=aioseo&return-to=' . $returnTo ) ),
			'testurl' => 'https://' . aioseo()->searchStatistics->api->getApiUrl() . '/v1/test/'
		], 'https://' . aioseo()->searchStatistics->api->getApiUrl() . '/v1/auth/new/' . aioseo()->searchStatistics->api->auth->type . '/' );

		$url = apply_filters( 'aioseo_search_statistics_auth_url', $url );

		return new \WP_REST_Response( [
			'success' => true,
```

### aioseo_search_statistics_reauth_url
**File:** `all-in-one-seo-pack/app/Common/Api/SearchStatistics.php`

**Context:**

```php
'return'  => urlencode( admin_url( 'admin.php?page=aioseo&return-to=' . $returnTo ) ),
			'testurl' => 'https://' . aioseo()->searchStatistics->api->getApiUrl() . '/v1/test/'
		], 'https://' . aioseo()->searchStatistics->api->getApiUrl() . '/v1/auth/reauth/' . aioseo()->searchStatistics->api->auth->type . '/' );

		$url = apply_filters( 'aioseo_search_statistics_reauth_url', $url );

		return new \WP_REST_Response( [
			'success' => true,
```

### aioseo_breadcrumbs_show_current_item
**File:** `all-in-one-seo-pack/app/Common/Breadcrumbs/Breadcrumbs.php`

**Context:**

```php
* @return bool              Show current item.
		 */
		public function showCurrentItem( $type = null, $reference = null ) {
			return apply_filters( 'aioseo_breadcrumbs_show_current_item', aioseo()->options->breadcrumbs->showCurrentItem, $type, $reference );
		}

		/**
```

### aioseo_woocommerce_breadcrumb_hide_shop
**File:** `all-in-one-seo-pack/app/Common/Breadcrumbs/Breadcrumbs.php`

**Context:**

```php
if (
				! function_exists( 'wc_get_page_id' ) ||
				apply_filters( 'aioseo_woocommerce_breadcrumb_hide_shop', false )
			) {
				return $crumb;
			}

			$shopPageId = wc_get_page_id( 'shop' );
```

### aioseo_breadcrumbs_trail
**File:** `all-in-one-seo-pack/app/Common/Breadcrumbs/Frontend.php`

**Context:**

```php
*/
	public function getBreadcrumbs() {
		if ( ! empty( $this->breadcrumbs ) ) {
			return apply_filters( 'aioseo_breadcrumbs_trail', $this->breadcrumbs );
		}

		$reference = get_queried_object();
```

### aioseo_breadcrumbs_output
**File:** `all-in-one-seo-pack/app/Common/Breadcrumbs/Frontend.php`

**Context:**

```php
) {
			return;
		}

		if ( ! apply_filters( 'aioseo_breadcrumbs_output', true ) ) {
			return;
		}

		// We can only run after this action because we need all post types loaded.
```

### widget_title
**File:** `all-in-one-seo-pack/app/Common/Breadcrumbs/Widget.php`

**Context:**

```php
// Title.
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'];
			echo apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
			echo $args['after_title'];
		}
```

### aioseo_report_summary_enable
**File:** `all-in-one-seo-pack/app/Common/EmailReports/Summary/Summary.php`

**Context:**

```php
// Keep going only if the feature is enabled.
		if (
			! aioseo()->options->advanced->emailSummary->enable ||
			! apply_filters( 'aioseo_report_summary_enable', true, $frequency )
		) {
			return;
		}

		// Get all recipients for the given frequency.
```

### aioseo_import_rank_math_posts_per_action
**File:** `all-in-one-seo-pack/app/Common/ImportExport/RankMath/PostMeta.php`

**Context:**

```php
* @return array The posts that were imported.
	 */
	public function importPostMeta() {
		$postsPerAction = apply_filters( 'aioseo_import_rank_math_posts_per_action', 100 );
		$posts          = $this->getPostsToImport( $postsPerAction );
		if ( ! $posts || ! count( $posts ) ) {
			aioseo()->core->cache->delete( 'import_post_meta_rank_math' );
```

### aioseo_import_seopress_posts_per_action
**File:** `all-in-one-seo-pack/app/Common/ImportExport/SeoPress/PostMeta.php`

**Context:**

```php
* @return void
	 */
	public function importPostMeta() {
		$postsPerAction  = apply_filters( 'aioseo_import_seopress_posts_per_action', 100 );
		$publicPostTypes = implode( "', '", aioseo()->helpers->getPublicPostTypes( true ) );
		$timeStarted     = gmdate( 'Y-m-d H:i:s', aioseo()->core->cache->get( 'import_post_meta_seopress' ) );
```

### aioseo_import_yoast_seo_posts_per_action
**File:** `all-in-one-seo-pack/app/Common/ImportExport/YoastSeo/PostMeta.php`

**Context:**

```php
* @return void
	 */
	public function importPostMeta() {
		$postsPerAction  = apply_filters( 'aioseo_import_yoast_seo_posts_per_action', 100 );
		$publicPostTypes = implode( "', '", aioseo()->helpers->getPublicPostTypes( true ) );
		$timeStarted     = gmdate( 'Y-m-d H:i:s', aioseo()->core->cache->get( 'import_post_meta_yoast_seo' ) );
```

### aioseo_disable
**File:** `all-in-one-seo-pack/app/Common/Main/Head.php`

**Context:**

```php
* @return void
	 */
	public function registerTitleHooks() {
		if ( apply_filters( 'aioseo_disable', false ) || apply_filters( 'aioseo_disable_title_rewrites', false ) ) {
			return;
		}

		add_filter( 'pre_get_document_title', [ $this, 'getTitle' ], 99999 );
```

### aioseo_disable_title_rewrites
**File:** `all-in-one-seo-pack/app/Common/Main/Head.php`

**Context:**

```php
* @return void
	 */
	public function registerTitleHooks() {
		if ( apply_filters( 'aioseo_disable', false ) || apply_filters( 'aioseo_disable_title_rewrites', false ) ) {
			return;
		}

		add_filter( 'pre_get_document_title', [ $this, 'getTitle' ], 99999 );
```

### aioseo_meta_views
**File:** `all-in-one-seo-pack/app/Common/Main/Head.php`

**Context:**

```php
*/
	public function output() {
		remove_action( 'wp_head', 'rel_canonical' );

		$views = apply_filters( 'aioseo_meta_views', $this->views );
		if ( empty( $views ) ) {
			return;
		}
```

### aioseo_remove_reply_to_com
**File:** `all-in-one-seo-pack/app/Common/Main/QueryArgs.php`

**Context:**

```php
* @return void
	 */
	private function removeReplyToCom() {
		if ( ! apply_filters( 'aioseo_remove_reply_to_com', true ) ) {
			return;
		}

		add_filter( 'comment_reply_link', [ $this, 'removeReplyToComLink' ] );
```

### aioseo_enable_amp_social_meta
**File:** `all-in-one-seo-pack/app/Common/Meta/Amp.php`

**Context:**

```php
if ( is_admin() || wp_doing_ajax() || wp_doing_cron() ) {
			return;
		}

		// Add social meta to AMP plugin.
		$enableAmp = apply_filters( 'aioseo_enable_amp_social_meta', true );

		if ( $enableAmp ) {
			$useSchema = apply_filters( 'aioseo_amp_schema', true );
```

### aioseo_amp_schema
**File:** `all-in-one-seo-pack/app/Common/Meta/Amp.php`

**Context:**

```php
$enableAmp = apply_filters( 'aioseo_enable_amp_social_meta', true );

		if ( $enableAmp ) {
			$useSchema = apply_filters( 'aioseo_amp_schema', true );

			if ( $useSchema ) {
				add_action( 'amp_post_template_head', [ $this, 'removeHooksAmpSchema' ], 9 );
```

### wpml_translate_single_string
**File:** `all-in-one-seo-pack/app/Common/Meta/Description.php`

**Context:**

```php
$description = aioseo()->options->searchAppearance->global->metaDescription;
		if ( aioseo()->helpers->isWpmlActive() ) {
			// Allow WPML to translate the title if the homepage is not static.
			$description = apply_filters( 'wpml_translate_single_string', $description, 'admin_texts_aioseo_options_localized', '[aioseo_options_localized]searchAppearance_global_metaDescription' );
		}

		$description = $this->helpers->prepare( $description );
```

### aioseo_generate_descriptions_from_content
**File:** `all-in-one-seo-pack/app/Common/Meta/Description.php`

**Context:**

```php
}

		$description = $this->helpers->sanitize( $this->getPostTypeDescription( $post->post_type ), $post->ID, $default );

		$generateDescriptions = apply_filters( 'aioseo_generate_descriptions_from_content', true, [ $post ] );
		if ( ! $description && ! post_password_required( $post ) ) {
			$description = $post->post_excerpt;
			if (
```

### $this->supportedFilters[ $this->name ]
**File:** `all-in-one-seo-pack/app/Common/Meta/Helpers.php`

**Context:**

```php
}

		$value = $replaceTags ? $value : aioseo()->tags->replaceTags( $value, $objectId );
		$value = apply_filters( $this->supportedFilters[ $this->name ], $value );

		return $this->sanitize( $value, $objectId, $replaceTags );
	}
```

### aioseo_keywords
**File:** `all-in-one-seo-pack/app/Common/Meta/Keywords.php`

**Context:**

```php
$keywords = stripslashes( $keywords );
		$keywords = str_replace( '"', '', $keywords );
		$keywords = wp_filter_nohtml_kses( $keywords );

		return apply_filters( 'aioseo_keywords', $keywords );
	}

	/**
```

### aioseo_prev_link
**File:** `all-in-one-seo-pack/app/Common/Meta/Links.php`

**Context:**

```php
global $post;
			$links = $this->getPostLinks( $post );
		}

		$links['prev'] = apply_filters( 'aioseo_prev_link', $links['prev'] );
		$links['next'] = apply_filters( 'aioseo_next_link', $links['next'] );

		return $links;
```

### aioseo_next_link
**File:** `all-in-one-seo-pack/app/Common/Meta/Links.php`

**Context:**

```php
}

		$links['prev'] = apply_filters( 'aioseo_prev_link', $links['prev'] );
		$links['next'] = apply_filters( 'aioseo_next_link', $links['next'] );

		return $links;
	}
```

### aioseo_404_robots
**File:** `all-in-one-seo-pack/app/Common/Meta/Robots.php`

**Context:**

```php
}

		if ( is_404() ) {
			return apply_filters( 'aioseo_404_robots', 'noindex' );
		}

		if ( is_archive() ) {
```

### aioseo_robots_meta
**File:** `all-in-one-seo-pack/app/Common/Meta/Robots.php`

**Context:**

```php
$this->attributes['noindex']  = 'noindex';
			$this->attributes['nofollow'] = 'nofollow';
		}

		$this->attributes = array_filter( (array) apply_filters( 'aioseo_robots_meta', $this->attributes ) );

		return $array ? $this->attributes : implode( ', ', $this->attributes );
	}
```

### aioseo_get_post
**File:** `all-in-one-seo-pack/app/Common/Models/Post.php`

**Context:**

```php
// Set options object.
		$post = self::setOptionsDefaults( $post );

		return apply_filters( 'aioseo_get_post', $post );
	}

	/**
```

### aioseo_save_post
**File:** `all-in-one-seo-pack/app/Common/Models/Post.php`

**Context:**

```php
}

		$thePost = self::getPost( $postId );
		$data    = apply_filters( 'aioseo_save_post', $data, $thePost );

		// Before setting the data, we check if the title/description are the same as the defaults and clear them if so.
		$data    = self::checkForDefaultFormat( $postId, $thePost, $data );
```

### aioseo_get_options_internal
**File:** `all-in-one-seo-pack/app/Common/Options/InternalOptions.php`

**Context:**

```php
$this->defaultsMerged,
			$this->addValueToValuesArray( $this->defaultsMerged, $dbOptions )
		);

		aioseo()->core->optionsCache->setOptions( $this->optionsName, apply_filters( 'aioseo_get_options_internal', $options ) );

		// Get the localized options.
		$dbOptionsLocalized = get_option( $this->optionsName . '_localized' );
```

### aioseo_get_options
**File:** `all-in-one-seo-pack/app/Common/Options/Options.php`

**Context:**

```php
$this->defaultsMerged,
			$this->addValueToValuesArray( $this->defaultsMerged, $dbOptions )
		);

		aioseo()->core->optionsCache->setOptions( $this->optionsName, apply_filters( 'aioseo_get_options', $options ) );

		// Get the localized options.
		$dbOptionsLocalized = get_option( $this->optionsName . '_localized' );
```

### aioseo_schema_breadcrumbs_home
**File:** `all-in-one-seo-pack/app/Common/Schema/Breadcrumb.php`

**Context:**

```php
// The homepage needs to be root item of all trails.
		$homepage = [
			// Translators: This refers to the homepage of the site.
			'name'        => apply_filters( 'aioseo_schema_breadcrumbs_home', __( 'Home', 'all-in-one-seo-pack' ) ),
			'description' => aioseo()->meta->description->getHomePageDescription(),
			'url'         => trailingslashit( home_url() ),
			'type'        => 'posts' === get_option( 'show_on_front' ) ? 'CollectionPage' : 'WebPage'
		];
		array_unshift( $breadcrumbs, $homepage );

		$breadcrumbs = array_filter( $breadcrumbs );
```

### aioseo_schema_disable
**File:** `all-in-one-seo-pack/app/Common/Schema/Helpers.php`

**Context:**

```php
*/
	public function isEnabled() {
		$isEnabled = ! in_array( 'enableSchemaMarkup', aioseo()->internalOptions->deprecatedOptions, true ) || aioseo()->options->deprecated->searchAppearance->global->schema->enableSchemaMarkup;

		return ! apply_filters( 'aioseo_schema_disable', ! $isEnabled );
	}

	/**
```

### aioseo_schema_output
**File:** `all-in-one-seo-pack/app/Common/Schema/Helpers.php`

**Context:**

```php
* @return string              The schema as JSON.
	 */
	public function getOutput( $schema, $replaceTags = true ) {
		$schema['@graph'] = apply_filters( 'aioseo_schema_output', $schema['@graph'] );
		$schema['@graph'] = $this->cleanAndParseData( $schema['@graph'], '', $replaceTags );

		// Sort the graphs alphabetically.
```

### aioseo_schema_json_flags
**File:** `all-in-one-seo-pack/app/Common/Schema/Helpers.php`

**Context:**

```php
return strcmp( $typeA, $typeB );
		} );

		// Allow users to control the default json_encode flags.
		// Some users report better SEO performance when non-Latin unicode characters are not escaped.
		$jsonFlags = apply_filters( 'aioseo_schema_json_flags', 0 );

		$json = isset( $_GET['aioseo-dev'] ) || aioseo()->schema->generatingValidatorOutput // phpcs:ignore HM.Security.NonceVerification.Recommended, WordPress.Security.NonceVerification.Recommended
			? aioseo()->helpers->wpJsonEncode( $schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
```

### aioseo_schema_graphs
**File:** `all-in-one-seo-pack/app/Common/Schema/Schema.php`

**Context:**

```php
* @return string The JSON schema output.
	 */
	protected function generateSchema() {
		// Now, filter the graphs.
		$this->graphs = apply_filters(
			'aioseo_schema_graphs',
			array_unique( array_filter( array_values( $this->graphs ) ) )
		);

		if ( ! $this->graphs ) {
			return '';
```

### aioseo_search_cleanup_patterns
**File:** `all-in-one-seo-pack/app/Common/SearchCleanup/SearchCleanup.php`

**Context:**

```php
if ( ! aioseo()->options->searchAppearance->advanced->searchCleanup->settings->commonPatterns ) {
			return;
		}

		$patterns = apply_filters( 'aioseo_search_cleanup_patterns', $this->patterns );
		foreach ( $patterns as $pattern ) {
			if ( preg_match( $pattern, $searchString ) ) {
				aioseo()->helpers->notFoundPage();
```

### aioseo_sitemap_post
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Content.php`

**Context:**

```php
$entry['changefreq'] = aioseo()->sitemap->priority->frequency( 'homePage' );
				$entry['priority']   = aioseo()->sitemap->priority->priority( 'homePage' );
			}

			$entries[] = apply_filters( 'aioseo_sitemap_post', $entry, $post->ID, $postType, 'post' );
		}

		// We can't remove the post type here because other plugins rely on it.
```

### aioseo_sitemap_posts
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Content.php`

**Context:**

```php
$entries[] = apply_filters( 'aioseo_sitemap_post', $entry, $post->ID, $postType, 'post' );
		}

		// We can't remove the post type here because other plugins rely on it.
		return apply_filters( 'aioseo_sitemap_posts', $entries, $postType );
	}

	/**
```

### aioseo_sitemap_archive_entry
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Content.php`

**Context:**

```php
'changefreq' => aioseo()->sitemap->priority->frequency( 'archive' ),
					'priority'   => aioseo()->sitemap->priority->priority( 'archive' ),
				];

				// To be consistent with our other entry filters, we need to pass the entry ID as well, but as null in this case.
				$entries[] = apply_filters( 'aioseo_sitemap_archive_entry', $entry, null, $postType, 'archive' );
			}
		}
```

### aioseo_sitemap_post_archives
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Content.php`

**Context:**

```php
$entries[] = apply_filters( 'aioseo_sitemap_archive_entry', $entry, null, $postType, 'archive' );
			}
		}

		return apply_filters( 'aioseo_sitemap_post_archives', $entries );
	}

	/**
```

### aioseo_sitemap_term
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Content.php`

**Context:**

```php
'priority'   => aioseo()->sitemap->priority->priority( 'taxonomies', $term, $taxonomy ),
				'images'     => aioseo()->sitemap->image->term( $term )
			];

			$entries[] = apply_filters( 'aioseo_sitemap_term', $entry, $term->term_id, $term->taxonomy, 'term' );
		}

		return apply_filters( 'aioseo_sitemap_terms', $entries );
```

### aioseo_sitemap_terms
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Content.php`

**Context:**

```php
$entries[] = apply_filters( 'aioseo_sitemap_term', $entry, $term->term_id, $term->taxonomy, 'term' );
		}

		return apply_filters( 'aioseo_sitemap_terms', $entries );
	}

	/**
```

### aioseo_sitemap_additional_pages
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Content.php`

**Context:**

```php
}

		if ( aioseo()->options->sitemap->general->additionalPages->enable ) {
			$entries = apply_filters( 'aioseo_sitemap_additional_pages', $entries );
		}

		if ( empty( $entries ) ) {
```

### aioseo_sitemap_authors
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Content.php`

**Context:**

```php
) {
			return [];
		}

		// Allow users to filter the authors in case their sites use a membership plugin or have custom code that affect the authors on their site.
		// e.g. there might be additional roles/conditions that need to be checked here.
		$authors = apply_filters( 'aioseo_sitemap_authors', [] );
		if ( empty( $authors ) ) {
			$usersTableName = aioseo()->core->db->db->users; // We get the table name from WPDB since multisites share the same table.
			$authors        = aioseo()->core->db->start( "$usersTableName as u", true )
```

### aioseo_sitemap_author_entry
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Content.php`

**Context:**

```php
'changefreq' => aioseo()->sitemap->priority->frequency( 'author' ),
				'priority'   => aioseo()->sitemap->priority->priority( 'author' )
			];

			$entries[] = apply_filters( 'aioseo_sitemap_author_entry', $entry, $authorData->ID, $authorData->nicename, 'author' );
		}

		return apply_filters( 'aioseo_sitemap_author_archives', $entries );
```

### aioseo_sitemap_author_archives
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Content.php`

**Context:**

```php
$entries[] = apply_filters( 'aioseo_sitemap_author_entry', $entry, $authorData->ID, $authorData->nicename, 'author' );
		}

		return apply_filters( 'aioseo_sitemap_author_archives', $entries );
	}

	/**
```

### aioseo_sitemap_date_entry
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Content.php`

**Context:**

```php
if ( $year !== $date->year ) {
				$year         = $date->year;
				$entry['loc'] = get_year_link( $date->year );
				$entries[]    = apply_filters( 'aioseo_sitemap_date_entry', $entry, $date, 'year', 'date' );
			}

			$entry['loc'] = get_month_link( $date->year, $date->month );
```

### aioseo_sitemap_date_archives
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Content.php`

**Context:**

```php
$entry['loc'] = get_month_link( $date->year, $date->month );
			$entries[]    = apply_filters( 'aioseo_sitemap_date_entry', $entry, $date, 'month', 'date' );
		}

		return apply_filters( 'aioseo_sitemap_date_archives', $entries );
	}

	/**
```

### aioseo_sitemap_post_rss
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Content.php`

**Context:**

```php
if ( aioseo()->helpers->getHomePageId() === $post->ID ) {
				$entry['guid'] = aioseo()->helpers->maybeRemoveTrailingSlash( $entry['guid'] );
			}

			$entries[] = apply_filters( 'aioseo_sitemap_post_rss', $entry, $post->ID, $post->post_type, 'post' );
		}

		usort( $entries, function( $a, $b ) {
```

### aioseo_sitemap_rss
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Content.php`

**Context:**

```php
usort( $entries, function( $a, $b ) {
			return $a['pubDate'] < $b['pubDate'] ? 1 : 0;
		});

		return apply_filters( 'aioseo_sitemap_rss', $entries );
	}

	/**
```

### aioseo_sitemap_product_attributes
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Content.php`

**Context:**

```php
'priority'   => aioseo()->sitemap->priority->priority( 'taxonomies', $term, 'product_attributes' ),
				'images'     => aioseo()->sitemap->image->term( $term )
			];

			$entries[] = apply_filters( 'aioseo_sitemap_product_attributes', $entry, $termId, $term->taxonomy, 'term' );
		}

		return $entries;
```

### aioseo_sitemap_filename
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Helpers.php`

**Context:**

```php
if ( ! $type ) {
			$type = isset( aioseo()->sitemap->type ) ? aioseo()->sitemap->type : 'general';
		}

		return apply_filters( 'aioseo_sitemap_filename', aioseo()->options->sitemap->$type->filename );
	}

	/**
```

### wpml_setting
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Helpers.php`

**Context:**

```php
// Allow WPML to filter out hidden language posts/terms.
		$hiddenObjectIds = [];
		if ( aioseo()->helpers->isWpmlActive() ) {
			$hiddenLanguages = apply_filters( 'wpml_setting', [], 'hidden_languages' );
			foreach ( $hiddenLanguages as $language ) {
				$objectTypes = [];
				if ( 'excludePosts' === $option ) {
```

### aioseo_sitemap_exclude_posts
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Helpers.php`

**Context:**

```php
}

		if ( 'excludePosts' === $option ) {
			$ids = apply_filters( 'aioseo_sitemap_exclude_posts', $ids, $type );
		}

		if ( 'excludeTerms' === $option ) {
```

### aioseo_sitemap_exclude_terms
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Helpers.php`

**Context:**

```php
}

		if ( 'excludeTerms' === $option ) {
			$ids = apply_filters( 'aioseo_sitemap_exclude_terms', $ids, $type );
		}

		return count( $ids ) ? esc_sql( implode( ', ', $ids ) ) : '';
```

### robots_txt
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Helpers.php`

**Context:**

```php
public function extractSitemapUrlsFromRobotsTxt() {
		// First, we need to remove our filter, so that it doesn't run unintentionally.
		remove_filter( 'robots_txt', [ aioseo()->robotsTxt, 'buildRules' ], 10000 );
		$robotsTxt = apply_filters( 'robots_txt', '', true );
		add_filter( 'robots_txt', [ aioseo()->robotsTxt, 'buildRules' ], 10000 );

		if ( ! $robotsTxt ) {
```

### aioseo_sitemap_exclude_images
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Helpers.php`

**Context:**

```php
*/
	public function excludeImages() {
		$shouldExclude = aioseo()->options->sitemap->general->advancedSettings->enable && aioseo()->options->sitemap->general->advancedSettings->excludeImages;

		return apply_filters( 'aioseo_sitemap_exclude_images', $shouldExclude );
	}

	/**
```

### aioseo_sitemap_author_post_types
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Helpers.php`

**Context:**

```php
public function getAuthorPostTypes() {
		// By default, WP only considers posts for author archives, but users can include additional post types.
		$postTypes = [ 'post' ];

		return apply_filters( 'aioseo_sitemap_author_post_types', $postTypes );
	}

	/**
```

### aioseo_html_sitemap_date_format
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Html/Frontend.php`

**Context:**

```php
* @return string       The formatted date.
	 */
	private function formatDate( $date ) {
		$dateFormat = apply_filters( 'aioseo_html_sitemap_date_format', get_option( 'date_format' ) );

		return date_i18n( $dateFormat, strtotime( $date ) );
	}
```

### aioseo_html_sitemap_posts
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Html/Frontend.php`

**Context:**

```php
$entries[] = $entry;
		}

		return apply_filters( 'aioseo_html_sitemap_posts', $entries, $postType );
	}

	/**
```

### aioseo_html_sitemap_terms
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Html/Frontend.php`

**Context:**

```php
'parent' => ! empty( $term->parent ) ? $term->parent : null
			];
		}

		return apply_filters( 'aioseo_html_sitemap_terms', $entries, $taxonomy );
	}

	/**
```

### aioseo_html_sitemap_page_title
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Html/Sitemap.php`

**Context:**

```php
$fakePost->post_author    = 1;
			$fakePost->post_date      = current_time( 'mysql' );
			$fakePost->post_date_gmt  = current_time( 'mysql', 1 );
			$fakePost->post_title     = apply_filters( 'aioseo_html_sitemap_page_title', __( 'Sitemap', 'all-in-one-seo-pack' ) );
			$fakePost->post_content   = '[aioseo_html_sitemap archives=false]';
			// We're using post instead of page to prevent calls to get_ancestors(), which will trigger errors.
			// To loead the page template, we set is_page to true on the WP_Query object.
```

### aioseo_image_sitemap_posts_per_scan
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Image/Image.php`

**Context:**

```php
) {
			return;
		}

		$postsPerScan = apply_filters( 'aioseo_image_sitemap_posts_per_scan', 10 );
		$postTypes    = implode( "', '", aioseo()->helpers->getPublicPostTypes( true ) );

		$posts = aioseo()->core->db
```

### aioseo_sitemap_images
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Image/Image.php`

**Context:**

```php
$images = $this->extract();
		$images = $this->removeImageDimensions( $images );

		$images = apply_filters( 'aioseo_sitemap_images', $images, $post );

		// Limit to a 1,000 URLs, in accordance to Google's specifications.
		$images = array_slice( $images, 0, 1000 );
```

### aioseo_sitemap_localization_disable
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Localization.php`

**Context:**

```php
* @since 4.2.1
	 */
	public function __construct() {
		if ( apply_filters( 'aioseo_sitemap_localization_disable', false ) ) {
			return;
		}

		if ( aioseo()->helpers->isWpmlActive() ) {
```

### wpml_default_language
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Localization.php`

**Context:**

```php
if ( aioseo()->helpers->isWpmlActive() ) {
			self::$wpml = [
				'defaultLanguage' => apply_filters( 'wpml_default_language', null ),
				'activeLanguages' => apply_filters( 'wpml_active_languages', null )
			];

			add_filter( 'aioseo_sitemap_term', [ $this, 'localizeWpml' ], 10, 4 );
			add_filter( 'aioseo_sitemap_post', [ $this, 'localizeWpml' ], 10, 4 );
```

### wpml_active_languages
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Localization.php`

**Context:**

```php
if ( aioseo()->helpers->isWpmlActive() ) {
			self::$wpml = [
				'defaultLanguage' => apply_filters( 'wpml_default_language', null ),
				'activeLanguages' => apply_filters( 'wpml_active_languages', null )
			];

			add_filter( 'aioseo_sitemap_term', [ $this, 'localizeWpml' ], 10, 4 );
			add_filter( 'aioseo_sitemap_post', [ $this, 'localizeWpml' ], 10, 4 );
```

### wpml_element_trid
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Localization.php`

**Context:**

```php
$elementId   = $term->term_taxonomy_id;
			$elementType = 'tax_' . $objectName;
		}

		$translationGroupId = apply_filters( 'wpml_element_trid', null, $elementId, $elementType );
		$translations       = apply_filters( 'wpml_get_element_translations', null, $translationGroupId, $elementType );
		if ( empty( $translations ) ) {
			return $entry;
```

### wpml_get_element_translations
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Localization.php`

**Context:**

```php
}

		$translationGroupId = apply_filters( 'wpml_element_trid', null, $elementId, $elementType );
		$translations       = apply_filters( 'wpml_get_element_translations', null, $translationGroupId, $elementType );
		if ( empty( $translations ) ) {
			return $entry;
		}
```

### wpml_object_id
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Localization.php`

**Context:**

```php
$entry['language'] = $languageCode;
				continue;
			}

			$translatedObjectId = apply_filters( 'wpml_object_id', $entryId, $objectName, false, $translation->language_code );
			if (
				( 'post' === $objectType && $this->isExcludedPost( $translatedObjectId ) ) ||
				( 'term' === $objectType && $this->isExcludedTerm( $translatedObjectId ) )
```

### aioseo_sitemap_show_credits
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Output.php`

**Context:**

```php
$excludeImages = aioseo()->sitemap->helpers->excludeImages();
		$generation    = ! isset( aioseo()->sitemap->isStatic ) || aioseo()->sitemap->isStatic ? __( 'statically', 'all-in-one-seo-pack' ) : __( 'dynamically', 'all-in-one-seo-pack' );
		$version       = aioseo()->helpers->getAioseoVersion();
		$showCredits   = apply_filters( 'aioseo_sitemap_show_credits', true );

		if ( ! empty( $version ) ) {
			$version = 'v' . $version;
```

### aioseo_sitemap_woocommerce_exclude_hidden_products
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Query.php`

**Context:**

```php
private function excludeHiddenProducts( $query ) {
		if (
			! aioseo()->helpers->isWooCommerceActive() ||
			! apply_filters( 'aioseo_sitemap_woocommerce_exclude_hidden_products', true )
		) {
			return $query;
		}

		static $hiddenProductIds = null;
```

### aioseo_sitemap_indexes
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Root.php`

**Context:**

```php
if ( isset( aioseo()->standalone->buddyPress->sitemap ) ) {
			$indexes = array_merge( $indexes, aioseo()->standalone->buddyPress->sitemap->indexes() );
		}

		return apply_filters( 'aioseo_sitemap_indexes', array_filter( $indexes ) );
	}

	/**
```

### aioseo_sitemap_lastmod_disable
**File:** `all-in-one-seo-pack/app/Common/Sitemap/Root.php`

**Context:**

```php
$ids = implode( "', '", $ids );

				$lastModified = null;
				if ( ! apply_filters( 'aioseo_sitemap_lastmod_disable', false ) ) {
					$lastModified = aioseo()->core->db
						->start( aioseo()->core->db->db->posts . ' as p', true )
						->select( 'MAX(`p`.`post_modified_gmt`) as last_modified' )
						->whereRaw( "( `p`.`ID` IN ( '$ids' ) )" )
						->run()
						->result();
				}

				if ( ! empty( $lastModified[0]->last_modified ) ) {
```

### aioseo_opengraph_default_image
**File:** `all-in-one-seo-pack/app/Common/Social/Facebook.php`

**Context:**

```php
if ( ! $image ) {
			$image = aioseo()->helpers->getSiteLogoUrl();
		}

		// Allow users to control the default image per post type.
		return apply_filters(
			'aioseo_opengraph_default_image',
			$image,
			[
				$post,
				$this->getObjectType()
			]
		);
	}

	/**
```

### aioseo_og_locale
**File:** `all-in-one-seo-pack/app/Common/Social/Facebook.php`

**Context:**

```php
$locale = 'en_US';
			}
		}

		return apply_filters( 'aioseo_og_locale', $locale );
	}
}
```

### aioseo_thumbnail_size
**File:** `all-in-one-seo-pack/app/Common/Social/Image.php`

**Context:**

```php
public function getImage( $type, $imageSource, $post = null ) {
		$this->type          = $type;
		$this->post          = $post;
		$this->thumbnailSize = apply_filters( 'aioseo_thumbnail_size', 'fullsize' );
		$hash                = md5( wp_json_encode( [ $type, $imageSource, $post ] ) );

		static $images = [];
```

### aioseo_facebook_tags
**File:** `all-in-one-seo-pack/app/Common/Social/Output.php`

**Context:**

```php
'article:author'         => aioseo()->social->facebook->getAuthor()
			];
		}

		return array_filter( apply_filters( 'aioseo_facebook_tags', $meta ) );
	}

	/**
```

### aioseo_social_twitter_additional_data
**File:** `all-in-one-seo-pack/app/Common/Social/Output.php`

**Context:**

```php
}

		if ( is_singular() ) {
			$additionalData = apply_filters( 'aioseo_social_twitter_additional_data', aioseo()->social->twitter->getAdditionalData() );
			if ( $additionalData ) {
				$i = 1;
				foreach ( $additionalData as $data ) {
```

### aioseo_twitter_tags
**File:** `all-in-one-seo-pack/app/Common/Social/Output.php`

**Context:**

```php
}
			}
		}

		return array_filter( apply_filters( 'aioseo_twitter_tags', $meta ) );
	}
}
```

### aioseo_opengraph_attributes
**File:** `all-in-one-seo-pack/app/Common/Social/Social.php`

**Context:**

```php
if ( ! aioseo()->options->social->facebook->general->enable ) {
			return $htmlTag;
		}

		$attributes = apply_filters( 'aioseo_opengraph_attributes', [ 'prefix="og: https://ogp.me/ns#"' ] );
		foreach ( $attributes as $attr ) {
			if ( strpos( $htmlTag, $attr ) === false ) {
				$htmlTag .= " $attr ";
```

### aioseo_facebook_access_token
**File:** `all-in-one-seo-pack/app/Common/Social/Social.php`

**Context:**

```php
*/
	public function bustOgCachePost( $postId ) {
		$post              = get_post( $postId );
		$customAccessToken = apply_filters( 'aioseo_facebook_access_token', '' );

		if (
			! aioseo()->helpers->isValidPost( $post ) ||
```

### bp_get_activity_content
**File:** `all-in-one-seo-pack/app/Common/Standalone/BuddyPress/Component.php`

**Context:**

```php
// The `content_rendered` is AIOSEO specific.
			$this->activity['content_rendered'] = $this->activity['content'] ?? '';
			if ( ! empty( $this->activity['content'] ) ) {
				$this->activity['content_rendered'] = apply_filters( 'bp_get_activity_content', $this->activity['content'] );
			}

			return;
```

### aioseo_image_seo_media_columns
**File:** `all-in-one-seo-pack/app/Common/Standalone/DetailsColumn.php`

**Context:**

```php
}

		if ( 'attachment' === $screen->post_type ) {
			$enabled = apply_filters( 'aioseo_image_seo_media_columns', true );
			if ( ! $enabled ) {
				return;
			}
```

### aioseo_details_column_post_show_title
**File:** `all-in-one-seo-pack/app/Common/Standalone/DetailsColumn.php`

**Context:**

```php
'nonce'              => $nonce,
			'title'              => $thePost->title,
			'defaultTitle'       => aioseo()->meta->title->getPostTypeTitle( $postType ),
			'showTitle'          => apply_filters( 'aioseo_details_column_post_show_title', true, $postId ),
			'description'        => $thePost->description,
			'defaultDescription' => aioseo()->meta->description->getPostTypeDescription( $postType ),
			'showDescription'    => apply_filters( 'aioseo_details_column_post_show_description', true, $postId ),
			'value'              => ! empty( $thePost->seo_score ) ? (int) $thePost->seo_score : 0,
			'showMedia'          => false,
			'isSpecialPage'      => aioseo()->helpers->isSpecialPage( $postId ),
			'postType'           => $postType,
			'isPostVisible'      => aioseo()->helpers->isPostPubliclyViewable( $postId )
		];

		return $postData;
	}
```

### aioseo_details_column_post_show_description
**File:** `all-in-one-seo-pack/app/Common/Standalone/DetailsColumn.php`

**Context:**

```php
'showTitle'          => apply_filters( 'aioseo_details_column_post_show_title', true, $postId ),
			'description'        => $thePost->description,
			'defaultDescription' => aioseo()->meta->description->getPostTypeDescription( $postType ),
			'showDescription'    => apply_filters( 'aioseo_details_column_post_show_description', true, $postId ),
			'value'              => ! empty( $thePost->seo_score ) ? (int) $thePost->seo_score : 0,
			'showMedia'          => false,
			'isSpecialPage'      => aioseo()->helpers->isSpecialPage( $postId ),
			'postType'           => $postType,
			'isPostVisible'      => aioseo()->helpers->isPostPubliclyViewable( $postId )
		];

		return $postData;
	}
```

### aioseo_flyout_menu_enable
**File:** `all-in-one-seo-pack/app/Common/Standalone/FlyoutMenu.php`

**Context:**

```php
* @return bool Whether the flyout menu is enabled.
	 */
	public function isEnabled() {
		return apply_filters( 'aioseo_flyout_menu_enable', true );
	}
}
```

### aioseo_last_modified_date_disable
**File:** `all-in-one-seo-pack/app/Common/Standalone/LimitModifiedDate.php`

**Context:**

```php
* @return void
	 */
	public function __construct() {
		if ( apply_filters( 'aioseo_last_modified_date_disable', false ) ) {
			return;
		}

		// Reset modified date when the post is updated.
```

### aioseo_limit_modified_date_post_types
**File:** `all-in-one-seo-pack/app/Common/Standalone/LimitModifiedDate.php`

**Context:**

```php
private function isAllowedPostType( $postType ) {
		$dynamicOptions = aioseo()->dynamicOptions->noConflict();
		$postTypes      = aioseo()->helpers->getPublicPostTypes( true );
		$postTypes      = apply_filters( 'aioseo_limit_modified_date_post_types', $postTypes );

		if ( ! in_array( $postType, $postTypes, true ) ) {
			return false;
```

### aioseo_page_builder_integration_disable
**File:** `all-in-one-seo-pack/app/Common/Standalone/PageBuilders/Base.php`

**Context:**

```php
if ( ! $this->isPluginActive() && ! $this->isThemeActive() ) {
			return;
		}

		// Check if we can proceed with the integration.
		if ( apply_filters( 'aioseo_page_builder_integration_disable', false, $this->integrationSlug ) ) {
			return;
		}

		$this->init();
```

### aioseo_page_builder_integration_plugins
**File:** `all-in-one-seo-pack/app/Common/Standalone/PageBuilders/Base.php`

**Context:**

```php
*/
	public function isPluginActive() {
		include_once ABSPATH . 'wp-admin/includes/plugin.php';

		$plugins = apply_filters( 'aioseo_page_builder_integration_plugins', $this->plugins, $this->integrationSlug );

		foreach ( $plugins as $basename ) {
			if ( is_plugin_active( $basename ) ) {
```

### aioseo_page_builder_integration_themes
**File:** `all-in-one-seo-pack/app/Common/Standalone/PageBuilders/Base.php`

**Context:**

```php
* @return bool Whether or not the theme is active.
	 */
	public function isThemeActive() {
		$themes = apply_filters( 'aioseo_page_builder_integration_themes', $this->themes, $this->integrationSlug );

		$theme = wp_get_theme();
		foreach ( $themes as $name ) {
```

### aioseo_seo_preview_disable
**File:** `all-in-one-seo-pack/app/Common/Standalone/SeoPreview.php`

**Context:**

```php
* @since 4.2.8
	 */
	public function __construct() {
		// Allow users to disable SEO Preview.
		if ( apply_filters( 'aioseo_seo_preview_disable', false ) ) {
			return;
		}

		// Hook into `wp` in order to have access to the WP queried object.
```

### aioseo_user_profile_tab_disable
**File:** `all-in-one-seo-pack/app/Common/Standalone/UserProfileTab.php`

**Context:**

```php
* @return void
	 */
	public function enqueueScript() {
		if ( apply_filters( 'aioseo_user_profile_tab_disable', false ) ) {
			return;
		}

		$screen = aioseo()->helpers->getCurrentScreen();
```

### aioseo_normalize_assets_host
**File:** `all-in-one-seo-pack/app/Common/Traits/Assets.php`

**Context:**

```php
public function normalizeAssetsHost( $path ) {
		static $paths = [];
		if ( isset( $paths[ $path ] ) ) {
			return apply_filters( 'aioseo_normalize_assets_host', $paths[ $path ] );
		}

		// We need to verify the domain on the $path attribute matches
```

### aioseo_conflicting_blocks
**File:** `all-in-one-seo-pack/app/Common/Traits/Helpers/Blocks.php`

**Context:**

```php
*/
	public function doBlocks( $content, $noConflict = true ) {
		if ( $noConflict ) {
			$conflictingBlocks = apply_filters( 'aioseo_conflicting_blocks', $this->conflictingBlocks );

			static $preRenderBlockCallback = null;
			if ( null === $preRenderBlockCallback ) {
```

### aioseo_disable_shortcode_parsing
**File:** `all-in-one-seo-pack/app/Common/Traits/Helpers/Shortcodes.php`

**Context:**

```php
}

		if ( ! wp_doing_cron() && ! wp_doing_ajax() ) {
			if ( ! $override && apply_filters( 'aioseo_disable_shortcode_parsing', false ) ) {
				return $content;
			}

			if ( ! $override && ! aioseo()->options->searchAppearance->advanced->runShortcodes ) {
```

### aioseo_allowed_shortcode_tags
**File:** `all-in-one-seo-pack/app/Common/Traits/Helpers/Shortcodes.php`

**Context:**

```php
if ( ! count( $tags ) ) {
			return $content;
		}

		$allowedTags  = apply_filters( 'aioseo_allowed_shortcode_tags', $allowedTags );
		$tagsToRemove = array_diff( $tags, $allowedTags );

		$content = $this->doShortcodesHelper( $content, $tagsToRemove, $postId );
```

### aioseo_conflicting_shortcodes
**File:** `all-in-one-seo-pack/app/Common/Traits/Helpers/Shortcodes.php`

**Context:**

```php
private function doShortcodesHelper( $content, $tagsToRemove = [], $postId = 0 ) {
		global $shortcode_tags; // phpcs:ignore Squiz.NamingConventions.ValidVariableName
		$conflictingShortcodes = array_merge( $tagsToRemove, $this->conflictingShortcodes );
		$conflictingShortcodes = apply_filters( 'aioseo_conflicting_shortcodes', $conflictingShortcodes );

		$tagsToRemove = [];
		foreach ( $conflictingShortcodes as $shortcode ) {
```

### aioseo_title_case_exceptions
**File:** `all-in-one-seo-pack/app/Common/Traits/Helpers/Strings.php`

**Context:**

```php
* @return string         The converted string.
	 */
	public function toTitleCase( $string ) {
		// List of common English words that aren't typically modified.
		$exceptions = apply_filters( 'aioseo_title_case_exceptions', [
			'of',
			'a',
			'the',
			'and',
			'an',
			'or',
			'nor',
			'but',
			'is',
			'if',
			'then',
			'else',
			'when',
			'at',
			'from',
			'by',
			'on',
			'off',
			'for',
			'in',
			'out',
			'over',
			'to',
			'into',
			'with'
		] );

		$words = explode( ' ', strtolower( $string ) );
```

### localization
**File:** `all-in-one-seo-pack/app/Common/Traits/Helpers/ThirdParty.php`

**Context:**

```php
} elseif ( function_exists( 'qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage' ) ) {
			$in = qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage( $in );
		}

		return apply_filters( 'localization', $in );
	}

	/**
```

### wpml_home_url
**File:** `all-in-one-seo-pack/app/Common/Traits/Helpers/ThirdParty.php`

**Context:**

```php
* @return string $url  The filtered URL.
	 */
	public function localizedUrl( $path ) {
		$url = apply_filters( 'wpml_home_url', home_url( '/' ) );

		// Remove URL parameters.
		preg_match_all( '/\?[\s\S]+/', (string) $url, $matches );
```

### aioseo_is_amp_page
**File:** `all-in-one-seo-pack/app/Common/Traits/Helpers/ThirdParty.php`

**Context:**

```php
! function_exists( 'ampforwp_is_amp_endpoint' ) &&
			! function_exists( 'is_amp_wp' )
		) {
			// If none of the AMP plugin functions are found, return false and allow compatibility with custom implementations.
			return apply_filters( 'aioseo_is_amp_page', false );
		}

		// AMP plugin requires the `wp` action to be called to function properly, otherwise, it will throw warnings.
```

### aioseo_vue_additional_scripts_enabled
**File:** `all-in-one-seo-pack/app/Common/Traits/Helpers/Vue.php`

**Context:**

```php
'dynamicOptions'     => aioseo()->dynamicOptions->all(),
			'deprecatedOptions'  => aioseo()->internalOptions->getAllDeprecatedOptions( true ),
			'settings'           => aioseo()->settings->all(),
			'additional_scripts' => apply_filters( 'aioseo_vue_additional_scripts_enabled', true ),
			'tags'               => aioseo()->tags->all( true ),
			'nonce'              => wp_create_nonce( 'wp_rest' ),
			'urls'               => [
				'domain'            => $this->getSiteDomain(),
				'mainSiteUrl'       => $this->getSiteUrl(),
				'siteLogo'          => aioseo()->helpers->getSiteLogoUrl(),
				'home'              => home_url(),
				'restUrl'           => aioseo()->helpers->getRestUrl(),
				'editScreen'        => admin_url( 'edit.php' ),
				'publicPath'        => aioseo()->core->assets->normalizeAssetsHost( plugin_dir_url( AIOSEO_FILE ) ),
				'assetsPath'        => aioseo()->core->assets->getAssetsPath(),
				'generalSitemapUrl' => aioseo()->sitemap->helpers->getUrl( 'general' ),
				'rssSitemapUrl'     => aioseo()->sitemap->helpers->getUrl( 'rss' ),
				'llmsUrl'           => aioseo()->llms->getUrl(),
				'robotsTxtUrl'      => $this->getSiteUrl() . '/robots.txt',
				'marketingSiteUrl'  => $this->getMarketingSiteUrl(),
				'upgradeUrl'        => apply_filters( 'aioseo_upgrade_link', AIOSEO_MARKETING_URL . 'lite-upgrade/' ),
				'staticHomePage'    => 'page' === get_option( 'show_on_front' ) ? get_edit_post_link( get_option( 'page_on_front' ), 'url' ) : null,
				'feeds'             => [
					'rdf'            => get_bloginfo( 'rdf_url' ),
					'rss'            => get_bloginfo( 'rss_url' ),
					'atom'           => get_bloginfo( 'atom_url' ),
					'global'         => get_bloginfo( 'rss2_url' ),
					'globalComments' => get_bloginfo( 'comments_rss2_url' ),
					'staticBlogPage' => $this->getBlogPageId() ? trailingslashit( get_permalink( $this->getBlogPageId() ) ) . 'feed' : ''
				],
				'connect'           => add_query_arg( [
					'siteurl'  => site_url(),
					'homeurl'  => home_url(),
					'redirect' => rawurldecode( base64_encode( admin_url( 'index.php?page=aioseo-connect' ) ) )
				], defined( 'AIOSEO_CONNECT_URL' ) ? AIOSEO_CONNECT_URL : 'https://connect.aioseo.com' ),
				'aio'               => [
					'about'            => is_network_admin() ? network_admin_url( 'admin.php?page=aioseo-about' ) : admin_url( 'admin.php?page=aioseo-about' ),
					'dashboard'        => admin_url( 'admin.php?page=aioseo' ),
					'featureManager'   => admin_url( 'admin.php?page=aioseo-feature-manager' ),
					'linkAssistant'    => admin_url( 'admin.php?page=aioseo-link-assistant' ),
					'localSeo'         => admin_url( 'admin.php?page=aioseo-local-seo' ),
					'monsterinsights'  => admin_url( 'admin.php?page=aioseo-monsterinsights' ),
					'redirects'        => admin_url( 'admin.php?page=aioseo-redirects' ),
					'searchAppearance' => admin_url( 'admin.php?page=aioseo-search-appearance' ),
					'searchStatistics' => admin_url( 'admin.php?page=aioseo-search-statistics' ),
					'seoAnalysis'      => admin_url( 'admin.php?page=aioseo-seo-analysis' ),
					'settings'         => admin_url( 'admin.php?page=aioseo-settings' ),
					'sitemaps'         => admin_url( 'admin.php?page=aioseo-sitemaps' ),
					'socialNetworks'   => admin_url( 'admin.php?page=aioseo-social-networks' ),
					'tools'            => admin_url( 'admin.php?page=aioseo-tools' ),
					'wizard'           => admin_url( 'index.php?page=aioseo-setup-wizard' ),
					'networkSettings'  => is_network_admin() ? network_admin_url( 'admin.php?page=aioseo-settings' ) : '',
					'seoRevisions'     => admin_url( 'admin.php?page=aioseo-seo-revisions' ),
				],
				'admin'             => [
					'widgets'          => admin_url( 'widgets.php' ),
					'optionsReading'   => admin_url( 'options-reading.php' ),
					'scheduledActions' => admin_url( '/tools.php?page=action-scheduler&status=pending&s=aioseo' ),
					'generalSettings'  => admin_url( 'options-general.php' )
				],
				'truSeoWorker'      => aioseo()->core->assets->jsUrl( 'src/app/tru-seo/analyzer/main.js' )
			],
			'backups'            => [],
			'importers'          => [],
			'data'               => [
				'server'                => aioseo()->helpers->getServerName(),
				'robots'                => [
					'defaultRules'      => [],
					'hasPhysicalRobots' => null,
					'rewriteExists'     => null,
					'sitemapUrls'       => []
				],
				'status'                => [],
				'htaccess'              => '',
				'isMultisite'           => is_multisite(),
				'isNetworkAdmin'        => is_network_admin(),
				'currentBlogId'         => get_current_blog_id(),
				'mainSite'              => is_main_site(),
				'subdomain'             => $this->isSubdomain(),
				'isBBPressActive'       => class_exists( 'bbPress' ),
				'isClassicEditorActive' => $this->isClassicEditorActive(),
				'isWooCommerceActive'   => $this->isWooCommerceActive(),
				'staticHomePage'        => $isStaticHomePage ? $staticHomePage : false,
				'staticBlogPage'        => $this->getBlogPageId(),
				'staticBlogPageTitle'   => get_the_title( $this->getBlogPageId() ),
				'isDev'                 => $this->isDev(),
				'isLocal'               => $this->isLocalUrl( site_url() ),
				'isSsl'                 => is_ssl(),
				'hasUrlTrailingSlash'   => '/' === user_trailingslashit( '' ),
				'permalinkStructure'    => get_option( 'permalink_structure' ),
				'usingPermalinks'       => aioseo()->helpers->usingPermalinks(),
				'dateFormat'            => get_option( 'date_format' ),
				'timeFormat'            => get_option( 'time_format' ),
				'siteName'              => aioseo()->helpers->getWebsiteName(),
				'adminEmail'            => get_bloginfo( 'admin_email' ),
				'blocks'                => [
					'toc' => [
						'hashPrefix' => apply_filters( 'aioseo_toc_hash_prefix', 'aioseo-' )
					]
				],
				'vueComponentsDefaults' => $this->getVueComponentsDefaults(),
			],
			'user'               => [
				'canManage'      => aioseo()->access->canManage(),
				'capabilities'   => aioseo()->access->getAllCapabilities(),
				'customRoles'    => $this->getCustomRoles(),
				'data'           => wp_get_current_user(),
				'locale'         => function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale(),
				'roles'          => $this->getUserRoles(),
				'unfilteredHtml' => current_user_can( 'unfiltered_html' )
			],
			'plugins'            => $this->getPluginData(),
			'postData'           => [
				'postTypes'    => array_values( $this->getPublicPostTypes( false, false, true ) ),
				'taxonomies'   => array_values( $this->getPublicTaxonomies( false, true ) ),
				'archives'     => array_values( $this->getPublicPostTypes( false, true, true ) ),
				'postStatuses' => array_values( $this->getPublicPostStatuses() )
			],
			'notifications'      => array_merge( Models\Notification::getNotifications( true ), [
				'force' => $this->showNotificationsDrawer()
			] ),
			'addons'             => aioseo()->addons->getAddons(),
			'features'           => aioseo()->features->getFeatures(),
			'version'            => AIOSEO_VERSION,
			'wpVersion'          => get_bloginfo( 'version' ),
			'phpVersion'         => PHP_VERSION,
			'helpPanel'          => aioseo()->help->getDocs(),
			'scheduledActions'   => [
				'sitemaps' => []
			],
			'integration'        => $this->args['integration'],
			'theme'              => [
				'features' => aioseo()->helpers->getThemeFeatures()
			]
		];
	}

	/**
```

### aioseo_upgrade_link
**File:** `all-in-one-seo-pack/app/Common/Traits/Helpers/Vue.php`

**Context:**

```php
'llmsUrl'           => aioseo()->llms->getUrl(),
				'robotsTxtUrl'      => $this->getSiteUrl() . '/robots.txt',
				'marketingSiteUrl'  => $this->getMarketingSiteUrl(),
				'upgradeUrl'        => apply_filters( 'aioseo_upgrade_link', AIOSEO_MARKETING_URL . 'lite-upgrade/' ),
				'staticHomePage'    => 'page' === get_option( 'show_on_front' ) ? get_edit_post_link( get_option( 'page_on_front' ), 'url' ) : null,
				'feeds'             => [
					'rdf'            => get_bloginfo( 'rdf_url' ),
					'rss'            => get_bloginfo( 'rss_url' ),
					'atom'           => get_bloginfo( 'atom_url' ),
					'global'         => get_bloginfo( 'rss2_url' ),
					'globalComments' => get_bloginfo( 'comments_rss2_url' ),
					'staticBlogPage' => $this->getBlogPageId() ? trailingslashit( get_permalink( $this->getBlogPageId() ) ) . 'feed' : ''
				],
				'connect'           => add_query_arg( [
					'siteurl'  => site_url(),
					'homeurl'  => home_url(),
					'redirect' => rawurldecode( base64_encode( admin_url( 'index.php?page=aioseo-connect' ) ) )
				], defined( 'AIOSEO_CONNECT_URL' ) ? AIOSEO_CONNECT_URL : 'https://connect.aioseo.com' ),
				'aio'               => [
					'about'            => is_network_admin() ? network_admin_url( 'admin.php?page=aioseo-about' ) : admin_url( 'admin.php?page=aioseo-about' ),
					'dashboard'        => admin_url( 'admin.php?page=aioseo' ),
					'featureManager'   => admin_url( 'admin.php?page=aioseo-feature-manager' ),
					'linkAssistant'    => admin_url( 'admin.php?page=aioseo-link-assistant' ),
					'localSeo'         => admin_url( 'admin.php?page=aioseo-local-seo' ),
					'monsterinsights'  => admin_url( 'admin.php?page=aioseo-monsterinsights' ),
					'redirects'        => admin_url( 'admin.php?page=aioseo-redirects' ),
					'searchAppearance' => admin_url( 'admin.php?page=aioseo-search-appearance' ),
					'searchStatistics' => admin_url( 'admin.php?page=aioseo-search-statistics' ),
					'seoAnalysis'      => admin_url( 'admin.php?page=aioseo-seo-analysis' ),
					'settings'         => admin_url( 'admin.php?page=aioseo-settings' ),
					'sitemaps'         => admin_url( 'admin.php?page=aioseo-sitemaps' ),
					'socialNetworks'   => admin_url( 'admin.php?page=aioseo-social-networks' ),
					'tools'            => admin_url( 'admin.php?page=aioseo-tools' ),
					'wizard'           => admin_url( 'index.php?page=aioseo-setup-wizard' ),
					'networkSettings'  => is_network_admin() ? network_admin_url( 'admin.php?page=aioseo-settings' ) : '',
					'seoRevisions'     => admin_url( 'admin.php?page=aioseo-seo-revisions' ),
				],
				'admin'             => [
					'widgets'          => admin_url( 'widgets.php' ),
					'optionsReading'   => admin_url( 'options-reading.php' ),
					'scheduledActions' => admin_url( '/tools.php?page=action-scheduler&status=pending&s=aioseo' ),
					'generalSettings'  => admin_url( 'options-general.php' )
				],
				'truSeoWorker'      => aioseo()->core->assets->jsUrl( 'src/app/tru-seo/analyzer/main.js' )
			],
			'backups'            => [],
			'importers'          => [],
			'data'               => [
				'server'                => aioseo()->helpers->getServerName(),
				'robots'                => [
					'defaultRules'      => [],
					'hasPhysicalRobots' => null,
					'rewriteExists'     => null,
					'sitemapUrls'       => []
				],
				'status'                => [],
				'htaccess'              => '',
				'isMultisite'           => is_multisite(),
				'isNetworkAdmin'        => is_network_admin(),
				'currentBlogId'         => get_current_blog_id(),
				'mainSite'              => is_main_site(),
				'subdomain'             => $this->isSubdomain(),
				'isBBPressActive'       => class_exists( 'bbPress' ),
				'isClassicEditorActive' => $this->isClassicEditorActive(),
				'isWooCommerceActive'   => $this->isWooCommerceActive(),
				'staticHomePage'        => $isStaticHomePage ? $staticHomePage : false,
				'staticBlogPage'        => $this->getBlogPageId(),
				'staticBlogPageTitle'   => get_the_title( $this->getBlogPageId() ),
				'isDev'                 => $this->isDev(),
				'isLocal'               => $this->isLocalUrl( site_url() ),
				'isSsl'                 => is_ssl(),
				'hasUrlTrailingSlash'   => '/' === user_trailingslashit( '' ),
				'permalinkStructure'    => get_option( 'permalink_structure' ),
				'usingPermalinks'       => aioseo()->helpers->usingPermalinks(),
				'dateFormat'            => get_option( 'date_format' ),
				'timeFormat'            => get_option( 'time_format' ),
				'siteName'              => aioseo()->helpers->getWebsiteName(),
				'adminEmail'            => get_bloginfo( 'admin_email' ),
				'blocks'                => [
					'toc' => [
						'hashPrefix' => apply_filters( 'aioseo_toc_hash_prefix', 'aioseo-' )
					]
				],
				'vueComponentsDefaults' => $this->getVueComponentsDefaults(),
			],
			'user'               => [
				'canManage'      => aioseo()->access->canManage(),
				'capabilities'   => aioseo()->access->getAllCapabilities(),
				'customRoles'    => $this->getCustomRoles(),
				'data'           => wp_get_current_user(),
				'locale'         => function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale(),
				'roles'          => $this->getUserRoles(),
				'unfilteredHtml' => current_user_can( 'unfiltered_html' )
			],
			'plugins'            => $this->getPluginData(),
			'postData'           => [
				'postTypes'    => array_values( $this->getPublicPostTypes( false, false, true ) ),
				'taxonomies'   => array_values( $this->getPublicTaxonomies( false, true ) ),
				'archives'     => array_values( $this->getPublicPostTypes( false, true, true ) ),
				'postStatuses' => array_values( $this->getPublicPostStatuses() )
			],
			'notifications'      => array_merge( Models\Notification::getNotifications( true ), [
				'force' => $this->showNotificationsDrawer()
			] ),
			'addons'             => aioseo()->addons->getAddons(),
			'features'           => aioseo()->features->getFeatures(),
			'version'            => AIOSEO_VERSION,
			'wpVersion'          => get_bloginfo( 'version' ),
			'phpVersion'         => PHP_VERSION,
			'helpPanel'          => aioseo()->help->getDocs(),
			'scheduledActions'   => [
				'sitemaps' => []
			],
			'integration'        => $this->args['integration'],
			'theme'              => [
				'features' => aioseo()->helpers->getThemeFeatures()
			]
		];
	}

	/**
```

### aioseo_toc_hash_prefix
**File:** `all-in-one-seo-pack/app/Common/Traits/Helpers/Vue.php`

**Context:**

```php
'adminEmail'            => get_bloginfo( 'admin_email' ),
				'blocks'                => [
					'toc' => [
						'hashPrefix' => apply_filters( 'aioseo_toc_hash_prefix', 'aioseo-' )
					]
				],
				'vueComponentsDefaults' => $this->getVueComponentsDefaults(),
			],
			'user'               => [
				'canManage'      => aioseo()->access->canManage(),
				'capabilities'   => aioseo()->access->getAllCapabilities(),
				'customRoles'    => $this->getCustomRoles(),
				'data'           => wp_get_current_user(),
				'locale'         => function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale(),
				'roles'          => $this->getUserRoles(),
				'unfilteredHtml' => current_user_can( 'unfiltered_html' )
			],
			'plugins'            => $this->getPluginData(),
			'postData'           => [
				'postTypes'    => array_values( $this->getPublicPostTypes( false, false, true ) ),
				'taxonomies'   => array_values( $this->getPublicTaxonomies( false, true ) ),
				'archives'     => array_values( $this->getPublicPostTypes( false, true, true ) ),
				'postStatuses' => array_values( $this->getPublicPostStatuses() )
			],
			'notifications'      => array_merge( Models\Notification::getNotifications( true ), [
				'force' => $this->showNotificationsDrawer()
			] ),
			'addons'             => aioseo()->addons->getAddons(),
			'features'           => aioseo()->features->getFeatures(),
			'version'            => AIOSEO_VERSION,
			'wpVersion'          => get_bloginfo( 'version' ),
			'phpVersion'         => PHP_VERSION,
			'helpPanel'          => aioseo()->help->getDocs(),
			'scheduledActions'   => [
				'sitemaps' => []
			],
			'integration'        => $this->args['integration'],
			'theme'              => [
				'features' => aioseo()->helpers->getThemeFeatures()
			]
		];
	}

	/**
```

### aioseo_description_include_custom_fields
**File:** `all-in-one-seo-pack/app/Common/Traits/Helpers/Vue.php`

**Context:**

```php
'editlink'                       => aioseo()->helpers->getPostEditLink( $postId ),
			'title'                          => ! empty( $post->title ) ? $post->title : aioseo()->meta->title->getPostTypeTitle( $postTypeObj->name ),
			'description'                    => ! empty( $post->description ) ? $post->description : aioseo()->meta->description->getPostTypeDescription( $postTypeObj->name ),
			'descriptionIncludeCustomFields' => apply_filters( 'aioseo_description_include_custom_fields', true, $post ),
			'keywords'                       => ! empty( $post->keywords ) ? $post->keywords : [],
			'keyphrases'                     => Models\Post::getKeyphrasesDefaults( $post->keyphrases ),
			'page_analysis'                  => Models\Post::getPageAnalysisDefaults( $post->page_analysis ),
			'loading'                        => [
				'focus'      => false,
				'additional' => [],
			],
			'type'                           => $postTypeObj->labels->singular_name,
			'postType'                       => 'type' === $postTypeObj->name ? '_aioseo_type' : $postTypeObj->name,
			'postStatus'                     => get_post_status( $postId ),
			'postAuthor'                     => (int) $wpPost->post_author,
			'isSpecialPage'                  => $this->isSpecialPage( $postId ),
			'isTruSeoEligible'               => $this->isTruSeoEligible( $postId ),
			'isStaticPostsPage'              => aioseo()->helpers->isStaticPostsPage(),
			'isHomePage'                     => $postId === $staticHomePage,
			'isWooCommercePageWithoutSchema' => $this->isWooCommercePageWithoutSchema( $postId ),
			'seo_score'                      => (int) $post->seo_score,
			'pillar_content'                 => ( (int) $post->pillar_content ) === 0 ? false : true,
			'canonicalUrl'                   => $post->canonical_url,
			'default'                        => ( (int) $post->robots_default ) === 0 ? false : true,
			'noindex'                        => ( (int) $post->robots_noindex ) === 0 ? false : true,
			'noarchive'                      => ( (int) $post->robots_noarchive ) === 0 ? false : true,
			'nosnippet'                      => ( (int) $post->robots_nosnippet ) === 0 ? false : true,
			'nofollow'                       => ( (int) $post->robots_nofollow ) === 0 ? false : true,
			'noimageindex'                   => ( (int) $post->robots_noimageindex ) === 0 ? false : true,
			'noodp'                          => ( (int) $post->robots_noodp ) === 0 ? false : true,
			'notranslate'                    => ( (int) $post->robots_notranslate ) === 0 ? false : true,
			'maxSnippet'                     => null === $post->robots_max_snippet ? -1 : (int) $post->robots_max_snippet,
			'maxVideoPreview'                => null === $post->robots_max_videopreview ? -1 : (int) $post->robots_max_videopreview,
			'maxImagePreview'                => $post->robots_max_imagepreview,
			'modalOpen'                      => false,
			'generalMobilePrev'              => false,
			'og_object_type'                 => ! empty( $post->og_object_type ) ? $post->og_object_type : 'default',
			'og_title'                       => $post->og_title,
			'og_description'                 => $post->og_description,
			'og_image_custom_url'            => $post->og_image_custom_url,
			'og_image_custom_fields'         => $post->og_image_custom_fields,
			'og_image_type'                  => ! empty( $post->og_image_type ) ? $post->og_image_type : 'default',
			'og_video'                       => ! empty( $post->og_video ) ? $post->og_video : '',
			'og_article_section'             => ! empty( $post->og_article_section ) ? $post->og_article_section : '',
			'og_article_tags'                => ! empty( $post->og_article_tags ) ? $post->og_article_tags : [],
			'twitter_use_og'                 => ( (int) $post->twitter_use_og ) === 0 ? false : true,
			'twitter_card'                   => $post->twitter_card,
			'twitter_image_custom_url'       => $post->twitter_image_custom_url,
			'twitter_image_custom_fields'    => $post->twitter_image_custom_fields,
			'twitter_image_type'             => $post->twitter_image_type,
			'twitter_title'                  => $post->twitter_title,
			'twitter_description'            => $post->twitter_description,
			'ai'                             => Models\Post::getDefaultAiOptions( $post->ai ),
			'schema'                         => Models\Post::getDefaultSchemaOptions( $post->schema, aioseo()->helpers->getPost( $postId ) ),
			'metaDefaults'                   => [
				'title'       => aioseo()->meta->title->getPostTypeTitle( $postTypeObj->name ),
				'description' => aioseo()->meta->description->getPostTypeDescription( $postTypeObj->name )
			],
			'linkAssistant'                  => [
				'modalOpen' => false
			],
			'limit_modified_date'            => ( (int) $post->limit_modified_date ) === 0 ? false : true,
			'redirects'                      => [
				'modalOpen' => false
			],
			'options'                        => $post->options,
			'maxAdditionalKeyphrases'        => 0,
		];

		if ( empty( $this->args['integration'] ) ) {
			$this->data['integration'] = aioseo()->helpers->getPostPageBuilderName( $postId );
```

### aioseo_vue_components_defaults
**File:** `all-in-one-seo-pack/app/Common/Traits/Helpers/Vue.php`

**Context:**

```php
'maxGroups' => 50
			]
		];

		return apply_filters( 'aioseo_vue_components_defaults', $defaults );
	}
}
```

### aioseo_get_post_id
**File:** `all-in-one-seo-pack/app/Common/Traits/Helpers/WpContext.php`

**Context:**

```php
if ( ! $postId && $learnPressLesson ) {
			$postId = $learnPressLesson;
		}

		// Allow other plugins to filter the post ID e.g. for a special archive page.
		$postId = apply_filters( 'aioseo_get_post_id', $postId );

		// We need to check these conditions and cannot always return get_post() because we'll return the first post on archive pages (dynamic homepage, term pages, etc.).
```

### aioseo_access_control_excluded_roles
**File:** `all-in-one-seo-pack/app/Common/Traits/Helpers/Wp.php`

**Context:**

```php
[ 'superadmin', 'administrator', 'editor', 'author', 'contributor' ],
			// Default AIOSEO roles.
			[ 'aioseo_manager', 'aioseo_editor' ],
			// Filterable roles.
			apply_filters( 'aioseo_access_control_excluded_roles', array_merge( [
				'subscriber'
			], aioseo()->helpers->isWooCommerceActive() ? [ 'customer' ] : [] ) )
		);

		// Remove empty entries.
		$toSkip = array_filter( $toSkip );
```

### aioseo_public_post_types
**File:** `all-in-one-seo-pack/app/Common/Traits/Helpers/Wp.php`

**Context:**

```php
if ( isset( aioseo()->standalone->buddyPress ) ) {
			aioseo()->standalone->buddyPress->maybeAddPostTypes( $postTypes, $namesOnly, $hasArchivesOnly, $args );
		}

		return apply_filters( 'aioseo_public_post_types', $postTypes, $namesOnly, $hasArchivesOnly, $args );
	}

	/**
```

### aioseo_public_taxonomies
**File:** `all-in-one-seo-pack/app/Common/Traits/Helpers/Wp.php`

**Context:**

```php
];
			}
		}

		return apply_filters( 'aioseo_public_taxonomies', $taxonomies, $namesOnly );
	}

	/**
```

### aioseo_canonical_url
**File:** `all-in-one-seo-pack/app/Common/Traits/Helpers/WpUri.php`

**Context:**

```php
}

		if ( is_404() || is_search() ) {
			$url[ $hash ] = apply_filters( 'aioseo_canonical_url', '' );

			return $url[ $hash ];
		}
```

### aioseo_disable_canonical_url_amp
**File:** `all-in-one-seo-pack/app/Common/Traits/Helpers/WpUri.php`

**Context:**

```php
// Get rid of /amp at the end of the URL.
		if (
			aioseo()->helpers->isAmpPage() &&
			! apply_filters( 'aioseo_disable_canonical_url_amp', false )
		) {
			$url[ $hash ] = preg_replace( '/\/amp$/', '', (string) $url[ $hash ] );
			$url[ $hash ] = preg_replace( '/\/amp\/$/', '/', (string) $url[ $hash ] );
		}
```

### get_canonical_url
**File:** `all-in-one-seo-pack/app/Common/Traits/Helpers/WpUri.php`

**Context:**

```php
$canonical_url = get_comments_pagenum_link( $cpage ); // phpcs:ignore Squiz.NamingConventions.ValidVariableName
			}
		}

		return apply_filters( 'get_canonical_url', $canonical_url, $post ); // phpcs:ignore Squiz.NamingConventions.ValidVariableName
	}

	/**
	 * Checks if permalinks are enabled.
	 *
	 * @since 4.8.3
	 *
	 * @return bool Whether permalinks are enabled.
	 */
	public function usingPermalinks() {
		global $wp_rewrite; // phpcs:ignore Squiz.NamingConventions.ValidVariableName

		return $wp_rewrite->using_permalinks();  // phpcs:ignore Squiz.NamingConventions.ValidVariableName
	}
}
```

### action_scheduler_enable_recreate_data_store
**File:** `all-in-one-seo-pack/app/Common/Utils/ActionScheduler.php`

**Context:**

```php
if ( ! is_admin() ) {
			return;
		}

		if ( ! apply_filters( 'action_scheduler_enable_recreate_data_store', true ) ) {
			return;
		}

		if (
```

### aioseo_hide_version_number
**File:** `all-in-one-seo-pack/app/Common/Utils/Helpers.php`

**Context:**

```php
*/
	public function getAioseoVersion() {
		$version = aioseo()->version;

		if ( ! $this->isDev() && apply_filters( 'aioseo_hide_version_number', false ) ) {
			$version = '';
		}

		return $version;
```

### aioseo_format_date
**File:** `all-in-one-seo-pack/app/Common/Utils/Tags.php`

**Context:**

```php
$format        = get_option( 'date_format' );
		$formattedDate = date_i18n( $format, $date );

		return apply_filters(
			'aioseo_format_date',
			$formattedDate,
			[
				$date,
				$format
			]
		);
	}

	/**
```

### aioseo_locate_template
**File:** `all-in-one-seo-pack/app/Common/Utils/Templates.php`

**Context:**

```php
}
			}
		}

		return apply_filters( 'aioseo_locate_template', $template, $templateName );
	}

	/**
```

### aioseo_template_path
**File:** `all-in-one-seo-pack/app/Common/Utils/Templates.php`

**Context:**

```php
* @return string The theme folder for templates.
	 */
	public function getThemeTemplatePath() {
		return apply_filters( 'aioseo_template_path', $this->themeTemplatePath );
	}

	/**
```

### aioseo_template_subpath
**File:** `all-in-one-seo-pack/app/Common/Utils/Templates.php`

**Context:**

```php
* @return string The theme subfolder for templates.
	 */
	public function getThemeTemplateSubpath() {
		return apply_filters( 'aioseo_template_subpath', $this->themeTemplateSubpath );
	}
}
```

### aioseo_author_meta
**File:** `all-in-one-seo-pack/app/Common/Views/main/meta.php`

**Context:**

```php
<?php
endif;
if (
	apply_filters( 'aioseo_author_meta', true ) &&
	! is_page() &&
	post_type_supports( $postType, 'author' ) &&
	! empty( $post->post_author ) &&
	! empty( get_the_author_meta( 'display_name', $post->post_author ) )
) :
	?>
```

### aioseo_usage_tracking_enable
**File:** `all-in-one-seo-pack/app/Lite/Admin/Usage.php`

**Context:**

```php
*/
	public function __construct() {
		parent::__construct();

		$this->enabled = apply_filters( 'aioseo_usage_tracking_enable', aioseo()->options->advanced->usageTracking );
	}

	/**
```

## Actions (3)

### aioseo_insert_post
**File:** `all-in-one-seo-pack/app/Common/Api/PostsTerms.php`

**Context:**

```php
$aioseoPost->description = $body['description'];
		$aioseoPost->updated     = gmdate( 'Y-m-d H:i:s' );
		$aioseoPost->save();

		// Trigger the action hook so we can create a revision.
		do_action( 'aioseo_insert_post', $postId );

		$lastError = aioseo()->core->db->lastError();
		if ( ! empty( $lastError ) ) {
```

### aioseo_run_updates
**File:** `all-in-one-seo-pack/app/Common/Main/Updates.php`

**Context:**

```php
$lastActiveVersion = aioseo()->internalOptions->internal->lastActiveVersion;
		// Don't run updates if the last active version is the same as the current version.
		if ( aioseo()->version === $lastActiveVersion ) {
			// Allow addons to run their updates.
			do_action( 'aioseo_run_updates', $lastActiveVersion );

			return;
		}
```

### admin_footer
**File:** `all-in-one-seo-pack/app/Common/Standalone/SetupWizard.php`

**Context:**

```php
wp_print_scripts( 'aioseo-vendors' );
		wp_print_scripts( 'aioseo-common' );
		wp_print_scripts( 'aioseo-setup-wizard-script' );
		do_action( 'admin_footer', '' );
		do_action( 'admin_print_footer_scripts' );
		// do_action( 'customize_controls_print_footer_scripts' );
		?>
```

