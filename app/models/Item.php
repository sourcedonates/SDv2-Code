<?php

class Item extends Eloquent
{
    protected $table = 'store_items';
    protected $softDelete = false;
    public $timestamps = false;
}

?>
