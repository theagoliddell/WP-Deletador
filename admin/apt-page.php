<?php
/**
 * Página de administração do plugin (Apagar Postagens por Tempo)
 *
 * @package Apagar_Postagens_Tempo
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Renderiza a página de opções no admin.
 */
function apt_render_admin_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    $message = '';
    $message_type = '';

    if (isset($_POST['apt_preview']) && check_admin_referer('apt_form', 'apt_nonce')) {
        $result = apt_get_posts_to_delete();
        if (is_wp_error($result)) {
            $message = $result->get_error_message();
            $message_type = 'error';
        } else {
            $message = sprintf(
                __('Seriam afetadas %d postagem(ns) com os critérios atuais.', 'apagar-postagens-tempo'),
                $result
            );
            $message_type = 'info';
        }
    }

    if (isset($_POST['apt_execute']) && check_admin_referer('apt_form', 'apt_nonce')) {
        $deleted = apt_delete_posts();
        if (is_wp_error($deleted)) {
            $message = $deleted->get_error_message();
            $message_type = 'error';
        } else {
            $message = sprintf(
                __('%d postagem(ns) excluída(s) com sucesso.', 'apagar-postagens-tempo'),
                $deleted
            );
            $message_type = 'success';
        }
    }

    $modo = isset($_POST['apt_modo']) ? sanitize_text_field($_POST['apt_modo']) : 'periodo';
    $dias = isset($_POST['apt_dias']) ? absint($_POST['apt_dias']) : 30;
    $horas = isset($_POST['apt_horas']) ? absint($_POST['apt_horas']) : 0;
    $data_limite = isset($_POST['apt_data_limite']) ? sanitize_text_field($_POST['apt_data_limite']) : '';
    $hora_limite = isset($_POST['apt_hora_limite']) ? sanitize_text_field($_POST['apt_hora_limite']) : '00:00';
    $categoria_id = isset($_POST['apt_categoria']) ? absint($_POST['apt_categoria']) : 0;

    $categorias = get_categories(['hide_empty' => false]);

    apt_render_admin_page_html(
        $message,
        $message_type,
        $modo,
        $dias,
        $horas,
        $data_limite,
        $hora_limite,
        $categoria_id,
        $categorias
    );
}

/**
 * Exibe o HTML da página (layout + formulário).
 *
 * @param string $message      Mensagem de feedback.
 * @param string $message_type Tipo: success, error, info.
 * @param string $modo         periodo|data.
 * @param int    $dias         Dias do período.
 * @param int    $horas        Horas do período.
 * @param string $data_limite  Data limite (modo data).
 * @param string $hora_limite  Hora limite (modo data).
 * @param int    $categoria_id ID da categoria (0 = todas).
 * @param array  $categorias   Lista de categorias.
 */
function apt_render_admin_page_html($message, $message_type, $modo, $dias, $horas, $data_limite, $hora_limite, $categoria_id, $categorias) {
    ?>
    <div class="wrap apt-wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

        <?php if ($message) : ?>
            <div class="notice notice-<?php echo esc_attr($message_type); ?> is-dismissible">
                <p><?php echo esc_html($message); ?></p>
            </div>
        <?php endif; ?>

        <?php
        include dirname(__FILE__) . '/views/apt-form.php';
        ?>

        <div class="apt-info">
            <p><strong><?php _e('Atenção:', 'apagar-postagens-tempo'); ?></strong> <?php _e('A exclusão é permanente (não envia para a lixeira). Faça backup antes de usar.', 'apagar-postagens-tempo'); ?></p>
        </div>
    </div>
    <?php
}
