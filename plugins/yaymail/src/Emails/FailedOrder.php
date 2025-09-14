<?php

namespace YayMail\Emails;

use YayMail\Abstracts\BaseEmail;
use YayMail\Elements\ElementsLoader;
use YayMail\Utils\SingletonTrait;

/**
 * FailedOrder Class
 *
 * @method static FailedOrder get_instance()
 */
class FailedOrder extends BaseEmail {
    use SingletonTrait;

    protected function __construct() {
        $emails = \WC_Emails::instance()->get_emails();
        $email  = $emails['WC_Email_Failed_Order'];
        if ( ! $email ) {
            return;
        }

        $this->id         = $email->id;
        $this->title      = $email->get_title();
        $this->root_email = $email;
        $this->recipient  = function_exists( 'yaymail_get_email_recipient_zone' ) ? yaymail_get_email_recipient_zone( $email ) : '';

        $this->render_priority = apply_filters( 'yaymail_email_render_priority', $this->render_priority, $this->id );
        add_filter( 'wc_get_template', [ $this, 'get_template_file' ], $this->render_priority ?? 10, 3 );
        $this->maybe_disable_block_email_editor();
    }

    public function get_default_elements() {
        $email_title = __( 'Order Failed: #{order_number}', 'woocommerce' );
        $email_title = str_replace( '#{order_number}', '#[yaymail_order_number is_plain="true"]', $email_title );
        // translators: order_id and customer name.
        $email_text      = sprintf( esc_html__( 'Payment for order #%1$s from %2$s has failed. The order was as follows:', 'woocommerce' ), '[yaymail_order_number is_plain="true"]', '[yaymail_billing_first_name] [yaymail_billing_last_name]' );
        $additional_text = __( 'Hopefully they\'ll be back. Read more about <a href=\"https://docs.woocommerce.com/document/managing-orders/\">troubleshooting failed payments</a>.', 'woocommerce' );
        $additional_text = str_replace( '<a', '<a style=\"color: ' . esc_attr( YAYMAIL_COLOR_WC_DEFAULT ) . ';\"', $additional_text );

        $default_elements = ElementsLoader::load_elements(
            [
                [
                    'type' => 'Logo',
                ],
                [
                    'type'       => 'Heading',
                    'attributes' => [
                        'rich_text' => $email_title,
                    ],
                ],
                [
                    'type'       => 'Text',
                    'attributes' => [
                        'rich_text' => '<p><span>' . $email_text . '</span></p>',
                    ],
                ],
                [
                    'type' => 'OrderDetails',
                ],
                [
                    'type' => 'BillingShippingAddress',
                ],
                [
                    'type'       => 'Text',
                    'attributes' => [
                        'rich_text' => '<p><span>' . $additional_text . '</span></p>',
                        'padding'   => [
                            'top'    => '0',
                            'right'  => '50',
                            'bottom' => '38',
                            'left'   => '50',
                        ],
                    ],
                ],
                [
                    'type' => 'Footer',
                ],
            ]
        );
        return $default_elements;
    }

    public function get_template_path() {
        return YAYMAIL_PLUGIN_PATH . 'templates/emails/admin-failed-order.php';
    }
}
