<?php

/**
 * Handling Payment Operations
 * 
 * The PaymentController handles all the Payment Functions after the user has confirmed his purchase
 * Selecting the correct provider, Redirecting the user to the provider (if required), 
 * Updating the transaction table if the transaction is successful (if using a instant provider, that doesnt send a ipn)
 * 
 * @author Werner Maisl
 * @copyright (c) 2014, Werner Maisl
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
        Log::debug("price: " . $price);

        //create a transaction with a transaction code
        $transaction_id = ""; //variable for the transaction code
        $transaction_id += time(); //add the current timestamp
        $transaction_id += rand(1, 9); //add 5 random numbers
        $transaction_id += rand(1, 9);
        $transaction_id += rand(1, 9);
        $transaction_id += rand(1, 9);
        $transaction_id += rand(1, 9);
        Log::debug("transaction_id: " . $transaction_id);

        //Check if a user with this mail adress exists or a user is logged in
        if ($user = Sentinel::check())
        {
            Log::debug("User logged in - UserID: ".$user_id);
        }
        else
        {
            Log::debug("User not logged in - Redirected to the login page");
            redirect::to('/user/require_login');
        }

        //Check if a steamid is added to the users account
        //save the transaction to the transaction db
        $transaction = new SDPaymentTransaction;
        $transaction->id = $transaction_id;
        $transaction->user_id = $user->id;
        $transaction->payment_provider = $provider->id;
        $transaction->currency = $data["currency"];
        $transaction->price = $price;
        $transaction->items = $item->id;
        $transaction->status = "sent";
        $transaction->save();


        //Create the payment with the provider, the transaction code and the price
        $payment_provider = $provider->provider_class;
        Log::debug("payment_provider_class:" . $payment_provider);
        $payment = new $payment_provider;

        $payment->initiate_payment($price, $transaction_id, $data["currency"]);
    }

    
    /**
     * Handle Process Queue
     */
    public function post_process($job, $data)
    {
        Log::Info("Processed Queue Job");
        Log::Debug("Queue Data: ". var_dump($data));
        
        //Delete the Job from the Queue
        $job->delete();
    }
}
