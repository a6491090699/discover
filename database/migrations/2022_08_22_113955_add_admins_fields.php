<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminsFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_users' , function(Blueprint $table){
            $table->integer('department_id')->default(0);
            $table->string('tel');
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
        Schema::table('admin_users' , function(Blueprint $table){
            $table->dropColumn('department_id');
            $table->dropColumn('tel');
            $table->dropSoftDeletes();
        });
    }
}
