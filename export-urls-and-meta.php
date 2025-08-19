<?php
/*
Plugin Name: Export URLs and Meta
Plugin URI: https://github.com/devjusty/export-urls-and-meta
Description: Plugin to export SEO titles, URLs, and meta descriptions to a CSV.
Version: 0.0.12
Author: Justin Thompson
Requires PHP: 7.0
Tested up to: 6.7.2
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain: export-urls-and-meta
*/

/**
 * Register uninstall hook to delete stored settings
 */
register_uninstall_hook(__FILE__, 'eum_on_uninstall');
function eum_on_uninstall()
{
  if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
  }
  delete_option('eum_export_settings');
}

// Exit if accessed directly
if (!defined('ABSPATH')) {
  exit;
}

/**
 * Adds an admin submenu under Tools
 */
function eum_add_admin_menu()
{
  add_submenu_page(
    'tools.php',               // Parent menu slug (Tools)
    'Export URLs and Meta',    // Page title
    'Export URLs and Meta',    // Menu title
    'manage_options',          // Capability required to access
    'export-urls-and-meta',    // Menu slug
    'eum_render_admin_page'    // Callback function to render the page
  );

  // Diagnostics page
  add_submenu_page(
    'tools.php',
    'Export URLs and Meta — Diagnostics',
    'Export URLs and Meta: Diagnostics',
    'manage_options',
    'export-urls-and-meta-diagnostics',
    'eum_render_diagnostics_page'
  );
}
add_action('admin_menu', 'eum_add_admin_menu');

// Add Plugin Settings Link to Plugins Page
function eum_add_settings_link($links)
{
  $settings_link = '<a href="tools.php?page=export-urls-and-meta">Export</a>';
  array_unshift($links, $settings_link);
  return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'eum_add_settings_link');

function eum_enqueue_admin_assets($hook)
{
  // Only load on our export page (tools_page_export-urls-and-meta)
  if ($hook !== 'tools_page_export-urls-and-meta') {
    return;
  }
  wp_enqueue_style('eum-admin-css', plugin_dir_url(__FILE__) . 'assets/css/export-urls-and-meta.css', array(), '0.0.13');
  wp_enqueue_script('eum-admin-js', plugin_dir_url(__FILE__) . 'assets/js/export-urls-and-meta.js', array('jquery'), '0.0.13', true);

  // Localize script for AJAX
  wp_localize_script('eum-admin-js', 'eum_ajax', [
    'ajax_url' => admin_url('admin-ajax.php'),
    'nonce'    => wp_create_nonce('eum_export_nonce'),
  ]);
}
add_action('admin_enqueue_scripts', 'eum_enqueue_admin_assets');

/**
 * Detect Active Seo Plugin(s)
 */
function eum_detect_active_seo_plugin()
{
  $seo_plugins = [
    'wordpress-seo/wp-seo.php' => 'Yoast SEO',
    'all-in-one-seo-pack/all_in_one_seo_pack.php'  => 'All in One SEO (v3)',
    'aioseo/aioseo.php' => 'All in One SEO',
    'autodescription/autodescription.php' => 'The SEO Framework',
    'seo-by-rank-math/rank-math.php' => 'Rank Math',
    'wp-seopress/seopress.php' => 'SEOPress',
  ];

  $active_plugins = get_option('active_plugins');
  $active_seo_plugins = [];

  foreach ($seo_plugins as $plugin_file => $plugin_name) {
    if (in_array($plugin_file, $active_plugins)) {
      $active_seo_plugins[$plugin_file] = $plugin_name;
    }
  }

  if (count($active_seo_plugins) > 1) {
    if (function_exists('eum_log')) {
      eum_log('Multiple SEO plugins detected', ['plugins' => array_values($active_seo_plugins)]);
    }
    eum_display_error_message('Multiple SEO plugins are active. Please deactivate all but one SEO plugin to ensure compatibility.');
    return false;
  }

  if (empty($active_seo_plugins)) {
    return ['plugin_file' => false, 'plugin_name' => 'None'];
  }

  $plugin_file = array_keys($active_seo_plugins)[0];
  return [
    'plugin_file' => $plugin_file,
    'plugin_name' => $active_seo_plugins[$plugin_file]
  ];
}


/**
 * Renders the admin page with export options.
 */
