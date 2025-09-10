## Filters (297)

### seopress_adminbar_icon
**File:** `wp-seopress/inc/admin/admin-bar/admin-bar.php`

**Context:**

```php
}

    $title = '<div id="seopress-ab-icon" class="ab-item svg seopress-logo" style="background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz48c3ZnIGlkPSJ1dWlkLTRmNmE4YTQxLTE4ZTMtNGY3Ny1iNWE5LTRiMWIzOGFhMmRjOSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB2aWV3Qm94PSIwIDAgODk5LjY1NSA0OTQuMzA5NCI+PHBhdGggaWQ9InV1aWQtYTE1NWMxY2EtZDg2OC00NjUzLTg0NzctOGRkODcyNDBhNzY1IiBkPSJNMzI3LjM4NDksNDM1LjEyOGwtMjk5Ljk5OTktLjI0OTdjLTE2LjI3MzUsMS4xOTM3LTI4LjQ5ODEsMTUuMzUzOC0yNy4zMDQ0LDMxLjYyNzMsMS4wNzE5LDE0LjYxMjgsMTIuNjkxNiwyNi4yMzI1LDI3LjMwNDQsMjcuMzA0NGwyOTkuOTk5OSwuMjQ5N2MxNi4yNzM1LTEuMTkzNywyOC40OTgxLTE1LjM1MzgsMjcuMzA0NC0zMS42MjczLTEuMDcxOC0xNC42MTI4LTEyLjY5MTYtMjYuMjMyNS0yNy4zMDQ0LTI3LjMwNDRaIiBzdHlsZT0iZmlsbDojYTdhYWFkIi8+PHBhdGggaWQ9InV1aWQtZTMwYmE0YzYtNDc2OS00NjZiLWEwM2EtZTY0NGM1MTk4ZTU2IiBkPSJNMjcuMzg0OSw1OC45MzE3bDI5OS45OTk5LC4yNDk3YzE2LjI3MzUtMS4xOTM3LDI4LjQ5ODEtMTUuMzUzNywyNy4zMDQ0LTMxLjYyNzMtMS4wNzE4LTE0LjYxMjgtMTIuNjkxNi0yNi4yMzI1LTI3LjMwNDQtMjcuMzA0NEwyNy4zODQ5LDBDMTEuMTExNCwxLjE5MzctMS4xMTMyLDE1LjM1MzcsLjA4MDUsMzEuNjI3M2MxLjA3MTksMTQuNjEyOCwxMi42OTE2LDI2LjIzMjUsMjcuMzA0NCwyNy4zMDQ0WiIgc3R5bGU9ImZpbGw6I2E3YWFhZCIvPjxwYXRoIGlkPSJ1dWlkLTJiYmQ1MmQ2LWFlYzEtNDY4OS05ZDRjLTIzYzM1ZDRmMjJiOCIgZD0iTTY1Mi40ODUsLjI4NDljLTEyNC45Mzg4LC4wNjQtMjMwLjE1NTQsOTMuNDEzMi0yNDUuMTAwMSwyMTcuNDU1SDI3LjM4NDljLTE2LjI3MzUsMS4xOTM3LTI4LjQ5ODEsMTUuMzUzNy0yNy4zMDQ0LDMxLjYyNzIsMS4wNzE5LDE0LjYxMjgsMTIuNjkxNiwyNi4yMzI1LDI3LjMwNDQsMjcuMzA0NEg0MDcuMzg0OWMxNi4yMjk4LDEzNS40NDU0LDEzOS4xODcsMjMyLjA4ODgsMjc0LjYzMjMsMjE1Ljg1ODksMTM1LjQ0NTUtMTYuMjI5OCwyMzIuMDg4OC0xMzkuMTg2OSwyMTUuODU4OS0yNzQuNjMyNEM4ODIuOTkyMSw5My42ODM0LDc3Ny41ODg0LC4yMTEyLDY1Mi40ODUsLjI4NDlabTAsNDMzLjQyMTdjLTEwMi45NzU0LDAtMTg2LjQ1MzMtODMuNDc4LTE4Ni40NTMzLTE4Ni40NTMzLDAtMTAyLjk3NTMsODMuNDc4MS0xODYuNDUzMywxODYuNDUzMy0xODYuNDUzMywxMDIuOTc1NCwwLDE4Ni40NTMzLDgzLjQ3OCwxODYuNDUzMywxODYuNDUzMywuMDUyNCwxMDIuOTc1My04My4zODMsMTg2LjQ5NTktMTg2LjM1ODMsMTg2LjU0ODMtLjAzMTYsMC0uMDYzNCwwLS4wOTUxLDB2LS4wOTVaIiBzdHlsZT0iZmlsbDojYTdhYWFkIi8+PC9zdmc+) !important"></div> ' . __('SEO', 'wp-seopress');
    
    $title = apply_filters('seopress_adminbar_icon', $title);
    
    $counter = '';
    if ('1' !== seopress_get_service('AdvancedOption')->getAppearanceAdminBarCounter() && $total > 0) {
```

### seopress_adminbar_counter
**File:** `wp-seopress/inc/admin/admin-bar/admin-bar.php`

**Context:**

```php
$counter = '';
    if ('1' !== seopress_get_service('AdvancedOption')->getAppearanceAdminBarCounter() && $total > 0) {
        $counter = '<div class="wp-core-ui wp-ui-notification seopress-menu-notification-counter">' . $total . '</div>';

        $counter = apply_filters('seopress_adminbar_counter', $counter, $total);
    }
    $noindex = '';
```

### seopress_adminbar_noindex
**File:** `wp-seopress/inc/admin/admin-bar/admin-bar.php`

**Context:**

```php
$noindex .= __('noindex is on!', 'wp-seopress');
            $noindex .= '</a>';
        }
    
        $noindex = apply_filters('seopress_adminbar_noindex', $noindex ?? '');
    }

    // Adds a new top level admin bar link and a submenu to it
```

### seopress_get_dynamic_variables
**File:** `wp-seopress/inc/admin/admin-dyn-variables-helper.php`

**Context:**

```php
function seopress_get_dyn_variables()
{
    return apply_filters('seopress_get_dynamic_variables', [
        '%%sep%%'                           => __('Separator', 'wp-seopress'),
        '%%sitetitle%%'                     => __('Site Title', 'wp-seopress'),
        '%%tagline%%'                       => __('Tagline', 'wp-seopress'),
        '%%post_title%%'                    => __('Post Title', 'wp-seopress'),
        '%%post_excerpt%%'                  => __('Post excerpt', 'wp-seopress'),
        '%%post_content%%'                  => __('Post content / product description', 'wp-seopress'),
        '%%post_thumbnail_url%%'            => __('Post thumbnail URL', 'wp-seopress'),
        '%%post_url%%'                      => __('Post URL', 'wp-seopress'),
        '%%post_date%%'                     => __('Post date', 'wp-seopress'),
        '%%post_modified_date%%'            => __('Post modified date', 'wp-seopress'),
        '%%post_author%%'                   => __('Post author', 'wp-seopress'),
        '%%post_category%%'                 => __('Post category', 'wp-seopress'),
        '%%post_tag%%'                      => __('Post tag', 'wp-seopress'),
        '%%_category_title%%'               => __('Category title', 'wp-seopress'),
        '%%_category_description%%'         => __('Category description', 'wp-seopress'),
        '%%tag_title%%'                     => __('Tag title', 'wp-seopress'),
        '%%tag_description%%'               => __('Tag description', 'wp-seopress'),
        '%%term_title%%'                    => __('Term title', 'wp-seopress'),
        '%%term_description%%'              => __('Term description', 'wp-seopress'),
        '%%search_keywords%%'               => __('Search keywords', 'wp-seopress'),
        '%%current_pagination%%'            => __('Current number page', 'wp-seopress'),
        '%%page%%'                          => __('Page number with context', 'wp-seopress'),
        '%%cpt_plural%%'                    => __('Plural Post Type Archive name', 'wp-seopress'),
        '%%archive_title%%'                 => __('Archive title', 'wp-seopress'),
        '%%archive_date%%'                  => __('Archive date', 'wp-seopress'),
        '%%archive_date_day%%'              => __('Day Archive date', 'wp-seopress'),
        '%%archive_date_month%%'            => __('Month Archive title', 'wp-seopress'),
        '%%archive_date_month_name%%'       => __('Month name Archive title', 'wp-seopress'),
        '%%archive_date_year%%'             => __('Year Archive title', 'wp-seopress'),
        '%%_cf_your_custom_field_name%%'    => __('Custom fields from post, page, post type and term taxonomy', 'wp-seopress'),
        '%%_ct_your_custom_taxonomy_slug%%' => __('Custom term taxonomy from post, page or post type', 'wp-seopress'),
        '%%wc_single_cat%%'                 => __('Single product category', 'wp-seopress'),
        '%%wc_single_tag%%'                 => __('Single product tag', 'wp-seopress'),
        '%%wc_single_short_desc%%'          => __('Single product short description', 'wp-seopress'),
        '%%wc_single_price%%'               => __('Single product price', 'wp-seopress'),
        '%%wc_single_price_exc_tax%%'       => __('Single product price taxes excluded', 'wp-seopress'),
        '%%wc_sku%%'                        => __('Single SKU product', 'wp-seopress'),
        '%%currentday%%'                    => __('Current day', 'wp-seopress'),
        '%%currentmonth%%'                  => __('Current month', 'wp-seopress'),
        '%%currentmonth_short%%'            => __('Current month in 3 letters', 'wp-seopress'),
        '%%currentyear%%'                   => __('Current year', 'wp-seopress'),
        '%%currentdate%%'                   => __('Current date', 'wp-seopress'),
        '%%currenttime%%'                   => __('Current time', 'wp-seopress'),
        '%%author_first_name%%'             => __('Author first name', 'wp-seopress'),
        '%%author_last_name%%'              => __('Author last name', 'wp-seopress'),
        '%%author_website%%'                => __('Author website', 'wp-seopress'),
        '%%author_nickname%%'               => __('Author nickname', 'wp-seopress'),
        '%%author_bio%%'                    => __('Author biography', 'wp-seopress'),
        '%%_ucf_your_user_meta%%'           => __('Custom User Meta', 'wp-seopress'),
        '%%currentmonth_num%%'              => __('Current month in digital format', 'wp-seopress'),
        '%%target_keyword%%'                => __('Target keyword', 'wp-seopress'),
    ]);
}

/**
```

### seopress_tools_tabs
**File:** `wp-seopress/inc/admin/admin-pages/Tools.php`

**Context:**

```php
'tab_seopress_tool_plugins'        => esc_html__('Plugins', 'wp-seopress'),
                'tab_seopress_tool_reset'          => esc_html__('Reset', 'wp-seopress'),
            ];

            $plugin_settings_tabs = apply_filters('seopress_tools_tabs', $plugin_settings_tabs);
        ?>
```

### seopress_seo_admin_menu
**File:** `wp-seopress/inc/admin/admin.php`

**Context:**

```php
* Add options page.
	 */
	public function setup_admin_pages() {
		$menu_icon = apply_filters(
			'seopress_seo_admin_menu',
			'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz48c3ZnIGlkPSJ1dWlkLTRmNmE4YTQxLTE4ZTMtNGY3Ny1iNWE5LTRiMWIzOGFhMmRjOSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB2aWV3Qm94PSIwIDAgODk5LjY1NSA0OTQuMzA5NCI+PHBhdGggaWQ9InV1aWQtYTE1NWMxY2EtZDg2OC00NjUzLTg0NzctOGRkODcyNDBhNzY1IiBkPSJNMzI3LjM4NDksNDM1LjEyOGwtMjk5Ljk5OTktLjI0OTdjLTE2LjI3MzUsMS4xOTM3LTI4LjQ5ODEsMTUuMzUzOC0yNy4zMDQ0LDMxLjYyNzMsMS4wNzE5LDE0LjYxMjgsMTIuNjkxNiwyNi4yMzI1LDI3LjMwNDQsMjcuMzA0NGwyOTkuOTk5OSwuMjQ5N2MxNi4yNzM1LTEuMTkzNywyOC40OTgxLTE1LjM1MzgsMjcuMzA0NC0zMS42MjczLTEuMDcxOC0xNC42MTI4LTEyLjY5MTYtMjYuMjMyNS0yNy4zMDQ0LTI3LjMwNDRaIiBzdHlsZT0iZmlsbDojZmZmOyIvPjxwYXRoIGlkPSJ1dWlkLWUzMGJhNGM2LTQ3NjktNDY2Yi1hMDNhLWU2NDRjNTE5OGU1NiIgZD0iTTI3LjM4NDksNTguOTMxN2wyOTkuOTk5OSwuMjQ5N2MxNi4yNzM1LTEuMTkzNywyOC40OTgxLTE1LjM1MzcsMjcuMzA0NC0zMS42MjczLTEuMDcxOC0xNC42MTI4LTEyLjY5MTYtMjYuMjMyNS0yNy4zMDQ0LTI3LjMwNDRMMjcuMzg0OSwwQzExLjExMTQsMS4xOTM3LTEuMTEzMiwxNS4zNTM3LC4wODA1LDMxLjYyNzNjMS4wNzE5LDE0LjYxMjgsMTIuNjkxNiwyNi4yMzI1LDI3LjMwNDQsMjcuMzA0NFoiIHN0eWxlPSJmaWxsOiNmZmY7Ii8+PHBhdGggaWQ9InV1aWQtMmJiZDUyZDYtYWVjMS00Njg5LTlkNGMtMjNjMzVkNGYyMmI4IiBkPSJNNjUyLjQ4NSwuMjg0OWMtMTI0LjkzODgsLjA2NC0yMzAuMTU1NCw5My40MTMyLTI0NS4xMDAxLDIxNy40NTVIMjcuMzg0OWMtMTYuMjczNSwxLjE5MzctMjguNDk4MSwxNS4zNTM3LTI3LjMwNDQsMzEuNjI3MiwxLjA3MTksMTQuNjEyOCwxMi42OTE2LDI2LjIzMjUsMjcuMzA0NCwyNy4zMDQ0SDQwNy4zODQ5YzE2LjIyOTgsMTM1LjQ0NTQsMTM5LjE4NywyMzIuMDg4OCwyNzQuNjMyMywyMTUuODU4OSwxMzUuNDQ1NS0xNi4yMjk4LDIzMi4wODg4LTEzOS4xODY5LDIxNS44NTg5LTI3NC42MzI0Qzg4Mi45OTIxLDkzLjY4MzQsNzc3LjU4ODQsLjIxMTIsNjUyLjQ4NSwuMjg0OVptMCw0MzMuNDIxN2MtMTAyLjk3NTQsMC0xODYuNDUzMy04My40NzgtMTg2LjQ1MzMtMTg2LjQ1MzMsMC0xMDIuOTc1Myw4My40NzgxLTE4Ni40NTMzLDE4Ni40NTMzLTE4Ni40NTMzLDEwMi45NzU0LDAsMTg2LjQ1MzMsODMuNDc4LDE4Ni40NTMzLDE4Ni40NTMzLC4wNTI0LDEwMi45NzUzLTgzLjM4MywxODYuNDk1OS0xODYuMzU4MywxODYuNTQ4My0uMDMxNiwwLS4wNjM0LDAtLjA5NTEsMHYtLjA5NVoiIHN0eWxlPSJmaWxsOiNmZmY7Ii8+PC9zdmc+'
		);
		
		$menu_title = apply_filters('seopress_seo_admin_menu_title', __('SEO', 'wp-seopress'));
```

### seopress_seo_admin_menu_title
**File:** `wp-seopress/inc/admin/admin.php`

**Context:**

```php
'seopress_seo_admin_menu',
			'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz48c3ZnIGlkPSJ1dWlkLTRmNmE4YTQxLTE4ZTMtNGY3Ny1iNWE5LTRiMWIzOGFhMmRjOSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB2aWV3Qm94PSIwIDAgODk5LjY1NSA0OTQuMzA5NCI+PHBhdGggaWQ9InV1aWQtYTE1NWMxY2EtZDg2OC00NjUzLTg0NzctOGRkODcyNDBhNzY1IiBkPSJNMzI3LjM4NDksNDM1LjEyOGwtMjk5Ljk5OTktLjI0OTdjLTE2LjI3MzUsMS4xOTM3LTI4LjQ5ODEsMTUuMzUzOC0yNy4zMDQ0LDMxLjYyNzMsMS4wNzE5LDE0LjYxMjgsMTIuNjkxNiwyNi4yMzI1LDI3LjMwNDQsMjcuMzA0NGwyOTkuOTk5OSwuMjQ5N2MxNi4yNzM1LTEuMTkzNywyOC40OTgxLTE1LjM1MzgsMjcuMzA0NC0zMS42MjczLTEuMDcxOC0xNC42MTI4LTEyLjY5MTYtMjYuMjMyNS0yNy4zMDQ0LTI3LjMwNDRaIiBzdHlsZT0iZmlsbDojZmZmOyIvPjxwYXRoIGlkPSJ1dWlkLWUzMGJhNGM2LTQ3NjktNDY2Yi1hMDNhLWU2NDRjNTE5OGU1NiIgZD0iTTI3LjM4NDksNTguOTMxN2wyOTkuOTk5OSwuMjQ5N2MxNi4yNzM1LTEuMTkzNywyOC40OTgxLTE1LjM1MzcsMjcuMzA0NC0zMS42MjczLTEuMDcxOC0xNC42MTI4LTEyLjY5MTYtMjYuMjMyNS0yNy4zMDQ0LTI3LjMwNDRMMjcuMzg0OSwwQzExLjExMTQsMS4xOTM3LTEuMTEzMiwxNS4zNTM3LC4wODA1LDMxLjYyNzNjMS4wNzE5LDE0LjYxMjgsMTIuNjkxNiwyNi4yMzI1LDI3LjMwNDQsMjcuMzA0NFoiIHN0eWxlPSJmaWxsOiNmZmY7Ii8+PHBhdGggaWQ9InV1aWQtMmJiZDUyZDYtYWVjMS00Njg5LTlkNGMtMjNjMzVkNGYyMmI4IiBkPSJNNjUyLjQ4NSwuMjg0OWMtMTI0LjkzODgsLjA2NC0yMzAuMTU1NCw5My40MTMyLTI0NS4xMDAxLDIxNy40NTVIMjcuMzg0OWMtMTYuMjczNSwxLjE5MzctMjguNDk4MSwxNS4zNTM3LTI3LjMwNDQsMzEuNjI3MiwxLjA3MTksMTQuNjEyOCwxMi42OTE2LDI2LjIzMjUsMjcuMzA0NCwyNy4zMDQ0SDQwNy4zODQ5YzE2LjIyOTgsMTM1LjQ0NTQsMTM5LjE4NywyMzIuMDg4OCwyNzQuNjMyMywyMTUuODU4OSwxMzUuNDQ1NS0xNi4yMjk4LDIzMi4wODg4LTEzOS4xODY5LDIxNS44NTg5LTI3NC42MzI0Qzg4Mi45OTIxLDkzLjY4MzQsNzc3LjU4ODQsLjIxMTIsNjUyLjQ4NSwuMjg0OVptMCw0MzMuNDIxN2MtMTAyLjk3NTQsMC0xODYuNDUzMy04My40NzgtMTg2LjQ1MzMtMTg2LjQ1MzMsMC0xMDIuOTc1Myw4My40NzgxLTE4Ni40NTMzLDE4Ni40NTMzLTE4Ni40NTMzLDEwMi45NzU0LDAsMTg2LjQ1MzMsODMuNDc4LDE4Ni40NTMzLDE4Ni40NTMzLC4wNTI0LDEwMi45NzUzLTgzLjM4MywxODYuNDk1OS0xODYuMzU4MywxODYuNTQ4My0uMDMxNiwwLS4wNjM0LDAtLjA5NTEsMHYtLjA5NVoiIHN0eWxlPSJmaWxsOiNmZmY7Ii8+PC9zdmc+'
		);
		
		$menu_title = apply_filters('seopress_seo_admin_menu_title', __('SEO', 'wp-seopress'));
		
		// SEO Dashboard page
		add_menu_page(
```

### seopress_features_list_before_tools
**File:** `wp-seopress/inc/admin/blocks/features-list.php`

**Context:**

```php
'filter'        => 'seopress_remove_feature_advanced',
			],
		];

		$features = apply_filters('seopress_features_list_before_tools', $features);

		$features['tools'] = [
			'svg'           => SEOPRESS_URL_ASSETS . '/img/ico-tools.svg',
```

### seopress_features_list_after_tools
**File:** `wp-seopress/inc/admin/blocks/features-list.php`

**Context:**

```php
'filter'        => 'seopress_remove_feature_tools',
			'toggle'        => false,
		];

		$features = apply_filters('seopress_features_list_after_tools', $features);

		if (! empty($features)) { ?>
```

