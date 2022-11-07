<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellPayLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_pay_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn')->default('');
            $table->timestamp('pay_at')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('fee_type_id');
            $table->decimal('contract_money')->nullable();
            $table->decimal('unpay_money')->nullable();
            $table->decimal('this_time_money')->nullable();
            $table->unsignedTinyInteger('pay_method')->nullable();
            $table->text('enclosure')->nullable();
            $table->text('other')->nullable();
            $table->integer('sale_order_id');
            $table->timestamp('check_at')->nullable()->comment('核算时间');
            $table->decimal('caozuo')->nullable()->comment('产生的操作费用');
            $table->decimal('zhanyong')->nullable()->comment('产生的资金占用的费用');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sell_pay_logs');
    }
}
