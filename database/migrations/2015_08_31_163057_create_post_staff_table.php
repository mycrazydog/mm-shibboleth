<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	//
    	Schema::create('staff', function (Blueprint $table)  {
    		$table->increments('id')->unsigned();
    		$table->string('first_name');   
    		$table->string('last_name');  
    		$table->timestamps();        
    	});    
    
        //
        Schema::create('post_staff', function (Blueprint $table)  {
            $table->integer('post_id')->unsigned()->index();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            
            $table->integer('staff_id')->unsigned()->index();   
            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
            
            $table->timestamps();                               
        });
        
        //

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('staff');
        Schema::drop('post_staff');       
    }
}
