<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_company_id');
            $table->string('sn')->default('');
            $table->string('position')->default('');
            $table->string('man')->default('');
            $table->string('tel')->default('');
            $table->tinyInteger('type')->comment('按面积|按重量 收仓储费');
            $table->decimal('save_price');
            $table->decimal('move_price');
            $table->string('title')->default('');
            $table->string('short_title')->default('')->comment('简称');
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
        Schema::dropIfExists('stores');
    }
}
