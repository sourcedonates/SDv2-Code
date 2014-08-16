<?php

class PaymentQueueWorker
{

    public function fire($job, $data)
    {
        $transaction_id = $data["transaction"];

        Log::info("Queue Worker Fired");
        Log::info("Transaction-ID: " . $transaction_id);

        //Get the transaction from the db
        $transaction = SDPaymentTransaction::find($transaction_id);
        if (!$transaction)
        {
            Log::warning("Could not load Transaction from Database");
            exit();
        }
        if($transaction->status != "confirmed")
        {
            Log::error("Transaction".$transaction->id."not confirmed - aborting");
        }
        
        Log::info("Transaction loaded from DB");
        Log::info("Transaction user_id: " . $transaction->user_id);
        Log::info("Transaction payment provider: " . $transaction->payment_provider);
        Log::info("Transaction Items: " . $transaction->items);

        //Get the user from the DB
        $user = Sentinel::findById($transaction->user_id);
        if (!$user)
        {
            Log::error("Could not find the user ".$transaction->user_id." in the DB");
            exit();
        }

        //Get the items from the DB
        $items = json_decode($transaction->items);
        if ($items == false)
        {
            Log::error("Invalid Item JSON at the Transaction ".$transaction->id);
            exit();
        }

        //Get the User info from the DB
        $user_info = SDUserinfo::where("user_id", $transaction->user_id);
        if (!$user_info)
        {
            Log::error("Could not get the User from the DB for transaction ". $transaction->id);
            exit();
        }

        //Go through the items and assign them to the user
        foreach ($items as $item)
        {
            Log::info("Got Item id:".$item->id);
            Log::info("Got Item count:".$item->count);
        }


        //Update the User in the DB
        //Check for errors
    }

}
