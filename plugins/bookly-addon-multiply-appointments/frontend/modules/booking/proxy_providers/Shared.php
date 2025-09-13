<?php
namespace BooklyMultiplyAppointments\Frontend\Modules\Booking\ProxyProviders;

use Bookly\Frontend\Modules\Booking\Proxy;
use Bookly\Lib as BooklyLib;

class Shared extends Proxy\Shared
{
    /**
     * @inheritDoc
     */
    public static function stepOptions( $options, $step, $userData )
    {
        if ( $step == 'service' ) {
            $options['l10n']['quantity_label'] = BooklyLib\Utils\Common::getTranslatedOption( 'bookly_l10n_label_multiply' );
            $options['max_quantity'] = get_option( 'bookly_multiply_appointments_quantity_max' );
        }

        return $options;
    }
}