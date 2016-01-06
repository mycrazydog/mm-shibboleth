<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    //
	    Schema::create('post_department', function (Blueprint $table)  {
	        $table->integer('post_id')->unsigned()->index();
	        $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
	        
	        $table->integer('department_id')->unsigned()->index();   
	        $table->foreign('department_id')->references('id')->on('staff')->onDelete('cascade');
	        
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
		Schema::drop('post_department');   
    }
}