function eum_render_admin_page()
{
  $active_seo_plugin = eum_detect_active_seo_plugin();
  $woocommerce_active = class_exists('WooCommerce');
  $saved_settings = get_option('eum_export_settings', []);

  // Check if homepage is “latest posts”
  $front_page_id = (int) get_option('page_on_front');
  $is_latest_posts = ($front_page_id === 0);
  if ($is_latest_posts) {
?>
    <div class="notice notice-info">
      <p>Your homepage is set to display latest posts (no static front page). Do you want to include the homepage in the export?</p>
    </div>
  <?php
  }

  // Check for saved settings
  $has_page             = (!empty($saved_settings['post_types']) && in_array('page', $saved_settings['post_types'], true));
  $has_post             = (!empty($saved_settings['post_types']) && in_array('post', $saved_settings['post_types'], true));
  $has_product          = (!empty($saved_settings['post_types']) && in_array('product', $saved_settings['post_types'], true));

  $wants_homepage_latest = !empty($saved_settings['include_homepage_latest']);
  $wants_wp_categories  = !empty($saved_settings['include_wp_categories']);
  $wants_product_cats   = !empty($saved_settings['include_product_categories']);

  $saved_statuses = !empty($saved_settings['publish_status']) ? $saved_settings['publish_status'] : [];
  $wants_publish = in_array('publish', $saved_statuses, true);
  $wants_draft   = in_array('draft',   $saved_statuses, true);
  $wants_private = in_array('private', $saved_statuses, true);

  $wants_chars   = !empty($saved_settings['include_character_count']);
  ?>
  <div class="wrap eum-export-page">
    <h1>Export URLs and Meta</h1>
    <?php if ($active_seo_plugin === false) : ?>
      <div class="notice notice-error is-dismissible">
        <p>Multiple SEO plugins are active. Please deactivate all but one SEO plugin to ensure compatibility.</p>
      </div>
    <?php else : ?>
      <p>Detected SEO Plugin: <strong><?php echo esc_html($active_seo_plugin['plugin_name']); ?></strong></p>
    <?php endif; ?>

    <form id="eum-export-form" method="post" action="" class="eum-export-form">
      <input type="hidden" name="eum_export_csv" value="1">
      <?php wp_nonce_field('eum_export_nonce', 'eum_export_nonce_field'); ?>

      <h2>Post Types</h2>
      <label for="eum_post_type_page">
        <input type="checkbox" id="eum_post_type_page"
          name="eum_post_types[]" value="page"
          <?php checked($has_page); ?>>
        Pages
      </label>
      <label for="eum_post_type_post">
        <input type="checkbox" id="eum_post_type_post"
          name="eum_post_types[]" value="post"
          <?php checked($has_post); ?>>
        Posts
      </label>

      <?php if ($is_latest_posts): ?>
        <h2>Homepage (Latest Posts)</h2>
        <label for="include_homepage_latest">
          <input type="checkbox" id="include_homepage_latest"
            name="include_homepage_latest" value="1"
            <?php checked($wants_homepage_latest); ?>>
          Include homepage (root URL) in the CSV
        </label>
      <?php endif; ?>

      <h2>Include Archive Pages</h2>
      <label for="eum_include_wp_categories">
        <input type="checkbox" id="eum_include_wp_categories"
          name="eum_include_wp_categories" value="1"
          <?php checked($wants_wp_categories); ?>>
        Include Post Category Pages
      </label>

      <?php if ($woocommerce_active) : ?>
        <h2>WooCommerce</h2>
        <label for="eum_post_type_product">
          <input type="checkbox" id="eum_post_type_product"
            name="eum_post_types[]" value="product"
            <?php checked($has_product); ?>>
          Products
        </label>
        <label for="eum_include_product_categories">
          <input type="checkbox" id="eum_include_product_categories"
            name="eum_include_product_categories" value="1"
            <?php checked($wants_product_cats); ?>>
          Include Product Category Pages
        </label>
      <?php endif; ?>

      <h2>Publish Status</h2>
      <p>Select the publish status of the posts you want to export.</p>
      <label for="eum_publish_status_publish">
        <input type="checkbox" id="eum_publish_status_publish"
          name="eum_publish_status[]" value="publish"
          <?php checked($wants_publish); ?>>
        Published
      </label>
      <label for="eum_publish_status_draft">
        <input type="checkbox" id="eum_publish_status_draft"
          name="eum_publish_status[]" value="draft"
          <?php checked($wants_draft); ?>>
        Drafts
      </label>
      <label for="eum_publish_status_private">
        <input type="checkbox" id="eum_publish_status_private"
          name="eum_publish_status[]" value="private"
          <?php checked($wants_private); ?>>
        Private
      </label>

      <h2>Additional Options</h2>
      <label for="eum_character_count">
        <input type="checkbox" id="eum_character_count"
          name="eum_character_count" value="1"
          <?php checked($wants_chars); ?>>
        Add character count for titles and descriptions
      </label>

      <div class="eum-form-actions">
        <button type="submit" name="eum_export_csv" class="button button-primary">Export CSV</button>
        <button type="button" id="eum-preview-button" class="button">Preview</button>
      </div>

    </form>
    <div id="eum-preview-container" class="eum-preview-container" style="display:none;">
      <h3>Preview</h3>
      <div id="eum-preview-content"></div>
    </div>
  </div>
<?php
}

/*---------------------------------------------------------------------------
 |  AJAX HANDLERS
 *--------------------------------------------------------------------------*/

add_action('wp_ajax_eum_start_export', 'eum_ajax_start_export');
add_action('wp_ajax_eum_process_batch', 'eum_ajax_process_batch');
add_action('wp_ajax_eum_download_file', 'eum_ajax_download_file');
add_action('wp_ajax_eum_cancel_export', 'eum_ajax_cancel_export');
add_action('wp_ajax_eum_ajax_preview_export', 'eum_ajax_preview_export');

/**
 * AJAX handler to start the export process.
 */
function eum_ajax_start_export()
{
  check_ajax_referer('eum_export_nonce', 'nonce');

  parse_str($_POST['form_data'], $form_data);

  // Sanitize and validate form data
  $post_types = isset($form_data['eum_post_types']) ? array_map('sanitize_text_field', (array)$form_data['eum_post_types']) : [];
  $include_homepage = isset($form_data['include_homepage_latest']) && $form_data['include_homepage_latest'] === 'on';
  $include_categories = isset($form_data['include_wp_categories']) && $form_data['include_wp_categories'] === 'on';
  $include_product_cats = isset($form_data['include_product_categories']) && $form_data['include_product_categories'] === 'on';
  $publish_status = isset($form_data['eum_publish_status']) && is_array($form_data['eum_publish_status']) ? array_map('sanitize_text_field', $form_data['eum_publish_status']) : ['publish'];

  $items_to_process = [];

  // Get posts
  if (!empty($post_types)) {
    $post_ids = get_posts([
      'post_type' => $post_types,
      'post_status' => $publish_status,
      'numberposts' => -1,
      'fields' => 'ids',
    ]);
    foreach ($post_ids as $id) {
      $items_to_process[] = ['type' => 'post', 'id' => $id];
    }
  }

  // Get categories
  if ($include_categories) {
    $term_ids = get_terms(['taxonomy' => 'category', 'fields' => 'ids', 'hide_empty' => false]);
    foreach ($term_ids as $id) {
      $items_to_process[] = ['type' => 'term', 'id' => $id, 'taxonomy' => 'category'];
    }
  }

  // Get product categories
  if ($include_product_cats && class_exists('WooCommerce')) {
    $term_ids = get_terms(['taxonomy' => 'product_cat', 'fields' => 'ids', 'hide_empty' => false]);
    foreach ($term_ids as $id) {
      $items_to_process[] = ['type' => 'term', 'id' => $id, 'taxonomy' => 'product_cat'];
    }
  }

  // Get homepage
  if ($include_homepage && get_option('show_on_front') === 'posts') {
    $items_to_process[] = ['type' => 'homepage', 'id' => 0];
  }

  if (empty($items_to_process)) {
    wp_send_json_error(['message' => 'No items found for the selected criteria.']);
  }

  $export_id = 'eum_export_' . md5(uniqid(rand(), true));
  $export_data = [
    'items' => $items_to_process,
    'total' => count($items_to_process),
    'processed' => 0,
    'form_data' => $form_data,
  ];

  // Store data in a transient for 1 hour
  set_transient($export_id, $export_data, HOUR_IN_SECONDS);

  wp_send_json_success([
    'total_items' => $export_data['total'],
    'export_id' => $export_id,
  ]);
}

