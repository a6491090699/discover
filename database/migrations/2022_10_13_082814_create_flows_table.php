<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flows', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('check_type')->default('1')->nullable()->comment('类型');
            $table->string('title')->nullable()->comment('标题');
            $table->text('remark')->nullable()->comment('备注');
            $table->text('flow_list')->nullable()->comment('json数据');
            $table->integer('user_id')->nullable()->comment('创建人');
            $table->integer('template_id')->nullable();
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
        Schema::dropIfExists('flows');
    }
}
