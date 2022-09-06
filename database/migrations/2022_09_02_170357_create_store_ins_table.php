<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_ins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn')->default('')->comment('入库单号');
            $table->dateTime('in_at')->comment('入库日期');
            $table->integer('store_id')->comment('入库仓库');
            // $table->unsignedTinyInteger('type')->comment('入库类型');
            $table->integer('order_id')->comment('关联订单id 采购订单or销售订单morph id');
            $table->string('order_type')->comment('关联订单id 采购订单or销售订单 morph type');
            $table->unsignedTinyInteger('status')->comment('状态  1,已入库 2未入库');
            $table->decimal('total_money')->comment('入库金额');
            $table->string('car_number')->default('')->comment('车牌号或柜号');
            $table->integer('delivery_id')->nullable()->comment('物流单号');
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
        Schema::dropIfExists('store_ins');
    }
}
