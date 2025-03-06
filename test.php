<?php
/*
Plugin Name: Export URLs and Meta
Description: Plugin to export a CSV file of all published pages with their titles, URLs, and meta descriptions.
Version: 0.0.6
Author: Justin Thompson
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
  exit;
}

// Plugin activation hook
register_activation_hook(__FILE__, 'eum_plugin_activate');

// Plugin deactivation hook
register_deactivation_hook(__FILE__, 'eum_plugin_deactivate');

// Plugin activation function
function eum_plugin_activate()
{
  // Add any activation tasks here
}

// Plugin deactivation function
function eum_plugin_deactivate()
{
  // Add any deactivation tasks here
}

// Function to detect active SEO plugin
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
  $active_seo_plugins = array_filter($seo_plugins, function ($plugin) use ($active_plugins) {
    return in_array($plugin, $active_plugins);
  }, ARRAY_FILTER_USE_KEY);

  if (count($active_seo_plugins) > 1) {
    add_action('admin_notices', function () {
      echo '<div class="notice notice-warning is-dismissible"><p>Multiple SEO plugins are active. Please deactivate all but one SEO plugin to ensure compatibility with this plugin.</p></div>';
    });
    return false;
  }

  return !empty($active_seo_plugins) ? array_keys($active_seo_plugins)[0] : false;
}

// Add admin menu
function eum_add_admin_menu()
{
  add_submenu_page(
    'tools.php',     // Parent menu slug (Settings)
    'Export URLs and Meta',    // Page title
    'Export URLs and Meta',    // Menu title
    'manage_options',          // Capability required to access
    'export-urls-and-meta',    // Menu slug
    'eum_render_admin_page'    // Callback function to render the page
  );
}
add_action('admin_menu', 'eum_add_admin_menu');

// Render admin page
function eum_render_admin_page()
{
  // Check if an SEO plugin is active
  $active_seo_plugin = eum_detect_active_seo_plugin();


  // Check if WooCommerce is active
  $woocommerce_active = class_exists('WooCommerce');

  // Check if checkboxes are checked
  $post_types = isset($_POST['eum_post_types']) ? $_POST['eum_post_types'] : array();
  $include_post_categories = isset($_POST['eum_include_post_categories']) && $_POST['eum_include_post_categories'] == 1;
  $include_product_categories = isset($_POST['eum_include_product_categories']) && $_POST['eum_include_product_categories'] == 1;
  $include_character_count = isset($_POST['eum_character_count']) && $_POST['eum_character_count'] == 1;
  $publish_status = isset($_POST['eum_publish_status']) ? $_POST['eum_publish_status'] : 'publish';

?>
  <div class="wrap">
    <h1>Export URLs and Meta</h1>
    <p>Detected SEO Plugin: <strong><?php echo $active_seo_plugin ? $active_seo_plugin : 'None'; ?></strong></p>

    <form method="post" action="">
      <input type="hidden" name="eum_export_csv" value="1">
      <?php wp_nonce_field('eum_export_nonce', 'eum_export_nonce_field'); ?>
      <h2>Post Types</h2>
      <label for="eum_post_type_page">
        <input type="checkbox" id="eum_post_type_page" name="eum_post_types[]" value="page" <?php echo in_array('page', $post_types) ? 'checked' : ''; ?>>
        Pages
      </label>
      <label for="eum_post_type_post">
        <input type="checkbox" id="eum_post_type_post" name="eum_post_types[]" value="post" <?php echo in_array('post', $post_types) ? 'checked' : ''; ?>>
        Posts
      </label>
      <label for="eum_include_post_categories">
        <input type="checkbox" id="eum_include_post_categories" name="eum_include_post_categories" value="1" <?php echo $include_post_categories ? 'checked' : ''; ?>>
        Include Post Category Pages

      </label>
      <?php if ($woocommerce_active) : ?>
        <label for="eum_post_type_product">
          <input type="checkbox" id="eum_post_type_product" name="eum_post_types[]" value="product" <?php echo in_array('product', $post_types) ? 'checked' : ''; ?>>
          Products
        </label>
        <label for="eum_include_product_categories">
          <input type="checkbox" id="eum_include_product_categories" name="eum_include_product_categories" value="1" <?php echo $include_product_categories ? 'checked' : ''; ?>>
          Include Product Category Pages
        </label>
      <?php endif; ?>
      <h2>Additional Options</h2>
      <label for="eum_character_count">
        <input type="checkbox" id="eum_character_count" name="eum_character_count" value="1" <?php echo $include_character_count ? 'checked' : ''; ?>>
        Add character count for titles and descriptions
      </label>
      <h2>Publish Status</h2>
      <select name="eum_publish_status">
        <option value="publish" <?php selected($publish_status, 'publish'); ?>>Published</option>
        <option value="draft" <?php selected($publish_status, 'draft'); ?>>Drafts</option>
        <option value="private" <?php selected($publish_status, 'private'); ?>>Private</option>
        <option value="any" <?php selected($publish_status, 'any'); ?>>All</option>
      </select>
      <button type="submit" class="button button-primary">Export CSV</button>
    </form>
  </div>
<?php
}

// Handle form submission
add_action('admin_init', 'eum_handle_export_csv');

// Function to handle CSV export
function eum_handle_export_csv()
{
  if (isset($_POST['eum_export_csv']) && $_POST['eum_export_csv'] == 1) {
    // Sanitize post data
    $post_types = isset($_POST['eum_post_types']) ? array_map('sanitize_text_field', $_POST['eum_post_types']) : array();
    $include_product_categories = isset($_POST['eum_include_product_categories']) ? intval($_POST['eum_include_product_categories']) : 0;
    $include_character_count = isset($_POST['eum_character_count']) ? intval($_POST['eum_character_count']) : 0;
    $publish_status = isset($_POST['eum_publish_status']) ? sanitize_text_field($_POST['eum_publish_status']) : 'publish';

    // Check if at least one post type is selected
    if (empty($post_types)) {
      // No post types selected, display an error message and halt further processing
      wp_die('Please select at least one post type.');
    }


    // Check nonce for security
    if (!isset($_POST['eum_export_nonce_field']) || !wp_verify_nonce($_POST['eum_export_nonce_field'], 'eum_export_nonce')) {
      // Nonce verification failed, display an error message and halt further processing
      wp_die('Security check failed. Please try again.');
    }

    // Check user capability
    if (!current_user_can('manage_options')) {
      // User does not have the required capability, display an error message and halt further processing
      wp_die('You do not have permission to perform this action.');
    }

    // Generate CSV
    $success = eum_generate_csv($post_types, $include_product_categories, $include_character_count, $publish_status);

    // Check if CSV generation was successful
    if (!$success) {
      // CSV generation failed, display an error message
      wp_die('Failed to generate CSV. Please try again later.');
    }
  }
}

// Function to get Yoast SEO title template for a given post type or taxonomy term
function eum_get_yoast_title_template($entity_type)
{
  switch ($entity_type) {
    case 'page':
      return get_option('wpseo_titles')['title-page'];
    case 'post':
      return get_option('wpseo_titles')['title-post'];
    case 'product':
      return get_option('wpseo_titles')['title-product'];
    case 'product_cat':
      return isset(get_option('wpseo_titles')['title-product_cat']) ? get_option('wpseo_titles')['title-product_cat'] : '';
    default:
      return '';
  }
}

// Function to generate CSV
function eum_generate_csv($post_types, $seo_plugin, $include_post_categories, $include_product_categories, $include_character_count, $publish_status)
{
  // Sanitize post types array
  $post_types = array_map('sanitize_text_field', $post_types);

  // Sanitize include product categories flag
  $include_product_categories = intval($include_product_categories);

  // Sanitize include character count flag
  $include_character_count = intval($include_character_count);

  // Sanitize publish status
  $publish_status = sanitize_text_field($publish_status);

  // Headers for CSV
  $headers = array('Page Title', 'URL', 'Meta Title', 'Meta Description', 'Post Type', 'Publish Status');

  // Check if character count option is checked
  $include_character_count = intval($include_character_count);

  // Add headers for character count columns if option is checked
  if ($include_character_count) {
    $headers[] = 'Meta Title Char. Count';
    $headers[] = 'Meta Description Char. Count';
  }

  // Prepare data for CSV
  $data = array();

  // Include regular posts/pages
  foreach ($post_types as $post_type) {
    $args = array(
      'post_type'      => $post_type,
      'post_status'    => $publish_status,
      'posts_per_page' => -1,
    );
    $posts = get_posts($args);

    foreach ($posts as $post) {
      $title = htmlspecialchars_decode(get_the_title($post->ID)); // Decode HTML entities in title
      $url = get_permalink($post->ID);

      // Get Yoast SEO meta title
      $yoast_meta_title = get_post_meta($post->ID, '_yoast_wpseo_title', true);

      // If Yoast SEO meta title is explicitly set, use it
      if (!empty($yoast_meta_title)) {
        $yoast_meta_title = wpseo_replace_vars(htmlspecialchars_decode($yoast_meta_title), $post); // Decode HTML entities
      } else {
        // If Yoast SEO meta title is not set, generate it based on Yoast settings
        $title_template = eum_get_yoast_title_template($post->post_type);
        $yoast_meta_title = wpseo_replace_vars(htmlspecialchars_decode($title_template), $post); // Decode HTML entities
      }

      $meta_description = get_post_meta($post->ID, '_yoast_wpseo_metadesc', true);

      // Get post type and publish status
      $post_type_label = get_post_type_object($post->post_type)->labels->singular_name;
      $publish_status_label = get_post_status_object($post->post_status)->label;

      $row = array(
        $title,
        $url,
        $yoast_meta_title,
        $meta_description,
        $post_type_label,
        $publish_status_label,
      );

      // Add character counts if option is checked
      if ($include_character_count) {
        $row[] = strlen($yoast_meta_title);
        $row[] = strlen($meta_description);
      }

      $data[] = $row;
    }
  }

  // Include product category pages if checkbox is selected
  if (
    $include_product_categories && in_array('product', $post_types)
  ) {
    // Get product categories
    $product_categories = get_terms(array(
      'taxonomy'   => 'product_cat',
      'hide_empty' => false,
    ));

    // Loop through each product category
    foreach ($product_categories as $category) {
      $category_title = $category->name;
      $category_url = get_term_link($category); // Get category URL

      // Fetch the Yoast SEO meta title for the product category
      $yoast_meta_title = get_term_meta($category->term_id, '_yoast_wpseo_title', true);



      // If Yoast SEO meta title is explicitly set, use it
      if (!empty($yoast_meta_title)) {
        $category_meta_title = wpseo_replace_vars($yoast_meta_title, (array) $category);
      } else {
        // If Yoast SEO meta title is not set, generate it based on Yoast settings
        // $title_template = eum_get_yoast_title_template('product_cat');
        // $category_meta_title = wpseo_replace_vars($title_template, (array) $category);

        $category_meta_title = $yoast_meta_title;
      }

      // Get category description
      $category_description = $category->description;

      // Add category data to the CSV
      $category_row = array(
        $category_title,
        $category_url,
        $category_meta_title, // Meta title
        $category_description,
        'Product Category', // Post type
        'Published', // Publish status (assumed to be published)
      );

      // Add character counts if option is checked
      if ($include_character_count) {
        // Add empty character count placeholders
        $category_row[] = strlen($category_meta_title); // Meta title char. count
        $category_row[] = strlen($category_description); // Meta description char. count
      }

      // Add category row to data array
      $data[] = $category_row;
    }
  }

  // Open output buffer
  ob_start();

  // Output CSV headers
  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="export-urls-and-meta.csv"');

  // Open file handle
  $file = fopen('php://output', 'w');

  // Write headers to CSV
  fputcsv($file, $headers);

  // Write data to CSV
  foreach ($data as $row) {
    fputcsv($file, $row);
  }

  // Close file handle
  fclose($file);

  // Flush output buffer
  ob_flush();
  exit();
}


?>
