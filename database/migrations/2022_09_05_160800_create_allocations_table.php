<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn')->default('')->comment('调拨单号');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态');
            $table->dateTime('trans_at')->nullable()->comment('调拨时间');
            $table->integer('out_store_id')->comment('调出仓');
            $table->integer('in_store_id')->comment('调入仓');
            $table->decimal('total_money')->nullable()->comment('调拨金额');
            $table->string('charge_man')->nullable()->comment('负责人');
            $table->text('mark')->nullable()->comment('备注');
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
        Schema::dropIfExists('allocations');
    }
}
