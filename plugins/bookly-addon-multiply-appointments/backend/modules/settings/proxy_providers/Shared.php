<?php
namespace BooklyMultiplyAppointments\Backend\Modules\Settings\ProxyProviders;

use Bookly\Backend\Modules\Settings\Proxy;

class Shared extends Proxy\Shared
{
    /**
     * @inheritDoc
     */
    public static function renderAdditionalSettings()
    {
        self::renderTemplate( 'additional_settings' );
    }

    /**
     * @inheritDoc
     */
    public static function saveSettings( array $alert, $tab, array $params )
    {
        if ( $tab == 'additional' ) {
            $options = array( 'bookly_multiply_appointments_quantity_max' );
            foreach ( $options as $option_name ) {
                if ( array_key_exists( $option_name, $params ) ) {
                    update_option( $option_name, $params[ $option_name ] );
                }
            }
        }

        return $alert;
    }
}