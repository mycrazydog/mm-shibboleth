<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostSourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        //
        Schema::create('sources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        
        //
        Schema::create('post_source', function (Blueprint $table)  {            
            $table->integer('post_id')->unsigned()->index();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            
            $table->integer('source_id')->unsigned()->index(); 
            $table->foreign('source_id')->references('id')->on('sources')->onDelete('cascade'); 
            
            $table->timestamps();                         
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('sources');
        Schema::drop('post_source');
    }
}
