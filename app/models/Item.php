<?php

class Item extends Eloquent
{
    protected $connection = 'ag_store';
    protected $table = 'store_items';
    public $timestamps = false;
}

?>
