<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReviewStatusToSometable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('store_ins', function (Blueprint $table) {
            $table->unsignedTinyInteger('review_status')->default(0);
            $table->unsignedTinyInteger('user_id')->nullable();
        });

        Schema::table('store_outs', function (Blueprint $table) {
            $table->unsignedTinyInteger('review_status')->default(0);
            $table->unsignedTinyInteger('user_id')->nullable();
        });

        Schema::table('allocations', function (Blueprint $table) {
            $table->unsignedTinyInteger('review_status')->default(0);
            $table->unsignedTinyInteger('user_id')->nullable();
        });
        Schema::table('purchase_order_backs', function (Blueprint $table) {
            $table->unsignedTinyInteger('review_status')->default(0);
            $table->unsignedTinyInteger('user_id')->nullable();
        });
        Schema::table('stock_history', function (Blueprint $table) {
            $table->integer('store_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->string('order_type')->nullable();
        });
        Schema::table('product', function (Blueprint $table) {
            $table->integer('product_category_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('store_ins', function (Blueprint $table) {
            $table->dropColumn('review_status');
            $table->dropColumn('user_id');
        });
        Schema::table('store_outs', function (Blueprint $table) {
            $table->dropColumn('review_status');
            $table->dropColumn('user_id');
        });
        Schema::table('allocations', function (Blueprint $table) {
            $table->dropColumn('review_status');
            $table->dropColumn('user_id');
        });
        Schema::table('purchase_order_backs', function (Blueprint $table) {
            $table->dropColumn('review_status');
            $table->dropColumn('user_id');
        });
        Schema::table('stock_history', function (Blueprint $table) {
            $table->dropColumn('store_id');
            $table->dropColumn('order_type');
        });
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn('product_category_id');
        });
    }
}
