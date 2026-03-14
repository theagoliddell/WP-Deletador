<?php
/**
 * Query e exclusão de postagens (Apagar Postagens por Tempo)
 *
 * @package Apagar_Postagens_Tempo
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Monta os argumentos da WP_Query para as postagens a excluir.
 *
 * @return array|WP_Error Argumentos para WP_Query ou erro.
 */
function apt_build_query_args() {
    $cutoff = apt_get_cutoff_datetime();
    if (is_wp_error($cutoff)) {
        return $cutoff;
    }

    $categoria_id = isset($_POST['apt_categoria']) ? absint($_POST['apt_categoria']) : 0;

    $args = [
        'post_type'      => 'post',
        'post_status'    => ['publish', 'draft', 'private', 'pending'],
        'posts_per_page' => -1,
        'fields'         => 'ids',
        'date_query'     => [
            [
                'before'    => $cutoff,
                'inclusive' => false,
            ],
        ],
    ];

    if ($categoria_id > 0) {
        $args['cat'] = $categoria_id;
    }

    return $args;
}

/**
 * Retorna a quantidade de postagens que seriam excluídas (preview).
 *
 * @return int|WP_Error Número de postagens ou erro.
 */
function apt_get_posts_to_delete() {
    $args = apt_build_query_args();
    if (is_wp_error($args)) {
        return $args;
    }
    $query = new WP_Query($args);
    return $query->found_posts;
}

/**
 * Exclui as postagens conforme os critérios do formulário.
 *
 * @return int|WP_Error Número de postagens excluídas ou erro.
 */
function apt_delete_posts() {
    $args = apt_build_query_args();
    if (is_wp_error($args)) {
        return $args;
    }

    $query = new WP_Query($args);
    $ids = $query->posts;
    $count = 0;

    foreach ($ids as $post_id) {
        $deleted = wp_delete_post($post_id, true);
        if ($deleted) {
            $count++;
        }
    }

    return $count;
}
