<?php defined( 'ABSPATH' ) || exit; // Exit if accessed directly
use Bookly\Backend\Components\Settings\Inputs;
?>
<div class="card bookly-collapse-with-arrow">
    <div class="card-header d-flex align-items-center">
        <a href="#bookly_add-multiply-appointments" class="ml-2 bookly-collapsed" role="button" data-toggle="bookly-collapse" aria-expanded="false">
            <?php _e( 'Multiply Appointments', 'bookly' ) ?>
        </a>
    </div>
    <div id="bookly_add-multiply-appointments" class="bookly-collapse">
        <div class="card-body pb-0">
            <?php Inputs::renderNumber( 'bookly_multiply_appointments_quantity_max', __( 'Max quantity', 'bookly' ), __( 'Set maximum value for Quantity field.', 'bookly' ), 1, 1 ) ?>
        </div>
    </div>
</div>