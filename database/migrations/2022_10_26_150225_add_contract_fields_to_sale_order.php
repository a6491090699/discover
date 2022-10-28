<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContractFieldsToSaleOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sale_order', function (Blueprint $table) {
            $table->timestamp('deposit_deadline')->nullable()->comment('最迟定金时间');
            $table->timestamp('last_money_deadline')->nullable()->comment('最迟尾款日期');
            $table->integer('objection_days')->nullable()->comment('逾期xx天算违约');
            $table->integer('store_id')->nullable()->comment('出库仓库id');
            $table->float('liquidated_damage_rate')->nullable()->comment('违约金比例');
            $table->float('bond_rate')->nullable()->comment('保证金比例');
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
            $table->dropColumn('deposit_deadline');
            $table->dropColumn('last_money_deadline');
            $table->dropColumn('objection_days');
            $table->dropColumn('store_id');
            $table->dropColumn('liquidated_damage_rate');
            $table->dropColumn('bond_rate');
        });
    }
}
