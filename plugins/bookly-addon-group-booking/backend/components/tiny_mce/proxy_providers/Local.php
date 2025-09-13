<?php
namespace BooklyGroupBooking\Backend\Components\TinyMce\ProxyProviders;

use Bookly\Backend\Components\TinyMce\Proxy;

class Local extends Proxy\GroupBooking
{
    /**
     * @inheritDoc
     */
    public static function renderStaffCabinetSettings()
    {
        self::renderTemplate( 'staff_cabinet' );
    }
}