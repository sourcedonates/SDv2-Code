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
            $table->bigInteger('user_id');
            $table->string('payment_provider');
            $table->string('currency');
            $table->string('price');
            $table->longText('items');
            $table->enum('status', array('sent','confirmed','rejected','completed','error','queued'));
            $table->longText('log')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');
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
