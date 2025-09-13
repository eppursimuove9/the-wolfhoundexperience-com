<?php
namespace BooklyChainAppointments\Backend\Modules\Appearance\ProxyProviders;

use Bookly\Backend\Modules\Appearance\Proxy;

/**
 * Class Local
 * @package BooklyChainAppointments\Backend\Modules\Appearance\ProxyProviders
 */
class Local extends Proxy\ChainAppointments
{
    /**
     * @inheritDoc
     */
    public static function renderChainTip()
    {
        self::renderTemplate( 'appearance' );
    }

    /**
     * @inheritDoc
     */
    public static function renderBookMore()
    {
        self::renderTemplate( 'book_more' );
    }
}