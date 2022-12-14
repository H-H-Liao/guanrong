<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagebannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return null
     */
    public function up()
    {
        Schema::create('pagebanners', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('image_id')->unsigned()->nullable();
            $table->json('status');
            $table->text('target')->nullable();//目標頁面
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return null
     */
    public function down()
    {
        Schema::drop('pagebanners');
    }
}
