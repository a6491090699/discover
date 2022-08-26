<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->unsignedTinyInteger('category_id');
            $table->string('bar_code')->default('');
            $table->string('quality_time')->default('');
            $table->date('product_date')->nullable();
            $table->string('pics')->default('');
            $table->integer('stock_max');
            $table->integer('stock_min');
            $table->longText('mark');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn('category_id');
            $table->dropColumn('bar_code');
            $table->dropColumn('quality_time');
            $table->dropColumn('product_date');
            $table->dropColumn('pics');
            $table->dropColumn('stock_max');
            $table->dropColumn('stock_min');
            $table->dropColumn('mark');
        });
    }
}