/**
 * AJAX handler to process a batch of items.
 */
function eum_ajax_process_batch()
{
  check_ajax_referer('eum_export_nonce', 'nonce');

  $export_id = sanitize_text_field($_POST['export_id']);
  $export_data = get_transient($export_id);

  if (!$export_data) {
    wp_send_json_error(['message' => 'Export session expired or invalid.']);
  }

  $batch_size = apply_filters('eum_export_batch_size', 50);
  $start = $export_data['processed'];
  $items_to_process = array_slice($export_data['items'], $start, $batch_size);

  if (empty($items_to_process)) {
    wp_send_json_success(['status' => 'complete']);
  }

  $upload_dir = wp_upload_dir();
  $file_path = $upload_dir['basedir'] . '/eum-export-' . $export_id . '.csv';

  $file_handle = fopen($file_path, 'a');
  if (!$file_handle) {
    if (!function_exists('eum_log')) {
      // fallback logging if helper not yet defined
      if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('[EUM] Failed to open export file for writing: ' . $file_path);
      }
    } else {
      eum_log('Failed to open export file for writing', ['file_path' => $file_path]);
    }
    wp_send_json_error(['message' => 'Unable to write export file. Check file permissions.']);
  }

  // Add CSV header if this is the first batch
  if ($start === 0) {
    $headers = ['Type', 'Title', 'URL', 'SEO Title', 'Meta Description'];
    if (!empty($export_data['form_data']['eum_character_count'])) {
      $headers[] = 'Title Length';
      $headers[] = 'Description Length';
    }
    fputcsv($file_handle, $headers);
  }

  foreach ($items_to_process as $item) {
    $row_data = eum_get_row_data($item, $export_data['form_data']);
    if ($row_data) {
      fputcsv($file_handle, $row_data);
    }
  }

  fclose($file_handle);

  $export_data['processed'] = $start + count($items_to_process);
  set_transient($export_id, $export_data, HOUR_IN_SECONDS);

  wp_send_json_success([
    'status' => 'processing',
    'processed' => $export_data['processed'],
    'total' => $export_data['total'],
  ]);
}

/**
 * AJAX handler to download the file and clean up.
 */
function eum_ajax_download_file()
{
  check_ajax_referer('eum_export_nonce', 'nonce');

  $export_id = sanitize_text_field($_GET['export_id']);
  $upload_dir = wp_upload_dir();
  $file_path = $upload_dir['basedir'] . '/eum-export-' . $export_id . '.csv';

  if (file_exists($file_path)) {
    $filename = eum_generate_csv_filename();

    header('Content-Description: File Transfer');
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_path));

    // Output UTF-8 BOM
    echo "\xEF\xBB\xBF";
    readfile($file_path);

    // Clean up
    unlink($file_path);
    delete_transient($export_id);
    exit;
  }

  wp_send_json_error(['message' => 'Export file not found.']);
}

/**
 * Helper function to get data for a single CSV row.
 */
/**
 * AJAX handler to cancel the export process.
 */
/**
 * AJAX handler for previewing the export.
 */
function eum_ajax_preview_export()
{
  check_ajax_referer('eum_export_nonce', 'nonce');

  // Reuse the same logic as starting an export, but limit to 10 items and don't create a file.
  parse_str($_POST['form_data'], $form_data);

  // Normalize inputs to match export
  $post_types = isset($form_data['eum_post_types']) ? array_map('sanitize_text_field', (array)$form_data['eum_post_types']) : [];
  $include_homepage = isset($form_data['include_homepage_latest']) && $form_data['include_homepage_latest'] === 'on';
  $include_categories = isset($form_data['include_wp_categories']) && $form_data['include_wp_categories'] === 'on';
  $include_product_cats = isset($form_data['include_product_categories']) && $form_data['include_product_categories'] === 'on';
  $publish_status = isset($form_data['eum_publish_status']) && is_array($form_data['eum_publish_status']) ? array_map('sanitize_text_field', $form_data['eum_publish_status']) : ['publish'];

  $items_to_process = [];

  if (!empty($post_types)) {
    $post_ids = get_posts([
      'post_type'   => $post_types,
      'post_status' => $publish_status,
      'numberposts' => 20, // small buffer before slicing to 10 below
      'fields'      => 'ids',
    ]);
    foreach ($post_ids as $id) {
      $items_to_process[] = ['type' => 'post', 'id' => $id];
    }
  }

  if ($include_categories) {
    $term_ids = get_terms(['taxonomy' => 'category', 'fields' => 'ids', 'hide_empty' => false]);
    foreach ($term_ids as $id) {
      $items_to_process[] = ['type' => 'term', 'id' => $id, 'taxonomy' => 'category'];
    }
  }

  if ($include_product_cats && class_exists('WooCommerce')) {
    $term_ids = get_terms(['taxonomy' => 'product_cat', 'fields' => 'ids', 'hide_empty' => false]);
    foreach ($term_ids as $id) {
      $items_to_process[] = ['type' => 'term', 'id' => $id, 'taxonomy' => 'product_cat'];
    }
  }

  if ($include_homepage && get_option('show_on_front') === 'posts') {
    $items_to_process[] = ['type' => 'homepage', 'id' => 0];
  }

  if (empty($items_to_process)) {
    wp_send_json_error(['message' => 'No items found for the selected criteria.']);
  }

  // Limit to 10 items for the preview
  $preview_items = array_slice($items_to_process, 0, 10);

  $preview_data = [];
  $headers = ['Type', 'Name', 'URL', 'SEO Title', 'Meta Description'];
  if (!empty($form_data['eum_character_count'])) {
    $headers[] = 'Title Length';
    $headers[] = 'Desc. Length';
  }
  $preview_data[] = $headers;

  foreach ($preview_items as $item) {
    $preview_data[] = eum_get_row_data($item, $form_data);
  }

  wp_send_json_success(['data' => $preview_data]);
}

