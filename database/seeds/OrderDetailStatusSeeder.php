<?php

use Illuminate\Database\Seeder;

class OrderDetailStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'order_detail_status';
        DB::table($tableName)->insert(
            array(
                [ 'id' => '1' , 'description' => 'Pendiente' , 'color' => '#37B7CF' ],
                [ 'id' => '2' , 'description' => 'En proceso' , 'color' => '#F6AB61' ],
                [ 'id' => '3' , 'description' => 'Retrabajo' , 'color' => '#EB5868' ],
                [ 'id' => '4' , 'description' => 'Terminada' , 'color' => '#2685C4' ],
                [ 'id' => '5' , 'description' => 'Entregada' , 'color' => '#9DCA48' ],
            )
        );
    }
}
