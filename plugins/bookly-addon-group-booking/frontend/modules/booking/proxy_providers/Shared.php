<?php
namespace BooklyGroupBooking\Frontend\Modules\Booking\ProxyProviders;

use Bookly\Lib as BooklyLib;

class Shared extends \Bookly\Frontend\Modules\Booking\Proxy\Shared
{
    /**
     * @inheritDoc
     */
    public static function prepareChainItemInfoText( $data, BooklyLib\ChainItem $chain_item )
    {
        return self::prepareInfoTextCodesData( $data, $chain_item );
    }

    /**
     * @inheritDoc
     */
    public static function prepareCartItemInfoText( $data, BooklyLib\CartItem $cart_item )
    {
        return self::prepareInfoTextCodesData( $data, $cart_item );
    }

    /**
     * Prepare info text codes for chain or cart item
     *
     * @param array $data
     * @param BooklyLib\ChainItem|BooklyLib\CartItem $item
     * @return array
     */
    protected static function prepareInfoTextCodesData( $data, $item )
    {
        $last = count( $data['appointments'] ) - 1;
        $data['appointments'][ $last ]['number_of_persons'] = $item->getNumberOfPersons();

        return $data;
    }

    /**
     * @inheritDoc
     */
    public static function stepOptions( $options, $step, $userData )
    {
        if ( $step == 'service' ) {
            $options['l10n']['nop_label'] = BooklyLib\Utils\Common::getTranslatedOption( 'bookly_l10n_label_number_of_persons' );
        }

        return $options;
    }
}