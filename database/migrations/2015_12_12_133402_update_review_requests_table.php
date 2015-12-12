<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateReviewRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * We're using two calls bacuse we cannot create and drop column
         * in single tranzaction
         */
        Schema::table('review_requests', function (Blueprint $table) {
            $table->dropColumn('date_review');
        });

        Schema::table('review_requests', function (Blueprint $table) {
            $table->dateTime('date_review')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('review_requests', function (Blueprint $table) {
            $table->dropColumn('date_review');
        });

        Schema::table('review_requests', function (Blueprint $table) {
            $table->timestamp('date_review');
        });
    }
}