/**
 * AJAX handler to cancel the export process.
 */
function eum_ajax_cancel_export()
{
  check_ajax_referer('eum_export_nonce', 'nonce');

  if (isset($_POST['export_id'])) {
    $export_id = sanitize_text_field($_POST['export_id']);

    // Delete transient
    delete_transient($export_id);

    // Delete temporary file
    $upload_dir = wp_upload_dir();
    $file_path = $upload_dir['basedir'] . '/eum-export-' . $export_id . '.csv';
    if (file_exists($file_path)) {
      unlink($file_path);
    }

    wp_send_json_success(['message' => 'Export cancelled.']);
  } else {
    wp_send_json_error(['message' => 'No export ID provided.']);
  }
}

/**
 * Helper function to get data for a single CSV row.
 */
function eum_get_row_data($item, $form_data)
{
  $active_seo_plugin = eum_detect_active_seo_plugin();
  $plugin_file = $active_seo_plugin['plugin_file'];
  $include_char_count = !empty($form_data['eum_character_count']);

  $data = [];

  switch ($item['type']) {
    case 'post':
      $post = get_post($item['id']);
      if (!$post) break;
      $meta = eum_get_post_meta($post, $plugin_file);
      $data = [
        get_post_type_object($post->post_type)->labels->singular_name,
        $post->post_title,
        get_permalink($post->ID),
        $meta['title'],
        $meta['desc'],
      ];
      if ($include_char_count) {
        $data[] = function_exists('mb_strlen') ? mb_strlen($meta['title']) : strlen($meta['title']);
        $data[] = function_exists('mb_strlen') ? mb_strlen($meta['desc']) : strlen($meta['desc']);
      }
      break;

    case 'term':
      $term = get_term($item['id'], $item['taxonomy']);
      if (!$term || is_wp_error($term)) break;
      $meta = eum_get_term_meta($term, $plugin_file);
      $data = [
        get_taxonomy($item['taxonomy'])->labels->singular_name,
        $term->name,
        get_term_link($term->term_id),
        $meta['title'],
        $meta['desc'],
      ];
      if ($include_char_count) {
        $data[] = function_exists('mb_strlen') ? mb_strlen($meta['title']) : strlen($meta['title']);
        $data[] = function_exists('mb_strlen') ? mb_strlen($meta['desc']) : strlen($meta['desc']);
      }
      break;

    case 'homepage':
      $meta = eum_get_homepage_meta($plugin_file);
      $data = [
        'Homepage',
        get_bloginfo('name'),
        home_url('/'),
        $meta['title'],
        $meta['desc'],
      ];
      if ($include_char_count) {
        $data[] = function_exists('mb_strlen') ? mb_strlen($meta['title']) : strlen($meta['title']);
        $data[] = function_exists('mb_strlen') ? mb_strlen($meta['desc']) : strlen($meta['desc']);
      }
      break;
  }

  return $data;
}

/**
 * Generates CSV filename using gmdate()
 */
function eum_generate_csv_filename()
{
  $site_name = sanitize_title(get_bloginfo('name'));
  $timestamp = date_i18n('dmY_Hi');
  return "{$site_name}-meta-export-{$timestamp}.csv";
}

/*---------------------------------------------------------------------------
 |  HELPER FUNCTIONS (POSTS, TERMS, HOMEPAGE)
 *--------------------------------------------------------------------------*/

/**
 * Retrieves SEO meta for a POST object (posts/pages/products).
 */
