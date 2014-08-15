<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class SDUserinfos extends Eloquent
{

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $table = 'sd_user_infos';
    protected $softDelete = true;
    public $timestamps = true;

}

?>