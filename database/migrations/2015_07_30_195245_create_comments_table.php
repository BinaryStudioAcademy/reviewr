<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration {

	public function up()
	{
		Schema::create('comments', function(Blueprint $table) {
			$table->increments('id');
			$table->string('text');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('user_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('comments');
	}
}