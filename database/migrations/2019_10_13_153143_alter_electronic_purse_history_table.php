<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterElectronicPurseHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('electronic_purse_history', function (Blueprint $table) {
            $table->unsignedInteger('id_order');
            $table->string('description');
        });
        Schema::table('electronic_purse_history', function (Blueprint $table) {
            $table->foreign('id_order')
                ->references('id')
                ->on('orders')
                ->onDelete('restrict')
                ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('electronic_purse_history', function (Blueprint $table) {
            $table->dropColumn('id_order');
            $table->dropColumn('description');
        });
    }
}
