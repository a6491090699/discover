<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseBackItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_back_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_order_back_id')->comment('退货订单id');
            $table->integer('product_id')->nullable()->comment('产品id');
            $table->integer('sku_id')->comment('属性');
            $table->integer('back_num')->nullable()->comment('退货数量');
            $table->decimal('price')->nullable()->comment('价格');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_back_items');
    }
}
