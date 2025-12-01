<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $this->call(UserTypesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(GroupsSeeder::class);
        $this->call(ModulesSeeder::class);
        $this->call(ProfilePermissionsSeeder::class);
        $this->call(ServiceCategoriesSeeder::class);
        $this->call(ServicesSeeder::class);
        $this->call(DefectsSeeder::class);
        $this->call(PrintsSeeder::class);
        $this->call(ColorsSeeder::class);
        $this->call(PaymentMethodsSeeder::class);
        $this->call(PrioritiesSeeder::class);
        $this->call(OrderStatusSeeder::class);
        $this->call(OrderDetailStatusSeeder::class);
        $this->call(CalendarSeeder::class);
        $this->call(ExpenseConceptsSeeder::class);
        */
        $this->call(ClientsSeeder::class);
    }
}
