<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('')->comment('服务商名称');
            $table->string('short_title')->default('')->comment('简称');
            $table->string('sn')->default('')->comment('供应商编码');
            $table->unsignedTinyInteger('type')->comment('类型 1.物流|2.货代3.报关行');
            $table->string('address')->default('')->comment('地址');
            $table->unsignedTinyInteger('status')->comment('状态1启用 2禁用');
            $table->string('link')->default('')->comment('联系人');
            $table->string('contact_department')->default('')->comment('联系人职位');
            $table->string('contact_email')->default('')->comment('联系邮箱');
            $table->string('phone')->default('')->comment('联系手机');
            $table->string('contact_tel')->default('')->comment('联系电话');
            $table->string('bank_title')->default('')->comment('开户名称');
            $table->string('bank_name')->default('')->comment('开户银行');
            $table->string('bank_account')->default('')->comment('银行账号');
            $table->string('bank_top')->default('')->comment('发票抬头');
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
        Schema::dropIfExists('providers');
    }
}