### $value['filter']
**File:** `wp-seopress/inc/admin/blocks/features-list.php`

**Context:**

```php
<?php foreach ($features as $key => $value) {
					if (isset($value['filter'])) {
						$seopress_feature = apply_filters($value['filter'], true);
					}

					if (true === $seopress_feature) {
```

### seopress_sitemaps_cpt
**File:** `wp-seopress/inc/admin/callbacks/Sitemaps.php`

**Context:**

```php
$postTypes = array_filter($postTypes, 'is_post_type_viewable');

    $postTypes[] = get_post_type_object('attachment');

    $postTypes = apply_filters( 'seopress_sitemaps_cpt', $postTypes );

    foreach ($postTypes as $seopress_cpt_key => $seopress_cpt_value) {
        ?>
```

### seopress_sitemaps_tax
**File:** `wp-seopress/inc/admin/callbacks/Sitemaps.php`

**Context:**

```php
$taxonomies = seopress_get_service('WordPressData')->getTaxonomies();

    $taxonomies = array_filter($taxonomies, 'is_taxonomy_viewable');

    $taxonomies = apply_filters( 'seopress_sitemaps_tax', $taxonomies );

    foreach ($taxonomies as $seopress_tax_key => $seopress_tax_value) { ?>
```

### seopress_metabox_seo_tabs
**File:** `wp-seopress/inc/admin/metaboxes/admin-metaboxes-form.php`

**Context:**

```php
$seo_tabs['advanced-tab'] = '<li><a href="#tabs-3">' . __('Advanced', 'wp-seopress') . '<span id="sp-advanced-alert"></span></a></li>';
					}
					$seo_tabs['redirect-tab'] = '<li><a href="#tabs-4">' . __('Redirection', 'wp-seopress') . '</a></li>';

		$seo_tabs = apply_filters('seopress_metabox_seo_tabs', $seo_tabs, $typenow, $pagenow);

		if ( ! empty($seo_tabs)) { ?>
```

### seopress_toggle_mobile_preview
**File:** `wp-seopress/inc/admin/metaboxes/admin-metaboxes-form.php`

**Context:**

```php
<?php
					$toggle_preview = 1;
					$toggle_preview = apply_filters('seopress_toggle_mobile_preview', $toggle_preview);
				?>
```

### seopress_primary_category_list
**File:** `wp-seopress/inc/admin/metaboxes/admin-metaboxes.php`

**Context:**

```php
$seopress_robots_primary_cat = get_post_meta($post->ID, '_seopress_robots_primary_cat', true);

	$cats = 'product' == $typenow && seopress_get_service('WooCommerceActivate')->isActive() ? get_the_terms( $post, 'product_cat' ) : get_categories();
	$cats = apply_filters( 'seopress_primary_category_list', $cats );
	$options = '';

	if( ! empty( $cats ) ){
```

### seopress_metaboxe_seo
**File:** `wp-seopress/inc/admin/metaboxes/admin-metaboxes.php`

**Context:**

```php
}

		$seopress_get_post_types = seopress_get_service('WordPressData')->getPostTypes();

		$seopress_get_post_types = apply_filters('seopress_metaboxe_seo', $seopress_get_post_types);

		if (!empty($seopress_get_post_types) && !seopress_get_service('EnqueueModuleMetabox')->canEnqueue()) {
			foreach ($seopress_get_post_types as $key => $value) {
```

### seopress_metaboxe_content_analysis
**File:** `wp-seopress/inc/admin/metaboxes/admin-metaboxes.php`

**Context:**

```php
}

		$seopress_get_post_types = seopress_get_service('WordPressData')->getPostTypes();

		$seopress_get_post_types = apply_filters('seopress_metaboxe_content_analysis', $seopress_get_post_types);

		if (!empty($seopress_get_post_types) && !seopress_get_service('EnqueueModuleMetabox')->canEnqueue()) {
			foreach ($seopress_get_post_types as $key => $value) {
```

### seopress_metaboxe_term_seo
**File:** `wp-seopress/inc/admin/metaboxes/admin-term-metaboxes.php`

**Context:**

```php
function seopress_init_term_metabox() {
        $seopress_get_taxonomies = seopress_get_service('WordPressData')->getTaxonomies();
        $seopress_get_taxonomies = apply_filters('seopress_metaboxe_term_seo', $seopress_get_taxonomies);

        if ( ! empty($seopress_get_taxonomies)) {
            if (!empty(seopress_get_service('AdvancedOption')->getAppearanceMetaboxePosition())) {
```

### seopress_metaboxe_term_seo_priority
**File:** `wp-seopress/inc/admin/metaboxes/admin-term-metaboxes.php`

**Context:**

```php
} else {
                $priority = 10;
            }

            $priority = apply_filters('seopress_metaboxe_term_seo_priority', $priority);

            foreach ($seopress_get_taxonomies as $key => $value) {
                add_action($key . '_edit_form', 'seopress_tax', $priority, 2); //Edit term page
```

### seopress_resize_panel_elementor
**File:** `wp-seopress/inc/admin/page-builders/elementor/inc/controls/class-social-preview-control.php`

**Context:**

```php
);

        wp_localize_script('sp-el-social-preview-script', 'seopressFiltersElementor', [
            'resize_panel' => apply_filters('seopress_resize_panel_elementor', true),
        ]);
    }

    protected function get_default_settings() {
```

### seopress_faq_block_inline_css
**File:** `wp-seopress/inc/admin/page-builders/gutenberg/blocks/faq/block.php`

**Context:**

```php
// Load our inline CSS only once
                    if (!isset($css)) {
                        $css = '<style>.wpseopress-hide {display: none;}.wpseopress-accordion-button{width:100%}</style>';
                        $css = apply_filters( 'seopress_faq_block_inline_css', $css );
                        echo $css;
                    }
                }
```

### seopress_schemas_faq_html
**File:** `wp-seopress/inc/admin/page-builders/gutenberg/blocks/faq/block.php`

**Context:**

```php
"mainEntity": '. wp_json_encode($entities) . '
				}
			</script>';

        echo apply_filters('seopress_schemas_faq_html', $schema);
    }
    $html = apply_filters('seopress_faq_block_html', ob_get_clean());
    return $html;
```

### seopress_faq_block_html
**File:** `wp-seopress/inc/admin/page-builders/gutenberg/blocks/faq/block.php`

**Context:**

```php
echo apply_filters('seopress_schemas_faq_html', $schema);
    }
    $html = apply_filters('seopress_faq_block_html', ob_get_clean());
    return $html;
}
```

### seopress_enable_setup_wizard
**File:** `wp-seopress/inc/admin/wizard/admin-wizard.php`

**Context:**

```php
* Hook in tabs.
	 */
	public function __construct() {
		if (apply_filters('seopress_enable_setup_wizard', true) && current_user_can(seopress_capability('manage_options', 'Admin_Setup_Wizard'))) {
			add_action('admin_menu', [$this, 'load_wizard'], 20);

			add_action('admin_head', [ $this, 'hide_from_menus' ], 20);
```

### seopress_setup_wizard_steps
**File:** `wp-seopress/inc/admin/wizard/admin-wizard.php`

**Context:**

```php
],
			]
		];

		$this->steps = apply_filters('seopress_setup_wizard_steps', $default_steps);
		$this->step  = isset($_GET['step']) ? sanitize_key($_GET['step']) : current(array_keys($this->steps));
		$this->parent  = isset($_GET['parent']) ? sanitize_key($_GET['parent']) : current(array_keys($this->steps));
```

### seopress_image_seo_before_cleaning
**File:** `wp-seopress/inc/functions/options-advanced-admin.php`

**Context:**

```php
add_filter('sanitize_file_name', 'seopress_image_seo_cleaning_filename', 10);
function seopress_image_seo_cleaning_filename($filename) {
    if (seopress_get_service('AdvancedOption')->getAdvancedCleaningFileName() === '1') {
        $filename = apply_filters( 'seopress_image_seo_before_cleaning', $filename );

        /* Force the file name in UTF-8 (encoding Windows / OS X / Linux) */
        $filename = wp_check_invalid_utf8($filename, true);
```

### seopress_image_seo_clean_input
**File:** `wp-seopress/inc/functions/options-advanced-admin.php`

**Context:**

```php
$filename = wp_check_invalid_utf8($filename, true);

        $char_not_clean = ['/•/','/·/','/À/','/Á/','/Â/','/Ã/','/Ä/','/Å/','/Ç/','/È/','/É/','/Ê/','/Ë/','/Ì/','/Í/','/Î/','/Ï/','/Ò/','/Ó/','/Ô/','/Õ/','/Ö/','/Ù/','/Ú/','/Û/','/Ü/','/Ý/','/à/','/á/','/â/','/ã/','/ä/','/å/','/ç/','/è/','/é/','/ê/','/ë/','/ì/','/í/','/î/','/ï/','/ð/','/ò/','/ó/','/ô/','/õ/','/ö/','/ù/','/ú/','/û/','/ü/','/ý/','/ÿ/', '/©/'];

        $char_not_clean = apply_filters( 'seopress_image_seo_clean_input', $char_not_clean );

        $clean = ['-','-','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','o','o','o','o','o','u','u','u','u','y','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','o','o','o','o','o','o','u','u','u','u','y','y','copy'];
```

### seopress_image_seo_clean_output
**File:** `wp-seopress/inc/functions/options-advanced-admin.php`

**Context:**

```php
$char_not_clean = apply_filters( 'seopress_image_seo_clean_input', $char_not_clean );

        $clean = ['-','-','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','o','o','o','o','o','u','u','u','u','y','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','o','o','o','o','o','o','u','u','u','u','y','y','copy'];

        $clean = apply_filters( 'seopress_image_seo_clean_output', $clean );

        $friendly_filename = preg_replace($char_not_clean, $clean, $filename);
```

### seopress_image_seo_after_cleaning
**File:** `wp-seopress/inc/functions/options-advanced-admin.php`

**Context:**

```php
/* Remove uppercase */
        $friendly_filename = strtolower($friendly_filename);

        $friendly_filename = apply_filters( 'seopress_image_seo_after_cleaning', $friendly_filename );

        $filename = $friendly_filename;
    }
```

### seopress_auto_image_title
**File:** `wp-seopress/inc/functions/options-advanced-admin.php`

**Context:**

```php
// Lowercase attributes
            $img_attr = strtolower($img_attr);

            $img_attr = apply_filters('seopress_auto_image_title', $img_attr, $cpt, $parent, $post_ID);

            // Create an array with the image meta (Title, Caption, Description) to be updated
            $img_attr_array = ['ID' => $post_ID]; // Image (ID) to be updated
```

### seopress_auto_image_attr
**File:** `wp-seopress/inc/functions/options-advanced-admin.php`

**Context:**

```php
if ('1' === seopress_get_service('AdvancedOption')->getImageAutoDescriptionEditor()) {
                $img_attr_array['post_content'] = $img_attr; // Set image Desc
            }

            $img_attr_array = apply_filters('seopress_auto_image_attr', $img_attr_array);

            // Set the image Alt-Text
            if ('1' === seopress_get_service('AdvancedOption')->getImageAutoAltEditor() || true === $bulk) {
```

### seopress_link_attrs
**File:** `wp-seopress/inc/functions/options-advanced.php`

**Context:**

```php
"noreferrer " => "",
        " noreferrer" => ""
    ];

    $attrs = apply_filters( 'seopress_link_attrs', $attrs );

    return strtr($content, $attrs);
}
```

### seopress_auto_image_alt_target_kw
**File:** `wp-seopress/inc/functions/options-advanced.php`

**Context:**

```php
if (empty($atts['alt'])) {
                if ('' != get_post_meta(get_the_ID(), '_seopress_analysis_target_kw', true)) {
                    $atts['alt'] = esc_html(get_post_meta(get_the_ID(), '_seopress_analysis_target_kw', true));

                    $atts['alt'] = apply_filters('seopress_auto_image_alt_target_kw', $atts['alt']);
                }
            }
        }
```

### seopress_category_rewrite_rules
**File:** `wp-seopress/inc/functions/options-advanced-rewriting.php`

**Context:**

```php
}, []);
            }
        }
        return apply_filters('seopress_category_rewrite_rules', $rules);
    }

    function seopress_remove_category_base($termlink, $term, $taxonomy)
```

### wpml_translate_single_string
**File:** `wp-seopress/inc/functions/options-advanced-rewriting.php`

**Context:**

```php
$category_base = get_option('category_base') ?: 'category';
        if (class_exists('Sitepress') && defined('ICL_LANGUAGE_CODE')) {
            $category_base = apply_filters('wpml_translate_single_string', $category_base, 'WordPress', 'URL category tax slug', ICL_LANGUAGE_CODE);
        }

        $category_base = apply_filters('seopress_remove_category_base', $category_base);
```

### seopress_remove_category_base
**File:** `wp-seopress/inc/functions/options-advanced-rewriting.php`

**Context:**

```php
if (class_exists('Sitepress') && defined('ICL_LANGUAGE_CODE')) {
            $category_base = apply_filters('wpml_translate_single_string', $category_base, 'WordPress', 'URL category tax slug', ICL_LANGUAGE_CODE);
        }

        $category_base = apply_filters('seopress_remove_category_base', $category_base);
        $category_base = ltrim($category_base, '/') . '/';

        return preg_replace('`' . preg_quote($category_base, '`') . '`u', '', $termlink, 1);
```

### seopress_product_category_rewrite_rules
**File:** `wp-seopress/inc/functions/options-advanced-rewriting.php`

**Context:**

```php
}, []);
            }
        }
        return apply_filters('seopress_product_category_rewrite_rules', $rules);
    }

    function seopress_remove_product_category_base($termlink, $term, $taxonomy)
```

### seopress_remove_product_category_base
**File:** `wp-seopress/inc/functions/options-advanced-rewriting.php`

**Context:**

```php
if (class_exists('Sitepress') && defined('ICL_LANGUAGE_CODE')) {
            $category_base = apply_filters('wpml_translate_single_string', $category_base, 'WordPress', 'URL product_cat tax slug', ICL_LANGUAGE_CODE);
        }

        $category_base = apply_filters('seopress_remove_product_category_base', $category_base);
        $category_base = ltrim($category_base, '/') . '/';

        return preg_replace('`' . preg_quote($category_base, '`') . '`u', '', $termlink, 1);
```

### seopress_clarity_user_consent
**File:** `wp-seopress/inc/functions/options-clarity.php`

**Context:**

```php
// Default to no consent if no cookie is set
            $consent = "window.clarity('consent', false);";
        }

        // Allow developers to modify the consent behavior
        $consent = apply_filters( 'seopress_clarity_user_consent', $consent );

        $js .= $consent;
```

### seopress_clarity_tracking_js
**File:** `wp-seopress/inc/functions/options-clarity.php`

**Context:**

```php
$js .= $consent;

		$js .= "</script>\n";

		// Allow developers to modify the entire Clarity tracking code
		$js = apply_filters('seopress_clarity_tracking_js', $js);

		if ($echo == true) {
			echo $js;
```

### seopress_user_consent
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
'wait_for_update': 500,
          }); \n";
    }

    $consent = apply_filters( 'seopress_user_consent', $consent );

    $js .= $consent;
```

### seopress_gtag_ga4
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
//Measurement ID
    if ('' !== seopress_get_service('GoogleAnalyticsOption')->getGA4()) {
        $seopress_gtag_ga4 = "gtag('config', '" . seopress_get_service('GoogleAnalyticsOption')->getGA4() . "');";
        $seopress_gtag_ga4 = apply_filters('seopress_gtag_ga4', $seopress_gtag_ga4);
        $js .= $seopress_gtag_ga4;
        $js .= "\n";
    }
```

### seopress_rgpd_message
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
$seopress_privacy_page = esc_url(get_permalink(get_option('wp_page_for_privacy_policy')));
        $msg                   = str_replace('[seopress_privacy_page]', $seopress_privacy_page, $msg);
    }

    $msg = apply_filters('seopress_rgpd_message', $msg);


    $consent_btn = seopress_get_service('GoogleAnalyticsOption')->getOptOutMessageOk();
```

### seopress_rgpd_full_message
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
</div>';

    $backdrop = '<div class="seopress-user-consent-backdrop seopress-user-consent-hide"></div>';

    $user_msg = apply_filters('seopress_rgpd_full_message', $user_msg, $msg, $consent_btn, $close_btn, $backdrop);

    echo $user_msg . $backdrop;
}
```

### seopress_rgpd_edit_message
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
<button id="seopress-user-consent-edit" type="button">' . $edit_cookie_btn . '</button>
        </p>
    </div>';

    $user_msg = apply_filters('seopress_rgpd_edit_message', $user_msg, $edit_cookie_btn);

    echo $user_msg;
}
```

### seopress_rgpd_full_message_styles
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
}';

    $styles .= '</style>';

    $styles = apply_filters('seopress_rgpd_full_message_styles', $styles);

    echo $styles;
}
```

### seopress_gtag_cd_hook_cf
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
$features = '';

        if (!isset($_COOKIE['seopress-user-consent-close'])) {
            //Dimensions
            $seopress_google_analytics_config['cd']['cd_hook'] = apply_filters('seopress_gtag_cd_hook_cf', isset($seopress_google_analytics_config['cd']['cd_hook']));
            if ( ! has_filter('seopress_gtag_cd_hook_cf')) {
                unset($seopress_google_analytics_config['cd']['cd_hook']);
            }
```

### seopress_gtag_cd_hook_ev
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
if ( ! has_filter('seopress_gtag_cd_hook_cf')) {
                unset($seopress_google_analytics_config['cd']['cd_hook']);
            }

            $seopress_google_analytics_event['cd_hook'] = apply_filters('seopress_gtag_cd_hook_ev', isset($seopress_google_analytics_event['cd_hook']));
            if ( ! has_filter('seopress_gtag_cd_hook_ev')) {
                unset($seopress_google_analytics_config['cd']['cd_hook']);
            }
```

### seopress_gtag_cd_author_cf
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
$seopress_google_analytics_config['cd']['cd_author'] = "'" . $cdAuthorOption . "': 'cd_author',";

                        $seopress_google_analytics_event['cd_author'] = "gtag('event', '" . __('Authors', 'wp-seopress') . "', {'cd_author': '" . get_the_author() . "', 'non_interaction': true});";

                        $seopress_google_analytics_config['cd']['cd_author'] = apply_filters('seopress_gtag_cd_author_cf', $seopress_google_analytics_config['cd']['cd_author']);

                        $seopress_google_analytics_event['cd_author'] = apply_filters('seopress_gtag_cd_author_ev', $seopress_google_analytics_event['cd_author']);
                    }
```

### seopress_gtag_cd_author_ev
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
$seopress_google_analytics_event['cd_author'] = "gtag('event', '" . __('Authors', 'wp-seopress') . "', {'cd_author': '" . get_the_author() . "', 'non_interaction': true});";

                        $seopress_google_analytics_config['cd']['cd_author'] = apply_filters('seopress_gtag_cd_author_cf', $seopress_google_analytics_config['cd']['cd_author']);

                        $seopress_google_analytics_event['cd_author'] = apply_filters('seopress_gtag_cd_author_ev', $seopress_google_analytics_event['cd_author']);
                    }
                }
            }
```

### seopress_gtag_cd_categories_cf
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
$seopress_google_analytics_config['cd']['cd_categories'] = "'" . $cdCategoryOption . "': 'cd_categories',";

                        $seopress_google_analytics_event['cd_categories'] = "gtag('event', '" . __('Categories', 'wp-seopress') . "', {'cd_categories': '" . $get_first_category . "', 'non_interaction': true});";

                        $seopress_google_analytics_config['cd']['cd_categories'] = apply_filters('seopress_gtag_cd_categories_cf', $seopress_google_analytics_config['cd']['cd_categories']);

                        $seopress_google_analytics_event['cd_categories'] = apply_filters('seopress_gtag_cd_categories_ev', $seopress_google_analytics_event['cd_categories']);
                    }
```

### seopress_gtag_cd_categories_ev
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
$seopress_google_analytics_event['cd_categories'] = "gtag('event', '" . __('Categories', 'wp-seopress') . "', {'cd_categories': '" . $get_first_category . "', 'non_interaction': true});";

                        $seopress_google_analytics_config['cd']['cd_categories'] = apply_filters('seopress_gtag_cd_categories_cf', $seopress_google_analytics_config['cd']['cd_categories']);

                        $seopress_google_analytics_event['cd_categories'] = apply_filters('seopress_gtag_cd_categories_ev', $seopress_google_analytics_event['cd_categories']);
                    }
                }
            }
