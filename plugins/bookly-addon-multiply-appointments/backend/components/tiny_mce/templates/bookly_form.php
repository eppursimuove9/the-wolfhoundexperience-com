<?php defined( 'ABSPATH' ) || exit; // Exit if accessed directly ?>
<tr>
    <td>
        <label for="bookly-hide-quantity"><?php echo esc_html( get_option( 'bookly_l10n_label_multiply' ) ) ?></label>
    </td>
    <td>
        <div class="checkbox">
            <label>
                <input type="checkbox" id="bookly-hide-quantity">
                <?php esc_html_e( 'Hide this field', 'bookly' ) ?>
            </label>
        </div>
    </td>
</tr>