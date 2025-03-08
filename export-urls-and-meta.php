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
  wp_enqueue_style('eum-admin-css', plugin_dir_url(__FILE__) . 'assets/css/export-urls-and-meta.css', array(), '0.0.12');
  wp_enqueue_script('eum-admin-js', plugin_dir_url(__FILE__) . 'assets/js/export-urls-and-meta.js', array('jquery'), '0.0.12', true);
}
add_action('admin_enqueue_scripts', 'eum_enqueue_admin_assets');

/**
 * Detect Active Seo Plugin(s)
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

    <form method="post" action="" class="eum-export-form">
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

  $active_seo_plugin = eum_detect_active_seo_plugin();
  if ($active_seo_plugin === false) {
    add_action('admin_notices', function () {
      eum_display_error_message('Multiple SEO plugins are active. Please deactivate all but one SEO plugin to ensure compatibility.');
    });
    return;
  }

  // Get sanitized inputs from form data
  $post_types = isset($_POST['eum_post_types'])
    ? array_map('sanitize_text_field', wp_unslash($_POST['eum_post_types']))
    : array();

  $include_homepage_latest = isset($_POST['include_homepage_latest']) ? 1 : 0;
  $include_wp_categories = isset($_POST['eum_include_wp_categories']) ? 1 : 0;
  $include_product_categories = isset($_POST['eum_include_product_categories'])
    ? intval($_POST['eum_include_product_categories'])
    : 0;

  $publish_status = isset($_POST['eum_publish_status'])
    ? array_map('sanitize_text_field', wp_unslash($_POST['eum_publish_status']))
    : array('publish');

  $include_character_count = isset($_POST['eum_character_count']) ? 1 : 0;

  // Save these choices to the database so they persist
  $saved_settings = [
    'post_types'                 => $post_types,
    'include_homepage_latest'    => $include_homepage_latest,
    'include_wp_categories'      => $include_wp_categories,
    'include_product_categories' => $include_product_categories,
    'publish_status'             => $publish_status,
    'include_character_count'    => $include_character_count,
  ];
  update_option('eum_export_settings', $saved_settings);

  // If no post types selected, show error and stop.
  if (empty($post_types) && !$include_wp_categories && !$include_product_categories) {
    add_action('admin_notices', function () {
      eum_display_error_message('Please select at least one post type or category option.');
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
      $include_homepage_latest,
      $include_wp_categories,
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
function eum_generate_csv(
  $post_types,
  $include_homepage_latest,
  $include_wp_categories,
  $seo_plugin,
  $include_product_categories,
  $include_character_count,
  $publish_status
) {

  // Prepare CSV headers
  $headers = [
    'Page Title',
    'URL',
    'Meta Title',
    'Meta Description',
    'Type',
    'Categories',
    'Status'
  ];

  if ($include_character_count) {
    $headers[] = 'Meta Title Char. Count';
    $headers[] = 'Description Char. Count';
  }

  // Prepare data for CSV
  $data = [];

  // Include regular posts/pages/products
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

      // Iterate over each post object
      foreach ($query->posts as $post) {
        // Basic Info
        $title   = htmlspecialchars_decode(get_the_title($post->ID));
        $url     = get_permalink($post->ID);
        $post_obj_label = get_post_type_object($post->post_type);
        $type_label     = $post_obj_label && isset($post_obj_label->labels->singular_name)
          ? $post_obj_label->labels->singular_name
          : $post->post_type;

        // Retrieve meta from a dedicated function
        $meta = eum_get_post_meta($post, $seo_plugin['plugin_file']);
        $meta_title = $meta['title'];
        $meta_desc  = $meta['desc'];

        // Category column
        $cat_string = '';
        if ($post->post_type === 'post') {
          $post_cats = wp_get_post_terms($post->ID, 'category', ['fields' => 'names']);
          $cat_string = !empty($post_cats) ? implode(', ', $post_cats) : '';
        } elseif ($post->post_type === 'product') {
          $product_cats = wp_get_post_terms($post->ID, 'product_cat', ['fields' => 'names']);
          $cat_string = !empty($product_cats) ? implode(', ', $product_cats) : '';
        }

        $status_obj = get_post_status_object($post->post_status);
        $status_label = $status_obj && isset($status_obj->label) ? $status_obj->label : $post->post_status;

        $row = [
          $title,
          $url,
          $meta_title,
          $meta_desc,
          $type_label,
          $cat_string,
          $status_label,
        ];
        if ($include_character_count) {
          $row[] = strlen((string)$meta_title);
          $row[] = strlen((string)$meta_desc);
        }
        $data[] = $row;
      }
      $paged++;
    } while ($paged <= $query->max_num_pages);
  }

  // Homepage (latest posts)
  if ($include_homepage_latest && (int) get_option('page_on_front') === 0) {
    $homepage_meta = eum_get_homepage_meta($seo_plugin['plugin_file']);
    $row = [
      'Homepage',
      home_url('/'),
      $homepage_meta['title'],
      $homepage_meta['desc'],
      'Front Page',
      '',
      'Published'
    ];
    if ($include_character_count) {
      $row[] = strlen((string)$homepage_meta['title']);
      $row[] = strlen((string)$homepage_meta['desc']);
    }
    $data[] = $row;
  }

  // Post Category Pages
  if ($include_wp_categories) {
    $wp_categories = get_terms([
      'taxonomy'   => 'category',
      'hide_empty' => false,
    ]);
    foreach ($wp_categories as $term) {
      $term_meta = eum_get_term_meta($term, $seo_plugin['plugin_file'], 'category');
      $row = [
        $term->name,
        get_term_link($term),
        $term_meta['title'],
        $term_meta['desc'],
        'Post Category',
        '',
        'Published'
      ];
      if ($include_character_count) {
        $row[] = strlen((string)$term_meta['title']);
        $row[] = strlen((string)$term_meta['desc']);
      }
      $data[] = $row;
    }
  }

  // Product categories
  if ($include_product_categories && in_array('product', $post_types, true)) {
    $product_categories = get_terms([
      'taxonomy'   => 'product_cat',
      'hide_empty' => false,
    ]);
    foreach ($product_categories as $term) {
      $term_meta = eum_get_term_meta($term, $seo_plugin['plugin_file'], 'product_cat');
      $row = [
        $term->name,
        get_term_link($term),
        $term_meta['title'],
        $term_meta['desc'],
        'Product Category',
        $term->name, // or '', if you don't want it repeated
        'Published'
      ];
      if ($include_character_count) {
        $row[] = strlen((string)$term_meta['title']);
        $row[] = strlen((string)$term_meta['desc']);
      }
      $data[] = $row;
    }
  }

  //  Build CSV in memory and use WP_Filesystem
  $csv_handle = fopen('php://temp', 'r+'); // no direct file system calls
  fputcsv($csv_handle, $headers);
  foreach ($data as $row) {
    fputcsv($csv_handle, $row);
  }
  rewind($csv_handle);
  $csv_output = stream_get_contents($csv_handle);
  fclose($csv_handle);

  if (!function_exists('WP_Filesystem')) {
    require_once ABSPATH . 'wp-admin/includes/file.php';
  }
  global $wp_filesystem;
  WP_Filesystem();

  $temp_file = wp_tempnam('csv-export');
  if (!$temp_file) {
    wp_die('Could not create temporary file for CSV export.');
  }
  $wp_filesystem->put_contents($temp_file, $csv_output, FS_CHMOD_FILE);
  $file_contents = $wp_filesystem->get_contents($temp_file);
  if ($file_contents === false) {
    wp_die('Unable to read CSV data from temporary file.');
  }

  $filename = eum_generate_csv_filename();
  header('Content-Type: text/csv; charset=UTF-8');
  header('Content-Disposition: attachment; filename="' . $filename . '"');
  header('Pragma: no-cache');
  header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

  // Output UTF-8 BOM
  echo "\xEF\xBB\xBF";
  echo $file_contents;

  wp_delete_file($temp_file);
  exit();
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
  } elseif ($plugin_file === 'wordpress-seo/wp-seo.php' && function_exists('wpseo_replace_vars')) {
    // Yoast
    $yoast_meta_title = get_post_meta($post_id, '_yoast_wpseo_title', true);

    if (!empty($yoast_meta_title)) {
      $meta_title = wpseo_replace_vars(htmlspecialchars_decode($yoast_meta_title), $post);
    } else {
      // fallback to template
      $template_title = eum_get_yoast_title_template($post->post_type);
      $meta_title     = wpseo_replace_vars(htmlspecialchars_decode($template_title), $post);
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
  } elseif ($plugin_file === 'wordpress-seo/wp-seo.php' && function_exists('wpseo_replace_vars')) {
    $yoast_t = get_term_meta($term->term_id, '_yoast_wpseo_title', true);
    $yoast_d = get_term_meta($term->term_id, '_yoast_wpseo_metadesc', true);

    if (!empty($yoast_t)) {
      $meta_title = wpseo_replace_vars($yoast_t, (array)$term);
    } else {
      // Possibly handle category template if you like:
      $template_cat = eum_get_yoast_title_template('category');
      $meta_title   = wpseo_replace_vars($template_cat, (array)$term);
    }
    if (!empty($yoast_d)) {
      $meta_desc  = wpseo_replace_vars($yoast_d, (array)$term);
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
    // Some Rank Math settings for homepage could exist in rank_math_titles_homepage_title or rank_math_titles_homepage_description
    $home_title = get_option('rank_math_titles_homepage_title');
    $home_desc  = get_option('rank_math_titles_homepage_description');

    if (!empty($home_title)) {
      $meta_title = $home_title;
    }
    if (!empty($home_desc)) {
      $meta_desc  = $home_desc;
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
