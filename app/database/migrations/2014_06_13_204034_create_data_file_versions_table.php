<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataFileVersionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('data_file_versions', function($table) {
            $table->increments('id');
            $table->integer('data_file_id')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->string('path');
            $table->integer('size');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            
            $table->foreign('data_file_id')->references('id')->on('data_files');
        });
        
        Schema::table('data_files', function($table){
            $table->unsignedInteger('version_id')->nullable();
            
            $table->foreign('version_id')->references('id')->on('data_file_versions')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('data_files', function($table){
            $table->dropForeign('data_files_version_id_foreign');
            $table->dropColumn('version_id');
        });
        
        Schema::drop('data_file_versions');
    }

}
