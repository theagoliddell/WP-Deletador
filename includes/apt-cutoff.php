<?php
/**
 * Cálculo da data/hora limite para exclusão (Apagar Postagens por Tempo)
 *
 * @package Apagar_Postagens_Tempo
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Calcula a data/hora "antes de" com base no modo e nos campos do formulário.
 *
 * @return string|WP_Error Data no formato Y-m-d H:i:s ou erro.
 */
function apt_get_cutoff_datetime() {
    $modo = isset($_POST['apt_modo']) ? sanitize_text_field($_POST['apt_modo']) : 'periodo';
    $dias = isset($_POST['apt_dias']) ? absint($_POST['apt_dias']) : 30;
    $horas = isset($_POST['apt_horas']) ? absint($_POST['apt_horas']) : 0;
    $data_limite = isset($_POST['apt_data_limite']) ? sanitize_text_field($_POST['apt_data_limite']) : '';
    $hora_limite = isset($_POST['apt_hora_limite']) ? sanitize_text_field($_POST['apt_hora_limite']) : '00:00';

    if ($modo === 'data') {
        if (empty($data_limite)) {
            return new WP_Error('apt_invalid', __('Informe a data limite.', 'apagar-postagens-tempo'));
        }
        $str = $data_limite . ' ' . ($hora_limite ?: '00:00');
        $ts = strtotime($str);
        if ($ts === false) {
            return new WP_Error('apt_invalid', __('Data ou hora inválida.', 'apagar-postagens-tempo'));
        }
        return date('Y-m-d H:i:s', $ts);
    }

    $total_horas = ($dias * 24) + $horas;
    if ($total_horas <= 0) {
        return new WP_Error('apt_invalid', __('Informe um período maior que zero.', 'apagar-postagens-tempo'));
    }
    return date('Y-m-d H:i:s', strtotime("-{$total_horas} hours"));
}
