<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'payment_methods';
        DB::table($tableName)->insert(
            array(
                [ 'id' => '1' , 'description' => 'Efectivo' ],
                [ 'id' => '2' , 'description' => 'Tarjeta bancaria' ],
                [ 'id' => '3' , 'description' => 'Monedero' ],
                [ 'id' => '4' , 'description' => 'Transferencia bancaria' ],
            )
        );
    }
}
