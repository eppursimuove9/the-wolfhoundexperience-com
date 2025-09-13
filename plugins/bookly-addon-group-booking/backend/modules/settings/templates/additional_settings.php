<?php defined( 'ABSPATH' ) || exit; // Exit if accessed directly
use Bookly\Backend\Components\Settings\Selects;
?>
<div class="card bookly-collapse-with-arrow">
    <div class="card-header d-flex align-items-center">
        <a href="#bookly_add-group-booking" class="ml-2 bookly-collapsed" role="button" data-toggle="bookly-collapse" aria-expanded="false">
            <?php _e( 'Group Booking', 'bookly' ) ?>
        </a>
    </div>
    <div id="bookly_add-group-booking" class="bookly-collapse">
        <div class="card-body pb-0">
            <?php Selects::renderSingle( 'bookly_group_booking_nop_format', __( 'Group bookings information format', 'bookly' ), __( 'Select format for displaying the time slot occupancy for group bookings.', 'bookly' ), array(
                array( 'busy', __( '[Booked/Max capacity]', 'bookly' ) ),
                array( 'free', __( '[Available left]', 'bookly' ) ),
            ) ) ?>
        </div>

    </div>
</div>