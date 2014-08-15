<?php

class SDPaymentTransaction extends Eloquent
{
    protected $table = 'sd_payment_transactions';
    protected $softDelete = true;
    public $timestamps = true;
}

?>