<?php

class ItemsController extends BaseController
{
    public function getIndex()
    {
        //Get the items from the StoreDB
        $items = Item::whereRaw("loadout_slot IN ( 'brillen','hats','pets','skin','snorren','piemol','vogel','jetpack' )")->get();

        //Sort them
        $items = $items->sortBy(function($item)
        {
            return $item->loadout_slot; //sort them by loadout slot
        });


        $paymentprovider = DB::table('sd_payment_providers')->orderBy('pos','desc')->get();
        
        
        
        //Build the view
        return View::make('item.overview', array(
            'items' => $items, //Items data
            'payment_providers' => $paymentprovider //Provider data
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