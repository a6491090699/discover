<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrameContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frame_contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn')->index()->default('')->comment('框架合同编号');
            $table->decimal('money')->nullable()->comment('合同总额');
            $table->integer('customer_id')->default('0')->comment('客户');
            $table->longText('products')->nullable();
            $table->decimal('year_rate')->nullable();
            $table->decimal('money_zy')->nullable();
            $table->decimal('money_czf')->nullable();
            $table->decimal('money_wlf')->nullable();
            $table->decimal('money_ccf')->nullable();
            $table->decimal('money_yhsxf')->nullable();
            $table->decimal('money_jkgs')->nullable();
            $table->decimal('money_zzs')->nullable();
            $table->decimal('money_sc')->nullable();
            $table->longText('money_other')->nullable();
            $table->unsignedTinyInteger('status')->default('0');
            $table->longText('pics')->nullable();
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
        Schema::dropIfExists('frame_contracts');
    }
}
