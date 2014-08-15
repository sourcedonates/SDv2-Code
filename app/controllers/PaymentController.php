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



        //query the itemsviewer-plans/items db to get the price of the plan

        //create a transaction with a transaction code

        //save the steamid, the username, the email, the provider, the amount and the items to the trasaction DB

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
