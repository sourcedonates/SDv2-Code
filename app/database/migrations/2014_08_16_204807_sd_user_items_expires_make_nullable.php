<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SdUserItemsExpiresMakeNullable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            DB::raw("ALTER TABLE `sd_user_items` CHANGE `expires_on` `expires_on` DATE NULL;");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            DB::raw("ALTER TABLE `sd_user_items` CHANGE `expires_on` `expires_on` DATE NOT NULL;");
	}

}
