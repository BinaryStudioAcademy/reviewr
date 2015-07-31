<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration
{

    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('department_id')->references('id')->on('departments')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('comments', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('comments', function(Blueprint $table) {
            $table->foreign('review_request_id')->references('id')->on('review_requests')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('review_requests', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('review_requests', function(Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('groups')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('review_request_user', function(Blueprint $table) {
            $table->foreign('review_request_id')->references('id')->on('review_requests')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('review_request_user', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('badge_user', function(Blueprint $table) {
            $table->foreign('badge_id')->references('id')->on('badges')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('badge_user', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('tag_review_request', function(Blueprint $table) {
            $table->foreign('tag_id')->references('id')->on('tags')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('tag_review_request', function(Blueprint $table) {
            $table->foreign('review_request_id')->references('id')->on('review_requests')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('group_user', function(Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('groups')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('group_user', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
    }

    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign('users_job_id_foreign');
        });
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign('users_department_id_foreign');
        });
        Schema::table('comments', function(Blueprint $table) {
            $table->dropForeign('comments_user_id_foreign');
        });
        Schema::table('comments', function(Blueprint $table) {
            $table->dropForeign('comments_review_request_id_foreign');
        });
        Schema::table('review_requests', function(Blueprint $table) {
            $table->dropForeign('review_requests_user_id_foreign');
        });
        Schema::table('review_requests', function(Blueprint $table) {
            $table->dropForeign('review_requests_group_id_foreign');
        });
        Schema::table('review_request_user', function(Blueprint $table) {
            $table->dropForeign('review_request_user_review_request_id_foreign');
        });
        Schema::table('review_request_user', function(Blueprint $table) {
            $table->dropForeign('review_request_user_user_id_foreign');
        });
        Schema::table('badge_user', function(Blueprint $table) {
            $table->dropForeign('badge_user_badge_id_foreign');
        });
        Schema::table('badge_user', function(Blueprint $table) {
            $table->dropForeign('badge_user_user_id_foreign');
        });
        Schema::table('tag_review_request', function(Blueprint $table) {
            $table->dropForeign('tag_review_request_tag_id_foreign');
        });
        Schema::table('tag_review_request', function(Blueprint $table) {
            $table->dropForeign('tag_review_request_review_request_id_foreign');
        });
        Schema::table('group_user', function(Blueprint $table) {
            $table->dropForeign('group_user_group_id_foreign');
        });
        Schema::table('group_user', function(Blueprint $table) {
            $table->dropForeign('group_user_user_id_foreign');
        });
    }
}