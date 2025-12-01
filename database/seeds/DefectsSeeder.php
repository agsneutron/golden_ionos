<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'defects';
        DB::table($tableName)->insert(
            array(
                [ 'id' => '1' , 'description' => 'Ninguno' ],
                [ 'id' => '2' , 'description' => 'Varios' ],
                [ 'id' => '3' , 'description' => 'Manchdo' ],
                [ 'id' => '4' , 'description' => 'Muy manchado' ],
                [ 'id' => '5' , 'description' => 'Sin raya' ],
                [ 'id' => '6' , 'description' => 'Botones rotos' ],
                [ 'id' => '7' , 'description' => 'Falta de botones' ],
                [ 'id' => '8' , 'description' => 'Roto' ],
                [ 'id' => '9' , 'description' => 'Decolorado' ],
                [ 'id' => '10' , 'description' => 'Descocido' ],
            )
        );
    }
}
