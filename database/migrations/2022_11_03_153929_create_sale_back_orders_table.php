<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleBackOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_back_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn')->nullable()->comment('编号');
            $table->integer('sale_back_order_id')->nullable()->comment('关联销售合同');
            $table->tinyInteger('status')->nullable()->comment('状态');
            $table->integer('store_id')->nullable()->comment('入库id');
            $table->float('back_money')->nullable()->comment('金额');
            $table->text('other')->nullable()->comment('备注');
            $table->tinyInteger('review_status')->nullable()->comment('审核状态');
            $table->integer('user_id')->nullable()->comment('创建用户');
            $table->timestamp('back_at')->nullable()->comment('退回时间');
            $table->timestamp('finished_at')->nullable()->comment('结束时间(收到时间)');
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
        Schema::dropIfExists('sale_back_orderss');
    }
}
