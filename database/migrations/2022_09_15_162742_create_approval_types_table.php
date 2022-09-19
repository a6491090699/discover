<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovalTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approval_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('')->comment('类型');
            $table->unsignedTinyInteger('status')->default('1')->comment('状态');
            $table->integer('order')->default('0')->comment('排序');
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
        Schema::dropIfExists('approval_types');
    }
}
