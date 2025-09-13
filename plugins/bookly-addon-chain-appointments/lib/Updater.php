<?php
namespace BooklyChainAppointments\Lib;

/**
 * Class Updater
 * @package BooklyChainAppointments\Lib
 */
class Updater extends \Bookly\Lib\Base\Updater
{
    function update_1_8()
    {
        $this->addL10nOptions( array(
            'bookly_l10n_chain_appointments_book_more'     => __( 'Add service', 'bookly' ),
        ) );
    }
}