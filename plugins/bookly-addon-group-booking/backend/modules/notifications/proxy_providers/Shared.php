<?php
namespace BooklyGroupBooking\Backend\Modules\Notifications\ProxyProviders;

use Bookly\Backend\Modules\Notifications\Proxy;

class Shared extends Proxy\Shared
{
    /**
     * @inheritDoc
     */
    public static function prepareNotificationCodes( array $codes, $type )
    {
        $codes['customer_appointment']['number_of_persons'] = array( 'description' => __( 'Number of persons', 'bookly' ) );

        return $codes;
    }
}