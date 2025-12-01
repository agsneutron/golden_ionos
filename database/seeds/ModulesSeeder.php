<?php

use Illuminate\Database\Seeder;

class ModulesSeeder extends Seeder
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
                [ 'id' => '1' , 'id_group' => '1' , 'name' => 'Usuarios' , 'url' => 'users' , 'icon' => 'fa fa-users' , 'active' => '1' , 'order' => '1' ],
                [ 'id' => '2' , 'id_group' => '1' , 'name' => 'Permisos' , 'url' => 'permits' , 'icon' => 'fa fa-lock' , 'active' => '1' , 'order' => '2' ],
                [ 'id' => '3' , 'id_group' => '1' , 'name' => 'Sucursales' , 'url' => 'branch_offices' , 'icon' => 'fa fa-flag-checkered' , 'active' => '1' , 'order' => '3' ],
                [ 'id' => '4' , 'id_group' => '1' , 'name' => 'Clientes' , 'url' => 'clients' , 'icon' => 'fa fa-group' , 'active' => '1' , 'order' => '4' ],
                [ 'id' => '5' , 'id_group' => '1' , 'name' => 'Servicios' , 'url' => 'services' , 'icon' => 'fa fa-flask' , 'active' => '1' , 'order' => '5' ],
                [ 'id' => '6' , 'id_group' => '1' , 'name' => 'Estampados' , 'url' => 'prints' , 'icon' => 'fa fa-bookmark-o' , 'active' => '1' , 'order' => '6' ],
                [ 'id' => '7' , 'id_group' => '1' , 'name' => 'Defectos' , 'url' => 'defects' , 'icon' => 'fa fa-exclamation' , 'active' => '1' , 'order' => '7' ],
                [ 'id' => '8' , 'id_group' => '1' , 'name' => 'Colores' , 'url' => 'colors' , 'icon' => 'fa fa-eye' , 'active' => '1' , 'order' => '8' ],
                [ 'id' => '9' , 'id_group' => '1' , 'name' => 'Metodos de pago' , 'url' => 'payment_methods' , 'icon' => 'fa fa-money' , 'active' => '1' , 'order' => '9' ],
                [ 'id' => '10' , 'id_group' => '2' , 'name' => 'Ordenes' , 'url' => 'orders' , 'icon' => 'fa fa-users' , 'active' => '1' , 'order' => '1' ],
                [ 'id' => '11' , 'id_group' => '2' , 'name' => 'Gastos' , 'url' => 'expenses' , 'icon' => 'fa fa-dollar ' , 'active' => '1' , 'order' => '2' ],
                [ 'id' => '12' , 'id_group' => '2' , 'name' => 'Entregas' , 'url' => 'deliveries' , 'icon' => 'fa fa-archive' , 'active' => '1' , 'order' => '3' ],
                [ 'id' => '13' , 'id_group' => '2' , 'name' => 'Recoleccion' , 'url' => 'harvest' , 'icon' => 'fa fa-clock-o' , 'active' => '1' , 'order' => '4' ],
                [ 'id' => '14' , 'id_group' => '2' , 'name' => 'Monederos' , 'url' => 'purses' , 'icon' => 'fa fa-id-card-o' , 'active' => '1' , 'order' => '5' ],
                [ 'id' => '15' , 'id_group' => '2' , 'name' => 'Corte' , 'url' => 'daily_cut' , 'icon' => 'fa fa-money' , 'active' => '1' , 'order' => '6' ],
                [ 'id' => '16' , 'id_group' => '3' , 'name' => 'Reporte de ventas' , 'url' => 'sales_report' , 'icon' => 'fa fa-bar-chart-o' , 'active' => '1' , 'order' => '1' ],
                [ 'id' => '17' , 'id_group' => '3' , 'name' => 'Reporte de gastos' , 'url' => 'expense_report' , 'icon' => 'fa fa-pie-chart' , 'active' => '1' , 'order' => '2' ],
                [ 'id' => '18' , 'id_group' => '1' , 'name' => 'Conceptos de gastos' , 'url' => 'expense_concepts' , 'icon' => 'fa fa-dollar ' , 'active' => '1' , 'order' => '11' ],
            )
        );
    }
}
