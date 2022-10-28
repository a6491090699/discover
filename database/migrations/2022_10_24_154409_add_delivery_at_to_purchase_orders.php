<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryAtToPurchaseOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_order', function (Blueprint $table) {
            $table->dateTime('receive_deadline')->nullable();
            $table->integer('store_id')->nullable();
            $table->integer('objection_days')->nullable();
            $table->float('liquidated_damage_rate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_order', function (Blueprint $table) {
            $table->dropColumn('receive_deadline');
            $table->dropColumn('store_id');
            $table->dropColumn('objection_days');
            $table->dropColumn('liquidated_damage_rate');
        });
    }
}
