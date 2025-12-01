<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrioritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'priorities';
        DB::table($tableName)->insert(
            array(
                [ 'id' => '1' , 'description' => 'Normal' ],
                [ 'id' => '2' , 'description' => 'Urgente' ],
                [ 'id' => '3' , 'description' => 'Extra urgente' ],
            )
        );
    }
}