function eum_get_post_meta($post, $plugin_file)
{
  $post_id    = $post->ID;
  $post_title = get_the_title($post_id);
  $site_name  = get_bloginfo('name');

  // Default fallback
  $meta_title = "{$post_title} - {$site_name}";
  $meta_desc  = '';

  if ($plugin_file === 'seo-by-rank-math/rank-math.php') {
    $saved_title = get_post_meta($post_id, 'rank_math_title', true);

    // Get description from Rank Math
    $saved_desc = get_post_meta($post_id, 'rank_math_description', true);

    if (!empty($saved_desc)) {
      $meta_desc = $saved_desc;
    } else {
      // Fallback to excerpt if no Rank Math description is set
      if ($post->post_type === 'post') {
        $raw_excerpt = get_post_field('post_excerpt', $post_id, 'raw');
        if (!empty($raw_excerpt)) {
          $maybe_excerpt = wp_strip_all_tags($raw_excerpt);
          $maybe_excerpt = preg_replace("/\r\n|\r|\n/", ' ', $maybe_excerpt);
          $maybe_excerpt = html_entity_decode($maybe_excerpt, ENT_QUOTES, get_option('blog_charset'));
          $meta_desc = $maybe_excerpt;
        }
      }
    }
    if (!empty($saved_title)) {
      $meta_title = $saved_title;
    }
  } elseif ($plugin_file === 'wp-seopress/seopress.php') {
    // SEOPress
    $title = get_post_meta($post_id, '_seopress_titles_title', true);
    $desc  = get_post_meta($post_id, '_seopress_titles_desc', true);

    if (!empty($title)) {
      $meta_title = $title;
    }
    if (!empty($desc)) {
      $meta_desc = $desc;
    }
  } elseif ($plugin_file === 'aioseo/aioseo.php' || $plugin_file === 'all-in-one-seo-pack/all_in_one_seo_pack.php') {
    // All in One SEO (v4 and legacy v3) — guarded fallbacks
    $aioseo_meta = get_post_meta($post_id, '_aioseo', true);
    if (!empty($aioseo_meta)) {
      if (is_string($aioseo_meta)) {
        $decoded = json_decode($aioseo_meta, true);
        if (json_last_error() === JSON_ERROR_NONE) {
          $aioseo_meta = $decoded;
        }
      }
      if (is_array($aioseo_meta)) {
        if (!empty($aioseo_meta['title'])) {
          $meta_title = $aioseo_meta['title'];
        }
        if (!empty($aioseo_meta['description'])) {
          $meta_desc = $aioseo_meta['description'];
        }
      }
    }
    // Fallback keys seen across versions
    $t = get_post_meta($post_id, '_aioseo_title', true);
    $d = get_post_meta($post_id, '_aioseo_description', true);
    if (!empty($t)) $meta_title = $t;
    if (!empty($d)) $meta_desc  = $d;
    // Legacy v3
    $t3 = get_post_meta($post_id, '_aioseop_title', true);
    $d3 = get_post_meta($post_id, '_aioseop_description', true);
    if (!empty($t3)) $meta_title = $t3;
    if (!empty($d3)) $meta_desc  = $d3;
  } elseif ($plugin_file === 'autodescription/autodescription.php') {
    // The SEO Framework — prefer API if available, with guarded checks
    if (function_exists('the_seo_framework')) {
      $tsf = the_seo_framework();
      if (is_object($tsf)) {
        try {
          if (method_exists($tsf, 'title')) {
            $title_obj = $tsf->title();
            if (is_object($title_obj)) {
              if (method_exists($title_obj, 'get_post_title')) {
                $maybe = $title_obj->get_post_title($post_id);
                if (!empty($maybe)) $meta_title = $maybe;
              } elseif (method_exists($title_obj, 'get_generated_title')) {
                $maybe = $title_obj->get_generated_title($post_id);
                if (!empty($maybe)) $meta_title = $maybe;
              }
            }
          }
          if (method_exists($tsf, 'description')) {
            $desc_obj = $tsf->description();
            if (is_object($desc_obj)) {
              if (method_exists($desc_obj, 'get_post_description')) {
                $maybe = $desc_obj->get_post_description($post_id);
                if (!empty($maybe)) $meta_desc = $maybe;
              } elseif (method_exists($desc_obj, 'get_generated_description')) {
                $maybe = $desc_obj->get_generated_description($post_id);
                if (!empty($maybe)) $meta_desc = $maybe;
              }
            }
          }
        } catch (Exception $e) {
          if (function_exists('eum_log')) {
            eum_log('TSF meta retrieval failed', ['error' => $e->getMessage()]);
          }
        }
      }
    }
    // Fallback to possible meta keys if API unavailable
    $tsf_t = get_post_meta($post_id, '_tsf_title', true);
    $tsf_d = get_post_meta($post_id, '_tsf_description', true);
    if (!empty($tsf_t)) $meta_title = $tsf_t;
    if (!empty($tsf_d)) $meta_desc  = $tsf_d;
  } elseif ($plugin_file === 'wordpress-seo/wp-seo.php' && function_exists('wpseo_replace_vars')) {
    // Yoast
    $yoast_meta_title = get_post_meta($post_id, '_yoast_wpseo_title', true);

    if (!empty($yoast_meta_title)) {
      if (function_exists('wpseo_replace_vars')) {
        $meta_title = wpseo_replace_vars(htmlspecialchars_decode($yoast_meta_title), $post);
      }
    } else {
      // fallback to template
      $template_title = eum_get_yoast_title_template($post->post_type);
      if (function_exists('wpseo_replace_vars')) {
        $meta_title = wpseo_replace_vars(htmlspecialchars_decode($template_title), $post);
      }
    }
    $yoast_desc = get_post_meta($post_id, '_yoast_wpseo_metadesc', true);

    if (!empty($yoast_desc)) {
      $meta_desc = $yoast_desc;
    }
  } else {
    // fallback logic if plugin_file is "None" or unknown

    // If post is 'post' and has excerpt
    if ($post->post_type === 'post') {
      $raw_excerpt = get_post_field('post_excerpt', $post_id, 'raw');
      if (!empty($raw_excerpt)) {
        $maybe_excerpt = wp_strip_all_tags($raw_excerpt);
        $maybe_excerpt = preg_replace("/\r\n|\r|\n/", ' ', $maybe_excerpt);
        $maybe_excerpt = html_entity_decode($maybe_excerpt, ENT_QUOTES, get_option('blog_charset'));
        $meta_desc     = $maybe_excerpt;
      }
    }
  }

  return [
    'title' => htmlspecialchars_decode($meta_title),
    'desc'  => htmlspecialchars_decode($meta_desc),
  ];
}

/**
 * Retrieves SEO meta for a TERM object (e.g. category, product_cat).
 */
