<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_outs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn')->default('')->comment('出库单号');
            $table->dateTime('out_at')->nullable()->comment('出库时间');
            $table->integer('store_id')->comment('出库仓库');
            $table->integer('order_id')->comment('关联订单');
            $table->string('order_type')->default('')->comment('关联订单');
            $table->unsignedTinyInteger('status')->comment('状态');
            $table->decimal('total_money')->nullable()->comment('出库金额');
            $table->string('car_number')->nullable()->comment('车牌号或柜号');
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
        Schema::dropIfExists('store_outs');
    }
}
