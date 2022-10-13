<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_uid')->nullable()->comment('发送方');
            $table->integer('to_uid')->nullable()->comment('接受方');
            $table->text('content')->nullable()->comment('内容');
            $table->unsignedTinyInteger('is_read')->nullable()->comment('是否已读');
            $table->unsignedTinyInteger('type')->nullable()->comment('类型');
            $table->string('to_url')->nullable()->comment('跳转地址');
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
        Schema::dropIfExists('messages');
    }
}
