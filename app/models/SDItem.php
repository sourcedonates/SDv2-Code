<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class SDItem extends Eloquent
{

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $table = 'sd_items';
    protected $softDelete = true;
    public $timestamps = true;

}

?>