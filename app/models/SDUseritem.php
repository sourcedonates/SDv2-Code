<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class SDUseritem extends Eloquent
{

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $table = 'sd_user_items';
    protected $softDelete = true;
    public $timestamps = true;

}

?>