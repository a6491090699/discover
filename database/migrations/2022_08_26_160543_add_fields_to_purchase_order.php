<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPurchaseOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_order', function (Blueprint $table) {
            $table->integer('frame_contract_id')->nullable()->comment('关联框架合同');
            $table->unsignedTinyInteger('type')->nullable()->comment('采购类型');
            $table->date('sign_at')->nullable()->comment('签订时间');
            $table->string('sign_man')->nullable()->comment('签订人');
            $table->unsignedTinyInteger('pay_method')->default('0')->comment('支付方式 1.TT 2.信用证 3.承兑汇票');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_order', function (Blueprint $table) {
            $table->dropColumn('frame_contract_id');
            $table->dropColumn('type');
            $table->dropColumn('sign_at');
            $table->dropColumn('sign_man');
            $table->dropColumn('pay_method');
        });
    }
}