```

### seopress_gtag_cd_tags_cf
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
$seopress_google_analytics_config['cd']['cd_tags'] = "'" . $cdTagOption . "': 'cd_tags',";

                    $seopress_google_analytics_event['cd_tags'] = "gtag('event', '" . __('Tags', 'wp-seopress') . "', {'cd_tags': '" . $get_tags . "', 'non_interaction': true});";

                    $seopress_google_analytics_config['cd']['cd_tags'] = apply_filters('seopress_gtag_cd_tags_cf', $seopress_google_analytics_config['cd']['cd_tags']);

                    $seopress_google_analytics_event['cd_tags'] = apply_filters('seopress_gtag_cd_tags_ev', $seopress_google_analytics_event['cd_tags']);
                }
```

### seopress_gtag_cd_tags_ev
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
$seopress_google_analytics_event['cd_tags'] = "gtag('event', '" . __('Tags', 'wp-seopress') . "', {'cd_tags': '" . $get_tags . "', 'non_interaction': true});";

                    $seopress_google_analytics_config['cd']['cd_tags'] = apply_filters('seopress_gtag_cd_tags_cf', $seopress_google_analytics_config['cd']['cd_tags']);

                    $seopress_google_analytics_event['cd_tags'] = apply_filters('seopress_gtag_cd_tags_ev', $seopress_google_analytics_event['cd_tags']);
                }
            }
```

### seopress_gtag_cd_cpt_cf
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
$seopress_google_analytics_config['cd']['cd_cpt'] = "'" . $cdPostTypeOption . "': 'cd_cpt',";

                    $seopress_google_analytics_event['cd_cpt'] = "gtag('event', '" . __('Post types', 'wp-seopress') . "', {'cd_cpt': '" . get_post_type() . "', 'non_interaction': true});";

                    $seopress_google_analytics_config['cd']['cd_cpt'] = apply_filters('seopress_gtag_cd_cpt_cf', $seopress_google_analytics_config['cd']['cd_cpt']);

                    $seopress_google_analytics_event['cd_cpt'] = apply_filters('seopress_gtag_cd_cpt_ev', $seopress_google_analytics_event['cd_cpt']);
                }
```

### seopress_gtag_cd_cpt_ev
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
$seopress_google_analytics_event['cd_cpt'] = "gtag('event', '" . __('Post types', 'wp-seopress') . "', {'cd_cpt': '" . get_post_type() . "', 'non_interaction': true});";

                    $seopress_google_analytics_config['cd']['cd_cpt'] = apply_filters('seopress_gtag_cd_cpt_cf', $seopress_google_analytics_config['cd']['cd_cpt']);

                    $seopress_google_analytics_event['cd_cpt'] = apply_filters('seopress_gtag_cd_cpt_ev', $seopress_google_analytics_event['cd_cpt']);
                }
            }
```

### seopress_gtag_cd_logged_in_cf
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
$seopress_google_analytics_config['cd']['cd_logged_in'] = "'" . $cdLoggedInUserOption . "': 'cd_logged_in',";

                    $seopress_google_analytics_event['cd_logged_in'] = "gtag('event', '" . __('Connected users', 'wp-seopress') . "', {'cd_logged_in': '" . wp_get_current_user()->ID . "', 'non_interaction': true});";

                    $seopress_google_analytics_config['cd']['cd_logged_in'] = apply_filters('seopress_gtag_cd_logged_in_cf', $seopress_google_analytics_config['cd']['cd_logged_in']);

                    $seopress_google_analytics_event['cd_logged_in'] = apply_filters('seopress_gtag_cd_logged_in_ev', $seopress_google_analytics_event['cd_logged_in']);
                }
```

### seopress_gtag_cd_logged_in_ev
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
$seopress_google_analytics_event['cd_logged_in'] = "gtag('event', '" . __('Connected users', 'wp-seopress') . "', {'cd_logged_in': '" . wp_get_current_user()->ID . "', 'non_interaction': true});";

                    $seopress_google_analytics_config['cd']['cd_logged_in'] = apply_filters('seopress_gtag_cd_logged_in_cf', $seopress_google_analytics_config['cd']['cd_logged_in']);

                    $seopress_google_analytics_event['cd_logged_in'] = apply_filters('seopress_gtag_cd_logged_in_ev', $seopress_google_analytics_event['cd_logged_in']);
                }
            }
```

### seopress_gtag_link_tracking_ev
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
}
    });
    ";
                $seopress_google_analytics_click_event['link_tracking'] = apply_filters('seopress_gtag_link_tracking_ev', $seopress_google_analytics_click_event['link_tracking']);
                $seopress_google_analytics_html .= $seopress_google_analytics_click_event['link_tracking'];
            }
```

### seopress_gtag_download_tracking_ev
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
}
        });
    ";
                    $seopress_google_analytics_click_event['download_tracking'] = apply_filters('seopress_gtag_download_tracking_ev', $seopress_google_analytics_click_event['download_tracking']);
                    $seopress_google_analytics_html .= $seopress_google_analytics_click_event['download_tracking'];
                }
            }
```

### seopress_gtag_outbound_tracking_ev
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
});
            }
        });";
                    $seopress_google_analytics_click_event['outbound_tracking'] = apply_filters('seopress_gtag_outbound_tracking_ev', $seopress_google_analytics_click_event['outbound_tracking']);
                    $seopress_google_analytics_html .= $seopress_google_analytics_click_event['outbound_tracking'];
                }
            }
```

### seopress_gtag_phone_tracking_ev
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
});
        }
    });";
                $seopress_google_analytics_click_event['phone_tracking'] = apply_filters('seopress_gtag_phone_tracking_ev', $seopress_google_analytics_click_event['phone_tracking']);
                $seopress_google_analytics_html .= $seopress_google_analytics_click_event['phone_tracking'];
            }
```

### seopress_gtag_ads
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
$adsOptions = seopress_get_service('GoogleAnalyticsOption')->getAds();
            if (!empty($adsOptions)) {
                $seopress_gtag_ads = "\n gtag('config', '" . $adsOptions . "');";
                $seopress_gtag_ads = apply_filters('seopress_gtag_ads', $seopress_gtag_ads);
                $seopress_google_analytics_html .= $seopress_gtag_ads;
                $seopress_google_analytics_html .= "\n";
            }
```

### seopress_gtag_before_closing_script
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
}

        $seopress_gtag_before_closing_script = '';
        $seopress_gtag_before_closing_script = apply_filters('seopress_gtag_before_closing_script', $seopress_gtag_before_closing_script);
        if(!empty($seopress_gtag_before_closing_script)) {
            $seopress_google_analytics_html .= $seopress_gtag_before_closing_script;
        }
```

### seopress_gtag_html
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
$seopress_google_analytics_html .= '</script>';
        $seopress_google_analytics_html .= "\n";

        $seopress_google_analytics_html = apply_filters('seopress_gtag_html', $seopress_google_analytics_html);

        if (true == $echo) {
            echo $seopress_google_analytics_html;
```

### seopress_custom_tracking
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
function seopress_custom_tracking_hook() {
    $data['custom'] = '';
    $data['custom'] = apply_filters('seopress_custom_tracking', $data['custom']);
    echo $data['custom'];
}
```

### seopress_custom_body_tracking
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
if ($seopress_html_body === 'none') {
        return;
    }

    $seopress_html_body = apply_filters('seopress_custom_body_tracking', $seopress_html_body);
    if (true == $echo) {
        echo "\n" . $seopress_html_body;
    } else {
```

### seopress_custom_footer_tracking
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
if ($seopress_html_footer === 'none') {
        return;
    }

    $seopress_html_footer = apply_filters('seopress_custom_footer_tracking', $seopress_html_footer);
    if (true == $echo) {
        echo "\n" . $seopress_html_footer;
    } else {
```

### seopress_gtag_after_additional_tracking_html
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
if ($seopress_html_head === 'none') {
        return;
    }

    $seopress_html_head = apply_filters('seopress_gtag_after_additional_tracking_html', $seopress_html_head);

    if (true == $echo) {
        echo "\n" . $seopress_html_head;
```

### seopress_instant_indexing_post_request_args
**File:** `wp-seopress/inc/functions/options-instant-indexing.php`

**Context:**

```php
'X-Source-Info' => $x_source_info
                    ],
                ];
                $args = apply_filters( 'seopress_instant_indexing_post_request_args', $args );

                //IndexNow (Bing)
                $response = wp_remote_post( $bing_url, $args );
```

### seopress_instant_indexing_permalink
**File:** `wp-seopress/inc/functions/options-instant-indexing.php`

**Context:**

```php
if (! in_array( $post->post_type, array_keys($post_types) ) ) {
                return;
            }

            $permalink = apply_filters( 'seopress_instant_indexing_permalink', $permalink, $post );

            return seopress_instant_indexing_fn(false, $permalink);
        }
```

### seopress_matomo_cookie_domain
**File:** `wp-seopress/inc/functions/options-matomo.php`

**Context:**

```php
$parse_url = wp_parse_url(get_home_url());
            if ( ! empty($parse_url['host'])) {
                $seopress_matomo_config['subdomains'] = "_paq.push(['setCookieDomain', '*.".$parse_url['host']."']);\n";
                $seopress_matomo_config['subdomains'] = apply_filters('seopress_matomo_cookie_domain', $seopress_matomo_config['subdomains']);
            }
		}
```

### seopress_matomo_site_domain
**File:** `wp-seopress/inc/functions/options-matomo.php`

**Context:**

```php
//site domain
		if (seopress_get_service('GoogleAnalyticsOption')->getMatomoSiteDomain() ==='1') {
			$seopress_matomo_config['site_domain'] = "_paq.push(['setDocumentTitle', document.domain + '/' + document.title]);\n";
			$seopress_matomo_config['site_domain'] = apply_filters('seopress_matomo_site_domain', $seopress_matomo_config['site_domain']);
		}

		//DNT
```

### seopress_matomo_dnt
**File:** `wp-seopress/inc/functions/options-matomo.php`

**Context:**

```php
//DNT
		if (seopress_get_service('GoogleAnalyticsOption')->getMatomoDnt() ==='1') {
			$seopress_matomo_config['dnt'] = "_paq.push(['setDoNotTrack', true]);\n";
			$seopress_matomo_config['dnt'] = apply_filters('seopress_matomo_dnt', $seopress_matomo_config['dnt']);
		}

		//disable cookies
```

### seopress_matomo_disable_cookies
**File:** `wp-seopress/inc/functions/options-matomo.php`

**Context:**

```php
//disable cookies
		if (seopress_get_service('GoogleAnalyticsOption')->getMatomoNoCookies() ==='1') {
			$seopress_matomo_config['no_cookies'] = "_paq.push(['disableCookies']);\n";
			$seopress_matomo_config['no_cookies'] = apply_filters('seopress_matomo_disable_cookies', $seopress_matomo_config['no_cookies']);
		}

		//cross domains
```

### seopress_matomo_linker
**File:** `wp-seopress/inc/functions/options-matomo.php`

**Context:**

```php
}
				}
				$seopress_matomo_config['set_domains'] = "_paq.push(['setDomains', [".$link_domains."]]);\n_paq.push(['enableCrossDomainLinking']);\n";
				$seopress_matomo_config['set_domains'] = apply_filters('seopress_matomo_linker', $seopress_matomo_config['set_domains']);
			}
		}
```

### seopress_matomo_link_tracking
**File:** `wp-seopress/inc/functions/options-matomo.php`

**Context:**

```php
//link tracking
		if (seopress_get_service('GoogleAnalyticsOption')->getMatomoLinkTracking() ==='1') {
			$seopress_matomo_config['link_tracking'] = "_paq.push(['enableLinkTracking']);\n";
			$seopress_matomo_config['link_tracking'] = apply_filters('seopress_matomo_link_tracking', $seopress_matomo_config['link_tracking']);
		}

		//no heatmaps
```

### seopress_matomo_no_heatmaps
**File:** `wp-seopress/inc/functions/options-matomo.php`

**Context:**

```php
//no heatmaps
		if (seopress_get_service('GoogleAnalyticsOption')->getMatomoNoHeatmaps() ==='1') {
			$seopress_matomo_config['no_heatmaps'] = "_paq.push(['HeatmapSessionRecording::disable']);\n";
			$seopress_matomo_config['no_heatmaps'] = apply_filters('seopress_matomo_no_heatmaps', $seopress_matomo_config['no_heatmaps']);
		}

		//dimensions
```

### seopress_matomo_cd_author_ev
**File:** `wp-seopress/inc/functions/options-matomo.php`

**Context:**

```php
if (!empty($cdAuthorOption) && $cdAuthorOption != 'none') {
            if (is_singular()) {
                $seopress_matomo_event['cd_author'] = "_paq.push(['setCustomVariable', '".substr($cdAuthorOption,-1)."', '".__('Authors','wp-seopress')."', '".get_the_author()."', 'visit']);\n";
                $seopress_matomo_event['cd_author'] = apply_filters('seopress_matomo_cd_author_ev', $seopress_matomo_event['cd_author']);
            }
		}
```

### seopress_matomo_cd_categories_ev
**File:** `wp-seopress/inc/functions/options-matomo.php`

**Context:**

```php
$get_first_category = esc_html( $categories[0]->name );
                }
                $seopress_matomo_event['cd_categories'] = "_paq.push(['setCustomVariable', '".substr($cdCategoryOption,-1)."', '".__('Categories','wp-seopress')."', '".$get_first_category."', 'visit']);\n";
                $seopress_matomo_event['cd_categories'] = apply_filters('seopress_matomo_cd_categories_ev', $seopress_matomo_event['cd_categories']);
            }
		}
```

### seopress_matomo_cd_tags_ev
**File:** `wp-seopress/inc/functions/options-matomo.php`

**Context:**

```php
}
                }
                $seopress_matomo_event['cd_tags'] = "_paq.push(['setCustomVariable', '".substr($cdTagOption,-1)."', '".__('Tags','wp-seopress')."', '".$get_tags."', 'visit']);\n";
                $seopress_matomo_event['cd_tags'] = apply_filters('seopress_matomo_cd_tags_ev', $seopress_matomo_event['cd_tags']);
            }
		}
```

### seopress_matomo_cd_cpt_ev
**File:** `wp-seopress/inc/functions/options-matomo.php`

**Context:**

```php
if (!empty($cdPostTypeOption) && $cdPostTypeOption !='none') {
            if (is_single()) {
                $seopress_matomo_event['cd_cpt'] = "_paq.push(['setCustomVariable', '".substr($cdPostTypeOption,-1)."', '".__('Post types','wp-seopress')."', '".get_post_type()."', 'visit']);\n";
                $seopress_matomo_event['cd_cpt'] = apply_filters('seopress_matomo_cd_cpt_ev', $seopress_matomo_event['cd_cpt']);
            }
		}
```

### seopress_matomo_cd_logged_in_ev
**File:** `wp-seopress/inc/functions/options-matomo.php`

**Context:**

```php
if (!empty($cdLoggedInUserOption) && $cdLoggedInUserOption !='none') {
            if (wp_get_current_user()->ID) {
                $seopress_matomo_event['cd_logged_in'] = "_paq.push(['setCustomVariable', '".substr($cdLoggedInUserOption,-1)."', '".__('Connected users','wp-seopress')."', '".wp_get_current_user()->ID."', 'visit']);\n";
                $seopress_matomo_event['cd_logged_in'] = apply_filters('seopress_matomo_cd_logged_in_ev', $seopress_matomo_event['cd_logged_in']);
            }
		}
```

### seopress_matomo_tracking_html
**File:** `wp-seopress/inc/functions/options-matomo.php`

**Context:**

```php
})();\n";

		$seopress_matomo_html .= "</script>";

		$seopress_matomo_html = apply_filters('seopress_matomo_tracking_html', $seopress_matomo_html);

		if ($echo == true) {
			echo $seopress_matomo_html;
```

### seopress_matomo_no_js
**File:** `wp-seopress/inc/functions/options-matomo.php`

**Context:**

```php
$no_js = NULL;
		if (seopress_get_service('GoogleAnalyticsOption')->getMatomoNoJS() ==='1') {
			$no_js = '<noscript><p><img src="https://'.seopress_get_service('GoogleAnalyticsOption')->getMatomoId().'/matomo.php?idsite='.seopress_get_service('GoogleAnalyticsOption')->getMatomoSiteId().'&amp;rec=1" style="border:0;" alt="" /></p></noscript>';
			$no_js = apply_filters('seopress_matomo_no_js', $no_js);
		}

		if ($no_js) {
```

### seopress_matomo_tracking_body_html
**File:** `wp-seopress/inc/functions/options-matomo.php`

**Context:**

```php
if ($no_js) {
			$html .= $no_js;
		}

		$html = apply_filters('seopress_matomo_tracking_body_html', $html);

		if ($echo == true) {
			echo $html;
```

### seopress_dyn_variables_fn
**File:** `wp-seopress/inc/functions/options-oembed.php`

**Context:**

```php
$seopress_oembed_title ='';

    $variables = null;
    $variables = apply_filters('seopress_dyn_variables_fn', $variables, $post, true);

    $seopress_titles_template_variables_array 	= $variables['seopress_titles_template_variables_array'];
    $seopress_titles_template_replace_array 	= $variables['seopress_titles_template_replace_array'];
```

### seopress_titles_custom_tax
**File:** `wp-seopress/inc/functions/options-oembed.php`

**Context:**

```php
$term = wp_get_post_terms($post->ID, $value);
            if ( ! is_wp_error($term)) {
                $terms                                       = esc_attr($term[0]->name);
                $seopress_titles_ct_template_replace_array[] = apply_filters('seopress_titles_custom_tax', $terms, $value);
            }
        }
    }
```

### seopress_oembed_title
**File:** `wp-seopress/inc/functions/options-oembed.php`

**Context:**

```php
}

    $seopress_oembed_title = str_replace($seopress_titles_template_variables_array, $seopress_titles_template_replace_array, $seopress_oembed_title);

    //Hook on post oEmbed title - 'seopress_oembed_title'
    $seopress_oembed_title = apply_filters('seopress_oembed_title', $seopress_oembed_title);

    return $seopress_oembed_title;
}
```

### seopress_oembed_thumbnail_size
**File:** `wp-seopress/inc/functions/options-oembed.php`

**Context:**

```php
$post_thumbnail_id 	=  get_post_thumbnail_id($post);

        $img_size 			= seopress_get_service('SocialOption')->getSocialLIImgSize() ? esc_attr(seopress_get_service('SocialOption')->getSocialLIImgSize()) : 'full';

        $img_size 			= apply_filters('seopress_oembed_thumbnail_size', $img_size);

        $attachment 		= wp_get_attachment_image_src($post_thumbnail_id, $img_size);
```

### seopress_oembed_thumbnail
**File:** `wp-seopress/inc/functions/options-oembed.php`

**Context:**

```php
$seopress_oembed_thumbnail['height'] 	= $attachment[2];
        }
    }

    //Hook on post oEmbed thumbnail - 'seopress_oembed_thumbnail'
    $seopress_oembed_thumbnail = apply_filters('seopress_oembed_thumbnail', $seopress_oembed_thumbnail);

    return $seopress_oembed_thumbnail;
}
```

### seopress_disable_archives_redirect_url
**File:** `wp-seopress/inc/functions/options.php`

**Context:**

```php
function seopress_titles_disable_archives()
    {
        global $wp_query;

        $url = apply_filters( 'seopress_disable_archives_redirect_url', get_home_url() );
        $status = apply_filters( 'seopress_disable_archives_redirect_status' , '301' );

        if ('1' === seopress_get_service('TitleOption')->getArchiveAuthorDisable() && $wp_query->is_author && ! is_feed()) {
```

### seopress_disable_archives_redirect_status
**File:** `wp-seopress/inc/functions/options.php`

**Context:**

```php
global $wp_query;

        $url = apply_filters( 'seopress_disable_archives_redirect_url', get_home_url() );
        $status = apply_filters( 'seopress_disable_archives_redirect_status' , '301' );

        if ('1' === seopress_get_service('TitleOption')->getArchiveAuthorDisable() && $wp_query->is_author && ! is_feed()) {
            wp_redirect($url, $status);
```

### seopress_cookies_expiration_days
**File:** `wp-seopress/inc/functions/options.php`

**Context:**

```php
if (seopress_get_service('GoogleAnalyticsOption')->getCbExpDate()) {
            $days = seopress_get_service('GoogleAnalyticsOption')->getCbExpDate();
        }
        $days = apply_filters('seopress_cookies_expiration_days', $days);

        $seopress_cookies_user_consent = [
            'seopress_nonce'                   => wp_create_nonce('seopress_cookies_user_consent_nonce'),
```

### seopress_gtag_ec_add_to_cart_checkout_ev
**File:** `wp-seopress/inc/functions/options.php`

**Context:**

```php
}

        $html = "<script>gtag('event', 'add_to_cart', {'items': " . wp_json_encode($final) . ' });</script>';

        $html = apply_filters('seopress_gtag_ec_add_to_cart_checkout_ev', $html);

        wp_send_json_success($html);
    }
```

### seopress_schemas_website
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
'description' => esc_html($site_desc),
			'url' => get_home_url(),
		];

		$website_schema = apply_filters( 'seopress_schemas_website', $website_schema );

		$jsonld = '<script id="website-schema" type="application/ld+json">';
		$jsonld .= wp_json_encode($website_schema);
