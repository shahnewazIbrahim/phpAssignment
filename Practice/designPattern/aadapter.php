<?php
interface PaymentGateway { 
    public function sendPayment($payment);
}
class PaymentProcessor {

    private $gateway;
    public function __construct(PaymentGateway $pg) {
        $this->gateway = $pg;
    }
    public function purchaseProduct($amount) {
        $this->gateway->sendPayment($amount);
    }
}

class Paypal implements PaymentGateway {
    public function sendPayment($payment) {
        echo"{$payment} processed\n";
    }
}


class Stripe {
    public function makePayment($amount, $currency = null) {
        echo"{$amount} processed\n";
    }
}

class StripeAdapter implements PaymentGateway {

    private $stripe;
    function __construct(Stripe $stripe) {
        $this->stripe = $stripe;
    }
    public function sendPayment($amount){
        $this->stripe->makePayment($amount);
    }
}


$paypal = new Paypal();
$stripe = new Stripe();
$sa = new StripeAdapter($stripe);
$pp = new PaymentProcessor($paypal);
$pp2 = new PaymentProcessor($sa);

$pp->purchaseProduct(45);
$pp2->purchaseProduct(52);