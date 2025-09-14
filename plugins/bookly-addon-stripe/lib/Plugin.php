<?php
namespace BooklyStripe\Lib;

use Bookly\Lib as BooklyLib;
use BooklyStripe\Backend;
use BooklyStripe\Backend\Components as BackendComponents;
use BooklyStripe\Frontend;

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
    protected static function init()
    {
        // Register proxy methods.
        Backend\Modules\Settings\ProxyProviders\Shared::init();
        if ( get_option( 'bookly_stripe_enabled' ) ) {
            Backend\Modules\Appearance\ProxyProviders\Shared::init();
            Frontend\Modules\Booking\ProxyProviders\Shared::init();
            Payment\ProxyProviders\Shared::init();
        }
        ProxyProviders\Shared::init();
    }

    /**
     * @inheriDoc
     */
    protected static function registerAjax()
    {
        if ( get_option( 'bookly_stripe_enabled' ) ) {
            Frontend\Modules\Stripe\Ajax::init();
        }
        BackendComponents\Notices\ScaUpdateAjax::init();
    }
}