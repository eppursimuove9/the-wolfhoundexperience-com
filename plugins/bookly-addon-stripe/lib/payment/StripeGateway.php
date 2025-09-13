<?php
namespace BooklyStripe\Lib\Payment;

use Bookly\Lib as BooklyLib;
use BooklyStripe\Lib\Payment\Lib\Stripe;

class StripeGateway extends BooklyLib\Base\Gateway
{
    protected $type = BooklyLib\Entities\Payment::TYPE_STRIPE;
    protected $on_site = true;

    /**
     * @inerhitDoc
     */
    protected function getCheckoutUrl( array $intent_data )
    {
    }

    /**
     * @inerhitDoc
     */
    protected function getInternalMetaData()
    {
        return array(
            'description' => $this->request->getUserData()->cart->getItemsTitle(),
            'customer' => $this->request->getUserData()->getFullName(),
            'email' => $this->request->getUserData()->getEmail(),
        );
    }

    /**
     * @inerhitDoc
     */
    protected function createGatewayIntent()
    {
        $this->initStripe();

        $userData = $this->request->getUserData();
        $customer = $userData->getCustomer();
        if ( $customer->getStripeAccount() ) {
            try {
                Stripe\Customer::update( $customer->getStripeAccount(),
                    array(
                        'email' => $userData->getEmail(),
                        'name' => $userData->getFullName(),
                    ) );
            } catch ( Stripe\Exception\InvalidRequestException $e ) {
                $customer->setStripeAccount( $this->createStripeCustomer( $userData ) );
            }
        } else {
            $customer->setStripeAccount( $this->createStripeCustomer( $userData ) );
        }
        $stripe_amount = $this->request->getCartInfo()->getGatewayAmount();
        if ( ! BooklyLib\Config::isZeroDecimalsCurrency() ) {
            $stripe_amount *= 100;
        }
        $intent = Stripe\PaymentIntent::create( array(
            'amount' => round( $stripe_amount ),
            'currency' => get_option( 'bookly_pmt_currency' ),
            'payment_method_types' => array( 'card' ),
            'description' => $userData->cart->getItemsTitle(),
            'receipt_email' => $userData->getEmail(),
            'customer' => $customer->getStripeAccount(),
            'metadata' => $this->getMetaData(),
        ) );
        if ( $intent->client_secret ) {
            return array(
                'ref_id' => $intent->id,
                'intent_secret' => $intent->client_secret,
                'target_url' => $this->getResponseUrl( self::EVENT_RETRIEVE ),
                'bookly_order' => BooklyLib\Entities\Order::find( $this->order->getOrderId() )->getToken(),
            );
        }
        throw new \Exception( 'Invalid response' );
    }

    /**
     * @inerhitDoc
     */
    public function retrieveStatus()
    {
        $this->initStripe();
        $payment = $this->getPayment();
        try {
            $intent = Stripe\PaymentIntent::retrieve( $payment->getRefId() );

            if ( $intent
                && $intent->status === 'succeeded'
                && $payment->getStatus() !== BooklyLib\Entities\Payment::STATUS_COMPLETED
            ) {
                $total = (float) $payment->getPaid();
                $received = (float) $intent->amount_received;
                if ( ! BooklyLib\Config::isZeroDecimalsCurrency() ) {
                    $total *= 100; // amount in cents
                }
                if ( abs( $received - $total ) <= 0.01 && BooklyLib\Config::getCurrency() == strtoupper( $intent->currency ) ) {

                    return self::STATUS_COMPLETED;
                }
            }

            return self::STATUS_PROCESSING;
        } catch ( \Exception $e ) {
            throw new \LogicException( $e->getMessage() );
        }
    }

    /**
     * @param BooklyLib\UserBookingData $userData
     * @return string|null
     */
    private function createStripeCustomer( BooklyLib\UserBookingData $userData )
    {
        try {
            $sc = Stripe\Customer::create( array(
                'email' => $userData->getEmail(),
                'name' => $userData->getFullName(),
            ) );

            return $sc->id;
        } catch ( \Exception $e ) { }

        return null;
    }

    private function initStripe()
    {
        include_once \BooklyStripe\Lib\Plugin::getDirectory() . '/lib/payment/Stripe/init.php';
        Stripe\Stripe::setApiKey( get_option( 'bookly_stripe_secret_key' ) );
        Stripe\Stripe::setApiVersion( '2019-02-19' );
    }
}