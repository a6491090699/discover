<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->unsignedTinyInteger('status');
            $table->string('sn')->default('');
            $table->string('short_title')->default('')->comment('简称');
            $table->string('signatory')->default('');
            $table->string('department')->default('');
            $table->date('sign_start_at')->nullable();
            $table->date('sign_stop_at')->nullable();
            $table->string('money_limit')->default('');
            $table->string('address')->default('');
            $table->string('contact_tel')->default('');
            $table->string('contact_qq')->default('');
            $table->string('contact_email')->default('');
            $table->string('contact_department')->default('');
            $table->string('bank_title')->default('');
            $table->string('bank_name')->default('');
            $table->string('bank_account')->default('');
            $table->string('bank_top')->default('');
            $table->string('tax_code')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('sn');
            $table->dropColumn('short_title');
            $table->dropColumn('signatory');
            $table->dropColumn('department');
            $table->dropColumn('sign_start_at');
            $table->dropColumn('sign_stop_at');
            $table->dropColumn('money_limit');
            $table->dropColumn('address');
            $table->dropColumn('contact_tel');
            $table->dropColumn('contact_qq');
            $table->dropColumn('contact_email');
            $table->dropColumn('contact_department');
            $table->dropColumn('bank_title');
            $table->dropColumn('bank_name');
            $table->dropColumn('bank_account');
            $table->dropColumn('bank_top');
            $table->dropColumn('tax_code');
        });
    }
}
