<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar', function (Blueprint $table) {
            $table->date('day')->primary();
            $table->string('name',70);
            $table->unsignedInteger('year');
            $table->string('month',15);
            $table->unsignedInteger('month_number');
            $table->unsignedInteger('day_of_the_year');
            $table->unsignedInteger('weekday');
            $table->unsignedInteger('day_of_the_month');
            $table->string('name_day',15);
            $table->string('short_name',15);
            $table->unsignedInteger('week');
            $table->unsignedInteger('bimester');
            $table->unsignedInteger('trimester');
            $table->unsignedInteger('semestre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar');
    }
}
