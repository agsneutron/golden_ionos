<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Modules2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'modules';
        DB::table($tableName)->insert(
            array(
                [ 'id' => '20' , 'id_group' => '2' , 'name' => 'Reporte de entregas' , 'url' => 'delivery_report' , 'icon' => 'fa fa-table' , 'active' => '1' , 'order' => '7' ],                
            )
        );
    }
}
