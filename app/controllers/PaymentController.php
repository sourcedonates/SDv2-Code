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
        $data = Input::all();
    	var_dump($data);
        echo "</br>";

        //Get the payment provider and check if the provider can handle the currency    
        $provider = SDPaymentProvider::find($data["provider_id"]);
        
        echo $provider->currencies;
        echo "</br>";
        
        $ava_curr = json_decode($provider->currencies);
        
        var_dump($ava_curr);
        echo "</br>";
        
        if($ava_curr == false) exit("Provider Currency JSON invalid");
        if($ava_curr->$data["currency"] != "true") exit("Currency not supported by provider");

        
        //query the items db to get the price of the plan
        echo "Item-id:" . $data["item_id"]. "</br>";
        $item = SDItem::find($data['item_id']);
        var_dump($item);
        
        
        //get the price of the item in the selected currency
        $price_array = json_decode($item->price);
        $price = $price_array->currency;
        
        
        //create a transaction with a transaction code
        $transaction_id = ""; //variable for the transaction code
        $transaction_id += time(); //add the current timestamp
        $transaction_id += rand(1, 9); //add 5 random numbers
        $transaction_id += rand(1, 9);
        $transaction_id += rand(1, 9);
        $transaction_id += rand(1, 9);
        $transaction_id += rand(1, 9);
        
        
        //save the steamid, the username, the email, the provider, the amount and the items to the trasaction DB
        $transaction = new SDPaymentTransaction;
        $transaction->id = $transaction_id;
        $transaction->payment_provider = $provider->id;
        $transaction->currency = $data["currency"];
        $transaction->price = $data["price"];
        $transaction->items = $item->id;
        $transaction->status = "sent";
        $transaction->save();
        
        //Get the module name of the selected provider

        //Create the payment with the provider, the transaction code and the price








        /**Temporary
        $price = 1.00; //get the price from the posted plan   
        $item_name = "testitem"; //get the item name from the items controller with the posted item_id


        //save to user details into the transaktion db and genereate a transaction id
        $transaction_id = 1234; //generate a new transaktion id


        //get the posted payment provider
        $payment_provider = "paypal"; //the posted payment provider


        $payment_paypal = new arrow768\payment_paypal;
        $payment_paypal->initiate_payment($price, $transaction_id);
        **/
    }
}
