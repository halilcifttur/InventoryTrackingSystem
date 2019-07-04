<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([

        	'name' => 'Computer Engineering',
        ]);

        DB::table('departments')->insert([

        	'name' => 'Psychology',
        ]);
    }
}
