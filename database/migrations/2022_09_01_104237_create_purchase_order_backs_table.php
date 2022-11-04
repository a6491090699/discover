<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderBacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_backs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn')->nullable()->comment('退货单号');
            $table->dateTime('back_at')->nullable()->comment('退货日期');
            $table->integer('purchase_order_id')->comment('采购合同');
            $table->integer('store_id')->nullable()->comment('退货出库仓库');
            $table->integer('supplier_id')->nullable()->comment('供应商');
            $table->decimal('back_money')->nullable()->comment('退货金额');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态');
            $table->string('other')->nullable()->comment('其他字段');
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
        Schema::dropIfExists('purchase_order_backs');
    }
}
