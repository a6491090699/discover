<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flow_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('approval_id');
            $table->integer('step_id');
            $table->integer('check_user_id');
            $table->text('content');
            $table->tinyIncrements('status')->default(0)->comment('0未审核 1成功  2 失败 ');
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
        Schema::dropIfExists('flow_records');
    }
}