function eum_get_term_meta($term, $plugin_file, $taxonomy_type = 'category')
{
  $term_title = $term->name;
  $term_desc  = $term->description;
  $site_name  = get_bloginfo('name');

  // default fallback
  $meta_title = "{$term_title} - {$site_name}";
  $meta_desc  = $term_desc;

  if ($plugin_file === 'seo-by-rank-math/rank-math.php') {
    // Possible Rank Math keys for terms
    $saved_title = get_term_meta($term->term_id, 'rank_math_title', true);
    $saved_desc  = get_term_meta($term->term_id, 'rank_math_description', true);

    if (!empty($saved_title)) {
      $meta_title = $saved_title;
    }
    if (!empty($saved_desc)) {
      $meta_desc = $saved_desc;
    }
  } elseif ($plugin_file === 'wp-seopress/seopress.php') {
    // Potential future: SEOPress term meta keys
    $title = get_term_meta($term->term_id, '_seopress_titles_title_term', true);
    $desc  = get_term_meta($term->term_id, '_seopress_titles_desc_term', true);
    if (!empty($title)) {
      $meta_title = $title;
    }
    if (!empty($desc)) {
      $meta_desc  = $desc;
    }
  } elseif ($plugin_file === 'aioseo/aioseo.php' || $plugin_file === 'all-in-one-seo-pack/all_in_one_seo_pack.php') {
    // AIOSEO terms (v4 and legacy) — guarded fallbacks
    $aioseo_term = get_term_meta($term->term_id, '_aioseo', true);
    if (!empty($aioseo_term)) {
      if (is_string($aioseo_term)) {
        $decoded = json_decode($aioseo_term, true);
        if (json_last_error() === JSON_ERROR_NONE) {
          $aioseo_term = $decoded;
        }
      }
      if (is_array($aioseo_term)) {
        if (!empty($aioseo_term['title'])) $meta_title = $aioseo_term['title'];
        if (!empty($aioseo_term['description'])) $meta_desc = $aioseo_term['description'];
      }
    }
    $t = get_term_meta($term->term_id, '_aioseo_title', true);
    $d = get_term_meta($term->term_id, '_aioseo_description', true);
    if (!empty($t)) $meta_title = $t;
    if (!empty($d)) $meta_desc  = $d;
    $t3 = get_term_meta($term->term_id, 'aioseo_title', true); // legacy variant
    $d3 = get_term_meta($term->term_id, 'aioseo_description', true);
    if (!empty($t3)) $meta_title = $t3;
    if (!empty($d3)) $meta_desc  = $d3;
  } elseif ($plugin_file === 'autodescription/autodescription.php') {
    // The SEO Framework terms — guarded attempt via API, then fallbacks
    if (function_exists('the_seo_framework')) {
      $tsf = the_seo_framework();
      if (is_object($tsf)) {
        try {
          if (method_exists($tsf, 'title')) {
            $title_obj = $tsf->title();
            if (is_object($title_obj) && method_exists($title_obj, 'get_term_title')) {
              $maybe = $title_obj->get_term_title($term->term_id);
              if (!empty($maybe)) $meta_title = $maybe;
            }
          }
          if (method_exists($tsf, 'description')) {
            $desc_obj = $tsf->description();
            if (is_object($desc_obj) && method_exists($desc_obj, 'get_term_description')) {
              $maybe = $desc_obj->get_term_description($term->term_id);
              if (!empty($maybe)) $meta_desc = $maybe;
            }
          }
        } catch (Exception $e) {
          if (function_exists('eum_log')) {
            eum_log('TSF term meta retrieval failed', ['error' => $e->getMessage()]);
          }
        }
      }
    }
    $tsf_t = get_term_meta($term->term_id, '_tsf_title', true);
    $tsf_d = get_term_meta($term->term_id, '_tsf_description', true);
    if (!empty($tsf_t)) $meta_title = $tsf_t;
    if (!empty($tsf_d)) $meta_desc  = $tsf_d;
  } elseif ($plugin_file === 'wordpress-seo/wp-seo.php' && function_exists('wpseo_replace_vars')) {
    // Yoast terms: keys are 'wpseo_title' and 'wpseo_desc' for terms
    $yoast_t = get_term_meta($term->term_id, 'wpseo_title', true);
    $yoast_d = get_term_meta($term->term_id, 'wpseo_desc', true);

    if (!empty($yoast_t)) {
      $meta_title = wpseo_replace_vars($yoast_t, $term);
    } else {
      // Use category template if defined
      $template_cat = eum_get_yoast_title_template('category');
      $meta_title = wpseo_replace_vars($template_cat, $term);
    }
    if (!empty($yoast_d)) {
      $meta_desc  = wpseo_replace_vars($yoast_d, $term);
    }
  }
  // else fallback to $meta_title as default
  return [
    'title' => htmlspecialchars_decode($meta_title),
    'desc'  => htmlspecialchars_decode($meta_desc),
  ];
}

/**
 * Retrieves meta for the homepage if “latest posts” is used.
 */
