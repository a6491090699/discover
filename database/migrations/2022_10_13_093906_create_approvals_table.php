<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approvals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->integer('flow_id')->nullable();
            $table->string('content')->nullable();
            $table->text('remark')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('check_step_sort')->nullable();
            $table->string('check_user_ids')->nullable();
            $table->string('flow_user_ids')->nullable();
            $table->unsignedTinyInteger('check_status')->nullable();
            $table->string('last_user_id')->nullable();
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
        Schema::dropIfExists('approvals');
    }
}
