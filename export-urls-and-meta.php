<?php
/*
Plugin Name: Export URLs and Meta
Description: Custom WordPress plugin to export a CSV file of all published pages with their titles, URLs, and meta descriptions.
Version: 0.0.1
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

// Add plugin functionality here

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
  // Check if character count option is checked
  $character_count_checked = isset($_POST['eum_character_count']) && $_POST['eum_character_count'] == 1 ? 'checked' : '';
?>
  <div class="wrap">
    <h1>Export URLs and Meta</h1>
    <p>Click the button below to export a CSV file containing URLs and meta descriptions of all published pages.</p>
    <form method="post" action="">
      <input type="hidden" name="eum_export_csv" value="1">
      <?php wp_nonce_field('eum_export_nonce', 'eum_export_nonce_field'); ?>
      <label for="eum_character_count">
        <input type="checkbox" id="eum_character_count" name="eum_character_count" value="1" <?php echo $character_count_checked; ?>>
        Add character count for titles and descriptions
      </label>
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
    // Check nonce for security
    if (!isset($_POST['eum_export_nonce_field']) || !wp_verify_nonce($_POST['eum_export_nonce_field'], 'eum_export_nonce')) {
      return;
    }

    // Check user capability
    if (!current_user_can('manage_options')) {
      return;
    }

    // Generate CSV
    eum_generate_csv();
  }
}

// Function to generate CSV
function eum_generate_csv()
{
  // Headers for CSV
  $headers = array('Title', 'URL', 'Meta Description');

  // Check if character count option is checked
  $include_character_count = isset($_POST['eum_character_count']) && $_POST['eum_character_count'] == 1;

  // Update headers if character count is included
  if ($include_character_count) {
    $headers[] = 'Title Character Count';
    $headers[] = 'Meta Description Character Count';
  }

  // Get all published pages
  $args = array(
    'post_type'      => 'page',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
  );
  $pages = get_posts($args);

  // Prepare data for CSV
  $data = array();
  foreach ($pages as $page) {
    $title = get_the_title($page->ID);
    $url = get_permalink($page->ID);
    $meta_description = get_post_meta($page->ID, '_yoast_wpseo_metadesc', true);

    // Calculate character counts if option is checked
    $title_character_count = $include_character_count ? strlen($title) : '';
    $description_character_count = $include_character_count ? strlen($meta_description) : '';

    $row = array(
      $title,
      $url,
      $meta_description,
    );

    // Add character counts to row if option is checked
    if ($include_character_count) {
      $row[] = $title_character_count;
      $row[] = $description_character_count;
    }

    $data[] = $row;
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
