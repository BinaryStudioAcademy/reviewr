<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReviewRequestUserTable extends Migration {

	public function up()
	{
		Schema::create('review_request_user', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->boolean('isAccepted');
			$table->integer('review_request_id')->unsigned();
			$table->integer('user_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('review_request_user');
	}
}