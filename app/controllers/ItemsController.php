<?php

class ItemsController extends BaseController
{

    public function getIndex()
    {
        //Get the items from the StoreDB
        $store_items = Item::whereRaw("loadout_slot IN ( 'brillen','hats','pets','skin','snorren','piemol','vogel','jetpack' )")->get();

        //Sort them
        $store_items = $store_items->sortBy(function($item)
        {
            return $store_items->loadout_slot; //sort them by loadout slot
        });

        $paymentprovider = DB::table('sd_payment_providers')->orderBy('pos', 'desc')->get();
        $user = Sentinel::check();

        $sd_items = SDItem::where('visible', '1')->get();

        //Build the view
        return View::make('item.overview', array(
                    'items' => $store_items, //Items data
                    'sd_items' => $sd_items, //SD Item data
                    'payment_providers' => $paymentprovider, //Provider data
                    'user' => $user //User data
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