```

### seopress_schemas_website_html
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
$jsonld .= wp_json_encode($website_schema);
		$jsonld .= '</script>';
		$jsonld .= "\n";

		$jsonld = apply_filters( 'seopress_schemas_website_html', $jsonld );

		echo $jsonld;
	}
```

### seopress_social_og_url
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
//Hook on post OG URL - 'seopress_social_og_url'
		if (has_filter('seopress_social_og_url')) {
			$seopress_social_og_url = apply_filters('seopress_social_og_url', $seopress_social_og_url);
		}

		if ( ! is_404()) {
```

### seopress_social_og_site_name
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
//Hook on post OG site name - 'seopress_social_og_site_name'
		if (has_filter('seopress_social_og_site_name')) {
			$seopress_social_og_site_name = apply_filters('seopress_social_og_site_name', $seopress_social_og_site_name);
		}

		if ( ! is_404()) {
```

### wpml_element_trid
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
if (is_plugin_active('sitepress-multilingual-cms/sitepress.php')) {

			if (get_post_type() && get_the_ID()) {
				$trid = apply_filters( 'wpml_element_trid', NULL, get_the_id(), 'post_'.get_post_type() );

				if (isset($trid)) {
					$translations = apply_filters( 'wpml_get_element_translations', NULL, $trid, 'post_'.get_post_type() );
```

### wpml_get_element_translations
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
$trid = apply_filters( 'wpml_element_trid', NULL, get_the_id(), 'post_'.get_post_type() );

				if (isset($trid)) {
					$translations = apply_filters( 'wpml_get_element_translations', NULL, $trid, 'post_'.get_post_type() );

					if (!empty($translations)) {
						foreach($translations as $lang => $object) {
```

### wpml_post_language_details
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
$elid = $object->element_id;

							if (isset($elid)) {
								$my_post_language_details = apply_filters( 'wpml_post_language_details', NULL, $elid ) ;

								if (!is_wp_error( $my_post_language_details ) && !empty($my_post_language_details['locale']) && $my_post_language_details['different_language'] === true) {
									$seopress_social_og_locale .= "\n";
```

### seopress_social_og_locale
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
//Hook on post OG locale - 'seopress_social_og_locale'
		if (has_filter('seopress_social_og_locale')) {
			$seopress_social_og_locale = apply_filters('seopress_social_og_locale', $seopress_social_og_locale);
		}

		if (isset($seopress_social_og_locale) && '' != $seopress_social_og_locale) {
```

### seopress_social_og_type
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
if (isset($seopress_social_og_type)) {
			//Hook on post OG type - 'seopress_social_og_type'
			if (has_filter('seopress_social_og_type')) {
				$seopress_social_og_type = apply_filters('seopress_social_og_type', $seopress_social_og_type);
			}
			if ( ! is_404()) {
				echo $seopress_social_og_type . "\n";
```

### seopress_social_og_author
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
if (isset($seopress_social_og_author)) {
			//Hook on post OG author - 'seopress_social_og_author'
			if (has_filter('seopress_social_og_author')) {
				$seopress_social_og_author = apply_filters('seopress_social_og_author', $seopress_social_og_author);
			}
			echo $seopress_social_og_author . "\n";
		}
```

### seopress_social_og_section
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
if (isset($seopress_social_og_section)) {
					//Hook on post OG article:section - 'seopress_social_og_section'
					if (has_filter('seopress_social_og_section')) {
						$seopress_social_og_section = apply_filters('seopress_social_og_section', $seopress_social_og_section);
					}
					echo $seopress_social_og_section;
				}
```

### seopress_social_og_tag
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
if (isset($seopress_social_og_tag)) {
						//Hook on post OG article:tag - 'seopress_social_og_tag'
						if (has_filter('seopress_social_og_tag')) {
							$seopress_social_og_tag = apply_filters('seopress_social_og_tag', $seopress_social_og_tag);
						}
						echo $seopress_social_og_tag;
					}
```

### seopress_social_og_title
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
//Hook on post OG title - 'seopress_social_og_title'
		if (has_filter('seopress_social_og_title')) {
			$seopress_social_og_title = apply_filters('seopress_social_og_title', $seopress_social_og_title);
		}

		if (isset($seopress_social_og_title) && '' != $seopress_social_og_title) {
```

### seopress_social_og_desc
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
//Hook on post OG description - 'seopress_social_og_desc'
		if (has_filter('seopress_social_og_desc')) {
			$seopress_social_og_desc = apply_filters('seopress_social_og_desc', $seopress_social_og_desc);
		}
		if (isset($seopress_social_og_desc) && '' != $seopress_social_og_desc) {
			if ( ! is_404()) {
```

### seopress_stop_attachment_url_to_postid
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
if ($url === null) {
		return;
	}

	$stop_attachment_url_to_postid = apply_filters( 'seopress_stop_attachment_url_to_postid', false );

	if ($post_id) {
		$post_id = get_post_thumbnail_id($post_id);
```

### seopress_social_og_thumb
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
//Hook on post OG thumbnail - 'seopress_social_og_thumb'
		if (has_filter('seopress_social_og_thumb')) {
			$seopress_social_og_thumb = apply_filters('seopress_social_og_thumb', $seopress_social_og_thumb);
		}
		if (isset($seopress_social_og_thumb) && '' != $seopress_social_og_thumb) {
			if ( ! is_404()) {
```

### seopress_social_twitter_card_summary
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
}
		//Hook on post Twitter card summary - 'seopress_social_twitter_card_summary'
		if (has_filter('seopress_social_twitter_card_summary')) {
			$seopress_social_twitter_card_summary = apply_filters('seopress_social_twitter_card_summary', $seopress_social_twitter_card_summary);
		}

		if ( ! is_404()) {
```

### seopress_social_twitter_card_site
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
//Hook on post Twitter card site - 'seopress_social_twitter_card_site'
		if (has_filter('seopress_social_twitter_card_site')) {
			$seopress_social_twitter_card_site = apply_filters('seopress_social_twitter_card_site', $seopress_social_twitter_card_site);
		}

		if ( ! is_404()) {
```

### seopress_social_twitter_card_creator
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
}
	//Hook on post Twitter card creator - 'seopress_social_twitter_card_creator'
	if (has_filter('seopress_social_twitter_card_creator')) {
		$seopress_social_twitter_card_creator = apply_filters('seopress_social_twitter_card_creator', $seopress_social_twitter_card_creator);
	}
	if (isset($seopress_social_twitter_card_creator) && '' != $seopress_social_twitter_card_creator) {
		if ( ! is_404()) {
```

### seopress_social_twitter_card_title
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
//Hook on post Twitter card title - 'seopress_social_twitter_card_title'
		if (has_filter('seopress_social_twitter_card_title')) {
			$seopress_social_twitter_card_title = apply_filters('seopress_social_twitter_card_title', $seopress_social_twitter_card_title);
		}
		if (isset($seopress_social_twitter_card_title) && '' != $seopress_social_twitter_card_title) {
			if ( ! is_404()) {
```

### seopress_social_twitter_card_desc
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
//Hook on post Twitter card description - 'seopress_social_twitter_card_desc'
		if (has_filter('seopress_social_twitter_card_desc')) {
			$seopress_social_twitter_card_desc = apply_filters('seopress_social_twitter_card_desc', $seopress_social_twitter_card_desc);
		}
		if (isset($seopress_social_twitter_card_desc) && '' != $seopress_social_twitter_card_desc) {
			if ( ! is_404()) {
```

### seopress_social_twitter_card_thumb
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
//Hook on post Twitter card thumbnail - 'seopress_social_twitter_card_thumb'
		if (has_filter('seopress_social_twitter_card_thumb')) {
			$seopress_social_twitter_card_thumb = apply_filters('seopress_social_twitter_card_thumb', $seopress_social_twitter_card_thumb);
		}
		if (isset($seopress_social_twitter_card_thumb) && '' != $seopress_social_twitter_card_thumb) {
			if ( ! is_404()) {
```

### seopress_social_fv_creator
**File:** `wp-seopress/inc/functions/options-social.php`

**Context:**

```php
$fv_creator = seopress_get_service('SocialOption')->getSocialFvCreator() ?? '';

		$seopress_social_fv_creator = '<meta name="fediverse:creator" content="' . esc_attr( $fv_creator ) . '" />';

		$seopress_social_fv_creator = apply_filters('seopress_social_fv_creator', $seopress_social_fv_creator);

		if ( is_singular()) {
			echo $seopress_social_fv_creator . "\n";
```

### seopress_titles_custom_field
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
foreach ($matches['1'] as $key => $value) {
					$custom_field = wp_trim_words(esc_attr(stripslashes_deep(wp_filter_nohtml_kses(wp_strip_all_tags(strip_shortcodes(get_post_meta($post->ID, $value, true), true))))), $seopress_excerpt_length);
					$seopress_titles_cf_template_replace_array[] = apply_filters('seopress_titles_custom_field', $custom_field, $value);
				}
			}
```

### seopress_titles_user_meta
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
foreach ($matches3['1'] as $key => $value) {
					$user_meta = esc_attr(get_user_meta(get_the_author_meta('ID'), $value, true));
					$seopress_titles_ucf_template_replace_array[] = apply_filters('seopress_titles_user_meta', $user_meta, $value);
				}
			}
```

### seopress_titles_title
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
//Hook on Title tag - 'seopress_titles_title'
	if (has_filter('seopress_titles_title')) {
		$seopress_titles_title_template = apply_filters('seopress_titles_title', $seopress_titles_title_template);
	}

	//Return Title tag
```

### seopress_old_pre_get_document_title
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
//Return Title tag
	return $seopress_titles_title_template;
}

if (apply_filters('seopress_old_pre_get_document_title', true)) {
	$priority = apply_filters( 'seopress_titles_the_title_priority', 10 );
	add_filter('pre_get_document_title', 'seopress_titles_the_title', $priority);

	//Avoid TEC rewriting our title tag on Venue and Organizer pages
```

### seopress_titles_the_title_priority
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
}

if (apply_filters('seopress_old_pre_get_document_title', true)) {
	$priority = apply_filters( 'seopress_titles_the_title_priority', 10 );
	add_filter('pre_get_document_title', 'seopress_titles_the_title', $priority);

	//Avoid TEC rewriting our title tag on Venue and Organizer pages
```

### seopress_titles_desc
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
}
	//Hook on meta description - 'seopress_titles_desc'
	if (has_filter('seopress_titles_desc')) {
		$seopress_titles_description_template = apply_filters('seopress_titles_desc', $seopress_titles_description_template);
	}
	//Return meta desc tag
	return $seopress_titles_description_template;
```

### seopress_old_wp_head_description
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
echo $html;
	}
}

if (apply_filters('seopress_old_wp_head_description', true)) {
	add_action('wp_head', 'seopress_titles_the_description', 1);
}

//Advanced
```

### seopress_titles_noindex_bypass
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
remove_filter( 'wp_robots', 'wp_robots_no_robots' );
		}
	}

	$seopress_titles_noindex = apply_filters('seopress_titles_noindex_bypass', $seopress_titles_noindex);

	//remove hreflang if noindex
	if ('1' == $seopress_titles_noindex || true == $seopress_titles_noindex) {
```

### seopress_titles_article_published_time
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
$seopress_get_current_up_post_date  = get_the_modified_date('c');
			$html                               = '<meta property="article:published_time" content="' . $seopress_get_current_pub_post_date . '">';
			$html .= "\n";

			$html = apply_filters('seopress_titles_article_published_time', $html);

			echo $html;
```

### seopress_titles_article_modified_time
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
$html = '<meta property="article:modified_time" content="' . $seopress_get_current_up_post_date . '">';
			$html .= "\n";

			$html = apply_filters('seopress_titles_article_modified_time', $html);

			echo $html;
```

### seopress_titles_og_updated_time
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
$html = '<meta property="og:updated_time" content="' . $seopress_get_current_up_post_date . '">';
			$html .= "\n";

			$html = apply_filters('seopress_titles_og_updated_time', $html);

			echo $html;
		}
```

### seopress_titles_gcs_thumbnail
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
if (get_the_post_thumbnail_url(get_the_ID())) {
				$html = '<meta name="thumbnail" content="' . get_the_post_thumbnail_url(get_the_ID(), 'thumbnail') . '">';
				$html .= "\n";

				$html = apply_filters('seopress_titles_gcs_thumbnail', $html);

				echo $html;
			}
```

### seopress_titles_noindex
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
$seopress_titles_noindex = 'noindex';
			//Hook on meta robots noindex - 'seopress_titles_noindex'
			if (has_filter('seopress_titles_noindex')) {
				$seopress_titles_noindex = apply_filters('seopress_titles_noindex', $seopress_titles_noindex);
			}
			array_push($seopress_comma_array, $seopress_titles_noindex);
		}
```

### seopress_titles_nofollow
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
$seopress_titles_nofollow = 'nofollow';
			//Hook on meta robots nofollow - 'seopress_titles_nofollow'
			if (has_filter('seopress_titles_nofollow')) {
				$seopress_titles_nofollow = apply_filters('seopress_titles_nofollow', $seopress_titles_nofollow);
			}
			array_push($seopress_comma_array, $seopress_titles_nofollow);
		}
```

### seopress_titles_noimageindex
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
$seopress_titles_noimageindex = 'noimageindex';
			//Hook on meta robots noimageindex - 'seopress_titles_noimageindex'
			if (has_filter('seopress_titles_noimageindex')) {
				$seopress_titles_noimageindex = apply_filters('seopress_titles_noimageindex', $seopress_titles_noimageindex);
			}
			array_push($seopress_comma_array, $seopress_titles_noimageindex);
		}
```

### seopress_titles_nosnippet
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
$seopress_titles_nosnippet = 'nosnippet';
			//Hook on meta robots nosnippet - 'seopress_titles_nosnippet'
			if (has_filter('seopress_titles_nosnippet')) {
				$seopress_titles_nosnippet = apply_filters('seopress_titles_nosnippet', $seopress_titles_nosnippet);
			}
			array_push($seopress_comma_array, $seopress_titles_nosnippet);
		}
```

### seopress_titles_robots_attrs
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
//Default meta robots
		$seopress_titles_robots = '<meta name="robots" content="';

		$seopress_comma_array = apply_filters('seopress_titles_robots_attrs', $seopress_comma_array);

		$seopress_comma_count = count($seopress_comma_array);
		for ($i = 0; $i < $seopress_comma_count; ++$i) {
```

### seopress_titles_robots
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
//Hook on meta robots all - 'seopress_titles_robots'
		if (has_filter('seopress_titles_robots')) {
			$seopress_titles_robots = apply_filters('seopress_titles_robots', $seopress_titles_robots);
		}
		echo $seopress_titles_robots;
	}
```

### seopress_titles_paged_rel
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
if (get_next_posts_link()) { 
			$html .= '<link rel="next" href="' . get_pagenum_link($paged + 1) . '">';
		}

		$html = apply_filters('seopress_titles_paged_rel', $html, $paged);
			
		echo $html;
	}
```

### seopress_titles_canonical
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
$seopress_titles_canonical = '<link rel="canonical" href="' . htmlspecialchars(urldecode(seopress_titles_canonical_post_option())) . '">';
			//Hook on post canonical URL - 'seopress_titles_canonical'
			if (has_filter('seopress_titles_canonical')) {
				$seopress_titles_canonical = apply_filters('seopress_titles_canonical', $seopress_titles_canonical);
			}
			echo $seopress_titles_canonical . "\n";
		}
```

### wpml_element_translation_type
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
$my_current_lang = '';
				$post_ID = get_the_ID();
				$post_type = get_post_type( $post_ID );
				$transl_status = apply_filters( 'wpml_element_translation_type', NULL, $post_ID, $post_type );
			
				// If the post is not translated, switch to the default language
				if ($transl_status != 1) {
```

### wpml_default_language
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
// If the post is not translated, switch to the default language
				if ($transl_status != 1) { 
					$my_default_lang = apply_filters('wpml_default_language', NULL );
					$my_current_lang = apply_filters( 'wpml_current_language', NULL );
					do_action( 'wpml_switch_language', $my_default_lang );
				}
```

### wpml_current_language
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
// If the post is not translated, switch to the default language
				if ($transl_status != 1) { 
					$my_default_lang = apply_filters('wpml_default_language', NULL );
					$my_current_lang = apply_filters( 'wpml_current_language', NULL );
					do_action( 'wpml_switch_language', $my_default_lang );
				}
			}
```

### wpml_setting
**File:** `wp-seopress/inc/functions/sitemap/template-xml-sitemaps-author.php`

**Context:**

```php
//Headers
seopress_get_service('SitemapHeaders')->printHeaders();

//WPML - Home URL
if ( 2 == apply_filters( 'wpml_setting', false, 'language_negotiation_type' ) ) {
    add_filter('seopress_sitemaps_home_url', function($home_url) {
        $home_url = apply_filters( 'wpml_home_url', get_option( 'home' ));
        return trailingslashit($home_url);
    });
} else {
    add_filter('wpml_get_home_url', 'seopress_remove_wpml_home_url_filter', 20, 5);
}
```

### wpml_home_url
**File:** `wp-seopress/inc/functions/sitemap/template-xml-sitemaps-author.php`

**Context:**

```php
//WPML - Home URL
if ( 2 == apply_filters( 'wpml_setting', false, 'language_negotiation_type' ) ) {
    add_filter('seopress_sitemaps_home_url', function($home_url) {
        $home_url = apply_filters( 'wpml_home_url', get_option( 'home' ));
        return trailingslashit($home_url);
    });
} else {
```

### seopress_sitemaps_home_url
**File:** `wp-seopress/inc/functions/sitemap/template-xml-sitemaps-author.php`

**Context:**

```php
}

    $home_url = home_url() . '/';

    $home_url = apply_filters('seopress_sitemaps_home_url', $home_url);

    $seopress_sitemaps = '<?xml version="1.0" encoding="UTF-8"?>';
```

### wpml_element_language_code
**File:** `wp-seopress/inc/functions/sitemap/template-xml-sitemaps.php`

**Context:**

```php
});

add_action('the_post', function ($post) {
    $language = apply_filters(
        'wpml_element_language_code',
        null,
        ['element_id' => $post->ID, 'element_type' => 'page']
    );
    do_action('wpml_switch_language', $language);
});
```

### seopress_sitemaps_max_terms_per_sitemap
**File:** `wp-seopress/inc/functions/sitemap/template-xml-sitemaps-single-term.php`

**Context:**

```php
//Max posts per paginated sitemap
    $max = 1000;
    $max = apply_filters('seopress_sitemaps_max_terms_per_sitemap', $max);

    if (isset($offset) && absint($offset) && '' != $offset && 0 != $offset) {
        $offset = (($offset - 1) * $max);
```

### seopress_excerpt_length
**File:** `wp-seopress/inc/functions/variables/dynamic-variables.php`

**Context:**

```php
//Excerpt length
    $seopress_excerpt_length = 50;
    $seopress_excerpt_length = apply_filters('seopress_excerpt_length', $seopress_excerpt_length);

    //Remove WordPress Filters
    $seopress_array_filters = ['category_description', 'tag_description', 'term_description'];
```

### seopress_paged
**File:** `wp-seopress/inc/functions/variables/dynamic-variables.php`

**Context:**

```php
if (get_query_var('paged') > '1') {
        $seopress_paged = get_query_var('paged');
        $seopress_paged = apply_filters('seopress_paged', $seopress_paged);
    } else {
        $seopress_paged = '';
    }
```

### seopress_context_paged
**File:** `wp-seopress/inc/functions/variables/dynamic-variables.php`

**Context:**

```php
/* translators: %1$d current page (e.g. 2) %2$d total number of pages (e.g. 30) */
            $seopress_context_paged = ' ' . $sep . ' ' . sprintf(esc_attr__('Page %1$d of %2$d', 'wp-seopress'), esc_attr($current_page), esc_attr($wp_query->max_num_pages));
        }
        $seopress_context_paged = apply_filters('seopress_context_paged', $seopress_context_paged);
    }

    if ((is_singular() || $is_oembed === true) && isset($post->post_author)) {
```

### seopress_titles_post_thumbnail_url
**File:** `wp-seopress/inc/functions/variables/dynamic-variables.php`

**Context:**

```php
if ((is_singular() || $is_oembed === true) && isset($post)) {
        $post_thumbnail_url = get_the_post_thumbnail_url($post, 'full');
        $post_thumbnail_url = apply_filters('seopress_titles_post_thumbnail_url', $post_thumbnail_url);
    }

    if ((is_singular() || $is_oembed === true) && isset($post)) {
```

### seopress_titles_post_url
**File:** `wp-seopress/inc/functions/variables/dynamic-variables.php`

**Context:**

```php
if ((is_singular() || $is_oembed === true) && isset($post)) {
        $post_url = esc_url(get_permalink($post));
        $post_url = apply_filters('seopress_titles_post_url', $post_url);
    }

    if ((is_single() || $is_oembed === true) && has_category('', $post)) {
```

### seopress_titles_cat
**File:** `wp-seopress/inc/functions/variables/dynamic-variables.php`

**Context:**

```php
if ((is_single() || $is_oembed === true) && has_category('', $post)) {
        $post_category_array = get_the_terms($post->ID, 'category');
        $post_category       = $post_category_array[0]->name;
        $post_category       = apply_filters('seopress_titles_cat', $post_category);
    }

    if ((is_single() || $is_oembed === true) && has_tag('', $post)) {
```

### seopress_titles_tag
**File:** `wp-seopress/inc/functions/variables/dynamic-variables.php`

**Context:**

```php
if ((is_single() || $is_oembed === true) && has_tag('', $post)) {
        $post_tag_array = get_the_terms($post->ID, 'post_tag');
        $post_tag       = $post_tag_array[0]->name;
        $post_tag       = apply_filters('seopress_titles_tag', $post_tag);
    }

    if ('' != get_search_query()) {
```

### seopress_get_search_query
**File:** `wp-seopress/inc/functions/variables/dynamic-variables.php`

**Context:**

```php
} else {
        $get_search_query = esc_attr('" "');
    }
    $get_search_query = apply_filters('seopress_get_search_query', $get_search_query);

    //Post Title
    if ((is_singular() || $is_oembed === true) && isset($post)) {
```

### seopress_titles_product_cat
**File:** `wp-seopress/inc/functions/variables/dynamic-variables.php`

**Context:**

```php
foreach ($woo_single_cats as $term) {
                    $woo_single_cat[$term->term_id] = $term->name;
                }

                $woo_single_cat = apply_filters('seopress_titles_product_cat', $woo_single_cat);

                $woo_single_cat_html = stripslashes_deep(wp_filter_nohtml_kses(join(', ', $woo_single_cat)));
            }
```

### seopress_titles_product_tag
**File:** `wp-seopress/inc/functions/variables/dynamic-variables.php`

**Context:**

```php
foreach ($woo_single_tags as $term) {
                    $woo_single_tag[$term->term_id] = $term->name;
                }

                $woo_single_tag = apply_filters('seopress_titles_product_tag', $woo_single_tag);

                $woo_single_tag_html = stripslashes_deep(wp_filter_nohtml_kses(join(', ', $woo_single_tag)));
            }
```

### seopress_titles_template_variables_array
**File:** `wp-seopress/inc/functions/variables/dynamic-variables.php`

**Context:**

```php
'%%currentmonth_num%%',
        '%%target_keyword%%',
    ];

    $seopress_titles_template_variables_array = apply_filters('seopress_titles_template_variables_array', $seopress_titles_template_variables_array);

    $seopress_titles_template_replace_array = [
        $sep,
```

### seopress_titles_template_replace_array
**File:** `wp-seopress/inc/functions/variables/dynamic-variables.php`

**Context:**

```php
date_i18n('n'),
        $target_kw,
    ];

    $seopress_titles_template_replace_array = apply_filters('seopress_titles_template_replace_array', $seopress_titles_template_replace_array);

    $variables = [
        'post'                                     => $post,
```

### seopress_titles_template_variables
**File:** `wp-seopress/inc/functions/variables/dynamic-variables.php`

**Context:**

```php
'seopress_titles_template_replace_array'   => $seopress_titles_template_replace_array,
        'seopress_excerpt_length'                  => $seopress_excerpt_length,
    ];

    $variables = apply_filters('seopress_titles_template_variables', $variables);

    //Add WordPress Filters again
    $seopress_array_filters = ['category_description', 'tag_description', 'term_description'];
```

### postmeta_form_limit
**File:** `wp-seopress/seopress-functions.php`

**Context:**

```php
if (false === $cf_keys) {
		global $wpdb;

		$limit   = (int) apply_filters('postmeta_form_limit', 250);
		$cf_keys = $wpdb->get_col($wpdb->prepare("
			SELECT DISTINCT meta_key
			FROM $wpdb->postmeta
```

### seopress_get_custom_fields
**File:** `wp-seopress/seopress-functions.php`

**Context:**

```php
}
			}
		}

		$cf_keys = apply_filters('seopress_get_custom_fields', $cf_keys);

		if ($cf_keys) {
			natcasesort($cf_keys);
```

### seopress_capability
**File:** `wp-seopress/seopress-functions.php`

**Context:**

```php
* @param mixed $context
 */
function seopress_capability($cap, $context = '') {
	$newcap = apply_filters('seopress_capability', $cap, $context);

	if ( ! current_user_can($newcap)) {
		return $cap;
```

### seopress_elementor_integration_enabled
**File:** `wp-seopress/seopress.php`

**Context:**

```php
// Load options and admin bar
	require_once $plugin_dir . 'inc/functions/options.php';
	require_once $plugin_dir . 'inc/admin/admin-bar/admin-bar.php';

	// Load integrations conditionally
	if (did_action('elementor/loaded') && apply_filters('seopress_elementor_integration_enabled', true)) {
		include_once $plugin_dir . 'inc/admin/page-builders/elementor/elementor-addon.php';
	}

	if (version_compare($wp_version, '5.0', '>=')) {
```

### seopress_module_metabox_is_gutenberg
**File:** `wp-seopress/src/Actions/Admin/ModuleMetabox.php`

**Context:**

```php
'NONCE'                   => wp_create_nonce('wp_rest'),
            'POST_ID'                 => $postId,
            'POST_TYPE'               => $postType,
            'IS_GUTENBERG'            => apply_filters('seopress_module_metabox_is_gutenberg', $isGutenberg),
            'SELECTOR_GUTENBERG'      => apply_filters('seopress_module_metabox_selector_gutenberg', '.edit-post-header .edit-post-header-toolbar__left'),
            'TOGGLE_MOBILE_PREVIEW' => apply_filters('seopress_toggle_mobile_preview', 1),
            'GOOGLE_SUGGEST' => [
                'ACTIVE'        => apply_filters('seopress_ui_metabox_google_suggest', false),
                'LOCALE'       => $locale,
                'COUNTRY_CODE' => $country_code,
            ],
            'USER_ROLES' => array_values($roles),
            'ROLES_BLOCKED' => [
                'GLOBAL' => $settingsAdvanced->getSecurityMetaboxRole(),
                'CONTENT_ANALYSIS' => $settingsAdvanced->getSecurityMetaboxRoleContentAnalysis()
            ],
            'OPTIONS' => [
                "AI" => seopress_get_service('ToggleOption')->getToggleAi() === "1" ? true : false,
            ],
            'TABS' => [
                'SCHEMAS' => apply_filters('seopress_active_schemas_manual_universal_metabox', false)
            ],
            'SUB_TABS' => [
                'GOOGLE_NEWS' => apply_filters('seopress_active_google_news', false),
                'VIDEO_SITEMAP' => apply_filters('seopress_active_video_sitemap', false),
                'INSPECT_URL' => apply_filters('seopress_active_inspect_url', false),
                'INTERNAL_LINKING' => apply_filters('seopress_active_internal_linking', false),
                'SCHEMA_MANUAL' =>  apply_filters('seopress_active_schemas', false)
            ],
            'FAVICON' => get_site_icon_url(32),
            'BEACON_SVG' => apply_filters('seopress_beacon_svg', SEOPRESS_URL_ASSETS.'/img/beacon.svg'),
            'AI_SVG' => apply_filters('seopress_ai_svg', SEOPRESS_URL_ASSETS.'/img/ai.svg'),
        ], $argsLocalize);

        wp_localize_script('seopress-metabox', 'SEOPRESS_DATA', $args);
        wp_localize_script('seopress-metabox', 'SEOPRESS_I18N', seopress_get_service('I18nUniversalMetabox')->getTranslations());
```

### seopress_module_metabox_selector_gutenberg
**File:** `wp-seopress/src/Actions/Admin/ModuleMetabox.php`

**Context:**

```php
'POST_ID'                 => $postId,
            'POST_TYPE'               => $postType,
            'IS_GUTENBERG'            => apply_filters('seopress_module_metabox_is_gutenberg', $isGutenberg),
            'SELECTOR_GUTENBERG'      => apply_filters('seopress_module_metabox_selector_gutenberg', '.edit-post-header .edit-post-header-toolbar__left'),
            'TOGGLE_MOBILE_PREVIEW' => apply_filters('seopress_toggle_mobile_preview', 1),
            'GOOGLE_SUGGEST' => [
                'ACTIVE'        => apply_filters('seopress_ui_metabox_google_suggest', false),
                'LOCALE'       => $locale,
                'COUNTRY_CODE' => $country_code,
            ],
            'USER_ROLES' => array_values($roles),
            'ROLES_BLOCKED' => [
                'GLOBAL' => $settingsAdvanced->getSecurityMetaboxRole(),
                'CONTENT_ANALYSIS' => $settingsAdvanced->getSecurityMetaboxRoleContentAnalysis()
            ],
            'OPTIONS' => [
                "AI" => seopress_get_service('ToggleOption')->getToggleAi() === "1" ? true : false,
            ],
            'TABS' => [
                'SCHEMAS' => apply_filters('seopress_active_schemas_manual_universal_metabox', false)
            ],
            'SUB_TABS' => [
                'GOOGLE_NEWS' => apply_filters('seopress_active_google_news', false),
                'VIDEO_SITEMAP' => apply_filters('seopress_active_video_sitemap', false),
                'INSPECT_URL' => apply_filters('seopress_active_inspect_url', false),
                'INTERNAL_LINKING' => apply_filters('seopress_active_internal_linking', false),
                'SCHEMA_MANUAL' =>  apply_filters('seopress_active_schemas', false)
            ],
            'FAVICON' => get_site_icon_url(32),
            'BEACON_SVG' => apply_filters('seopress_beacon_svg', SEOPRESS_URL_ASSETS.'/img/beacon.svg'),
            'AI_SVG' => apply_filters('seopress_ai_svg', SEOPRESS_URL_ASSETS.'/img/ai.svg'),
        ], $argsLocalize);

        wp_localize_script('seopress-metabox', 'SEOPRESS_DATA', $args);
        wp_localize_script('seopress-metabox', 'SEOPRESS_I18N', seopress_get_service('I18nUniversalMetabox')->getTranslations());
```

### seopress_ui_metabox_google_suggest
**File:** `wp-seopress/src/Actions/Admin/ModuleMetabox.php`

**Context:**

```php
'SELECTOR_GUTENBERG'      => apply_filters('seopress_module_metabox_selector_gutenberg', '.edit-post-header .edit-post-header-toolbar__left'),
            'TOGGLE_MOBILE_PREVIEW' => apply_filters('seopress_toggle_mobile_preview', 1),
            'GOOGLE_SUGGEST' => [
                'ACTIVE'        => apply_filters('seopress_ui_metabox_google_suggest', false),
                'LOCALE'       => $locale,
                'COUNTRY_CODE' => $country_code,
            ],
            'USER_ROLES' => array_values($roles),
            'ROLES_BLOCKED' => [
                'GLOBAL' => $settingsAdvanced->getSecurityMetaboxRole(),
                'CONTENT_ANALYSIS' => $settingsAdvanced->getSecurityMetaboxRoleContentAnalysis()
            ],
            'OPTIONS' => [
                "AI" => seopress_get_service('ToggleOption')->getToggleAi() === "1" ? true : false,
            ],
            'TABS' => [
                'SCHEMAS' => apply_filters('seopress_active_schemas_manual_universal_metabox', false)
            ],
            'SUB_TABS' => [
                'GOOGLE_NEWS' => apply_filters('seopress_active_google_news', false),
                'VIDEO_SITEMAP' => apply_filters('seopress_active_video_sitemap', false),
                'INSPECT_URL' => apply_filters('seopress_active_inspect_url', false),
                'INTERNAL_LINKING' => apply_filters('seopress_active_internal_linking', false),
                'SCHEMA_MANUAL' =>  apply_filters('seopress_active_schemas', false)
            ],
            'FAVICON' => get_site_icon_url(32),
            'BEACON_SVG' => apply_filters('seopress_beacon_svg', SEOPRESS_URL_ASSETS.'/img/beacon.svg'),
            'AI_SVG' => apply_filters('seopress_ai_svg', SEOPRESS_URL_ASSETS.'/img/ai.svg'),
        ], $argsLocalize);

        wp_localize_script('seopress-metabox', 'SEOPRESS_DATA', $args);
        wp_localize_script('seopress-metabox', 'SEOPRESS_I18N', seopress_get_service('I18nUniversalMetabox')->getTranslations());
```

### seopress_active_schemas_manual_universal_metabox
**File:** `wp-seopress/src/Actions/Admin/ModuleMetabox.php`

**Context:**

```php
"AI" => seopress_get_service('ToggleOption')->getToggleAi() === "1" ? true : false,
            ],
            'TABS' => [
                'SCHEMAS' => apply_filters('seopress_active_schemas_manual_universal_metabox', false)
            ],
            'SUB_TABS' => [
                'GOOGLE_NEWS' => apply_filters('seopress_active_google_news', false),
                'VIDEO_SITEMAP' => apply_filters('seopress_active_video_sitemap', false),
                'INSPECT_URL' => apply_filters('seopress_active_inspect_url', false),
                'INTERNAL_LINKING' => apply_filters('seopress_active_internal_linking', false),
                'SCHEMA_MANUAL' =>  apply_filters('seopress_active_schemas', false)
            ],
            'FAVICON' => get_site_icon_url(32),
            'BEACON_SVG' => apply_filters('seopress_beacon_svg', SEOPRESS_URL_ASSETS.'/img/beacon.svg'),
            'AI_SVG' => apply_filters('seopress_ai_svg', SEOPRESS_URL_ASSETS.'/img/ai.svg'),
        ], $argsLocalize);

        wp_localize_script('seopress-metabox', 'SEOPRESS_DATA', $args);
        wp_localize_script('seopress-metabox', 'SEOPRESS_I18N', seopress_get_service('I18nUniversalMetabox')->getTranslations());
```

### seopress_active_google_news
**File:** `wp-seopress/src/Actions/Admin/ModuleMetabox.php`

**Context:**

```php
'SCHEMAS' => apply_filters('seopress_active_schemas_manual_universal_metabox', false)
            ],
            'SUB_TABS' => [
                'GOOGLE_NEWS' => apply_filters('seopress_active_google_news', false),
                'VIDEO_SITEMAP' => apply_filters('seopress_active_video_sitemap', false),
                'INSPECT_URL' => apply_filters('seopress_active_inspect_url', false),
                'INTERNAL_LINKING' => apply_filters('seopress_active_internal_linking', false),
                'SCHEMA_MANUAL' =>  apply_filters('seopress_active_schemas', false)
            ],
            'FAVICON' => get_site_icon_url(32),
            'BEACON_SVG' => apply_filters('seopress_beacon_svg', SEOPRESS_URL_ASSETS.'/img/beacon.svg'),
            'AI_SVG' => apply_filters('seopress_ai_svg', SEOPRESS_URL_ASSETS.'/img/ai.svg'),
        ], $argsLocalize);

        wp_localize_script('seopress-metabox', 'SEOPRESS_DATA', $args);
        wp_localize_script('seopress-metabox', 'SEOPRESS_I18N', seopress_get_service('I18nUniversalMetabox')->getTranslations());