function eum_get_homepage_meta($plugin_file)
{
  $site_name = get_bloginfo('name');
  $meta_title = $site_name;
  $meta_desc = '';

  if ($plugin_file === 'wordpress-seo/wp-seo.php' && function_exists('wpseo_replace_vars')) {
    $yoast_titles = get_option('wpseo_titles');
    if (!empty($yoast_titles['title-home'])) {
      $meta_title = wpseo_replace_vars($yoast_titles['title-home'], get_post(0));
    }
    if (!empty($yoast_titles['metadesc-home'])) {
      $meta_desc  = wpseo_replace_vars($yoast_titles['metadesc-home'], get_post(0));
    }
  } elseif ($plugin_file === 'seo-by-rank-math/rank-math.php') {
    // Prefer consolidated Rank Math options array; fallback to legacy option names
    $rm_titles = get_option('rank-math-options-titles');
    $home_title = is_array($rm_titles) && !empty($rm_titles['homepage_title']) ? $rm_titles['homepage_title'] : get_option('rank_math_titles_homepage_title');
    $home_desc  = is_array($rm_titles) && !empty($rm_titles['homepage_description']) ? $rm_titles['homepage_description'] : get_option('rank_math_titles_homepage_description');

    if (!empty($home_title)) {
      $meta_title = $home_title;
    }
    if (!empty($home_desc)) {
      $meta_desc  = $home_desc;
    }
  } elseif ($plugin_file === 'wp-seopress/seopress.php') {
    // SEOPress: attempt to read home title/desc from options array; guarded
    $seo_titles = get_option('seopress_titles_option_name');
    if (is_array($seo_titles)) {
      if (!empty($seo_titles['seopress_titles_home_title'])) {
        $meta_title = $seo_titles['seopress_titles_home_title'];
      }
      if (!empty($seo_titles['seopress_titles_home_desc'])) {
        $meta_desc = $seo_titles['seopress_titles_home_desc'];
      }
    } else {
      if (function_exists('eum_log')) {
        eum_log('SEOPress home options not found or invalid');
      }
    }
  } elseif ($plugin_file === 'autodescription/autodescription.php') {
    // The SEO Framework: guarded attempt via API
    if (function_exists('the_seo_framework')) {
      try {
        $tsf = the_seo_framework();
        if (is_object($tsf)) {
          if (method_exists($tsf, 'title')) {
            $title_obj = $tsf->title();
            if (is_object($title_obj) && method_exists($title_obj, 'get_blogname_title')) {
              $maybe = $title_obj->get_blogname_title();
              if (!empty($maybe)) $meta_title = $maybe;
            }
          }
          if (method_exists($tsf, 'description')) {
            $desc_obj = $tsf->description();
            if (is_object($desc_obj) && method_exists($desc_obj, 'get_blogdescription')) {
              $maybe = $desc_obj->get_blogdescription();
              if (!empty($maybe)) $meta_desc = $maybe;
            }
          }
        }
      } catch (Exception $e) {
        if (function_exists('eum_log')) {
          eum_log('TSF homepage options retrieval failed', ['error' => $e->getMessage()]);
        }
      }
    }
  }
  // else fallback to site name
  return [
    'title' => htmlspecialchars_decode($meta_title),
    'desc'  => htmlspecialchars_decode($meta_desc),
  ];
}

/**
 * Retrieves the Yoast title template from wpseo_titles, using safe checks.
 */
function eum_get_yoast_title_template($entity_type)
{
  static $yoast_titles;

  if (!isset($yoast_titles)) {
    $yoast_titles = get_option('wpseo_titles');
    if (!is_array($yoast_titles)) {
      $yoast_titles = [];
    }
  }

  switch ($entity_type) {
    case 'page':
      return !empty($yoast_titles['title-page']) ? $yoast_titles['title-page'] : '';
    case 'post':
      return !empty($yoast_titles['title-post']) ? $yoast_titles['title-post'] : '';
    case 'product':
      return !empty($yoast_titles['title-product']) ? $yoast_titles['title-product'] : '';
    case 'product_cat':
      return !empty($yoast_titles['title-product_cat']) ? $yoast_titles['title-product_cat'] : '';
    case 'category':
      return !empty($yoast_titles['title-category']) ? $yoast_titles['title-category'] : '';
    default:
      return '';
  }
}

/**
 * Displays an error message in the admin.
 */
function eum_display_error_message($message)
{
?>
  <div class="notice notice-error is-dismissible">
    <p><?php echo esc_html($message); ?></p>
  </div>
<?php
}

/**
 * Displays a generic notice message in the admin (info, warning, etc.).
 */
function eum_display_notice($message, $type = 'info')
{
?>
  <div class="notice notice-<?php echo esc_attr($type); ?> is-dismissible">
    <p><?php echo esc_html($message); ?></p>
  </div>
<?php

}

/**
 * Minimal debug logger. Writes to PHP error_log when WP_DEBUG is true.
 */
function eum_log($message, $context = [])
{
  if (defined('WP_DEBUG') && WP_DEBUG) {
    $prefix = '[EUM] ';
    if (!empty($context)) {
      $message .= ' ' . wp_json_encode($context);
    }
    error_log($prefix . $message);
  }
}

/**
 * Renders a lightweight diagnostics page for maintainers.
 */
