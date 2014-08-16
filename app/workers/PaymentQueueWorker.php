<?php

class PaymentQueueWorker
{
    public function fire($job, $data)
    {
        $transaction_id = mysql_escape_string($data["transaction"]);
        
        Log::Debug("Queue Worker Fired");
        Log::Debug("Transaction-ID: ".$transaction_id);
        
        //Get the transaction from the db
        $transaction = SDPaymentTransaction::find($transaction_id);
        if(!$transaction)
        {
            Log::Warning("Could not load Transaction from Database");
            exit();
        }
        Log::Debug("Transaction loaded from DB");
        Log::Debug("Transaction user_id: ".$transaction->user_id);
        Log::Debug("Transaction payment provider:".$transaction->payment_provider);
        Log::Debug("Transaction Item ID")
        //Get the user from the DB
        
        //Get the item from the DB
        
        //Get the User info from the DB
        
        //Confirm that we have got the required infos
        
        //Call the actual function
        
        //Update the User in the DB
        
        //Check for errors
        
    }
}