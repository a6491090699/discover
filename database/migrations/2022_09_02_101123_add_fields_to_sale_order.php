<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToSaleOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sale_order', function (Blueprint $table) {
            $table->integer('frame_contract_id')->nullable()->comment('关联框架合同');
            $table->unsignedTinyInteger('type')->nullable()->comment('销售类型 1,出口 2,内贸');
            $table->date('sign_at')->nullable()->comment('签订时间');
            $table->date('send_at')->nullable()->comment('交货时间');
            $table->string('sign_man')->nullable()->comment('签订人');
            $table->decimal('total_money',20,2)->nullable()->default(0)->comment('合同金额');
            $table->string('total_money_cn')->nullable()->comment('中文大写');
            $table->unsignedTinyInteger('pay_method')->default('0')->comment('支付方式 1.TT 2.信用证 3.承兑汇票');
            $table->text('params')->nullable()->comment('额外参数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sale_order', function (Blueprint $table) {
            $table->dropColumn('frame_contract_id');
            $table->dropColumn('type');
            $table->dropColumn('sign_at');
            $table->dropColumn('send_at');
            $table->dropColumn('sign_man');
            $table->dropColumn('total_money');
            $table->dropColumn('total_money_cn');
            $table->dropColumn('pay_method');
            $table->dropColumn('other');
        });
    }
}
