<?php

use Illuminate\Database\Migrations\Migration;

class CreateItemsviewerItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('itemsviewer_items',function($table)
		{
			$table->increments('itv_item_id'); //id
			$table->string('itv_item_name','100'); //short name of the item
			$table->string('itv_item_name_long', '1000'); //long name of the item
			$table->float('itv_item_price'); //price of the item
			$table->string('itv_item_provider'); //namespace / class that handles the item
			$table->string('itv_item_attrs','1000'); //json of the item attrs
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('itemsviewer_items');
	}

}