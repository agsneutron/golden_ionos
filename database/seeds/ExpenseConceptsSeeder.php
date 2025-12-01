<?php

use Illuminate\Database\Seeder;

class ExpenseConceptsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'expense_concepts';
        DB::table($tableName)->insert(
            array(
                [ 'id' => '1' , 'description' => 'Detergente liquido' ],
                [ 'id' => '2' , 'description' => 'Detergente en polvo' ],
                [ 'id' => '3' , 'description' => 'Cloro' ],
                [ 'id' => '4' , 'description' => 'Ganchos' ],
                [ 'id' => '5' , 'description' => 'Bolsas' ],
            )
        );
    }
}
