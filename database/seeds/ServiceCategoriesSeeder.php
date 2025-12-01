<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'service_categories';
        DB::table($tableName)->insert(
            array(
                [ 'id' => '1' , 'id_service_group' => null , 'description' => 'LAVANDERIA' ],
                [ 'id' => '2' , 'id_service_group' => null , 'description' => 'COSTURA' ],
                [ 'id' => '3' , 'id_service_group' => null , 'description' => 'TINTORERIA' ],
                [ 'id' => '4' , 'id_service_group' => null , 'description' => 'PLANCHADO' ],
                [ 'id' => '5' , 'id_service_group' => null , 'description' => 'PAQUETES' ],
                [ 'id' => '6' , 'id_service_group' => null , 'description' => 'EMPRESAS' ],
            )
        );
    }
}
