<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBadgeUserTable extends Migration {

	public function up()
	{
		Schema::create('badge_user', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('badge_id')->unsigned();
			$table->integer('user_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('badge_user');
	}
}