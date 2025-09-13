<?php
namespace BooklyStripe\Lib\ProxyProviders;

use Bookly\Lib as BooklyLib;
use BooklyStripe\Backend\Components\Notices;

class Shared extends BooklyLib\Proxy\Shared
{
    /**
     * @inheritDoc
     */
    public static function renderAdminNotices( $bookly_page )
    {
        Notices\ScaUpdate::render();
    }
}