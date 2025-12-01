<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrintsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'prints';
        DB::table($tableName)->insert(
            array(
                [ 'id' => '1' , 'description' => 'Ninguno' ],
                [ 'id' => '2' , 'description' => 'Varios' ],
                [ 'id' => '3' , 'description' => 'Bolitas' ],
                [ 'id' => '4' , 'description' => 'Rayas' ],
                [ 'id' => '5' , 'description' => 'Gales' ],
                [ 'id' => '6' , 'description' => 'Estampado' ],
                [ 'id' => '7' , 'description' => 'Encaje' ],
                [ 'id' => '8' , 'description' => 'Flores' ],
                [ 'id' => '9' , 'description' => 'Jaspeado' ],
                [ 'id' => '10' , 'description' => 'Tejido' ],
            )
        );
    }
}
