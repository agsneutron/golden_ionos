<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElectronicPurseHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('electronic_purse_history', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_electronic_purse');
            $table->decimal('amount',8,2);
            $table->unsignedInteger('movement_type');
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
        Schema::dropIfExists('electronic_purse_history');
    }
}
