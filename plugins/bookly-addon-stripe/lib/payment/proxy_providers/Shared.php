<?php
namespace BooklyStripe\Lib\Payment\ProxyProviders;

use Bookly\Frontend\Modules\Payment;
use Bookly\Lib\Payment\Proxy;
use Bookly\Lib\Entities;
use Bookly\Lib\CartInfo;
use BooklyStripe\Lib\Payment\StripeGateway;

class Shared extends Proxy\Shared
{
    /**
     * @inerhitDoc
     */
    public static function getGatewayByName( $gateway, Payment\Request $request )
    {
        if ( $gateway === Entities\Payment::TYPE_STRIPE ) {
            return new StripeGateway( $request );
        }

        return $gateway;
    }

    /**
     * @inheritDoc
     */
    public static function paymentSpecificPriceExists( $gateway )
    {
        if ( $gateway === Entities\Payment::TYPE_STRIPE ) {
            return self::showPaymentSpecificPrices( false );
        }

        return $gateway;
    }

    /**
     * @inheritDoc
     */
    public static function applyGateway( CartInfo $cart_info, $gateway )
    {
        if ( $gateway === Entities\Payment::TYPE_STRIPE ) {
            $cart_info->setGateway( $gateway );
        }

        return $cart_info;
    }

    /**
     * @inheritDoc
     */
    public static function prepareOutdatedUnpaidPayments( $payments )
    {
        $timeout = (int) get_option( 'bookly_stripe_timeout' );
        if ( $timeout ) {
            $payments = array_merge( $payments, Entities\Payment::query()
                ->where( 'type', Entities\Payment::TYPE_STRIPE )
                ->where( 'status', Entities\Payment::STATUS_PENDING )
                ->whereLt( 'created_at', date_create( current_time( 'mysql' ) )->modify( sprintf( '- %s seconds', $timeout ) )->format( 'Y-m-d H:i:s' ) )
                ->fetchCol( 'id' )
            );
        }

        return $payments;
    }

    /**
     * @inheritDoc
     */
    public static function showPaymentSpecificPrices( $show )
    {
        return $show ?: ( get_option( 'bookly_stripe_increase' ) != 0 || get_option( 'bookly_stripe_addition' ) != 0 );
    }
}