<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class SDPaymentProvider extends Eloquent
{

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $table = 'sd_payment_providers';
    protected $softDelete = true;
    public $timestamps = true;

}

?>