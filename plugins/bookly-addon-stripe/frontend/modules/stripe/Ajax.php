<?php
namespace BooklyStripe\Frontend\Modules\Stripe;

use Bookly\Lib as BooklyLib;
use Bookly\Frontend\Modules\Payment;
use BooklyStripe\Lib\Payment\StripeGateway;

class Ajax extends BooklyLib\Base\Ajax
{
    /**
     * @inheritDoc
     */
    protected static function permissions()
    {
        return array( '_default' => 'anonymous' );
    }

    /**
     * Override parent method to exclude actions from CSRF token verification.
     *
     * @param string $action
     * @return bool
     */
    protected static function csrfTokenValid( $action = null )
    {
        $excluded_actions = array(
            'ipn',
        );

        return in_array( $action, $excluded_actions ) || parent::csrfTokenValid( $action );
    }

    /**
     * WebHook endpoint to handle payment.
     */
    public static function ipn()
    {
        $data = json_decode( file_get_contents( 'php://input' ), true );
        $response_code = 200;

        if ( $data && isset( $data['type'] ) && in_array( $data['type'], array( 'payment_intent.succeeded', 'payment_intent.payment_failed' ) ) ) {
            try {
                /** @var BooklyLib\Entities\Payment $payment */
                $payment = BooklyLib\Entities\Payment::query()->where( 'ref_id', $data['data']['object']['id'] )->findOne();
                if ( $payment && $payment->getStatus() === BooklyLib\Entities\Payment::STATUS_PENDING ) {
                    $stripe = new StripeGateway( Payment\Request::getInstance() );
                    $stripe->setPayment( $payment )->retrieve();
                }
            } catch ( \Exception $e ) {
                BooklyLib\Utils\Log::error( $e->getMessage(), $e->getFile(), $e->getLine() );
                $response_code = 400;
            }
        }
        BooklyLib\Utils\Common::emptyResponse( $response_code );
    }

}