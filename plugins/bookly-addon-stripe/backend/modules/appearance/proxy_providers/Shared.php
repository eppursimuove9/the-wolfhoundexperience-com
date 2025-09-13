<?php
namespace BooklyStripe\Backend\Modules\Appearance\ProxyProviders;

use Bookly\Backend\Modules\Appearance\Proxy;
use Bookly\Lib\Entities\Payment;

class Shared extends Proxy\Shared
{
    /**
     * @inheritDoc
     */
    public static function paymentGateways( $data )
    {
        $data[ Payment::TYPE_STRIPE ] = array(
            'label_option_name' => 'bookly_l10n_label_pay_stripe',
            'title' => 'Stripe',
            'with_card' => true,
            'logo_url' => 'default',
        );

        return $data;
    }

    /**
     * @inheritDoc
     */
    public static function prepareOptions( array $options_to_save, array $options )
    {
        return array_merge( $options_to_save, array_intersect_key( $options, array_flip( array(
            'bookly_l10n_label_pay_stripe',
            'bookly_l10n_label_ccard_code',
            'bookly_l10n_label_ccard_expire',
            'bookly_l10n_label_ccard_number',
        ) ) ) );
    }
}