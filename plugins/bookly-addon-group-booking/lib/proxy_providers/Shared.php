<?php
namespace BooklyGroupBooking\Lib\ProxyProviders;

use Bookly\Lib as BooklyLib;

class Shared extends BooklyLib\Proxy\Shared
{
    /**
     * @inheritDoc
     */
    public static function prepareStatement( $value, $statement, $table )
    {
        $tables = array( 'StaffService', 'Service' );
        $key    = $table . '-' . $statement;
        if ( in_array( $table, $tables ) ) {
            if ( ! self::hasInCache( $key ) ) {
                preg_match( '/(?:(\w+)\()?\W*(?:(\w+)\.(\w+)|(\w+))/', $statement, $match );

                $count = count( $match );
                if ( $count == 4 ) {
                    $field = $match[3];
                } elseif ( $count == 5 ) {
                    $field = $match[4];
                }

                switch ( $field ) {
                    case 'capacity_min':
                    case 'capacity_max':
                        self::putInCache( $key, $statement );
                        break;
                }
            }
        } else {
            self::putInCache( $key, $value );
        }

        return self::getFromCache( $key );
    }

    /**
     * @inheritDoc
     */
    public static function prepareTableColumns( $columns, $table )
    {
        if ( $table == BooklyLib\Utils\Tables::APPOINTMENTS ) {
            $columns['number_of_persons'] = __( 'Number of persons', 'bookly' );
        }

        return $columns;
    }
}