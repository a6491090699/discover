<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalMoneyToPurchaseOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_order', function (Blueprint $table) {
            $table->decimal('total_money', 20, 2)->default(0)->comment('订单总价');
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
            $table->dropColumn('total_money');
        });
    }
}
