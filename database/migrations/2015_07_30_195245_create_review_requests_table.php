<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReviewRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('review_requests', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('details');
            $table->integer('reputation');
            $table->timestamp('date_review');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('user_id')->unsigned();
            $table->integer('group_id')->unsigned()->nullable();
        });
    }

    public function down()
    {
        Schema::drop('review_requests');
    }
}