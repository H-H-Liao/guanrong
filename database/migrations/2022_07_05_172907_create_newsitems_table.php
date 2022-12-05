<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewsitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return null
     */
    public function up()
    {
        Schema::create('newsitems', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('image_id')->unsigned()->nullable();
            $table->json('status');
            $table->json('title');
            $table->json('body');
            //依照時間顯示項目
            $table->date('show_date');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('no_end_date')->default(0);
            //meta
            $table->json('slug');
            $table->json('meta_title');
            $table->json('meta_keywords');
            $table->json('meta_description');
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
        Schema::drop('newsitems');
    }
}