```

### seopress_active_video_sitemap
**File:** `wp-seopress/src/Actions/Admin/ModuleMetabox.php`

**Context:**

```php
],
            'SUB_TABS' => [
                'GOOGLE_NEWS' => apply_filters('seopress_active_google_news', false),
                'VIDEO_SITEMAP' => apply_filters('seopress_active_video_sitemap', false),
                'INSPECT_URL' => apply_filters('seopress_active_inspect_url', false),
                'INTERNAL_LINKING' => apply_filters('seopress_active_internal_linking', false),
                'SCHEMA_MANUAL' =>  apply_filters('seopress_active_schemas', false)
            ],
            'FAVICON' => get_site_icon_url(32),
            'BEACON_SVG' => apply_filters('seopress_beacon_svg', SEOPRESS_URL_ASSETS.'/img/beacon.svg'),
            'AI_SVG' => apply_filters('seopress_ai_svg', SEOPRESS_URL_ASSETS.'/img/ai.svg'),
        ], $argsLocalize);

        wp_localize_script('seopress-metabox', 'SEOPRESS_DATA', $args);
        wp_localize_script('seopress-metabox', 'SEOPRESS_I18N', seopress_get_service('I18nUniversalMetabox')->getTranslations());
```

### seopress_active_inspect_url
**File:** `wp-seopress/src/Actions/Admin/ModuleMetabox.php`

**Context:**

```php
'SUB_TABS' => [
                'GOOGLE_NEWS' => apply_filters('seopress_active_google_news', false),
                'VIDEO_SITEMAP' => apply_filters('seopress_active_video_sitemap', false),
                'INSPECT_URL' => apply_filters('seopress_active_inspect_url', false),
                'INTERNAL_LINKING' => apply_filters('seopress_active_internal_linking', false),
                'SCHEMA_MANUAL' =>  apply_filters('seopress_active_schemas', false)
            ],
            'FAVICON' => get_site_icon_url(32),
            'BEACON_SVG' => apply_filters('seopress_beacon_svg', SEOPRESS_URL_ASSETS.'/img/beacon.svg'),
            'AI_SVG' => apply_filters('seopress_ai_svg', SEOPRESS_URL_ASSETS.'/img/ai.svg'),
        ], $argsLocalize);

        wp_localize_script('seopress-metabox', 'SEOPRESS_DATA', $args);
        wp_localize_script('seopress-metabox', 'SEOPRESS_I18N', seopress_get_service('I18nUniversalMetabox')->getTranslations());
```

### seopress_active_internal_linking
**File:** `wp-seopress/src/Actions/Admin/ModuleMetabox.php`

**Context:**

```php
'GOOGLE_NEWS' => apply_filters('seopress_active_google_news', false),
                'VIDEO_SITEMAP' => apply_filters('seopress_active_video_sitemap', false),
                'INSPECT_URL' => apply_filters('seopress_active_inspect_url', false),
                'INTERNAL_LINKING' => apply_filters('seopress_active_internal_linking', false),
                'SCHEMA_MANUAL' =>  apply_filters('seopress_active_schemas', false)
            ],
            'FAVICON' => get_site_icon_url(32),
            'BEACON_SVG' => apply_filters('seopress_beacon_svg', SEOPRESS_URL_ASSETS.'/img/beacon.svg'),
            'AI_SVG' => apply_filters('seopress_ai_svg', SEOPRESS_URL_ASSETS.'/img/ai.svg'),
        ], $argsLocalize);

        wp_localize_script('seopress-metabox', 'SEOPRESS_DATA', $args);
        wp_localize_script('seopress-metabox', 'SEOPRESS_I18N', seopress_get_service('I18nUniversalMetabox')->getTranslations());
```

### seopress_active_schemas
**File:** `wp-seopress/src/Actions/Admin/ModuleMetabox.php`

**Context:**

```php
'VIDEO_SITEMAP' => apply_filters('seopress_active_video_sitemap', false),
                'INSPECT_URL' => apply_filters('seopress_active_inspect_url', false),
                'INTERNAL_LINKING' => apply_filters('seopress_active_internal_linking', false),
                'SCHEMA_MANUAL' =>  apply_filters('seopress_active_schemas', false)
            ],
            'FAVICON' => get_site_icon_url(32),
            'BEACON_SVG' => apply_filters('seopress_beacon_svg', SEOPRESS_URL_ASSETS.'/img/beacon.svg'),
            'AI_SVG' => apply_filters('seopress_ai_svg', SEOPRESS_URL_ASSETS.'/img/ai.svg'),
        ], $argsLocalize);

        wp_localize_script('seopress-metabox', 'SEOPRESS_DATA', $args);
        wp_localize_script('seopress-metabox', 'SEOPRESS_I18N', seopress_get_service('I18nUniversalMetabox')->getTranslations());
```

### seopress_beacon_svg
**File:** `wp-seopress/src/Actions/Admin/ModuleMetabox.php`

**Context:**

```php
'SCHEMA_MANUAL' =>  apply_filters('seopress_active_schemas', false)
            ],
            'FAVICON' => get_site_icon_url(32),
            'BEACON_SVG' => apply_filters('seopress_beacon_svg', SEOPRESS_URL_ASSETS.'/img/beacon.svg'),
            'AI_SVG' => apply_filters('seopress_ai_svg', SEOPRESS_URL_ASSETS.'/img/ai.svg'),
        ], $argsLocalize);

        wp_localize_script('seopress-metabox', 'SEOPRESS_DATA', $args);
        wp_localize_script('seopress-metabox', 'SEOPRESS_I18N', seopress_get_service('I18nUniversalMetabox')->getTranslations());
