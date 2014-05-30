<?php

use Illuminate\Database\Migrations\Migration;

class CreateSdItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sd_items', function($table)
        {
            $table->bigIncrements('id'); //id
            $table->integer('pos');
            $table->string('name_short');
            $table->string('name_long');
            $table->longText('price');
            $table->longText('handlers');
            $table->longText('web_attrs');
            $table->longText('expires_after')->nullable();
            $table->enum('type', array('ota','expiring'));
            $table->integer('visible');
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
        Schema::dropIfExists('sd_items');
    }

}
