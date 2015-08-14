<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersVote extends Migration
{
    public function up()
    {
        Schema::create('user_vote', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('review_request_id')->unsigned();
        });
        Schema::table('user_vote', function(Blueprint $table) {
            $table->foreign('review_request_id')->references('id')->on('review_requests')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('user_vote', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
    }

    public function down()
    {
        Schema::drop('user_vote');
    }


}
