<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTemplateDataToFrameContracts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('frame_contracts', function (Blueprint $table) {
            $table->integer('template_id')->nullable()->comment('合作协议模板id');
            $table->longText('template_data')->nullable()->comment('合作协议模板参数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('frame_contracts', function (Blueprint $table) {
            $table->dropColumn('template_id');
            $table->dropColumn('template_data');
        });
    }
}
