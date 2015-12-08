<?php

use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
	  //delete users table records
	  DB::table('staff')->delete();
	  //insert some dummy records
	  DB::table('staff')->insert(array(
	      array('first_name'=>'Anne-Marie', 'last_name'=>'Mills'),
	      array('first_name'=>'Mary', 'last_name'=>'Newsom'),
	      array('first_name'=>'Ida', 'last_name'=>'Stavenger'),
	      array('first_name'=>'Jeff', 'last_name'=>'Michael'),
	      array('first_name'=>'Linda', 'last_name'=>'Shipley'),
	      array('first_name'=>'Laura', 'last_name'=>'Simmons'),
	      array('first_name'=>'Charles', 'last_name'=>'Andrews'),
	      array('first_name'=>'Claire', 'last_name'=>'Apaliski'),
	      array('first_name'=>'Zach', 'last_name'=>'Szczepaniak'),
	      array('first_name'=>'Amy Hawn', 'last_name'=>'Nelson'),
	      array('first_name'=>'Ashley', 'last_name'=>'Clark'),
	      array('first_name'=>'Miriam', 'last_name'=>'McManus'),
	      array('first_name'=>'Diane', 'last_name'=>'Gavarkavich'),
	      array('first_name'=>'Marsha', 'last_name'=>'Armes'),
	      array('first_name'=>'Kevin', 'last_name'=>'Hart'),
	      array('first_name'=>'Jody', 'last_name'=>'Pressley'),
	      array('first_name'=>'Ian', 'last_name'=>'Tyndall'),
	      array('first_name'=>'David', 'last_name'=>'Hill'),
	      array('first_name'=>'Robin', 'last_name'=>'Miller'),
	      array('first_name'=>'Jacob', 'last_name'=>'Schmidt'),	
	   ));
	}
}
