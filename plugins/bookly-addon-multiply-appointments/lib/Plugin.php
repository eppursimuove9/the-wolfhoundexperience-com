<?php
namespace BooklyMultiplyAppointments\Lib;

use Bookly\Lib as BooklyLib;
use BooklyMultiplyAppointments\Backend;
use BooklyMultiplyAppointments\Frontend;
use BooklyMultiplyAppointments\Backend\Components;

abstract class Plugin extends BooklyLib\Base\Plugin
{
    protected static $prefix;
    protected static $title;
    protected static $version;
    protected static $slug;
    protected static $directory;
    protected static $main_file;
    protected static $basename;
    protected static $text_domain;
    protected static $root_namespace;
    protected static $embedded;

    /**
     * @inheritDoc
     */
    public static function init()
    {
        // Init proxy.
        Backend\Modules\Appearance\ProxyProviders\Local::init();
        Backend\Modules\Appearance\ProxyProviders\Shared::init();
        Backend\Modules\Settings\ProxyProviders\Shared::init();
        Components\TinyMce\ProxyProviders\Shared::init();

        Frontend\Modules\Booking\ProxyProviders\Shared::init();
    }

}