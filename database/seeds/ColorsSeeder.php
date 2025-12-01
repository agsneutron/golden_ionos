<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'colors';
        DB::table($tableName)->insert(
            array(
                [ 'id' => '1' , 'description' => 'Varios' ],
                [ 'id' => '2' , 'description' => 'Gris' ],
                [ 'id' => '3' , 'description' => 'Café' ],
                [ 'id' => '4' , 'description' => 'Azul' ],
                [ 'id' => '5' , 'description' => 'Morado' ],
                [ 'id' => '6' , 'description' => 'Verde' ],
                [ 'id' => '7' , 'description' => 'Naranja' ],
                [ 'id' => '8' , 'description' => 'Amarillo' ],
                [ 'id' => '9' , 'description' => 'Rojo' ],
            )
        );
    }
}
