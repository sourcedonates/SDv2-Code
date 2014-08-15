<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class SDPaymentTransaction extends Eloquent
{

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $table = 'sd_payment_transactions';
    protected $softDelete = true;
    public $timestamps = true;

}

?>