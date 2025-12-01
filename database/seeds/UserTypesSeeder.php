<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'user_types';
        DB::table($tableName)->insert(
            array(
                [ 'id' => '1' , 'description' => 'Desarrollador' , 'flag_asigned_branch' => '0' ],
                [ 'id' => '2' , 'description' => 'Administrador' , 'flag_asigned_branch' => '0' ],
                [ 'id' => '3' , 'description' => 'Encargado' , 'flag_asigned_branch' => '1' ],
                [ 'id' => '4' , 'description' => 'Cliente' , 'flag_asigned_branch' => '0' ],
                [ 'id' => '5' , 'description' => 'Repartidor/Recolector' , 'flag_asigned_branch' => '0' ],
            )
        );
    }
}