function eum_render_diagnostics_page()
{
  if (!current_user_can('manage_options')) {
    return;
  }

  $detected = eum_detect_active_seo_plugin();
  $plugin_file = is_array($detected) ? $detected['plugin_file'] : false;
  $plugin_name = is_array($detected) ? $detected['plugin_name'] : 'Unknown';

  $upload_dir = wp_upload_dir();
  $basedir = isset($upload_dir['basedir']) ? $upload_dir['basedir'] : '';
  $is_writable = $basedir ? (is_writable($basedir) ? 'Yes' : 'No') : 'Unknown';
  $batch_size = apply_filters('eum_export_batch_size', 50);

  $wp_debug = defined('WP_DEBUG') && WP_DEBUG ? 'Yes' : 'No';
  $wp_debug_log = defined('WP_DEBUG_LOG') && WP_DEBUG_LOG ? 'Yes' : 'No';

  $keys = [
    'posts' => ['title' => '', 'desc' => '', 'notes' => ''],
    'terms' => ['title' => '', 'desc' => '', 'notes' => ''],
    'homepage' => ['source' => '', 'notes' => ''],
  ];

  switch ($plugin_file) {
    case 'wordpress-seo/wp-seo.php':
      $keys['posts'] = ['title' => '_yoast_wpseo_title', 'desc' => '_yoast_wpseo_metadesc', 'notes' => 'Uses wpseo_replace_vars'];
      $keys['terms'] = ['title' => 'wpseo_title', 'desc' => 'wpseo_desc', 'notes' => 'Uses wpseo_replace_vars'];
      $keys['homepage'] = ['source' => "get_option('wpseo_titles')['title-home'|'metadesc-home']", 'notes' => ''];
      break;
    case 'seo-by-rank-math/rank-math.php':
      $keys['posts'] = ['title' => 'rank_math_title', 'desc' => 'rank_math_description', 'notes' => ''];
      $keys['terms'] = ['title' => 'rank_math_title', 'desc' => 'rank_math_description', 'notes' => ''];
      $keys['homepage'] = ['source' => "get_option('rank-math-options-titles')['homepage_*'] or legacy rank_math_titles_homepage_*", 'notes' => ''];
      break;
    case 'wp-seopress/seopress.php':
      $keys['posts'] = ['title' => '_seopress_titles_title', 'desc' => '_seopress_titles_desc', 'notes' => ''];
      $keys['terms'] = ['title' => '_seopress_titles_title_term', 'desc' => '_seopress_titles_desc_term', 'notes' => ''];
      $keys['homepage'] = ['source' => "get_option('seopress_titles_option_name')['seopress_titles_home_*']", 'notes' => ''];
      break;
    case 'aioseo/aioseo.php':
    case 'all-in-one-seo-pack/all_in_one_seo_pack.php':
      $keys['posts'] = ['title' => '_aioseo[title] or _aioseo_title or legacy _aioseop_title', 'desc' => '_aioseo[description] or _aioseo_description or legacy _aioseop_description', 'notes' => 'Composite meta array may be JSON'];
      $keys['terms'] = ['title' => '_aioseo[title] or _aioseo_title or legacy aioseo_title', 'desc' => '_aioseo[description] or _aioseo_description or legacy aioseo_description', 'notes' => ''];
      $keys['homepage'] = ['source' => 'N/A (site-level settings not currently read)', 'notes' => ''];
      break;
    case 'autodescription/autodescription.php':
      $keys['posts'] = ['title' => 'TSF API (title()->get_post_title)', 'desc' => 'TSF API (description()->get_post_description)', 'notes' => 'Fallback keys _tsf_title/_tsf_description'];
      $keys['terms'] = ['title' => 'TSF API (title()->get_term_title)', 'desc' => 'TSF API (description()->get_term_description)', 'notes' => 'Fallback keys _tsf_title/_tsf_description'];
      $keys['homepage'] = ['source' => 'TSF API (title()/description())', 'notes' => ''];
      break;
    default:
      $keys['posts'] = ['title' => 'n/a', 'desc' => 'n/a', 'notes' => 'No SEO plugin detected'];
      $keys['terms'] = ['title' => 'n/a', 'desc' => 'n/a', 'notes' => ''];
      $keys['homepage'] = ['source' => 'n/a', 'notes' => ''];
      break;
  }

  $computed_home = eum_get_homepage_meta($plugin_file);

  ?>
  <div class="wrap">
    <h1>Export URLs and Meta — Diagnostics</h1>

    <h2>Detection</h2>
    <table class="widefat striped">
      <tbody>
        <tr>
          <th scope="row">Detected SEO Plugin</th>
          <td><?php echo esc_html($plugin_name ?: 'None'); ?> (<?php echo esc_html($plugin_file ?: ''); ?>)</td>
        </tr>
        <tr>
          <th scope="row">wpseo_replace_vars available</th>
          <td><?php echo function_exists('wpseo_replace_vars') ? 'Yes' : 'No'; ?></td>
        </tr>
        <tr>
          <th scope="row">the_seo_framework() available</th>
          <td><?php echo function_exists('the_seo_framework') ? 'Yes' : 'No'; ?></td>
        </tr>
      </tbody>
    </table>

    <h2>Meta Sources</h2>
    <table class="widefat striped">
      <thead><tr><th>Entity</th><th>Title Key/Source</th><th>Description Key/Source</th><th>Notes</th></tr></thead>
      <tbody>
        <tr><td>Posts</td><td><?php echo esc_html($keys['posts']['title']); ?></td><td><?php echo esc_html($keys['posts']['desc']); ?></td><td><?php echo esc_html($keys['posts']['notes']); ?></td></tr>
        <tr><td>Terms</td><td><?php echo esc_html($keys['terms']['title']); ?></td><td><?php echo esc_html($keys['terms']['desc']); ?></td><td><?php echo esc_html($keys['terms']['notes']); ?></td></tr>
        <tr><td>Homepage</td><td colspan="2"><?php echo esc_html($keys['homepage']['source']); ?></td><td><?php echo esc_html($keys['homepage']['notes']); ?></td></tr>
      </tbody>
    </table>

    <h2>Homepage (Computed)</h2>
    <table class="widefat striped">
      <tbody>
        <tr><th scope="row">Computed Title</th><td><?php echo esc_html($computed_home['title']); ?></td></tr>
        <tr><th scope="row">Computed Description</th><td><?php echo esc_html($computed_home['desc']); ?></td></tr>
      </tbody>
    </table>

    <h2>Environment</h2>
    <table class="widefat striped">
      <tbody>
        <tr><th scope="row">Uploads Base Dir</th><td><?php echo esc_html($basedir); ?></td></tr>
        <tr><th scope="row">Uploads Writable</th><td><?php echo esc_html($is_writable); ?></td></tr>
        <tr><th scope="row">Batch Size</th><td><?php echo (int) $batch_size; ?></td></tr>
        <tr><th scope="row">WP_DEBUG</th><td><?php echo esc_html($wp_debug); ?></td></tr>
        <tr><th scope="row">WP_DEBUG_LOG</th><td><?php echo esc_html($wp_debug_log); ?></td></tr>
      </tbody>
    </table>
  </div>
  <?php
}
