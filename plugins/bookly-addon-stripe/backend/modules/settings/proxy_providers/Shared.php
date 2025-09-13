<?php
namespace BooklyStripe\Backend\Modules\Settings\ProxyProviders;

use Bookly\Backend\Modules\Settings\Proxy;
use Bookly\Lib\Entities\Payment;

class Shared extends Proxy\Shared
{
    /**
     * @inheritDoc
     */
    public static function preparePaymentGatewaySettings( $payment_data )
    {
        $type = Payment::TYPE_STRIPE;
        $payment_data[ $type ] = self::renderTemplate( 'payment_settings', compact( 'type' ), false );

        return $payment_data;
    }

    /**
     * @inheritDoc
     */
    public static function saveSettings( array $alert, $tab, array $params )
    {
        if ( $tab == 'payments' ) {
            $options = array(
                'bookly_stripe_enabled',
                'bookly_stripe_publishable_key',
                'bookly_stripe_secret_key',
                'bookly_stripe_increase',
                'bookly_stripe_addition',
                'bookly_stripe_timeout'
            );
            foreach ( $options as $option_name ) {
                if ( array_key_exists( $option_name, $params ) ) {
                    update_option( $option_name, trim( $params[ $option_name ] ) );
                }
            }
        }
    }
}