```

### seopress_ai_svg
**File:** `wp-seopress/src/Actions/Admin/ModuleMetabox.php`

**Context:**

```php
],
            'FAVICON' => get_site_icon_url(32),
            'BEACON_SVG' => apply_filters('seopress_beacon_svg', SEOPRESS_URL_ASSETS.'/img/beacon.svg'),
            'AI_SVG' => apply_filters('seopress_ai_svg', SEOPRESS_URL_ASSETS.'/img/ai.svg'),
        ], $argsLocalize);

        wp_localize_script('seopress-metabox', 'SEOPRESS_DATA', $args);
        wp_localize_script('seopress-metabox', 'SEOPRESS_I18N', seopress_get_service('I18nUniversalMetabox')->getTranslations());
```

### seopress_get_count_target_keywords
**File:** `wp-seopress/src/Actions/Api/CountTargetKeywordsUse.php`

**Context:**

```php
$targetKeywords   =  $request->get_param('keywords');

        $data = seopress_get_service('CountTargetKeywordsUse')->getCountByKeywords($targetKeywords, $id);

        $data = apply_filters('seopress_get_count_target_keywords', $data);

        return new \WP_REST_Response($data);
    }
```

### seopress_headless_get_post
**File:** `wp-seopress/src/Actions/Api/GetPost.php`

**Context:**

```php
"breadcrumbs" => $breadcrumbs,
            "redirections" => $redirections
        ];

        return apply_filters('seopress_headless_get_post', $data, $id, $context);

    }
```

### seopress_headless_url_to_postid
**File:** `wp-seopress/src/Actions/Api/GetPost.php`

**Context:**

```php
}

        try {
            $id = apply_filters('seopress_headless_url_to_postid', url_to_postid($url), $request);
            if(!$id){
                return new \WP_Error("not_found", "ID for URL not found");
            }
```

### seopress_schemas_organization_html
**File:** `wp-seopress/src/Actions/Front/Schemas/PrintHeadJsonSchema.php`

**Context:**

```php
$jsons = seopress_get_service('JsonSchemaGenerator')->getJsonsEncoded([
            'organization'
        ]);
        ?><script type="application/ld+json"><?php echo apply_filters('seopress_schemas_organization_html', $jsons[0]); ?></script>
```

### seopress_schemas_available
**File:** `wp-seopress/src/Compose/UseJsonSchema.php`

**Context:**

```php
*/
    public function getSchemasAvailable() {
        if (null !== $this->schemasAvailable) {
            return apply_filters('seopress_schemas_available', $this->schemasAvailable);
        }

        $schemas = $this->buildSchemas(SEOPRESS_PLUGIN_DIR_PATH . 'src/JsonSchemas');
```

### seopress_tags_available
**File:** `wp-seopress/src/Compose/UseTags.php`

**Context:**

```php
}
        }


        $this->tagsAvailable[$hash] = apply_filters('seopress_tags_available', $tags);

        return $this->tagsAvailable[$hash];
    }
```

### seopress_get_content_analysis_data
**File:** `wp-seopress/src/Helpers/ContentAnalysis.php`

**Context:**

```php
'desc'   => null,
            ],
        ];

        return apply_filters('seopress_get_content_analysis_data', $data);
    }
}
```

### seopress_get_options_schema_currencies
**File:** `wp-seopress/src/Helpers/Currencies.php`

**Context:**

```php
abstract class Currencies {
    public static function getOptions() {
        return apply_filters('seopress_get_options_schema_currencies', [
            ['value' => 'none', 'label' => __('Select a Currency', 'wp-seopress')],
            ['value' => 'USD', 'label' => __('U.S. Dollar', 'wp-seopress')],
            ['value' => 'GBP', 'label' => __('Pound Sterling', 'wp-seopress')],
            ['value' => 'EUR', 'label' => __('Euro', 'wp-seopress')],
            ['value' => 'ARS', 'label' => __('Argentina Peso', 'wp-seopress')],
            ['value' => 'AUD', 'label' => __('Australian Dollar', 'wp-seopress')],
            ['value' => 'BRL', 'label' => __('Brazilian Real', 'wp-seopress')],
            ['value' => 'BGN', 'label' => __('Bulgarian lev', 'wp-seopress')],
            ['value' => 'CAD', 'label' => __('Canadian Dollar', 'wp-seopress')],
            ['value' => 'CLP', 'label' => __('Chilean Peso', 'wp-seopress')],
            ['value' => 'CZK', 'label' => __('Czech Koruna', 'wp-seopress')],
            ['value' => 'DKK', 'label' => __('Danish Krone', 'wp-seopress')],
            ['value' => 'HKD', 'label' => __('Hong Kong Dollar', 'wp-seopress')],
            ['value' => 'HUF', 'label' => __('Hungarian Forint', 'wp-seopress')],
            ['value' => 'INR', 'label' => __('Indian rupee', 'wp-seopress')],
            ['value' => 'ILS', 'label' => __('Israeli New Sheqel', 'wp-seopress')],
            ['value' => 'JPY', 'label' => __('Japanese Yen', 'wp-seopress')],
            ['value' => 'MYR', 'label' => __('Malaysian Ringgit', 'wp-seopress')],
            ['value' => 'MXN', 'label' => __('Mexican Peso', 'wp-seopress')],
            ['value' => 'NOK', 'label' => __('Norwegian Krone', 'wp-seopress')],
            ['value' => 'NZD', 'label' => __('New Zealand Dollar', 'wp-seopress')],
            ['value' => 'PHP', 'label' => __('Philippine Peso', 'wp-seopress')],
            ['value' => 'PLN', 'label' => __('Polish Zloty', 'wp-seopress')],
            ['value' => 'IDR', 'label' => __('Indonesian rupiah', 'wp-seopress')],
            ['value' => 'RUB', 'label' => __('Russian Ruble', 'wp-seopress')],
            ['value' => 'SGD', 'label' => __('Singapore Dollar', 'wp-seopress')],
            ['value' => 'PEN', 'label' => __('Sol', 'wp-seopress')],
            ['value' => 'ZAR', 'label' => __('South African Rand', 'wp-seopress')],
            ['value' => 'SEK', 'label' => __('Swedish Krona', 'wp-seopress')],
            ['value' => 'CHF', 'label' => __('Swiss Franc', 'wp-seopress')],
            ['value' => 'TWD', 'label' => __('Taiwan New Dollar', 'wp-seopress')],
            ['value' => 'THB', 'label' => __('Thai Baht', 'wp-seopress')],
            ['value' => 'UAH', 'label' => __('Ukrainian hryvnia', 'wp-seopress')],
            ['value' => 'VND', 'label' => __('Vietnamese đồng', 'wp-seopress')],
        ]);
    }
}
```

### seopress_api_meta_redirection_settings
**File:** `wp-seopress/src/Helpers/Metas/RedirectionSettings.php`

**Context:**

```php
if($defaultType === null || empty($defaultType)){
            $defaultType = 301;
        }

        $data = apply_filters('seopress_api_meta_redirection_settings', [
            [
                'key'         => '_seopress_redirections_enabled',
                'type'        => 'checkbox',
                'placeholder' => '',
                'use_default' => '',
                'default'     => '',
                'label'       => __('Enabled redirection?', 'wp-seopress'),
                'visible'     => true,
            ],
            [
                'key'         => '_seopress_redirections_logged_status',
                'type'        => 'select',
                'placeholder' => '',
                'use_default' => true,
                'default'     => $defaultStatus,
                'label'       => __('Select a login status:', 'wp-seopress'),
                'options'     => [
                    ['value' => 'both', 'label' =>  __('All', 'wp-seopress')],
                    ['value' => 'only_logged_in', 'label' =>  __('Only Logged In', 'wp-seopress')],
                    ['value' => 'only_not_logged_in', 'label' =>  __('Only Not Logged In', 'wp-seopress')],
                ],
                'visible'     => true,
            ],
            [
                'key'         => '_seopress_redirections_type',
                'type'        => 'select',
                'placeholder' => '',
                'use_default' => true,
                'default'     => $defaultType,
                'label'       => __('Select a redirection type:', 'wp-seopress'),
                'options'     => [
                    ['value' => 301, 'label' =>  __('301 Moved Permanently', 'wp-seopress')],
                    ['value' => 302, 'label' =>  __('302 Found / Moved Temporarily', 'wp-seopress')],
                    ['value' => 307, 'label' =>  __('307 Moved Temporarily', 'wp-seopress')]
                ],
                'visible'     => true,
            ],
            [
                'key'         => '_seopress_redirections_value',
                'type'        => 'input',
                'placeholder' => __('Enter your new URL in absolute (e.g. https://www.example.com/)', 'wp-seopress'),
                'label'       => __('URL redirection', 'wp-seopress'),
                'description' => __('Enter some keywords to auto-complete this field against your content', 'wp-seopress'),
                'use_default' => '',
                'default'     => '',
                'visible'     => true,
            ],
        ], $id);

        return $data;
    }
```

### seopress_api_meta_robot_settings
**File:** `wp-seopress/src/Helpers/Metas/RobotSettings.php`

**Context:**

```php
$titleOptionService = seopress_get_service('TitleOption');

        $postType = get_post_type($id);

        $data = apply_filters('seopress_api_meta_robot_settings', [
            [
                'key'         => '_seopress_robots_index',
                'type'        => 'checkbox',
                'use_default' => $titleOptionService->getSingleCptNoIndex($id) || $titleOptionService->getTitleNoIndex() || true === post_password_required($id),
                'default'     => 'yes',
                'label'       => __('Do not display this page in search engine results / XML - HTML sitemaps (noindex)', 'wp-seopress'),
                'visible'     => true,
            ],
            [
                'key'         => '_seopress_robots_follow',
                'type'        => 'checkbox',
                'use_default' => $titleOptionService->getSingleCptNoFollow($id) || $titleOptionService->getTitleNoFollow(),
                'default'     => 'yes',
                'label'       => __('Do not follow links for this page (nofollow)', 'wp-seopress'),
                'visible'     => true,
            ],
            [
                'key'         => '_seopress_robots_snippet',
                'type'        => 'checkbox',
                'use_default' => $titleOptionService->getTitleNoSnippet(),
                'default'     => 'yes',
                'label'       => __('Do not display a description in search results for this page (nosnippet)', 'wp-seopress'),
                'visible'     => true,
            ],
            [
                'key'         => '_seopress_robots_imageindex',
                'type'        => 'checkbox',
                'use_default' => $titleOptionService->getTitleNoImageIndex(),
                'default'     => 'yes',
                'label'       => __('Do not index images for this page (noimageindex)', 'wp-seopress'),
                'visible'     => true,
            ],
            [
                'key'         => '_seopress_robots_canonical',
                'type'        => 'input',
                'use_default' => '',
                'placeholder' => sprintf('%s %s', __('Default value: ', 'wp-seopress'), urldecode(get_permalink($id))),
                'default'     => '',
                'label'       => __('Canonical URL', 'wp-seopress'),
                'visible'     => true,
            ],
            [
                'key'         => '_seopress_robots_primary_cat',
                'type'        => 'select',
                'use_default' => '',
                'placeholder' => '',
                'default'     => '',
                'label'       => __('Select a primary category', 'wp-seopress'),
                'description' => /* translators: category permalink structure */ wp_kses_post(sprintf(__('Set thee category that gets used in the %s permalink and in our breadcrumbs if you have multiple categories.', 'wp-seopress'), '<code>%category%</code>')),
                'options'     => self::getRobotPrimaryCats($id, $postType),
                'visible'     => ('post' === $postType || 'product' === $postType),
            ],
        ], $id);

        return $data;
    }
```

### seopress_api_meta_social_settings
**File:** `wp-seopress/src/Helpers/Metas/SocialSettings.php`

**Context:**

```php
$facebook = self::getMetaKeysFacebook();
        $twitter = self::getMetaKeysTwitter();
        $all = array_merge($facebook, $twitter);
        return apply_filters('seopress_api_meta_social_settings', $all, $id);

    }
}
```

### seopress_pages_admin
**File:** `wp-seopress/src/Helpers/PagesAdmin.php`

**Context:**

```php
const LICENSE          = 'license';

    public static function getPages() {
        return apply_filters('seopress_pages_admin', [
            self::DASHBOARD,
            self::TITLE_METAS,
            self::XML_HTML_SITEMAP,
            self::SOCIAL_NETWORKS,
            self::ANALYTICS,
            self::ADVANCED,
            self::TOOLS,
            self::INSTANT_INDEXING,
            self::PRO,
            self::SCHEMAS,
            self::BOT,
            self::LICENSE,
        ]);
    }

    /**
```

### seopress_get_capability_by_page
**File:** `wp-seopress/src/Helpers/PagesAdmin.php`

**Context:**

```php
case 'seopress-bot-batch':
                return self::BOT;
            default:
                return apply_filters('seopress_get_capability_by_page', null);
        }
    }
```

### seopress_get_page_by_capability
**File:** `wp-seopress/src/Helpers/PagesAdmin.php`

**Context:**

```php
case self::BOT:
                return 'seopress-bot-batch';
            default:
                return apply_filters('seopress_get_page_by_capability', null);
        }
    }
```

### seopress_get_options_schema_course_categories
**File:** `wp-seopress/src/Helpers/Schemas/Course.php`

**Context:**

```php
abstract class Course {
    public static function getCategories() {
        return apply_filters('seopress_get_options_schema_course_categories', [
            ['value' => 'none', 'label' => __('Select a category', 'wp-seopress')],
            ['value' => 'Free', 'label' => __('Free', 'wp-seopress')],
            ['value' => 'Partially Free', 'label' => __('Partially free', 'wp-seopress')],
            ['value' => 'Subscription', 'label' => __('Subscription', 'wp-seopress')],
            ['value' => 'Paid', 'label' => __('Paid', 'wp-seopress')],
        ]);
    }

    public static function getCourseModes() {
```

### seopress_get_options_schema_course_course_modes
**File:** `wp-seopress/src/Helpers/Schemas/Course.php`

**Context:**

```php
}

    public static function getCourseModes() {
        return apply_filters('seopress_get_options_schema_course_course_modes', [
            ['value' => 'none', 'label' => __('Select a category', 'wp-seopress')],
            ['value' => 'Onsite', 'label' => __('Onsite', 'wp-seopress')],
            ['value' => 'Online', 'label' => __('Online', 'wp-seopress')],
        ]);
    }
    
    public static function getRepeatFrequencies() {
```

### seopress_get_options_schema_course_repeat_frequencies
**File:** `wp-seopress/src/Helpers/Schemas/Course.php`

**Context:**

```php
}
    
    public static function getRepeatFrequencies() {
        return apply_filters('seopress_get_options_schema_course_repeat_frequencies', [
            ['value' => 'none', 'label' => __('Select a category', 'wp-seopress')],
            ['value' => 'Daily', 'label' => __('Daily', 'wp-seopress')],
            ['value' => 'Weekly', 'label' => __('Weekly', 'wp-seopress')],
            ['value' => 'Monthly', 'label' => __('Monthly', 'wp-seopress')],
            ['value' => 'Yearly', 'label' => __('Yearly', 'wp-seopress')],
        ]);
    }
}
```

### seopress_get_json_data_contact_point
**File:** `wp-seopress/src/JsonSchemas/ContactPoint.php`

**Context:**

```php
*/
    public function getJsonData($context = null) {
        $data = $this->getArrayJson();

        return apply_filters('seopress_get_json_data_contact_point', $data);
    }
}
```

### seopress_get_json_data_image
**File:** `wp-seopress/src/JsonSchemas/Image.php`

**Context:**

```php
*/
    public function getJsonData($context = null) {
        $data = $this->getArrayJson();

        return apply_filters('seopress_get_json_data_image', $data);
    }
}
```

### seopress_get_json_data_organization
**File:** `wp-seopress/src/JsonSchemas/Organization.php`

**Context:**

```php
unset($data['logo']);
            }
        }

        return apply_filters('seopress_get_json_data_organization', $data);
    }

    /**
```

### seopress_get_json_from_file
**File:** `wp-seopress/src/Models/JsonSchemaValue.php`

**Context:**

```php
* @return string
     */
    public function getJson() {
        $file = apply_filters('seopress_get_json_from_file', sprintf('%s/%s.json', SEOPRESS_TEMPLATE_JSON_SCHEMAS, $this->getName(), '.json'));

        if ( ! file_exists($file)) {
            return '';
```

### seopress_schema_get_array_json
**File:** `wp-seopress/src/Models/JsonSchemaValue.php`

**Context:**

```php
$json = $this->getJson();
        try {
            $data = json_decode($json, true);

            return apply_filters('seopress_schema_get_array_json', $data, $this->getName());
        } catch (\Exception $th) {
            return [];
        }
```

### seopress_schema_clean_values
**File:** `wp-seopress/src/Models/JsonSchemaValue.php`

**Context:**

```php
* @return array
     */
    public function cleanValues($data) {
        return apply_filters('seopress_schema_clean_values', $data, $this->getName());
    }
}
```

### seopress_notifications_center_item
**File:** `wp-seopress/src/Services/Admin/Notifications/Notifications.php`

**Context:**

```php
$args['impact']['medium'] = $alerts_medium;
		$args['impact']['low'] = $alerts_low;
		$args['impact']['info'] = $alerts_info;

		$args = apply_filters( 'seopress_notifications_center_item', $args, $alerts_info, $alerts_low, $alerts_medium, $alerts_high );

		return $args;
	}
```

### seopress_content_analysis_target_keywords
**File:** `wp-seopress/src/Services/ContentAnalysis/DomAnalysis.php`

**Context:**

```php
$targetKeywords = isset($options['target_keywords']) && !empty($options['target_keywords']) ? $options['target_keywords'] : get_post_meta($options['id'], '_seopress_analysis_target_kw', true);

        $targetKeywords = array_filter(explode(',', remove_accents(strtolower($targetKeywords))));

        return apply_filters( 'seopress_content_analysis_target_keywords', $targetKeywords, $options['id'] );
    }

    public function getScore($post){
```

### seopress_real_preview_custom_args
**File:** `wp-seopress/src/Services/ContentAnalysis/RequestPreview.php`

**Context:**

```php
{
    public function getLinkRequest($id, $taxname = null){
        $args = ['no_admin_bar' => 1];

        //Useful for Page / Theme builders
        $args = apply_filters('seopress_real_preview_custom_args', $args);

        //Oxygen / beTheme compatibility
        $theme = wp_get_theme();
```

### seopress_get_dom_link
**File:** `wp-seopress/src/Services/ContentAnalysis/RequestPreview.php`

**Context:**

```php
$link = get_term_link((int) $id, $taxname);
            $link = add_query_arg('no_admin_bar', 1, $link);
        }


        $link = apply_filters('seopress_get_dom_link', $link, $id);

        return $link;
    }
```

### seopress_real_preview_remote
**File:** `wp-seopress/src/Services/ContentAnalysis/RequestPreview.php`

**Context:**

```php
if (! empty($cookies)) {
            $args['cookies'] = $cookies;
        }

        $args = apply_filters('seopress_real_preview_remote', $args);

        $link = $this->getLinkRequest($id, $taxname);
```

### seopress_can_enqueue_universal_metabox
**File:** `wp-seopress/src/Services/EnqueueModuleMetabox.php`

**Context:**

```php
if(isset($_POST['can_enqueue_seopress_metabox']) && $_POST['can_enqueue_seopress_metabox'] === '1'){
            $response = true;
        }

        return apply_filters('seopress_can_enqueue_universal_metabox', $response);
    }
}
```

### seopress_sitemaps_html_product_cat_slug
**File:** `wp-seopress/src/Services/HTMLSitemap/HTMLSitemapService.php`

**Context:**

```php
$html,
            '[seopress_html_sitemap]'
        );

        $product_cat_slug = apply_filters('seopress_sitemaps_html_product_cat_slug', 'product_cat');
        
        $exclude_option = $this->sitemapOption->getHtmlExclude() ?: '';
        $order_option = $this->sitemapOption->getHtmlOrder() ?: '';
