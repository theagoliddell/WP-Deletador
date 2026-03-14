<?php
/**
 * Menu e assets do admin (Apagar Postagens por Tempo)
 *
 * @package Apagar_Postagens_Tempo
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Registra menu e página de opções no admin.
 */
function apt_register_menu() {
    add_options_page(
        __('Apagar Postagens por Tempo', 'apagar-postagens-tempo'),
        __('Apagar Postagens', 'apagar-postagens-tempo'),
        'manage_options',
        APT_SLUG,
        'apt_render_admin_page'
    );
}

/**
 * Enfileira estilos e scripts no admin.
 *
 * @param string $hook Sufixo do hook da página atual.
 */
function apt_admin_assets($hook) {
    if (strpos($hook, APT_SLUG) === false) {
        return;
    }
    wp_enqueue_style(
        'apt-admin',
        APT_URL . 'admin.css',
        [],
        APT_VERSION
    );
}
