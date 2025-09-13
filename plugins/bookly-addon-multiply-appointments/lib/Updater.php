<?php
namespace BooklyMultiplyAppointments\Lib;

class Updater extends \Bookly\Lib\Base\Updater
{
    public function update_2_0()
    {
        delete_option( 'bookly_multiply_appointments_enabled' );
    }

    public function update_1_3()
    {
        add_option( 'bookly_multiply_appointments_enabled', '1' );
    }

    public function update_1_2()
    {
        $options = array(
            'ab_appearance_text_label_multiply' => 'bookly_l10n_label_multiply',
        );
        $this->renameL10nStrings( $options );
    }

}