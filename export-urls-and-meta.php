<?php
/*
Plugin Name: Export URLs and Meta
Description: Custom WordPress plugin to export a CSV file of all published pages with their titles, URLs, and meta descriptions.
Version: 0.0.3
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

// Add admin menu
function eum_add_admin_menu()
{
  add_submenu_page(
    'options-general.php',     // Parent menu slug (Settings)
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
  // Check if WooCommerce is active
  $woocommerce_active = class_exists('WooCommerce');

  // Check if checkboxes are checked
  $post_types = isset($_POST['eum_post_types']) ? $_POST['eum_post_types'] : array();
  $include_product_categories = isset($_POST['eum_include_product_categories']) && $_POST['eum_include_product_categories'] == 1;
  $include_character_count = isset($_POST['eum_character_count']) && $_POST['eum_character_count'] == 1;
  $publish_status = isset($_POST['eum_publish_status']) ? $_POST['eum_publish_status'] : 'publish';
?>
  <div class="wrap">
    <h1>Export URLs and Meta</h1>
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

// Function to generate CSV
function
eum_generate_csv($post_types, $include_product_categories, $include_character_count, $publish_status)
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

  // // Get selected post types
  // $post_types = isset($_POST['eum_post_types']) ? $_POST['eum_post_types'] : array();

  // // Get publish status
  // $publish_status = isset($_POST['eum_publish_status']) ? $_POST['eum_publish_status'] : 'publish';

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
      $title = get_the_title($post->ID);
      $url = get_permalink($post->ID);

      // Get Yoast SEO meta title
      $yoast_meta_title = get_post_meta($post->ID, '_yoast_wpseo_title', true);

      // If Yoast SEO meta title is explicitly set, use it
      if (!empty($yoast_meta_title)) {
        // $yoast_meta_title = $yoast_meta_title;
        $yoast_meta_title = wpseo_replace_vars(get_post_meta($post->ID, '_yoast_wpseo_title', true), $post);
      } else {
        // If Yoast SEO meta title is not set, generate it based on Yoast settings
        if (empty($yoast_meta_title)) {
          // Get the Yoast SEO title template for the post type (page, post, product)
          if ($post->post_type === 'page') {
            $title_template = get_option('wpseo_titles')['title-page'];
          } elseif ($post->post_type === 'post') {
            $title_template = get_option('wpseo_titles')['title-post'];
          } elseif ($post->post_type === 'product') {
            $title_template = get_option('wpseo_titles')['title-product'];
          } else {
            // Handle other post types if necessary
            $title_template = ''; // Set default value
          }

          // Generate the Yoast SEO title using the template and post data
          $yoast_meta_title = wpseo_replace_vars($title_template, $post);
        }
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
