<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdvanceChargeMoneyToSaleOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sale_order', function (Blueprint $table) {
            $table->decimal('advance_charge_money',10 , 2)->nullable()->comment('预付款');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sale_order', function (Blueprint $table) {
            $table->dropColumn('advance_charge_money');
        });
    }
}