```

### seopress_sitemaps_html_cpt
**File:** `wp-seopress/src/Services/HTMLSitemap/HTMLSitemapService.php`

**Context:**

```php
$post_types_list[$value] = ['include' => '1'];
                }
            }

            $post_types_list = apply_filters('seopress_sitemaps_html_cpt', $post_types_list);

            foreach ($post_types_list as $cpt_key => $cpt_value) {
                if (!empty($cpt_value)) {
```

### seopress_sitemaps_html_cpt_name
**File:** `wp-seopress/src/Services/HTMLSitemap/HTMLSitemapService.php`

**Context:**

```php
$obj = get_post_type_object($cpt_key);
                if ($obj) {
                    $cpt_name = apply_filters('seopress_sitemaps_html_cpt_name', $obj->labels->name, $obj->name);
                    $html .= '<h2 class="sp-cpt-name">' . $cpt_name . '</h2>';

                    // Add archive link if post type has archives enabled
```

### seopress_sitemaps_html_display_terms_only
**File:** `wp-seopress/src/Services/HTMLSitemap/HTMLSitemapService.php`

**Context:**

```php
$args_cat_query = $this->getCategoryQueryArgs($exclude_option);

                        $cats = $this->getCategories($cpt_key, $args_cat_query, $product_cat_slug);

                        // Check if we should only display terms
                        $display_terms_only = apply_filters('seopress_sitemaps_html_display_terms_only', $atts['terms_only'], $cpt_key);

                        if (is_array($cats) && !empty($cats)) {
                            if ($display_terms_only) {
```

### seopress_sitemaps_html_term_name
**File:** `wp-seopress/src/Services/HTMLSitemap/HTMLSitemapService.php`

**Context:**

```php
foreach ($terms as $term) {
            if (!is_wp_error($term) && is_object($term)) {
                $term_name = apply_filters('seopress_sitemaps_html_term_name', $term->name, $term);
                $term_url = get_term_link($term);
                
                if (!is_wp_error($term_url)) {
```

### seopress_sitemaps_html_terms_output
**File:** `wp-seopress/src/Services/HTMLSitemap/HTMLSitemapService.php`

**Context:**

```php
$html .= '</ul>';
        $html .= '</div>';

        return apply_filters('seopress_sitemaps_html_terms_output', $html, $terms, $cpt_key);
    }

    private function hasPostTypeArchive($post_type) {
```

### seopress_sitemaps_html_cat_query
**File:** `wp-seopress/src/Services/HTMLSitemap/HTMLSitemapService.php`

**Context:**

```php
private function getCategories($cpt_key, $args_cat_query, $product_cat_slug) {
        if ('post' === $cpt_key) {
            $args_cat_query = apply_filters('seopress_sitemaps_html_cat_query', $args_cat_query);
            return get_categories($args_cat_query);
        } elseif ('product' === $cpt_key) {
            $args_cat_query = apply_filters('seopress_sitemaps_html_product_cat_query', $args_cat_query);
```

### seopress_sitemaps_html_product_cat_query
**File:** `wp-seopress/src/Services/HTMLSitemap/HTMLSitemapService.php`

**Context:**

```php
$args_cat_query = apply_filters('seopress_sitemaps_html_cat_query', $args_cat_query);
            return get_categories($args_cat_query);
        } elseif ('product' === $cpt_key) {
            $args_cat_query = apply_filters('seopress_sitemaps_html_product_cat_query', $args_cat_query);
            return get_terms($product_cat_slug, $args_cat_query);
        }
```

### seopress_sitemaps_html_hierarchical_terms_query
**File:** `wp-seopress/src/Services/HTMLSitemap/HTMLSitemapService.php`

**Context:**

```php
$args_cat_query = apply_filters('seopress_sitemaps_html_product_cat_query', $args_cat_query);
            return get_terms($product_cat_slug, $args_cat_query);
        }

        return apply_filters('seopress_sitemaps_html_hierarchical_terms_query', $cpt_key, $args_cat_query);
    }

    private function renderHierarchicalSitemap($cats, $cpt_key, $args, $product_cat_slug) {
```

### seopress_sitemaps_html_hierarchical_tax_query
**File:** `wp-seopress/src/Services/HTMLSitemap/HTMLSitemapService.php`

**Context:**

```php
}

                if ('post' !== $cpt_key && 'product' !== $cpt_key) {
                    $args['tax_query'] = apply_filters('seopress_sitemaps_html_hierarchical_tax_query', $cpt_key, $cat, $args);
                }

                $html .= $this->renderFlatSitemap($cpt_key, $args);
```

### seopress_sitemaps_html_query
**File:** `wp-seopress/src/Services/HTMLSitemap/HTMLSitemapTemplate.php`

**Context:**

```php
}

    public function render($cpt_key, $args) {
        $args = apply_filters('seopress_sitemaps_html_query', $args, $cpt_key);
        $html = '';

        if (is_post_type_hierarchical($cpt_key)) {
```

### seopress_sitemaps_html_pages_query
**File:** `wp-seopress/src/Services/HTMLSitemap/HTMLSitemapTemplate.php`

**Context:**

```php
'sort_order'  => $this->sitemapOption->getHtmlOrder(),
                'sort_column' => $this->sitemapOption->getHtmlOrderBy(),
            ];

            $args2 = apply_filters('seopress_sitemaps_html_pages_query', $args2, $cpt_key);
            $postslist = get_pages($args2);
        } else {
            $postslist = get_posts($args);
```

### seopress_sitemaps_html_pages_depth_query
**File:** `wp-seopress/src/Services/HTMLSitemap/HTMLSitemapTemplate.php`

**Context:**

```php
private function renderHierarchicalPosts($postslist) {
        $walker_page = new \Walker_Page();
        $html = '<ul class="sp-list-posts sp-cpt-hierarchical">';

        $depth = apply_filters('seopress_sitemaps_html_pages_depth_query', 0);
        $html .= $walker_page->walk($postslist, $depth);
        $html .= '</ul>';
```

### seopress_sitemaps_html_post_title
**File:** `wp-seopress/src/Services/HTMLSitemap/HTMLSitemapTemplate.php`

**Context:**

```php
}
                }
            }

            $post_title = apply_filters('seopress_sitemaps_html_post_title', get_the_title($post));

            $html .= '<li>';
            $html .= '<a href="' . get_permalink($post) . '">' . $post_title . '</a>';
```

### seopress_sitemaps_html_post_date
**File:** `wp-seopress/src/Services/HTMLSitemap/HTMLSitemapTemplate.php`

**Context:**

```php
$html .= '<a href="' . get_permalink($post) . '">' . $post_title . '</a>';

            if ('1' !== $this->sitemapOption->getHtmlDate()) {
                $date = apply_filters('seopress_sitemaps_html_post_date', true, $cpt_key);
                if (true === $date) {
                    $date_format = apply_filters('seopress_sitemaps_html_post_date_format', 'j F Y');
                    $html .= ' - ' . get_the_date($date_format, $post);
```

### seopress_sitemaps_html_post_date_format
**File:** `wp-seopress/src/Services/HTMLSitemap/HTMLSitemapTemplate.php`

**Context:**

```php
if ('1' !== $this->sitemapOption->getHtmlDate()) {
                $date = apply_filters('seopress_sitemaps_html_post_date', true, $cpt_key);
                if (true === $date) {
                    $date_format = apply_filters('seopress_sitemaps_html_post_date_format', 'j F Y');
                    $html .= ' - ' . get_the_date($date_format, $post);
                }
            }
```

### seopress_json_schema_generator_get_jsons
**File:** `wp-seopress/src/Services/JsonSchemaGenerator.php`

**Context:**

```php
$context['key_get_json_schema']  = $key;
            $data[$key]                      = $this->getJsonFromSchema($schema, $context, ['remove_empty'=> true]);
        }

        return apply_filters('seopress_json_schema_generator_get_jsons', $data);
    }

    /**
```

### seopress_json_schema_generator_get_jsons_encoded
**File:** `wp-seopress/src/Services/JsonSchemaGenerator.php`

**Context:**

```php
}
            $data[$key] = wp_json_encode($data[$key]);
        }

        return apply_filters('seopress_json_schema_generator_get_jsons_encoded', $data);
    }
}
```

### seopress_search_attachment_result_limit
**File:** `wp-seopress/src/Services/SearchAttachment.php`

**Context:**

```php
$filename_parts = explode('-', $filename);
        array_pop($filename_parts); // Remove the size attribute part
        $clean_filename = implode('-', $filename_parts);
        
        $limit   = apply_filters('seopress_search_attachment_result_limit', 50);
        if($limit > 200){
            $limit = 200;
        }
```

### seopress_search_url_result_limit
**File:** `wp-seopress/src/Services/SearchUrl.php`

**Context:**

```php
{
    public function searchByPostName($value) {
        global $wpdb;

        $limit   = apply_filters('seopress_search_url_result_limit', 50);
        if($limit > 200){
            $limit = 200;
        }
```

### seopress_sitemaps_headers
**File:** `wp-seopress/src/Services/Sitemap/Headers.php`

**Context:**

```php
*/
    public function printHeaders() {
        $headers = ['Content-type' => 'text/xml', 'x-robots-tag' => 'noindex, follow'];
        $headers = apply_filters('seopress_sitemaps_headers', $headers);
        if (empty($headers)) {
            return;
        }
```

### seopress_sitemaps_xml_single
**File:** `wp-seopress/src/Services/Sitemap/Render/Single.php`

**Context:**

```php
include_once SEOPRESS_TEMPLATE_SITEMAP_DIR . '/single.php';
        $xml = ob_get_contents();
        ob_end_clean();

        echo apply_filters('seopress_sitemaps_xml_single', $xml);
    }
}
```

### seopress_post_types
**File:** `wp-seopress/src/Services/WordPressData.php`

**Context:**

```php
$post_types['bricks_template']
            );
        }

        $post_types = apply_filters( 'seopress_post_types', $post_types, $return_all, $args );

        return $post_types;
    }
```

### seopress_get_taxonomies_args
**File:** `wp-seopress/src/Services/WordPressData.php`

**Context:**

```php
'show_ui' => true,
            'public'  => true,
        ];
        $args = apply_filters('seopress_get_taxonomies_args', $args);

        $output     = 'objects'; // or objects
        $operator   = 'and'; // 'and' or 'or'
```

### seopress_get_taxonomies_list
**File:** `wp-seopress/src/Services/WordPressData.php`

**Context:**

```php
$taxonomies['template_bundle']
            );
        }

        $taxonomies = apply_filters( 'seopress_get_taxonomies_list', $taxonomies, $return_all );

        if ( ! $with_terms) {
            return $taxonomies;
```

### seopress_get_tag_archive_title_value
**File:** `wp-seopress/src/Tags/ArchiveTitle.php`

**Context:**

```php
public function getValue($args = null) {
        $context = isset($args[0]) ? $args[0] : null;
        $value   = get_the_archive_title();

        return apply_filters('seopress_get_tag_archive_title_value', $value, $context);
    }
}
```

### seopress_get_tag_author_bio_value
**File:** `wp-seopress/src/Tags/AuthorBio.php`

**Context:**

```php
}

        $value = esc_attr(stripslashes_deep(wp_filter_nohtml_kses(wp_strip_all_tags(strip_shortcodes($value)))));

        return apply_filters('seopress_get_tag_author_bio_value', $value, $context);
    }
}
```

### seopress_get_tag_author_first_name_value
**File:** `wp-seopress/src/Tags/AuthorFirstName.php`

**Context:**

```php
}

        $value = esc_attr($value);

        return apply_filters('seopress_get_tag_author_first_name_value', $value, $context);
    }
}
```

### seopress_get_tag_author_last_name_value
**File:** `wp-seopress/src/Tags/AuthorLastName.php`

**Context:**

```php
}

        $value = esc_attr($value);

        return apply_filters('seopress_get_tag_author_last_name_value', $value, $context);
    }
}
```

### seopress_get_tag_author_nickname_value
**File:** `wp-seopress/src/Tags/AuthorNickname.php`

**Context:**

```php
}

        $value = esc_attr($value);

        return apply_filters('seopress_get_tag_author_nickname_value', $value, $context);
    }
}
```

### seopress_get_tag_author_url_value
**File:** `wp-seopress/src/Tags/AuthorUrl.php`

**Context:**

```php
if ($context['is_author'] && is_int(get_queried_object_id()) && empty($value)) {
            $value = get_author_posts_url(get_queried_object_id());
        }

        return apply_filters('seopress_get_tag_author_url_value', $value, $context);
    }
}
```

### seopress_get_tag_author_website_value
**File:** `wp-seopress/src/Tags/AuthorWebsite.php`

**Context:**

```php
}

        $value = esc_attr($value);

        return apply_filters('seopress_get_tag_author_website_value', $value, $context);
    }
}
```

### seopress_get_tag_category_description_value
**File:** `wp-seopress/src/Tags/CategoryDescription.php`

**Context:**

```php
wp_filter_nohtml_kses($value)
            ), seopress_get_service('TagsToString')->getExcerptLengthForTags()
        );

        return apply_filters('seopress_get_tag_category_description_value', $value, $context);
    }
}
```

### seopress_get_tag_category_title_value
**File:** `wp-seopress/src/Tags/CategoryTitle.php`

**Context:**

```php
} else {
            $value = single_cat_title('', false);
        }

        return apply_filters('seopress_get_tag_category_title_value', $value, $context);
    }
}
```

### seopress_get_tag_current_pagination_value
**File:** `wp-seopress/src/Tags/CurrentPagination.php`

**Context:**

```php
* Please use seopress_get_tag_current_pagination_value
         */
        $value = apply_filters('seopress_paged', $value);

        return apply_filters('seopress_get_tag_current_pagination_value', $value, $context);
    }
}
```

### seopress_get_tag_cpt_plural_value
**File:** `wp-seopress/src/Tags/CustomPostTypePlural.php`

**Context:**

```php
public function getValue($args = null) {
        $context = isset($args[0]) ? $args[0] : null;
        $value   = post_type_archive_title('', false);

        return apply_filters('seopress_get_tag_cpt_plural_value', $value, $context);
    }
}
```

### seopress_get_tag_archive_date_day_value
**File:** `wp-seopress/src/Tags/Date/ArchiveDateDay.php`

**Context:**

```php
public function getValue($args = null) {
        $context = isset($args[0]) ? $args[0] : null;
        $value   = get_query_var('day');

        return apply_filters('seopress_get_tag_archive_date_day_value', $value, $context);
    }
}
```

### seopress_get_tag_archive_date_month_name_value
**File:** `wp-seopress/src/Tags/Date/ArchiveDateMonthName.php`

**Context:**

```php
$date   = DateTime::createFromFormat('!m', $value);

            $value = esc_attr(wp_strip_all_tags(($date->format('F'))));

            return apply_filters('seopress_get_tag_archive_date_month_name_value', $value, $context);
        } catch (\Exception $e) {
            return apply_filters('seopress_get_tag_archive_date_month_name_value', '', $context);
        }
