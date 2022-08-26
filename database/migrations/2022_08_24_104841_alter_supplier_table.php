<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier', function (Blueprint $table) {
            $table->string('short_title')->default('')->comment('简称');
            $table->string('sn')->default('')->comment('供应商编码');
            $table->unsignedTinyInteger('type')->comment('类型 1.贸易商|2.工厂');
            $table->unsignedTinyInteger('status')->comment('状态1.启用|2.停用');
            $table->string('address')->default('')->comment('地址');
            $table->string('contact_department')->default('')->comment('联系人职位');
            $table->string('contact_tel')->default('')->comment('联系人电话');
            $table->string('contact_email')->default('')->comment('联系邮箱');
            $table->string('bank_title')->default('')->comment('开户名称');
            $table->string('bank_name')->default('')->comment('开户银行');
            $table->string('bank_account')->default('')->comment('银行账号');
            $table->string('bank_top')->default('')->comment('发票抬头');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supplier', function (Blueprint $table) {
            $table->dropColumn('sn');
            $table->dropColumn('short_title');
            $table->dropColumn('type');
            $table->dropColumn('status');
            $table->dropColumn('address');
            $table->dropColumn('contact_department');
            $table->dropColumn('contact_email');
            $table->dropColumn('contact_tel');
            $table->dropColumn('bank_title');
            $table->dropColumn('bank_name');
            $table->dropColumn('bank_account');
            $table->dropColumn('bank_top');
        });
    }
}
