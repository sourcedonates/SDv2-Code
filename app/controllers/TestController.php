<?php

class TestController extends BaseController
{
    public function test_payment()
    {
        
        $paypal_payment = new arrow768\payment_paypal;

        $paypal_payment->initiate_payment('1.00', '1234');
    }
}