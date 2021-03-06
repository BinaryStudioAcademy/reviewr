<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->string('bid');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('role')->nullable();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('avatar');
            $table->string('address')->nullable();
            $table->string('password');
            $table->string('remember_token');
            $table->integer('reputation');
            $table->integer('job_id')->unsigned()->nullable();
            $table->integer('department_id')->unsigned()->nullable();
        });
    }

    public function down()
    {
        Schema::drop('users');
    }
}