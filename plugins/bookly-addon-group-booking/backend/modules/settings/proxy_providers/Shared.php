<?php
namespace BooklyGroupBooking\Backend\Modules\Settings\ProxyProviders;

use Bookly\Backend\Modules\Settings\Proxy;

class Shared extends Proxy\Shared
{
    /**
     * @inheritDoc
     */
    public static function renderAdditionalSettings()
    {
        self::renderTemplate( 'additional_settings' );
    }

    /**
     * @inheritDoc
     */
    public static function saveSettings( array $alert, $tab, array $params )
    {
        if ( $tab == 'additional' ) {
            $options = array( 'bookly_group_booking_nop_format' );
            foreach ( $options as $option_name ) {
                if ( array_key_exists( $option_name, $params ) ) {
                    update_option( $option_name, $params[ $option_name ] );
                }
            }
        }

        return $alert;
    }

    /**
     * @inheritDoc
     */
    public static function prepareCalendarAppointmentCodes( array $codes, $participants )
    {
        if ( $participants == 'one' ) {
            $codes['number_of_persons'] = __( 'Number of persons', 'bookly' );
        } else {
            $codes['signed_up'] = __( 'Number of persons already in the list', 'bookly' );
            $codes['service_capacity'] = __( 'Capacity of service', 'bookly' );
        }

        return $codes;
    }

    /**
     * @inheritDoc
     */
    public static function prepareCodes( array $codes, $section )
    {
        switch ( $section ) {
            case 'calendar_one_participant' :
            case 'ics_for_customer':
            case 'ics_for_staff':
                $codes['number_of_persons'] = array( 'description' => __( 'Number of persons', 'bookly' ) );
                break;
            case 'calendar_many_participants' :
                $codes['signed_up'] = array( 'description' => __( 'Number of persons already in the list', 'bookly' ) );
                $codes['service_capacity'] = array( 'description' => __( 'Capacity of service', 'bookly' ) );
                break;
            case 'google_calendar' :
            case 'outlook_calendar' :
                $codes = array_merge_recursive( $codes, array(
                    'number_of_persons' => array( 'description' => __( 'Number of persons', 'bookly' ) ),
                    'participants' => array(
                        'loop' => array(
                            'codes' => array(
                                'signed_up' => array( 'description' => __( 'Number of persons already in the list', 'bookly' ) ),
                                'service_capacity' => array( 'description' => __( 'Capacity of service', 'bookly' ) ),
                            ),
                        ),
                    ),
                ) );
                break;
        }

        return $codes;
    }
}