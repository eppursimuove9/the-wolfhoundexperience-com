<?php
namespace BooklyMultiplyAppointments\Lib;

use Bookly\Lib as BooklyLib;

class Installer extends Base\Installer
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->options = array(
            'bookly_multiply_appointments_quantity_max' => 10,
            'bookly_l10n_label_multiply'                => __( 'Quantity', 'bookly' ),
        );
    }

}