<?php
/*
Plugin Name:  MyPopUps
Plugin URI:   https://mypopups.com/
Description:  Create pop-ups without coding! Our builder allows you to create amazing looking pop-ups for a wide range of purposes (newsletter subscription, discounts, cookies etc.).
Version:      1.1.0
Text-domain:  pop-up-pop-up
Author:       Pop-ups
Author URI:   https://mypopups.com
License:      GPLv3
License URI:  http://www.gnu.org/licenses/gpl-3.0.en.html
*/

define('MYPOPUPS_URL', 'https://mypopups.com');
define('MYPOPUPS_DOMAIN_CHECK_FILE', 'mypopups_domain_check.json');

if (!function_exists('analyst_init')) {
  require_once 'analyst/main.php';
}
analyst_init(array(
  'client-id' => 'o6grd4ebow48kyeq',
  'client-secret' => 'ae54530aa6229bd48abaf85c80e394d3fc373808',
  'base-dir' => __FILE__
));

add_action('plugins_loaded', function () {

  // Deactivation module
  // $mpu_plugin_path = trailingslashit(basename(__DIR__)) . basename(__FILE__);
  // if (isset($GLOBALS['IIEV_PLUGINS_DEACTIVATION'])) {
  //   if (is_array($GLOBALS['IIEV_PLUGINS_DEACTIVATION'])) $GLOBALS['IIEV_PLUGINS_DEACTIVATION'][] = $mpu_plugin_path;
  // } else {
  //   if (!(class_exists('\Inisev\Subs\Inisev_Deactivation') || class_exists('Inisev\Subs\Inisev_Deactivation') || class_exists('Inisev_Deactivation'))) {
  //     require_once __DIR__ . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'deactivation' . DIRECTORY_SEPARATOR . 'deactivation.php';
  //   }
  //   $deactivation_module = new \Inisev\Subs\Inisev_Deactivation($mpu_plugin_path, __DIR__, __FILE__);
  // }

});

// Front area - register scripts
add_action('wp_footer', function ($hook) {
  $_mpu_already = [];
  $options = get_option('wp_mypopups');
  if (empty($options) || (isset($options['list']) && empty($options['list']))) {
    return;
  }
  $options['list'] = array_reverse($options['list']);
  foreach ($options['list'] as $id => $item) {
    $embed = $item['embed_url'];
    $url = $embed;
    $embed = substr($embed, strpos($embed, 'element?sub'));
    if ($item['status'] == 'Enabled' && !in_array($embed, $_mpu_already)) {
      $idT = sanitize_text_field(esc_html($id));
      $urlT = sanitize_text_field(esc_html($url));
      echo '<script src="' . $urlT . '" id="wp_mypopups-' . $idT . '"></script>';
      // wp_enqueue_script('wp_mypopups-' . $id, $url);
      array_push($_mpu_already, $embed);
    }
  }
});

// Admin area
// Register menu
add_action('admin_menu', function () {
  $icon = 'data:image/svg+xml;base64,' . base64_encode('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 245 300" style="enable-background:new 0 0 245 300;" xml:space="preserve"><g><path style="fill:#00B47C;" d="M148.3,257.7c-18.5-0.5-34.8-9.5-45.5-23.1c-5-5.2-8.1-12.3-8.1-20.1V104.1c0-14.9-11.3-27.4-26.1-28.9 l-32-3.2v129.1c0,47.5,37.2,87.6,84.6,88.9c49.2,1.3,89.5-38.1,89.5-87v-6C210.7,231.1,182.6,258.6,148.3,257.7z"/><path style="fill:#028C85;" d="M230.8,48.9l-45.1-37.6c-2.2-1.8-5.3-1.8-7.4,0L133.1,49c-1.7,1.4-1.3,4.1,0.7,4.9c1.9,0.8,4.4,1.7,7.5,2.4 c6.6,1.6,11.4,7.3,11.4,14.1v143.1c0,15.6-11.9,29.1-27.4,30c-8.9,0.5-16.9-3.1-22.5-8.9c10.8,13.6,27,22.6,45.5,23.1  c34.3,0.9,62.5-26.6,62.5-60.7V70.5c0-6.4,5.2-12.7,11.5-14.1c3.2-0.7,5.9-1.7,7.8-2.5C232.1,53,232.5,50.3,230.8,48.9z"/></g></svg>');
  add_menu_page(__('MyPopUps', 'pop-up-pop-up'), __('MyPopUps', 'pop-up-pop-up'), 'manage_options', 'wp-mypopups', 'wp_mypopups_settings_page', '', 100);
});

// Admin page scripts
add_action('admin_enqueue_scripts', function ($hook) {
  if ('toplevel_page_wp-mypopups' == $hook) {
    wp_enqueue_style('wp_mypopups_admin_css', plugins_url('css/admin-style.css', __FILE__));
    wp_enqueue_script('underscore', plugins_url('js/underscore-min.js', __FILE__));
    wp_enqueue_script('wp_mypopups_script', plugins_url('js/admin-script.js', __FILE__));
  }

  wp_enqueue_style('wp_mypopups_icon_css', plugins_url('css/MPU-icon-style.css', __FILE__), [], '2');
});

// Footer text left
add_filter('admin_footer_text', function ($footer_text) {
  $current_screen = get_current_screen();
  if (isset($current_screen->id) && 'toplevel_page_wp-mypopups' == $current_screen->id) {
    $footer_text = sprintf(__('Need help? Go to our <a href="%s">support center</a>.', 'pop-up-pop-up'), MYPOPUPS_URL . '/help');
  }

  return $footer_text;
});

