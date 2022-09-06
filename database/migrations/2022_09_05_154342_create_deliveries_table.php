<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->comment('关联订单');
            $table->string('order_type')->default('')->comment('关联订单模型');
            $table->string('sn')->default('')->comment('物流单号');
            $table->string('company')->nullable()->comment('物流公司');
            $table->dateTime('send_at')->nullable()->comment('发货日期');
            $table->dateTime('arrived_at')->nullable()->comment('到货日期');
            $table->unsignedTinyInteger('status')->nullable()->comment('状态');
            $table->decimal('money')->nullable()->comment('物流费用');
            $table->text('enclosure')->nullable()->comment('附件');
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
        Schema::dropIfExists('deliveries');
    }
}
