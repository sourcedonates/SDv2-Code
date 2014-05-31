<?php

class TestController extends BaseController
{
    public function test_payment()
    {
        $payment_provider = "arrow768\payment_paypal";
        $paypal_payment = new $payment_provider;

        $paypal_payment->initiate_payment('1.00', '1234');
    }
}