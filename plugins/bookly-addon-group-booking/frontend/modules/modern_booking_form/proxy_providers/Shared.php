<?php
namespace BooklyGroupBooking\Frontend\Modules\ModernBookingForm\ProxyProviders;

use Bookly\Lib as BooklyLib;

class Shared extends \Bookly\Frontend\Modules\ModernBookingForm\Proxy\Shared
{
    /**
     * @inheritDoc
     */
    public static function prepareAppearanceData( array $bookly_options )
    {
        $bookly_options['fields']['show_nop_on_slots'] = __( 'Show information about group bookings', 'bookly' );
        $bookly_options['fields']['capacity'] = __( 'Capacity', 'bookly' );
        $bookly_options['fields']['capacity_busy'] = __( 'Busy', 'bookly' );
        $bookly_options['fields']['capacity_free'] = __( 'Free', 'bookly' );

        return $bookly_options;
    }

    /**
     * @inheritDoc
     */
    public static function prepareAppearance( array $bookly_options )
    {
        $bookly_options['show_nop'] = isset( $bookly_options['show_nop'] ) ? (bool) $bookly_options['show_nop'] : true;
        $bookly_options['show_nop_on_slots'] = false;
        $bookly_options['l10n']['nop'] = __( 'Number of persons', 'bookly' );
        $bookly_options['l10n']['capacity'] = __( 'Capacity', 'bookly' );
        $bookly_options['l10n']['capacity_busy'] = __( 'Busy', 'bookly' );
        $bookly_options['l10n']['capacity_free'] = __( 'Free', 'bookly' );

        return $bookly_options;
    }

    /**
     * @inerhitDoc
     */
    public static function prepareFormOptions( array $bookly_options )
    {
        $bookly_options['nop_format'] = get_option( 'bookly_group_booking_nop_format', 'busy' );

        return $bookly_options;
    }
}