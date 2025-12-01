<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'groups';
        DB::table($tableName)->insert(
            array(
                [ 'id' => '1' , 'name' => 'Administración' , 'icon' => 'fa fa-cogs' ],
                [ 'id' => '2' , 'name' => 'Operación' , 'icon' => 'fa fa-briefcase' ],
                [ 'id' => '3' , 'name' => 'Reportes' , 'icon' => 'fa fa-newspaper-o' ],
            )
        );
    }
}
