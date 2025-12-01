<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'profile_permissions';
        DB::table($tableName)->insert(
            array(
                [ 'id' => '1' , 'id_user_type' => '1' , 'id_module' => '1' ],
                [ 'id' => '2' , 'id_user_type' => '1' , 'id_module' => '2' ],
                [ 'id' => '3' , 'id_user_type' => '1' , 'id_module' => '3' ],
                [ 'id' => '4' , 'id_user_type' => '1' , 'id_module' => '4' ],
                [ 'id' => '5' , 'id_user_type' => '1' , 'id_module' => '5' ],
                [ 'id' => '6' , 'id_user_type' => '1' , 'id_module' => '6' ],
                [ 'id' => '7' , 'id_user_type' => '1' , 'id_module' => '7' ],
                [ 'id' => '8' , 'id_user_type' => '1' , 'id_module' => '8' ],
                [ 'id' => '9' , 'id_user_type' => '1' , 'id_module' => '9' ],
                [ 'id' => '10' , 'id_user_type' => '1' , 'id_module' => '10' ],
                [ 'id' => '11' , 'id_user_type' => '1' , 'id_module' => '11' ],
                [ 'id' => '12' , 'id_user_type' => '1' , 'id_module' => '12' ],
                [ 'id' => '13' , 'id_user_type' => '1' , 'id_module' => '13' ],
                [ 'id' => '14' , 'id_user_type' => '1' , 'id_module' => '14' ],
                [ 'id' => '15' , 'id_user_type' => '1' , 'id_module' => '15' ],
                [ 'id' => '16' , 'id_user_type' => '1' , 'id_module' => '16' ],
                [ 'id' => '17' , 'id_user_type' => '1' , 'id_module' => '17' ],
                [ 'id' => '18' , 'id_user_type' => '1' , 'id_module' => '18' ],
                [ 'id' => '19' , 'id_user_type' => '2' , 'id_module' => '1' ],
                [ 'id' => '20' , 'id_user_type' => '2' , 'id_module' => '2' ],
                [ 'id' => '21' , 'id_user_type' => '2' , 'id_module' => '3' ],
                [ 'id' => '22' , 'id_user_type' => '2' , 'id_module' => '4' ],
                [ 'id' => '23' , 'id_user_type' => '2' , 'id_module' => '5' ],
                [ 'id' => '24' , 'id_user_type' => '2' , 'id_module' => '6' ],
                [ 'id' => '25' , 'id_user_type' => '2' , 'id_module' => '7' ],
                [ 'id' => '26' , 'id_user_type' => '2' , 'id_module' => '8' ],
                [ 'id' => '27' , 'id_user_type' => '2' , 'id_module' => '9' ],
                [ 'id' => '28' , 'id_user_type' => '2' , 'id_module' => '10' ],
                [ 'id' => '29' , 'id_user_type' => '2' , 'id_module' => '11' ],
                [ 'id' => '30' , 'id_user_type' => '2' , 'id_module' => '12' ],
                [ 'id' => '31' , 'id_user_type' => '2' , 'id_module' => '13' ],
                [ 'id' => '32' , 'id_user_type' => '2' , 'id_module' => '14' ],
                [ 'id' => '33' , 'id_user_type' => '2' , 'id_module' => '15' ],
                [ 'id' => '34' , 'id_user_type' => '2' , 'id_module' => '16' ],
                [ 'id' => '35' , 'id_user_type' => '2' , 'id_module' => '17' ],
                [ 'id' => '36' , 'id_user_type' => '2' , 'id_module' => '18' ],
            )
        );
    }
}
