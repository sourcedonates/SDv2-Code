<?php

/**
 * SDv2 Payment Controller
 * 
 * The PaymentController handles all the Payment Functions after the user has confirmed his purchase
 * Selecting the correct provider, Redirecting the user to the provider (if required), 
 * Updating the transaction table if the transaction is successful (if using a instant provider, that doesnt send a ipn)
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
class PaymentController extends BaseController
{

    /**
     * Processes the post request.
     * 
     * Request needs to contain: 
     * 
     */
    public function process_payment()
    {
        $debug = Config::get('sdv2.debug');

        $data = Input::all();
        if ($debug)
            var_dump($data);
        if ($debug)
            echo "</br>";

        //Get the payment provider and check if the provider can handle the currency    
        $provider = SDPaymentProvider::find($data["provider_id"]);
        if ($debug)
            echo $provider->currencies;
        if ($debug)
            echo "</br>";

        $ava_curr = json_decode($provider->currencies);
        if ($debug)
            var_dump($ava_curr);
        if ($debug)
            echo "</br>";

        if ($ava_curr == false)
            exit("Provider Currency JSON invalid");
        if ($ava_curr->$data["currency"] != "true")
            exit("Currency not supported by provider");


        //query the items db to get the price of the plan
        if ($debug)
            echo "Item-id:" . $data["item_id"] . "</br>";
        $item = SDItem::find($data['item_id']);
        if ($debug)
            var_dump($item);
        if ($debug)
            echo "</br>";

        //get the price of the item in the selected currency
        $price_array = json_decode($item->price);
        $price = $price_array->$data["currency"];
        Log::info("price: " . $price);

        //Generate a transaction id and check if it exists
        $got_transaction_id = false;
        while ($got_transaction_id == false)
        {
            $transaction_id = $this->generate_transaction_id();
            if (!$check_id = SDPaymentTransaction::find($transaction_id))
            {
                $got_transaction_id = true;
            }
            else
            {
                Log::error("transaction id " . $transaction_id . " already exists");
            }
        }
        Log::info("transaction id: " . $transaction_id);

        //Check if a user with this mail adress exists or a user is logged in
        if ($user = Sentinel::check())
        {
            Log::info("User logged in - UserID: " . $user->id);
        }
        else
        {
            Log::info("User not logged in - Redirected to the login page");
            redirect::to('/user/require_login');
        }

        //Generate the item json
        $items = array();
        $items[] = array("id" => $item->id, "count" => "1");

        $items = json_encode($items);

        //Check if a steamid is added to the users account
        //save the transaction to the transaction db
        $transaction = new SDPaymentTransaction;
        $transaction->id = $transaction_id;
        $transaction->user_id = $user->id;
        $transaction->payment_provider = $provider->id;
        $transaction->currency = $data["currency"];
        $transaction->price = $price;
        $transaction->items = $items;
        $transaction->status = "sent";
        $transaction->save();


        //Create the payment with the provider, the transaction code and the price
        $payment_provider = $provider->provider_class;
        Log::info("payment_provider_class:" . $payment_provider);
        $payment = new $payment_provider;

        $payment->initiate_payment($price, $transaction_id, $data["currency"]);
    }

    private function generate_transaction_id()
    {
        $transaction_id = ""; //variable for the transaction code
        $transaction_id += time(); //add the current timestamp
        $transaction_id += rand(1, 9); //add 5 random numbers
        $transaction_id += rand(1, 9);
        $transaction_id += rand(1, 9);
        $transaction_id += rand(1, 9);
        $transaction_id += rand(1, 9);

        return $transaction_id;
    }

    /**
     * Show the configured payment provider
     * 
     */
    public function show_providers()
    {
        $user = $this->check_login();

        if ($user != false)
        {
            if ($user->hasAccess("payment.show_pp"))
            {
                //Get the user details from the db
                $user_infos = SDUserinfo::where('user_id', $user->id)->get();

                foreach ($user_infos as $user_info)
                {
                    $data[$user_info->type] = $user_info->value;
                }

                $data['user'] = $user;
                $template = Config::get('sdv2.system_backendtemplate');
                return View::make($template . ".payment.show_pp", $data);
            }
            else
            {
                return Redirect::to('/user/dashboard')->with('error', 'Wrong Extension / Mime Type');
            }
        }
        else
        {
            return Redirect::to('/user/login');
        }
    }

    /**
     * Login Check
     * 
     * Checks if a User is logged in and redirects him to the login page if he is not
     */
    private function check_login()
    {
        if ($user = Sentinel::check())
        {
            return $user;
        }
        else
        {
            return false;
        }
    }

}
