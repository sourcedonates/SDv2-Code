<?php

/**
 * SDv2 Presentation Controller
 * 
 * The PaymentController shows the frontend to the user.
 * This is going to change in a future version
 * 
 * This file is Part of SousrceDonatesv2
 * SousrceDonatesv2 is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version. 
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 * 
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 * 
 * @package    SousrceDonatesv2
 * @author     Werner Maisl
 * @copyright  (c) 2013-2014 - Werner Maisl
 * @license    GNU AGPLv3 http://www.gnu.org/licenses/agpl-3.0.txt
 */

class PresentationController extends BaseController
{

    public function getIndex()
    {
        //Get the items from the StoreDB
        $store_items = Item::whereRaw("loadout_slot IN ( 'brillen','hats','pets','skin','snorren','piemol','vogel','jetpack' )")->get();

        //Sort them
        $store_items = $store_items->sortBy(function($store_item)
        {
            return $store_item->loadout_slot; //sort them by loadout slot
        });

        $paymentprovider = DB::table('sd_payment_providers')->orderBy('pos', 'desc')->get();
        $user = Sentinel::check();

        $sd_items = SDItem::where('visible', '1')->get();

        //Build the view
        return View::make('item.overview', array(
                    'items' => $store_items, //Items data
                    'sditems' => $sd_items, //SD Item data
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
