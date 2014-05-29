<?php

use Illuminate\Database\Migrations\Migration;

class CreateSdPaymentProvidersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sd_payment_providers', function($table)
        {
            $table->bigIncrements('id'); //id
            $table->integer('pos');
            $table->string('name_short');
            $table->string('name_long');
            $table->string('provider_class');
            $table->enum('type', array('ipn'));
            $table->longText('currencies');
            $table->longText('settings');
            $table->longText('price');
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('sd_payment_providers');
    }

}
