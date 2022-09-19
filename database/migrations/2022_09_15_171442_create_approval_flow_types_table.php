<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovalFlowTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approval_flow_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('')->comment('流程名');
            $table->integer('approval_type_id')->comment('审批类型id');
            $table->string('desc')->default('')->comment('流程说明');
            $table->text('check_users')->comment('审批人id 按顺序排序');
            $table->unsignedTinyInteger('status');
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
        Schema::dropIfExists('approval_flow_types');
    }
}
