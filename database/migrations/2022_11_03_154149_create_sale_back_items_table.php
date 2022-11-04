<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleBackItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_back_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->nullable()->comment('订单id');
            $table->integer('sku_id')->nullable()->comment('产品id');
            $table->integer('should_num')->nullable()->comment('应到数目');
            $table->integer('actual_num')->nullable()->comment('实到数目');
            $table->float('price')->nullable()->comment('价格');
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
        Schema::dropIfExists('sale_back_items');
    }
}
