<?php

use Illuminate\Database\Migrations\Migration;

class CreateSdPaymentTransactionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sd_payment_transactions', function($table)
        {
            $table->string('id'); //id
            $table->string('payment_provider');
            $table->string('currency');
            $table->string('price');
            $table->longText('items');
            $table->longText('parameters');
            $table->enum('status', array('sent','confirmed','rejected','completed','error'));
            $table->longText('log');
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');
            $table->unique('name_short');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sd_payment_transactions');
    }

}