```

### seopress_get_tag_archive_date_month_value
**File:** `wp-seopress/src/Tags/Date/ArchiveDateMonth.php`

**Context:**

```php
public function getValue($args = null) {
        $context = isset($args[0]) ? $args[0] : null;
        $value   = get_query_var('monthnum');

        return apply_filters('seopress_get_tag_archive_date_month_value', $value, $context);
    }
}
```

### seopress_get_tag_archive_date_value
**File:** `wp-seopress/src/Tags/Date/ArchiveDate.php`

**Context:**

```php
public function getValue($args = null) {
        $context = isset($args[0]) ? $args[0] : null;
        $value   = sprintf('%s - %s', get_query_var('monthnum'), get_query_var('year'));

        return apply_filters('seopress_get_tag_archive_date_value', $value, $context);
    }
}
```

### seopress_get_tag_archive_date_year_value
**File:** `wp-seopress/src/Tags/Date/ArchiveDateYear.php`

**Context:**

```php
public function getValue($args = null) {
        $context = isset($args[0]) ? $args[0] : null;
        $value   = get_query_var('year');

        return apply_filters('seopress_get_tag_archive_date_year_value', $value, $context);
    }
}
```

### seopress_get_tag_post_date_value
**File:** `wp-seopress/src/Tags/Date/PostDate.php`

**Context:**

```php
if (isset($context['post'])) {
            $value = get_the_date(get_option('date_format'), $context['post']->ID);
        }

        return apply_filters('seopress_get_tag_post_date_value', $value, $context);
    }
}
```

### seopress_get_tag_post_modified_date_value
**File:** `wp-seopress/src/Tags/Date/PostModifiedDate.php`

**Context:**

```php
if (isset($context['post'])) {
            $value = get_the_modified_date(get_option('date_format'), $context['post']->ID);
        }

        return apply_filters('seopress_get_tag_post_modified_date_value', $value, $context);
    }
}
```

### seopress_get_tag_page_value
**File:** `wp-seopress/src/Tags/Page.php`

**Context:**

```php
*/
            $value = apply_filters('seopress_context_paged', $value);
        }

        return apply_filters('seopress_get_tag_page_value', $value, $context);
    }
}
```

### seopress_get_tag_post_author_value
**File:** `wp-seopress/src/Tags/PostAuthor.php`

**Context:**

```php
$value = esc_attr($user_info->display_name);
            }
        }

        return apply_filters('seopress_get_tag_post_author_value', $value, $context);
    }
}
```

### seopress_get_tag_post_category_value
**File:** `wp-seopress/src/Tags/PostCategory.php`

**Context:**

```php
*/
            $value               = apply_filters('seopress_titles_cat', $value);
        }

        return apply_filters('seopress_get_tag_post_category_value', $value, $context);
    }
}
```

### seopress_get_tag_post_content_value
**File:** `wp-seopress/src/Tags/PostContent.php`

**Context:**

```php
)
            ), seopress_get_service('TagsToString')->getExcerptLengthForTags()
        );

        return apply_filters('seopress_get_tag_post_content_value', $value, $context);
    }
}
```

### seopress_get_tag_post_excerpt_value
**File:** `wp-seopress/src/Tags/PostExcerpt.php`

**Context:**

```php
)
            ), seopress_get_service('TagsToString')->getExcerptLengthForTags()
        );

        return apply_filters('seopress_get_tag_post_excerpt_value', $value, $context);
    }
}
```

### seopress_get_tag_post_tag_value
**File:** `wp-seopress/src/Tags/PostTag.php`

**Context:**

```php
*/
            $value               = apply_filters('seopress_titles_tag', $value);
        }

        return apply_filters('seopress_get_tag_post_tag_value', $value, $context);
    }
}
```

### seopress_get_tag_post_thumbnail_url_height_value
**File:** `wp-seopress/src/Tags/PostThumbnailUrlHeight.php`

**Context:**

```php
$value = $size[2];
            }
        }

        return apply_filters('seopress_get_tag_post_thumbnail_url_height_value', $value, $context);
    }
}
```

### seopress_get_tag_post_thumbnail_url_value
**File:** `wp-seopress/src/Tags/PostThumbnailUrl.php`

**Context:**

```php
*/
            $value = apply_filters('seopress_titles_post_thumbnail_url', $value);
        }

        return apply_filters('seopress_get_tag_post_thumbnail_url_value', $value, $context);
    }
}
```

### seopress_get_tag_post_thumbnail_url_width_value
**File:** `wp-seopress/src/Tags/PostThumbnailUrlWidth.php`

**Context:**

```php
$value = $size[1];
            }
        }

        return apply_filters('seopress_get_tag_post_thumbnail_url_width_value', $value, $context);
    }
}
```

### seopress_get_tag_post_title_value
**File:** `wp-seopress/src/Tags/PostTitle.php`

**Context:**

```php
$value = str_replace('<br>', ' ', $value);
            $value = esc_attr(strip_tags($value));
        }

        return apply_filters('seopress_get_tag_post_title_value', $value, $context);
    }
}
```

### seopress_get_tag_post_url_value
**File:** `wp-seopress/src/Tags/PostUrl.php`

**Context:**

```php
*/
            $value = apply_filters('seopress_titles_post_url', $value);
        }

        return apply_filters('seopress_get_tag_post_url_value', $value, $context);
    }
}
```

### seopress_get_tag_schema_post_date_value
**File:** `wp-seopress/src/Tags/Schema/Date/PostDate.php`

**Context:**

```php
if (isset($context['post'])) {
            $value = get_the_date('c', $context['post']->ID);
        }

        return apply_filters('seopress_get_tag_schema_post_date_value', $value, $context);
    }
}
```

### seopress_get_tag_schema_post_modified_date_value
**File:** `wp-seopress/src/Tags/Schema/Date/PostModifiedDate.php`

**Context:**

```php
if (isset($context['post'])) {
            $value = get_the_modified_date('c', $context['post']->ID);
        }

        return apply_filters('seopress_get_tag_schema_post_modified_date_value', $value, $context);
    }
}
```

### seopress_get_tag_schema_knowledge_type
**File:** `wp-seopress/src/Tags/Schema/KnowledgeType.php`

**Context:**

```php
if (empty($value)) {
            $value = 'Organization';
        }

        return apply_filters('seopress_get_tag_schema_knowledge_type', $value, $context);
    }
}
```

### seopress_get_tag_schema_site_alternate_name
**File:** `wp-seopress/src/Tags/Schema/SiteAlternateName.php`

**Context:**

```php
$context = isset($args[0]) ? $args[0] : null;

        $value   = !empty(seopress_get_service('TitleOption')->getHomeSiteTitleAlt()) ? seopress_get_service('TitleOption')->getHomeSiteTitleAlt() : get_bloginfo('name');

        return apply_filters('seopress_get_tag_schema_site_alternate_name', $value, $context);
    }
}
```

### seopress_get_tag_site_url_value
**File:** `wp-seopress/src/Tags/Schema/SiteUrl.php`

**Context:**

```php
public function getValue($args = null) {
        $value = site_url();

        return apply_filters('seopress_get_tag_site_url_value', $value);
    }
}
```

### seopress_get_tag_schema_social_account_extra
**File:** `wp-seopress/src/Tags/Schema/SocialAccount/Extra.php`

**Context:**

```php
$context = isset($args[0]) ? $args[0] : null;

        $value = seopress_get_service('SocialOption')->getSocialAccountsExtra();

        return apply_filters('seopress_get_tag_schema_social_account_extra', $value, $context);
    }
}
```

### seopress_get_tag_schema_social_account_facebook
**File:** `wp-seopress/src/Tags/Schema/SocialAccount/Facebook.php`

**Context:**

```php
$context = isset($args[0]) ? $args[0] : null;

        $value   = seopress_get_service('SocialOption')->getSocialAccountsFacebook();

        return apply_filters('seopress_get_tag_schema_social_account_facebook', $value, $context);
    }
}
```

### seopress_get_tag_schema_social_account_instagram
**File:** `wp-seopress/src/Tags/Schema/SocialAccount/Instagram.php`

**Context:**

```php
$context = isset($args[0]) ? $args[0] : null;

        $value   = seopress_get_service('SocialOption')->getSocialAccountsInstagram();

        return apply_filters('seopress_get_tag_schema_social_account_instagram', $value, $context);
    }
}
```

### seopress_get_tag_schema_social_account_linkedin
**File:** `wp-seopress/src/Tags/Schema/SocialAccount/Linkedin.php`

**Context:**

```php
$context = isset($args[0]) ? $args[0] : null;

        $value   = seopress_get_service('SocialOption')->getSocialAccountsLinkedin();

        return apply_filters('seopress_get_tag_schema_social_account_linkedin', $value, $context);
    }
}
```

### seopress_get_tag_schema_social_account_pinterest
**File:** `wp-seopress/src/Tags/Schema/SocialAccount/Pinterest.php`

**Context:**

```php
$context = isset($args[0]) ? $args[0] : null;

        $value   = seopress_get_service('SocialOption')->getSocialAccountsPinterest();

        return apply_filters('seopress_get_tag_schema_social_account_pinterest', $value, $context);
    }
}
```

### seopress_get_tag_schema_social_account_twitter
**File:** `wp-seopress/src/Tags/Schema/SocialAccount/Twitter.php`

**Context:**

```php
if ( ! empty($value)) {
            $value = sprintf('https://twitter.com/%s', $value);
        }

        return apply_filters('seopress_get_tag_schema_social_account_twitter', $value, $context);
    }
}
```

### seopress_get_tag_schema_social_account_youtube
**File:** `wp-seopress/src/Tags/Schema/SocialAccount/Youtube.php`

**Context:**

```php
$context = isset($args[0]) ? $args[0] : null;

        $value   = seopress_get_service('SocialOption')->getSocialAccountsYoutube();

        return apply_filters('seopress_get_tag_schema_social_account_youtube', $value, $context);
    }
}
```

### seopress_get_tag_schema_social_knowledge_contact_option
**File:** `wp-seopress/src/Tags/Schema/SocialKnowledgeContactOption.php`

**Context:**

```php
if ('None' === $value) {
            $value = '';
        }

        return apply_filters('seopress_get_tag_schema_social_knowledge_contact_option', $value, $context);
    }
}
```

### seopress_get_tag_schema_social_knowledge_contact_type
**File:** `wp-seopress/src/Tags/Schema/SocialKnowledgeContactType.php`

**Context:**

```php
$context = isset($args[0]) ? $args[0] : null;

        $value   = seopress_get_service('SocialOption')->getSocialKnowledgeContactType();

        return apply_filters('seopress_get_tag_schema_social_knowledge_contact_type', $value, $context);
    }
}
```

### seopress_get_tag_schema_organization_description
**File:** `wp-seopress/src/Tags/Schema/SocialKnowledgeDescription.php`

**Context:**

```php
$context = isset($args[0]) ? $args[0] : null;

        $value   = !empty(seopress_get_service('SocialOption')->getSocialKnowledgeDesc()) ? seopress_get_service('SocialOption')->getSocialKnowledgeDesc() : get_bloginfo('tagline');

        return apply_filters('seopress_get_tag_schema_organization_description', $value, $context);
    }
}
```

### seopress_get_tag_schema_organization_email
**File:** `wp-seopress/src/Tags/Schema/SocialKnowledgeEmail.php`

**Context:**

```php
$context = isset($args[0]) ? $args[0] : null;

        $value   = seopress_get_service('SocialOption')->getSocialKnowledgeEmail();

        return apply_filters('seopress_get_tag_schema_organization_email', $value, $context);
    }
}
```

### seopress_get_tag_schema_social_knowledge_image
**File:** `wp-seopress/src/Tags/Schema/SocialKnowledgeImage.php`

**Context:**

```php
$context = isset($args[0]) ? $args[0] : null;

        $value   = seopress_get_service('SocialOption')->getSocialKnowledgeImage();

        return apply_filters('seopress_get_tag_schema_social_knowledge_image', $value, $context);
    }
}
```

### seopress_get_tag_schema_social_knowledge_name
**File:** `wp-seopress/src/Tags/Schema/SocialKnowledgeName.php`

**Context:**

```php
if (empty($value) && 'none' !== $type) {
            $value = get_bloginfo('name');
        }

        return apply_filters('seopress_get_tag_schema_social_knowledge_name', $value, $context);
    }
}
```

### seopress_get_tag_schema_organization_tax_id
**File:** `wp-seopress/src/Tags/Schema/SocialKnowledgeTaxId.php`

**Context:**

```php
$context = isset($args[0]) ? $args[0] : null;

        $value   = seopress_get_service('SocialOption')->getSocialKnowledgeTaxID();

        return apply_filters('seopress_get_tag_schema_organization_tax_id', $value, $context);
    }
}
```

### seopress_get_tag_schema_social_phone_number
**File:** `wp-seopress/src/Tags/Schema/SocialPhoneNumber.php`

**Context:**

```php
$context = isset($args[0]) ? $args[0] : null;

        $value   = seopress_get_service('SocialOption')->getSocialKnowledgePhone();

        return apply_filters('seopress_get_tag_schema_social_phone_number', $value, $context);
    }
}
```

### seopress_get_tag_search_keywords_value
**File:** `wp-seopress/src/Tags/SearchKeywords.php`

**Context:**

```php
* Please use seopress_get_tag_search_keywords_value
         */
        $value = apply_filters('seopress_get_search_query', $value);

        return apply_filters('seopress_get_tag_search_keywords_value', $value, $context);
    }
}
```

### seopress_get_tag_separator_value
**File:** `wp-seopress/src/Tags/Separator.php`

**Context:**

```php
if (empty($separator)) {
            $separator = self::DEFAULT_SEPARATOR;
        }

        return apply_filters('seopress_get_tag_separator_value', $separator, $context);
    }
}
```

### seopress_get_tag_tag_description_value
**File:** `wp-seopress/src/Tags/TagDescription.php`

**Context:**

```php
wp_filter_nohtml_kses($value)
            ), seopress_get_service('TagsToString')->getExcerptLengthForTags()
        );

        return apply_filters('seopress_get_tag_tag_description_value', $value, $context);
    }
}
```

### seopress_get_tag_tag_title_value
**File:** `wp-seopress/src/Tags/TagTitle.php`

**Context:**

```php
} else {
            $value   = single_tag_title('', false);
        }

        return apply_filters('seopress_get_tag_tag_title_value', $value, $context);
    }
}
```

### seopress_get_tag_target_keyword_value
**File:** `wp-seopress/src/Tags/TargetKeyword.php`

**Context:**

```php
if (isset($context['post']->ID)) {
            $value = get_post_meta($context['post']->ID, '_seopress_analysis_target_kw', true);
        }

        return apply_filters('seopress_get_tag_target_keyword_value', $value, $context);
    }
}
```

### seopress_get_tag_term_description_value
**File:** `wp-seopress/src/Tags/TermDescription.php`

**Context:**

```php
wp_filter_nohtml_kses($value)
            ), seopress_get_service('TagsToString')->getExcerptLengthForTags()
        );

        return apply_filters('seopress_get_tag_term_description_value', $value, $context);
    }
}
```

### seopress_get_tag_term_title_value
**File:** `wp-seopress/src/Tags/TermTitle.php`

**Context:**

```php
} else {
            $value   = single_term_title('', false);
        }

        return apply_filters('seopress_get_tag_term_title_value', $value, $context);
    }
}
```

### seopress_get_tag_wc_get_price_value
**File:** `wp-seopress/src/Tags/WooCommerce/GetPrice.php`

**Context:**

```php
$product    = wc_get_product($context['post']->ID);
            $value      = $product->get_price();
        }

        return apply_filters('seopress_get_tag_wc_get_price_value', $value, $context);
    }
}
```

### seopress_get_tag_wc_price_valid_date
**File:** `wp-seopress/src/Tags/WooCommerce/PriceValidDate.php`

**Context:**

```php
$value      = $date->date('m-d-Y');
            }
        }

        return apply_filters('seopress_get_tag_wc_price_valid_date', $value, $context);
    }
}
```

### seopress_get_tag_wc_single_cat_value
**File:** `wp-seopress/src/Tags/WooCommerce/SingleCategory.php`

**Context:**

```php
$value = stripslashes_deep(wp_filter_nohtml_kses(join(', ', $wooSingleCat)));
            }
        }

        return apply_filters('seopress_get_tag_wc_single_cat_value', $value, $context);
    }
}
```

### seopress_get_tag_wc_single_price_exc_tax_value
**File:** `wp-seopress/src/Tags/WooCommerce/SinglePriceExcludeTax.php`

**Context:**

```php
$product          = wc_get_product($context['post']->ID);
            $value            = wc_get_price_excluding_tax($product);
        }

        return apply_filters('seopress_get_tag_wc_single_price_exc_tax_value', $value, $context);
    }
}
```

### seopress_get_tag_wc_single_price_value
**File:** `wp-seopress/src/Tags/WooCommerce/SinglePrice.php`

**Context:**

```php
$product          = wc_get_product($context['post']->ID);
            $value            = wc_get_price_including_tax($product);
        }

        return apply_filters('seopress_get_tag_wc_single_price_value', $value, $context);
    }
}
```

### seopress_get_tag_wc_single_tag_value
**File:** `wp-seopress/src/Tags/WooCommerce/SingleTag.php`

**Context:**

```php
$value = stripslashes_deep(wp_filter_nohtml_kses(join(', ', $singleTag)));
            }
        }

        return apply_filters('seopress_get_tag_wc_single_tag_value', $value, $context);
    }
}
```

### seopress_get_tag_wc_sku_value
**File:** `wp-seopress/src/Tags/WooCommerce/Sku.php`

**Context:**

```php
$product          = wc_get_product($context['post']->ID);
            $value            = $product->get_sku();
        }

        return apply_filters('seopress_get_tag_wc_sku_value', $value, $context);
    }
}
```

### seopress_gtag_ec_add_to_cart_archive_ev
**File:** `wp-seopress/src/Thirds/WooCommerce/WooCommerceAnalyticsService.php`

**Context:**

```php
});
        </script>
        ';
        $js = apply_filters('seopress_gtag_ec_add_to_cart_archive_ev', $js);

        echo $js;
    }
```

### seopress_gtag_ec_add_to_cart_single_ev
**File:** `wp-seopress/src/Thirds/WooCommerce/WooCommerceAnalyticsService.php`

**Context:**

```php
});
        </script>
        ";

        $js = apply_filters('seopress_gtag_ec_add_to_cart_single_ev', $js);

        echo $js;
    }
```

### seopress_gtag_ec_remove_from_cart_ev
**File:** `wp-seopress/src/Thirds/WooCommerce/WooCommerceAnalyticsService.php`

**Context:**

```php
</script>
            ';
        }

        $sprintf = apply_filters('seopress_gtag_ec_remove_from_cart_ev', $sprintf);

        return $sprintf;
    }
```

### seopress_gtag_ec_remove_from_cart_checkout_ev
**File:** `wp-seopress/src/Thirds/WooCommerce/WooCommerceAnalyticsService.php`

**Context:**

```php
});
        </script>';

        $js = apply_filters('seopress_gtag_ec_remove_from_cart_checkout_ev', $js, $final);

        echo $js;
    }
```

### seopress_gtag_ec_single_view_details_ev
**File:** `wp-seopress/src/Thirds/WooCommerce/WooCommerceAnalyticsService.php`

**Context:**

```php
});
        </script>
        ";

        $js = apply_filters('seopress_gtag_ec_single_view_details_ev', $js);

        echo $js;
    }
```

### seopress_sitemaps_max_posts_per_sitemap
**File:** `wp-seopress/templates/sitemap/single.php`

**Context:**

```php
//Max posts per paginated sitemap
$max = 1000;
$max = apply_filters('seopress_sitemaps_max_posts_per_sitemap', $max);

if (isset($offset) && absint($offset) && '' != $offset && 0 != $offset) {
	$offset = (($offset - 1) * $max);
```

## Actions (22)

### seopress_tools_before
**File:** `wp-seopress/inc/admin/admin-pages/Tools.php`

**Context:**

```php
<?php do_action('seopress_tools_before', $current_tab, $docs); ?>
        <div class="seopress-tab <?php if ('tab_seopress_tool_settings' == $current_tab) {
        echo 'active';
    } ?>" id="tab_seopress_tool_settings">
```

### seopress_tools_migration
**File:** `wp-seopress/inc/admin/admin-pages/Tools.php`

**Context:**

```php
<?php do_action('seopress_tools_migration', $current_tab); ?>
        <div class="seopress-tab <?php if ('tab_seopress_tool_reset' == $current_tab) {
        echo 'active';
    } ?>" id="tab_seopress_tool_reset">
```

### seopress_dashboard_insights
**File:** `wp-seopress/inc/admin/blocks/insights.php`

**Context:**

```php
<?php
    defined('ABSPATH') or exit('Please don&rsquo;t call the plugin directly. Thanks :)');

    do_action('seopress_dashboard_insights', $current_tab);
```

### seopress_ca_tab_after
**File:** `wp-seopress/inc/admin/metaboxes/admin-metaboxes-content-analysis-form.php`

**Context:**

```php
<?php do_action('seopress_ca_tab_after', $data_attr['current_id']); ?>
</div>
```

### seopress_titles_title_tab_before
**File:** `wp-seopress/inc/admin/metaboxes/admin-metaboxes-form.php`

**Context:**

```php
<?php do_action('seopress_titles_title_tab_before', $pagenow); ?>
							<p>
								<span class="seopress-d-flex seopress-mb-1">
									<label for="seopress_titles_title_meta">
										<?php
											esc_html_e('Title', 'wp-seopress');
											echo seopress_tooltip(esc_html__('Meta title', 'wp-seopress'), esc_html__('Titles are critical to give users a quick insight into the content of a result and why it’s relevant to their query. It\'s often the primary piece of information used to decide which result to click on, so it\'s important to use high-quality titles on your web pages.', 'wp-seopress'), esc_html('<title>My super title</title>'));
										?>
```

### seopress_titles_title_input_before
**File:** `wp-seopress/inc/admin/metaboxes/admin-metaboxes-form.php`

**Context:**

```php
<?php do_action('seopress_titles_title_input_before', $pagenow); ?>
								</span>

								<input id="seopress_titles_title_meta" type="text" name="seopress_titles_title"
									class="components-text-control__input"
									placeholder="<?php esc_html_e('Enter your title', 'wp-seopress'); ?>"
```

### seopress_titles_meta_desc_input_before
**File:** `wp-seopress/inc/admin/metaboxes/admin-metaboxes-form.php`

**Context:**

```php
<?php do_action('seopress_titles_meta_desc_input_before', $pagenow); ?>
								</span>
								<textarea id="seopress_titles_desc_meta" rows="4" name="seopress_titles_desc"
									class="components-text-control__textarea"
									placeholder="<?php esc_html_e('Enter your meta description', 'wp-seopress'); ?>"
```

### seopress_titles_title_tab_after
**File:** `wp-seopress/inc/admin/metaboxes/admin-metaboxes-form.php`

**Context:**

```php
<?php if (('post' == $typenow || 'product' == $typenow) && ('post.php' == $pagenow || 'post-new.php' == $pagenow)) {
							seopress_primary_category_select();
						}

						do_action('seopress_titles_title_tab_after', $pagenow, $data_attr);
						?>
```

### seopress_seo_metabox_after_content
**File:** `wp-seopress/inc/admin/metaboxes/admin-metaboxes-form.php`

**Context:**

```php
</p>
					</div>
					<?php }
					do_action('seopress_seo_metabox_after_content', $typenow, $pagenow, $data_attr, $seo_tabs);
					?>
```

### seopress_seo_metabox_save
**File:** `wp-seopress/inc/admin/metaboxes/admin-metaboxes.php`

**Context:**

```php
update_post_meta($post_id, '_elementor_page_settings', $elementor);
				}
			}

			do_action('seopress_seo_metabox_save', $post_id, $seo_tabs);
		}
	}
}
```

### seopress/page-builders/elementor/save_meta
**File:** `wp-seopress/inc/admin/metaboxes/admin-metaboxes.php`

**Context:**

```php
add_action('save_post', 'seopress_update_elementor_fields', 999, 2);
	function seopress_update_elementor_fields($post_id, $post)
	{
		do_action('seopress/page-builders/elementor/save_meta', $post_id);
	}
}
```

### seopress_seo_metabox_term_save
**File:** `wp-seopress/inc/admin/metaboxes/admin-term-metaboxes.php`

**Context:**

```php
delete_term_meta($term_id, '_seopress_redirections_enabled', '');
            }
        }

        do_action('seopress_seo_metabox_term_save', $term_id, $_POST);
    }
}
```

### seopress_clarity_html
**File:** `wp-seopress/inc/functions/options-clarity.php`

**Context:**

```php
function seopress_clarity_js_arguments() {
	$echo = true;
	do_action('seopress_clarity_html', $echo);
}
```

### seopress_google_analytics_html
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
function seopress_google_analytics_js_arguments() {
    $echo = true;
    do_action('seopress_google_analytics_html', $echo);
}

function seopress_custom_tracking_hook() {
```

### seopress_custom_body_tracking_html
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
function seopress_custom_tracking_body_hook() {
    $echo = true;
    do_action('seopress_custom_body_tracking_html', $echo);
}

//Build custom code before body tag closing
```

### seopress_custom_footer_tracking_html
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
function seopress_custom_tracking_footer_hook() {
    $echo = true;
    do_action('seopress_custom_footer_tracking_html', $echo);
}

//Build custom code in head
```

### seopress_custom_head_tracking_html
**File:** `wp-seopress/inc/functions/options-google-analytics.php`

**Context:**

```php
function seopress_custom_tracking_head_hook() {
    $echo = true;
    do_action('seopress_custom_head_tracking_html', $echo);
}
```

### seopress_matomo_html
**File:** `wp-seopress/inc/functions/options-matomo.php`

**Context:**

```php
function seopress_matomo_js_arguments() {
	$echo = true;
	do_action('seopress_matomo_html', $echo);
}

function seopress_matomo_nojs() {
```

### seopress_matomo_body_html
**File:** `wp-seopress/inc/functions/options-matomo.php`

**Context:**

```php
function seopress_matomo_nojs() {
	$echo = true;
	do_action('seopress_matomo_body_html', $echo);
}

add_action('seopress_matomo_body_html', 'seopress_matomo_body_js', 10, 1);
```

### wpml_switch_language
**File:** `wp-seopress/inc/functions/options-titles-metas.php`

**Context:**

```php
if ($transl_status != 1) { 
					$my_default_lang = apply_filters('wpml_default_language', NULL );
					$my_current_lang = apply_filters( 'wpml_current_language', NULL );
					do_action( 'wpml_switch_language', $my_default_lang );
				}
			}
```

### seopress_third_importer_aio
**File:** `wp-seopress/src/Actions/Admin/Importer/AIO.php`

**Context:**

```php
$data['count'] = $offset;
		}
		$data['offset'] = $offset;

		do_action('seopress_third_importer_aio', $offset, $increment);

		wp_send_json_success($data);
		exit();
```

### seopress_third_importer_rank_math
**File:** `wp-seopress/src/Actions/Admin/Importer/RankMath.php`

**Context:**

```php
}

        $data['offset'] = $offset;

        do_action('seopress_third_importer_rank_math', $offset, $increment);

        wp_send_json_success($data);
        exit();
```

