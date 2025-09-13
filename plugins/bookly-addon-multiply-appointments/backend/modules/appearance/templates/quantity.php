<?php defined( 'ABSPATH' ) || exit; // Exit if accessed directly
use Bookly\Backend\Components\Editable\Elements;
?>
<div class="bookly-form-group bookly-js-quantity">
    <?php Elements::renderLabel( array( 'bookly_l10n_label_multiply', ) ) ?>
    <div class="bookly-form-field">
        <select class="bookly-select-mobile bookly-js-select-quantity">
            <?php for ( $i = 1; $i <= $quantity_max; $i ++ ) : ?>
                <option><?php echo $i ?></option>
            <?php endfor ?>
        </select>
    </div>
</div>