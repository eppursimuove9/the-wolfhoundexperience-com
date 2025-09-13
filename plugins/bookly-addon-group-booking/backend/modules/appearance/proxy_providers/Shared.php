<?php
namespace BooklyGroupBooking\Backend\Modules\Appearance\ProxyProviders;

use Bookly\Backend\Modules\Appearance\Proxy;
use BooklyGroupBooking\Lib;

class Shared extends Proxy\Shared
{
    /**
     * @inheritDoc
     */
    public static function prepareOptions( array $options_to_save, array $options )
    {
        return array_merge( $options_to_save, array_intersect_key( $options, array_flip( array(
            'bookly_group_booking_app_show_nop',
            'bookly_l10n_label_number_of_persons',
        ) ) ) );
    }

    /**
     * @inheritDoc
     */
    public static function renderTimeStepSettings()
    {
        self::renderTemplate( 'time_step_settings' );
    }

    /**
     * @inheritDoc
     */
    public static function prepareCodes( array $codes )
    {
        $codes['appointments']['loop']['codes']['number_of_persons'] = array( 'description' => __( 'Number of persons', 'bookly' ), 'if' => true );

        return array_merge( $codes, array(
            'number_of_persons' => array( 'description' => __( 'Number of persons', 'bookly' ) ),
        ) );
    }
}