<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToElectronicPurseHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('electronic_purse_history', function (Blueprint $table) {
            $table->foreign('id_electronic_purse')
                ->references('id')
                ->on('electronic_purse')
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
            $table->dropForeign('electronic_purse_history_id_electronic_purse_foreign');
        });
    }
}
