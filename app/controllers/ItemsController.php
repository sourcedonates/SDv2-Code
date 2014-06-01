<?php

class ItemsController extends BaseController
{

    protected $layout = 'layouts.master';

    public function getIndex()
    {
        //Get the items from the StoreDB
        $items = Item::whereRaw("loadout_slot IN ( 'brillen','hats','pets','skin','snorren','piemol','vogel','jetpack' )")->get();

        //Sort them
        $items = $items->sortBy(function($item)
        {
            return $item->loadout_slot; //sort them by loadout slot
        });


        //TODO: Get the available payment providers
        

        //Build the view
        $this->layout->content = View::make('item.overview', array(
            'items' => $items, //Items data
        ));
    }


    public function getDetails($item_id)
    {
        
        $item = Item::find($item_id);
//      var_dump($item);
        $this->layout->content = View::make('item.details', array(
            'item' => $item,
        ));
    }
}