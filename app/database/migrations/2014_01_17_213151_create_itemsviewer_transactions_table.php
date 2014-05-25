<?php

use Illuminate\Database\Migrations\Migration;

class CreateItemsviewerTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('itemsviewer_transactions',function($table)
		{
			$table->increments('itv_transaction_id'); //id
			$table->string('itv_transaction_code','100'); //the generated transaction code
			$table->float('itv_transaction_userdetails'); //json of the user details
			$table->string('itv_transaction_provider','100'); //name of the transaction provider
			$table->string('itv_transaction_items','1000'); //json of the items
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
		Schema::dropIfExists('itemsviewer_transactions');
	}

}