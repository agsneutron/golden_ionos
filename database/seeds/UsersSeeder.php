<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'users';
        DB::table($tableName)->insert(
            array(
                [ 'id' => '1' , 'id_user_type' => '1' , 'name' => 'Iván Chávez' , 'email' => 'ivan.chavez@encodesystems.com' , 'password'=>bcrypt('devICG'),'address' => '' , 'phone' => '' , 'postal_code' => '0' ],
                [ 'id' => '2' , 'id_user_type' => '2' , 'name' => 'Jesus Aguirre' , 'email' => 'jaguirre1966@gmail.com' , 'password'=>bcrypt('g0ld3n'),'address' => '' , 'phone' => '' , 'postal_code' => '0' ],
                [ 'id' => '3' , 'id_user_type' => '2' , 'name' => 'Tere' , 'email' => 'riv-ba@hotmail.com' , 'password'=>bcrypt('g0ld3n'),'address' => '' , 'phone' => '' , 'postal_code' => '0' ],
            )
        );
    }
}
