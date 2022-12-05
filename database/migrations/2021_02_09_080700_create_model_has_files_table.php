<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelHasFilesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('model_has_files', function (Blueprint $table) {
            $table->integer('file_id')->unsigned();
            $table->morphs('model', 'file');
            $table->integer('position')->unsigned();

            $table->foreign('file_id')
                ->references('id')
                ->on('files')
                ->onDelete('cascade');

            $table->primary(['file_id', 'model_id', 'model_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('model_has_files');
    }
}
