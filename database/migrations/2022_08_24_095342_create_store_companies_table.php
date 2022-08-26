<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('');
            $table->string('short_title')->default('')->comment('简称');
            $table->string('address')->default('');
            $table->string('charge_man')->default('');
            $table->string('tel')->default('');
            $table->string('tax_code')->default('');
            $table->string('bank')->default('');
            $table->string('bank_account')->default('');
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
        Schema::dropIfExists('store_companies');
    }
}
