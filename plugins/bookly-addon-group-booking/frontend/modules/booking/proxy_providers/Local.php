<?php
namespace BooklyGroupBooking\Frontend\Modules\Booking\ProxyProviders;

use Bookly\Lib as BooklyLib;
use Bookly\Frontend\Modules\Booking\Proxy;

abstract class Local extends Proxy\GroupBooking
{
    /**
     * @inheritDoc
     */
    public static function getTimeSlotText( BooklyLib\Slots\Range $slot )
    {
        $text = '';
        if ( get_option( 'bookly_group_booking_app_show_nop', 0 ) && ! $slot->fullyBooked() && $slot->capacity() > 1 ) {
            switch ( get_option( 'bookly_group_booking_nop_format', 'busy' ) ) {
                case 'busy':
                    $text = sprintf( '[%s/%s]', $slot->maxNop(), $slot->capacity() );
                    break;
                case 'free':
                    $text = sprintf( '[%s]', max( 0, $slot->capacity() - $slot->maxNop() ) );
            }
        }

        return $text;
    }
}