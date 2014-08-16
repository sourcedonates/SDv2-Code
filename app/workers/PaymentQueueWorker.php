<?php

class PaymentQueueWorker
{

    public function fire($job, $data)
    {
        $transaction_id = mysql_escape_string($data["transaction"]);

        Log::Debug("Queue Worker Fired");
        Log::Debug("Transaction-ID: " . $transaction_id);

        //Get the transaction from the db
        $transaction = SDPaymentTransaction::find($transaction_id);
        if (!$transaction)
        {
            Log::Warning("Could not load Transaction from Database");
            exit();
        }
        if($transaction->status != "confirmed")
        {
            Log::Error("Transaction".$transaction->id."not confirmed - aborting");
        }
        
        Log::Debug("Transaction loaded from DB");
        Log::Debug("Transaction user_id: " . $transaction->user_id);
        Log::Debug("Transaction payment provider: " . $transaction->payment_provider);
        Log::Debug("Transaction Items: " . $transaction->items);

        //Get the user from the DB
        $user = Sentinel::findById($transaction->user_id);
        if (!$user)
        {
            Log::Error("Could not find the user ".$transaction->user_id." in the DB");
            exit();
        }

        //Get the items from the DB
        $items = json_decode($transaction->items);
        if ($items == false)
        {
            Log::Error("Invalid Item JSON at the Transaction ".$transaction->id);
            exit();
        }

        //Get the User info from the DB
        $user_info = SDUserinfo::where("user_id", $transaction->user_id);
        if (!$user_info)
        {
            Log::Error("Could not get the User from the DB for transaction ". $transaction->id);
            exit();
        }

        //Go through the items and assign them to the user
        foreach ($items as $item)
        {
            Log::Debug("Got Item id:".$item->id);
            Log::Debug("Got Item count:".$item->count);
        }


        //Update the User in the DB
        //Check for errors
    }

}
