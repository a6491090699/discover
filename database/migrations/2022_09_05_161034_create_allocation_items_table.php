<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllocationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocation_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('allocation_id')->comment('调拨单');
            $table->integer('sku_id')->comment('属性');
            $table->integer('product_id')->comment('产品');
            $table->string('num')->nullable()->comment('数量');
            $table->decimal('price')->nullable()->comment('单价');
            $table->decimal('sum_price')->nullable()->comment('总价');
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
        Schema::dropIfExists('allocation_items');
    }
}
