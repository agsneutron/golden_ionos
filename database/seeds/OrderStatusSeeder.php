<?php

use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'order_status';
        DB::table($tableName)->insert(
            array(
                [ 'id' => '1' , 'description' => 'En registro' , 'color' => '#9A9E9E' ],
                [ 'id' => '2' , 'description' => 'Pendiente' , 'color' => '#37B7CF' ],
                [ 'id' => '3' , 'description' => 'En proceso' , 'color' => '#F6AB61' ],
                [ 'id' => '4' , 'description' => 'Retrabajo' , 'color' => '#EB5868' ],
                [ 'id' => '5' , 'description' => 'Terminada' , 'color' => '#2685C4' ],
                [ 'id' => '6' , 'description' => 'Entregada' , 'color' => '#9DCA48' ],
                [ 'id' => '7' , 'description' => 'Cancelada' , 'color' => '#EC031C' ],
            )
        );
    }
}
