<?php
namespace BooklyMultiplyAppointments\Backend\Components\TinyMce\ProxyProviders;

use Bookly\Backend\Components\TinyMce\Proxy;

class Shared extends Proxy\Shared
{
    /**
     * @inheritDoc
     */
    public static function renderBooklyFormFields()
    {
        self::renderTemplate( 'bookly_form' );
    }
}