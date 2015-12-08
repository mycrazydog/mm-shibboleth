<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
            // Update the users table
            Schema::table('posts', function ($table) {
                $table->integer('user_id_updater')->unsigned()->nullable()->after('user_id');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
            // Update the users table
            Schema::table('posts', function ($table) {
                $table->dropColumn('user_id_updater');
            });
        });
    }
}
