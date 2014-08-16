<?php

class PaymentQueueWorker
{
    public function fire($job, $data)
    {
        File::append(app_path().'/test.txt',$data['transaction']."-".time());
    }
}
