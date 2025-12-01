<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenseReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_branch_office');
            $table->unsignedInteger('id_expense_concept');
            $table->unsignedInteger('id_user');
            $table->date('date_expense');
            $table->decimal('amount', 8,2);
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense_reports');
    }
}
