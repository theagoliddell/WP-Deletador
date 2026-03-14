<?php
/**
 * Plugin Name: Apagar Postagens por Tempo
 * Plugin URI: https://example.com
 * Description: Apaga postagens após um período configurável, com opção de filtrar por categoria. Inclui painel para definir data/hora e visualizar impacto.
 * Version: 1.0.0
 * Author: Plugin WP
 * Author URI: https://example.com
 * License: GPL v2 or later
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
