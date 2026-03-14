<?php
/**
 * Template do formulário de critérios (Apagar Postagens por Tempo)
 *
 * @package Apagar_Postagens_Tempo
 * @var string $modo
 * @var int    $dias
 * @var int    $horas
 * @var string $data_limite
 * @var string $hora_limite
 * @var int    $categoria_id
 * @var array  $categorias
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="apt-panel">
    <form method="post" action="" id="apt-form">
        <?php wp_nonce_field('apt_form', 'apt_nonce'); ?>

        <h2 class="apt-title"><?php _e('Critérios de exclusão', 'apagar-postagens-tempo'); ?></h2>

        <table class="form-table">
            <tr>
                <th scope="row"><?php _e('Modo', 'apagar-postagens-tempo'); ?></th>
                <td>
                    <fieldset>
                        <label>
                            <input type="radio" name="apt_modo" value="periodo" <?php checked($modo, 'periodo'); ?> />
                            <?php _e('Mais antigas que um período', 'apagar-postagens-tempo'); ?>
                        </label>
                        <br />
                        <label>
                            <input type="radio" name="apt_modo" value="data" <?php checked($modo, 'data'); ?> />
                            <?php _e('Publicadas antes de uma data/hora', 'apagar-postagens-tempo'); ?>
                        </label>
                    </fieldset>
                </td>
            </tr>
            <tr class="apt-row-periodo" style="<?php echo $modo === 'data' ? 'display:none' : ''; ?>">
                <th scope="row"><?php _e('Período', 'apagar-postagens-tempo'); ?></th>
                <td>
                    <label>
                        <input type="number" name="apt_dias" value="<?php echo esc_attr($dias); ?>" min="0" class="small-text" /> <?php _e('dias', 'apagar-postagens-tempo'); ?>
                    </label>
                    &nbsp;
                    <label>
                        <input type="number" name="apt_horas" value="<?php echo esc_attr($horas); ?>" min="0" max="23" class="small-text" /> <?php _e('horas', 'apagar-postagens-tempo'); ?>
                    </label>
                    <p class="description"><?php _e('Postagens publicadas há mais tempo que esse período serão excluídas.', 'apagar-postagens-tempo'); ?></p>
                </td>
            </tr>
            <tr class="apt-row-data" style="<?php echo $modo === 'periodo' ? 'display:none' : ''; ?>">
                <th scope="row"><?php _e('Data e hora limite', 'apagar-postagens-tempo'); ?></th>
                <td>
                    <label>
                        <input type="date" name="apt_data_limite" value="<?php echo esc_attr($data_limite); ?>" />
                    </label>
                    <label>
                        <input type="time" name="apt_hora_limite" value="<?php echo esc_attr($hora_limite); ?>" />
                    </label>
                    <p class="description"><?php _e('Postagens publicadas antes dessa data/hora serão excluídas.', 'apagar-postagens-tempo'); ?></p>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php _e('Categoria', 'apagar-postagens-tempo'); ?></th>
                <td>
                    <select name="apt_categoria">
                        <option value="0" <?php selected($categoria_id, 0); ?>><?php _e('Todas as categorias', 'apagar-postagens-tempo'); ?></option>
                        <?php foreach ($categorias as $cat) : ?>
                            <option value="<?php echo esc_attr($cat->term_id); ?>" <?php selected($categoria_id, $cat->term_id); ?>>
                                <?php echo esc_html($cat->name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="description"><?php _e('Restrinja a uma categoria ou aplique a todas.', 'apagar-postagens-tempo'); ?></p>
                </td>
            </tr>
        </table>

        <p class="submit">
            <input type="submit" name="apt_preview" class="button button-secondary" value="<?php esc_attr_e('Quantas postagens seriam afetadas?', 'apagar-postagens-tempo'); ?>" formnovalidate />
            <input type="submit" name="apt_execute" class="button button-primary" value="<?php esc_attr_e('Executar exclusão', 'apagar-postagens-tempo'); ?>" onclick="return confirm('<?php echo esc_js(__('Tem certeza? Esta ação não pode ser desfeita.', 'apagar-postagens-tempo')); ?>');" />
        </p>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('apt-form');
    if (!form) return;
    var rowPeriodo = form.querySelector('.apt-row-periodo');
    var rowData = form.querySelector('.apt-row-data');
    function toggle() {
        var modo = form.querySelector('input[name="apt_modo"]:checked').value;
        rowPeriodo.style.display = modo === 'periodo' ? '' : 'none';
        rowData.style.display = modo === 'data' ? '' : 'none';
    }
    form.querySelectorAll('input[name="apt_modo"]').forEach(function(r) { r.addEventListener('change', toggle); });
});
</script>
