<?php
/**
 * Plugin Name: WP Deletador
 * Plugin URI: https://quartaseries.com
 * Description: A lightweight and efficient WordPress plugin designed to help administrators perform bulk cleanup of old posts based on specific time and category criteria.
 * Version: 1.0.0
 * Author: Theago Liddell
 * Author URI: https://quartaseries.com
 * License: MIT License
 * Text Domain: apagar-postagens-tempo
 */

if (!defined('ABSPATH')) {
    exit;
}

$apt_plugin_dir = plugin_dir_path(__FILE__);
$apt_plugin_url = plugin_dir_url(__FILE__);

require_once $apt_plugin_dir . 'includes/apt-constants.php';
require_once $apt_plugin_dir . 'includes/apt-cutoff.php';
require_once $apt_plugin_dir . 'includes/apt-query.php';
require_once $apt_plugin_dir . 'admin/apt-menu.php';
require_once $apt_plugin_dir . 'admin/apt-page.php';

define('APT_PATH', $apt_plugin_dir);
define('APT_URL', $apt_plugin_url);

add_action('admin_menu', 'apt_register_menu');
add_action('admin_enqueue_scripts', 'apt_admin_assets');
