<?php
namespace BooklyGroupBooking\Backend\Modules\Appearance\ProxyProviders;

use Bookly\Backend\Modules\Appearance\Proxy;

class Local extends Proxy\GroupBooking
{
    /**
     * @inheritDoc
     */
    public static function renderNOP()
    {
        self::renderTemplate( 'nop' );
    }
}