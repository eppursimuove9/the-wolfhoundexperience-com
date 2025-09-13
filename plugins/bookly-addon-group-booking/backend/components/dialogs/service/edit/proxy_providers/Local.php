<?php
namespace BooklyGroupBooking\Backend\Components\Dialogs\Service\Edit\ProxyProviders;

use Bookly\Backend\Components\Dialogs\Service\Edit\Proxy;

class Local extends Proxy\GroupBooking
{
    /**
     * @inheritDoc
     */
    public static function renderSubForm( array $service )
    {
        self::renderTemplate( 'sub_form', compact( 'service' ) );
    }
}