// Footer text right
add_filter('update_footer', function ($footer_text) {
  $current_screen = get_current_screen();
  if (isset($current_screen->id) && 'toplevel_page_wp-mypopups' == $current_screen->id) {
    $footer_text = __('Powered by <b>MyPopUps</b>', 'pop-up-pop-up');
  }

  return $footer_text;
}, 11);

// Redirect to plugin settings page after activation
add_action('admin_init', function () {
  if (get_option('wp_mypopups_do_activation_redirect', false)) {
    delete_option('wp_mypopups_do_activation_redirect');
    wp_redirect(admin_url('admin.php?page=wp-mypopups'));
  }
});

register_activation_hook(__FILE__, function () {
  add_option('wp_mypopups_do_activation_redirect', true);
});

// Save data from ajax query from plugin settings page
add_action('wp_ajax_wp_mypopups', function () {

  if (!is_admin()) {
    die();
  }
  if (!empty($_POST) && isset($_POST['user_id'])) {
    $message = wp_mypopups_add_user_id_to_file_code(sanitize_text_field($_POST['user_id']));
    header('Content-Type: application/json');
    $response = $message ? $message : __('saved', 'pop-up-pop-up');

    echo json_encode(['message' => sanitize_text_field($response)]);

    die();
  }

  if (!empty($_POST) && !empty($_POST['list'])) {
    $options = [
      'list' => []
    ];

    foreach ($_POST['list'] as $key => $popup) {
      $slug = preg_replace("/[^a-z0-9]/", '', $key);
      $popup['slug'] = $slug;
      $options['list'][$slug] = $popup;
    }

    update_option('wp_mypopups', $options);
    header('Content-Type: application/json');
    $options['status'] = __('options saved', 'pop-up-pop-up');
    echo json_encode($options);
    die();
  }

  if (!empty($_POST) && !empty($_POST['agreed'])) {
    if (sanitize_text_field($_POST['agreed']) === 'true') {
      update_option('wp_mypopups_connect', true);
      wp_mypopups_file_code();
    }
  }
});

// Get path of save
function wp_mypopups_get_file_path() {
  if (is_writable(get_home_path())) {
    $path = get_home_path();
  } else if (is_writable(ABSPATH)) {
    $path = ABSPATH;
  } else if (is_writable(__DIR__)) {
    $path = trailingslashit(__DIR__);
  } else {
    $path = get_home_path();
  }

  $file = $path . MYPOPUPS_DOMAIN_CHECK_FILE;
  return $file;
}

// Show plugin settings page
function wp_mypopups_settings_page() {
  $options = get_option('wp_mypopups');
  if (empty($options)) {
    $options = [
      'list' => []
    ];
    update_option('wp_mypopups', $options);
  }
  include plugin_dir_path(__FILE__) . '/views/main.php';
}

// Check or add file to site root
function wp_mypopups_file_code() {
  if (!current_user_can('activate_plugins')) {
    return;
  }
  if (!get_option('wp_mypopups_connect', false)) {
    return;
  }
  $file = wp_mypopups_get_file_path();
  if (file_exists($file)) {
    return;
  }
  $domain = preg_replace("/^www./", '', site_url());
  if (substr($domain, 0, 8) === 'https://') $domain = substr($domain, 8);
  if (substr($domain, 0, 7) === 'http://') $domain = substr($domain, 7);
  $response = wp_remote_get(MYPOPUPS_URL . '/api/domains/get-code/' . $domain, [ 'sslverify' => false ]);
  $message = false;
  if ($response) {
    $body = json_decode($response['body'], true);
    if ($body['success']) {
      $uuid = $body['code'];
      $fp = fopen($file, 'w');
      if ($fp) {
        fwrite($fp, json_encode(["code" => $uuid]));
        fclose($fp);
      } else {
        $message = __('Please check permission, I could not save this file: ', 'pop-up-pop-up') . $file;
      }
    } else {
      $message = $body['message'];
    }
  } else {
    $message = __('Server not return domain code', 'pop-up-pop-up');
  }

  return $message;
}

// delete code file from site on plugin deactivation or uninstall
function wp_mypopups_delete_file_code() {
  if (!current_user_can('activate_plugins')) {
    return;
  }
  $file = wp_mypopups_get_file_path();
  delete_option('wp_mypopups');
  delete_option('wp_mypopups_connect');
  if (file_exists($file)) {
    unlink($file);
  }
}

register_uninstall_hook(__FILE__, "wp_mypopups_delete_file_code");
register_deactivation_hook(__FILE__, "wp_mypopups_delete_file_code");

// add user id to code file
function wp_mypopups_add_user_id_to_file_code($id) {
  $file = wp_mypopups_get_file_path();
  if (!file_exists($file)) {
    return;
  }
  $content = file_get_contents($file);

  try {
    $json_data = json_decode($content, true);
  } catch (Exception $e) {
    $json_data = false;
  }
  $message = false;
  if ($json_data and is_array($json_data)) {
    $json_data['id'] = $id;
    $fp = fopen($file, 'w');
    if ($fp) {
      fwrite($fp, json_encode($json_data));
      fclose($fp);
    } else {
      $message = __('Please check permission, I could not save this file: ', 'pop-up-pop-up') . $file;
    }
  }

  return $message;
}

// Include footer banner
include_once trailingslashit(__DIR__) . 'modules/banner/misc.php';

// Review banner
add_action('plugins_loaded', function () {

  if (!(class_exists('Inisev\Subs\Inisev_Review') || class_exists('Inisev_Review'))) require_once __DIR__ . '/modules/review/review.php';
  $review_banner = new \Inisev\Subs\Inisev_Review(__FILE__, __DIR__, 'pop-up-pop-up', 'MyPopUps', 'https://bit.ly/3xbZfIW', 'wp-mypopups');

});
