<?php
/*
Plugin Name: Export URLs and Meta
Plugin URI: https://github.com/devjusty/export-urls-and-meta
Description: Plugin to export SEO titles, URLs, and meta descriptions to a CSV.
Version: 0.0.7
Author: Justin Thompson
Requires PHP: 7.0
Tested up to: 6.7
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain: export-urls-and-meta
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
  exit;
}



/**
 * Detect which SEO plugin (if any) is active, ensuring only one is active
 */
function eum_detect_active_seo_plugin()
{
  $seo_plugins = [
    'wordpress-seo/wp-seo.php' => 'Yoast SEO',
    'all-in-one-seo-pack/all_in_one_seo_pack.php'  => 'All in One SEO Pack',
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
 * Adds an admin submenu under Tools for our export page.
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
}
add_action('admin_menu', 'eum_add_admin_menu');


/**
 * Renders the admin page with a form for selecting post types/status, etc.
 */
function eum_render_admin_page()
{
  // Check if an SEO plugin is active and if WooCommerce is active
  $active_seo_plugin = eum_detect_active_seo_plugin();
  $woocommerce_active = class_exists('WooCommerce');
?>
  <div class="wrap">
    <h1>Export URLs and Meta</h1>
    <?php if ($active_seo_plugin === false) : ?>
      <div class="notice notice-error is-dismissible">
        <p>Multiple SEO plugins are active. Please deactivate all but one SEO plugin to ensure compatibility.</p>
      </div>
    <?php else : ?>
      <p>Detected SEO Plugin: <strong><?php echo esc_html($active_seo_plugin['plugin_name']); ?></strong></p>
    <?php endif; ?>

    <form method="post" action="">
      <input type="hidden" name="eum_export_csv" value="1">
      <?php wp_nonce_field('eum_export_nonce', 'eum_export_nonce_field'); ?>

      <h2>Post Types</h2>
      <label for="eum_post_type_page">
        <input type="checkbox" id="eum_post_type_page" name="eum_post_types[]" value="page">
        Pages
      </label>
      <label for="eum_post_type_post">
        <input type="checkbox" id="eum_post_type_post" name="eum_post_types[]" value="post">
        Posts
      </label>

      <?php if ($woocommerce_active) : ?>
        <h2>WooCommerce</h2>
        <label for="eum_post_type_product">
          <input type="checkbox" id="eum_post_type_product" name="eum_post_types[]" value="product">
          Products
        </label>
        <label for="eum_include_product_categories">
          <input type="checkbox" id="eum_include_product_categories" name="eum_include_product_categories" value="1">
          Include Product Category Pages
        </label>
      <?php endif; ?>

      <h2>Publish Status</h2>
      <p>Select the publish status of the posts you want to export.</p>
      <label for="eum_publish_status_publish"><input type="checkbox" id="eum_publish_status_publish" name="eum_publish_status[]" value="publish" checked> Published</label>
      <label for="eum_publish_status_draft"><input type="checkbox" id="eum_publish_status_draft" name="eum_publish_status[]" value="draft"> Drafts</label>
      <label for="eum_publish_status_private"><input type="checkbox" id="eum_publish_status_private" name="eum_publish_status[]" value="private"> Private</label>

      <h2>Additional Options</h2>
      <label for="eum_character_count">
        <input type="checkbox" id="eum_character_count" name="eum_character_count" value="1"> Add character count for titles and descriptions
      </label>

      <div style="margin-top: 20px;">
        <button type="submit" name="eum_export_csv" class="button button-primary">Export CSV</button>
      </div>

    </form>
  </div>
<?php
}


/**
 * Handles form submission to export CSV. Validates and sanitizes input.
 */
function eum_handle_export_csv()
{
  // Check if form was submitted
  if (!isset($_POST['eum_export_csv'])) {
    return; // Exit early if not our form submission
  }

  // Nonce Checks
  $nonce_field = isset($_POST['eum_export_nonce_field'])
    ? sanitize_text_field(wp_unslash($_POST['eum_export_nonce_field']))
    : '';
  if (!wp_verify_nonce($nonce_field, 'eum_export_nonce')) {
    wp_die('Security check failed. Please try again.', 'Security Error', array('response' => 403));
  }

  // Check user capability
  if (!current_user_can('manage_options')) {
    wp_die('You do not have permission to perform this action.', 'Permission Error', array('response' => 403));
  }
  // Get active SEO plugin information
  $active_seo_plugin = eum_detect_active_seo_plugin();
  if ($active_seo_plugin === false) {
    add_action('admin_notices', function () {
      eum_display_error_message('Multiple SEO plugins are active. Please deactivate all but one SEO plugin to ensure compatibility.');
    });
    return;
  }

  // Get sanitized inputs
  $post_types = isset($_POST['eum_post_types'])
    ? array_map('sanitize_text_field', wp_unslash($_POST['eum_post_types']))
    : array();
  $include_product_categories = isset($_POST['eum_include_product_categories'])
    ? intval($_POST['eum_include_product_categories'])
    : 0;
  $publish_status = isset($_POST['eum_publish_status'])
    ? array_map('sanitize_text_field', wp_unslash($_POST['eum_publish_status']))
    : array('publish');
  $include_character_count = isset($_POST['eum_character_count'])
    ? intval($_POST['eum_character_count'])
    : 0;

  // If no post types selected, show error and stop.
  if (empty($post_types)) {
    add_action('admin_notices', function () {
      eum_display_error_message('Please select at least one post type.');
    });
    return;
  }

  // If no statuses, default to 'publish'
  if (empty($publish_status)) {
    $publish_status = ['publish'];
  }

  // Generate the CSV
  try {
    eum_generate_csv(
      $post_types,
      $active_seo_plugin,
      $include_product_categories,
      $include_character_count,
      $publish_status
    );
  } catch (Exception $e) {
    // Handle any exceptions that might occur during CSV generation
    add_action('admin_notices', function () use ($e) {
      eum_display_error_message('Failed to generate CSV: ' . $e->getMessage());
    });
    return;
  }
}

// Handle form submission
add_action('admin_init', 'eum_handle_export_csv');


/**
 * Generates the CSV file and streams it to the browser using WP_Filesystem.
 */
function eum_generate_csv($post_types, $seo_plugin, $include_product_categories, $include_character_count, $publish_status)
{
  // Prepare CSV headers
  $headers = array('Page Title', 'URL', 'Meta Title', 'Meta Description', 'Post Type', 'Publish Status');
  if ($include_character_count) {
    $headers[] = 'Meta Title Char. Count';
    $headers[] = 'Meta Description Char. Count';
  }

  // Prepare data for CSV
  $data = [];

  $seo_plugin_file = $seo_plugin['plugin_file'];

  // Identify if Yoast is available
  $is_yoast = (
    $seo_plugin['plugin_file'] === 'wordpress-seo/wp-seo.php'
    && function_exists('wpseo_replace_vars')
  );

  // Include regular posts/pages
  foreach ($post_types as $post_type) {
    $paged = 1;
    do {
      $args = [
        'post_type'      => $post_type,
        'post_status'    => $publish_status,
        'posts_per_page' => 100,
        'paged'          => $paged,
      ];
      $query = new WP_Query($args);
      $posts = $query->posts;

      // Iterate over each post object
      foreach ($posts as $post) {
        $title = htmlspecialchars_decode(get_the_title($post->ID)); // Decode HTML entities in title
        $url = get_permalink($post->ID);

        // Determine meta title / description
        $meta_title       = '';
        $meta_description = '';

        // Use fallback or plugin-specific logic
        if ($seo_plugin['plugin_name'] === 'None') {
          // For no SEO plugin:
          // Title always "Page/Post Title - Site Name".
          $meta_title = $title . ' - ' . get_bloginfo('name');

          // If this is a post, and there's an actual excerpt, use that.
          // Otherwise, leave the meta description blank.
          if ($post->post_type === 'post') {
            // Check for manual excerpt
            $raw_excerpt = get_post_field('post_excerpt', $post->ID, 'raw');
            // If there's a manual excerpt, sanitize it; otherwise blank
            if (!empty($raw_excerpt)) {
              $maybe_excerpt = wp_strip_all_tags($raw_excerpt);
              $maybe_excerpt = preg_replace("/\r\n|\r|\n/", ' ', $maybe_excerpt);
              $maybe_excerpt = html_entity_decode($maybe_excerpt, ENT_QUOTES, get_option('blog_charset'));
              $meta_description = $maybe_excerpt;
            } else {
              $meta_description = ''; // No manual excerpt, so blank
            }
          }
        } elseif ($is_yoast) {
          // Yoast SEO logic
          $yoast_meta_title = get_post_meta($post->ID, '_yoast_wpseo_title', true);

          if (!empty($yoast_meta_title)) {
            $meta_title = wpseo_replace_vars(htmlspecialchars_decode($yoast_meta_title), $post);
          } else {
            $title_template = eum_get_yoast_title_template($post->post_type);
            $meta_title = wpseo_replace_vars(htmlspecialchars_decode($title_template), $post);
          }
          $meta_description = get_post_meta($post->ID, '_yoast_wpseo_metadesc', true);
        } else {
          // Other recognized plugin or fallback
          // If you want custom logic for Rank Math or SEOPress, handle it here.
          // For now, fallback:
          $meta_info = eum_get_seo_meta($post->ID, $seo_plugin['plugin_file']);
          $meta_title = $meta_info['meta_title'];
          $meta_description = $meta_info['meta_desc'];
        }

        // Post type label
        $post_type_obj = get_post_type_object($post->post_type);
        $post_type_label = $post_type_obj ? $post_type_obj->labels->singular_name : $post->post_type;

        // Status label
        $status_obj = get_post_status_object($post->post_status);
        $publish_status_label = $status_obj ? $status_obj->label : $post->post_status;

        $row = [
          $title,
          $url,
          $meta_title,
          $meta_description,
          $post_type_label,
          $publish_status_label,
        ];

        if ($include_character_count) {
          $row[] = strlen((string)$meta_title);
          $row[] = strlen((string)$meta_description);
        }

        $data[] = $row;
      }
      $paged++;
    } while ($paged <= $query->max_num_pages);
  }

  // Include product categories if requested
  if ($include_product_categories && in_array('product', $post_types, true)) {
    $product_categories = get_terms([
      'taxonomy'   => 'product_cat',
      'hide_empty' => false,
    ]);
    foreach ($product_categories as $category) {
      $category_title = $category->name;
      $category_url   = get_term_link($category);

      $category_meta_title  = '';
      $category_description = $category->description;

      // Decide meta logic for product categories
      if ($seo_plugin['plugin_name'] === 'None') {
        // No recognized SEO plugin
        $category_meta_title   = $category_title . ' - ' . get_bloginfo('name');
        $category_description  = $category->description;
      } elseif ($is_yoast) {
        $yoast_meta_title = get_term_meta($category->term_id, '_yoast_wpseo_title', true);
        if (!empty($yoast_meta_title)) {
          $category_meta_title = wpseo_replace_vars($yoast_meta_title, (array)$category);
        } else {
          // Use the product_cat template if provided
          $title_template = eum_get_yoast_title_template('product_cat');
          $category_meta_title = wpseo_replace_vars($title_template, (array)$category);
        }
        $category_description = $category->description;
      } else {
        // Other plugin or fallback
        $category_meta_title  = $category_title . ' - ' . get_bloginfo('name');
        $category_description = $category->description;
      }

      $category_row = [
        $category_title,
        $category_url,
        $category_meta_title,
        $category_description,
        'Product Category',
        'Published',
      ];
      if ($include_character_count) {
        $category_row[] = strlen((string)$category_meta_title);
        $category_row[] = strlen((string)$category_description);
      }
      $data[] = $category_row;
    }
  }

  // -----------------------------------------------------------------------
  // Instead of fopen/fclose/unlink, build CSV in memory and use WP_Filesystem
  // -----------------------------------------------------------------------

  // 1) Build CSV output in memory
  $csv_handle = fopen('php://temp', 'r+'); // no direct file system calls
  fputcsv($csv_handle, $headers);

  foreach ($data as $row) {
    fputcsv($csv_handle, $row);
  }

  rewind($csv_handle);
  $csv_output = stream_get_contents($csv_handle);
  fclose($csv_handle);

  // 2) Use WP_Filesystem to create a temp file and write CSV output
  if (!function_exists('WP_Filesystem')) {
    require_once ABSPATH . 'wp-admin/includes/file.php';
  }
  global $wp_filesystem;
  WP_Filesystem();

  $temp_file = wp_tempnam('csv-export');
  if (!$temp_file) {
    wp_die('Could not create temporary file for CSV export.');
  }

  // Write CSV string to the file
  $wp_filesystem->put_contents($temp_file, $csv_output, FS_CHMOD_FILE);

  // 3) Retrieve contents again
  $file_contents = $wp_filesystem->get_contents($temp_file);
  if ($file_contents === false) {
    wp_die('Unable to read CSV data from temporary file.');
  }


  // 4) Stream CSV to the browser
  $filename = eum_generate_csv_filename();

  // Send headers
  header('Content-Type: text/csv; charset=UTF-8');
  header('Content-Disposition: attachment; filename="' . $filename . '"');
  header('Pragma: no-cache');
  header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

  // Output UTF-8 BOM
  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
  echo "\xEF\xBB\xBF";

  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
  echo $file_contents;

  // 5) Remove temp file with wp_delete_file()
  wp_delete_file($temp_file);
  exit();
}

/**
 * Generates CSV filename using gmdate() to avoid date/timezone issues.
 */
function eum_generate_csv_filename()
{
  $site_name = sanitize_title(get_bloginfo('name'));
  $timestamp = gmdate('dmY_Hi');  // Format: DDMMYY_HHMM (24-hour format)
  return "{$site_name}-meta-export-{$timestamp}.csv";
}


/**
 * Retrieves meta data from various SEO plugins
 */
function eum_get_seo_meta($post_id, $plugin_file)
{
  $meta_title = '';
  $meta_desc = '';
  $site_name = get_bloginfo('name');
  $post_title = get_the_title($post_id);

  if ($plugin_file === 'seo-by-rank-math/rank-math.php' && function_exists('RankMath')) {
    // Rank Math logic
    $meta_title = RankMath()->variables->get_variable('title', $post_id);
    $meta_desc  = RankMath()->variables->get_variable('meta_description', $post_id);
  } elseif ($plugin_file === 'wp-seopress/seopress.php') {
    // SEOPress logic
    $meta_title = get_post_meta($post_id, '_seopress_titles_title', true);
    $meta_desc  = get_post_meta($post_id, '_seopress_titles_desc', true);
  } else {
    // Fallback for none or other
    $meta_title = $post_title . ' - ' . $site_name;
    $meta_desc  = get_the_excerpt($post_id);
  }

  return [
    'meta_title' => htmlspecialchars_decode($meta_title),
    'meta_desc'  => htmlspecialchars_decode($meta_desc),
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
    // Ensure it's an array to avoid PHP notices
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

?>
