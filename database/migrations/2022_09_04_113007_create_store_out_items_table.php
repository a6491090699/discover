<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreOutItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_out_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('store_out_id')->default('')->comment('出库单');
            $table->string('sku_id')->nullable()->comment('属性');
            $table->string('should_num')->nullable()->comment('应出数量');
            $table->string('actual_num')->nullable()->comment('实出数量');
            $table->string('price')->nullable()->comment('单价');
            $table->string('sum_price')->nullable()->comment('总金额');
            $table->string('product_id')->nullable()->comment('产品');
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
        Schema::dropIfExists('store_out_items');
    }
}
