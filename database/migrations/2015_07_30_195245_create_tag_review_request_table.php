<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagReviewRequestTable extends Migration
{

    public function up()
    {
        Schema::create('tag_review_request', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('tag_id')->unsigned();
            $table->integer('review_request_id')->unsigned();
        });
    }

    public function down()
    {
        Schema::drop('tag_review_request');
    }
}