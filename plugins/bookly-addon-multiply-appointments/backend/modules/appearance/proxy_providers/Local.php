<?php
namespace BooklyMultiplyAppointments\Backend\Modules\Appearance\ProxyProviders;

use Bookly\Backend\Modules\Appearance\Proxy;
use BooklyMultiplyAppointments\Lib;

class Local extends Proxy\MultiplyAppointments
{
    /**
     * @inheritDoc
     */
    public static function renderQuantity()
    {
        self::renderTemplate( 'quantity', array( 'quantity_max' => get_option( 'bookly_multiply_appointments_quantity_max' ) ) );
    }
}