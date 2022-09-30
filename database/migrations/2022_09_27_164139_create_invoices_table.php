<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sell_pay_log_id');
            $table->string('sn')->nullable();
            $table->string('invoice_no')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamp('invoice_at')->nullable();
            $table->decimal('money')->nullable();
            $table->unsignedTinyInteger('type')->default('0');
            $table->text('other')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
