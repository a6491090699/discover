<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreInItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_in_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_in_id')->comment('入库id');
            $table->integer('sku_id')->comment('属性');
            $table->integer('should_num')->nullable()->comment('应收数量');
            $table->integer('actual_num')->nullable()->comment('实收数量');
            $table->decimal('price')->nullable()->comment('单价');
            $table->decimal('sum_price')->nullable()->comment('总金额');
            $table->string('product_id')->default('')->comment('产品id');
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
        Schema::dropIfExists('store_in_items');
    }
}
